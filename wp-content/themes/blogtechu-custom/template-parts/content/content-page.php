<article id="post-<?php the_ID(); ?>" <?php post_class( 'page-entry rounded-3xl border border-slate-200 bg-white p-8 shadow-sm' ); ?>>
  <header class="entry-header mb-6">
    <h1 class="entry-title text-3xl font-semibold"><?php the_title(); ?></h1>
  </header>

  <div class="entry-content text-slate-700">
    <?php the_content(); ?>
  </div>
</article>
