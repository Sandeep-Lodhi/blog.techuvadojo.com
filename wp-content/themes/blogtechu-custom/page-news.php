<?php
/**
 * News landing — "NewsBeat" magazine layout (auto-loaded for slug "news").
 *
 * Brand hero, category bar, breaking ticker, Editor's Picks / Main News /
 * Trending Now, Featured Posts and Latest Articles + Newsletter.
 * Helpers (cover, category icon/color, card renderer) live in inc/news-ajax.php.
 *
 * @package Blogtechu_Custom
 */

get_header();

/* Small helper: a colored category badge for a news post. */
if ( ! function_exists( 'blogtechu_nb_badge' ) ) {
	function blogtechu_nb_badge( $post_id ) {
		$terms = get_the_terms( $post_id, 'news_category' );
		if ( ! $terms || is_wp_error( $terms ) ) {
			return '';
		}
		$t     = $terms[0];
		$color = blogtechu_news_cat_icon( $t->slug )['color'];
		return '<span class="nb-badge" style="background-color:' . esc_attr( $color ) . ';">' . esc_html( $t->name ) . '</span>';
	}
}

$news_url = get_permalink();

/* Pull a working set of recent articles. */
$recent = get_posts(
	array(
		'post_type'      => 'news',
		'posts_per_page' => 20,
		'post_status'    => 'publish',
	)
);

$cats = get_terms(
	array(
		'taxonomy'   => 'news_category',
		'hide_empty' => true,
		'number'     => 9,
		'orderby'    => 'count',
		'order'      => 'DESC',
	)
);
?>

<!-- Brand hero -->
<section class="nb-hero">
	<div class="nb-hero-inner">
		<div class="nb-hero-top">
			<span class="nb-hero-date">
				<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="5" width="18" height="16" rx="2"/><path d="M3 9h18M8 3v4M16 3v4"/></svg>
				<?php echo esc_html( date_i18n( 'l, j F Y' ) ); ?>
			</span>
			<span class="nb-hero-live"><?php esc_html_e( 'Live Updates', 'blogtechu-custom' ); ?></span>
		</div>
		<div class="nb-hero-main">
			<h1 class="nb-hero-title">NEWS<span>BEAT</span></h1>
			<p class="nb-hero-tag"><?php esc_html_e( 'Stay updated with the latest tech news, insights and trends from around the world.', 'blogtechu-custom' ); ?></p>
		</div>
		<?php if ( ! empty( $cats ) && ! is_wp_error( $cats ) ) : ?>
			<div class="nb-hero-trending">
				<span class="nb-hero-trending-label">🔥 <?php esc_html_e( 'Trending', 'blogtechu-custom' ); ?></span>
				<?php foreach ( array_slice( $cats, 0, 5 ) as $hc ) : ?>
					<a class="nb-hero-tchip" href="<?php echo esc_url( get_term_link( $hc ) ); ?>"><?php echo esc_html( $hc->name ); ?></a>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</div>
</section>

<!-- Category bar -->
<?php if ( ! empty( $cats ) && ! is_wp_error( $cats ) ) : ?>
	<div class="nb-catbar">
		<div class="nb-catbar-inner">
			<a class="nb-cat-home" href="<?php echo esc_url( $news_url ); ?>" aria-label="<?php esc_attr_e( 'News home', 'blogtechu-custom' ); ?>">
				<svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 11l9-8 9 8M5 10v10h14V10"/></svg>
			</a>
			<div class="nb-cat-scroll">
				<?php foreach ( $cats as $cat ) : ?>
					<a class="nb-cat" href="<?php echo esc_url( get_term_link( $cat ) ); ?>"><?php echo esc_html( $cat->name ); ?></a>
				<?php endforeach; ?>
			</div>
			<div class="nb-cat-actions">
				<a class="nb-cat-watch" href="#">
					<svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor"><path d="M8 5v14l11-7z"/></svg>
					<?php esc_html_e( 'Watch Live', 'blogtechu-custom' ); ?>
				</a>
				<button type="button" class="nb-cat-search" data-search-open aria-label="<?php esc_attr_e( 'Search', 'blogtechu-custom' ); ?>">
					<svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="7"/><path d="m21 21-4.3-4.3"/></svg>
				</button>
			</div>
		</div>
	</div>
<?php endif; ?>

<!-- Breaking ticker (auto-scrolling) -->
<?php if ( ! empty( $recent ) ) : ?>
	<div class="nw-ticker">
		<span class="nw-ticker-label">⚡ <?php esc_html_e( 'Breaking', 'blogtechu-custom' ); ?></span>
		<div class="nw-ticker-viewport">
			<div class="nw-ticker-track">
				<?php
				$ticker_items = array_slice( $recent, 0, 6 );
				// Output twice for a seamless marquee loop.
				for ( $d = 0; $d < 2; $d++ ) :
					foreach ( $ticker_items as $rp ) :
						?>
						<a href="<?php echo esc_url( get_permalink( $rp ) ); ?>"<?php echo 1 === $d ? ' aria-hidden="true"' : ''; ?>><?php echo esc_html( get_the_title( $rp ) ); ?></a>
						<span class="nw-ticker-dot" aria-hidden="true">●</span>
						<?php
					endforeach;
				endfor;
				?>
			</div>
		</div>
	</div>
<?php endif; ?>

<?php if ( ! empty( $recent ) ) : ?>
<!-- Top: Editor's Picks | Main News | Trending Now -->
<div class="nb-top">

	<!-- Editor's Picks -->
	<div>
		<h2 class="nb-coltitle"><?php esc_html_e( "Editor's Picks", 'blogtechu-custom' ); ?></h2>
		<?php $picks = array_slice( $recent, 1, 4 ); ?>
		<?php if ( ! empty( $picks ) ) : $p0 = $picks[0]; ?>
			<a class="nb-pick" href="<?php echo esc_url( get_permalink( $p0 ) ); ?>">
				<span class="nb-pick-media">
					<img src="<?php echo esc_url( blogtechu_news_cover_url( $p0->ID ) ); ?>" alt="<?php echo esc_attr( get_the_title( $p0 ) ); ?>" loading="lazy" />
					<?php
					$pt = get_the_terms( $p0->ID, 'news_category' );
					if ( $pt && ! is_wp_error( $pt ) ) :
						?>
						<span class="nb-pick-cat" style="background-color:<?php echo esc_attr( blogtechu_news_cat_icon( $pt[0]->slug )['color'] ); ?>;"><?php echo esc_html( $pt[0]->name ); ?></span>
					<?php endif; ?>
				</span>
				<span class="nb-pick-body">
					<span class="nb-pick-title block"><?php echo esc_html( get_the_title( $p0 ) ); ?></span>
					<span class="nb-pick-excerpt block"><?php echo esc_html( wp_trim_words( get_the_excerpt( $p0 ), 18 ) ); ?></span>
					<span class="nb-pick-meta block"><?php echo esc_html( get_the_date( '', $p0 ) ); ?> · <?php echo esc_html( blogtechu_reading_time( $p0->ID ) ); ?></span>
				</span>
			</a>
			<div class="nb-list">
				<?php foreach ( array_slice( $picks, 1, 3 ) as $pp ) : ?>
					<a class="mini-post" href="<?php echo esc_url( get_permalink( $pp ) ); ?>">
						<span class="mini-post-thumb"><img src="<?php echo esc_url( blogtechu_news_cover_url( $pp->ID ) ); ?>" alt="<?php echo esc_attr( get_the_title( $pp ) ); ?>" loading="lazy" /></span>
						<span class="min-w-0">
							<span class="mini-post-title block line-clamp-2"><?php echo esc_html( get_the_title( $pp ) ); ?></span>
							<span class="mini-post-meta block"><?php echo esc_html( blogtechu_reading_time( $pp->ID ) ); ?></span>
						</span>
					</a>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</div>

	<!-- Main News -->
	<div>
		<h2 class="nb-coltitle"><?php esc_html_e( 'Main News', 'blogtechu-custom' ); ?></h2>
		<?php $main = $recent[0]; ?>
		<a class="nb-main" href="<?php echo esc_url( get_permalink( $main ) ); ?>">
			<img class="nb-main-img" src="<?php echo esc_url( blogtechu_news_cover_url( $main->ID ) ); ?>" alt="<?php echo esc_attr( get_the_title( $main ) ); ?>" />
			<span class="nb-main-veil"></span>
			<span class="nb-main-body">
				<span class="nb-badges"><?php echo blogtechu_nb_badge( $main->ID ); // phpcs:ignore ?></span>
				<span class="nb-main-title block"><?php echo esc_html( get_the_title( $main ) ); ?></span>
					<span class="nb-main-excerpt block"><?php echo esc_html( wp_trim_words( get_the_excerpt( $main ), 24 ) ); ?></span>
				<span class="nb-main-meta">
					<span><?php echo esc_html( get_the_author_meta( 'display_name', get_post_field( 'post_author', $main->ID ) ) ); ?></span>
					<span class="meta-dot"><?php echo esc_html( get_the_date( '', $main ) ); ?></span>
					<span class="meta-dot"><?php echo esc_html( blogtechu_reading_time( $main->ID ) ); ?></span>
				</span>
			</span>
		</a>
	</div>

	<!-- Trending Now -->
	<div>
		<h2 class="nb-coltitle"><?php esc_html_e( 'Trending Now', 'blogtechu-custom' ); ?></h2>
		<div class="nb-trend">
			<?php
			$rank = 0;
			foreach ( array_slice( $recent, 5, 5 ) as $tp ) :
				$rank++;
				?>
				<a class="nb-trend-item" href="<?php echo esc_url( get_permalink( $tp ) ); ?>">
					<span class="nb-trend-thumb">
						<img src="<?php echo esc_url( blogtechu_news_cover_url( $tp->ID ) ); ?>" alt="<?php echo esc_attr( get_the_title( $tp ) ); ?>" loading="lazy" />
						<span class="nb-trend-num"><?php echo esc_html( $rank ); ?></span>
					</span>
					<span class="min-w-0">
						<span class="nb-trend-title block line-clamp-2"><?php echo esc_html( get_the_title( $tp ) ); ?></span>
						<span class="nb-trend-meta block"><?php echo esc_html( blogtechu_reading_time( $tp->ID ) ); ?></span>
					</span>
				</a>
			<?php endforeach; ?>
		</div>
	</div>
</div>

<!-- Featured Posts -->
<section class="nb-section mt-16">
	<h2 class="nb-coltitle"><?php esc_html_e( 'Featured Posts', 'blogtechu-custom' ); ?></h2>
	<div class="nb-catgrid mt-6">
		<?php
		$feat = new WP_Query(
			array(
				'post_type'      => 'news',
				'posts_per_page' => 4,
				'no_found_rows'  => true,
			)
		);
		while ( $feat->have_posts() ) :
			$feat->the_post();
			blogtechu_render_news_card();
		endwhile;
		wp_reset_postdata();
		?>
	</div>
</section>

<!-- Latest Articles + Newsletter -->
<div class="nb-bottom mt-16">
	<!-- Big latest -->
	<div>
		<h2 class="nb-coltitle"><?php esc_html_e( 'Latest Articles', 'blogtechu-custom' ); ?></h2>
		<?php $big = $recent[0]; ?>
		<a class="nb-latest-card" href="<?php echo esc_url( get_permalink( $big ) ); ?>">
			<span class="nb-latest-media">
				<img src="<?php echo esc_url( blogtechu_news_cover_url( $big->ID ) ); ?>" alt="<?php echo esc_attr( get_the_title( $big ) ); ?>" />
				<?php
				$bt = get_the_terms( $big->ID, 'news_category' );
				if ( $bt && ! is_wp_error( $bt ) ) :
					?>
					<span class="nb-latest-cat" style="background-color:<?php echo esc_attr( blogtechu_news_cat_icon( $bt[0]->slug )['color'] ); ?>;"><?php echo esc_html( $bt[0]->name ); ?></span>
				<?php endif; ?>
			</span>
			<span class="nb-latest-body">
				<span class="nb-latest-title block"><?php echo esc_html( get_the_title( $big ) ); ?></span>
				<span class="nb-latest-excerpt block"><?php echo esc_html( wp_trim_words( get_the_excerpt( $big ), 26 ) ); ?></span>
				<span class="nb-latest-meta block"><?php echo esc_html( get_the_date( '', $big ) ); ?> · <?php echo esc_html( blogtechu_reading_time( $big->ID ) ); ?></span>
			</span>
		</a>
	</div>

	<!-- Latest list -->
	<div class="lg:mt-12">
		<div class="nb-list">
			<?php foreach ( array_slice( $recent, 1, 5 ) as $lp ) : ?>
				<a class="mini-post" href="<?php echo esc_url( get_permalink( $lp ) ); ?>">
					<span class="mini-post-thumb"><img src="<?php echo esc_url( blogtechu_news_cover_url( $lp->ID ) ); ?>" alt="<?php echo esc_attr( get_the_title( $lp ) ); ?>" loading="lazy" /></span>
					<span class="min-w-0">
						<span class="mini-post-title block line-clamp-2"><?php echo esc_html( get_the_title( $lp ) ); ?></span>
						<span class="mini-post-meta block"><?php echo esc_html( get_the_date( '', $lp ) ); ?> · <?php echo esc_html( blogtechu_reading_time( $lp->ID ) ); ?></span>
					</span>
				</a>
			<?php endforeach; ?>
		</div>
	</div>

	<!-- Newsletter -->
	<div class="lg:mt-12">
		<div class="sidebar-cta">
			<h3><?php esc_html_e( 'Stay Updated', 'blogtechu-custom' ); ?></h3>
			<p><?php esc_html_e( 'Subscribe to our newsletter and get the latest news and insights delivered to your inbox.', 'blogtechu-custom' ); ?></p>
			<form onsubmit="return false;">
				<input type="email" placeholder="<?php esc_attr_e( 'Enter your email', 'blogtechu-custom' ); ?>" aria-label="<?php esc_attr_e( 'Email address', 'blogtechu-custom' ); ?>" />
				<button type="submit"><?php esc_html_e( 'Subscribe Now', 'blogtechu-custom' ); ?></button>
			</form>
		</div>
	</div>
</div>
<!-- Category-wise sections (dynamic: top categories by article count) -->
<?php
$section_cats = get_terms(
	array(
		'taxonomy'   => 'news_category',
		'hide_empty' => true,
		'orderby'    => 'count',
		'order'      => 'DESC',
		'number'     => 8,
	)
);
if ( $section_cats && ! is_wp_error( $section_cats ) ) :
	foreach ( $section_cats as $cterm ) :
		if ( (int) $cterm->count < 3 ) {
			continue; // Only feature categories with enough stories for a full row.
		}
		$cat_q = new WP_Query(
			array(
				'post_type'      => 'news',
				'post_status'    => 'publish',
				'posts_per_page' => 4,
				'no_found_rows'  => true,
				'tax_query'      => array(
					array( 'taxonomy' => 'news_category', 'field' => 'term_id', 'terms' => $cterm->term_id ),
				),
			)
		);
		if ( ! $cat_q->have_posts() ) {
			continue;
		}
		$c_color = blogtechu_news_cat_icon( $cterm->slug )['color'];
		?>
		<section class="nb-catblock mt-14">
			<div class="nb-catblock-head">
				<h2 class="nb-catblock-title"><span class="nb-catblock-bar" style="background-color:<?php echo esc_attr( $c_color ); ?>;"></span><?php echo esc_html( $cterm->name ); ?></h2>
				<a class="link-button" href="<?php echo esc_url( get_term_link( $cterm ) ); ?>"><?php esc_html_e( 'View All', 'blogtechu-custom' ); ?> →</a>
			</div>
			<div class="nb-catgrid">
				<?php
				while ( $cat_q->have_posts() ) :
					$cat_q->the_post();
					blogtechu_render_news_card();
				endwhile;
				wp_reset_postdata();
				?>
			</div>
		</section>
		<?php
	endforeach;
endif;
?>

<!-- More Stories — infinite scroll feed -->
<section class="nb-section mt-16">
	<h2 class="nb-coltitle"><?php esc_html_e( 'More Stories', 'blogtechu-custom' ); ?></h2>
	<?php
	$feed_q = new WP_Query(
		array(
			'post_type'      => 'news',
			'post_status'    => 'publish',
			'posts_per_page' => 9,
			'paged'          => 1,
		)
	);
	?>
	<?php if ( $feed_q->have_posts() ) : ?>
		<div class="nb-catgrid mt-6" data-newsfeed>
			<?php
			while ( $feed_q->have_posts() ) :
				$feed_q->the_post();
				blogtechu_render_news_card();
			endwhile;
			wp_reset_postdata();
			?>
		</div>
		<div class="news-feed-loading" data-newsfeed-loading><span class="news-feed-spinner"></span></div>
		<div class="news-sentinel" data-newsfeed-sentinel></div>
		<p class="news-feed-end" data-newsfeed-end hidden><?php esc_html_e( "You're all caught up", 'blogtechu-custom' ); ?></p>
		<script>
			window.BlogtechuNewsFeed = {
				ajaxUrl: <?php echo wp_json_encode( admin_url( 'admin-ajax.php' ) ); ?>,
				nonce: <?php echo wp_json_encode( wp_create_nonce( 'blogtechu_news' ) ); ?>,
				totalPages: <?php echo (int) $feed_q->max_num_pages; ?>
			};
		</script>
	<?php endif; ?>
</section>

<?php else : ?>
	<div class="blog-empty"><?php esc_html_e( 'No news yet. Publish your first article from the News menu.', 'blogtechu-custom' ); ?></div>
<?php endif; ?>

<div class="pb-20"></div>

<?php
get_footer();
