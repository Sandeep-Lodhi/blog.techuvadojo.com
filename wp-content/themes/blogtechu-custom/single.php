<?php
/**
 * Single blog post reading page.
 *
 * @package Blogtechu_Custom
 */

get_header();
?>

<div class="reading-progress" data-reading-progress></div>

<?php
while ( have_posts() ) :
	the_post();

	$cats      = get_the_category();
	$cat       = ! empty( $cats ) ? $cats[0] : null;
	$cat_color = $cat ? blogtechu_cat_icon( $cat->slug ) : array( 'color' => '#2563eb' );
	$cover     = blogtechu_post_cover_url();
	$author_id = (int) get_the_author_meta( 'ID' );
	$bio       = get_the_author_meta( 'description' );
	$permalink = get_permalink();
	$share_t   = rawurlencode( get_the_title() );
	$share_u   = rawurlencode( $permalink );
	?>

	<article <?php post_class( 'single-post' ); ?>>

		<!-- Header -->
		<!-- Header -->
		<header class="single-head">
			<?php if ( $cat ) : ?>
				<a class="single-cat" style="background-color:<?php echo esc_attr( $cat_color['color'] ); ?>;" href="<?php echo esc_url( get_category_link( $cat->term_id ) ); ?>"><?php echo esc_html( $cat->name ); ?></a>
			<?php endif; ?>

			<h1 class="single-title"><?php the_title(); ?></h1>

			<div class="single-meta">
				<?php echo get_avatar( $author_id, 40, '', '', array( 'class' => 'single-meta-avatar' ) ); ?>
				<span class="single-meta-author"><?php the_author(); ?></span>
				<span class="single-meta-dot"></span>
				<span><?php echo esc_html( get_the_date() ); ?></span>
				<span class="single-meta-dot"></span>
				<span><?php echo esc_html( blogtechu_reading_time() ); ?></span>
			</div>
		</header>

		<!-- Cover -->
		<div class="single-cover">
			<img src="<?php echo esc_url( $cover ); ?>" alt="<?php the_title_attribute(); ?>" />
		</div>

		<!-- Two-column body: content + sticky aside -->
		<div class="single-layout">
			<div class="single-main">

				<!-- Content -->
				<div class="single-content entry-content" data-reading-target>
					<?php
					the_content();

					wp_link_pages(
						array(
							'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'blogtechu-custom' ),
							'after'  => '</div>',
						)
					);
					?>
				</div>

				<!-- Tags -->
				<?php if ( has_tag() ) : ?>
					<div class="single-tags">
						<?php foreach ( get_the_tags() as $tag ) : ?>
							<a class="tag-chip" href="<?php echo esc_url( get_tag_link( $tag->term_id ) ); ?>"><?php echo esc_html( $tag->name ); ?></a>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>

				<!-- Share -->
				<div class="single-share">
					<span class="single-share-label"><?php esc_html_e( 'Share:', 'blogtechu-custom' ); ?></span>
					<a href="https://twitter.com/intent/tweet?url=<?php echo $share_u; // phpcs:ignore ?>&text=<?php echo $share_t; // phpcs:ignore ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php esc_attr_e( 'Share on X', 'blogtechu-custom' ); ?>"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M18.9 2H22l-7.6 8.7L23.3 22h-6.9l-5.4-7-6.2 7H1.6l8.1-9.3L1 2h7.1l4.9 6.5L18.9 2zm-2.4 18h1.9L7.6 4H5.6l10.9 16z"/></svg></a>
					<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $share_u; // phpcs:ignore ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php esc_attr_e( 'Share on Facebook', 'blogtechu-custom' ); ?>"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M22 12a10 10 0 1 0-11.6 9.9v-7H7.9V12h2.5V9.8c0-2.5 1.5-3.9 3.8-3.9 1.1 0 2.2.2 2.2.2v2.5h-1.2c-1.2 0-1.6.8-1.6 1.6V12h2.7l-.4 2.9h-2.3v7A10 10 0 0 0 22 12z"/></svg></a>
					<a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo $share_u; // phpcs:ignore ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php esc_attr_e( 'Share on LinkedIn', 'blogtechu-custom' ); ?>"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M20.45 20.45h-3.56v-5.57c0-1.33-.02-3.04-1.85-3.04-1.85 0-2.13 1.45-2.13 2.94v5.67H9.35V9h3.41v1.56h.05c.48-.9 1.64-1.85 3.37-1.85 3.6 0 4.27 2.37 4.27 5.46v6.28zM5.34 7.43a2.07 2.07 0 1 1 0-4.14 2.07 2.07 0 0 1 0 4.14zM7.12 20.45H3.56V9h3.56v11.45zM22.22 0H1.77C.79 0 0 .77 0 1.73v20.54C0 23.23.79 24 1.77 24h20.45c.98 0 1.78-.77 1.78-1.73V1.73C24 .77 23.2 0 22.22 0z"/></svg></a>
					<button type="button" data-copy-link="<?php echo esc_url( $permalink ); ?>" aria-label="<?php esc_attr_e( 'Copy link', 'blogtechu-custom' ); ?>"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10 13a5 5 0 0 0 7 0l3-3a5 5 0 0 0-7-7l-1 1M14 11a5 5 0 0 0-7 0l-3 3a5 5 0 0 0 7 7l1-1"/></svg></button>
				</div>

				<?php // Author box hidden per request. ?>
				<?php if ( false ) : ?>
				<div class="single-author-box">
					<?php echo get_avatar( $author_id, 64, '', '', array( 'class' => 'single-author-avatar' ) ); ?>
					<div>
						<div class="single-author-label"><?php esc_html_e( 'Written by', 'blogtechu-custom' ); ?></div>
						<div class="single-author-name"><?php the_author(); ?></div>
						<p class="single-author-bio">
							<?php
							echo $bio
								? esc_html( $bio )
								: esc_html__( 'Sharing practical tech knowledge, tutorials and insights to help you build and grow.', 'blogtechu-custom' );
							?>
						</p>
					</div>
				</div>
				<?php endif; ?>

				<!-- Prev / next navigation -->
				<?php
				$prev_post = get_previous_post();
				$next_post = get_next_post();
				?>
				<?php if ( $prev_post || $next_post ) : ?>
					<nav class="single-nav">
						<?php if ( $prev_post ) : ?>
							<a class="single-nav-card is-prev" href="<?php echo esc_url( get_permalink( $prev_post ) ); ?>">
								<span class="single-nav-dir">← <?php esc_html_e( 'Previous', 'blogtechu-custom' ); ?></span>
								<span class="single-nav-title"><?php echo esc_html( get_the_title( $prev_post ) ); ?></span>
							</a>
						<?php else : ?>
							<span></span>
						<?php endif; ?>
						<?php if ( $next_post ) : ?>
							<a class="single-nav-card is-next" href="<?php echo esc_url( get_permalink( $next_post ) ); ?>">
								<span class="single-nav-dir"><?php esc_html_e( 'Next', 'blogtechu-custom' ); ?> →</span>
								<span class="single-nav-title"><?php echo esc_html( get_the_title( $next_post ) ); ?></span>
							</a>
						<?php endif; ?>
					</nav>
				<?php endif; ?>

			</div>

			<!-- Sticky aside: TOC + newsletter -->
			<aside class="single-aside">
				<div class="single-aside-inner">
					<div class="single-toc-card" data-toc-card hidden>
						<div class="single-toc-title"><?php esc_html_e( 'On this page', 'blogtechu-custom' ); ?></div>
						<nav class="single-toc" data-toc></nav>
					</div>

					<div class="sidebar-cta">
						<h3><?php esc_html_e( 'Enjoying this?', 'blogtechu-custom' ); ?></h3>
						<p><?php esc_html_e( 'Get new tutorials and tech insights in your inbox.', 'blogtechu-custom' ); ?></p>
						<form onsubmit="return false;">
							<input type="email" placeholder="<?php esc_attr_e( 'you@example.com', 'blogtechu-custom' ); ?>" aria-label="<?php esc_attr_e( 'Email address', 'blogtechu-custom' ); ?>" />
							<button type="submit"><?php esc_html_e( 'Subscribe', 'blogtechu-custom' ); ?></button>
						</form>
					</div>
				</div>
			</aside>
		</div>

		<!-- Related posts -->
		<?php
		if ( $cat ) :
			$related = new WP_Query(
				array(
					'post_type'           => 'post',
					'posts_per_page'      => 3,
					'post__not_in'        => array( get_the_ID() ),
					'category__in'        => array( $cat->term_id ),
					'ignore_sticky_posts' => true,
					'no_found_rows'       => true,
				)
			);
			if ( $related->have_posts() ) :
				?>
				<section class="single-related">
					<div class="single-related-head">
						<h2 class="section-heading"><?php esc_html_e( 'Related Articles', 'blogtechu-custom' ); ?></h2>
						<a class="read-more-link" href="<?php echo esc_url( get_category_link( $cat->term_id ) ); ?>"><?php esc_html_e( 'View all', 'blogtechu-custom' ); ?> →</a>
					</div>
					<div class="single-related-grid">
						<?php
						while ( $related->have_posts() ) :
							$related->the_post();
							blogtechu_render_post_card();
						endwhile;
						?>
					</div>
				</section>
				<?php
			endif;
			wp_reset_postdata();
		endif;
		?>

	</article>

	<?php
	if ( comments_open() || get_comments_number() ) {
		echo '<div class="mx-auto max-w-3xl px-5 pb-20">';
		comments_template();
		echo '</div>';
	}

endwhile;
?>

<button type="button" class="back-to-top" data-back-to-top aria-label="<?php esc_attr_e( 'Back to top', 'blogtechu-custom' ); ?>">
	<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" width="20" height="20"><path d="M12 19V5M5 12l7-7 7 7"/></svg>
</button>

<?php
get_footer();
