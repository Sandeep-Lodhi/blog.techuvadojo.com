<?php
/**
 * Registers the "Jobs" custom post type + "Department" taxonomy so open
 * positions can be managed from the dashboard. Each Job has its own public
 * detail page (single-job.php) with a full description and apply form.
 *
 * @package Blogtechu_Custom
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register the Job post type.
 */
function blogtechu_register_job_cpt() {
	$labels = array(
		'name'               => __( 'Jobs', 'blogtechu-custom' ),
		'singular_name'      => __( 'Job', 'blogtechu-custom' ),
		'menu_name'          => __( 'Jobs', 'blogtechu-custom' ),
		'name_admin_bar'     => __( 'Job', 'blogtechu-custom' ),
		'add_new'            => __( 'Add Job', 'blogtechu-custom' ),
		'add_new_item'       => __( 'Add Job', 'blogtechu-custom' ),
		'new_item'           => __( 'New Job', 'blogtechu-custom' ),
		'edit_item'          => __( 'Edit Job', 'blogtechu-custom' ),
		'view_item'          => __( 'View Job', 'blogtechu-custom' ),
		'all_items'          => __( 'All Jobs', 'blogtechu-custom' ),
		'search_items'       => __( 'Search Jobs', 'blogtechu-custom' ),
		'not_found'          => __( 'No jobs found.', 'blogtechu-custom' ),
		'not_found_in_trash' => __( 'No jobs found in Trash.', 'blogtechu-custom' ),
	);

	$args = array(
		'labels'        => $labels,
		'public'        => true,
		'show_ui'       => true,
		'show_in_menu'  => true,
		'show_in_rest'  => false, // Use the classic editor so the Job Details fields sit clearly under the content.
		'menu_position' => 7,
		'menu_icon'     => 'dashicons-businessperson',
		'hierarchical'  => false,
		'has_archive'   => false, // The Careers page handles the listing.
		'rewrite'       => array( 'slug' => 'jobs', 'with_front' => false ),
		'supports'      => array( 'title', 'editor', 'excerpt', 'author' ),
	);

	register_post_type( 'job', $args );
}
add_action( 'init', 'blogtechu_register_job_cpt' );

/**
 * Register the Department taxonomy.
 */
function blogtechu_register_job_taxonomy() {
	register_taxonomy(
		'job_department',
		'job',
		array(
			'labels'            => array(
				'name'          => __( 'Departments', 'blogtechu-custom' ),
				'singular_name' => __( 'Department', 'blogtechu-custom' ),
				'menu_name'     => __( 'Departments', 'blogtechu-custom' ),
				'all_items'     => __( 'All Departments', 'blogtechu-custom' ),
				'edit_item'     => __( 'Edit Department', 'blogtechu-custom' ),
				'add_new_item'  => __( 'Add New Department', 'blogtechu-custom' ),
				'search_items'  => __( 'Search Departments', 'blogtechu-custom' ),
			),
			'hierarchical'      => true,
			'public'            => true,
			'show_in_rest'      => true,
			'show_admin_column' => true,
			'rewrite'           => array( 'slug' => 'department', 'with_front' => false ),
		)
	);
}
add_action( 'init', 'blogtechu_register_job_taxonomy' );

/**
 * Register Job meta fields (structured details edited via the meta box below).
 */
function blogtechu_register_job_meta() {
	$keys = array( '_job_type', '_job_work', '_job_exp', '_job_location', '_job_salary', '_job_icon', '_job_tone', '_job_responsibilities', '_job_requirements', '_job_benefits' );
	foreach ( $keys as $key ) {
		register_post_meta(
			'job',
			$key,
			array(
				'type'              => 'string',
				'single'            => true,
				'show_in_rest'      => false,
				'sanitize_callback' => 'wp_kses_post',
				'auth_callback'     => function () {
					return current_user_can( 'edit_posts' );
				},
			)
		);
	}
}
add_action( 'init', 'blogtechu_register_job_meta' );

/**
 * Meta box for the structured Job details.
 */
function blogtechu_job_meta_box() {
	add_meta_box( 'blogtechu_job_details', __( 'Job Details', 'blogtechu-custom' ), 'blogtechu_job_meta_box_html', 'job', 'normal', 'high' );
}
add_action( 'add_meta_boxes', 'blogtechu_job_meta_box' );

/**
 * Render the Job details meta box.
 *
 * @param WP_Post $post Current job.
 */
function blogtechu_job_meta_box_html( $post ) {
	wp_nonce_field( 'blogtechu_job_meta', 'blogtechu_job_meta_nonce' );
	$fields = array(
		'_job_type'     => array( 'Employment type', 'e.g. Full Time / Part Time / Internship', 'text' ),
		'_job_work'     => array( 'Work mode', 'e.g. Remote / Hybrid / On-site', 'text' ),
		'_job_exp'      => array( 'Experience', 'e.g. 2-4 Years', 'text' ),
		'_job_location' => array( 'Location', 'e.g. Noida, India', 'text' ),
		'_job_salary'   => array( 'Salary', 'e.g. Competitive', 'text' ),
		'_job_icon'     => array( 'Icon key', 'stack / wp / design / chart / video / pm', 'text' ),
		'_job_tone'     => array( 'Icon colour', 'blue / sky / pink / purple / green / orange', 'text' ),
	);
	echo '<style>.bt-job-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:14px}.bt-job-grid label{display:block;font-weight:600;margin-bottom:4px}.bt-job-grid input,.bt-job-full textarea{width:100%}.bt-job-full{margin-top:14px}.bt-job-full label{font-weight:600;display:block;margin-bottom:4px}.bt-job-hint{color:#777;font-weight:400;font-size:11px}</style>';
	echo '<div class="bt-job-grid">';
	foreach ( $fields as $key => $f ) {
		$val = get_post_meta( $post->ID, $key, true );
		printf(
			'<div><label for="%1$s">%2$s <span class="bt-job-hint">%3$s</span></label><input type="text" id="%1$s" name="%1$s" value="%4$s" /></div>',
			esc_attr( $key ),
			esc_html( $f[0] ),
			esc_html( $f[1] ),
			esc_attr( $val )
		);
	}
	echo '</div>';

	$lists = array(
		'_job_responsibilities' => __( 'Responsibilities (one per line)', 'blogtechu-custom' ),
		'_job_requirements'     => __( 'Requirements (one per line)', 'blogtechu-custom' ),
		'_job_benefits'         => __( 'Benefits (one per line)', 'blogtechu-custom' ),
	);
	foreach ( $lists as $key => $label ) {
		$val = get_post_meta( $post->ID, $key, true );
		printf(
			'<div class="bt-job-full"><label for="%1$s">%2$s</label><textarea id="%1$s" name="%1$s" rows="5">%3$s</textarea></div>',
			esc_attr( $key ),
			esc_html( $label ),
			esc_textarea( $val )
		);
	}
}

/**
 * Save the Job details meta box.
 *
 * @param int $post_id Job ID.
 */
function blogtechu_save_job_meta( $post_id ) {
	if ( ! isset( $_POST['blogtechu_job_meta_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['blogtechu_job_meta_nonce'] ) ), 'blogtechu_job_meta' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}
	$text_keys = array( '_job_type', '_job_work', '_job_exp', '_job_location', '_job_salary', '_job_icon', '_job_tone' );
	foreach ( $text_keys as $key ) {
		if ( isset( $_POST[ $key ] ) ) {
			update_post_meta( $post_id, $key, sanitize_text_field( wp_unslash( $_POST[ $key ] ) ) );
		}
	}
	$area_keys = array( '_job_responsibilities', '_job_requirements', '_job_benefits' );
	foreach ( $area_keys as $key ) {
		if ( isset( $_POST[ $key ] ) ) {
			update_post_meta( $post_id, $key, sanitize_textarea_field( wp_unslash( $_POST[ $key ] ) ) );
		}
	}
}
add_action( 'save_post_job', 'blogtechu_save_job_meta' );

/**
 * Flush rewrite rules once so /jobs/{slug} works without re-saving permalinks.
 */
function blogtechu_jobs_maybe_flush_rewrites() {
	if ( '1' !== get_option( 'blogtechu_jobs_rewrites' ) ) {
		flush_rewrite_rules( false );
		update_option( 'blogtechu_jobs_rewrites', '1' );
	}
}
add_action( 'init', 'blogtechu_jobs_maybe_flush_rewrites', 99 );
