<?php
/**
 * Posts page template.
 *
 * @package Blogtechu_Custom
 */

get_header();
?>

<div class="archive-listing max-w-7xl mx-auto px-5 py-12">
  <?php
  get_template_part(
    'template-parts/layout/page-header',
    null,
    array(
      'title'       => is_home() && ! is_front_page() ? single_post_title( '', false ) : __( 'Latest Articles', 'blogtechu-custom' ),
      'description' => __( 'Explore the newest tutorials, insights, and updates from TechuvaDojo.', 'blogtechu-custom' ),
    )
  );
  ?>

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
