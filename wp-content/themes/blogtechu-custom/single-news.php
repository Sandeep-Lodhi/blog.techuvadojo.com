<?php
/**
 * Single News article — real news-site layout (Aaj Tak / NewsBeat style).
 * Article + sticky sidebar (Trending, Latest, Photos, Follow). No author bio,
 * no comments — like a news portal. Helpers in inc/news-ajax.php.
 *
 * @package Blogtechu_Custom
 */

get_header();

$news_page = get_page_by_path( 'news' );
$news_url  = $news_page ? get_permalink( $news_page ) : home_url( '/' );
?>

<div class="reading-progress" data-reading-progress></div>

<?php
while ( have_posts() ) :
	the_post();

	$terms     = get_the_terms( get_the_ID(), 'news_category' );
	$term      = ( $terms && ! is_wp_error( $terms ) ) ? $terms[0] : null;
	$cat_color = $term ? blogtechu_news_cat_icon( $term->slug )['color'] : '#2563eb';
	$cover     = blogtechu_news_cover_url();
	$author_id = (int) get_the_author_meta( 'ID' );
	$tag_terms = get_the_terms( get_the_ID(), 'news_tag' );
	$permalink = get_permalink();
	$u         = rawurlencode( $permalink );
	$t_enc     = rawurlencode( get_the_title() );
	$deck      = get_the_excerpt();
	$thumb_cap = has_post_thumbnail() ? wp_get_attachment_caption( get_post_thumbnail_id() ) : '';
	?>

	<div class="na-wrap">

		<!-- Article -->
		<article class="na-main">
			<nav class="na-breadcrumb" aria-label="Breadcrumb">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'blogtechu-custom' ); ?></a><i>›</i>
				<a href="<?php echo esc_url( $news_url ); ?>"><?php esc_html_e( 'Newsbeat', 'blogtechu-custom' ); ?></a>
				<?php if ( $term ) : ?><i>›</i><a href="<?php echo esc_url( get_term_link( $term ) ); ?>"><?php echo esc_html( $term->name ); ?></a><?php endif; ?>
				<i>›</i><span class="text-slate-400 line-clamp-1"><?php echo esc_html( wp_trim_words( get_the_title(), 6 ) ); ?></span>
			</nav>

			<?php if ( $term ) : ?>
				<a class="na-cat" style="background-color:<?php echo esc_attr( $cat_color ); ?>;" href="<?php echo esc_url( get_term_link( $term ) ); ?>"><?php echo esc_html( $term->name ); ?></a>
			<?php endif; ?>

			<h1 class="na-title"><?php the_title(); ?></h1>

			<?php if ( $deck ) : ?>
				<p class="na-deck"><?php echo esc_html( wp_trim_words( $deck, 36 ) ); ?></p>
			<?php endif; ?>

			<!-- Byline -->
			<div class="na-byline">
				<?php echo get_avatar( $author_id, 40, '', '', array( 'class' => 'na-byline-avatar' ) ); ?>
				<span>
					<span class="na-byline-name block"><?php printf( esc_html__( 'By %s', 'blogtechu-custom' ), esc_html( get_the_author() ) ); ?></span>
					<span class="na-byline-meta block"><?php echo esc_html( get_the_date() ); ?> · <?php echo esc_html( blogtechu_reading_time() ); ?></span>
				</span>
				<span class="na-byline-share">
					<a class="na-ishare" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $u; // phpcs:ignore ?>" target="_blank" rel="noopener noreferrer" aria-label="Facebook"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M22 12a10 10 0 1 0-11.6 9.9v-7H7.9V12h2.5V9.8c0-2.5 1.5-3.9 3.8-3.9 1.1 0 2.2.2 2.2.2v2.5h-1.2c-1.2 0-1.6.8-1.6 1.6V12h2.7l-.4 2.9h-2.3v7A10 10 0 0 0 22 12z"/></svg></a>
					<a class="na-ishare" href="https://twitter.com/intent/tweet?url=<?php echo $u; // phpcs:ignore ?>&text=<?php echo $t_enc; // phpcs:ignore ?>" target="_blank" rel="noopener noreferrer" aria-label="X"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M18.9 2H22l-7.6 8.7L23.3 22h-6.9l-5.4-7-6.2 7H1.6l8.1-9.3L1 2h7.1l4.9 6.5L18.9 2z"/></svg></a>
					<a class="na-ishare" href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo $u; // phpcs:ignore ?>" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M20.45 20.45h-3.56v-5.57c0-1.33-.02-3.04-1.85-3.04-1.85 0-2.13 1.45-2.13 2.94v5.67H9.35V9h3.41v1.56h.05c.48-.9 1.64-1.85 3.37-1.85 3.6 0 4.27 2.37 4.27 5.46v6.28zM5.34 7.43a2.07 2.07 0 1 1 0-4.14 2.07 2.07 0 0 1 0 4.14zM7.12 20.45H3.56V9h3.56v11.45z"/></svg></a>
					<button class="na-ishare" type="button" data-copy-link="<?php echo esc_url( $permalink ); ?>" aria-label="Copy link"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10 13a5 5 0 0 0 7 0l3-3a5 5 0 0 0-7-7l-1 1M14 11a5 5 0 0 0-7 0l-3 3a5 5 0 0 0 7 7l1-1"/></svg></button>
					<button class="na-ishare" type="button" onclick="window.print()" aria-label="Print"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9V2h12v7M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2M6 14h12v8H6z"/></svg></button>
				</span>
			</div>

			<!-- Featured image -->
			<figure class="na-figure">
				<img src="<?php echo esc_url( $cover ); ?>" alt="<?php the_title_attribute(); ?>" />
				<?php if ( $thumb_cap ) : ?>
					<figcaption class="na-figure-cap"><?php echo esc_html( $thumb_cap ); ?></figcaption>
				<?php endif; ?>
			</figure>

			<!-- Body -->
			<div class="na-content entry-content" data-reading-target>
				<?php the_content(); ?>
			</div>

			<!-- Also Read -->
			<?php
			if ( $term ) :
				$also = get_posts(
					array(
						'post_type'      => 'news',
						'posts_per_page' => 2,
						'post__not_in'   => array( get_the_ID() ),
						'tax_query'      => array(
							array( 'taxonomy' => 'news_category', 'field' => 'term_id', 'terms' => $term->term_id ),
						),
					)
				);
				if ( $also ) :
					?>
					<div class="na-also">
						<div class="na-also-title"><?php esc_html_e( 'Also Read', 'blogtechu-custom' ); ?></div>
						<?php foreach ( $also as $ap ) : ?>
							<a href="<?php echo esc_url( get_permalink( $ap ) ); ?>">› <?php echo esc_html( get_the_title( $ap ) ); ?></a>
						<?php endforeach; ?>
					</div>
					<?php
				endif;
			endif;
			?>

			<!-- Tags -->
			<?php if ( $tag_terms && ! is_wp_error( $tag_terms ) ) : ?>
				<div class="na-tags">
					<?php foreach ( $tag_terms as $tag ) : ?>
						<a class="tag-chip" href="<?php echo esc_url( get_term_link( $tag ) ); ?>"><?php echo esc_html( $tag->name ); ?></a>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>

			<!-- Share this article -->
			<div class="na-sharebar">
				<div class="na-sharebar-title"><?php esc_html_e( 'Share this article', 'blogtechu-custom' ); ?></div>
				<div class="na-sharebar-row">
					<a class="na-shareb na-fb" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $u; // phpcs:ignore ?>" target="_blank" rel="noopener noreferrer"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M22 12a10 10 0 1 0-11.6 9.9v-7H7.9V12h2.5V9.8c0-2.5 1.5-3.9 3.8-3.9 1.1 0 2.2.2 2.2.2v2.5h-1.2c-1.2 0-1.6.8-1.6 1.6V12h2.7l-.4 2.9h-2.3v7A10 10 0 0 0 22 12z"/></svg> Facebook</a>
					<a class="na-shareb na-tw" href="https://twitter.com/intent/tweet?url=<?php echo $u; // phpcs:ignore ?>&text=<?php echo $t_enc; // phpcs:ignore ?>" target="_blank" rel="noopener noreferrer"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M18.9 2H22l-7.6 8.7L23.3 22h-6.9l-5.4-7-6.2 7H1.6l8.1-9.3L1 2h7.1l4.9 6.5L18.9 2z"/></svg> Twitter</a>
					<a class="na-shareb na-li" href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo $u; // phpcs:ignore ?>" target="_blank" rel="noopener noreferrer"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M20.45 20.45h-3.56v-5.57c0-1.33-.02-3.04-1.85-3.04-1.85 0-2.13 1.45-2.13 2.94v5.67H9.35V9h3.41v1.56h.05c.48-.9 1.64-1.85 3.37-1.85 3.6 0 4.27 2.37 4.27 5.46v6.28zM5.34 7.43a2.07 2.07 0 1 1 0-4.14 2.07 2.07 0 0 1 0 4.14zM7.12 20.45H3.56V9h3.56v11.45z"/></svg> LinkedIn</a>
					<a class="na-shareb na-wa" href="https://wa.me/?text=<?php echo $t_enc; // phpcs:ignore ?>%20<?php echo $u; // phpcs:ignore ?>" target="_blank" rel="noopener noreferrer"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2a10 10 0 0 0-8.5 15.3L2 22l4.8-1.5A10 10 0 1 0 12 2zm5.3 14c-.2.6-1.2 1.2-1.7 1.2-.5.1-1 .2-3-.6-2.5-1-4.1-3.6-4.2-3.8-.1-.2-1-1.3-1-2.5s.6-1.8.9-2c.2-.3.5-.3.7-.3h.5c.2 0 .4 0 .6.5l.8 2c.1.2.1.4 0 .5l-.4.5c-.2.2-.3.4-.1.7.2.3.8 1.3 1.7 2.1 1.2 1 2.1 1.4 2.4 1.5.2 0 .4 0 .6-.2l.7-.9c.2-.2.4-.2.6-.1l1.9.9c.2.1.4.2.4.3.1.2.1.7-.1 1.2z"/></svg> WhatsApp</a>
					<button class="na-shareb na-copy" type="button" data-copy-link="<?php echo esc_url( $permalink ); ?>"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10 13a5 5 0 0 0 7 0l3-3a5 5 0 0 0-7-7l-1 1M14 11a5 5 0 0 0-7 0l-3 3a5 5 0 0 0 7 7l1-1"/></svg> Copy Link</button>
				</div>
			</div>

			<!-- Prev / Next -->
			<?php
			$prev = get_previous_post();
			$next = get_next_post();
			?>
			<?php if ( $prev || $next ) : ?>
				<div class="na-prevnext">
					<?php if ( $prev ) : ?>
						<a class="na-pn is-prev" href="<?php echo esc_url( get_permalink( $prev ) ); ?>">
							<span class="na-pn-thumb"><img src="<?php echo esc_url( blogtechu_news_cover_url( $prev->ID ) ); ?>" alt="" loading="lazy" /></span>
							<span class="min-w-0"><span class="na-pn-dir block">← <?php esc_html_e( 'Previous', 'blogtechu-custom' ); ?></span><span class="na-pn-title block"><?php echo esc_html( get_the_title( $prev ) ); ?></span></span>
						</a>
					<?php else : ?><span></span><?php endif; ?>
					<?php if ( $next ) : ?>
						<a class="na-pn is-next" href="<?php echo esc_url( get_permalink( $next ) ); ?>">
							<span class="na-pn-thumb"><img src="<?php echo esc_url( blogtechu_news_cover_url( $next->ID ) ); ?>" alt="" loading="lazy" /></span>
							<span class="min-w-0"><span class="na-pn-dir block"><?php esc_html_e( 'Next', 'blogtechu-custom' ); ?> →</span><span class="na-pn-title block"><?php echo esc_html( get_the_title( $next ) ); ?></span></span>
						</a>
					<?php endif; ?>
				</div>
			<?php endif; ?>

			<!-- Related stories -->
			<?php
			if ( $term ) :
				$related = new WP_Query(
					array(
						'post_type'      => 'news',
						'posts_per_page' => 8,
						'post__not_in'   => array( get_the_ID() ),
						'no_found_rows'  => true,
						'tax_query'      => array(
							array( 'taxonomy' => 'news_category', 'field' => 'term_id', 'terms' => $term->term_id ),
						),
					)
				);
				if ( $related->found_posts < 4 ) {
					$related = new WP_Query( array( 'post_type' => 'news', 'posts_per_page' => 8, 'post__not_in' => array( get_the_ID() ), 'no_found_rows' => true ) );
				}
				if ( $related->have_posts() ) :
					?>
					<section class="na-related">
						<h2 class="na-side-title"><?php esc_html_e( 'Related Stories', 'blogtechu-custom' ); ?></h2>
						<div class="na-related-scroll">
							<?php
							while ( $related->have_posts() ) :
								$related->the_post();
								blogtechu_render_news_card();
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

		<!-- Sidebar -->
		<aside class="na-aside">
			<div class="na-aside-inner">

				<!-- Trending Now -->
				<?php $trend = get_posts( array( 'post_type' => 'news', 'posts_per_page' => 5, 'post__not_in' => array( get_the_ID() ) ) ); ?>
				<?php if ( $trend ) : ?>
					<div class="sidebar-card">
						<h3 class="na-side-title"><?php esc_html_e( 'Trending Now', 'blogtechu-custom' ); ?></h3>
						<div class="nb-trend">
							<?php
							$rank = 0;
							foreach ( $trend as $tp ) :
								$rank++;
								?>
								<a class="nb-trend-item" href="<?php echo esc_url( get_permalink( $tp ) ); ?>">
									<span class="nb-trend-thumb">
										<img src="<?php echo esc_url( blogtechu_news_cover_url( $tp->ID ) ); ?>" alt="" loading="lazy" />
										<span class="nb-trend-num"><?php echo esc_html( $rank ); ?></span>
									</span>
									<span class="min-w-0">
										<span class="nb-trend-title block line-clamp-2"><?php echo esc_html( get_the_title( $tp ) ); ?></span>
										<span class="nb-trend-meta block"><?php echo esc_html( blogtechu_reading_time( $tp->ID ) ); ?></span>
									</span>
								</a>
							<?php endforeach; ?>
						</div>
						<a class="na-viewall" href="<?php echo esc_url( $news_url ); ?>"><?php esc_html_e( 'View All Trending', 'blogtechu-custom' ); ?> →</a>
					</div>
				<?php endif; ?>

				<!-- Latest News -->
				<?php $latest = get_posts( array( 'post_type' => 'news', 'posts_per_page' => 5, 'post__not_in' => array( get_the_ID() ), 'offset' => 1 ) ); ?>
				<?php if ( $latest ) : ?>
					<div class="sidebar-card">
						<h3 class="na-side-title"><?php esc_html_e( 'Latest News', 'blogtechu-custom' ); ?></h3>
						<div class="space-y-1">
							<?php foreach ( $latest as $lp ) : ?>
								<a class="mini-post" href="<?php echo esc_url( get_permalink( $lp ) ); ?>">
									<span class="mini-post-thumb"><img src="<?php echo esc_url( blogtechu_news_cover_url( $lp->ID ) ); ?>" alt="" loading="lazy" /></span>
									<span class="min-w-0">
										<span class="mini-post-title block line-clamp-2"><?php echo esc_html( get_the_title( $lp ) ); ?></span>
										<span class="mini-post-meta block"><?php echo esc_html( blogtechu_reading_time( $lp->ID ) ); ?></span>
									</span>
								</a>
							<?php endforeach; ?>
						</div>
						<a class="na-viewall" href="<?php echo esc_url( $news_url ); ?>"><?php esc_html_e( 'View All Latest News', 'blogtechu-custom' ); ?> →</a>
					</div>
				<?php endif; ?>

				<!-- Photos -->
				<?php $photos = get_posts( array( 'post_type' => 'news', 'posts_per_page' => 4, 'post__not_in' => array( get_the_ID() ), 'offset' => 2 ) ); ?>
				<?php if ( $photos ) : ?>
					<div class="sidebar-card">
						<h3 class="na-side-title"><?php esc_html_e( 'Photos', 'blogtechu-custom' ); ?></h3>
						<div class="na-photos">
							<?php foreach ( $photos as $ph ) : ?>
								<a class="na-photo" href="<?php echo esc_url( get_permalink( $ph ) ); ?>" aria-label="<?php echo esc_attr( get_the_title( $ph ) ); ?>"><img src="<?php echo esc_url( blogtechu_news_cover_url( $ph->ID ) ); ?>" alt="" loading="lazy" /></a>
							<?php endforeach; ?>
						</div>
					</div>
				<?php endif; ?>

				<!-- Follow Us -->
				<div class="sidebar-card">
					<h3 class="na-side-title"><?php esc_html_e( 'Follow Us', 'blogtechu-custom' ); ?></h3>
					<div class="na-follow">
						<a href="#" style="background:#1877f2;"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M22 12a10 10 0 1 0-11.6 9.9v-7H7.9V12h2.5V9.8c0-2.5 1.5-3.9 3.8-3.9 1.1 0 2.2.2 2.2.2v2.5h-1.2c-1.2 0-1.6.8-1.6 1.6V12h2.7l-.4 2.9h-2.3v7A10 10 0 0 0 22 12z"/></svg> Facebook</a>
						<a href="#" style="background:#1da1f2;"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M18.9 2H22l-7.6 8.7L23.3 22h-6.9l-5.4-7-6.2 7H1.6l8.1-9.3L1 2h7.1l4.9 6.5L18.9 2z"/></svg> Twitter</a>
						<a href="#" style="background:#e1306c;"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2.2c3.2 0 3.6 0 4.9.1 3.3.1 4.8 1.7 4.9 4.9.1 1.3.1 1.6.1 4.8s0 3.5-.1 4.8c-.1 3.2-1.6 4.8-4.9 4.9-1.3.1-1.6.1-4.9.1s-3.6 0-4.9-.1c-3.3-.1-4.8-1.7-4.9-4.9C2.1 15.5 2 15.2 2 12s0-3.5.1-4.8C2.2 4 3.7 2.4 7 2.3 8.4 2.2 8.8 2.2 12 2.2zm0 4.9a4.9 4.9 0 1 0 0 9.8 4.9 4.9 0 0 0 0-9.8zm0 8a3.1 3.1 0 1 1 0-6.2 3.1 3.1 0 0 1 0 6.2zm5.1-8.3a1.1 1.1 0 1 0 0 2.3 1.1 1.1 0 0 0 0-2.3z"/></svg> Instagram</a>
						<a href="#" style="background:#ff0000;"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M23 12s0-3.2-.4-4.7a2.5 2.5 0 0 0-1.8-1.8C19.3 5 12 5 12 5s-7.3 0-8.8.5A2.5 2.5 0 0 0 1.4 7.3 26 26 0 0 0 1 12c0 .1 0 3.2.4 4.7a2.5 2.5 0 0 0 1.8 1.8C4.7 19 12 19 12 19s7.3 0 8.8-.5a2.5 2.5 0 0 0 1.8-1.8C23 15.2 23 12 23 12zM10 15V9l5 3-5 3z"/></svg> YouTube</a>
					</div>
				</div>
			</div>
		</aside>
	</div>

<?php endwhile; ?>

<button type="button" class="back-to-top" data-back-to-top aria-label="<?php esc_attr_e( 'Back to top', 'blogtechu-custom' ); ?>">
	<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" width="20" height="20"><path d="M12 19V5M5 12l7-7 7 7"/></svg>
</button>

<?php
get_footer();
