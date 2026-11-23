<?php
/**
 * Job helpers: meta accessors, icon resolver, a shared card renderer and the
 * shared application-form handler (nonce-protected, sanitized, resume upload
 * via wp_mail) used by both the Careers landing page and single-job pages.
 *
 * @package Blogtechu_Custom
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Get a job meta value with a fallback.
 *
 * @param string $key     Meta key (without leading underscore handling).
 * @param mixed  $default Default value.
 * @param int    $post_id Optional job ID.
 * @return string
 */
function blogtechu_job_meta( $key, $default = '', $post_id = null ) {
	$post_id = $post_id ? $post_id : get_the_ID();
	$val     = get_post_meta( $post_id, '_job_' . $key, true );
	return ( '' !== $val && null !== $val ) ? $val : $default;
}

/**
 * First department name + slug for a job.
 *
 * @param int $post_id Optional job ID.
 * @return array{name:string,slug:string}
 */
function blogtechu_job_department( $post_id = null ) {
	$post_id = $post_id ? $post_id : get_the_ID();
	$terms   = get_the_terms( $post_id, 'job_department' );
	if ( $terms && ! is_wp_error( $terms ) ) {
		return array( 'name' => $terms[0]->name, 'slug' => $terms[0]->slug );
	}
	return array( 'name' => '', 'slug' => '' );
}

/**
 * Resolve a job icon SVG by key.
 *
 * @param string $name Icon key.
 * @return string
 */
function blogtechu_job_icon_svg( $name ) {
	$icons = array(
		'stack'  => '<path d="M12 2l9 5-9 5-9-5 9-5z"/><path d="M3 12l9 5 9-5M3 17l9 5 9-5"/>',
		'wp'     => '<circle cx="12" cy="12" r="9"/><path d="M6.5 9l2.2 6.5L11 9l2.3 6.5L15.5 9"/>',
		'design' => '<path d="M15 4l5 5L9 20l-5 1 1-5z"/><path d="M13 6l5 5"/>',
		'chart'  => '<path d="M3 3v18h18"/><path d="M7 14l3-3 3 3 5-6"/>',
		'video'  => '<rect x="3" y="6" width="13" height="12" rx="2"/><path d="M16 10l5-3v10l-5-3z"/>',
		'pm'     => '<rect x="6" y="4" width="12" height="16" rx="2"/><path d="M9.5 4h5v3h-5z"/><path d="M9 11h6M9 15h4"/>',
	);
	$inner = isset( $icons[ $name ] ) ? $icons[ $name ] : $icons['stack'];
	return '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">' . $inner . '</svg>';
}

/**
 * Render a single job card for the listing (call inside the loop).
 */
function blogtechu_render_job_card() {
	$dept = blogtechu_job_department();
	$type = blogtechu_job_meta( 'type', __( 'Full Time', 'blogtechu-custom' ) );
	$work = blogtechu_job_meta( 'work', __( 'Remote', 'blogtechu-custom' ) );
	$exp  = blogtechu_job_meta( 'exp', '' );
	$icon = blogtechu_job_meta( 'icon', 'stack' );
	$tone = blogtechu_job_meta( 'tone', 'blue' );
	$is_part = ( false !== stripos( $type, 'part' ) );
	$search  = strtolower( get_the_title() . ' ' . wp_strip_all_tags( get_the_excerpt() ) . ' ' . $dept['name'] );
	?>
	<article class="cr-job" data-cr-dept="<?php echo esc_attr( $dept['slug'] ); ?>" data-cr-title="<?php echo esc_attr( $search ); ?>">
		<span class="cr-job-ico cr-tone-<?php echo esc_attr( $tone ); ?>"><?php echo blogtechu_job_icon_svg( $icon ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span>
		<div class="cr-job-body">
			<div class="cr-job-top">
				<h3 class="cr-job-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
				<span class="cr-job-type <?php echo $is_part ? 'is-part' : ''; ?>"><?php echo esc_html( $type ); ?></span>
			</div>
			<div class="cr-job-meta">
				<?php if ( $dept['name'] ) : ?><span><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="7" width="18" height="13" rx="2"/><path d="M8 7V5a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg><?php echo esc_html( $dept['name'] ); ?></span><?php endif; ?>
				<span><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 21s7-5.5 7-11a7 7 0 1 0-14 0c0 5.5 7 11 7 11z"/><circle cx="12" cy="10" r="2.5"/></svg><?php echo esc_html( $work ); ?></span>
				<?php if ( $exp ) : ?><span><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></svg><?php echo esc_html( $exp ); ?></span><?php endif; ?>
			</div>
			<p class="cr-job-desc"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 22 ) ); ?></p>
		</div>
		<a class="cr-job-apply" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Apply Now', 'blogtechu-custom' ); ?> <span aria-hidden="true">→</span></a>
	</article>
	<?php
}

/**
 * Render a meta list (responsibilities/requirements/benefits) from newline text.
 *
 * @param string $raw  Newline-separated items.
 * @param string $type 'check' or 'dot'.
 */
function blogtechu_job_list( $raw, $type = 'check' ) {
	$lines = array_filter( array_map( 'trim', preg_split( '/\r\n|\r|\n/', (string) $raw ) ) );
	if ( empty( $lines ) ) {
		return;
	}
	echo '<ul class="sj-list sj-list-' . esc_attr( $type ) . '">';
	foreach ( $lines as $line ) {
		echo '<li>' . esc_html( $line ) . '</li>';
	}
	echo '</ul>';
}

/**
 * Process the application form (call BEFORE get_header on apply templates).
 *
 * Returns the same array on every call within a request (memoized).
 *
 * @return array{status:string,message:string,values:array}
 */
function blogtechu_process_job_application() {
	static $result = null;
	if ( null !== $result ) {
		return $result;
	}

	$result = array(
		'status'  => '',
		'message' => '',
		'values'  => array( 'name' => '', 'email' => '', 'phone' => '', 'position' => '', 'linkedin' => '', 'message' => '' ),
	);

	if ( 'POST' !== $_SERVER['REQUEST_METHOD'] || ! isset( $_POST['cr_apply_submit'] ) ) {
		return $result;
	}

	if ( ! isset( $_POST['cr_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['cr_nonce'] ) ), 'cr_apply_form' ) ) {
		$result['status']  = 'error';
		$result['message'] = __( 'Security check failed. Please refresh the page and try again.', 'blogtechu-custom' );
		return $result;
	}

	$v             = &$result['values'];
	$v['name']     = isset( $_POST['cr_name'] ) ? sanitize_text_field( wp_unslash( $_POST['cr_name'] ) ) : '';
	$v['email']    = isset( $_POST['cr_email'] ) ? sanitize_email( wp_unslash( $_POST['cr_email'] ) ) : '';
	$v['phone']    = isset( $_POST['cr_phone'] ) ? sanitize_text_field( wp_unslash( $_POST['cr_phone'] ) ) : '';
	$v['position'] = isset( $_POST['cr_position'] ) ? sanitize_text_field( wp_unslash( $_POST['cr_position'] ) ) : '';
	$v['linkedin'] = isset( $_POST['cr_linkedin'] ) ? esc_url_raw( wp_unslash( $_POST['cr_linkedin'] ) ) : '';
	$v['message']  = isset( $_POST['cr_message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['cr_message'] ) ) : '';
	$hp            = isset( $_POST['cr_website'] ) ? trim( wp_unslash( $_POST['cr_website'] ) ) : '';

	if ( '' !== $hp ) {
		$result['status']  = 'success';
		$result['message'] = __( 'Thank you! Your application has been received.', 'blogtechu-custom' );
		return $result;
	}

	if ( '' === $v['name'] || ! is_email( $v['email'] ) || '' === $v['message'] ) {
		$result['status']  = 'error';
		$result['message'] = __( 'Please fill in your name, a valid email and a short message.', 'blogtechu-custom' );
		return $result;
	}

	// Optional resume upload (PDF / DOC / DOCX, max 5MB).
	$attachments = array();
	$resume_path = '';
	$resume_note = __( 'Not attached', 'blogtechu-custom' );

	if ( ! empty( $_FILES['cr_resume']['name'] ) ) {
		$allowed = array(
			'pdf'  => 'application/pdf',
			'doc'  => 'application/msword',
			'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
		);
		$file = $_FILES['cr_resume'];
		$ext  = strtolower( pathinfo( sanitize_file_name( $file['name'] ), PATHINFO_EXTENSION ) );

		if ( UPLOAD_ERR_OK !== (int) $file['error'] ) {
			$result['status']  = 'error';
			$result['message'] = __( 'Resume upload failed. Please try again.', 'blogtechu-custom' );
			return $result;
		} elseif ( ! array_key_exists( $ext, $allowed ) ) {
			$result['status']  = 'error';
			$result['message'] = __( 'Resume must be a PDF, DOC or DOCX file.', 'blogtechu-custom' );
			return $result;
		} elseif ( (int) $file['size'] > 5 * 1024 * 1024 ) {
			$result['status']  = 'error';
			$result['message'] = __( 'Resume is too large. Maximum size is 5MB.', 'blogtechu-custom' );
			return $result;
		}
		require_once ABSPATH . 'wp-admin/includes/file.php';
		$upload = wp_handle_upload( $file, array( 'test_form' => false, 'mimes' => $allowed ) );
		if ( ! empty( $upload['file'] ) ) {
			$resume_path   = $upload['file'];
			$attachments[] = $resume_path;
			$resume_note   = __( 'Attached to this email', 'blogtechu-custom' );
		} else {
			$result['status']  = 'error';
			$result['message'] = isset( $upload['error'] ) ? $upload['error'] : __( 'Resume upload failed. Please try again.', 'blogtechu-custom' );
			return $result;
		}
	}

	$to      = get_option( 'admin_email' );
	$subject = sprintf(
		/* translators: %s: position applied for */
		__( 'New job application: %s', 'blogtechu-custom' ),
		$v['position'] ? $v['position'] : __( 'General', 'blogtechu-custom' )
	);
	$body = sprintf(
		/* translators: 1: name, 2: email, 3: phone, 4: position, 5: profile url, 6: resume note, 7: message */
		__( "New career application received.\n\nName: %1\$s\nEmail: %2\$s\nPhone: %3\$s\nPosition: %4\$s\nProfile/Portfolio: %5\$s\nResume: %6\$s\n\nMessage:\n%7\$s", 'blogtechu-custom' ),
		$v['name'],
		$v['email'],
		$v['phone'] ? $v['phone'] : __( 'Not provided', 'blogtechu-custom' ),
		$v['position'] ? $v['position'] : __( 'Not specified', 'blogtechu-custom' ),
		$v['linkedin'] ? $v['linkedin'] : __( 'Not provided', 'blogtechu-custom' ),
		$resume_note,
		$v['message']
	);
	$headers = array(
		'Content-Type: text/plain; charset=UTF-8',
		sprintf( 'Reply-To: %s <%s>', $v['name'], $v['email'] ),
	);

	$sent = wp_mail( $to, '[' . get_bloginfo( 'name' ) . '] ' . $subject, $body, $headers, $attachments );

	if ( $resume_path && file_exists( $resume_path ) ) {
		wp_delete_file( $resume_path );
	}

	if ( $sent ) {
		$result['status']  = 'success';
		$result['message'] = __( "Thank you for applying! We've received your application and will be in touch if there's a match.", 'blogtechu-custom' );
		$result['values']  = array( 'name' => '', 'email' => '', 'phone' => '', 'position' => $v['position'], 'linkedin' => '', 'message' => '' );
	} else {
		$result['status']  = 'error';
		$result['message'] = __( 'Sorry, something went wrong sending your application. Please email us directly.', 'blogtechu-custom' );
	}

	return $result;
}

/**
 * Shared application form markup.
 *
 * @param array  $app      Result from blogtechu_process_job_application().
 * @param string $position Default position value (job title) — locked when set.
 */
function blogtechu_render_apply_form( $app, $position = '' ) {
	$v   = $app['values'];
	$pos = $position ? $position : $v['position'];
	?>
	<?php if ( $app['message'] ) : ?>
		<div class="cu-alert <?php echo 'success' === $app['status'] ? 'cu-alert-success' : 'cu-alert-error'; ?>" role="alert" style="margin-top:1.25rem;">
			<?php echo esc_html( $app['message'] ); ?>
		</div>
	<?php endif; ?>

	<form class="cr-form" method="post" enctype="multipart/form-data" action="<?php echo esc_url( get_permalink() ); ?>#apply" novalidate>
		<?php wp_nonce_field( 'cr_apply_form', 'cr_nonce' ); ?>

		<div class="cr-form-row">
			<div class="cu-field"><input class="cu-input cu-input--plain" type="text" id="cr_name" name="cr_name" value="<?php echo esc_attr( $v['name'] ); ?>" placeholder="<?php esc_attr_e( 'Full Name *', 'blogtechu-custom' ); ?>" required /></div>
			<div class="cu-field"><input class="cu-input cu-input--plain" type="email" name="cr_email" value="<?php echo esc_attr( $v['email'] ); ?>" placeholder="<?php esc_attr_e( 'Email Address *', 'blogtechu-custom' ); ?>" required /></div>
		</div>
		<div class="cr-form-row">
			<div class="cu-field"><input class="cu-input cu-input--plain" type="text" name="cr_phone" value="<?php echo esc_attr( $v['phone'] ); ?>" placeholder="<?php esc_attr_e( 'Phone Number', 'blogtechu-custom' ); ?>" /></div>
			<div class="cu-field"><input class="cu-input cu-input--plain" type="url" name="cr_linkedin" value="<?php echo esc_attr( $v['linkedin'] ); ?>" placeholder="<?php esc_attr_e( 'Portfolio / LinkedIn URL', 'blogtechu-custom' ); ?>" /></div>
		</div>

		<div class="cu-field">
			<input class="cu-input cu-input--plain" type="text" id="cr_position" name="cr_position" value="<?php echo esc_attr( $pos ); ?>" placeholder="<?php esc_attr_e( 'Position', 'blogtechu-custom' ); ?>" <?php echo $position ? 'readonly' : ''; ?> />
		</div>

		<label class="cr-file">
			<input type="file" id="cr_resume" name="cr_resume" accept=".pdf,.doc,.docx,application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document" />
			<span class="cr-file-ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M12 16V4M7 9l5-5 5 5"/><path d="M5 20h14"/></svg></span>
			<span class="cr-file-text"><strong data-cr-file-label><?php esc_html_e( 'Upload your resume', 'blogtechu-custom' ); ?></strong><em><?php esc_html_e( 'PDF, DOC or DOCX — max 5MB', 'blogtechu-custom' ); ?></em></span>
		</label>

		<div class="cu-field"><textarea class="cu-textarea" name="cr_message" rows="5" placeholder="<?php esc_attr_e( 'Why are you a great fit? Tell us about yourself… *', 'blogtechu-custom' ); ?>" required><?php echo esc_textarea( $v['message'] ); ?></textarea></div>

		<?php // Honeypot. ?>
		<div style="position:absolute;left:-9999px;" aria-hidden="true">
			<label for="cr_website"><?php esc_html_e( 'Website', 'blogtechu-custom' ); ?></label>
			<input type="text" id="cr_website" name="cr_website" tabindex="-1" autocomplete="off" />
		</div>

		<button class="cu-submit" type="submit" name="cr_apply_submit" value="1"><?php esc_html_e( 'Submit Application', 'blogtechu-custom' ); ?> <span aria-hidden="true">→</span></button>
	</form>
	<?php
}
