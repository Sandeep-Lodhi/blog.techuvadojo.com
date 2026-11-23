<?php
/**
 * AJAX handler for the "Let's Talk" quick-enquiry modal in the header.
 * Validates a nonce, sanitizes input, blocks bots via honeypot and emails the
 * enquiry to the site admin. Returns JSON for the front-end to display inline.
 *
 * @package Blogtechu_Custom
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function blogtechu_lets_talk_handler() {
	check_ajax_referer( 'blogtechu_lets_talk', 'nonce' );

	$name    = isset( $_POST['name'] ) ? sanitize_text_field( wp_unslash( $_POST['name'] ) ) : '';
	$email   = isset( $_POST['email'] ) ? sanitize_email( wp_unslash( $_POST['email'] ) ) : '';
	$phone   = isset( $_POST['phone'] ) ? sanitize_text_field( wp_unslash( $_POST['phone'] ) ) : '';
	$topic   = isset( $_POST['subject'] ) ? sanitize_text_field( wp_unslash( $_POST['subject'] ) ) : '';
	$message = isset( $_POST['message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['message'] ) ) : '';
	$hp      = isset( $_POST['website'] ) ? trim( wp_unslash( $_POST['website'] ) ) : '';

	// Honeypot caught a bot — pretend success.
	if ( '' !== $hp ) {
		wp_send_json_success( array( 'message' => __( 'Thank you! Your message has been sent.', 'blogtechu-custom' ) ) );
	}

	if ( '' === $name || ! is_email( $email ) || '' === $message ) {
		wp_send_json_error( array( 'message' => __( 'Please add your name, a valid email and a message.', 'blogtechu-custom' ) ) );
	}

	$to      = get_option( 'admin_email' );
	$subject = $topic
		? sprintf( /* translators: 1: subject, 2: sender name */ __( '%1$s — enquiry from %2$s', 'blogtechu-custom' ), $topic, $name )
		: sprintf( /* translators: %s: sender name */ __( 'New "Let\'s Talk" enquiry from %s', 'blogtechu-custom' ), $name );
	$body = sprintf(
		/* translators: 1: name, 2: email, 3: phone, 4: subject, 5: message */
		__( "New quick enquiry from the website header.\n\nName: %1\$s\nEmail: %2\$s\nPhone: %3\$s\nSubject: %4\$s\n\nMessage:\n%5\$s", 'blogtechu-custom' ),
		$name,
		$email,
		$phone ? $phone : __( 'Not provided', 'blogtechu-custom' ),
		$topic ? $topic : __( 'Not provided', 'blogtechu-custom' ),
		$message
	);
	$headers = array(
		'Content-Type: text/plain; charset=UTF-8',
		sprintf( 'Reply-To: %s <%s>', $name, $email ),
	);

	$sent = wp_mail( $to, '[' . get_bloginfo( 'name' ) . '] ' . $subject, $body, $headers );

	if ( $sent ) {
		wp_send_json_success( array( 'message' => __( "Thank you! Your message has been sent — we'll reply within 24 hours.", 'blogtechu-custom' ) ) );
	}

	wp_send_json_error( array( 'message' => __( 'Sorry, something went wrong. Please email us directly.', 'blogtechu-custom' ) ) );
}
add_action( 'wp_ajax_blogtechu_lets_talk', 'blogtechu_lets_talk_handler' );
add_action( 'wp_ajax_nopriv_blogtechu_lets_talk', 'blogtechu_lets_talk_handler' );
