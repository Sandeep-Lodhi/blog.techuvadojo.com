<?php
/**
 * Template for the Team page (slug "team").
 *
 * Hero with team photo + stats, leadership grid, teams by department, "Life at
 * TechuvaDojo" values, a stats band, team moments, culture voices and a CTA.
 * Team members are sample placeholders — replace with real people.
 *
 * @package Blogtechu_Custom
 */

get_header();

$careers_url  = home_url( '/careers' );
$contact_url  = home_url( '/contact' );
$linkedin_url = 'https://www.linkedin.com/in/sandeep-lodhi-30293620b';
$avatar_base  = get_theme_file_uri( '/assets/images/team/' );

$tm_av = function ( $file ) use ( $avatar_base ) {
	return esc_url( $avatar_base . $file . '.jpg' );
};

$tm_icon = function ( $inner ) {
	return '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">' . $inner . '</svg>';
};
$li_svg = '<svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M20.45 20.45h-3.56v-5.57c0-1.33-.02-3.04-1.85-3.04-1.85 0-2.13 1.45-2.13 2.94v5.67H9.35V9h3.41v1.56h.05c.48-.9 1.64-1.85 3.37-1.85 3.6 0 4.27 2.37 4.27 5.46v6.28zM5.34 7.43a2.07 2.07 0 1 1 0-4.14 2.07 2.07 0 0 1 0 4.14zM7.12 20.45H3.56V9h3.56v11.45zM22.22 0H1.77C.79 0 0 .77 0 1.73v20.54C0 23.23.79 24 1.77 24h20.45c.98 0 1.78-.77 1.78-1.73V1.73C24 .77 23.2 0 22.22 0z"/></svg>';
?>

<!-- Hero -->
<section class="tm-hero">
	<div class="tm-hero-inner">
		<div class="tm-hero-content">
			<span class="section-eyebrow"><?php esc_html_e( 'Our Team', 'blogtechu-custom' ); ?></span>
			<h1 class="tm-hero-title"><?php echo wp_kses( __( 'Meet the Experts Behind <em>TechuvaDojo</em>', 'blogtechu-custom' ), array( 'em' => array() ) ); ?></h1>
			<p class="tm-hero-text"><?php esc_html_e( 'Building innovative digital solutions through collaboration, creativity, and technology.', 'blogtechu-custom' ); ?></p>
			<div class="tm-hero-actions">
				<a class="au-btn" href="<?php echo esc_url( $careers_url ); ?>"><?php esc_html_e( 'Join Our Team', 'blogtechu-custom' ); ?> <span aria-hidden="true">→</span></a>
				<a class="au-btn is-ghost" href="<?php echo esc_url( $careers_url ); ?>"><?php esc_html_e( 'View Open Positions', 'blogtechu-custom' ); ?></a>
			</div>
		</div>
		<div class="tm-hero-visual">
			<img class="tm-hero-img" src="<?php echo esc_url( add_query_arg( 'v', filemtime( get_theme_file_path( '/assets/images/about-team.png' ) ), get_theme_file_uri( '/assets/images/about-team.png' ) ) ); ?>" alt="<?php esc_attr_e( 'The TechuvaDojo team', 'blogtechu-custom' ); ?>" loading="eager" decoding="async" />
			<div class="tm-hero-stats">
				<div class="tm-hero-stat"><span class="tm-hs-ico cr-tone-blue"><?php echo $tm_icon( '<circle cx="9" cy="8" r="3"/><path d="M2 20a7 7 0 0 1 14 0"/><circle cx="17" cy="9" r="2.5"/><path d="M22 19a5 5 0 0 0-7-4.6"/>' ); // phpcs:ignore ?></span><span><strong>15+</strong><em><?php esc_html_e( 'Team Members', 'blogtechu-custom' ); ?></em></span></div>
				<div class="tm-hero-stat"><span class="tm-hs-ico cr-tone-green"><?php echo $tm_icon( '<rect x="3" y="7" width="18" height="13" rx="2"/><path d="M8 7V5a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/>' ); // phpcs:ignore ?></span><span><strong>13+</strong><em><?php esc_html_e( 'Projects Delivered', 'blogtechu-custom' ); ?></em></span></div>
				<div class="tm-hero-stat"><span class="tm-hs-ico cr-tone-purple"><?php echo $tm_icon( '<circle cx="12" cy="12" r="9"/><path d="M3 12h18M12 3a15 15 0 0 1 0 18M12 3a15 15 0 0 0 0 18"/>' ); // phpcs:ignore ?></span><span><strong>6+</strong><em><?php esc_html_e( 'Countries Served', 'blogtechu-custom' ); ?></em></span></div>
				<div class="tm-hero-stat"><span class="tm-hs-ico cr-tone-orange"><?php echo $tm_icon( '<circle cx="12" cy="12" r="9"/><path d="M9 10h.01M15 10h.01M8.5 14a4 4 0 0 0 7 0"/>' ); // phpcs:ignore ?></span><span><strong>100%</strong><em><?php esc_html_e( 'Client Focus', 'blogtechu-custom' ); ?></em></span></div>
			</div>
		</div>
	</div>
</section>

<!-- Leadership -->
<section class="tm-lead">
	<div class="tm-wrap">
		<div class="tm-head"><h2 class="tm-h2"><?php esc_html_e( 'Leadership Team', 'blogtechu-custom' ); ?></h2><span class="tm-rule"></span></div>
		<div class="tm-lead-grid">
			<?php
			$leaders = array(
				array( 'Sandeep Lodhi', __( 'Founder & CEO', 'blogtechu-custom' ), 'm1', $linkedin_url ),
				array( 'Anjali Sharma', __( 'Chief Technology Officer', 'blogtechu-custom' ), 'w1', '#' ),
				array( 'Priya Mehta', __( 'Chief Operating Officer', 'blogtechu-custom' ), 'w2', '#' ),
				array( 'Vikram Singh', __( 'Head of Engineering', 'blogtechu-custom' ), 'm2', '#' ),
			);
			foreach ( $leaders as $l ) :
				?>
				<article class="tm-lead-card">
					<div class="tm-lead-photo"><img src="<?php echo $tm_av( $l[2] ); ?>" alt="<?php echo esc_attr( $l[0] ); ?>" loading="lazy" /></div>
					<div class="tm-lead-body">
						<div>
							<h3 class="tm-lead-name"><?php echo esc_html( $l[0] ); ?></h3>
							<p class="tm-lead-role"><?php echo esc_html( $l[1] ); ?></p>
						</div>
						<a class="tm-lead-li" href="<?php echo esc_url( $l[3] ); ?>"<?php echo '#' === $l[3] ? '' : ' target="_blank" rel="noopener"'; ?> aria-label="LinkedIn"><?php echo $li_svg; // phpcs:ignore ?></a>
					</div>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<!-- By department -->
<section class="tm-dept">
	<div class="tm-wrap">
		<div class="tm-head"><h2 class="tm-h2"><?php esc_html_e( 'Our Team By Department', 'blogtechu-custom' ); ?></h2><span class="tm-rule"></span></div>
		<div class="tm-dept-grid">
			<?php
			$depts = array(
				array( 'tone' => 'blue', 'icon' => '<path d="M8 9l-4 3 4 3M16 9l4 3-4 3M13 6l-2 12"/>', 'name' => __( 'Engineering Team', 'blogtechu-custom' ), 'members' => array( array( 'Senior MERN Dev', 'm3' ), array( 'Frontend Developer', 'm4' ), array( 'Backend Developer', 'm5' ), array( 'DevOps Engineer', 'm6' ), array( 'AI Engineer', 'w3' ) ) ),
				array( 'tone' => 'purple', 'icon' => '<path d="M15 4l5 5L9 20l-5 1 1-5z"/><path d="M13 6l5 5"/>', 'name' => __( 'Design Team', 'blogtechu-custom' ), 'members' => array( array( 'UI/UX Designer', 'w4' ), array( 'Graphic Designer', 'w5' ), array( 'Brand Designer', 'm7' ), array( 'Video Editor', 'm8' ) ) ),
				array( 'tone' => 'orange', 'icon' => '<path d="M3 11l14-7v16L3 13z"/><path d="M17 8a3 3 0 0 1 0 6"/>', 'name' => __( 'Marketing Team', 'blogtechu-custom' ), 'members' => array( array( 'SEO Specialist', 'w6' ), array( 'Content Writer', 'w7' ), array( 'Social Media', 'w8' ), array( 'PPC Expert', 'm9' ) ) ),
				array( 'tone' => 'green', 'icon' => '<rect x="6" y="4" width="12" height="16" rx="2"/><path d="M9 4h6v3H9zM9 11h6M9 15h4"/>', 'name' => __( 'Project Management', 'blogtechu-custom' ), 'members' => array( array( 'Project Manager', 'm10' ), array( 'Scrum Master', 'w9' ), array( 'Business Analyst', 'w10' ) ) ),
			);
			foreach ( $depts as $d ) :
				?>
				<article class="tm-dept-card">
					<div class="tm-dept-top"><span class="tm-dept-ico cr-tone-<?php echo esc_attr( $d['tone'] ); ?>"><?php echo $tm_icon( $d['icon'] ); // phpcs:ignore ?></span><h3 class="tm-dept-name"><?php echo esc_html( $d['name'] ); ?></h3></div>
					<div class="tm-dept-members">
						<?php foreach ( $d['members'] as $m ) : ?>
							<div class="tm-dept-member"><img src="<?php echo $tm_av( $m[1] ); ?>" alt="" loading="lazy" /><span><?php echo esc_html( $m[0] ); ?></span></div>
						<?php endforeach; ?>
					</div>
					<a class="tm-dept-link" href="<?php echo esc_url( $careers_url ); ?>"><?php esc_html_e( 'View Open Roles', 'blogtechu-custom' ); ?> <span aria-hidden="true">→</span></a>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<!-- Life at TechuvaDojo -->
<section class="tm-life">
	<div class="tm-wrap">
		<div class="tm-head"><h2 class="tm-h2"><?php esc_html_e( 'Life At TechuvaDojo', 'blogtechu-custom' ); ?></h2><span class="tm-rule"></span></div>
		<div class="tm-life-grid">
			<?php
			$life = array(
				array( 'blue', __( 'Innovation', 'blogtechu-custom' ), __( 'We encourage creativity and experimentation.', 'blogtechu-custom' ), '<path d="M9.5 18h5M10 21h4"/><path d="M12 3a6 6 0 0 0-4 10.5c.7.7 1 1.4 1 2.5h6c0-1.1.3-1.8 1-2.5A6 6 0 0 0 12 3z"/>' ),
				array( 'purple', __( 'Learning', 'blogtechu-custom' ), __( 'Continuous skill development and growth.', 'blogtechu-custom' ), '<path d="M22 10 12 5 2 10l10 5 10-5z"/><path d="M6 12v5c3 2 9 2 12 0v-5"/>' ),
				array( 'green', __( 'Collaboration', 'blogtechu-custom' ), __( 'Work together to solve complex challenges.', 'blogtechu-custom' ), '<circle cx="9" cy="8" r="3"/><path d="M2 20a7 7 0 0 1 14 0"/><circle cx="17" cy="9" r="2.5"/><path d="M22 19a5 5 0 0 0-7-4.6"/>' ),
				array( 'orange', __( 'Ownership', 'blogtechu-custom' ), __( 'Everyone contributes to company success.', 'blogtechu-custom' ), '<circle cx="12" cy="12" r="9"/><path d="M12 8v8M8 12h8"/>' ),
				array( 'sky', __( 'Flexibility', 'blogtechu-custom' ), __( 'Hybrid and remote-friendly environment.', 'blogtechu-custom' ), '<path d="M3 11l9-7 9 7"/><path d="M5 10v10h14V10"/>' ),
				array( 'pink', __( 'Recognition', 'blogtechu-custom' ), __( 'Celebrate achievements and milestones.', 'blogtechu-custom' ), '<path d="M8 21h8M12 17v4"/><path d="M7 4h10v4a5 5 0 0 1-10 0z"/><path d="M5 5a2 2 0 0 0 2 2M19 5a2 2 0 0 1-2 2"/>' ),
			);
			foreach ( $life as $v ) :
				?>
				<article class="tm-life-card">
					<span class="tm-life-ico"><?php echo $tm_icon( $v[3] ); // phpcs:ignore ?></span>
					<h3 class="tm-life-title"><?php echo esc_html( $v[1] ); ?></h3>
					<p class="tm-life-text"><?php echo esc_html( $v[2] ); ?></p>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<!-- Stats band -->
<section class="tm-band">
	<div class="tm-band-inner">
		<div class="tm-band-stat"><span class="tm-band-ico"><?php echo $tm_icon( '<circle cx="9" cy="8" r="3"/><path d="M2 20a7 7 0 0 1 14 0"/><circle cx="17" cy="9" r="2.5"/><path d="M22 19a5 5 0 0 0-7-4.6"/>' ); // phpcs:ignore ?></span><strong>15+</strong><em><?php esc_html_e( 'Team Members', 'blogtechu-custom' ); ?></em></div>
		<div class="tm-band-stat"><span class="tm-band-ico"><?php echo $tm_icon( '<rect x="3" y="7" width="18" height="13" rx="2"/><path d="M8 7V5a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/>' ); // phpcs:ignore ?></span><strong>13+</strong><em><?php esc_html_e( 'Projects Delivered', 'blogtechu-custom' ); ?></em></div>
		<div class="tm-band-stat"><span class="tm-band-ico"><?php echo $tm_icon( '<path d="M8 9l-4 3 4 3M16 9l4 3-4 3M13 6l-2 12"/>' ); // phpcs:ignore ?></span><strong>20+</strong><em><?php esc_html_e( 'Technologies', 'blogtechu-custom' ); ?></em></div>
		<div class="tm-band-stat"><span class="tm-band-ico"><?php echo $tm_icon( '<circle cx="12" cy="12" r="9"/><path d="M3 12h18M12 3a15 15 0 0 1 0 18M12 3a15 15 0 0 0 0 18"/>' ); // phpcs:ignore ?></span><strong>6+</strong><em><?php esc_html_e( 'Countries', 'blogtechu-custom' ); ?></em></div>
		<div class="tm-band-stat"><span class="tm-band-ico"><?php echo $tm_icon( '<circle cx="12" cy="12" r="9"/><path d="M9 10h.01M15 10h.01M8.5 14a4 4 0 0 0 7 0"/>' ); // phpcs:ignore ?></span><strong>100%</strong><em><?php esc_html_e( 'Client Focus', 'blogtechu-custom' ); ?></em></div>
	</div>
</section>

<!-- Team moments -->
<section class="tm-moments">
	<div class="tm-wrap">
		<div class="tm-head"><h2 class="tm-h2"><?php esc_html_e( 'Team Moments', 'blogtechu-custom' ); ?></h2><span class="tm-rule"></span></div>
		<div class="tm-moments-grid">
			<?php
			$moments = array(
				array( 'blue', __( 'Team Meetings', 'blogtechu-custom' ), '<rect x="3" y="4" width="18" height="14" rx="2"/><path d="M8 20h8M12 18v2"/>' ),
				array( 'purple', __( 'Office Events', 'blogtechu-custom' ), '<rect x="3" y="5" width="18" height="16" rx="2"/><path d="M3 9h18M8 3v4M16 3v4"/>' ),
				array( 'green', __( 'Hackathons', 'blogtechu-custom' ), '<path d="M13 2 4 14h7l-1 8 9-12h-7l1-8z"/>' ),
				array( 'orange', __( 'Client Meetings', 'blogtechu-custom' ), '<path d="M8 13l3 3a2 2 0 0 0 3 0l5-5"/><path d="M3 8l4-4 5 5M21 8l-4-4-3 3"/>' ),
				array( 'sky', __( 'Annual Trips', 'blogtechu-custom' ), '<path d="M3 18l4-9 5 4 4-8 5 13z"/>' ),
				array( 'pink', __( 'Celebrations', 'blogtechu-custom' ), '<path d="M2 22l5-13 8 8z"/><path d="M14 8a3 3 0 0 0-3-3M17 5a3 3 0 0 0-3-3M19 11a3 3 0 0 0 3-3"/>' ),
			);
			foreach ( $moments as $m ) :
				?>
				<article class="tm-moment tm-grad-<?php echo esc_attr( $m[0] ); ?>">
					<span class="tm-moment-ico"><?php echo $tm_icon( $m[2] ); // phpcs:ignore ?></span>
					<span class="tm-moment-label"><?php echo esc_html( $m[1] ); ?></span>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<!-- Voices -->
<section class="tm-voices">
	<div class="tm-wrap">
		<div class="tm-head"><h2 class="tm-h2"><?php esc_html_e( 'What Our Team Says', 'blogtechu-custom' ); ?></h2><span class="tm-rule"></span></div>
		<div class="tm-slider">
			<button type="button" class="tm-slider-btn tm-slider-prev" data-tm-prev aria-label="<?php esc_attr_e( 'Previous', 'blogtechu-custom' ); ?>"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 18l-6-6 6-6"/></svg></button>
			<div class="tm-voices-track" data-tm-track>
				<?php
				$voices = array(
					array( 'TechuvaDojo gives us real ownership and challenging projects that push us to learn and grow every day.', 'Arjun Patel', __( 'Senior Developer', 'blogtechu-custom' ), 'm3' ),
					array( 'A supportive culture and continuous learning keep me motivated to do my best work.', 'Sneha Kapoor', __( 'UI/UX Designer', 'blogtechu-custom' ), 'w4' ),
					array( 'I love the collaborative environment and the freedom to innovate. Your ideas truly matter here.', 'Karan Mehta', __( 'DevOps Engineer', 'blogtechu-custom' ), 'm6' ),
					array( 'The mentorship here is unreal. I have grown more in months than I expected in years.', 'Riya Sharma', __( 'Frontend Developer', 'blogtechu-custom' ), 'w5' ),
					array( 'Flexible hours and a remote-first culture let me do my best work without burning out.', 'Aman Gupta', __( 'Backend Developer', 'blogtechu-custom' ), 'm5' ),
					array( 'Leadership genuinely listens. Every idea gets a fair shot and that keeps us motivated.', 'Pooja Nair', __( 'Project Manager', 'blogtechu-custom' ), 'w9' ),
				);
				foreach ( $voices as $v ) :
					?>
					<article class="tm-voice">
						<div class="tm-voice-stars">★★★★★</div>
						<p class="tm-voice-text">&ldquo;<?php echo esc_html( $v[0] ); ?>&rdquo;</p>
						<div class="tm-voice-by">
							<img src="<?php echo $tm_av( $v[3] ); ?>" alt="<?php echo esc_attr( $v[1] ); ?>" loading="lazy" />
							<span><strong><?php echo esc_html( $v[1] ); ?></strong><em><?php echo esc_html( $v[2] ); ?></em></span>
						</div>
					</article>
				<?php endforeach; ?>
			</div>
			<button type="button" class="tm-slider-btn tm-slider-next" data-tm-next aria-label="<?php esc_attr_e( 'Next', 'blogtechu-custom' ); ?>"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 6l6 6-6 6"/></svg></button>
		</div>
		<div class="tm-dots" data-tm-dots aria-hidden="true"></div>
	</div>
</section>

<!-- CTA -->
<section class="pj-cta-wrap">
	<div class="pj-cta">
		<span class="pj-cta-rocket"><svg viewBox="0 0 64 64" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M32 6c9 5 14 14 14 26l-7 7H25l-7-7c0-12 5-21 14-26z"/><circle cx="32" cy="24" r="4"/><path d="M25 40l-7 12 12-5M39 40l7 12-12-5"/></svg></span>
		<div class="pj-cta-text">
			<h2 class="pj-cta-title"><?php esc_html_e( 'Ready To Build The Future With Us?', 'blogtechu-custom' ); ?></h2>
			<p class="pj-cta-sub"><?php esc_html_e( 'Join our growing team of developers, designers, marketers, and innovators.', 'blogtechu-custom' ); ?></p>
		</div>
		<div class="pj-cta-actions">
			<a class="pj-cta-btn" href="<?php echo esc_url( $careers_url ); ?>"><?php esc_html_e( 'View Careers', 'blogtechu-custom' ); ?> <span aria-hidden="true">→</span></a>
			<a class="pj-cta-btn is-ghost" href="<?php echo esc_url( $careers_url ); ?>"><?php esc_html_e( 'Apply Now', 'blogtechu-custom' ); ?> <span aria-hidden="true">→</span></a>
		</div>
	</div>
</section>

<?php
get_footer();
