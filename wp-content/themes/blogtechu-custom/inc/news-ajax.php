<?php
/**
 * News helpers: cover images, category icons/colors, a shared card renderer and
 * an AJAX endpoint powering in-place category filtering + "Load More" on the
 * News page. Mirrors the blog engine but for the "news" CPT / news_category.
 *
 * @package Blogtechu_Custom
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * First news_category name for a post.
 */
if ( ! function_exists( 'blogtechu_news_cat_name' ) ) {
	function blogtechu_news_cat_name( $post_id = null ) {
		$post_id = $post_id ? $post_id : get_the_ID();
		$terms   = get_the_terms( $post_id, 'news_category' );
		return ( $terms && ! is_wp_error( $terms ) ) ? $terms[0]->name : __( 'News', 'blogtechu-custom' );
	}
}

/**
 * Resolve a cover image: featured image, else a themed SVG by category.
 */
if ( ! function_exists( 'blogtechu_news_cover_url' ) ) {
	function blogtechu_news_cover_url( $post_id = null ) {
		$post_id = $post_id ? $post_id : get_the_ID();
		if ( has_post_thumbnail( $post_id ) ) {
			return get_the_post_thumbnail_url( $post_id, 'medium_large' );
		}
		$map = array(
			'breaking-news'       => 'breaking',
			'ai-innovation'       => 'ai',
			'startups'            => 'startup',
			'funding-investment'  => 'markets',
			'tech-companies'      => 'default',
			'business'            => 'markets',
			'product-launches'    => 'startup',
			'markets-ipos'        => 'markets',
			'cybersecurity'       => 'security',
			'cloud-enterprise'    => 'cloud',
			'events-conferences'  => 'default',
			'government-policy'    => 'default',
			'gadgets-hardware'    => 'hardware',
			'careers-jobs'        => 'default',
			'deals-acquisitions'  => 'markets',
			'opinions-analysis'   => 'default',
		);
		$terms = get_the_terms( $post_id, 'news_category' );
		$slug  = ( $terms && ! is_wp_error( $terms ) ) ? $terms[0]->slug : '';
		$file  = isset( $map[ $slug ] ) ? $map[ $slug ] : 'default';
		return get_theme_file_uri( '/assets/images/news/' . $file . '.svg' );
	}
}

/**
 * Colored SVG icon + accent color for a news category slug.
 *
 * @return array{color:string,svg:string}
 */
if ( ! function_exists( 'blogtechu_news_cat_icon' ) ) {
	function blogtechu_news_cat_icon( $slug ) {
		$paths = array(
			'breaking-news'      => '<path d="M13 2 4 14h7l-1 8 9-12h-7l1-8z"/>',
			'ai-innovation'      => '<path d="M12 3l1.6 4.4L18 9l-4.4 1.6L12 15l-1.6-4.4L6 9z"/><path d="M18 14l.8 2.2L21 17l-2.2.8L18 20l-.8-2.2L15 17z"/>',
			'startups'           => '<path d="M12 3c3 1.6 5 5 5 9l-2.5 2.5h-5L7 12c0-4 2-7.4 5-9z"/><circle cx="12" cy="9" r="1.6"/><path d="M9.5 14.5l-2.5 4 4-1.5M14.5 14.5l2.5 4-4-1.5"/>',
			'funding-investment' => '<circle cx="12" cy="12" r="9"/><path d="M12 7v10M14.5 9.5a2.5 2.5 0 0 0-5 0c0 3 5 1.5 5 4.5a2.5 2.5 0 0 1-5 0"/>',
			'tech-companies'     => '<rect x="5" y="3" width="14" height="18" rx="1"/><path d="M9 7h2M13 7h2M9 11h2M13 11h2M9 15h2M13 15h2"/>',
			'business'           => '<rect x="3" y="7" width="18" height="13" rx="2"/><path d="M8 7V5a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2M3 13h18"/>',
			'product-launches'   => '<path d="M21 8l-9-5-9 5 9 5 9-5z"/><path d="M3 8v8l9 5 9-5V8"/>',
			'markets-ipos'       => '<path d="M3 3v18h18"/><path d="M7 14l4-4 3 3 5-6"/>',
			'cybersecurity'      => '<path d="M12 3l8 3v5c0 5-3.5 8-8 10-4.5-2-8-5-8-10V6z"/><path d="M9 12l2 2 4-4"/>',
			'cloud-enterprise'   => '<path d="M17.5 19a4.5 4.5 0 0 0 .5-9 6.5 6.5 0 0 0-12.4-1.5A4 4 0 0 0 6 19z"/>',
			'events-conferences' => '<rect x="3" y="5" width="18" height="16" rx="2"/><path d="M3 9h18M8 3v4M16 3v4"/>',
			'government-policy'   => '<path d="M3 9l9-5 9 5M5 9v8M9 9v8M15 9v8M19 9v8M3 21h18M3 9h18"/>',
			'gadgets-hardware'   => '<rect x="6" y="6" width="12" height="12" rx="2"/><rect x="9.5" y="9.5" width="5" height="5"/><path d="M9 2v2M15 2v2M9 20v2M15 20v2M2 9h2M2 15h2M20 9h2M20 15h2"/>',
			'careers-jobs'       => '<rect x="3" y="7" width="18" height="13" rx="2"/><path d="M8 7V5a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2M3 13h18"/>',
			'deals-acquisitions' => '<path d="M4 8h12l-3-3M20 16H8l3 3"/>',
			'opinions-analysis'  => '<path d="M21 12a8 8 0 0 1-11.5 7.2L4 21l1.8-5.5A8 8 0 1 1 21 12z"/>',
		);
		$colors = array(
			'breaking-news'      => '#ef4444',
			'ai-innovation'      => '#7c3aed',
			'startups'           => '#ea580c',
			'funding-investment' => '#059669',
			'tech-companies'     => '#0284c7',
			'business'           => '#0891b2',
			'product-launches'   => '#d97706',
			'markets-ipos'       => '#16a34a',
			'cybersecurity'      => '#e11d48',
			'cloud-enterprise'   => '#2563eb',
			'events-conferences' => '#db2777',
			'government-policy'   => '#0d9488',
			'gadgets-hardware'   => '#4f46e5',
			'careers-jobs'       => '#0891b2',
			'deals-acquisitions' => '#c026d3',
			'opinions-analysis'  => '#475569',
		);
		$inner = isset( $paths[ $slug ] ) ? $paths[ $slug ] : '<rect x="3" y="4" width="18" height="16" rx="2"/><path d="M7 9h10M7 13h10M7 17h6"/>';
		$color = isset( $colors[ $slug ] ) ? $colors[ $slug ] : '#2563eb';
		$svg   = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">' . $inner . '</svg>';
		return array( 'color' => $color, 'svg' => $svg );
	}
}

/**
 * Render a single news card (call inside the loop). Reuses the polished
 * .post-card styles from the blog for visual parity.
 */
if ( ! function_exists( 'blogtechu_render_news_card' ) ) {
	function blogtechu_render_news_card() {
		$terms = get_the_terms( get_the_ID(), 'news_category' );
		$term  = ( $terms && ! is_wp_error( $terms ) ) ? $terms[0] : null;
		$color = $term ? blogtechu_news_cat_icon( $term->slug )['color'] : '#2563eb';
		$cover = blogtechu_news_cover_url();
		?>
		<article class="post-card">
			<a class="post-card-media" href="<?php the_permalink(); ?>" aria-label="<?php the_title_attribute(); ?>">
				<img class="post-card-img" src="<?php echo esc_url( $cover ); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy" />
				<?php if ( $term ) : ?>
					<span class="post-card-cat" style="background-color:<?php echo esc_attr( $color ); ?>;"><?php echo esc_html( $term->name ); ?></span>
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
 * AJAX: return a page of news cards (optionally filtered by news_category).
 */
function blogtechu_get_news_posts() {
	check_ajax_referer( 'blogtechu_news', 'nonce' );

	$paged    = isset( $_POST['paged'] ) ? max( 1, (int) $_POST['paged'] ) : 1;
	$category = isset( $_POST['category'] ) ? sanitize_title( wp_unslash( $_POST['category'] ) ) : 'all';
	$exclude  = isset( $_POST['exclude'] ) ? array_filter( array_map( 'absint', explode( ',', (string) wp_unslash( $_POST['exclude'] ) ) ) ) : array();

	$args = array(
		'post_type'      => 'news',
		'post_status'    => 'publish',
		'posts_per_page' => 9,
		'paged'          => $paged,
	);
	if ( $category && 'all' !== $category ) {
		$args['tax_query'] = array(
			array(
				'taxonomy' => 'news_category',
				'field'    => 'slug',
				'terms'    => $category,
			),
		);
	}
	if ( ! empty( $exclude ) ) {
		$args['post__not_in'] = $exclude;
	}

	$query = new WP_Query( $args );

	ob_start();
	if ( $query->have_posts() ) {
		while ( $query->have_posts() ) {
			$query->the_post();
			blogtechu_render_news_card();
		}
	} else {
		echo '<p class="post-grid-empty">' . esc_html__( 'No news in this category yet.', 'blogtechu-custom' ) . '</p>';
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
add_action( 'wp_ajax_blogtechu_get_news_posts', 'blogtechu_get_news_posts' );
add_action( 'wp_ajax_nopriv_blogtechu_get_news_posts', 'blogtechu_get_news_posts' );
