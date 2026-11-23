<?php
/**
 * Template for the Careers landing page (slug "careers").
 *
 * Dynamic, CPT-driven: dark hero + stats strip, a perks grid, open positions
 * (live search + department filter) beside a resume + hiring-process sidebar,
 * a general application form (shared handler) and a closing CTA. Each job's
 * "Apply Now" opens its full detail page (single-job.php).
 *
 * @package Blogtechu_Custom
 */

get_header();

$cr_resume_mail = 'mailto:hello@techuvadojo.com?subject=' . rawurlencode( 'Resume Submission – TechuvaDojo' );

/* Departments for the dropdown (from the taxonomy). */
$cr_terms = get_terms(
	array(
		'taxonomy'   => 'job_department',
		'hide_empty' => true,
	)
);

$cr_open  = (int) wp_count_posts( 'job' )->publish;
$cr_depts = ( $cr_terms && ! is_wp_error( $cr_terms ) ) ? count( $cr_terms ) : 0;
?>

<!-- Hero -->
<section class="cr-hero">
	<div class="cr-hero-inner">
		<div class="cr-hero-content">
			<span class="cr-hero-eyebrow"><span class="cr-dot"></span><?php esc_html_e( 'We Are Hiring', 'blogtechu-custom' ); ?></span>
			<h1 class="cr-hero-title">
				<?php echo wp_kses( __( 'Build Your Career With <em>TechuvaDojo</em>', 'blogtechu-custom' ), array( 'em' => array() ) ); ?>
			</h1>
			<p class="cr-hero-text"><?php esc_html_e( "We're more than just a tech company – we're a team of passionate problem solvers, creators, and innovators. Join us and be part of something amazing.", 'blogtechu-custom' ); ?></p>

			<div class="cr-hero-actions">
				<a class="cr-hero-btn" href="#open-roles"><?php esc_html_e( 'View Open Positions', 'blogtechu-custom' ); ?> <span aria-hidden="true">→</span></a>
				<a class="cr-hero-btn is-ghost" href="#life"><?php esc_html_e( 'Life at TechuvaDojo', 'blogtechu-custom' ); ?></a>
			</div>
		</div>

		<div class="cr-hero-visual">
			<?php $cr_svg = get_theme_file_uri( '/assets/images/careers-hero.svg' ); $cr_ver = filemtime( get_theme_file_path( '/assets/images/careers-hero.svg' ) ); ?>
			<img class="cr-hero-img" src="<?php echo esc_url( add_query_arg( 'v', $cr_ver, $cr_svg ) ); ?>" alt="" loading="eager" decoding="async" />
			<?php if ( $cr_open > 0 ) : ?>
				<div class="cr-hero-card">
					<span class="cr-hero-card-label"><?php esc_html_e( 'Open Positions', 'blogtechu-custom' ); ?></span>
					<strong class="cr-hero-card-num"><?php echo esc_html( number_format_i18n( $cr_open ) ); ?></strong>
					<a class="cr-hero-card-link" href="#open-roles"><?php esc_html_e( 'Join Our Team →', 'blogtechu-custom' ); ?></a>
				</div>
			<?php endif; ?>
		</div>
	</div>

	<!-- Stats strip -->
	<div class="cr-stats">
		<div class="cr-stat">
			<span class="cr-stat-ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="7" width="18" height="13" rx="2"/><path d="M8 7V5a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2M3 13h18"/></svg></span>
			<span><strong><?php echo esc_html( number_format_i18n( $cr_open ) ); ?></strong><em><?php esc_html_e( 'Open Roles', 'blogtechu-custom' ); ?></em></span>
		</div>
		<div class="cr-stat">
			<span class="cr-stat-ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M3 21h18M5 21V7l7-4 7 4v14M9 9h.01M9 13h.01M9 17h.01M15 9h.01M15 13h.01M15 17h.01"/></svg></span>
			<span><strong><?php echo esc_html( number_format_i18n( $cr_depts ) ); ?></strong><em><?php esc_html_e( 'Departments', 'blogtechu-custom' ); ?></em></span>
		</div>
		<div class="cr-stat">
			<span class="cr-stat-ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M8 9l-4 3 4 3M16 9l4 3-4 3M13 6l-2 12"/></svg></span>
			<span><strong>20+</strong><em><?php esc_html_e( 'Technologies', 'blogtechu-custom' ); ?></em></span>
		</div>
		<div class="cr-stat">
			<span class="cr-stat-ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="M3 12h18M12 3a15 15 0 0 1 0 18M12 3a15 15 0 0 0 0 18"/></svg></span>
			<span><strong><?php esc_html_e( '100%', 'blogtechu-custom' ); ?></strong><em><?php esc_html_e( 'Remote-Friendly', 'blogtechu-custom' ); ?></em></span>
		</div>
	</div>
</section>

<!-- More than a workplace (perks) -->
<section class="cr-perks" id="life">
	<div class="cr-perks-inner">
		<div class="cr-perks-head">
			<span class="section-eyebrow"><?php esc_html_e( "Why You'll Love It Here", 'blogtechu-custom' ); ?></span>
			<h2 class="cr-pos-title"><?php esc_html_e( 'More Than Just a Workplace', 'blogtechu-custom' ); ?></h2>
			<p class="cr-pos-sub mx-auto"><?php esc_html_e( 'We believe in creating an environment where great people can do their best work and grow together.', 'blogtechu-custom' ); ?></p>
		</div>
		<div class="cr-perks-grid">
			<?php
			$perks = array(
				array( 'title' => __( 'Growth & Learning', 'blogtechu-custom' ), 'desc' => __( 'Continuous learning and career development.', 'blogtechu-custom' ), 'icon' => '<path d="M3 3v18h18"/><path d="M7 13l3-3 3 3 5-6"/>' ),
				array( 'title' => __( 'Work-Life Balance', 'blogtechu-custom' ), 'desc' => __( 'Flexible hours and remote work opportunities.', 'blogtechu-custom' ), 'icon' => '<circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/>' ),
				array( 'title' => __( 'Innovative Culture', 'blogtechu-custom' ), 'desc' => __( 'Work on cutting-edge technologies and exciting projects.', 'blogtechu-custom' ), 'icon' => '<path d="M9.5 18h5M10 21h4"/><path d="M12 3a6 6 0 0 0-4 10.5c.7.7 1 1.4 1 2.5h6c0-1.1.3-1.8 1-2.5A6 6 0 0 0 12 3z"/>' ),
				array( 'title' => __( 'Health & Wellness', 'blogtechu-custom' ), 'desc' => __( 'Wellness support and a healthy work environment.', 'blogtechu-custom' ), 'icon' => '<path d="M19 14c1.4-1.5 2-3.4 2-5a4.5 4.5 0 0 0-8-2.6A4.5 4.5 0 0 0 5 9c0 1.6.6 3.5 2 5l5 5z"/>' ),
				array( 'title' => __( 'Team & Events', 'blogtechu-custom' ), 'desc' => __( 'Regular team events, outings and fun activities.', 'blogtechu-custom' ), 'icon' => '<rect x="3" y="4" width="18" height="17" rx="2"/><path d="M3 9h18M8 2v4M16 2v4"/>' ),
				array( 'title' => __( 'Competitive Pay', 'blogtechu-custom' ), 'desc' => __( 'Attractive compensation and performance bonuses.', 'blogtechu-custom' ), 'icon' => '<rect x="2" y="6" width="20" height="13" rx="2"/><path d="M2 10h20"/><circle cx="17" cy="14.5" r="1.2"/>' ),
			);
			foreach ( $perks as $p ) :
				?>
				<article class="cr-perk">
					<span class="cr-perk-ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><?php echo $p['icon']; // phpcs:ignore WordPress.Security.EscapeOutput ?></svg></span>
					<h3 class="cr-perk-title"><?php echo esc_html( $p['title'] ); ?></h3>
					<p class="cr-perk-desc"><?php echo esc_html( $p['desc'] ); ?></p>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<!-- Open positions -->
<section class="cr-pos" id="open-roles">
	<div class="cr-pos-inner">
		<div class="cr-pos-head">
			<div>
				<span class="section-eyebrow"><?php esc_html_e( 'Career Opportunities', 'blogtechu-custom' ); ?></span>
				<h2 class="cr-pos-title"><?php esc_html_e( 'Open Positions', 'blogtechu-custom' ); ?></h2>
				<p class="cr-pos-sub"><?php esc_html_e( 'Find the perfect role and start your journey with us.', 'blogtechu-custom' ); ?></p>
			</div>
			<div class="cr-pos-filters">
				<div class="cr-search">
					<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="11" cy="11" r="7"/><path d="M21 21l-4-4"/></svg>
					<input type="search" data-cr-search placeholder="<?php esc_attr_e( 'Search job title, keyword…', 'blogtechu-custom' ); ?>" aria-label="<?php esc_attr_e( 'Search jobs', 'blogtechu-custom' ); ?>" />
				</div>
				<select class="cr-select" data-cr-dept aria-label="<?php esc_attr_e( 'Filter by department', 'blogtechu-custom' ); ?>">
					<option value=""><?php esc_html_e( 'All Departments', 'blogtechu-custom' ); ?></option>
					<?php if ( $cr_terms && ! is_wp_error( $cr_terms ) ) : ?>
						<?php foreach ( $cr_terms as $term ) : ?>
							<option value="<?php echo esc_attr( $term->slug ); ?>"><?php echo esc_html( $term->name ); ?></option>
						<?php endforeach; ?>
					<?php endif; ?>
				</select>
			</div>
		</div>

		<div class="cr-pos-grid">
			<!-- Jobs list -->
			<div>
				<div class="cr-jobs-list" data-cr-list>
					<?php
					$jobs_q = new WP_Query(
						array(
							'post_type'      => 'job',
							'post_status'    => 'publish',
							'posts_per_page' => -1,
							'orderby'        => 'date',
							'order'          => 'DESC',
						)
					);
					if ( $jobs_q->have_posts() ) :
						while ( $jobs_q->have_posts() ) :
							$jobs_q->the_post();
							blogtechu_render_job_card();
						endwhile;
						wp_reset_postdata();
					else :
						?>
						<p class="cr-jobs-empty"><?php esc_html_e( 'No open positions right now — check back soon, or send us your resume below!', 'blogtechu-custom' ); ?></p>
					<?php endif; ?>
				</div>
				<p class="cr-jobs-empty" data-cr-empty style="display:none;"><?php esc_html_e( 'No openings match your search — try a different keyword or department.', 'blogtechu-custom' ); ?></p>
				<div class="cr-pos-more">
					<a class="cr-more-btn" href="#open-roles"><?php esc_html_e( 'View All Openings', 'blogtechu-custom' ); ?> <span aria-hidden="true">→</span></a>
				</div>
			</div>

			<!-- Sidebar -->
			<aside class="cr-pos-side">
				<div class="cr-why">
					<h3 class="cr-why-title"><?php esc_html_e( 'Why Join Us?', 'blogtechu-custom' ); ?></h3>
					<ul class="cr-why-list">
						<li>
							<span class="cr-why-ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3l8 3v5c0 5-3.5 8-8 10-4.5-2-8-5-8-10V6z"/><path d="M9 12l2 2 4-4"/></svg></span>
							<span><strong><?php esc_html_e( 'Work on exciting projects', 'blogtechu-custom' ); ?></strong><em><?php esc_html_e( 'Solve real-world problems and build impactful solutions.', 'blogtechu-custom' ); ?></em></span>
						</li>
						<li>
							<span class="cr-why-ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3c3 1.6 5 5 5 9l-2.5 2.5h-5L7 12c0-4 2-7.4 5-9z"/><circle cx="12" cy="9" r="1.6"/><path d="M9.5 14.5l-2.5 4 4-1.5M14.5 14.5l2.5 4-4-1.5"/></svg></span>
							<span><strong><?php esc_html_e( 'Career growth', 'blogtechu-custom' ); ?></strong><em><?php esc_html_e( 'We invest in your growth and help you reach your full potential.', 'blogtechu-custom' ); ?></em></span>
						</li>
						<li>
							<span class="cr-why-ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></svg></span>
							<span><strong><?php esc_html_e( 'Flexible work', 'blogtechu-custom' ); ?></strong><em><?php esc_html_e( 'Enjoy flexible hours and work from anywhere.', 'blogtechu-custom' ); ?></em></span>
						</li>
						<li>
							<span class="cr-why-ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="8" r="3"/><path d="M2 20a7 7 0 0 1 14 0"/><circle cx="17" cy="9" r="2.5"/><path d="M22 19a5 5 0 0 0-7-4.6"/></svg></span>
							<span><strong><?php esc_html_e( 'Amazing team', 'blogtechu-custom' ); ?></strong><em><?php esc_html_e( 'Be part of a supportive and talented team.', 'blogtechu-custom' ); ?></em></span>
						</li>
						<li>
							<span class="cr-why-ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3l8 3v5c0 5-3.5 8-8 10-4.5-2-8-5-8-10V6z"/><path d="M12 8v6M9 11h6"/></svg></span>
							<span><strong><?php esc_html_e( 'Competitive benefits', 'blogtechu-custom' ); ?></strong><em><?php esc_html_e( 'We offer great compensation and additional perks.', 'blogtechu-custom' ); ?></em></span>
						</li>
					</ul>
				</div>

				<div class="cr-resume">
					<span class="cr-resume-ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="M3 7l9 6 9-6"/><path d="M16 3l5 2-2 5"/></svg></span>
					<h3 class="cr-resume-title"><?php esc_html_e( "Don't See the Right Fit?", 'blogtechu-custom' ); ?></h3>
					<p class="cr-resume-text"><?php esc_html_e( "We're always looking for talented and passionate people. Send us your resume and we'll keep you in mind for future opportunities.", 'blogtechu-custom' ); ?></p>
					<a class="cr-resume-btn" href="<?php echo esc_url( $cr_resume_mail ); ?>"><?php esc_html_e( 'Send Your Resume', 'blogtechu-custom' ); ?> <span aria-hidden="true">→</span></a>
				</div>

				<div class="cr-process">
					<h3 class="cr-process-title"><?php esc_html_e( 'Our Hiring Process', 'blogtechu-custom' ); ?></h3>
					<ol class="cr-process-list">
						<?php
						$steps = array(
							array( __( 'Apply Online', 'blogtechu-custom' ), __( 'Submit your application and resume.', 'blogtechu-custom' ) ),
							array( __( 'Screening', 'blogtechu-custom' ), __( 'Our team reviews your application.', 'blogtechu-custom' ) ),
							array( __( 'Interview', 'blogtechu-custom' ), __( 'Technical and HR interview rounds.', 'blogtechu-custom' ) ),
							array( __( 'Offer', 'blogtechu-custom' ), __( 'We extend an offer and welcome you onboard!', 'blogtechu-custom' ) ),
						);
						foreach ( $steps as $i => $step ) :
							?>
							<li class="cr-process-step">
								<span class="cr-process-num"><?php echo esc_html( $i + 1 ); ?></span>
								<span><strong><?php echo esc_html( $step[0] ); ?></strong><em><?php echo esc_html( $step[1] ); ?></em></span>
							</li>
						<?php endforeach; ?>
					</ol>
				</div>
			</aside>
		</div>
	</div>
</section>

<!-- Our Culture -->
<section class="cr-culture">
	<div class="cr-culture-inner">
		<div class="cr-culture-head">
			<span class="section-eyebrow"><?php esc_html_e( 'Our Culture', 'blogtechu-custom' ); ?></span>
			<h2 class="cr-pos-title"><?php esc_html_e( 'A Place Where You Can Thrive', 'blogtechu-custom' ); ?></h2>
			<p class="cr-pos-sub"><?php esc_html_e( 'We believe in creating an environment where everyone feels valued, inspired, and empowered to do their best work.', 'blogtechu-custom' ); ?></p>
		</div>
		<div class="cr-culture-grid">
			<?php
			$culture = array(
				array( 'title' => __( 'Collaborate', 'blogtechu-custom' ), 'desc' => __( 'We work together and support each other.', 'blogtechu-custom' ), 'tone' => 'blue', 'icon' => '<circle cx="9" cy="8" r="3"/><path d="M2 20a7 7 0 0 1 14 0"/><circle cx="17" cy="9" r="2.5"/><path d="M22 19a5 5 0 0 0-7-4.6"/>' ),
				array( 'title' => __( 'Innovate', 'blogtechu-custom' ), 'desc' => __( 'We embrace new ideas and creative solutions.', 'blogtechu-custom' ), 'tone' => 'purple', 'icon' => '<path d="M9.5 18h5M10 21h4"/><path d="M12 3a6 6 0 0 0-4 10.5c.7.7 1 1.4 1 2.5h6c0-1.1.3-1.8 1-2.5A6 6 0 0 0 12 3z"/>' ),
				array( 'title' => __( 'Grow', 'blogtechu-custom' ), 'desc' => __( 'We learn, improve and grow together.', 'blogtechu-custom' ), 'tone' => 'green', 'icon' => '<path d="M3 3v18h18"/><path d="M7 14l3-3 3 3 5-6"/>' ),
				array( 'title' => __( 'Celebrate', 'blogtechu-custom' ), 'desc' => __( 'We celebrate wins and enjoy the journey.', 'blogtechu-custom' ), 'tone' => 'orange', 'icon' => '<path d="M8 21h8M12 17v4"/><path d="M7 4h10v4a5 5 0 0 1-10 0z"/><path d="M5 5a2 2 0 0 0 2 2M19 5a2 2 0 0 1-2 2"/>' ),
			);
			foreach ( $culture as $c ) :
				?>
				<article class="cr-culture-card cr-cult-<?php echo esc_attr( $c['tone'] ); ?>">
					<span class="cr-culture-ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><?php echo $c['icon']; // phpcs:ignore WordPress.Security.EscapeOutput ?></svg></span>
					<div class="cr-culture-body">
						<h3 class="cr-culture-title"><?php echo esc_html( $c['title'] ); ?></h3>
						<p class="cr-culture-text"><?php echo esc_html( $c['desc'] ); ?></p>
					</div>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<!-- Closing CTA -->
<section class="cr-cta-wrap">
	<div class="cr-cta">
		<div class="cr-cta-text">
			<h2 class="cr-cta-title"><?php esc_html_e( 'Ready to Build Something Amazing?', 'blogtechu-custom' ); ?></h2>
			<p class="cr-cta-sub"><?php esc_html_e( "Be a part of a team that's shaping the future of technology and making a real impact.", 'blogtechu-custom' ); ?></p>
		</div>
		<div class="cr-cta-actions">
			<a class="cr-cta-btn" href="#open-roles"><?php esc_html_e( 'View Open Positions', 'blogtechu-custom' ); ?> <span aria-hidden="true">→</span></a>
			<a class="cr-cta-btn is-ghost" href="<?php echo esc_url( $cr_resume_mail ); ?>"><?php esc_html_e( 'Send Your Resume', 'blogtechu-custom' ); ?> <span aria-hidden="true">→</span></a>
		</div>
	</div>
</section>

<?php
get_footer();
