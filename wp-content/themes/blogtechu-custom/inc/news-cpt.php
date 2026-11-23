<?php
/**
 * Registers the "News" custom post type and its taxonomies, giving News its own
 * top-level admin menu (All News, Add News, News Categories, News Tags) so it
 * can be managed completely separately from blog Posts.
 *
 * @package Blogtechu_Custom
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register the News post type.
 */
function blogtechu_register_news_cpt() {
	$labels = array(
		'name'                  => __( 'News', 'blogtechu-custom' ),
		'singular_name'         => __( 'News Article', 'blogtechu-custom' ),
		'menu_name'             => __( 'News', 'blogtechu-custom' ),
		'name_admin_bar'        => __( 'News Article', 'blogtechu-custom' ),
		'add_new'               => __( 'Add News', 'blogtechu-custom' ),
		'add_new_item'          => __( 'Add News', 'blogtechu-custom' ),
		'new_item'              => __( 'New News Article', 'blogtechu-custom' ),
		'edit_item'             => __( 'Edit News Article', 'blogtechu-custom' ),
		'view_item'             => __( 'View News Article', 'blogtechu-custom' ),
		'all_items'             => __( 'All News', 'blogtechu-custom' ),
		'search_items'          => __( 'Search News', 'blogtechu-custom' ),
		'not_found'             => __( 'No news articles found.', 'blogtechu-custom' ),
		'not_found_in_trash'    => __( 'No news articles found in Trash.', 'blogtechu-custom' ),
		'featured_image'        => __( 'Featured Image', 'blogtechu-custom' ),
		'set_featured_image'    => __( 'Set featured image', 'blogtechu-custom' ),
		'remove_featured_image' => __( 'Remove featured image', 'blogtechu-custom' ),
		'archives'              => __( 'News Archives', 'blogtechu-custom' ),
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'show_in_rest'       => true, // Gutenberg editor support.
		'menu_position'      => 6,    // Just below Posts (5).
		'menu_icon'          => 'dashicons-megaphone',
		'hierarchical'       => false,
		'has_archive'        => false, // The "News" page handles the listing.
		'rewrite'            => array( 'slug' => 'news', 'with_front' => false ),
		'supports'           => array( 'title', 'editor', 'excerpt', 'thumbnail', 'author' ),
		'taxonomies'         => array(),
	);

	register_post_type( 'news', $args );
}
add_action( 'init', 'blogtechu_register_news_cpt' );

/**
 * Register News Categories + News Tags taxonomies (separate from blog ones).
 */
function blogtechu_register_news_taxonomies() {
	// News Categories (hierarchical, like post categories).
	register_taxonomy(
		'news_category',
		'news',
		array(
			'labels'            => array(
				'name'          => __( 'News Categories', 'blogtechu-custom' ),
				'singular_name' => __( 'News Category', 'blogtechu-custom' ),
				'menu_name'     => __( 'Categories', 'blogtechu-custom' ),
				'all_items'     => __( 'All Categories', 'blogtechu-custom' ),
				'edit_item'     => __( 'Edit Category', 'blogtechu-custom' ),
				'add_new_item'  => __( 'Add New Category', 'blogtechu-custom' ),
				'search_items'  => __( 'Search Categories', 'blogtechu-custom' ),
			),
			'hierarchical'      => true,
			'public'            => true,
			'show_in_rest'      => true,
			'show_admin_column' => true,
			'rewrite'           => array( 'slug' => 'news-category', 'with_front' => false ),
		)
	);

	// News Tags (non-hierarchical).
	register_taxonomy(
		'news_tag',
		'news',
		array(
			'labels'            => array(
				'name'          => __( 'News Tags', 'blogtechu-custom' ),
				'singular_name' => __( 'News Tag', 'blogtechu-custom' ),
				'menu_name'     => __( 'Tags', 'blogtechu-custom' ),
				'all_items'     => __( 'All Tags', 'blogtechu-custom' ),
				'edit_item'     => __( 'Edit Tag', 'blogtechu-custom' ),
				'add_new_item'  => __( 'Add New Tag', 'blogtechu-custom' ),
				'search_items'  => __( 'Search Tags', 'blogtechu-custom' ),
			),
			'hierarchical'      => false,
			'public'            => true,
			'show_in_rest'      => true,
			'show_admin_column' => true,
			'rewrite'           => array( 'slug' => 'news-tag', 'with_front' => false ),
		)
	);
}
add_action( 'init', 'blogtechu_register_news_taxonomies' );

/**
 * Flush rewrite rules once after the News CPT is first registered, so single
 * news URLs (/news/{slug}) work without manually re-saving permalinks.
 */
function blogtechu_news_maybe_flush_rewrites() {
	if ( '2' !== get_option( 'blogtechu_news_rewrites' ) ) {
		flush_rewrite_rules( false );
		update_option( 'blogtechu_news_rewrites', '2' );
	}
}
add_action( 'init', 'blogtechu_news_maybe_flush_rewrites', 99 );
