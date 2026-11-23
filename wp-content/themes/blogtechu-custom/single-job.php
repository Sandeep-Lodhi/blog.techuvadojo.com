<?php
/**
 * Single Job detail page — full description + application form.
 *
 * @package Blogtechu_Custom
 */

$app = blogtechu_process_job_application();

get_header();

$careers_page = get_page_by_path( 'careers' );
$careers_url  = $careers_page ? get_permalink( $careers_page ) : home_url( '/careers/' );

while ( have_posts() ) :
	the_post();

	$dept     = blogtechu_job_department();
	$type     = blogtechu_job_meta( 'type', __( 'Full Time', 'blogtechu-custom' ) );
	$work     = blogtechu_job_meta( 'work', __( 'Remote', 'blogtechu-custom' ) );
	$exp      = blogtechu_job_meta( 'exp', '' );
	$location = blogtechu_job_meta( 'location', __( 'Remote', 'blogtechu-custom' ) );
	$salary   = blogtechu_job_meta( 'salary', '' );
	$icon     = blogtechu_job_meta( 'icon', 'stack' );
	$tone     = blogtechu_job_meta( 'tone', 'blue' );
	$title    = get_the_title();
	?>

	<!-- Job hero -->
	<section class="sj-hero">
		<div class="sj-hero-inner">
			<nav class="sj-crumb" aria-label="<?php esc_attr_e( 'Breadcrumb', 'blogtechu-custom' ); ?>">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'blogtechu-custom' ); ?></a>
				<span aria-hidden="true">›</span>
				<a href="<?php echo esc_url( $careers_url ); ?>"><?php esc_html_e( 'Careers', 'blogtechu-custom' ); ?></a>
				<span aria-hidden="true">›</span>
				<span class="sj-crumb-current"><?php echo esc_html( $title ); ?></span>
			</nav>

			<div class="sj-hero-main">
				<span class="sj-hero-ico cr-tone-<?php echo esc_attr( $tone ); ?>"><?php echo blogtechu_job_icon_svg( $icon ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span>
				<div>
					<h1 class="sj-hero-title"><?php echo esc_html( $title ); ?></h1>
					<div class="sj-hero-meta">
						<?php if ( $dept['name'] ) : ?><span><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="7" width="18" height="13" rx="2"/><path d="M8 7V5a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg><?php echo esc_html( $dept['name'] ); ?></span><?php endif; ?>
						<span><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 21s7-5.5 7-11a7 7 0 1 0-14 0c0 5.5 7 11 7 11z"/><circle cx="12" cy="10" r="2.5"/></svg><?php echo esc_html( $location ); ?></span>
						<span><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="16" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg><?php echo esc_html( get_the_date() ); ?></span>
					</div>
					<div class="sj-hero-tags">
						<span class="sj-tag"><?php echo esc_html( $type ); ?></span>
						<span class="sj-tag"><?php echo esc_html( $work ); ?></span>
						<?php if ( $exp ) : ?><span class="sj-tag"><?php echo esc_html( $exp ); ?></span><?php endif; ?>
					</div>
				</div>
				<a class="sj-hero-apply" href="#apply"><?php esc_html_e( 'Apply Now', 'blogtechu-custom' ); ?> <span aria-hidden="true">→</span></a>
			</div>
		</div>
	</section>

	<!-- Body -->
	<section class="sj-body">
		<div class="sj-layout">

			<!-- Main -->
			<div class="sj-main">
				<?php if ( get_the_content() ) : ?>
					<div class="sj-block">
						<h2 class="sj-h2"><?php esc_html_e( 'About the Role', 'blogtechu-custom' ); ?></h2>
						<div class="sj-prose"><?php the_content(); ?></div>
					</div>
				<?php endif; ?>

				<?php $resp = blogtechu_job_meta( 'responsibilities', '' ); ?>
				<?php if ( $resp ) : ?>
					<div class="sj-block">
						<h2 class="sj-h2"><?php esc_html_e( 'Key Responsibilities', 'blogtechu-custom' ); ?></h2>
						<?php blogtechu_job_list( $resp, 'check' ); ?>
					</div>
				<?php endif; ?>

				<?php $reqs = blogtechu_job_meta( 'requirements', '' ); ?>
				<?php if ( $reqs ) : ?>
					<div class="sj-block">
						<h2 class="sj-h2"><?php esc_html_e( 'Requirements', 'blogtechu-custom' ); ?></h2>
						<?php blogtechu_job_list( $reqs, 'dot' ); ?>
					</div>
				<?php endif; ?>

				<?php $bens = blogtechu_job_meta( 'benefits', '' ); ?>
				<?php if ( $bens ) : ?>
					<div class="sj-block">
						<h2 class="sj-h2"><?php esc_html_e( 'Perks & Benefits', 'blogtechu-custom' ); ?></h2>
						<?php blogtechu_job_list( $bens, 'check' ); ?>
					</div>
				<?php endif; ?>

				<div class="sj-cta-inline">
					<div>
						<h3 class="sj-cta-title"><?php esc_html_e( 'Ready to apply?', 'blogtechu-custom' ); ?></h3>
						<p class="sj-cta-text"><?php esc_html_e( 'Fill in the form below — it only takes a couple of minutes.', 'blogtechu-custom' ); ?></p>
					</div>
					<a class="sj-cta-btn" href="#apply"><?php esc_html_e( 'Apply for this role', 'blogtechu-custom' ); ?> <span aria-hidden="true">→</span></a>
				</div>
			</div>

			<!-- Sidebar -->
			<aside class="sj-side">
				<div class="sj-summary">
					<h3 class="sj-summary-title"><?php esc_html_e( 'Job Overview', 'blogtechu-custom' ); ?></h3>
					<ul class="sj-summary-list">
						<?php if ( $dept['name'] ) : ?>
							<li><span class="sj-summary-ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="7" width="18" height="13" rx="2"/><path d="M8 7V5a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg></span><span><em><?php esc_html_e( 'Department', 'blogtechu-custom' ); ?></em><strong><?php echo esc_html( $dept['name'] ); ?></strong></span></li>
						<?php endif; ?>
						<li><span class="sj-summary-ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="4" y="4" width="16" height="16" rx="2"/><path d="M8 9h8M8 13h5"/></svg></span><span><em><?php esc_html_e( 'Employment Type', 'blogtechu-custom' ); ?></em><strong><?php echo esc_html( $type ); ?></strong></span></li>
						<li><span class="sj-summary-ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 21s7-5.5 7-11a7 7 0 1 0-14 0c0 5.5 7 11 7 11z"/><circle cx="12" cy="10" r="2.5"/></svg></span><span><em><?php esc_html_e( 'Location', 'blogtechu-custom' ); ?></em><strong><?php echo esc_html( $location ); ?> · <?php echo esc_html( $work ); ?></strong></span></li>
						<?php if ( $exp ) : ?>
							<li><span class="sj-summary-ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></svg></span><span><em><?php esc_html_e( 'Experience', 'blogtechu-custom' ); ?></em><strong><?php echo esc_html( $exp ); ?></strong></span></li>
						<?php endif; ?>
						<?php if ( $salary ) : ?>
							<li><span class="sj-summary-ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="M12 7v10M14.5 9.5a2.5 2.5 0 0 0-5 0c0 3 5 1.5 5 4.5a2.5 2.5 0 0 1-5 0"/></svg></span><span><em><?php esc_html_e( 'Salary', 'blogtechu-custom' ); ?></em><strong><?php echo esc_html( $salary ); ?></strong></span></li>
						<?php endif; ?>
					</ul>
					<a class="sj-summary-btn" href="#apply"><?php esc_html_e( 'Apply Now', 'blogtechu-custom' ); ?> <span aria-hidden="true">→</span></a>
					<a class="sj-summary-back" href="<?php echo esc_url( $careers_url ); ?>">← <?php esc_html_e( 'Back to all jobs', 'blogtechu-custom' ); ?></a>
				</div>
			</aside>

		</div>
	</section>

	<!-- Application form -->
	<section class="cr-apply" id="apply">
		<div class="cr-apply-card">
			<div class="text-center">
				<span class="section-eyebrow"><?php esc_html_e( 'Application', 'blogtechu-custom' ); ?></span>
				<h2 class="cr-pos-title"><?php
					/* translators: %s: job title */
					printf( esc_html__( 'Apply for %s', 'blogtechu-custom' ), esc_html( $title ) );
				?></h2>
				<p class="cr-pos-sub mx-auto"><?php esc_html_e( "Tell us a bit about yourself and attach your resume — we'll be in touch.", 'blogtechu-custom' ); ?></p>
			</div>
			<?php blogtechu_render_apply_form( $app, $title ); ?>
		</div>
	</section>

	<!-- Other openings -->
	<?php
	$others = new WP_Query(
		array(
			'post_type'      => 'job',
			'post_status'    => 'publish',
			'posts_per_page' => 3,
			'post__not_in'   => array( get_the_ID() ),
			'orderby'        => 'rand',
		)
	);
	if ( $others->have_posts() ) :
		?>
		<section class="sj-others">
			<div class="sj-others-inner">
				<h2 class="cr-pos-title"><?php esc_html_e( 'Other Open Positions', 'blogtechu-custom' ); ?></h2>
				<div class="cr-jobs-list" style="margin-top:1.5rem;">
					<?php
					while ( $others->have_posts() ) :
						$others->the_post();
						blogtechu_render_job_card();
					endwhile;
					wp_reset_postdata();
					?>
				</div>
			</div>
		</section>
	<?php endif; ?>

<?php
endwhile;

get_footer();
