<?php
/**
 * Comments template.
 *
 * @package Blogtechu_Custom
 */

if ( post_password_required() ) {
  return;
}
?>

<section id="comments" class="comments-area">
  <?php if ( have_comments() ) : ?>
    <h2 class="comments-title">
      <?php
      $comments_number = get_comments_number();
      if ( '1' === $comments_number ) {
        esc_html_e( 'One Comment', 'blogtechu-custom' );
      } else {
        printf(
          /* translators: %s: number of comments. */
          esc_html__( '%s Comments', 'blogtechu-custom' ),
          esc_html( number_format_i18n( $comments_number ) )
        );
      }
      ?>
    </h2>

    <ol class="comment-list">
      <?php
      wp_list_comments(
        array(
          'avatar_size' => 48,
          'short_ping'  => true,
          'style'       => 'ol',
        )
      );
      ?>
    </ol>

    <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
      <nav class="comment-navigation" aria-label="<?php esc_attr_e( 'Comments', 'blogtechu-custom' ); ?>">
        <?php paginate_comments_links(); ?>
      </nav>
    <?php endif; ?>
  <?php endif; ?>

  <?php if ( ! comments_open() && get_comments_number() ) : ?>
    <p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'blogtechu-custom' ); ?></p>
  <?php endif; ?>

  <?php
  // Always show Name / Email / Website fields (even for logged-in users) by
  // placing them inside comment_field, which WordPress always renders.
  $commenter = wp_get_current_commenter();
  $req       = get_option( 'require_name_email' );
  $req_attr  = $req ? " required aria-required='true'" : '';

  $comment_field  = '<p class="comment-form-comment"><label for="comment">' . esc_html__( 'Comment *', 'blogtechu-custom' ) . '</label>';
  $comment_field .= '<textarea id="comment" name="comment" cols="45" rows="6" maxlength="65525" required placeholder="' . esc_attr__( 'Share your thoughts…', 'blogtechu-custom' ) . '"></textarea></p>';
  $comment_field .= '<p class="comment-form-author"><label for="author">' . esc_html__( 'Name *', 'blogtechu-custom' ) . '</label>';
  $comment_field .= '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" maxlength="245"' . $req_attr . ' placeholder="' . esc_attr__( 'Your name', 'blogtechu-custom' ) . '" /></p>';
  $comment_field .= '<p class="comment-form-email"><label for="email">' . esc_html__( 'Email *', 'blogtechu-custom' ) . '</label>';
  $comment_field .= '<input id="email" name="email" type="email" value="' . esc_attr( $commenter['comment_author_email'] ) . '" maxlength="100"' . $req_attr . ' placeholder="' . esc_attr__( 'you@example.com', 'blogtechu-custom' ) . '" /></p>';
  $comment_field .= '<p class="comment-form-url"><label for="url">' . esc_html__( 'Website', 'blogtechu-custom' ) . '</label>';
  $comment_field .= '<input id="url" name="url" type="url" value="' . esc_attr( $commenter['comment_author_url'] ) . '" maxlength="200" placeholder="https://…" /></p>';

  comment_form(
    array(
      'title_reply'          => __( 'Leave a Comment', 'blogtechu-custom' ),
      'label_submit'         => __( 'Post Comment', 'blogtechu-custom' ),
      'comment_notes_before' => '<p class="comment-notes">' . esc_html__( 'Your email address will not be published. Required fields are marked *', 'blogtechu-custom' ) . '</p>',
      'comment_field'        => $comment_field,
      'fields'               => array(),
      'logged_in_as'         => '',
    )
  );
  ?>
</section>
