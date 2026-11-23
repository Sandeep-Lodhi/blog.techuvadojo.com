<?php
/**
 * Search results template.
 *
 * @package Blogtechu_Custom
 */

get_header();
?>

<div class="search-listing max-w-7xl mx-auto px-5 py-12">
  <?php
  get_template_part(
    'template-parts/layout/page-header',
    null,
    array(
      'title'       => sprintf(
        /* translators: %s: search query. */
        __( 'Search results for "%s"', 'blogtechu-custom' ),
        get_search_query()
      ),
      'description' => __( 'Browse matching posts and resources from the site.', 'blogtechu-custom' ),
    )
  );
  ?>

  <div class="archive-search-form">
    <?php get_search_form(); ?>
  </div>

  <?php if ( have_posts() ) : ?>
    <div class="post-grid grid gap-10">
      <?php while ( have_posts() ) : the_post(); ?>
        <?php get_template_part( 'template-parts/content/content', get_post_type() ); ?>
      <?php endwhile; ?>
    </div>

    <?php get_template_part( 'template-parts/navigation/pagination' ); ?>
  <?php else : ?>
    <?php get_template_part( 'template-parts/content/content', 'none' ); ?>
  <?php endif; ?>
</div>

<?php
get_footer();
