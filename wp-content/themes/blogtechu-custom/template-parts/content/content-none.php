<section class="no-results not-found rounded-3xl border border-slate-200 bg-white p-8 shadow-sm">
  <header class="page-header mb-4">
    <h1 class="text-3xl font-semibold"><?php esc_html_e( 'Nothing Found', 'blogtechu-custom' ); ?></h1>
  </header>
  <div class="page-content text-slate-700">
    <p><?php esc_html_e( 'It looks like nothing was found at this location. Try searching or check the site navigation.', 'blogtechu-custom' ); ?></p>
    <?php get_search_form(); ?>
  </div>
</section>
