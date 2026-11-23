<?php
$category = get_the_category();
$category_name = ! empty( $category ) ? $category[0]->name : __( 'Article', 'blogtechu-custom' );
$title_tag = is_singular() ? 'h1' : 'h2';
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'blog-card' ); ?>>
  <a href="<?php the_permalink(); ?>" class="blog-card-media" aria-label="<?php the_title_attribute(); ?>">
    <img class="blog-card-image" src="<?php echo esc_url( blogtechu_post_cover_url() ); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy" decoding="async" />
    <span class="blog-card-badge"><?php echo esc_html( $category_name ); ?></span>
  </a>

  <div class="blog-card-body">
    <header class="entry-header">
      <<?php echo esc_html( $title_tag ); ?> class="blog-card-title">
        <?php if ( is_singular() ) : ?>
          <?php the_title(); ?>
        <?php else : ?>
          <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        <?php endif; ?>
      </<?php echo esc_html( $title_tag ); ?>>

      <div class="blog-card-meta">
        <?php blogtechu_custom_posted_on(); ?>
        <span><?php echo esc_html( get_the_author() ); ?></span>
      </div>
    </header>

    <div class="<?php echo is_singular() ? 'entry-content' : 'blog-card-excerpt'; ?>">
      <?php
      if ( is_singular() ) {
        the_content();
      } else {
        the_excerpt();
      }
      ?>
    </div>

    <?php if ( ! is_singular() ) : ?>
      <div class="blog-card-footer">
        <a href="<?php the_permalink(); ?>" class="read-more-link"><?php esc_html_e( 'Read More', 'blogtechu-custom' ); ?></a>
        <span><?php echo esc_html( get_comments_number() ); ?> <?php esc_html_e( 'comments', 'blogtechu-custom' ); ?></span>
      </div>
    <?php endif; ?>
  </div>
</article>
