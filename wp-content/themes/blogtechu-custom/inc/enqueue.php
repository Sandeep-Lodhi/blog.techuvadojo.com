<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function blogtechu_custom_get_asset_uri( $path ) {
    $file_path = get_theme_file_path( $path );
    if ( file_exists( $file_path ) ) {
        return get_theme_file_uri( $path );
    }
    return false;
}

function blogtechu_custom_enqueue_assets() {
    $theme = wp_get_theme();
    wp_enqueue_style( 'blogtechu-style', get_stylesheet_uri(), array(), $theme->get( 'Version' ) );

    $dist_style = blogtechu_custom_get_asset_uri( '/dist/style.css' );
    if ( $dist_style ) {
        wp_enqueue_style( 'blogtechu-main', $dist_style, array( 'blogtechu-style' ), filemtime( get_theme_file_path( '/dist/style.css' ) ) );
    }

    $dist_script = blogtechu_custom_get_asset_uri( '/dist/main.js' );
    if ( $dist_script ) {
        wp_enqueue_script( 'blogtechu-main', $dist_script, array(), filemtime( get_theme_file_path( '/dist/main.js' ) ), true );
    }
}
add_action( 'wp_enqueue_scripts', 'blogtechu_custom_enqueue_assets' );
