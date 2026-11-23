<?php
get_header();
?>

<div class="archive-listing max-w-7xl mx-auto px-5 py-12">
  <?php
  get_template_part(
    'template-parts/layout/page-header',
    null,
    array(
      'title'       => get_the_archive_title(),
      'description' => get_the_archive_description(),
    )
  );
  ?>

  <?php if ( have_posts() ) : ?>
    <div class="archive-grid grid gap-10">
      <?php while ( have_posts() ) : the_post(); ?>
        <?php get_template_part( 'template-parts/content/content', 'post' ); ?>
      <?php endwhile; ?>
    </div>

    <?php get_template_part( 'template-parts/navigation/pagination' ); ?>
  <?php else : ?>
    <?php get_template_part( 'template-parts/content/content', 'none' ); ?>
  <?php endif; ?>
</div>

<?php
get_footer();
