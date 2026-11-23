<?php
/**
 * Template for the Terms & Conditions page (auto-loaded for slug "terms-conditions").
 *
 * Reuses the Privacy Policy layout (pp-* classes): hero with document
 * illustration, sticky "On this page" TOC + help box, and a numbered,
 * icon-led body. Generic standard terms copy — have counsel review.
 *
 * @package Blogtechu_Custom
 */

get_header();

$contact_url  = home_url( '/contact' );
$last_updated = 'May 20, 2024';

/* Small inline icon helper. */
$tc_icon = function ( $name ) {
	$icons = array(
		'accept'   => '<path d="M8 13l3 3a2 2 0 0 0 3 0l5-5"/><path d="M3 8l4-4 5 5"/><path d="M21 8l-4-4-3 3"/><path d="M3 8v4l3 3M21 8v4l-2.5 2.5"/>',
		'services' => '<rect x="3" y="4" width="18" height="12" rx="2"/><path d="M8 20h8M12 16v4"/>',
		'user'     => '<circle cx="12" cy="8" r="4"/><path d="M5 20a7 7 0 0 1 14 0"/>',
		'ip'       => '<path d="M9.5 18h5M10 21h4"/><path d="M12 3a6 6 0 0 0-4 10.5c.7.7 1 1.4 1 2.5h6c0-1.1.3-1.8 1-2.5A6 6 0 0 0 12 3z"/>',
		'payments' => '<rect x="3" y="5" width="18" height="14" rx="2"/><path d="M3 10h18M7 15h3"/>',
		'lock'     => '<rect x="5" y="11" width="14" height="9" rx="2"/><path d="M8 11V8a4 4 0 0 1 8 0v3"/>',
		'shield'   => '<path d="M12 3l8 3v5c0 5-3.5 8-8 10-4.5-2-8-5-8-10V6z"/>',
		'shieldck' => '<path d="M12 3l8 3v5c0 5-3.5 8-8 10-4.5-2-8-5-8-10V6z"/><path d="M9 12l2 2 4-4"/>',
		'power'    => '<path d="M12 4v8"/><path d="M7.5 7a8 8 0 1 0 9 0"/>',
		'law'      => '<path d="M12 4v16M7 21h10M5 9h14"/><path d="M5 9l-2.2 5.2a3 3 0 0 0 6 0L7 9M19 9l-2.2 5.2a3 3 0 0 0 6 0L21 9"/><circle cx="12" cy="5" r="1.4"/>',
		'changes'  => '<path d="M4 12a8 8 0 0 1 13.7-5.7L20 8"/><path d="M20 4v4h-4"/><path d="M20 12a8 8 0 0 1-13.7 5.7L4 16"/><path d="M4 20v-4h4"/>',
		'contact'  => '<rect x="3" y="5" width="18" height="14" rx="2"/><path d="M3 7l9 6 9-6"/>',
	);
	$inner = isset( $icons[ $name ] ) ? $icons[ $name ] : $icons['services'];
	return '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">' . $inner . '</svg>';
};

/* The full terms, in order. */
$tc_sections = array(
	array(
		'id'    => 'acceptance',
		'icon'  => 'accept',
		'title' => 'Acceptance of Terms',
		'body'  => '<p>By accessing or using our website and services, you agree to comply with and be bound by these Terms &amp; Conditions. If you do not agree with any part of these terms, you must not use our services.</p>',
	),
	array(
		'id'    => 'services',
		'icon'  => 'services',
		'title' => 'Services',
		'body'  => '<p>TechuvaDojo provides digital solutions including web development, mobile app development, UI/UX design, digital marketing and other related services as described on our website.</p>',
	),
	array(
		'id'    => 'user-responsibilities',
		'icon'  => 'user',
		'title' => 'User Responsibilities',
		'body'  => '<p>You agree to provide accurate information when required and not to use our website or services for any unlawful purpose. You must not engage in any activity that disrupts or interferes with our services.</p>',
	),
	array(
		'id'    => 'intellectual-property',
		'icon'  => 'ip',
		'title' => 'Intellectual Property',
		'body'  => '<p>All content, designs, logos, texts, and materials on our website are the property of TechuvaDojo Pvt. Ltd. and are protected by copyright and intellectual property laws. You may not use, reproduce, or distribute our content without prior written permission.</p>',
	),
	array(
		'id'    => 'payments-refunds',
		'icon'  => 'payments',
		'title' => 'Payments &amp; Refunds',
		'body'  => '<p>All payments for our services must be made as agreed in the respective proposal or invoice. Refunds are subject to our Refund Policy.</p>',
	),
	array(
		'id'    => 'confidentiality',
		'icon'  => 'lock',
		'title' => 'Confidentiality',
		'body'  => '<p>We value your trust. Any confidential information shared with us will be kept secure and will not be disclosed to third parties without your consent, except as required by law.</p>',
	),
	array(
		'id'    => 'limitation-of-liability',
		'icon'  => 'shield',
		'title' => 'Limitation of Liability',
		'body'  => '<p>TechuvaDojo shall not be liable for any indirect, incidental, special, or consequential damages arising out of or related to the use of our services or website.</p>',
	),
	array(
		'id'    => 'indemnification',
		'icon'  => 'shieldck',
		'title' => 'Indemnification',
		'body'  => '<p>You agree to indemnify and hold harmless TechuvaDojo Pvt. Ltd. from any claims, damages, losses, or expenses arising from your use of our services or violation of these terms.</p>',
	),
	array(
		'id'    => 'termination',
		'icon'  => 'power',
		'title' => 'Termination',
		'body'  => '<p>We reserve the right to suspend or terminate your access to our services at any time without prior notice if we believe you have violated these Terms &amp; Conditions.</p>',
	),
	array(
		'id'    => 'governing-law',
		'icon'  => 'law',
		'title' => 'Governing Law',
		'body'  => '<p>These Terms &amp; Conditions shall be governed by and construed in accordance with the laws of India. Any disputes shall be subject to the exclusive jurisdiction of the courts in Noida, Uttar Pradesh.</p>',
	),
	array(
		'id'    => 'changes',
		'icon'  => 'changes',
		'title' => 'Changes to Terms',
		'body'  => '<p>We may modify these terms from time to time. The updated version will be posted on this page with the &ldquo;Last updated&rdquo; date. Your continued use of our services constitutes acceptance of the changes.</p>',
	),
	array(
		'id'    => 'contact-us',
		'icon'  => 'contact',
		'title' => 'Contact Us',
		'body'  => '<p>If you have any questions about these Terms &amp; Conditions, please contact us:</p>
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
				<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M9 12l2 2 4-4"/><path d="M12 3l8 3v5c0 5-3.5 8-8 10-4.5-2-8-5-8-10V6z"/></svg>
				<?php esc_html_e( 'Terms &amp; Conditions', 'blogtechu-custom' ); ?>
			</span>
			<h1 class="pp-hero-title">
				<?php esc_html_e( 'Terms &amp;', 'blogtechu-custom' ); ?> <em><?php esc_html_e( 'Conditions', 'blogtechu-custom' ); ?></em>
			</h1>
			<p class="pp-hero-text"><?php esc_html_e( 'These terms and conditions outline the rules and regulations for the use of TechuvaDojo Pvt. Ltd. website and services.', 'blogtechu-custom' ); ?></p>
			<p class="pp-hero-updated">
				<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" style="display:inline-block;width:1em;height:1em;vertical-align:-0.12em;margin-right:.35em;"><rect x="3" y="5" width="18" height="16" rx="2"/><path d="M3 9h18M8 3v4M16 3v4"/></svg>
				<?php printf( esc_html__( 'Last updated: %s', 'blogtechu-custom' ), esc_html( $last_updated ) ); ?>
			</p>
		</div>

		<div class="pp-hero-visual" aria-hidden="true">
			<?php $tc_hero_svg = get_theme_file_uri( '/assets/images/terms-hero.svg' ); $tc_hero_ver = filemtime( get_theme_file_path( '/assets/images/terms-hero.svg' ) ); ?>
			<img class="pp-hero-img" src="<?php echo esc_url( add_query_arg( 'v', $tc_hero_ver, $tc_hero_svg ) ); ?>" alt="" loading="eager" decoding="async" />
		</div>
	</div>
</section>

<!-- Body -->
<section class="pp-body">
	<div class="pp-layout">

		<!-- Sidebar -->
		<aside class="pp-sidebar">
			<nav class="pp-toc" aria-label="<?php esc_attr_e( 'On this page', 'blogtechu-custom' ); ?>">
				<h2 class="pp-toc-title"><?php esc_html_e( 'On this page', 'blogtechu-custom' ); ?></h2>
				<ol class="pp-toc-list">
					<?php foreach ( $tc_sections as $i => $s ) : ?>
						<li><a class="pp-toc-link<?php echo 0 === $i ? ' is-active' : ''; ?>" href="#<?php echo esc_attr( $s['id'] ); ?>"><?php echo ( $i + 1 ) . '. ' . esc_html( wp_strip_all_tags( html_entity_decode( $s['title'] ) ) ); ?></a></li>
					<?php endforeach; ?>
				</ol>
			</nav>

			<div class="pp-help">
				<span class="pp-help-icon">
					<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="9"/><path d="M9.5 9a2.5 2.5 0 1 1 3.5 2.3c-.8.4-1 .9-1 1.7M12 17h.01"/></svg>
					<strong><?php esc_html_e( 'Need Clarification?', 'blogtechu-custom' ); ?></strong>
				</span>
				<p class="pp-help-text"><?php esc_html_e( 'If you have any questions about these Terms &amp; Conditions, feel free to contact us.', 'blogtechu-custom' ); ?></p>
				<a class="pp-help-btn" href="<?php echo esc_url( $contact_url ); ?>"><?php esc_html_e( 'Contact Us', 'blogtechu-custom' ); ?> <span aria-hidden="true">→</span></a>
			</div>
		</aside>

		<!-- Main -->
		<div class="pp-main">
			<p class="pp-intro"><?php esc_html_e( 'Welcome to TechuvaDojo Pvt. Ltd. (“we”, “our”, “us”). By accessing or using our website and services, you agree to be bound by the following terms and conditions.', 'blogtechu-custom' ); ?></p>

			<?php foreach ( $tc_sections as $i => $s ) : ?>
				<article class="pp-section" id="<?php echo esc_attr( $s['id'] ); ?>">
					<span class="pp-section-icon"><?php echo $tc_icon( $s['icon'] ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span>
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
