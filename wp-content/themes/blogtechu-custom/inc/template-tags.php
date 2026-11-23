<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function blogtechu_custom_posted_on() {
    printf(
        '<span class="posted-on">%1$s</span>',
        sprintf(
            '<time class="entry-date published" datetime="%1$s">%2$s</time>',
            esc_attr( get_the_date( DATE_W3C ) ),
            esc_html( get_the_date() )
        )
    );
}

/**
 * Returns the active CSS class for a header nav item when it matches the page
 * currently being viewed. Used by the hardcoded fallback menu in header.php.
 *
 * @param string $key One of: home, blog, news, or a page slug (services, etc.).
 * @return string 'current-menu-item' when active, otherwise ''.
 */
function blogtechu_nav_current_class( $key ) {
    $is_current = false;

    switch ( $key ) {
        case 'home':
            $is_current = is_front_page();
            break;
        case 'blog':
            // Blog page, the posts index, single posts, and post category/tag archives.
            // Guard is_home() with ! is_front_page() so the homepage doesn't also light up Blog
            // when the site is set to show latest posts on the front page.
            $is_current = is_page( 'blog' ) || ( is_home() && ! is_front_page() ) || is_singular( 'post' ) || is_category() || is_tag();
            break;
        case 'news':
            // News page, single news articles, and news taxonomy archives.
            $is_current = is_page( 'news' ) || is_singular( 'news' ) || is_tax( array( 'news_category', 'news_tag' ) );
            break;
        default:
            $is_current = is_page( $key );
            break;
    }

    return $is_current ? 'current-menu-item' : '';
}

/**
 * Limit front-end search results to real content (blog posts and news).
 *
 * Without this, WordPress includes every public post type — so job listings
 * and pages appear in search results with mismatched/empty cards.
 *
 * @param WP_Query $query The query being run.
 */
function blogtechu_limit_search_post_types( $query ) {
	if ( is_admin() || ! $query->is_main_query() || ! $query->is_search() ) {
		return;
	}
	$query->set( 'post_type', array( 'post', 'news' ) );
}
add_action( 'pre_get_posts', 'blogtechu_limit_search_post_types' );

function blogtechu_custom_entry_footer() {
    if ( 'post' === get_post_type() ) {
        $categories_list = get_the_category_list( ', ' );
        if ( $categories_list ) {
            printf( '<span class="cat-links">%1$s</span>', $categories_list );
        }
    }
}
