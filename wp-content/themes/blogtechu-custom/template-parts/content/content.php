<?php
/**
 * Generic content fallback (used for non-post/page types in loops, e.g. News
 * in search results). Mirrors the post card so every result looks consistent.
 *
 * @package Blogtechu_Custom
 */

if ( 'post' === get_post_type() ) {
  get_template_part( 'template-parts/content/content', 'post' );
  return;
}

if ( 'page' === get_post_type() ) {
  get_template_part( 'template-parts/content/content', 'page' );
  return;
}

$pt_object = get_post_type_object( get_post_type() );
$pt_label  = $pt_object ? $pt_object->labels->singular_name : __( 'Resource', 'blogtechu-custom' );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'blog-card' ); ?>>
  <a href="<?php the_permalink(); ?>" class="blog-card-media" aria-label="<?php the_title_attribute(); ?>">
    <img class="blog-card-image" src="<?php echo esc_url( blogtechu_post_cover_url() ); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy" decoding="async" />
    <span class="blog-card-badge"><?php echo esc_html( $pt_label ); ?></span>
  </a>

  <div class="blog-card-body">
    <header class="entry-header">
      <h2 class="blog-card-title">
        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
      </h2>
      <div class="blog-card-meta">
        <?php blogtechu_custom_posted_on(); ?>
        <span><?php echo esc_html( get_the_author() ); ?></span>
      </div>
    </header>

    <div class="blog-card-excerpt">
      <?php the_excerpt(); ?>
    </div>

    <div class="blog-card-footer">
      <a href="<?php the_permalink(); ?>" class="read-more-link"><?php esc_html_e( 'Read More', 'blogtechu-custom' ); ?></a>
    </div>
  </div>
</article>
