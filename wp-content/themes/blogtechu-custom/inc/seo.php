<?php
/**
 * Lightweight SEO: outputs a meta description (and Open Graph basics) on the
 * front end. Uses the post/page excerpt or content, with tailored copy for key
 * marketing pages. Keeps things simple — install Yoast/Rank Math later if you
 * want full control.
 *
 * @package Blogtechu_Custom
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Build the best meta description for the current view.
 */
function blogtechu_get_meta_description() {
	$overrides = array(
		'services'  => __( 'Full-service IT company offering MERN & custom web development, mobile apps, e-commerce, cloud & DevOps, AI solutions, SEO and digital marketing. Get a free quote today.', 'blogtechu-custom' ),
		'about'     => __( 'Learn about TechuvaDojo — a team of developers, designers and marketers building fast, reliable and modern digital products for ambitious brands.', 'blogtechu-custom' ),
		'contact'   => __( 'Get in touch with TechuvaDojo. Tell us about your project and we will get back to you within 24 hours with a free, no-obligation quote.', 'blogtechu-custom' ),
		'portfolio' => __( 'Explore selected work by TechuvaDojo — websites, web apps, e-commerce stores and digital campaigns built for real results.', 'blogtechu-custom' ),
		'projects'  => __( 'Products, apps and open-source work engineered by the TechuvaDojo team, with the technologies behind each one.', 'blogtechu-custom' ),
		'careers'   => __( 'Join the TechuvaDojo team. Explore open roles and help us build modern digital products. Remote-friendly and growth-focused.', 'blogtechu-custom' ),
		'blog'      => __( 'Insights, tutorials and ideas on web development, AI, cloud, tools and growth — from the TechuvaDojo team.', 'blogtechu-custom' ),
		'news'      => __( 'Daily tech news: IT companies, product launches, AI, startups, events and the technologies shaping our world.', 'blogtechu-custom' ),
	);

	$desc = '';

	if ( is_singular() ) {
		$post = get_queried_object();
		if ( $post instanceof WP_Post ) {
			if ( isset( $overrides[ $post->post_name ] ) ) {
				$desc = $overrides[ $post->post_name ];
			} elseif ( has_excerpt( $post ) ) {
				$desc = get_the_excerpt( $post );
			} else {
				$desc = wp_strip_all_tags( strip_shortcodes( $post->post_content ) );
			}
		}
	} elseif ( is_category() || is_tag() || is_tax() ) {
		$desc = term_description();
		if ( ! $desc ) {
			/* translators: %s: archive title. */
			$desc = sprintf( __( 'Browse the latest articles in %s on the TechuvaDojo blog.', 'blogtechu-custom' ), single_term_title( '', false ) );
		}
	} elseif ( is_home() || is_front_page() ) {
		$desc = get_bloginfo( 'description' );
	}

	$desc = trim( preg_replace( '/\s+/', ' ', wp_strip_all_tags( (string) $desc ) ) );

	if ( '' === $desc ) {
		$desc = get_bloginfo( 'description' );
	}

	return wp_html_excerpt( $desc, 160, '' );
}

/**
 * Print meta description + basic Open Graph / Twitter tags.
 */
function blogtechu_print_seo_tags() {
	if ( is_admin() ) {
		return;
	}

	$desc = blogtechu_get_meta_description();
	if ( ! $desc ) {
		return;
	}

	$title = wp_get_document_title();

	echo "\n<!-- TechuvaDojo SEO -->\n";
	printf( '<meta name="description" content="%s">' . "\n", esc_attr( $desc ) );
	printf( '<meta property="og:title" content="%s">' . "\n", esc_attr( $title ) );
	printf( '<meta property="og:description" content="%s">' . "\n", esc_attr( $desc ) );
	printf( '<meta property="og:type" content="%s">' . "\n", is_singular() && ! is_front_page() ? 'article' : 'website' );
	printf( '<meta property="og:url" content="%s">' . "\n", esc_url( ( is_singular() ? get_permalink() : home_url( add_query_arg( null, null ) ) ) ) );
	printf( '<meta property="og:site_name" content="%s">' . "\n", esc_attr( get_bloginfo( 'name' ) ) );
	if ( is_singular() && has_post_thumbnail() ) {
		printf( '<meta property="og:image" content="%s">' . "\n", esc_url( get_the_post_thumbnail_url( null, 'large' ) ) );
	}
	printf( '<meta name="twitter:card" content="%s">' . "\n", 'summary_large_image' );
	echo "<!-- /TechuvaDojo SEO -->\n";
}
add_action( 'wp_head', 'blogtechu_print_seo_tags', 5 );
