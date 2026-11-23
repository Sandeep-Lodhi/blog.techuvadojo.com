<?php
/**
 * Search form template.
 *
 * @package Blogtechu_Custom
 */
$blogtechu_custom_search_id = 'search-field-' . wp_unique_id();
?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
  <label class="screen-reader-text" for="<?php echo esc_attr( $blogtechu_custom_search_id ); ?>">
    <?php esc_html_e( 'Search for:', 'blogtechu-custom' ); ?>
  </label>
  <input
    id="<?php echo esc_attr( $blogtechu_custom_search_id ); ?>"
    type="search"
    class="search-field"
    placeholder="<?php echo esc_attr_x( 'Search articles...', 'placeholder', 'blogtechu-custom' ); ?>"
    value="<?php echo esc_attr( get_search_query() ); ?>"
    name="s"
  >
  <button type="submit" class="search-submit">
    <?php echo esc_html_x( 'Search', 'submit button', 'blogtechu-custom' ); ?>
  </button>
</form>
