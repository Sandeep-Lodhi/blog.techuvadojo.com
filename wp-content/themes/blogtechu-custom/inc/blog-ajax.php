<?php
/**
 * Blog page helpers: a shared post-card renderer and an AJAX endpoint that
 * powers in-place category filtering and the "Load More" button on the Blog
 * page. Rendering the cards through one function keeps the server-side and
 * AJAX-loaded markup identical.
 *
 * @package Blogtechu_Custom
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Estimated reading time for a post.
 */
if ( ! function_exists( 'blogtechu_reading_time' ) ) {
	function blogtechu_reading_time( $post_id = null ) {
		$content = get_post_field( 'post_content', $post_id ? $post_id : get_the_ID() );
		$words   = str_word_count( wp_strip_all_tags( $content ) );
		$minutes = max( 1, (int) ceil( $words / 200 ) );
		/* translators: %d: number of minutes. */
		return sprintf( _n( '%d min read', '%d min read', $minutes, 'blogtechu-custom' ), $minutes );
	}
}

/**
 * Resolve a cover image for a post: its featured image when set, otherwise a
 * themed SVG illustration chosen from the post's first category.
 */
if ( ! function_exists( 'blogtechu_post_cover_url' ) ) {
	function blogtechu_post_cover_url( $post_id = null ) {
		$post_id = $post_id ? $post_id : get_the_ID();

		if ( has_post_thumbnail( $post_id ) ) {
			return get_the_post_thumbnail_url( $post_id, 'medium_large' );
		}

		// Map category slug -> cover file in /assets/images/blog/.
		$map = array(
			'ai'                        => 'ai',
			'programming'               => 'code',
			'coding'                    => 'code',
			'technologies'             => 'code',
			'extensions'                => 'code',
			'extensions-chrome-vs-code' => 'code',
			'apps'                      => 'code',
			'plugins'                   => 'code',
			'useful-websites'           => 'code',
			'useful-sites-website'      => 'code',
			'wordpress'                 => 'wordpress',
			'shopify'                   => 'shopify',
			'dropshipping'              => 'shopify',
			'tools'                     => 'tools',
			'online-earning'            => 'money',
			'freelancing'               => 'money',
			'advertising'               => 'marketing',
			'social-media'              => 'marketing',
			'social-marketing'          => 'marketing',
			'funnels-building'          => 'marketing',
			'interviews'                => 'marketing',
			'tech-companies'            => 'default',
			'government'                => 'default',
		);

		$cats = get_the_category( $post_id );
		$slug = ! empty( $cats ) ? $cats[0]->slug : '';
		$file = isset( $map[ $slug ] ) ? $map[ $slug ] : 'default';

		return get_theme_file_uri( '/assets/images/blog/' . $file . '.svg' );
	}
}

/**
 * Returns a colored SVG icon + accent color for a category slug, used in the
 * sidebar Categories list (flat colored-icon style like the reference design).
 *
 * @return array{color:string,svg:string}
 */
if ( ! function_exists( 'blogtechu_cat_icon' ) ) {
	function blogtechu_cat_icon( $slug ) {
		$paths = array(
			'tools'                     => '<circle cx="12" cy="12" r="3"/><path d="M12 2v3M12 19v3M4.2 4.2l2.1 2.1M17.7 17.7l2.1 2.1M2 12h3M19 12h3M4.2 19.8l2.1-2.1M17.7 6.3l2.1-2.1"/>',
			'ai'                        => '<rect x="6" y="6" width="12" height="12" rx="2"/><rect x="9.5" y="9.5" width="5" height="5"/><path d="M9 2v2M15 2v2M9 20v2M15 20v2M2 9h2M2 15h2M20 9h2M20 15h2"/>',
			'programming'               => '<path d="M8 9l-3 3 3 3M16 9l3 3-3 3M13 6l-2 12"/>',
			'coding'                    => '<path d="M8 9l-3 3 3 3M16 9l3 3-3 3M13 6l-2 12"/>',
			'technologies'              => '<path d="M13 2 4 14h7l-1 8 9-12h-7l1-8z"/>',
			'tech-companies'            => '<rect x="5" y="3" width="14" height="18" rx="1"/><path d="M9 7h2M13 7h2M9 11h2M13 11h2M9 15h2M13 15h2"/>',
			'interviews'                => '<rect x="9" y="3" width="6" height="11" rx="3"/><path d="M5 11a7 7 0 0 0 14 0M12 18v3M9 21h6"/>',
			'social-media'              => '<path d="M21 12a8 8 0 0 1-11.5 7.2L4 21l1.8-5.5A8 8 0 1 1 21 12z"/>',
			'dropshipping'              => '<rect x="2" y="7" width="12" height="9" rx="1"/><path d="M14 10h4l3 3v3h-7z"/><circle cx="7" cy="18" r="1.6"/><circle cx="17" cy="18" r="1.6"/>',
			'shopify'                   => '<path d="M6 8h12l-1 12H7L6 8z"/><path d="M9 8a3 3 0 0 1 6 0"/>',
			'wordpress'                 => '<circle cx="12" cy="12" r="9"/><path d="M3 12h18M12 3a14 14 0 0 1 0 18M12 3a14 14 0 0 0 0 18"/>',
			'online-earning'            => '<circle cx="12" cy="12" r="9"/><path d="M12 7v10M14.5 9.5a2.5 2.5 0 0 0-5 0c0 3 5 1.5 5 4.5a2.5 2.5 0 0 1-5 0"/>',
			'freelancing'               => '<rect x="3" y="7" width="18" height="13" rx="2"/><path d="M8 7V5a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2M3 13h18"/>',
			'government'                => '<path d="M3 9l9-5 9 5M5 9v8M9 9v8M15 9v8M19 9v8M3 21h18M3 9h18"/>',
			'useful-websites'           => '<path d="M10 13a4 4 0 0 0 6 .5l2-2a4 4 0 0 0-5.7-5.7l-1 1M14 11a4 4 0 0 0-6-.5l-2 2a4 4 0 0 0 5.7 5.7l1-1"/>',
			'useful-sites-website'      => '<path d="M10 13a4 4 0 0 0 6 .5l2-2a4 4 0 0 0-5.7-5.7l-1 1M14 11a4 4 0 0 0-6-.5l-2 2a4 4 0 0 0 5.7 5.7l1-1"/>',
			'advertising'               => '<path d="M3 11v2a1 1 0 0 0 1 1h2l9 5V5L6 10H4a1 1 0 0 0-1 1zM18 9a3 3 0 0 1 0 6"/>',
			'extensions'                => '<path d="M10 4a2 2 0 1 1 4 0v2h3a1 1 0 0 1 1 1v3h-2a2 2 0 1 0 0 4h2v3a1 1 0 0 1-1 1h-3v-2a2 2 0 1 0-4 0v2H7a1 1 0 0 1-1-1v-3H4a2 2 0 1 1 0-4h2V7a1 1 0 0 1 1-1h3z"/>',
			'extensions-chrome-vs-code' => '<path d="M10 4a2 2 0 1 1 4 0v2h3a1 1 0 0 1 1 1v3h-2a2 2 0 1 0 0 4h2v3a1 1 0 0 1-1 1h-3v-2a2 2 0 1 0-4 0v2H7a1 1 0 0 1-1-1v-3H4a2 2 0 1 1 0-4h2V7a1 1 0 0 1 1-1h3z"/>',
			'apps'                      => '<rect x="4" y="4" width="7" height="7" rx="1"/><rect x="13" y="4" width="7" height="7" rx="1"/><rect x="4" y="13" width="7" height="7" rx="1"/><rect x="13" y="13" width="7" height="7" rx="1"/>',
			'plugins'                   => '<path d="M9 2v6M15 2v6M7 8h10v3a5 5 0 0 1-10 0V8zM12 16v6"/>',
			'funnels-building'          => '<path d="M3 4h18l-7 8v6l-4 2v-8L3 4z"/>',
			'social-marketing'          => '<circle cx="18" cy="5" r="2"/><circle cx="6" cy="12" r="2"/><circle cx="18" cy="19" r="2"/><path d="M8 11l8-5M8 13l8 5"/>',
		);

		$colors = array(
			'tools'                     => '#0ea5e9',
			'ai'                        => '#f59e0b',
			'programming'               => '#2563eb',
			'coding'                    => '#2563eb',
			'technologies'              => '#6366f1',
			'tech-companies'            => '#0284c7',
			'interviews'                => '#f43f5e',
			'social-media'              => '#ec4899',
			'dropshipping'              => '#d97706',
			'shopify'                   => '#16a34a',
			'wordpress'                 => '#1d4ed8',
			'online-earning'            => '#059669',
			'freelancing'               => '#7c3aed',
			'government'                => '#0d9488',
			'useful-websites'           => '#06b6d4',
			'useful-sites-website'      => '#06b6d4',
			'advertising'               => '#ef4444',
			'extensions'                => '#9333ea',
			'extensions-chrome-vs-code' => '#9333ea',
			'apps'                      => '#d946ef',
			'plugins'                   => '#4f46e5',
			'funnels-building'          => '#ea580c',
			'social-marketing'          => '#db2777',
		);

		$inner = isset( $paths[ $slug ] ) ? $paths[ $slug ] : '<circle cx="12" cy="12" r="9"/><path d="M12 8v4l3 2"/>';
		$color = isset( $colors[ $slug ] ) ? $colors[ $slug ] : '#2563eb';
		$svg   = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">' . $inner . '</svg>';

		return array( 'color' => $color, 'svg' => $svg );
	}
}

/**
 * Render a single blog post card (call inside the loop).
 */
if ( ! function_exists( 'blogtechu_render_post_card' ) ) {
	function blogtechu_render_post_card() {
		$cats  = get_the_category();
		$cat   = ! empty( $cats ) ? $cats[0] : null;
		$cover = blogtechu_post_cover_url();
		?>
		<article class="post-card">
			<a class="post-card-media" href="<?php the_permalink(); ?>" aria-label="<?php the_title_attribute(); ?>">
				<img class="post-card-img" src="<?php echo esc_url( $cover ); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy" />
				<?php
				if ( $cat ) :
					$cat_color = blogtechu_cat_icon( $cat->slug );
					?>
					<span class="post-card-cat" style="background-color:<?php echo esc_attr( $cat_color['color'] ); ?>;"><?php echo esc_html( $cat->name ); ?></span>
				<?php endif; ?>
			</a>
			<div class="post-card-body">
				<div class="post-card-metatop">
					<span><?php echo esc_html( get_the_date() ); ?></span>
					<span class="post-card-dot"></span>
					<span><?php echo esc_html( blogtechu_reading_time() ); ?></span>
				</div>
				<h3 class="post-card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
				<p class="post-card-excerpt"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 18 ) ); ?></p>
				<div class="post-card-foot">
					<?php echo get_avatar( get_the_author_meta( 'ID' ), 36, '', '', array( 'class' => 'post-card-avatar' ) ); ?>
					<span class="post-card-author"><?php the_author(); ?></span>
					<span class="post-card-readmore"><?php esc_html_e( 'Read', 'blogtechu-custom' ); ?> <span class="post-card-arrow" aria-hidden="true">→</span></span>
				</div>
			</div>
		</article>
		<?php
	}
}

/**
 * AJAX: return a page of post cards (optionally filtered by category).
 */
function blogtechu_get_blog_posts() {
	check_ajax_referer( 'blogtechu_blog', 'nonce' );

	$paged    = isset( $_POST['paged'] ) ? max( 1, (int) $_POST['paged'] ) : 1;
	$category = isset( $_POST['category'] ) ? sanitize_title( wp_unslash( $_POST['category'] ) ) : 'all';
	$exclude  = isset( $_POST['exclude'] ) ? array_filter( array_map( 'absint', explode( ',', (string) wp_unslash( $_POST['exclude'] ) ) ) ) : array();
	$per_page = 12;

	$args = array(
		'post_type'           => 'post',
		'post_status'         => 'publish',
		'posts_per_page'      => $per_page,
		'paged'               => $paged,
		'ignore_sticky_posts' => true,
	);

	if ( $category && 'all' !== $category ) {
		$args['category_name'] = $category;
	}
	if ( ! empty( $exclude ) ) {
		$args['post__not_in'] = $exclude;
	}

	$query = new WP_Query( $args );

	ob_start();
	if ( $query->have_posts() ) {
		while ( $query->have_posts() ) {
			$query->the_post();
			blogtechu_render_post_card();
		}
	} else {
		echo '<p class="post-grid-empty">' . esc_html__( 'No articles found in this category yet.', 'blogtechu-custom' ) . '</p>';
	}
	$html = ob_get_clean();

	wp_reset_postdata();

	wp_send_json_success(
		array(
			'html'    => $html,
			'hasMore' => $paged < (int) $query->max_num_pages,
			'found'   => (int) $query->found_posts,
		)
	);
}
add_action( 'wp_ajax_blogtechu_get_blog_posts', 'blogtechu_get_blog_posts' );
add_action( 'wp_ajax_nopriv_blogtechu_get_blog_posts', 'blogtechu_get_blog_posts' );
