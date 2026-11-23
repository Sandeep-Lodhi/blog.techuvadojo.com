<?php
/**
 * Template for the Portfolio page (slug "portfolio").
 *
 * Rich, case-study-driven showcase: hero with screenshot collage, impact stats,
 * alternating featured case studies (browser mockups), "what we build", a
 * project gallery, the tech stack and a delivery process. Content sourced from
 * the founder's real portfolio.
 *
 * @package Blogtechu_Custom
 */

get_header();

$contact_url  = home_url( '/contact' );
$projects_url = home_url( '/projects' );
$img_base     = get_theme_file_uri( '/assets/images/projects/' );

/* Browser-frame mockup helper. */
$po_browser = function ( $img, $url, $alt, $link = '' ) use ( $img_base ) {
	$open  = $link ? '<a href="' . esc_url( $link ) . '" target="_blank" rel="noopener">' : '';
	$close = $link ? '</a>' : '';
	$out   = '<div class="po-browser">';
	$out  .= '<div class="po-browser-bar"><i></i><i></i><i></i><span class="po-browser-url">' . esc_html( $url ) . '</span></div>';
	$out  .= $open . '<img src="' . esc_url( $img_base . $img ) . '" alt="' . esc_attr( $alt ) . '" loading="lazy" decoding="async" />' . $close;
	$out  .= '</div>';
	return $out;
};

/* Featured case studies (one per category for variety). */
$po_cases = array(
	array(
		'title'      => 'TorahAnytime',
		'img'        => 'torahanytime.png',
		'url'        => 'torahanytime.com',
		'cat'        => 'Enterprise Platform',
		'desc'       => 'A large-scale religious media & donations platform serving a global audience. We led the project workflow end to end — from feature delivery to production deployment.',
		'highlights' => array( 'Led workflow: tickets, PR reviews & production releases', 'Scaled backend with Redis, ElasticSearch & RabbitMQ', 'Containerised with Docker & Kubernetes on AWS' ),
		'tech'       => array( 'Node.js', 'MySQL', 'Redis', 'AWS', 'Docker', 'Kubernetes', 'ElasticSearch' ),
		'live'       => 'https://torahanytime.com/',
		'code'       => '',
	),
	array(
		'title'      => 'Real Estate Platform',
		'img'        => 'real-estate.png',
		'url'        => 'real-estate.app',
		'cat'        => 'Full-Stack Web App',
		'desc'       => 'A full-featured MERN real-estate marketplace connecting property owners, buyers and agents with rich listings and dynamic insights.',
		'highlights' => array( 'Listing management with image uploads & search', 'Secure auth with JWT and Firebase', 'Real-time data insights powered by MongoDB' ),
		'tech'       => array( 'React.js', 'Node.js', 'Express.js', 'MongoDB', 'Firebase', 'Redux' ),
		'live'       => 'https://real-estate-d1ad.onrender.com/',
		'code'       => 'https://github.com/Sandeep-Lodhi/mern-estate',
	),
	array(
		'title'      => 'Amazon Clone',
		'img'        => 'amazon-clone.png',
		'url'        => 'amazon-clone.app',
		'cat'        => 'E-Commerce',
		'desc'       => 'An Amazon-style storefront with full product browsing, cart, authentication and real card payments via Stripe.',
		'highlights' => array( 'Product catalog, cart & checkout flow', 'Stripe payment integration', 'Firebase auth & realtime database' ),
		'tech'       => array( 'React.js', 'Firebase', 'Node.js', 'Express.js', 'Stripe' ),
		'live'       => 'https://amazone-clone-six-omega.vercel.app/',
		'code'       => 'https://github.com/Sandeep-Lodhi/Amazone-Clone',
	),
	array(
		'title'      => 'Go ASK Me',
		'img'        => 'goask.png',
		'url'        => 'goask.me',
		'cat'        => 'AI Platform · Romania',
		'desc'       => 'An AI-powered services marketplace where users simply describe what they need and an AI agent handles matching, negotiating and closing the best deal — in minutes.',
		'highlights' => array( 'AI agent for smart matching & negotiation', 'Marketplace with end-to-end deal flow', 'Voice input & multi-language support' ),
		'tech'       => array( 'Next.js', 'React.js', 'Node.js', 'TypeScript', 'AI / LLM', 'PostgreSQL' ),
		'live'       => 'https://goask.me/',
		'code'       => '',
	),
);

/* Gallery (the rest of the work). */
$po_gallery = array(
	array( 'title' => 'Nosotrus LMS', 'img' => 'nosotrus.png', 'cat' => 'Enterprise', 'live' => 'https://develop.nosotrosonline.com/' ),
	array( 'title' => 'FamilyOne', 'img' => 'familyone.png', 'cat' => 'Enterprise', 'live' => 'https://family.one/' ),
	array( 'title' => 'BikeShopShippers', 'img' => 'bikeshopshippers.png', 'cat' => 'Enterprise', 'live' => 'https://bikeshopshippers.com/us' ),
	array( 'title' => 'Airiasearch', 'img' => 'airiasearch.png', 'cat' => 'AI Web App', 'live' => 'https://airiasearch.vercel.app/' ),
	array( 'title' => 'Netflix Clone', 'img' => 'netflix-clone.png', 'cat' => 'Web App', 'live' => 'https://netflix-clone-git-main-sandeep-lodhis-projects.vercel.app/' ),
	array( 'title' => 'Zegocloud Meet', 'img' => 'zegocloud.png', 'cat' => 'Web App', 'live' => 'https://zegocloud-app.vercel.app/' ),
	array( 'title' => 'E-commerce Platform', 'img' => 'ecommerce.png', 'cat' => 'E-Commerce', 'live' => '' ),
	array( 'title' => 'SmartBiz', 'img' => 'smartbiz.png', 'cat' => 'SaaS', 'live' => '' ),
	array( 'title' => 'Todo App', 'img' => 'todo-app.png', 'cat' => 'Web App', 'live' => 'https://dodo-app-client.vercel.app/' ),
);

$arrow = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M7 17 17 7M9 7h8v8"/></svg>';
$code  = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M8 9l-4 3 4 3M16 9l4 3-4 3M13 6l-2 12"/></svg>';
?>

<!-- Hero -->
<section class="po-hero">
	<div class="po-hero-inner">
		<div class="po-hero-content">
			<span class="po-hero-eyebrow"><span class="cr-dot"></span><?php esc_html_e( 'Portfolio', 'blogtechu-custom' ); ?></span>
			<h1 class="po-hero-title"><?php echo wp_kses( __( 'Crafting Digital Experiences That <em>Perform</em>', 'blogtechu-custom' ), array( 'em' => array() ) ); ?></h1>
			<p class="po-hero-text"><?php esc_html_e( 'We design and build fast, scalable products — from enterprise platforms to polished web apps. Here is a look at the work we are proud of.', 'blogtechu-custom' ); ?></p>
			<div class="po-hero-actions">
				<a class="au-btn" href="<?php echo esc_url( $contact_url ); ?>"><?php esc_html_e( 'Start a Project', 'blogtechu-custom' ); ?> <span aria-hidden="true">→</span></a>
				<a class="au-btn is-ghost" href="#work"><?php esc_html_e( 'View Our Work', 'blogtechu-custom' ); ?></a>
			</div>
		</div>
		<div class="po-hero-collage">
			<div class="po-collage-back"><?php echo $po_browser( 'netflix-clone.png', 'netflix-clone.app', 'Netflix Clone' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></div>
			<div class="po-collage-front"><?php echo $po_browser( 'airiasearch.png', 'airiasearch.app', 'Airiasearch' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></div>
		</div>
	</div>

	<div class="po-stats">
		<div class="po-stat"><strong>13+</strong><span><?php esc_html_e( 'Projects Delivered', 'blogtechu-custom' ); ?></span></div>
		<div class="po-stat"><strong>20+</strong><span><?php esc_html_e( 'Technologies', 'blogtechu-custom' ); ?></span></div>
		<div class="po-stat"><strong>3</strong><span><?php esc_html_e( 'Core Specialities', 'blogtechu-custom' ); ?></span></div>
		<div class="po-stat"><strong><?php esc_html_e( 'Global', 'blogtechu-custom' ); ?></strong><span><?php esc_html_e( 'Production Apps', 'blogtechu-custom' ); ?></span></div>
	</div>
</section>

<!-- Featured case studies -->
<section class="po-cases" id="work">
	<div class="po-section-head">
		<span class="section-eyebrow"><?php esc_html_e( 'Featured Work', 'blogtechu-custom' ); ?></span>
		<h2 class="po-h2"><?php esc_html_e( 'Selected Case Studies', 'blogtechu-custom' ); ?></h2>
		<p class="po-sub"><?php esc_html_e( 'A closer look at some of the products we have designed, built and shipped.', 'blogtechu-custom' ); ?></p>
	</div>

	<?php foreach ( $po_cases as $i => $c ) : ?>
		<article class="po-case<?php echo ( $i % 2 ) ? ' is-reverse' : ''; ?>">
			<div class="po-case-media">
				<?php echo $po_browser( $c['img'], $c['url'], $c['title'], $c['live'] ? $c['live'] : $c['code'] ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
			</div>
			<div class="po-case-body">
				<span class="po-case-cat"><?php echo esc_html( $c['cat'] ); ?></span>
				<h3 class="po-case-title"><?php echo esc_html( $c['title'] ); ?></h3>
				<p class="po-case-desc"><?php echo esc_html( $c['desc'] ); ?></p>
				<ul class="po-case-points">
					<?php foreach ( $c['highlights'] as $h ) : ?>
						<li><?php echo esc_html( $h ); ?></li>
					<?php endforeach; ?>
				</ul>
				<div class="po-case-tech">
					<?php foreach ( $c['tech'] as $t ) : ?>
						<span class="pj-chip"><?php echo esc_html( $t ); ?></span>
					<?php endforeach; ?>
				</div>
				<div class="po-case-links">
					<?php if ( $c['live'] ) : ?>
						<a class="au-btn" href="<?php echo esc_url( $c['live'] ); ?>" target="_blank" rel="noopener"><?php esc_html_e( 'View Live', 'blogtechu-custom' ); ?> <?php echo $arrow; // phpcs:ignore WordPress.Security.EscapeOutput ?></a>
					<?php endif; ?>
					<?php if ( $c['code'] ) : ?>
						<a class="au-btn is-ghost" href="<?php echo esc_url( $c['code'] ); ?>" target="_blank" rel="noopener"><?php echo $code; // phpcs:ignore WordPress.Security.EscapeOutput ?> <?php esc_html_e( 'Source', 'blogtechu-custom' ); ?></a>
					<?php endif; ?>
				</div>
			</div>
		</article>
	<?php endforeach; ?>
</section>

<!-- Global clients -->
<section class="po-globe">
	<div class="po-globe-inner">
		<div class="po-section-head">
			<span class="section-eyebrow"><?php esc_html_e( 'Global Reach', 'blogtechu-custom' ); ?></span>
			<h2 class="po-h2"><?php esc_html_e( 'Trusted by Clients Across the Globe', 'blogtechu-custom' ); ?></h2>
			<p class="po-sub"><?php esc_html_e( 'We have designed, built and shipped software for teams and businesses around the world.', 'blogtechu-custom' ); ?></p>
		</div>
		<div class="po-globe-grid">
			<?php
			$countries = array(
				array( '🇮🇱', __( 'Israel', 'blogtechu-custom' ) ),
				array( '🇺🇸', __( 'United States', 'blogtechu-custom' ) ),
				array( '🇦🇺', __( 'Australia', 'blogtechu-custom' ) ),
				array( '🇷🇴', __( 'Romania', 'blogtechu-custom' ) ),
				array( '🇪🇸', __( 'Spain', 'blogtechu-custom' ) ),
				array( '🇨🇦', __( 'Canada', 'blogtechu-custom' ) ),
			);
			foreach ( $countries as $c ) :
				?>
				<article class="po-country">
					<span class="po-country-flag"><?php echo esc_html( $c[0] ); ?></span>
					<span class="po-country-name"><?php echo esc_html( $c[1] ); ?></span>
				</article>
			<?php endforeach; ?>
		</div>
		<p class="po-globe-note"><?php esc_html_e( '6 countries · International client delivery across multiple time zones', 'blogtechu-custom' ); ?></p>
	</div>
</section>

<!-- What we build -->
<section class="po-build">
	<div class="po-build-inner">
		<div class="po-section-head">
			<span class="section-eyebrow"><?php esc_html_e( 'What We Build', 'blogtechu-custom' ); ?></span>
			<h2 class="po-h2"><?php esc_html_e( 'Expertise Across the Stack', 'blogtechu-custom' ); ?></h2>
		</div>
		<div class="po-build-grid">
			<?php
			$builds = array(
				array( 'green', __( 'Enterprise Platforms', 'blogtechu-custom' ), __( 'Large-scale, cloud-native systems with CI/CD, queues and microservices.', 'blogtechu-custom' ), '<path d="M3 21h18M5 21V7l7-4 7 4v14M9 9h.01M9 13h.01M9 17h.01M15 9h.01M15 13h.01M15 17h.01"/>' ),
				array( 'blue', __( 'Web Applications', 'blogtechu-custom' ), __( 'Fast, responsive React / Next.js apps with delightful, accessible UI.', 'blogtechu-custom' ), '<rect x="3" y="4" width="18" height="14" rx="2"/><path d="M3 9h18M8 21h8"/>' ),
				array( 'orange', __( 'E-Commerce', 'blogtechu-custom' ), __( 'Conversion-focused stores with secure checkout and payment integrations.', 'blogtechu-custom' ), '<path d="M6 6h15l-1.5 9h-12z"/><path d="M6 6 5 3H3"/><circle cx="9" cy="20" r="1.5"/><circle cx="17" cy="20" r="1.5"/>' ),
			);
			foreach ( $builds as $b ) :
				?>
				<article class="po-build-card">
					<span class="po-build-ico cr-tone-<?php echo esc_attr( $b[0] ); ?>"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><?php echo $b[3]; // phpcs:ignore WordPress.Security.EscapeOutput ?></svg></span>
					<h3 class="po-build-title"><?php echo esc_html( $b[1] ); ?></h3>
					<p class="po-build-text"><?php echo esc_html( $b[2] ); ?></p>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<!-- Gallery -->
<section class="po-gallery">
	<div class="po-gallery-inner">
		<div class="po-section-head">
			<span class="section-eyebrow"><?php esc_html_e( 'More Work', 'blogtechu-custom' ); ?></span>
			<h2 class="po-h2"><?php esc_html_e( 'Project Gallery', 'blogtechu-custom' ); ?></h2>
		</div>
		<div class="po-gallery-grid">
			<?php foreach ( $po_gallery as $g ) : ?>
				<?php $glink = $g['live'] ? $g['live'] : ''; ?>
				<article class="po-tile">
					<?php if ( $glink ) : ?><a href="<?php echo esc_url( $glink ); ?>" target="_blank" rel="noopener"><?php endif; ?>
						<img src="<?php echo esc_url( $img_base . $g['img'] ); ?>" alt="<?php echo esc_attr( $g['title'] ); ?>" loading="lazy" decoding="async" />
						<div class="po-tile-overlay">
							<span class="po-tile-cat"><?php echo esc_html( $g['cat'] ); ?></span>
							<h3 class="po-tile-title"><?php echo esc_html( $g['title'] ); ?><?php echo $glink ? ' <span aria-hidden="true">↗</span>' : ''; ?></h3>
						</div>
					<?php if ( $glink ) : ?></a><?php endif; ?>
				</article>
			<?php endforeach; ?>
		</div>
		<div class="po-gallery-cta">
			<a class="cr-more-btn" href="<?php echo esc_url( $projects_url ); ?>"><?php esc_html_e( 'See All Projects', 'blogtechu-custom' ); ?> <span aria-hidden="true">→</span></a>
		</div>
	</div>
</section>

<!-- Tech stack -->
<section class="po-stack">
	<div class="po-stack-inner">
		<div class="po-section-head">
			<span class="section-eyebrow"><?php esc_html_e( 'Our Toolkit', 'blogtechu-custom' ); ?></span>
			<h2 class="po-h2"><?php esc_html_e( 'Technologies We Work With', 'blogtechu-custom' ); ?></h2>
		</div>
		<div class="po-stack-chips">
			<?php
			$stack = array( 'React.js', 'Next.js', 'Node.js', 'Express.js', 'TypeScript', 'MongoDB', 'PostgreSQL', 'MySQL', 'Redis', 'AWS', 'Docker', 'Kubernetes', 'Tailwind CSS', 'Redux', 'GraphQL', 'Firebase', 'Stripe', 'ElasticSearch', 'Serverless', 'CI/CD' );
			foreach ( $stack as $s ) {
				echo '<span class="po-stack-chip">' . esc_html( $s ) . '</span>';
			}
			?>
		</div>
	</div>
</section>

<!-- Process -->
<section class="po-process">
	<div class="po-process-inner">
		<div class="po-section-head">
			<span class="section-eyebrow"><?php esc_html_e( 'How We Work', 'blogtechu-custom' ); ?></span>
			<h2 class="po-h2"><?php esc_html_e( 'From Idea to Launch', 'blogtechu-custom' ); ?></h2>
		</div>
		<div class="po-process-grid">
			<?php
			$steps = array(
				array( __( 'Discover', 'blogtechu-custom' ), __( 'We learn your goals, users and requirements to shape the right plan.', 'blogtechu-custom' ), '<circle cx="11" cy="11" r="7"/><path d="M21 21l-4-4"/>' ),
				array( __( 'Design', 'blogtechu-custom' ), __( 'Wireframes and polished UI that are intuitive and on-brand.', 'blogtechu-custom' ), '<path d="M15 4l5 5L9 20l-5 1 1-5z"/><path d="M13 6l5 5"/>' ),
				array( __( 'Develop', 'blogtechu-custom' ), __( 'Clean, scalable code with testing, reviews and CI/CD.', 'blogtechu-custom' ), '<path d="M8 9l-4 3 4 3M16 9l4 3-4 3M13 6l-2 12"/>' ),
				array( __( 'Launch', 'blogtechu-custom' ), __( 'Deploy to production and support you as you grow.', 'blogtechu-custom' ), '<path d="M12 3c3 1.6 5 5 5 9l-2.5 2.5h-5L7 12c0-4 2-7.4 5-9z"/><circle cx="12" cy="9" r="1.6"/>' ),
			);
			foreach ( $steps as $i => $st ) :
				?>
				<article class="po-step">
					<span class="po-step-num"><?php echo esc_html( sprintf( '%02d', $i + 1 ) ); ?></span>
					<span class="po-step-ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><?php echo $st[2]; // phpcs:ignore WordPress.Security.EscapeOutput ?></svg></span>
					<h3 class="po-step-title"><?php echo esc_html( $st[0] ); ?></h3>
					<p class="po-step-text"><?php echo esc_html( $st[1] ); ?></p>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<!-- CTA -->
<section class="cr-cta-wrap">
	<div class="cr-cta">
		<div class="cr-cta-text">
			<h2 class="cr-cta-title"><?php esc_html_e( 'Like what you see?', 'blogtechu-custom' ); ?></h2>
			<p class="cr-cta-sub"><?php esc_html_e( "Let's build something great together — get in touch and tell us about your project.", 'blogtechu-custom' ); ?></p>
		</div>
		<div class="cr-cta-actions">
			<a class="cr-cta-btn" href="<?php echo esc_url( $contact_url ); ?>"><?php esc_html_e( 'Start a Project', 'blogtechu-custom' ); ?> <span aria-hidden="true">→</span></a>
			<a class="cr-cta-btn is-ghost" href="<?php echo esc_url( $projects_url ); ?>"><?php esc_html_e( 'Browse Projects', 'blogtechu-custom' ); ?> <span aria-hidden="true">→</span></a>
		</div>
	</div>
</section>

<?php
get_footer();
