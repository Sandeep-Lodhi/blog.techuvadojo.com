<?php
/**
 * Template for the Projects page (slug "projects").
 *
 * Light hero with a device mockup, an impact stats strip, a category filter and
 * a grid of project cards (screenshot, category, description, tech, links), plus
 * a dark CTA. Content sourced from the founder's real portfolio.
 *
 * @package Blogtechu_Custom
 */

get_header();

$contact_url = home_url( '/contact' );
$img_base    = get_theme_file_uri( '/assets/images/projects/' );

/* Real projects. cat: enterprise | ecommerce | webapp. */
$pj_projects = array(
	array( 'title' => 'Go ASK Me', 'img' => 'goask.png', 'cat' => 'webapp', 'badge' => 'AI Platform', 'desc' => 'AI-powered services marketplace where an AI agent handles matching, negotiating and closing deals.', 'tech' => array( 'Next.js', 'Node.js', 'AI / LLM', 'PostgreSQL' ), 'live' => 'https://goask.me/', 'code' => '' ),
	array( 'title' => 'TorahAnytime', 'img' => 'torahanytime.png', 'cat' => 'enterprise', 'badge' => 'Enterprise', 'desc' => 'Large-scale religious media & donations platform — led workflow, releases and DevOps.', 'tech' => array( 'Node.js', 'MySQL', 'AWS', 'Kubernetes' ), 'live' => 'https://torahanytime.com/', 'code' => '' ),
	array( 'title' => 'Nosotrus LMS', 'img' => 'nosotrus.png', 'cat' => 'enterprise', 'badge' => 'Enterprise', 'desc' => 'Learning Management System for Spanish education with role-based dashboards.', 'tech' => array( 'Node.js', 'Serverless', 'PostgreSQL', 'CI/CD' ), 'live' => 'https://develop.nosotrosonline.com/', 'code' => '' ),
	array( 'title' => 'FamilyOne', 'img' => 'familyone.png', 'cat' => 'enterprise', 'badge' => 'Enterprise', 'desc' => 'Family discount & networking platform linking users with local business partners.', 'tech' => array( 'Node.js', 'TypeScript', 'AWS', 'Redis' ), 'live' => 'https://family.one/', 'code' => '' ),
	array( 'title' => 'BikeShopShippers', 'img' => 'bikeshopshippers.png', 'cat' => 'enterprise', 'badge' => 'Logistics', 'desc' => 'Logistics & bulk-shipping dashboard with order, delivery and tracking APIs.', 'tech' => array( 'Next.js', 'Medusa.js', 'Stripe', 'UPS API' ), 'live' => 'https://bikeshopshippers.com/us', 'code' => '' ),
	array( 'title' => 'Airiasearch', 'img' => 'airiasearch.png', 'cat' => 'webapp', 'badge' => 'AI Web App', 'desc' => 'AI-powered search interface with real-time suggestions and smart filtering.', 'tech' => array( 'React.js', 'Node.js', 'Tailwind CSS', 'REST API' ), 'live' => 'https://airiasearch.vercel.app/', 'code' => 'https://github.com/Sandeep-Lodhi/airiasearch' ),
	array( 'title' => 'Real Estate Platform', 'img' => 'real-estate.png', 'cat' => 'webapp', 'badge' => 'Web App', 'desc' => 'Full-featured MERN real-estate marketplace for owners, buyers and agents.', 'tech' => array( 'React.js', 'Node.js', 'MongoDB', 'Firebase' ), 'live' => 'https://real-estate-d1ad.onrender.com/', 'code' => 'https://github.com/Sandeep-Lodhi/mern-estate' ),
	array( 'title' => 'Amazon Clone', 'img' => 'amazon-clone.png', 'cat' => 'ecommerce', 'badge' => 'E-Commerce', 'desc' => 'Amazon-style storefront with cart, auth and Stripe + Firebase payments.', 'tech' => array( 'React.js', 'Firebase', 'Stripe' ), 'live' => 'https://amazone-clone-six-omega.vercel.app/', 'code' => 'https://github.com/Sandeep-Lodhi/Amazone-Clone' ),
	array( 'title' => 'E-commerce Platform', 'img' => 'ecommerce.png', 'cat' => 'ecommerce', 'badge' => 'E-Commerce', 'desc' => 'Complete MERN e-commerce site with secure auth and payment processing.', 'tech' => array( 'MongoDB', 'Express.js', 'React.js', 'Redux' ), 'live' => '', 'code' => '' ),
	array( 'title' => 'Netflix Clone', 'img' => 'netflix-clone.png', 'cat' => 'webapp', 'badge' => 'Web App', 'desc' => 'Netflix-style streaming app with auth and TMDB-powered carousels.', 'tech' => array( 'React.js', 'Firebase', 'TMDB API' ), 'live' => 'https://netflix-clone-git-main-sandeep-lodhis-projects.vercel.app/', 'code' => 'https://github.com/Sandeep-Lodhi/netflix-clone' ),
	array( 'title' => 'Zegocloud Meet', 'img' => 'zegocloud.png', 'cat' => 'webapp', 'badge' => 'Web App', 'desc' => 'Real-time meeting app with video conferencing, auth and messaging.', 'tech' => array( 'React.js', 'Node.js', 'TypeScript', 'ZegoCloud' ), 'live' => 'https://zegocloud-app.vercel.app/', 'code' => 'https://github.com/Sandeep-Lodhi/zegocloud-app' ),
	array( 'title' => 'SmartBiz', 'img' => 'smartbiz.png', 'cat' => 'enterprise', 'badge' => 'SaaS', 'desc' => 'Event-management & onboarding platform with a dynamic, sector-specific form system.', 'tech' => array( 'React.js', 'Node.js', 'AWS Lambda', 'PostgreSQL' ), 'live' => '', 'code' => '' ),
	array( 'title' => 'Todo App', 'img' => 'todo-app.png', 'cat' => 'webapp', 'badge' => 'Web App', 'desc' => 'Minimal yet powerful Todo app with full CRUD and persistent storage.', 'tech' => array( 'React.js', 'Node.js', 'MongoDB' ), 'live' => 'https://dodo-app-client.vercel.app/', 'code' => 'https://github.com/Sandeep-Lodhi/dodo-app' ),
);

$pj_cats = array(
	'all'        => __( 'All Projects', 'blogtechu-custom' ),
	'enterprise' => __( 'Enterprise', 'blogtechu-custom' ),
	'webapp'     => __( 'Web Apps', 'blogtechu-custom' ),
	'ecommerce'  => __( 'E-Commerce', 'blogtechu-custom' ),
);

/* Stat icons. */
$pj_stat_icon = function ( $n ) {
	$i = array(
		'work'  => '<rect x="3" y="7" width="18" height="13" rx="2"/><path d="M8 7V5a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2M3 13h18"/>',
		'globe' => '<circle cx="12" cy="12" r="9"/><path d="M3 12h18M12 3a15 15 0 0 1 0 18M12 3a15 15 0 0 0 0 18"/>',
		'code'  => '<path d="M8 9l-4 3 4 3M16 9l4 3-4 3M13 6l-2 12"/>',
		'layers'=> '<path d="M12 2l9 5-9 5-9-5 9-5z"/><path d="M3 12l9 5 9-5M3 17l9 5 9-5"/>',
		'smile' => '<circle cx="12" cy="12" r="9"/><path d="M9 10h.01M15 10h.01M8.5 14a4 4 0 0 0 7 0"/>',
		'rocket'=> '<path d="M12 3c3 1.6 5 5 5 9l-2.5 2.5h-5L7 12c0-4 2-7.4 5-9z"/><circle cx="12" cy="9" r="1.6"/><path d="M9.5 14.5l-2.5 4 4-1.5M14.5 14.5l2.5 4-4-1.5"/>',
	);
	return '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">' . ( isset( $i[ $n ] ) ? $i[ $n ] : $i['work'] ) . '</svg>';
};

$arrow = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6"/></svg>';
$eye   = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7-10-7-10-7z"/><circle cx="12" cy="12" r="3"/></svg>';
$code  = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M8 9l-4 3 4 3M16 9l4 3-4 3M13 6l-2 12"/></svg>';
?>

<!-- Hero -->
<section class="pj-hero">
	<div class="pj-hero-inner">
		<div class="pj-hero-content">
			<span class="pj-hero-eyebrow"><span class="cr-dot"></span><?php esc_html_e( 'Our Projects', 'blogtechu-custom' ); ?></span>
			<h1 class="pj-hero-title"><?php echo wp_kses( __( 'Ideas We Build, Solutions We <em>Deliver</em>', 'blogtechu-custom' ), array( 'em' => array() ) ); ?></h1>
			<p class="pj-hero-text"><?php esc_html_e( 'Explore our successful projects across different industries. We turn ideas into powerful digital experiences.', 'blogtechu-custom' ); ?></p>
			<div class="pj-hero-actions">
				<a class="au-btn" href="#projects-grid"><?php esc_html_e( 'View All Projects', 'blogtechu-custom' ); ?> <span aria-hidden="true">→</span></a>
				<a class="au-btn is-ghost" href="<?php echo esc_url( $contact_url ); ?>"><?php esc_html_e( 'Start Your Project', 'blogtechu-custom' ); ?></a>
			</div>
		</div>

		<div class="pj-hero-visual" aria-hidden="true">
			<span class="pj-decor-plane"><svg viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M44 4 20 26"/><path d="M44 4 30 44l-10-18L2 16z"/></svg></span>
			<span class="pj-decor-dots"><svg viewBox="0 0 80 80" fill="currentColor"><g><circle cx="6" cy="6" r="3"/><circle cx="26" cy="6" r="3"/><circle cx="46" cy="6" r="3"/><circle cx="6" cy="26" r="3"/><circle cx="26" cy="26" r="3"/><circle cx="46" cy="26" r="3"/><circle cx="6" cy="46" r="3"/><circle cx="26" cy="46" r="3"/><circle cx="46" cy="46" r="3"/></g></svg></span>

			<div class="pj-mockup">
				<div class="pj-laptop">
					<div class="pj-laptop-screen"><img src="<?php echo esc_url( $img_base . 'real-estate.png' ); ?>" alt="" loading="eager" decoding="async" /></div>
					<div class="pj-laptop-deck"><span></span></div>
				</div>
				<div class="pj-phone">
					<svg viewBox="0 0 120 250" xmlns="http://www.w3.org/2000/svg">
						<rect width="120" height="250" fill="#0f172a"/>
						<rect x="12" y="16" width="50" height="6" rx="3" fill="#334155"/>
						<rect x="12" y="30" width="34" height="5" rx="2.5" fill="#1e293b"/>
						<rect x="12" y="48" width="96" height="54" rx="8" fill="#1e293b"/>
						<text x="22" y="78" font-family="Inter, Arial" font-size="20" font-weight="800" fill="#fff">70%</text>
						<path d="M64 86 q10 -16 20 -6 q8 8 20 -10" stroke="#60a5fa" stroke-width="2.5" fill="none"/>
						<g>
							<rect x="14" y="150" width="14" height="34" rx="2" fill="#3b82f6"/>
							<rect x="34" y="134" width="14" height="50" rx="2" fill="#60a5fa"/>
							<rect x="54" y="120" width="14" height="64" rx="2" fill="#93c5fd"/>
							<rect x="74" y="142" width="14" height="42" rx="2" fill="#38bdf8"/>
							<rect x="94" y="128" width="14" height="56" rx="2" fill="#2563eb"/>
						</g>
						<rect x="12" y="200" width="96" height="8" rx="4" fill="#1e293b"/>
						<rect x="12" y="216" width="70" height="8" rx="4" fill="#1e293b"/>
					</svg>
				</div>
				<span class="pj-plant"><svg viewBox="0 0 60 70" fill="none"><path d="M30 64V40" stroke="#64748b" stroke-width="3"/><path d="M30 46c-14-2-22-14-19-31 16 0 24 12 19 31zM30 42c12-4 17-15 14-29-14 1-19 13-14 29z" fill="#22c55e"/><path d="M16 64h28l-4 6H20z" fill="#e2e8f0"/></svg></span>
					<span class="pj-float pj-float-live"><span class="pj-float-dot"></span><?php esc_html_e( 'Live in Production', 'blogtechu-custom' ); ?></span>
					<span class="pj-float pj-float-stat"><strong><?php echo esc_html( count( $pj_projects ) ); ?>+</strong> <?php esc_html_e( 'Projects Shipped', 'blogtechu-custom' ); ?></span>
			</div>
		</div>
	</div>

	</section>

	<!-- Stats strip -->
	<div class="pj-stats">
		<div class="pj-stat"><span class="pj-stat-ico cr-tone-blue"><?php echo $pj_stat_icon( 'work' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span><span><strong><?php echo esc_html( count( $pj_projects ) ); ?>+</strong><em><?php esc_html_e( 'Projects Shipped', 'blogtechu-custom' ); ?></em></span></div>
		<div class="pj-stat"><span class="pj-stat-ico cr-tone-green"><?php echo $pj_stat_icon( 'globe' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span><span><strong>6+</strong><em><?php esc_html_e( 'Countries Served', 'blogtechu-custom' ); ?></em></span></div>
		<div class="pj-stat"><span class="pj-stat-ico cr-tone-purple"><?php echo $pj_stat_icon( 'code' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span><span><strong>20+</strong><em><?php esc_html_e( 'Technologies', 'blogtechu-custom' ); ?></em></span></div>
		<div class="pj-stat"><span class="pj-stat-ico cr-tone-orange"><?php echo $pj_stat_icon( 'layers' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span><span><strong>3</strong><em><?php esc_html_e( 'Specialities', 'blogtechu-custom' ); ?></em></span></div>
		<div class="pj-stat"><span class="pj-stat-ico cr-tone-sky"><?php echo $pj_stat_icon( 'smile' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span><span><strong>100%</strong><em><?php esc_html_e( 'Client Focus', 'blogtechu-custom' ); ?></em></span></div>
		<div class="pj-stat"><span class="pj-stat-ico cr-tone-pink"><?php echo $pj_stat_icon( 'rocket' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span><span><strong><?php esc_html_e( 'Live', 'blogtechu-custom' ); ?></strong><em><?php esc_html_e( 'Production Apps', 'blogtechu-custom' ); ?></em></span></div>
	</div>

<!-- Projects -->
<section class="pj-section" id="projects-grid">
	<div class="pj-inner">
		<div class="pj-filter">
			<?php foreach ( $pj_cats as $key => $label ) : ?>
				<button type="button" class="pj-filter-btn<?php echo 'all' === $key ? ' is-active' : ''; ?>" data-pj-filter="<?php echo esc_attr( $key ); ?>"><?php echo esc_html( $label ); ?></button>
			<?php endforeach; ?>
		</div>

		<div class="pj-grid" data-pj-list>
			<?php foreach ( $pj_projects as $p ) : ?>
				<?php $primary = $p['live'] ? $p['live'] : ( $p['code'] ? $p['code'] : '' ); ?>
				<article class="pj-card" data-pj-cat="<?php echo esc_attr( $p['cat'] ); ?>">
					<div class="pj-card-media">
						<?php if ( $primary ) : ?><a href="<?php echo esc_url( $primary ); ?>" target="_blank" rel="noopener" aria-label="<?php echo esc_attr( $p['title'] ); ?>"><?php endif; ?>
							<img src="<?php echo esc_url( $img_base . $p['img'] ); ?>" alt="<?php echo esc_attr( $p['title'] ); ?> screenshot" loading="lazy" decoding="async" />
							<span class="pj-card-cat pj-cat-<?php echo esc_attr( $p['cat'] ); ?>"><?php echo esc_html( $p['badge'] ); ?></span>
						<?php if ( $primary ) : ?></a><?php endif; ?>
					</div>
					<div class="pj-card-body">
						<h3 class="pj-card-title"><?php echo esc_html( $p['title'] ); ?></h3>
						<p class="pj-card-desc"><?php echo esc_html( $p['desc'] ); ?></p>
						<div class="pj-card-tech">
							<?php foreach ( $p['tech'] as $t ) { echo '<span class="pj-chip">' . esc_html( $t ) . '</span>'; } ?>
						</div>
						<div class="pj-card-foot">
							<?php if ( $primary ) : ?>
								<a class="pj-card-cta" href="<?php echo esc_url( $primary ); ?>" target="_blank" rel="noopener"><?php echo $p['live'] ? esc_html__( 'View Case Study', 'blogtechu-custom' ) : esc_html__( 'View Code', 'blogtechu-custom' ); ?> <?php echo $arrow; // phpcs:ignore WordPress.Security.EscapeOutput ?></a>
								<?php if ( $p['code'] && $p['live'] ) : ?>
									<a class="pj-card-icon" href="<?php echo esc_url( $p['code'] ); ?>" target="_blank" rel="noopener" aria-label="<?php esc_attr_e( 'Source code', 'blogtechu-custom' ); ?>"><?php echo $code; // phpcs:ignore WordPress.Security.EscapeOutput ?></a>
								<?php else : ?>
									<a class="pj-card-icon" href="<?php echo esc_url( $primary ); ?>" target="_blank" rel="noopener" aria-label="<?php esc_attr_e( 'Preview', 'blogtechu-custom' ); ?>"><?php echo $eye; // phpcs:ignore WordPress.Security.EscapeOutput ?></a>
								<?php endif; ?>
							<?php else : ?>
								<span class="pj-card-private"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="5" y="11" width="14" height="9" rx="2"/><path d="M8 11V8a4 4 0 0 1 8 0v3"/></svg> <?php esc_html_e( 'Client Project', 'blogtechu-custom' ); ?></span>
							<?php endif; ?>
						</div>
					</div>
				</article>
			<?php endforeach; ?>
		</div>
		<p class="pj-empty" data-pj-empty style="display:none;"><?php esc_html_e( 'No projects in this category yet.', 'blogtechu-custom' ); ?></p>
	</div>
</section>

<!-- CTA -->
<section class="pj-cta-wrap">
	<div class="pj-cta">
		<span class="pj-cta-rocket"><svg viewBox="0 0 64 64" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M32 6c9 5 14 14 14 26l-7 7H25l-7-7c0-12 5-21 14-26z"/><circle cx="32" cy="24" r="4"/><path d="M25 40l-7 12 12-5M39 40l7 12-12-5"/></svg></span>
		<div class="pj-cta-text">
			<h2 class="pj-cta-title"><?php esc_html_e( 'Have a Project in Mind?', 'blogtechu-custom' ); ?></h2>
			<p class="pj-cta-sub"><?php echo wp_kses( __( "Let's work together to build something <em>amazing</em> for your business.", 'blogtechu-custom' ), array( 'em' => array() ) ); ?></p>
		</div>
		<div class="pj-cta-actions">
			<a class="pj-cta-btn" href="<?php echo esc_url( $contact_url ); ?>"><?php esc_html_e( 'Start Your Project', 'blogtechu-custom' ); ?> <span aria-hidden="true">→</span></a>
			<a class="pj-cta-btn is-ghost" href="<?php echo esc_url( $contact_url ); ?>" data-talk-open><?php esc_html_e( 'Talk to Our Expert', 'blogtechu-custom' ); ?></a>
		</div>
	</div>
</section>

<?php
get_footer();
