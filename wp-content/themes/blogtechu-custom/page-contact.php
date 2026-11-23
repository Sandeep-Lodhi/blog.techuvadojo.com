<?php
/**
 * Template for the Contact page (auto-loaded for the page with slug "contact").
 *
 * Modern contact page matching the brand reference: dark hero with paper-plane
 * illustration + trust chips, a working contact form (nonce-protected,
 * sanitized, wp_mail) beside a contact-information card, a help + map block,
 * and an FAQ / partnership banner.
 *
 * @package Blogtechu_Custom
 */

/* ---- Handle form submission (before any output) ---- */
$ct_status  = '';
$ct_message = '';
$ct_values  = array(
	'name'    => '',
	'email'   => '',
	'subject' => '',
	'message' => '',
);

if ( 'POST' === $_SERVER['REQUEST_METHOD'] && isset( $_POST['ct_contact_submit'] ) ) {
	if ( ! isset( $_POST['ct_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['ct_nonce'] ) ), 'ct_contact_form' ) ) {
		$ct_status  = 'error';
		$ct_message = __( 'Security check failed. Please refresh the page and try again.', 'blogtechu-custom' );
	} else {
		$ct_values['name']    = isset( $_POST['ct_name'] ) ? sanitize_text_field( wp_unslash( $_POST['ct_name'] ) ) : '';
		$ct_values['email']   = isset( $_POST['ct_email'] ) ? sanitize_email( wp_unslash( $_POST['ct_email'] ) ) : '';
		$ct_values['subject'] = isset( $_POST['ct_subject'] ) ? sanitize_text_field( wp_unslash( $_POST['ct_subject'] ) ) : '';
		$ct_values['message'] = isset( $_POST['ct_message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['ct_message'] ) ) : '';
		$ct_hp                = isset( $_POST['ct_website'] ) ? trim( wp_unslash( $_POST['ct_website'] ) ) : '';

		if ( '' !== $ct_hp ) {
			// Honeypot filled — silently treat as success to fool bots.
			$ct_status  = 'success';
			$ct_message = __( 'Thank you! Your message has been sent.', 'blogtechu-custom' );
		} elseif ( '' === $ct_values['name'] || '' === $ct_values['message'] || ! is_email( $ct_values['email'] ) ) {
			$ct_status  = 'error';
			$ct_message = __( 'Please fill in your name, a valid email and a message.', 'blogtechu-custom' );
		} else {
			$to      = get_option( 'admin_email' );
			$subject = $ct_values['subject'] ? $ct_values['subject'] : __( 'New contact form message', 'blogtechu-custom' );
			$body    = sprintf(
				/* translators: 1: name, 2: email, 3: message */
				__( "You received a new message from your website contact form.\n\nName: %1\$s\nEmail: %2\$s\n\nMessage:\n%3\$s", 'blogtechu-custom' ),
				$ct_values['name'],
				$ct_values['email'],
				$ct_values['message']
			);
			$headers = array(
				'Content-Type: text/plain; charset=UTF-8',
				sprintf( 'Reply-To: %s <%s>', $ct_values['name'], $ct_values['email'] ),
			);

			$sent = wp_mail( $to, '[' . get_bloginfo( 'name' ) . '] ' . $subject, $body, $headers );

			if ( $sent ) {
				$ct_status  = 'success';
				$ct_message = __( "Thank you! Your message has been sent — we'll get back to you within 24 hours.", 'blogtechu-custom' );
				$ct_values  = array( 'name' => '', 'email' => '', 'subject' => '', 'message' => '' );
			} else {
				$ct_status  = 'error';
				$ct_message = __( 'Sorry, something went wrong sending your message. Please email us directly.', 'blogtechu-custom' );
			}
		}
	}
}

get_header();

$email_addr  = 'hello@techuvadojo.com';
$phone_no    = '+91 98765 43210';
$whatsapp_no = '+91 98765 43210';
$map_query   = 'Tech Park, Sector 12, Noida, Uttar Pradesh 201301';
$faq_url     = home_url( '/#faq' );
?>

<!-- Hero -->
<section class="cu-hero">
	<div class="cu-hero-inner">
		<div class="cu-hero-content">
			<nav class="cu-crumb" aria-label="<?php esc_attr_e( 'Breadcrumb', 'blogtechu-custom' ); ?>">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'blogtechu-custom' ); ?></a>
				<span aria-hidden="true">›</span>
				<span class="cu-crumb-current"><?php esc_html_e( 'Contact', 'blogtechu-custom' ); ?></span>
			</nav>

			<h1 class="cu-hero-title">
				<?php echo wp_kses( __( "Let&#39;s Build Something Amazing <em>Together</em>", 'blogtechu-custom' ), array( 'em' => array() ) ); ?>
			</h1>
			<p class="cu-hero-text"><?php esc_html_e( "Have a project in mind or just want to say hello? We'd love to hear from you. Reach out to us and we'll get back to you as soon as possible.", 'blogtechu-custom' ); ?></p>

			<div class="cu-hero-features">
				<div class="cu-feature">
					<span class="cu-feature-ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3l8 3v5c0 5-3.5 8-8 10-4.5-2-8-5-8-10V6z"/><path d="M9 12l2 2 4-4"/></svg></span>
					<span><strong><?php esc_html_e( 'Quick Response', 'blogtechu-custom' ); ?></strong><em><?php esc_html_e( 'We reply within 24 hours', 'blogtechu-custom' ); ?></em></span>
				</div>
				<div class="cu-feature">
					<span class="cu-feature-ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="4"/><path d="M5 20a7 7 0 0 1 14 0"/></svg></span>
					<span><strong><?php esc_html_e( 'Trusted Partner', 'blogtechu-custom' ); ?></strong><em><?php esc_html_e( 'Quality-first delivery', 'blogtechu-custom' ); ?></em></span>
				</div>
				<div class="cu-feature">
					<span class="cu-feature-ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="M3 12h18M12 3a15 15 0 0 1 0 18M12 3a15 15 0 0 0 0 18"/></svg></span>
					<span><strong><?php esc_html_e( 'Global Support', 'blogtechu-custom' ); ?></strong><em><?php esc_html_e( "We're here for you", 'blogtechu-custom' ); ?></em></span>
				</div>
			</div>
		</div>

		<div class="cu-hero-visual" aria-hidden="true">
			<?php $cu_svg = get_theme_file_uri( '/assets/images/contact-hero.svg' ); $cu_ver = filemtime( get_theme_file_path( '/assets/images/contact-hero.svg' ) ); ?>
			<img class="cu-hero-img" src="<?php echo esc_url( add_query_arg( 'v', $cu_ver, $cu_svg ) ); ?>" alt="" loading="eager" decoding="async" />
		</div>
	</div>
</section>

<!-- Form + Info -->
<section class="cu-main">
	<div class="cu-grid">

		<!-- Form -->
		<div class="cu-form-card">
			<h2 class="cu-card-title"><?php esc_html_e( 'Send Us a Message', 'blogtechu-custom' ); ?></h2>
			<p class="cu-card-sub"><?php esc_html_e( "Fill out the form below and we'll get back to you shortly.", 'blogtechu-custom' ); ?></p>

			<?php if ( $ct_message ) : ?>
				<div class="cu-alert <?php echo 'success' === $ct_status ? 'cu-alert-success' : 'cu-alert-error'; ?>" role="alert">
					<?php echo esc_html( $ct_message ); ?>
				</div>
			<?php endif; ?>

			<form class="cu-form" method="post" action="<?php echo esc_url( get_permalink() ); ?>#contact-form" id="contact-form" novalidate>
				<?php wp_nonce_field( 'ct_contact_form', 'ct_nonce' ); ?>

				<div class="cu-row">
					<div class="cu-field">
						<span class="cu-input-ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="4"/><path d="M5 20a7 7 0 0 1 14 0"/></svg></span>
						<input class="cu-input" type="text" name="ct_name" value="<?php echo esc_attr( $ct_values['name'] ); ?>" placeholder="<?php esc_attr_e( 'Your Name', 'blogtechu-custom' ); ?>" required />
					</div>
					<div class="cu-field">
						<span class="cu-input-ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="M3 7l9 6 9-6"/></svg></span>
						<input class="cu-input" type="email" name="ct_email" value="<?php echo esc_attr( $ct_values['email'] ); ?>" placeholder="<?php esc_attr_e( 'Your Email', 'blogtechu-custom' ); ?>" required />
					</div>
				</div>

				<div class="cu-field">
					<span class="cu-input-ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M4 6h16M4 6v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6M8 3v4M16 3v4"/></svg></span>
					<input class="cu-input" type="text" name="ct_subject" value="<?php echo esc_attr( $ct_values['subject'] ); ?>" placeholder="<?php esc_attr_e( 'Subject', 'blogtechu-custom' ); ?>" />
				</div>

				<div class="cu-field">
					<textarea class="cu-textarea" name="ct_message" rows="6" placeholder="<?php esc_attr_e( 'Tell us about your project', 'blogtechu-custom' ); ?>" required><?php echo esc_textarea( $ct_values['message'] ); ?></textarea>
				</div>

				<?php // Honeypot — hidden from humans. ?>
				<div style="position:absolute;left:-9999px;" aria-hidden="true">
					<label for="ct_website"><?php esc_html_e( 'Website', 'blogtechu-custom' ); ?></label>
					<input type="text" id="ct_website" name="ct_website" tabindex="-1" autocomplete="off" />
				</div>

				<button class="cu-submit" type="submit" name="ct_contact_submit" value="1"><?php esc_html_e( 'Send Message', 'blogtechu-custom' ); ?> <span aria-hidden="true">→</span></button>

				<p class="cu-privacy">
					<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 3l8 3v5c0 5-3.5 8-8 10-4.5-2-8-5-8-10V6z"/></svg>
					<?php esc_html_e( 'We respect your privacy. Your information will never be shared.', 'blogtechu-custom' ); ?>
				</p>
			</form>
		</div>

		<!-- Contact information -->
		<aside class="cu-info-card">
			<h2 class="cu-card-title"><?php esc_html_e( 'Contact Information', 'blogtechu-custom' ); ?></h2>
			<p class="cu-card-sub"><?php esc_html_e( 'Choose the best way to reach us.', 'blogtechu-custom' ); ?></p>

			<ul class="cu-info-list">
				<li>
					<span class="cu-info-ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="M3 7l9 6 9-6"/></svg></span>
					<span class="cu-info-text"><strong><?php esc_html_e( 'Email Us', 'blogtechu-custom' ); ?></strong><a href="mailto:<?php echo esc_attr( $email_addr ); ?>"><?php echo esc_html( $email_addr ); ?></a></span>
				</li>
				<li>
					<span class="cu-info-ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3 19.5 19.5 0 0 1-6-6 19.8 19.8 0 0 1-3.1-8.7A2 2 0 0 1 4.1 2h3a2 2 0 0 1 2 1.7c.1.9.3 1.8.7 2.6a2 2 0 0 1-.5 2.1L8.1 9.6a16 16 0 0 0 6 6l1.2-1.2a2 2 0 0 1 2.1-.5c.8.3 1.7.6 2.6.7a2 2 0 0 1 1.7 2z"/></svg></span>
					<span class="cu-info-text"><strong><?php esc_html_e( 'Call Us', 'blogtechu-custom' ); ?></strong><a href="tel:<?php echo esc_attr( preg_replace( '/\s+/', '', $phone_no ) ); ?>"><?php echo esc_html( $phone_no ); ?></a></span>
				</li>
				<li>
					<span class="cu-info-ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M21 11.5a8.4 8.4 0 0 1-12.3 7.5L3 21l2.1-5.6A8.4 8.4 0 1 1 21 11.5z"/><path d="M8.5 9.5c0 4 2 6 6 6"/></svg></span>
					<span class="cu-info-text"><strong><?php esc_html_e( 'WhatsApp', 'blogtechu-custom' ); ?></strong><a href="https://wa.me/<?php echo esc_attr( preg_replace( '/\D+/', '', $whatsapp_no ) ); ?>" target="_blank" rel="noopener"><?php echo esc_html( $whatsapp_no ); ?></a></span>
				</li>
				<li>
					<span class="cu-info-ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 21s7-5.5 7-11a7 7 0 1 0-14 0c0 5.5 7 11 7 11z"/><circle cx="12" cy="10" r="2.5"/></svg></span>
					<span class="cu-info-text"><strong><?php esc_html_e( 'Office Address', 'blogtechu-custom' ); ?></strong><span><?php esc_html_e( 'TechuvaDojo Pvt. Ltd.', 'blogtechu-custom' ); ?><br><?php esc_html_e( '123, Tech Park, Sector 12, Noida, Uttar Pradesh, India - 201301', 'blogtechu-custom' ); ?></span></span>
				</li>
				<li>
					<span class="cu-info-ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></svg></span>
					<span class="cu-info-text"><strong><?php esc_html_e( 'Working Hours', 'blogtechu-custom' ); ?></strong><span><?php esc_html_e( 'Mon - Sat: 9:00 AM - 7:00 PM', 'blogtechu-custom' ); ?><br><?php esc_html_e( 'Sunday: Closed', 'blogtechu-custom' ); ?></span></span>
				</li>
			</ul>
		</aside>

	</div>
</section>

<!-- Help + Map -->
<section class="cu-help">
	<div class="cu-help-grid">
		<div class="cu-help-text">
			<h2 class="cu-card-title"><?php esc_html_e( "We're Here to Help", 'blogtechu-custom' ); ?></h2>
			<p class="cu-card-sub"><?php esc_html_e( 'Whether you have a question about our services, pricing, or anything else, our team is ready to answer all your questions.', 'blogtechu-custom' ); ?></p>
			<ul class="cu-checklist">
				<li><?php esc_html_e( 'Get a free consultation', 'blogtechu-custom' ); ?></li>
				<li><?php esc_html_e( 'Discuss your project requirements', 'blogtechu-custom' ); ?></li>
				<li><?php esc_html_e( 'Receive a tailored proposal', 'blogtechu-custom' ); ?></li>
				<li><?php esc_html_e( 'Start your journey with us', 'blogtechu-custom' ); ?></li>
			</ul>
		</div>
		<div class="cu-map">
			<iframe
				title="<?php esc_attr_e( 'TechuvaDojo office location', 'blogtechu-custom' ); ?>"
				src="https://www.google.com/maps?q=<?php echo rawurlencode( $map_query ); ?>&output=embed"
				loading="lazy"
				referrerpolicy="no-referrer-when-downgrade"
				allowfullscreen></iframe>
		</div>
	</div>
</section>

<!-- FAQ / Partnership banner -->
<section class="cu-banner">
	<div class="cu-banner-grid">
		<div class="cu-banner-col">
			<span class="cu-banner-ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/><path d="M9.5 9a2.5 2.5 0 1 1 3.5 2.3c-.8.4-1 .9-1 1.7M12 16h.01"/></svg></span>
			<div>
				<h3 class="cu-banner-title"><?php esc_html_e( 'Have Questions?', 'blogtechu-custom' ); ?><br><?php echo wp_kses( __( "We've Got <em>Answers</em>", 'blogtechu-custom' ), array( 'em' => array() ) ); ?></h3>
				<p class="cu-banner-text"><?php esc_html_e( 'Check out our FAQ section for quick answers to common queries.', 'blogtechu-custom' ); ?></p>
				<a class="cu-banner-btn" href="<?php echo esc_url( $faq_url ); ?>"><?php esc_html_e( 'View FAQs', 'blogtechu-custom' ); ?> <span aria-hidden="true">→</span></a>
			</div>
		</div>

		<div class="cu-banner-col cu-banner-col-alt">
			<div>
				<h3 class="cu-banner-title"><?php esc_html_e( 'Looking for a Partnership?', 'blogtechu-custom' ); ?></h3>
				<p class="cu-banner-text"><?php esc_html_e( "Let's create something extraordinary together.", 'blogtechu-custom' ); ?></p>
				<a class="cu-banner-btn" href="mailto:<?php echo esc_attr( $email_addr ); ?>?subject=Partnership%20Enquiry"><?php esc_html_e( 'Become a Partner', 'blogtechu-custom' ); ?> <span aria-hidden="true">→</span></a>
			</div>
			<span class="cu-banner-ico cu-banner-ico-lg"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M8 13l3 3a2 2 0 0 0 3 0l5-5"/><path d="M3 8l4-4 5 5"/><path d="M21 8l-4-4-3 3"/><path d="M3 8v4l3 3M21 8v4l-2.5 2.5"/></svg></span>
		</div>
	</div>
</section>

<?php
get_footer();
