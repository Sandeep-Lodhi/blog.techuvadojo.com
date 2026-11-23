<?php
get_header();
?>

<div class="archive-intro max-w-7xl mx-auto px-5 py-12">
  <?php if ( is_home() && ! is_front_page() ) : ?>
    <?php
    get_template_part(
      'template-parts/layout/page-header',
      null,
      array(
        'title' => single_post_title( '', false ),
      )
    );
    ?>
  <?php endif; ?>

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
