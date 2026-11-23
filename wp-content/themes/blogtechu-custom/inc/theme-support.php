<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function blogtechu_custom_theme_support() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'responsive-embeds' );
    add_theme_support( 'align-wide' );
    add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );
    add_theme_support( 'wp-block-styles' );
    add_theme_support( 'editor-styles' );
    add_theme_support( 'customize-selective-refresh-widgets' );
    add_theme_support( 'custom-logo', array(
        'height'      => 60,
        'width'       => 250,
        'flex-width'  => true,
    ) );

    add_image_size( 'blogtechu-card', 720, 430, true );
    add_image_size( 'blogtechu-hero', 1280, 720, true );

    register_nav_menus(
        array(
            'primary' => __( 'Primary Menu', 'blogtechu-custom' ),
            'footer'  => __( 'Footer Menu', 'blogtechu-custom' ),
            'social'  => __( 'Social Links Menu', 'blogtechu-custom' ),
        )
    );
}
add_action( 'after_setup_theme', 'blogtechu_custom_theme_support' );
