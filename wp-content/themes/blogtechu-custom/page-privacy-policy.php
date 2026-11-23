<?php
/**
 * Template for the Privacy Policy page (auto-loaded for the page slug "privacy-policy").
 *
 * Hero with shield illustration, sticky "On This Page" TOC + help box, and a
 * numbered, icon-led policy body. Content is generic/standard policy copy —
 * have it reviewed by counsel before relying on it.
 *
 * @package Blogtechu_Custom
 */

get_header();

$contact_url  = home_url( '/contact' );
$last_updated = 'May 20, 2024';

/* Small inline icon helper. */
$pp_icon = function ( $name ) {
	$icons = array(
		'collect'  => '<path d="M12 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8z"/><path d="M5 20a7 7 0 0 1 14 0"/>',
		'use'      => '<rect x="4" y="4" width="16" height="16" rx="2"/><path d="M8 9h8M8 13h8M8 17h5"/>',
		'share'    => '<circle cx="18" cy="5" r="3"/><circle cx="6" cy="12" r="3"/><circle cx="18" cy="19" r="3"/><path d="M8.6 13.5l6.8 4M15.4 6.5l-6.8 4"/>',
		'cookies'  => '<path d="M12 3a9 9 0 1 0 9 9 4 4 0 0 1-4-4 4 4 0 0 1-4-4 .9.9 0 0 0-1-1z"/><circle cx="9" cy="11" r="1"/><circle cx="14" cy="14" r="1"/><circle cx="13" cy="8" r="1"/>',
		'security' => '<path d="M12 3l8 3v5c0 5-3.5 8-8 10-4.5-2-8-5-8-10V6z"/><path d="M9 12l2 2 4-4"/>',
		'rights'   => '<path d="M12 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8z"/><path d="M5 20a7 7 0 0 1 11-5.7"/><circle cx="18" cy="18" r="3"/>',
		'links'    => '<path d="M10 13a5 5 0 0 0 7 0l2-2a5 5 0 0 0-7-7l-1 1"/><path d="M14 11a5 5 0 0 0-7 0l-2 2a5 5 0 0 0 7 7l1-1"/>',
		'children' => '<circle cx="12" cy="12" r="9"/><path d="M9 10h.01M15 10h.01M9 15a4 4 0 0 0 6 0"/>',
		'changes'  => '<path d="M12 20h9"/><path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4z"/>',
		'contact'  => '<rect x="3" y="5" width="18" height="14" rx="2"/><path d="M3 7l9 6 9-6"/>',
	);
	$inner = isset( $icons[ $name ] ) ? $icons[ $name ] : $icons['use'];
	return '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">' . $inner . '</svg>';
};

/* The full policy, in order. body = ready-to-print HTML. */
$pp_sections = array(
	array(
		'id'    => 'information-we-collect',
		'icon'  => 'collect',
		'title' => 'Information We Collect',
		'body'  => '<p>We collect information that you provide directly to us and information we collect automatically when you use our website or services.</p>
			<ul class="pp-list">
				<li><strong>Personal Information:</strong> name, email address, phone number, company name, etc.</li>
				<li><strong>Usage Data:</strong> IP address, browser type, pages visited, time spent, and other analytics.</li>
			</ul>',
	),
	array(
		'id'    => 'how-we-use',
		'icon'  => 'use',
		'title' => 'How We Use Your Information',
		'body'  => '<p>We use the information we collect to:</p>
			<ul class="pp-list pp-list-dot">
				<li>Provide, operate, and maintain our services</li>
				<li>Communicate with you and respond to inquiries</li>
				<li>Improve our website, services, and user experience</li>
				<li>Send you updates, offers, and newsletters (you can opt out anytime)</li>
			</ul>',
	),
	array(
		'id'    => 'how-we-share',
		'icon'  => 'share',
		'title' => 'How We Share Your Information',
		'body'  => '<p>We do not sell or rent your personal data. We may share your information with:</p>
			<ul class="pp-list pp-list-dot">
				<li>Trusted service providers who help us operate our website and services</li>
				<li>Legal authorities when required by law or to protect our rights</li>
				<li>Business partners with your consent</li>
			</ul>',
	),
	array(
		'id'    => 'cookies',
		'icon'  => 'cookies',
		'title' => 'Cookies &amp; Tracking Technologies',
		'body'  => '<p>We use cookies and similar technologies to enhance your experience, analyze site traffic, and understand user behavior. You can manage your cookie preferences in your browser settings.</p>',
	),
	array(
		'id'    => 'data-security',
		'icon'  => 'security',
		'title' => 'Data Security',
		'body'  => '<p>We implement industry-standard security measures to protect your data. However, no online transmission is 100% secure.</p>',
	),
	array(
		'id'    => 'your-rights',
		'icon'  => 'rights',
		'title' => 'Your Rights &amp; Choices',
		'body'  => '<p>You have the right to access, update, or delete your personal information. You can also opt out of marketing communications at any time.</p>',
	),
	array(
		'id'    => 'third-party-links',
		'icon'  => 'links',
		'title' => 'Third-Party Links',
		'body'  => '<p>Our website may contain links to third-party websites. We are not responsible for the privacy practices or content of those sites.</p>',
	),
	array(
		'id'    => 'childrens-privacy',
		'icon'  => 'children',
		'title' => 'Children&rsquo;s Privacy',
		'body'  => '<p>Our services are not intended for children under 13. We do not knowingly collect personal information from children.</p>',
	),
	array(
		'id'    => 'changes',
		'icon'  => 'changes',
		'title' => 'Changes to This Policy',
		'body'  => '<p>We may update this Privacy Policy from time to time. We will post the updated policy on this page with a revised &ldquo;Last updated&rdquo; date.</p>',
	),
	array(
		'id'    => 'contact-us',
		'icon'  => 'contact',
		'title' => 'Contact Us',
		'body'  => '<p>If you have any questions about this Privacy Policy or our data practices, please contact us:</p>
			<ul class="pp-contact-list">
				<li><span class="pp-contact-ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="5" y="3" width="14" height="18" rx="1"/><path d="M9 7h2M13 7h2M9 11h2M13 11h2M9 15h2M13 15h2"/></svg></span> TechuvaDojo Pvt. Ltd.</li>
				<li><span class="pp-contact-ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 21s7-5.5 7-11a7 7 0 1 0-14 0c0 5.5 7 11 7 11z"/><circle cx="12" cy="10" r="2.5"/></svg></span> 123, Tech Park, Sector 12, Noida, Uttar Pradesh, India - 201301</li>
				<li><span class="pp-contact-ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="M3 7l9 6 9-6"/></svg></span> <a href="mailto:hello@techuvadojo.com">hello@techuvadojo.com</a></li>
				<li><span class="pp-contact-ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3 19.5 19.5 0 0 1-6-6 19.8 19.8 0 0 1-3.1-8.7A2 2 0 0 1 4.1 2h3a2 2 0 0 1 2 1.7c.1.9.3 1.8.7 2.6a2 2 0 0 1-.5 2.1L8.1 9.6a16 16 0 0 0 6 6l1.2-1.2a2 2 0 0 1 2.1-.5c.8.3 1.7.6 2.6.7a2 2 0 0 1 1.7 2z"/></svg></span> <a href="tel:+919876543210">+91 98765 43210</a></li>
			</ul>',
	),
);
?>

<!-- Hero -->
<section class="pp-hero">
	<div class="pp-hero-inner">
		<div class="pp-hero-content">
			<span class="pp-hero-eyebrow">
				<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 3l8 3v5c0 5-3.5 8-8 10-4.5-2-8-5-8-10V6z"/><path d="M9 12l2 2 4-4"/></svg>
				<?php esc_html_e( 'Privacy Policy', 'blogtechu-custom' ); ?>
			</span>
			<h1 class="pp-hero-title">
				<?php esc_html_e( 'Your Privacy.', 'blogtechu-custom' ); ?><br>
				<?php esc_html_e( 'Our', 'blogtechu-custom' ); ?> <em><?php esc_html_e( 'Responsibility.', 'blogtechu-custom' ); ?></em>
			</h1>
			<p class="pp-hero-text"><?php esc_html_e( 'At TechuvaDojo, we value your trust and are committed to protecting your personal information. This Privacy Policy explains how we collect, use, disclose, and safeguard your data when you interact with our website and services.', 'blogtechu-custom' ); ?></p>
			<p class="pp-hero-updated"><?php printf( esc_html__( 'Last updated: %s', 'blogtechu-custom' ), esc_html( $last_updated ) ); ?></p>
		</div>

		<div class="pp-hero-visual" aria-hidden="true">
			<?php $pp_hero_svg = get_theme_file_uri( '/assets/images/privacy-hero.svg' ); $pp_hero_ver = filemtime( get_theme_file_path( '/assets/images/privacy-hero.svg' ) ); ?>
			<img class="pp-hero-img" src="<?php echo esc_url( add_query_arg( 'v', $pp_hero_ver, $pp_hero_svg ) ); ?>" alt="" loading="eager" decoding="async" />
		</div>
	</div>
</section>

<!-- Body -->
<section class="pp-body">
	<div class="pp-layout">

		<!-- Sidebar -->
		<aside class="pp-sidebar">
			<nav class="pp-toc" aria-label="<?php esc_attr_e( 'On this page', 'blogtechu-custom' ); ?>">
				<h2 class="pp-toc-title"><?php esc_html_e( 'On This Page', 'blogtechu-custom' ); ?></h2>
				<ol class="pp-toc-list">
					<?php foreach ( $pp_sections as $i => $s ) : ?>
						<li><a class="pp-toc-link<?php echo 0 === $i ? ' is-active' : ''; ?>" href="#<?php echo esc_attr( $s['id'] ); ?>"><?php echo ( $i + 1 ) . '. ' . esc_html( wp_strip_all_tags( html_entity_decode( $s['title'] ) ) ); ?></a></li>
					<?php endforeach; ?>
				</ol>
			</nav>

			<div class="pp-help">
				<span class="pp-help-icon">
					<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 3l8 3v5c0 5-3.5 8-8 10-4.5-2-8-5-8-10V6z"/></svg>
					<strong><?php esc_html_e( 'We&rsquo;re Here to Help', 'blogtechu-custom' ); ?></strong>
				</span>
				<p class="pp-help-text"><?php esc_html_e( 'If you have any questions about this Privacy Policy or our data practices, feel free to reach out to us.', 'blogtechu-custom' ); ?></p>
				<a class="pp-help-btn" href="<?php echo esc_url( $contact_url ); ?>"><?php esc_html_e( 'Contact Us', 'blogtechu-custom' ); ?> <span aria-hidden="true">→</span></a>
			</div>
		</aside>

		<!-- Main -->
		<div class="pp-main">
			<p class="pp-intro"><?php esc_html_e( 'This Privacy Policy describes how TechuvaDojo Pvt. Ltd. (“we”, “our”, or “us”) collects, uses, and shares information about you when you visit our website or use our services.', 'blogtechu-custom' ); ?></p>

			<?php foreach ( $pp_sections as $i => $s ) : ?>
				<article class="pp-section" id="<?php echo esc_attr( $s['id'] ); ?>">
					<span class="pp-section-icon"><?php echo $pp_icon( $s['icon'] ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span>
					<div class="pp-section-body">
						<h2 class="pp-section-title"><?php echo ( $i + 1 ) . '. ' . wp_kses( $s['title'], array() ); ?></h2>
						<?php echo $s['body']; // phpcs:ignore WordPress.Security.EscapeOutput — trusted static markup with inline SVG icons. ?>
					</div>
				</article>
			<?php endforeach; ?>
		</div>

	</div>
</section>

<?php
get_footer();
