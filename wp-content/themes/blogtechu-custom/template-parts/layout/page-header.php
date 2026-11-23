<?php
/**
 * Reusable page header.
 *
 * @package Blogtechu_Custom
 */

$title       = isset( $args['title'] ) ? $args['title'] : '';
$description = isset( $args['description'] ) ? $args['description'] : '';
?>

<?php if ( $title || $description ) : ?>
  <header class="archive-header mb-8">
    <?php if ( $title ) : ?>
      <h1 class="archive-title text-4xl font-bold"><?php echo wp_kses_post( $title ); ?></h1>
    <?php endif; ?>

    <?php if ( $description ) : ?>
      <div class="archive-description mt-3 text-slate-600"><?php echo wp_kses_post( wpautop( $description ) ); ?></div>
    <?php endif; ?>
  </header>
<?php endif; ?>
