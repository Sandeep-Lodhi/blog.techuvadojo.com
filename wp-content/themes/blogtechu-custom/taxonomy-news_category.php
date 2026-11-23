<?php
/**
 * News taxonomy archive (News Categories & News Tags).
 *
 * Used for taxonomy-news_category.php; News Tags fall back here via a copy.
 *
 * @package Blogtechu_Custom
 */

get_header();

$term      = get_queried_object();
$news_page = get_page_by_path( 'news' );
$news_url  = $news_page ? get_permalink( $news_page ) : home_url( '/' );

if ( ! function_exists( 'blogtechu_news_cat_name' ) ) {
	function blogtechu_news_cat_name( $post_id ) {
		$terms = get_the_terms( $post_id, 'news_category' );
		return ( $terms && ! is_wp_error( $terms ) ) ? $terms[0]->name : __( 'News', 'blogtechu-custom' );
	}
}
?>

<section class="nw-head">
	<div class="nw-head-inner">
		<span class="nw-head-eyebrow">📰 <?php esc_html_e( 'Tech News', 'blogtechu-custom' ); ?></span>
		<h1 class="nw-head-title"><?php echo esc_html( $term->name ); ?></h1>
		<?php if ( ! empty( $term->description ) ) : ?>
			<p class="nw-head-text"><?php echo esc_html( $term->description ); ?></p>
		<?php endif; ?>
		<a class="nw-single-back mt-2 text-brand-300 hover:text-white" href="<?php echo esc_url( $news_url ); ?>">← <?php esc_html_e( 'All News', 'blogtechu-custom' ); ?></a>
	</div>
</section>

<section class="nw-section">
	<?php if ( have_posts() ) : ?>
		<div class="nb-catgrid">
			<?php
			while ( have_posts() ) :
				the_post();
				blogtechu_render_news_card();
			endwhile;
			?>
		</div>

		<?php get_template_part( 'template-parts/navigation/pagination' ); ?>
	<?php else : ?>
		<div class="nw-empty"><?php esc_html_e( 'No news articles in this section yet.', 'blogtechu-custom' ); ?></div>
	<?php endif; ?>
</section>

<?php
get_footer();
