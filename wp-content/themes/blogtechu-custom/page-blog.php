<?php
/**
 * Template for the Blog page (auto-loaded for the page with slug "blog").
 *
 * Modern blog index: hero with search, category filter bar, a featured post,
 * a responsive post grid, and a sticky sidebar (categories, popular posts,
 * tags and a newsletter CTA). Built on the theme's existing brand palette.
 *
 * @package Blogtechu_Custom
 */

get_header();

// blogtechu_reading_time() and blogtechu_render_post_card() live in inc/blog-ajax.php.

$paged = max( 1, (int) get_query_var( 'paged' ), (int) get_query_var( 'page' ) );

/* --- Featured post: most recent, shown only on the first page. --- */
$featured_id = 0;
if ( 1 === $paged ) {
	$featured_q = new WP_Query(
		array(
			'post_type'           => 'post',
			'posts_per_page'      => 1,
			'ignore_sticky_posts' => true,
			'no_found_rows'       => true,
		)
	);
	if ( $featured_q->have_posts() ) {
		$featured_q->the_post();
		$featured_id = get_the_ID();
	}
}
?>

<!-- Hero -->
<section class="blog-hero">
	<div class="blog-hero-inner">
		<span class="blog-hero-eyebrow"><?php esc_html_e( 'Our Blog', 'blogtechu-custom' ); ?></span>
		<h1 class="blog-hero-title">
			<?php echo wp_kses( __( 'Insights, Tutorials &amp; <em>Ideas to Inspire</em>', 'blogtechu-custom' ), array( 'em' => array() ) ); ?>
		</h1>
		<p class="blog-hero-text"><?php esc_html_e( 'Stay updated with the latest trends in technology, development, digital marketing and business growth.', 'blogtechu-custom' ); ?></p>

		<form class="blog-hero-search" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
			<input type="search" name="s" placeholder="<?php esc_attr_e( 'Search articles…', 'blogtechu-custom' ); ?>" value="<?php echo get_search_query(); ?>" />
			<button type="submit"><?php esc_html_e( 'Search', 'blogtechu-custom' ); ?></button>
		</form>
	</div>
</section>

<!-- Category filter bar -->
<?php
$blog_cats = get_categories(
	array(
		'orderby'    => 'count',
		'order'      => 'DESC',
		'hide_empty' => true,
		'number'     => 8,
	)
);
?>
<?php if ( ! empty( $blog_cats ) ) : ?>
	<nav class="blog-filter" aria-label="<?php esc_attr_e( 'Browse by category', 'blogtechu-custom' ); ?>">
		<a class="blog-filter-pill is-active" data-blog-filter="all" href="<?php echo esc_url( get_permalink() ); ?>"><?php esc_html_e( 'All', 'blogtechu-custom' ); ?></a>
		<?php foreach ( $blog_cats as $cat ) : ?>
			<a class="blog-filter-pill" data-blog-filter="<?php echo esc_attr( $cat->slug ); ?>" href="<?php echo esc_url( get_category_link( $cat->term_id ) ); ?>">
				<?php echo esc_html( $cat->name ); ?>
				<span class="count"><?php echo esc_html( $cat->count ); ?></span>
			</a>
		<?php endforeach; ?>
	</nav>
	<p class="blog-filter-hint" data-blog-count></p>
<?php endif; ?>

<!-- Featured post -->
<?php if ( $featured_id ) : ?>
	<?php
	$f_cats = get_the_category( $featured_id );
	$f_cat  = ! empty( $f_cats ) ? $f_cats[0]->name : __( 'Article', 'blogtechu-custom' );
	?>
	<article class="featured-post">
		<a class="featured-media" href="<?php the_permalink(); ?>" aria-label="<?php the_title_attribute(); ?>">
			<img src="<?php echo esc_url( blogtechu_post_cover_url( $featured_id ) ); ?>" alt="<?php the_title_attribute(); ?>" />
			<span class="featured-flag">★ <?php esc_html_e( 'Featured', 'blogtechu-custom' ); ?></span>
		</a>
		<div class="featured-body">
			<span class="featured-cat"><?php echo esc_html( $f_cat ); ?></span>
			<h2 class="featured-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			<p class="featured-excerpt"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 34 ) ); ?></p>
			<div class="featured-meta">
				<span><?php echo esc_html( get_the_author() ); ?></span>
				<span class="meta-dot"><?php echo esc_html( get_the_date() ); ?></span>
				<span class="meta-dot"><?php echo esc_html( blogtechu_reading_time() ); ?></span>
			</div>
			<a class="featured-cta" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read Article', 'blogtechu-custom' ); ?></a>
		</div>
	</article>
	<?php wp_reset_postdata(); ?>
<?php endif; ?>

<!-- Main grid + sidebar -->
<?php
$main_args = array(
	'post_type'           => 'post',
	'post_status'         => 'publish',
	'paged'               => 1,
	'posts_per_page'      => 12,
	'ignore_sticky_posts' => true,
);
if ( $featured_id ) {
	$main_args['post__not_in'] = array( $featured_id );
}
$blog_q = new WP_Query( $main_args );
?>

<div class="blog-layout">
	<!-- Posts column -->
	<div class="blog-main">
		<div class="blog-main-head">
			<h2 class="section-heading"><?php esc_html_e( 'Latest Articles', 'blogtechu-custom' ); ?></h2>
			<span class="section-subtitle"><?php echo esc_html( sprintf( __( '%d articles', 'blogtechu-custom' ), (int) wp_count_posts()->publish ) ); ?></span>
		</div>

		<?php if ( $blog_q->have_posts() ) : ?>
			<div class="post-grid" data-blog-grid>
				<?php
				while ( $blog_q->have_posts() ) :
					$blog_q->the_post();
					blogtechu_render_post_card();
				endwhile;
				?>
			</div>

			<?php if ( (int) $blog_q->max_num_pages > 1 ) : ?>
				<div class="load-more-wrap">
					<button type="button" class="load-more-btn" data-blog-loadmore>
						<span class="load-more-text"><?php esc_html_e( 'Load More Articles', 'blogtechu-custom' ); ?></span>
						<span class="load-more-spinner" aria-hidden="true"></span>
					</button>
				</div>
			<?php endif; ?>
		<?php else : ?>
			<div class="blog-empty">
				<p class="text-lg font-semibold text-slate-700"><?php esc_html_e( 'No articles yet', 'blogtechu-custom' ); ?></p>
				<p class="mt-2 text-sm"><?php esc_html_e( 'Check back soon — fresh content is on the way.', 'blogtechu-custom' ); ?></p>
			</div>
		<?php endif; ?>
		<?php wp_reset_postdata(); ?>

		<script>
			window.BlogtechuBlog = {
				ajaxUrl: <?php echo wp_json_encode( admin_url( 'admin-ajax.php' ) ); ?>,
				nonce: <?php echo wp_json_encode( wp_create_nonce( 'blogtechu_blog' ) ); ?>,
				exclude: <?php echo wp_json_encode( $featured_id ? (string) $featured_id : '' ); ?>
			};
		</script>
	</div>

	<!-- Sidebar -->
	<aside class="blog-sidebar">
		<div class="sidebar-sticky">

			<!-- Popular / recent posts -->
			<?php
			$popular = new WP_Query(
				array(
					'post_type'           => 'post',
					'posts_per_page'      => 5,
					'ignore_sticky_posts' => true,
					'no_found_rows'       => true,
				)
			);
			?>
			<?php if ( $popular->have_posts() ) : ?>
				<div class="sidebar-card">
					<h3 class="sidebar-title"><?php esc_html_e( 'Trending Reads', 'blogtechu-custom' ); ?></h3>
					<div class="mt-5 space-y-1">
						<?php
						while ( $popular->have_posts() ) :
							$popular->the_post();
							?>
							<a class="mini-post" href="<?php the_permalink(); ?>">
								<span class="mini-post-thumb">
									<?php if ( has_post_thumbnail() ) : ?>
										<?php the_post_thumbnail( 'thumbnail' ); ?>
									<?php else : ?>
										<img src="<?php echo esc_url( blogtechu_post_cover_url() ); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy" />
									<?php endif; ?>
								</span>
								<span class="min-w-0">
									<span class="mini-post-title block line-clamp-2"><?php the_title(); ?></span>
									<span class="mini-post-meta block"><?php echo esc_html( get_the_date() ); ?></span>
								</span>
							</a>
						<?php endwhile; ?>
					</div>
				</div>
				<?php wp_reset_postdata(); ?>
			<?php endif; ?>

			<!-- Categories -->
			<?php if ( ! empty( $blog_cats ) ) : ?>
				<div class="sidebar-card">
					<h3 class="sidebar-title"><?php esc_html_e( 'Categories', 'blogtechu-custom' ); ?></h3>
					<?php $blog_cats = get_categories( array( 'orderby' => 'name', 'order' => 'ASC', 'hide_empty' => false, 'exclude' => array( 1 ) ) ); ?>
						<ul class="cat-list cat-list-scroll">
						<?php foreach ( $blog_cats as $cat ) : ?>
							<li>
								<a class="cat-row" href="<?php echo esc_url( get_category_link( $cat->term_id ) ); ?>">
									<span class="cat-icon" style="color:<?php echo esc_attr( blogtechu_cat_icon( $cat->slug )['color'] ); ?>;background-color:<?php echo esc_attr( blogtechu_cat_icon( $cat->slug )['color'] ); ?>1a;"><?php echo blogtechu_cat_icon( $cat->slug )['svg']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
									<span class="cat-name"><?php echo esc_html( $cat->name ); ?></span>
									<span class="cat-count"><?php echo esc_html( $cat->count ); ?></span>
								</a>
							</li>
						<?php endforeach; ?>
					</ul>
				</div>
			<?php endif; ?>

			<!-- Tags -->
			<?php
			$tags = get_tags(
				array(
					'orderby' => 'count',
					'order'   => 'DESC',
					'number'  => 16,
				)
			);
			?>
			<?php if ( ! empty( $tags ) ) : ?>
				<div class="sidebar-card">
					<h3 class="sidebar-title"><?php esc_html_e( 'Popular Tags', 'blogtechu-custom' ); ?></h3>
					<div class="tag-cloud">
						<?php foreach ( $tags as $tag ) : ?>
							<a class="tag-chip" href="<?php echo esc_url( get_tag_link( $tag->term_id ) ); ?>"><?php echo esc_html( $tag->name ); ?></a>
						<?php endforeach; ?>
					</div>
				</div>
			<?php endif; ?>

			<!-- Newsletter CTA -->
			<div class="sidebar-cta">
				<h3><?php esc_html_e( 'Join the newsletter', 'blogtechu-custom' ); ?></h3>
				<p><?php esc_html_e( 'Get the best new tutorials and tech insights delivered to your inbox. No spam, ever.', 'blogtechu-custom' ); ?></p>
				<form onsubmit="return false;">
					<input type="email" placeholder="<?php esc_attr_e( 'you@example.com', 'blogtechu-custom' ); ?>" aria-label="<?php esc_attr_e( 'Email address', 'blogtechu-custom' ); ?>" />
					<button type="submit"><?php esc_html_e( 'Subscribe', 'blogtechu-custom' ); ?></button>
				</form>
			</div>

		</div>
	</aside>
</div>

<!-- Closing CTA banner -->
<section class="cta-banner">
	<div class="cta-banner-grid">
		<span class="cta-banner-icon">💡</span>
		<div>
			<h2 class="cta-banner-title"><?php esc_html_e( 'Have a project in mind?', 'blogtechu-custom' ); ?></h2>
			<p class="cta-banner-text"><?php esc_html_e( 'Let us help you build modern, fast and reliable digital products.', 'blogtechu-custom' ); ?></p>
		</div>
		<a class="cta-banner-button" href="<?php echo esc_url( home_url( '/contact' ) ); ?>"><?php esc_html_e( "Let's Talk", 'blogtechu-custom' ); ?></a>
	</div>
</section>

<?php
get_footer();
