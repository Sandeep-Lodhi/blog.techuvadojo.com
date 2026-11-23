<?php
/**
 * Template for the Gallery page (slug "gallery").
 *
 * Dark hero, category filter and a photo-backed masonry-style grid of moments.
 *
 * @package Blogtechu_Custom
 */

get_header();

$gl_icon = function ( $inner ) {
	return '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">' . $inner . '</svg>';
};

$gl_gallery_asset = function ( $filename ) {
	$path      = '/assets/images/gallery/' . $filename;
	$file_path = get_theme_file_path( $path );
	$file_url  = get_theme_file_uri( $path );

	if ( file_exists( $file_path ) ) {
		return add_query_arg( 'v', filemtime( $file_path ), $file_url );
	}

	return $file_url;
};

/* Filter categories. */
$gl_cats = array(
	'all'          => __( 'All', 'blogtechu-custom' ),
	'culture'      => __( 'Team & Culture', 'blogtechu-custom' ),
	'events'       => __( 'Events', 'blogtechu-custom' ),
	'workspaces'   => __( 'Workspaces', 'blogtechu-custom' ),
	'celebrations' => __( 'Celebrations', 'blogtechu-custom' ),
	'outreach'     => __( 'Outreach', 'blogtechu-custom' ),
	'awards'       => __( 'Awards', 'blogtechu-custom' ),
);
$gl_cat_labels = array(
	'culture'      => __( 'Team & Culture', 'blogtechu-custom' ),
	'events'       => __( 'Events', 'blogtechu-custom' ),
	'workspaces'   => __( 'Workspaces', 'blogtechu-custom' ),
	'celebrations' => __( 'Celebrations', 'blogtechu-custom' ),
	'outreach'     => __( 'Outreach', 'blogtechu-custom' ),
	'awards'       => __( 'Awards', 'blogtechu-custom' ),
);

/* Icons per category. */
$gl_cat_icon = array(
	'all'          => '<path d="M4 4h6v6H4zM14 4h6v6h-6zM4 14h6v6H4zM14 14h6v6h-6z"/>',
	'culture'      => '<circle cx="9" cy="8" r="3"/><path d="M2 20a7 7 0 0 1 14 0"/><circle cx="17" cy="9" r="2.5"/><path d="M22 19a5 5 0 0 0-7-4.6"/>',
	'events'       => '<rect x="3" y="5" width="18" height="16" rx="2"/><path d="M3 9h18M8 3v4M16 3v4"/>',
	'workspaces'   => '<rect x="3" y="4" width="18" height="12" rx="2"/><path d="M8 20h8M12 16v4"/>',
	'celebrations' => '<path d="M2 22l5-13 8 8z"/><path d="M14 8a3 3 0 0 0-3-3M17 5a3 3 0 0 0-3-3M19 11a3 3 0 0 0 3-3"/>',
	'outreach'     => '<path d="M3 11l14-7v16L3 13z"/><path d="M17 8a3 3 0 0 1 0 6"/>',
	'awards'       => '<circle cx="12" cy="8" r="5"/><path d="M8.5 12.5L7 22l5-3 5 3-1.5-9.5"/>',
);

/* Tiles. wide = half-width feature tile on large screens. */
$gl_tiles = array(
	array(
		'cat'     => 'culture',
		'label'   => __( 'Team Collaboration', 'blogtechu-custom' ),
		'caption' => __( 'A focused product team session at TechuvaDojo HQ.', 'blogtechu-custom' ),
		'image'   => 'team-collaboration.png',
	),
	array(
		'cat'     => 'workspaces',
		'label'   => __( 'Open Workspace', 'blogtechu-custom' ),
		'caption' => __( 'Daily build work across design, development and QA.', 'blogtechu-custom' ),
		'image'   => 'office-workspace.png',
	),
	array(
		'cat'     => 'culture',
		'label'   => __( 'Team Day', 'blogtechu-custom' ),
		'caption' => __( 'The crew together after a packed delivery sprint.', 'blogtechu-custom' ),
		'image'   => 'team-group-outdoor.png',
	),
	array(
		'cat'     => 'workspaces',
		'label'   => __( 'Strategy Room', 'blogtechu-custom' ),
		'caption' => __( 'Planning sessions that turn rough ideas into shipped products.', 'blogtechu-custom' ),
		'image'   => 'boardroom-session.png',
	),
	array(
		'cat'     => 'celebrations',
		'label'   => __( 'Milestone Celebration', 'blogtechu-custom' ),
		'caption' => __( 'A launch moment shared with the people behind the work.', 'blogtechu-custom' ),
		'image'   => 'milestone-celebration.png',
	),
	array(
		'cat'     => 'awards',
		'label'   => __( 'Great Place to Work', 'blogtechu-custom' ),
		'caption' => __( 'Recognition for a culture built around care and craft.', 'blogtechu-custom' ),
		'image'   => 'great-place-award.png',
	),
	array(
		'cat'     => 'events',
		'label'   => __( 'Tech Talk Stage', 'blogtechu-custom' ),
		'caption' => __( 'Sharing practical lessons from real product builds.', 'blogtechu-custom' ),
		'image'   => 'tech-talk-stage.png',
		'wide'    => true,
	),
	array(
		'cat'     => 'workspaces',
		'label'   => __( 'Lounge Collaboration', 'blogtechu-custom' ),
		'caption' => __( 'Casual reviews, sharper decisions and calmer handoffs.', 'blogtechu-custom' ),
		'image'   => 'lounge-collaboration.png',
		'wide'    => true,
	),
	array(
		'cat'     => 'outreach',
		'label'   => __( 'Community Cleanup', 'blogtechu-custom' ),
		'caption' => __( 'Team outreach beyond the office walls.', 'blogtechu-custom' ),
		'image'   => 'community-cleanup.png',
	),
	array(
		'cat'     => 'awards',
		'label'   => __( 'Tech Excellence Awards', 'blogtechu-custom' ),
		'caption' => __( 'Celebrating technical excellence and dependable delivery.', 'blogtechu-custom' ),
		'image'   => 'tech-excellence-awards.png',
	),
	array(
		'cat'     => 'celebrations',
		'label'   => __( 'Holiday Celebration', 'blogtechu-custom' ),
		'caption' => __( 'Seasonal moments with the full team gathered together.', 'blogtechu-custom' ),
		'image'   => 'holiday-celebration.png',
	),
);

$gl_hero_image = $gl_gallery_asset( 'gallery-hero.png' );
?>

<!-- Hero -->
<section class="gl-hero">
	<div class="gl-hero-inner">
		<div class="gl-hero-content">
			<nav class="gl-crumb" aria-label="<?php esc_attr_e( 'Breadcrumb', 'blogtechu-custom' ); ?>">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'blogtechu-custom' ); ?></a>
				<span aria-hidden="true">•</span>
				<span class="gl-crumb-current"><?php esc_html_e( 'Gallery', 'blogtechu-custom' ); ?></span>
			</nav>
			<h1 class="gl-hero-title"><?php esc_html_e( 'Our Gallery', 'blogtechu-custom' ); ?></h1>
			<p class="gl-hero-text"><?php esc_html_e( 'Moments that inspire, teams that create, and milestones that drive us forward.', 'blogtechu-custom' ); ?></p>
		</div>
		<div class="gl-hero-visual">
			<div class="gl-hero-frame">
				<img src="<?php echo esc_url( $gl_hero_image ); ?>" alt="<?php esc_attr_e( 'TechuvaDojo team collaborating in front of a modern office building', 'blogtechu-custom' ); ?>" loading="eager" decoding="async" fetchpriority="high" />
			</div>
			<span class="gl-hero-badge" aria-hidden="true">TD</span>
		</div>
	</div>
</section>

<!-- Gallery -->
<section class="gl-section">
	<div class="gl-inner">
		<div class="gl-filter">
			<?php foreach ( $gl_cats as $key => $label ) : ?>
				<button type="button" class="gl-filter-btn<?php echo 'all' === $key ? ' is-active' : ''; ?>" data-gl-filter="<?php echo esc_attr( $key ); ?>">
					<?php if ( isset( $gl_cat_icon[ $key ] ) ) { echo '<span class="gl-filter-ico">' . $gl_icon( $gl_cat_icon[ $key ] ) . '</span>'; /* phpcs:ignore */ } ?>
					<?php echo esc_html( $label ); ?>
				</button>
			<?php endforeach; ?>
		</div>

		<div class="gl-grid" data-gl-list>
			<?php
			foreach ( $gl_tiles as $index => $t ) :
				$cat   = $t['cat'];
				$wide  = ! empty( $t['wide'] );
				$image = $gl_gallery_asset( $t['image'] );
				?>
				<button type="button" class="gl-tile is-photo<?php echo $wide ? ' is-wide' : ''; ?>" data-gl-cat="<?php echo esc_attr( $cat ); ?>" data-gl-full="<?php echo esc_url( $image ); ?>" data-gl-title="<?php echo esc_attr( $t['label'] ); ?>" data-gl-category="<?php echo esc_attr( $gl_cat_labels[ $cat ] ); ?>" data-gl-caption="<?php echo esc_attr( $t['caption'] ); ?>" aria-label="<?php echo esc_attr( sprintf( __( 'View %s', 'blogtechu-custom' ), $t['label'] ) ); ?>">
					<img src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr( $t['label'] ); ?>" loading="<?php echo $index < 3 ? 'eager' : 'lazy'; ?>" decoding="async" />
					<div class="gl-tile-overlay">
						<span class="gl-tile-cat"><?php echo esc_html( $gl_cat_labels[ $cat ] ); ?></span>
						<span class="gl-tile-label"><?php echo esc_html( $t['label'] ); ?></span>
						<span class="gl-tile-caption"><?php echo esc_html( $t['caption'] ); ?></span>
					</div>
				</button>
			<?php endforeach; ?>
		</div>
		<p class="gl-empty" data-gl-empty style="display:none;"><?php esc_html_e( 'No photos in this category yet.', 'blogtechu-custom' ); ?></p>

		<div class="gl-lightbox" data-gl-lightbox aria-hidden="true">
			<div class="gl-lightbox-panel" role="dialog" aria-modal="true" aria-labelledby="gl-lightbox-title">
				<button type="button" class="gl-lightbox-close" data-gl-lightbox-close aria-label="<?php esc_attr_e( 'Close gallery image', 'blogtechu-custom' ); ?>">
					<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M18 6 6 18M6 6l12 12"/></svg>
				</button>
				<img class="gl-lightbox-img" data-gl-lightbox-img src="" alt="" decoding="async" />
				<div class="gl-lightbox-meta">
					<div>
						<p class="gl-lightbox-kicker" data-gl-lightbox-category></p>
						<h2 class="gl-lightbox-title" id="gl-lightbox-title" data-gl-lightbox-title></h2>
						<p class="gl-lightbox-caption" data-gl-lightbox-caption></p>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- Want to see more -->
<section class="gl-cta-wrap">
	<div class="gl-cta">
		<span class="gl-cta-ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="3"/><circle cx="9" cy="9" r="2"/><path d="M21 15l-5-5L5 21"/></svg></span>
		<div class="gl-cta-text">
			<h2 class="gl-cta-title"><?php esc_html_e( 'Want to see more?', 'blogtechu-custom' ); ?></h2>
			<p class="gl-cta-sub"><?php esc_html_e( 'Follow us on our social media channels for more updates, behind-the-scenes moments and stories.', 'blogtechu-custom' ); ?></p>
		</div>
		<a class="gl-cta-btn" href="https://www.linkedin.com/in/sandeep-lodhi-30293620b" target="_blank" rel="noopener"><?php esc_html_e( 'Follow Us on Social Media', 'blogtechu-custom' ); ?> <span aria-hidden="true">→</span></a>
	</div>
</section>

<?php
get_footer();
