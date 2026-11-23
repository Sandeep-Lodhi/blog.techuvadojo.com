<?php
get_header();
?>

<div class="page-view max-w-5xl mx-auto px-5 py-12">
  <?php
  while ( have_posts() ) :
    the_post();
    get_template_part( 'template-parts/content/content', 'page' );
  endwhile;
  ?>
</div>

<?php
get_footer();
