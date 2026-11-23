<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function blogtechu_custom_register_block_patterns() {
    register_block_pattern(
        'blogtechu-custom/hero-section',
        array(
            'title'       => __( 'Hero Section', 'blogtechu-custom' ),
            'description' => __( 'A full-width hero section with title, text, and button.', 'blogtechu-custom' ),
            'content'     => "<!-- wp:group {\"align\":\"full\",\"style\":{\"spacing\":{\"padding\":{\"top\":\"4rem\",\"bottom\":\"4rem\"}}},\"backgroundColor\":\"primary\"} -->\n<div class=\"wp-block-group alignfull has-primary-background-color has-background\"><div class=\"wp-block-group__inner-container\"><!-- wp:heading {\"level\":1} -->\n<h1>Modern WordPress blog for developers</h1><!-- /wp:heading -->\n<!-- wp:paragraph -->\n<p>Fast, clean, and flexible architecture with Tailwind and Gutenberg.</p><!-- /wp:paragraph -->\n<!-- wp:buttons -->\n<div class=\"wp-block-buttons\"><!-- wp:button {\"className\":\"is-style-primary\"} -->\n<div class=\"wp-block-button is-style-primary\"><a class=\"wp-block-button__link\">Get started</a></div><!-- /wp:button --></div><!-- /wp:buttons --></div></div><!-- /wp:group -->",
        )
    );
}
add_action( 'init', 'blogtechu_custom_register_block_patterns' );
