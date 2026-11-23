<?php
get_header();
?>

<div class="error404 max-w-5xl mx-auto px-5 py-16 text-center">
  <h1 class="text-5xl font-bold mb-6"><?php esc_html_e( '404 — Page not found', 'blogtechu-custom' ); ?></h1>
  <p class="text-lg text-slate-600 mb-8"><?php esc_html_e( 'The page you are looking for cannot be found. Try searching or return to the homepage.', 'blogtechu-custom' ); ?></p>
  <?php get_search_form(); ?>
  <p class="mt-8"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="text-blue-500"><?php esc_html_e( 'Back to home', 'blogtechu-custom' ); ?></a></p>
</div>

<?php
get_footer();
