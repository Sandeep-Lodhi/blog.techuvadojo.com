<?php
/**
 * Template for the Services page (auto-loaded for the page with slug "services").
 *
 * Modern services landing: hero with stats, services grid, process timeline,
 * pricing plans, trust strip, FAQ accordion and a closing CTA. Built on the
 * theme's existing brand palette and component classes.
 *
 * @package Blogtechu_Custom
 */

get_header();

$contact_url = home_url( '/contact' );
?>

<!-- Hero -->
<section class="svc-hero">
	<div class="svc-hero-inner">
		<div>
			<span class="svc-hero-eyebrow"><?php esc_html_e( 'Our Services', 'blogtechu-custom' ); ?></span>
			<h1 class="svc-hero-title">
				<?php echo wp_kses( __( 'Digital Solutions That <em>Drive Growth</em>', 'blogtechu-custom' ), array( 'em' => array() ) ); ?>
			</h1>
			<p class="svc-hero-text"><?php esc_html_e( 'From pixel-perfect websites to scalable e-commerce stores and result-driven marketing — we design, build and grow digital products that move your business forward.', 'blogtechu-custom' ); ?></p>

			<div class="hero-cta-row">
				<a class="btn-primary" href="<?php echo esc_url( $contact_url ); ?>"><?php esc_html_e( 'Get a Free Quote', 'blogtechu-custom' ); ?></a>
				<a class="btn-ghost" href="#services-grid"><?php esc_html_e( 'Explore Services', 'blogtechu-custom' ); ?></a>
			</div>

			<div class="svc-hero-stats">
				<div class="svc-hero-stat"><strong>100%</strong><span><?php esc_html_e( 'Dedicated Team', 'blogtechu-custom' ); ?></span></div>
				<div class="svc-hero-stat"><strong>24/7</strong><span><?php esc_html_e( 'Support', 'blogtechu-custom' ); ?></span></div>
				<div class="svc-hero-stat"><strong>Agile</strong><span><?php esc_html_e( 'Delivery', 'blogtechu-custom' ); ?></span></div>
			</div>
		</div>

		<div class="svc-hero-card">
			<?php
			$hero_chips = array(
				array( 'icon' => '⚡', 'title' => __( 'Fast Delivery', 'blogtechu-custom' ), 'desc' => __( 'Agile sprints, on-time launches', 'blogtechu-custom' ) ),
				array( 'icon' => '🎯', 'title' => __( 'Results Focused', 'blogtechu-custom' ), 'desc' => __( 'Strategy built around your KPIs', 'blogtechu-custom' ) ),
				array( 'icon' => '🛠️', 'title' => __( 'Full-Stack Expertise', 'blogtechu-custom' ), 'desc' => __( 'Design, code, marketing & support', 'blogtechu-custom' ) ),
				array( 'icon' => '🤝', 'title' => __( 'Dedicated Support', 'blogtechu-custom' ), 'desc' => __( '24/7 help, real humans', 'blogtechu-custom' ) ),
			);
			foreach ( $hero_chips as $chip ) :
				?>
				<div class="svc-hero-chip">
					<span class="svc-hero-chip-icon"><?php echo esc_html( $chip['icon'] ); ?></span>
					<span>
						<strong><?php echo esc_html( $chip['title'] ); ?></strong>
						<span><?php echo esc_html( $chip['desc'] ); ?></span>
					</span>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<!-- Services grid -->
<section class="services-section" id="services-grid">
	<div class="services-head">
		<div>
			<span class="section-eyebrow"><?php esc_html_e( 'What We Do', 'blogtechu-custom' ); ?></span>
			<h2 class="services-title"><?php echo wp_kses( __( 'Services We <em>Provide</em>', 'blogtechu-custom' ), array( 'em' => array() ) ); ?></h2>
		</div>
		<p class="section-subtitle max-w-md"><?php esc_html_e( 'A complete suite of development, design, marketing and support services under one roof — so you can move faster with a single trusted partner.', 'blogtechu-custom' ); ?></p>
	</div>

	<!-- Filter tabs -->
	<div class="svc-filter">
		<?php
		$svc_filters = array(
			'*'           => __( 'All Services', 'blogtechu-custom' ),
			'development' => __( 'Development', 'blogtechu-custom' ),
			'design'      => __( 'Design & Creative', 'blogtechu-custom' ),
			'marketing'   => __( 'Marketing', 'blogtechu-custom' ),
			'business'    => __( 'Business Solutions', 'blogtechu-custom' ),
			'support'     => __( 'Support', 'blogtechu-custom' ),
		);
		foreach ( $svc_filters as $key => $label ) :
			?>
			<button type="button" class="svc-filter-btn<?php echo '*' === $key ? ' is-active' : ''; ?>" data-svc-filter="<?php echo esc_attr( $key ); ?>"><?php echo esc_html( $label ); ?></button>
		<?php endforeach; ?>
	</div>

	<div class="services-grid" data-svc-grid>
		<?php
		// icon = inner SVG markup; cat = filter group; tone = color variant.
		$services = array(
			array( 'cat' => 'development', 'tone' => '', 'title' => __( 'MERN Stack Development', 'blogtechu-custom' ), 'desc' => __( 'Custom MERN apps, enterprise web apps, REST & GraphQL APIs, PWAs and full-stack builds.', 'blogtechu-custom' ), 'icon' => '<path d="M12 2 2 7l10 5 10-5-10-5z"/><path d="M2 12l10 5 10-5M2 17l10 5 10-5"/>' ),
			array( 'cat' => 'development', 'tone' => 'tone-violet', 'title' => __( 'Custom Web Development', 'blogtechu-custom' ), 'desc' => __( 'Business, corporate & portfolio sites, landing pages, blogs, news portals and CMS development.', 'blogtechu-custom' ), 'icon' => '<rect x="2" y="3" width="20" height="14" rx="2"/><path d="M8 21h8M12 17v4M9 8l-2 2 2 2M15 8l2 2-2 2"/>' ),
			array( 'cat' => 'development', 'tone' => 'tone-rose', 'title' => __( 'E-Commerce Development', 'blogtechu-custom' ), 'desc' => __( 'Custom stores, multi-vendor marketplaces, B2B/B2C, payment gateway & order-tracking integration.', 'blogtechu-custom' ), 'icon' => '<circle cx="9" cy="20" r="1.5"/><circle cx="18" cy="20" r="1.5"/><path d="M2 3h3l2.2 11a1.5 1.5 0 0 0 1.5 1.2h8.4a1.5 1.5 0 0 0 1.5-1.2L21 7H6"/>' ),
			array( 'cat' => 'development', 'tone' => 'tone-emerald', 'title' => __( 'Industry Applications', 'blogtechu-custom' ), 'desc' => __( 'CRM, ERP, SaaS, EdTech, logistics, real estate, healthcare, booking & inventory systems.', 'blogtechu-custom' ), 'icon' => '<rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/>' ),
			array( 'cat' => 'development', 'tone' => 'tone-amber', 'title' => __( 'Mobile App Development', 'blogtechu-custom' ), 'desc' => __( 'Android, iOS and cross-platform apps with React Native and Flutter.', 'blogtechu-custom' ), 'icon' => '<rect x="6" y="2" width="12" height="20" rx="2"/><path d="M10 18h4"/>' ),
			array( 'cat' => 'development', 'tone' => 'tone-violet', 'title' => __( 'API & Integration', 'blogtechu-custom' ), 'desc' => __( 'REST & GraphQL APIs, payment, maps, OAuth, SMS/email, AI, CRM and ERP integrations.', 'blogtechu-custom' ), 'icon' => '<path d="M7 4a2 2 0 0 0-2 2v3a2 2 0 0 1-2 2 2 2 0 0 1 2 2v3a2 2 0 0 0 2 2M17 4a2 2 0 0 1 2 2v3a2 2 0 0 0 2 2 2 2 0 0 0-2 2v3a2 2 0 0 1-2 2"/>' ),
			array( 'cat' => 'development', 'tone' => '', 'title' => __( 'Cloud & DevOps', 'blogtechu-custom' ), 'desc' => __( 'AWS, DigitalOcean, Firebase, Docker, CI/CD, Nginx, SSL, deployment & server migration.', 'blogtechu-custom' ), 'icon' => '<path d="M17.5 19a4.5 4.5 0 0 0 .5-9 6.5 6.5 0 0 0-12.4-1.5A4 4 0 0 0 6 19z"/>' ),
			array( 'cat' => 'development', 'tone' => 'tone-violet', 'title' => __( 'WordPress Development', 'blogtechu-custom' ), 'desc' => __( 'Custom themes, WooCommerce, plugin development, speed optimization, migration & support.', 'blogtechu-custom' ), 'icon' => '<circle cx="12" cy="12" r="9"/><path d="M3 12h18M12 3a14 14 0 0 1 0 18M12 3a14 14 0 0 0 0 18"/>' ),
			array( 'cat' => 'development', 'tone' => 'tone-emerald', 'title' => __( 'Shopify Development', 'blogtechu-custom' ), 'desc' => __( 'Store setup & development, theme customization, app integration, migration & optimization.', 'blogtechu-custom' ), 'icon' => '<path d="M6 8h12l-1 12H7L6 8z"/><path d="M9 8a3 3 0 0 1 6 0"/>' ),

			// UI/UX & Graphic Design — hidden for now.
			// array( 'cat' => 'design', 'tone' => 'tone-pink', 'title' => __( 'UI/UX & Graphic Design', 'blogtechu-custom' ), 'desc' => __( 'Website & app UI, dashboards, logos, brand identity, banners and social creatives.', 'blogtechu-custom' ), 'icon' => '<path d="M12 19l7-7a2.8 2.8 0 0 0-4-4l-7 7-1 5z"/><path d="M14 7l3 3"/>' ),
			array( 'cat' => 'design', 'tone' => 'tone-amber', 'title' => __( 'Content Writing', 'blogtechu-custom' ), 'desc' => __( 'Blogs, technical & SEO content, copywriting, product descriptions and content strategy.', 'blogtechu-custom' ), 'icon' => '<path d="M14 3v4a1 1 0 0 0 1 1h4"/><path d="M14 3H6a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><path d="M9 13h6M9 17h4"/>' ),
			array( 'cat' => 'design', 'tone' => 'tone-rose', 'title' => __( 'Media Production', 'blogtechu-custom' ), 'desc' => __( 'Photo & video editing, retouching, motion graphics, intros and promotional videos.', 'blogtechu-custom' ), 'icon' => '<rect x="3" y="4" width="18" height="16" rx="2"/><path d="M7 4v16M17 4v16M3 9h4M17 9h4M3 15h4M17 15h4"/>' ),

			array( 'cat' => 'marketing', 'tone' => 'tone-amber', 'title' => __( 'Funnel Building', 'blogtechu-custom' ), 'desc' => __( 'Sales, lead-gen, webinar and product-launch funnels with high-converting landing pages.', 'blogtechu-custom' ), 'icon' => '<path d="M3 4h18l-7 8v6l-4 2v-8L3 4z"/>' ),
			array( 'cat' => 'marketing', 'tone' => 'tone-violet', 'title' => __( 'Email Marketing & Automation', 'blogtechu-custom' ), 'desc' => __( 'Campaigns, newsletters, sequences, lead nurturing and n8n/Zapier automation.', 'blogtechu-custom' ), 'icon' => '<rect x="3" y="5" width="18" height="14" rx="2"/><path d="M3 7l9 6 9-6"/>' ),
			array( 'cat' => 'marketing', 'tone' => 'tone-emerald', 'title' => __( 'SEO Services', 'blogtechu-custom' ), 'desc' => __( 'Technical, on-page, off-page, local and e-commerce SEO plus full SEO audits.', 'blogtechu-custom' ), 'icon' => '<path d="M3 3v18h18"/><path d="M7 14l4-4 3 3 5-6"/>' ),
			array( 'cat' => 'marketing', 'tone' => 'tone-rose', 'title' => __( 'Digital Advertising', 'blogtechu-custom' ), 'desc' => __( 'Google, Meta, YouTube & LinkedIn ads, PPC, remarketing and CPA/CPC campaigns.', 'blogtechu-custom' ), 'icon' => '<path d="M3 11v2a1 1 0 0 0 1 1h2l9 5V5L6 10H4a1 1 0 0 0-1 1z"/><path d="M18 9a3 3 0 0 1 0 6"/>' ),
			array( 'cat' => 'marketing', 'tone' => 'tone-pink', 'title' => __( 'Social Media Marketing', 'blogtechu-custom' ), 'desc' => __( 'Strategy, management, content planning, community management and influencer marketing.', 'blogtechu-custom' ), 'icon' => '<circle cx="18" cy="5" r="2"/><circle cx="6" cy="12" r="2"/><circle cx="18" cy="19" r="2"/><path d="M8 11l8-5M8 13l8 5"/>' ),

			array( 'cat' => 'business', 'tone' => 'tone-emerald', 'title' => __( 'AI Solutions', 'blogtechu-custom' ), 'desc' => __( 'AI chatbots & agents, workflow automation, OpenAI integration and AI customer support.', 'blogtechu-custom' ), 'icon' => '<rect x="6" y="6" width="12" height="12" rx="2"/><rect x="9.5" y="9.5" width="5" height="5"/><path d="M9 2v2M15 2v2M9 20v2M15 20v2M2 9h2M2 15h2M20 9h2M20 15h2"/>' ),
			array( 'cat' => 'business', 'tone' => '', 'title' => __( 'IT Consulting', 'blogtechu-custom' ), 'desc' => __( 'Digital transformation, software architecture, MVP, cloud, security and code audits.', 'blogtechu-custom' ), 'icon' => '<path d="M9 18h6M10 22h4"/><path d="M12 2a7 7 0 0 0-4 12.7V17h8v-2.3A7 7 0 0 0 12 2z"/>' ),

			array( 'cat' => 'support', 'tone' => 'tone-emerald', 'title' => __( 'Quality Assurance', 'blogtechu-custom' ), 'desc' => __( 'Manual & automated testing, API, performance & security testing, bug fixing.', 'blogtechu-custom' ), 'icon' => '<path d="M12 3l8 3v5c0 5-3.5 8-8 10-4.5-2-8-5-8-10V6z"/><path d="M9 12l2 2 4-4"/>' ),
			array( 'cat' => 'support', 'tone' => 'tone-amber', 'title' => __( 'Maintenance & Support', 'blogtechu-custom' ), 'desc' => __( 'Website, app & server maintenance, security updates, backups and 24/7 technical support.', 'blogtechu-custom' ), 'icon' => '<path d="M4 13a8 8 0 0 1 16 0"/><path d="M5 18v-4a1 1 0 0 1 1-1h1v6H6a1 1 0 0 1-1-1zM19 18v-4a1 1 0 0 0-1-1h-1v6h1a1 1 0 0 0 1-1z"/>' ),
		);
		foreach ( $services as $svc ) :
			?>
			<div class="service-card <?php echo esc_attr( $svc['tone'] ); ?>" data-svc-cat="<?php echo esc_attr( $svc['cat'] ); ?>">
				<div class="service-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><?php echo $svc['icon']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></svg></div>
				<h3 class="service-card-title"><?php echo esc_html( $svc['title'] ); ?></h3>
				<p class="service-card-desc"><?php echo esc_html( $svc['desc'] ); ?></p>
				<a href="<?php echo esc_url( $contact_url ); ?>" class="service-card-link"><?php esc_html_e( 'Learn More', 'blogtechu-custom' ); ?></a>
			</div>
		<?php endforeach; ?>
		<p class="svc-empty" data-svc-empty style="display:none;"><?php esc_html_e( 'No services in this category yet.', 'blogtechu-custom' ); ?></p>
	</div>
</section>

<!-- Industries We Serve -->
<section class="industries-section">
	<div class="services-head">
		<div>
			<span class="section-eyebrow"><?php esc_html_e( 'Industries', 'blogtechu-custom' ); ?></span>
			<h2 class="services-title"><?php echo wp_kses( __( 'Industries We <em>Serve</em>', 'blogtechu-custom' ), array( 'em' => array() ) ); ?></h2>
		</div>
		<p class="section-subtitle max-w-md"><?php esc_html_e( 'Domain expertise across the sectors that move fast and demand reliable technology.', 'blogtechu-custom' ); ?></p>
	</div>
	<div class="industries-grid">
		<?php
		$industries = array(
			array( 'icon' => '🏥', 'name' => __( 'Healthcare', 'blogtechu-custom' ), 'desc' => __( 'HealthTech & patient platforms', 'blogtechu-custom' ) ),
			array( 'icon' => '💰', 'name' => __( 'FinTech & Banking', 'blogtechu-custom' ), 'desc' => __( 'Secure financial software', 'blogtechu-custom' ) ),
			array( 'icon' => '🛒', 'name' => __( 'E-Commerce & Retail', 'blogtechu-custom' ), 'desc' => __( 'Stores & marketplaces', 'blogtechu-custom' ) ),
			array( 'icon' => '🎓', 'name' => __( 'EdTech', 'blogtechu-custom' ), 'desc' => __( 'Learning platforms', 'blogtechu-custom' ) ),
			array( 'icon' => '🏠', 'name' => __( 'Real Estate', 'blogtechu-custom' ), 'desc' => __( 'Listings & property apps', 'blogtechu-custom' ) ),
			array( 'icon' => '🚚', 'name' => __( 'Logistics', 'blogtechu-custom' ), 'desc' => __( 'Transport & tracking', 'blogtechu-custom' ) ),
			array( 'icon' => '🚀', 'name' => __( 'SaaS & Startups', 'blogtechu-custom' ), 'desc' => __( 'MVPs to scale-ups', 'blogtechu-custom' ) ),
			array( 'icon' => '🎬', 'name' => __( 'Media & Entertainment', 'blogtechu-custom' ), 'desc' => __( 'Content & streaming', 'blogtechu-custom' ) ),
		);
		foreach ( $industries as $ind ) :
			?>
			<div class="industry-card">
				<span class="industry-icon"><?php echo esc_html( $ind['icon'] ); ?></span>
				<span>
					<span class="industry-name block"><?php echo esc_html( $ind['name'] ); ?></span>
					<span class="industry-desc block"><?php echo esc_html( $ind['desc'] ); ?></span>
				</span>
			</div>
		<?php endforeach; ?>
	</div>
</section>

<!-- Tech Stack -->
<section class="stack-section">
	<div class="services-head">
		<div>
			<span class="section-eyebrow"><?php esc_html_e( 'Our Toolbox', 'blogtechu-custom' ); ?></span>
			<h2 class="services-title"><?php echo wp_kses( __( 'Technologies We <em>Work With</em>', 'blogtechu-custom' ), array( 'em' => array() ) ); ?></h2>
		</div>
		<p class="section-subtitle max-w-md"><?php esc_html_e( 'A battle-tested stack across the full product lifecycle.', 'blogtechu-custom' ); ?></p>
	</div>
	<div class="stack-grid">
		<?php
		$stacks = array(
			array( 'group' => __( 'Frontend', 'blogtechu-custom' ), 'icon' => '<rect x="3" y="4" width="18" height="12" rx="2"/><path d="M8 20h8M12 16v4"/>', 'items' => array( 'React.js', 'Next.js', 'TypeScript', 'Redux', 'Tailwind CSS' ) ),
			array( 'group' => __( 'Backend & APIs', 'blogtechu-custom' ), 'icon' => '<rect x="3" y="4" width="18" height="6" rx="1"/><rect x="3" y="14" width="18" height="6" rx="1"/><path d="M7 7h.01M7 17h.01"/>', 'items' => array( 'Node.js', 'Express.js', 'Nest.js', 'REST APIs', 'tRPC' ) ),
			array( 'group' => __( 'Databases', 'blogtechu-custom' ), 'icon' => '<ellipse cx="12" cy="5" rx="8" ry="3"/><path d="M4 5v6c0 1.7 3.6 3 8 3s8-1.3 8-3V5M4 11v6c0 1.7 3.6 3 8 3s8-1.3 8-3v-6"/>', 'items' => array( 'MongoDB', 'PostgreSQL', 'MySQL', 'Redis', 'Firebase' ) ),
			array( 'group' => __( 'DevOps & Cloud', 'blogtechu-custom' ), 'icon' => '<path d="M17.5 19a4.5 4.5 0 0 0 .5-9 6.5 6.5 0 0 0-12.4-1.5A4 4 0 0 0 6 19z"/>', 'items' => array( 'Docker', 'Kubernetes', 'AWS', 'GitHub Actions', 'NGINX' ) ),
			array( 'group' => __( 'Deployment', 'blogtechu-custom' ), 'icon' => '<path d="M12 19V6M5 12l7-7 7 7"/>', 'items' => array( 'Vercel', 'Render', 'DigitalOcean', 'Cloudflare', 'Heroku' ) ),
			array( 'group' => __( 'Testing & Quality', 'blogtechu-custom' ), 'icon' => '<path d="M12 3l8 3v5c0 5-3.5 8-8 10-4.5-2-8-5-8-10V6z"/><path d="M9 12l2 2 4-4"/>', 'items' => array( 'Jest', 'Cypress', 'Mocha', 'Sentry', 'ESLint' ) ),
			array( 'group' => __( 'CMS & E-Commerce', 'blogtechu-custom' ), 'icon' => '<path d="M6 8h12l-1 12H7L6 8z"/><path d="M9 8a3 3 0 0 1 6 0"/>', 'items' => array( 'WordPress', 'WooCommerce', 'Shopify' ) ),
			array( 'group' => __( 'AI & Automation', 'blogtechu-custom' ), 'icon' => '<path d="M12 3l1.6 4.4L18 9l-4.4 1.6L12 15l-1.6-4.4L6 9l4.4-1.6z"/><path d="M18 14l.8 2.2L21 17l-2.2.8L18 20l-.8-2.2L15 17l2.2-.8z"/>', 'items' => array( 'OpenAI', 'ChatGPT', 'GitHub Copilot', 'n8n', 'Zapier' ) ),
			array( 'group' => __( 'Version Control & Tools', 'blogtechu-custom' ), 'icon' => '<circle cx="6" cy="6" r="2"/><circle cx="6" cy="18" r="2"/><circle cx="18" cy="8" r="2"/><path d="M6 8v8M18 10a6 6 0 0 1-6 6H8"/>', 'items' => array( 'Git', 'GitHub', 'Bitbucket', 'Postman', 'Jira' ) ),
		);
		foreach ( $stacks as $stack ) :
			?>
			<div class="stack-group">
				<div class="stack-group-head">
					<span class="stack-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><?php echo $stack['icon']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></svg></span>
					<span class="stack-group-title"><?php echo esc_html( $stack['group'] ); ?></span>
				</div>
				<div class="stack-chips">
					<?php foreach ( $stack['items'] as $item ) : ?>
						<span class="stack-chip"><?php echo esc_html( $item ); ?></span>
					<?php endforeach; ?>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
</section>

<!-- Process timeline -->
<section class="process-section">
	<div class="services-head">
		<div>
			<span class="section-eyebrow"><?php esc_html_e( 'How We Work', 'blogtechu-custom' ); ?></span>
			<h2 class="services-title"><?php echo wp_kses( __( 'A simple, <em>proven process</em>', 'blogtechu-custom' ), array( 'em' => array() ) ); ?></h2>
		</div>
		<p class="section-subtitle max-w-md"><?php esc_html_e( 'Transparent steps from first conversation to launch and beyond — you always know what happens next.', 'blogtechu-custom' ); ?></p>
	</div>

	<div class="process-grid">
		<?php
		$steps = array(
			array( 'icon' => '💬', 'title' => __( 'Discover', 'blogtechu-custom' ), 'desc' => __( 'We learn your goals, audience and requirements.', 'blogtechu-custom' ) ),
			array( 'icon' => '🧭', 'title' => __( 'Plan', 'blogtechu-custom' ), 'desc' => __( 'We map a clear strategy, scope and timeline.', 'blogtechu-custom' ) ),
			array( 'icon' => '🎨', 'title' => __( 'Design', 'blogtechu-custom' ), 'desc' => __( 'We craft intuitive, on-brand interfaces.', 'blogtechu-custom' ) ),
			array( 'icon' => '⚙️', 'title' => __( 'Build', 'blogtechu-custom' ), 'desc' => __( 'We develop, test and refine every detail.', 'blogtechu-custom' ) ),
			array( 'icon' => '🚀', 'title' => __( 'Launch', 'blogtechu-custom' ), 'desc' => __( 'We deploy, monitor and support your growth.', 'blogtechu-custom' ) ),
		);
		foreach ( $steps as $step ) :
			?>
			<div class="process-step">
				<div class="process-step-icon"><?php echo esc_html( $step['icon'] ); ?></div>
				<h3 class="process-step-title"><?php echo esc_html( $step['title'] ); ?></h3>
				<p class="process-step-desc"><?php echo esc_html( $step['desc'] ); ?></p>
			</div>
		<?php endforeach; ?>
	</div>
</section>

<!-- Engagement Models -->
<section class="models-section">
	<div class="services-head">
		<div>
			<span class="section-eyebrow"><?php esc_html_e( 'How We Engage', 'blogtechu-custom' ); ?></span>
			<h2 class="services-title"><?php echo wp_kses( __( 'Flexible <em>Engagement Models</em>', 'blogtechu-custom' ), array( 'em' => array() ) ); ?></h2>
		</div>
		<p class="section-subtitle max-w-md"><?php esc_html_e( 'Work with us the way that fits your project, team and budget.', 'blogtechu-custom' ); ?></p>
	</div>
	<div class="models-grid">
		<?php
		$models = array(
			array( 'title' => __( 'Fixed Price', 'blogtechu-custom' ), 'desc' => __( 'A defined scope, timeline and cost agreed upfront — ideal when requirements are clear.', 'blogtechu-custom' ), 'best' => __( 'Best for: well-defined projects & MVPs', 'blogtechu-custom' ), 'icon' => '<path d="M14 3v4a1 1 0 0 0 1 1h4"/><path d="M14 3H6a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><path d="M9 13l2 2 4-4"/>' ),
			array( 'title' => __( 'Dedicated Team', 'blogtechu-custom' ), 'desc' => __( 'A full-time team that works only on your product, scaling up or down as you grow.', 'blogtechu-custom' ), 'best' => __( 'Best for: long-term products & startups', 'blogtechu-custom' ), 'icon' => '<path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/>' ),
			array( 'title' => __( 'Staff Augmentation', 'blogtechu-custom' ), 'desc' => __( 'Add our vetted experts to your in-house team on an hourly or monthly basis.', 'blogtechu-custom' ), 'best' => __( 'Best for: scaling existing teams fast', 'blogtechu-custom' ), 'icon' => '<circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/>' ),
		);
		foreach ( $models as $m ) :
			?>
			<div class="model-card">
				<div class="model-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><?php echo $m['icon']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></svg></div>
				<h3 class="model-title"><?php echo esc_html( $m['title'] ); ?></h3>
				<p class="model-desc"><?php echo esc_html( $m['desc'] ); ?></p>
				<div class="model-best"><strong><?php echo esc_html( $m['best'] ); ?></strong></div>
				<a class="price-cta mt-6" href="<?php echo esc_url( $contact_url ); ?>"><?php esc_html_e( 'Discuss Your Needs', 'blogtechu-custom' ); ?></a>
			</div>
		<?php endforeach; ?>
	</div>
</section>

<!-- Testimonials — hidden until real client quotes are available. -->
<?php if ( false ) : ?>
<section class="testi-section">
	<div class="services-head">
		<div>
			<span class="section-eyebrow"><?php esc_html_e( 'Testimonials', 'blogtechu-custom' ); ?></span>
			<h2 class="services-title"><?php echo wp_kses( __( 'What Our <em>Clients Say</em>', 'blogtechu-custom' ), array( 'em' => array() ) ); ?></h2>
		</div>
		<p class="section-subtitle max-w-md"><?php esc_html_e( 'Real results and partnerships that speak for themselves.', 'blogtechu-custom' ); ?></p>
	</div>
	<div class="testi-grid">
		<?php
		$testimonials = array(
			array( 'initials' => 'RK', 'name' => __( 'Rohan Kapoor', 'blogtechu-custom' ), 'role' => __( 'Founder, RetailHub', 'blogtechu-custom' ), 'quote' => __( 'They rebuilt our store and conversions jumped 38% in two months. Communication was clear and delivery was on time, every sprint.', 'blogtechu-custom' ) ),
			array( 'initials' => 'SM', 'name' => __( 'Sara Mathew', 'blogtechu-custom' ), 'role' => __( 'CTO, FinEdge', 'blogtechu-custom' ), 'quote' => __( 'The team feels like an extension of ours. Their MERN expertise and AWS setup handled our scale flawlessly during launch.', 'blogtechu-custom' ) ),
			array( 'initials' => 'AD', 'name' => __( 'Arjun Desai', 'blogtechu-custom' ), 'role' => __( 'CEO, LearnLoop (EdTech)', 'blogtechu-custom' ), 'quote' => __( 'From MVP to a full platform with 50k users — they guided the architecture and never missed a deadline. Highly recommended.', 'blogtechu-custom' ) ),
		);
		foreach ( $testimonials as $t ) :
			?>
			<div class="testi-card">
				<div class="testi-stars">★★★★★</div>
				<p class="testi-quote">&ldquo;<?php echo esc_html( $t['quote'] ); ?>&rdquo;</p>
				<div class="testi-author">
					<span class="testi-avatar"><?php echo esc_html( $t['initials'] ); ?></span>
					<span>
						<span class="testi-name block"><?php echo esc_html( $t['name'] ); ?></span>
						<span class="testi-role block"><?php echo esc_html( $t['role'] ); ?></span>
					</span>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
</section>
<?php endif; ?>

<!-- Pricing -->
<section class="pricing-section">
	<div class="services-head">
		<div>
			<span class="section-eyebrow"><?php esc_html_e( 'Pricing', 'blogtechu-custom' ); ?></span>
			<h2 class="services-title"><?php echo wp_kses( __( 'Simple, <em>transparent plans</em>', 'blogtechu-custom' ), array( 'em' => array() ) ); ?></h2>
		</div>
		<p class="section-subtitle max-w-md"><?php esc_html_e( 'Flexible packages for every stage of growth. Need something custom? Just reach out.', 'blogtechu-custom' ); ?></p>
	</div>

	<div class="pricing-grid">
		<?php
		$plans = array(
			array(
				'name'     => __( 'Starter', 'blogtechu-custom' ),
				'price'    => __( 'From $499', 'blogtechu-custom' ),
				'period'   => __( '/ project', 'blogtechu-custom' ),
				'desc'     => __( 'Perfect for small businesses getting online.', 'blogtechu-custom' ),
				'featured' => false,
				'features' => array(
					__( '5-page responsive website', 'blogtechu-custom' ),
					__( 'Mobile-friendly design', 'blogtechu-custom' ),
					__( 'Basic SEO setup', 'blogtechu-custom' ),
					__( '2 rounds of revisions', 'blogtechu-custom' ),
					__( '1 month free support', 'blogtechu-custom' ),
				),
			),
			array(
				'name'     => __( 'Growth', 'blogtechu-custom' ),
				'price'    => __( 'From $1,299', 'blogtechu-custom' ),
				'period'   => __( '/ project', 'blogtechu-custom' ),
				'desc'     => __( 'For growing brands that need more power.', 'blogtechu-custom' ),
				'featured' => true,
				'features' => array(
					__( 'Up to 15 custom pages', 'blogtechu-custom' ),
					__( 'CMS / WordPress integration', 'blogtechu-custom' ),
					__( 'Advanced SEO & speed tuning', 'blogtechu-custom' ),
					__( 'E-commerce ready', 'blogtechu-custom' ),
					__( '3 months priority support', 'blogtechu-custom' ),
				),
			),
			array(
				'name'     => __( 'Enterprise', 'blogtechu-custom' ),
				'price'    => __( 'Custom', 'blogtechu-custom' ),
				'period'   => '',
				'desc'     => __( 'Tailored solutions for large-scale needs.', 'blogtechu-custom' ),
				'featured' => false,
				'features' => array(
					__( 'Unlimited pages & features', 'blogtechu-custom' ),
					__( 'Custom web / app development', 'blogtechu-custom' ),
					__( 'Dedicated project manager', 'blogtechu-custom' ),
					__( 'Marketing & growth strategy', 'blogtechu-custom' ),
					__( '12 months premium support', 'blogtechu-custom' ),
				),
			),
		);
		foreach ( $plans as $plan ) :
			?>
			<div class="price-card <?php echo $plan['featured'] ? 'is-featured' : ''; ?>">
				<?php if ( $plan['featured'] ) : ?>
					<span class="price-flag"><?php esc_html_e( 'Most Popular', 'blogtechu-custom' ); ?></span>
				<?php endif; ?>
				<span class="price-name"><?php echo esc_html( $plan['name'] ); ?></span>
				<div class="price-amount"><?php echo esc_html( $plan['price'] ); ?> <span><?php echo esc_html( $plan['period'] ); ?></span></div>
				<p class="price-desc"><?php echo esc_html( $plan['desc'] ); ?></p>
				<ul class="price-features">
					<?php foreach ( $plan['features'] as $feature ) : ?>
						<li><?php echo esc_html( $feature ); ?></li>
					<?php endforeach; ?>
				</ul>
				<a class="price-cta" href="<?php echo esc_url( $contact_url ); ?>"><?php esc_html_e( 'Choose Plan', 'blogtechu-custom' ); ?></a>
			</div>
		<?php endforeach; ?>
	</div>
</section>

<!-- Trust strip -->
<div class="my-4">
	<div class="trust-strip">
		<div class="trust-item">
			<div class="trust-item-icon">🛡️</div>
			<div><div class="trust-item-title"><?php esc_html_e( 'Quality-First Approach', 'blogtechu-custom' ); ?></div><div class="trust-item-desc"><?php esc_html_e( 'In Everything We Build', 'blogtechu-custom' ); ?></div></div>
		</div>
		<div class="trust-item">
			<div class="trust-item-icon">⭐</div>
			<div><div class="trust-item-title"><?php esc_html_e( 'Modern Tech Stack', 'blogtechu-custom' ); ?></div><div class="trust-item-desc"><?php esc_html_e( 'Future-Ready Solutions', 'blogtechu-custom' ); ?></div></div>
		</div>
		<div class="trust-item">
			<div class="trust-item-icon">🎧</div>
			<div><div class="trust-item-title"><?php esc_html_e( '24/7 Support', 'blogtechu-custom' ); ?></div><div class="trust-item-desc"><?php esc_html_e( "We're Here to Help", 'blogtechu-custom' ); ?></div></div>
		</div>
		<div class="trust-item">
			<div class="trust-item-icon">🔒</div>
			<div><div class="trust-item-title"><?php esc_html_e( 'Secure & Reliable', 'blogtechu-custom' ); ?></div><div class="trust-item-desc"><?php esc_html_e( 'Your Success, Our Priority', 'blogtechu-custom' ); ?></div></div>
		</div>
	</div>
</div>

<!-- FAQ -->
<section class="faq-section">
	<div class="text-center">
		<span class="section-eyebrow"><?php esc_html_e( 'FAQ', 'blogtechu-custom' ); ?></span>
		<h2 class="services-title"><?php esc_html_e( 'Frequently asked questions', 'blogtechu-custom' ); ?></h2>
	</div>

	<div class="faq-list">
		<?php
		$faqs = array(
			array( 'q' => __( 'How long does a typical project take?', 'blogtechu-custom' ), 'a' => __( 'Most websites launch within 2–6 weeks depending on scope. After our first call we give you a clear timeline with milestones, so you always know what to expect.', 'blogtechu-custom' ) ),
			array( 'q' => __( 'Do you offer ongoing support after launch?', 'blogtechu-custom' ), 'a' => __( 'Yes. Every plan includes a free support period, and we offer affordable monthly maintenance packages for updates, security and improvements.', 'blogtechu-custom' ) ),
			array( 'q' => __( 'Can you redesign my existing website?', 'blogtechu-custom' ), 'a' => __( 'Absolutely. We can modernize your current site, improve performance and SEO, and migrate your content without losing your existing rankings.', 'blogtechu-custom' ) ),
			array( 'q' => __( 'What technologies do you work with?', 'blogtechu-custom' ), 'a' => __( 'We work across WordPress, Shopify, modern JavaScript frameworks and custom stacks — always choosing the right tool for your goals and budget.', 'blogtechu-custom' ) ),
			array( 'q' => __( 'How do payments work?', 'blogtechu-custom' ), 'a' => __( 'We typically split projects into milestones with a deposit to start. For custom and enterprise work we tailor a payment schedule that fits your needs.', 'blogtechu-custom' ) ),
		);
		foreach ( $faqs as $i => $faq ) :
			?>
			<details class="faq-item" <?php echo 0 === $i ? 'open' : ''; ?>>
				<summary class="faq-q"><?php echo esc_html( $faq['q'] ); ?></summary>
				<div class="faq-a"><?php echo esc_html( $faq['a'] ); ?></div>
			</details>
		<?php endforeach; ?>
	</div>
</section>

<!-- Closing CTA -->
<section class="cta-banner">
	<div class="cta-banner-grid">
		<span class="cta-banner-icon">🚀</span>
		<div>
			<h2 class="cta-banner-title"><?php esc_html_e( 'Ready to start your project?', 'blogtechu-custom' ); ?></h2>
			<p class="cta-banner-text"><?php esc_html_e( "Tell us about your idea and we'll get back to you within 24 hours with a free, no-obligation quote.", 'blogtechu-custom' ); ?></p>
		</div>
		<a class="cta-banner-button" href="<?php echo esc_url( $contact_url ); ?>"><?php esc_html_e( "Let's Talk", 'blogtechu-custom' ); ?></a>
	</div>
</section>

<?php
get_footer();
