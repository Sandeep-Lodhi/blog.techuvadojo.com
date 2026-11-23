<?php
/**
 * Template for the About page (slug "about").
 *
 * Matches the brand reference: hero with an illustrated team scene + stats card,
 * a mission/story block beside a journey timeline, core values, a "why choose
 * us" grid and a team section with illustrated character avatars. Team members,
 * stats and journey dates are sample placeholders — replace with real details.
 *
 * @package Blogtechu_Custom
 */

get_header();

$services_url  = home_url( '/services' );
$portfolio_url = home_url( '/portfolio' );
$contact_url   = home_url( '/contact' );
$careers_url   = home_url( '/careers' );
$linkedin_url  = 'https://www.linkedin.com/in/sandeep-lodhi-30293620b';
$github_url    = 'https://github.com/Sandeep-Lodhi';

/* ---- Illustrated character avatar generator (no stock photos needed) ---- */
if ( ! function_exists( 'blogtechu_person_svg' ) ) {
	/**
	 * Draw a friendly character (head + shoulders) in a 0–100 coordinate space.
	 */
	function blogtechu_person_svg( $c ) {
		$skin  = $c['skin'];
		$hair  = $c['hair'];
		$shirt = $c['shirt'];
		$style = isset( $c['style'] ) ? $c['style'] : 'short';
		$beard = ! empty( $c['beard'] );
		$glass = ! empty( $c['glasses'] );

		$s = '';
		// Shoulders / shirt.
		$s .= '<path d="M14 100 C14 76 32 66 50 66 C68 66 86 76 86 100 Z" fill="' . $skin . '" opacity="0"/>';
		$s .= '<path d="M14 100 C14 76 32 66 50 66 C68 66 86 76 86 100 Z" fill="' . $shirt . '"/>';
		$s .= '<path d="M43 67 L50 77 L57 67" fill="none" stroke="#ffffff" stroke-opacity="0.45" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"/>';
		// Long hair behind shoulders.
		if ( 'long' === $style ) {
			$s .= '<path d="M30 42 C26 60 31 70 40 71 L44 60 C36 57 34 50 35 42 Z" fill="' . $hair . '"/>';
			$s .= '<path d="M70 42 C74 60 69 70 60 71 L56 60 C64 57 66 50 65 42 Z" fill="' . $hair . '"/>';
		}
		// Neck + ears + head.
		$s .= '<rect x="44" y="55" width="12" height="13" rx="5" fill="' . $skin . '"/>';
		$s .= '<circle cx="34" cy="44" r="3.4" fill="' . $skin . '"/><circle cx="66" cy="44" r="3.4" fill="' . $skin . '"/>';
		$s .= '<ellipse cx="50" cy="43" rx="15.5" ry="17.5" fill="' . $skin . '"/>';
		// Beard.
		if ( $beard ) {
			$s .= '<path d="M35 45 C36 59 43 67 50 67 C57 67 64 59 65 45 C61 54 56 57 50 57 C44 57 39 54 35 45 Z" fill="' . $hair . '" opacity="0.95"/>';
		}
		// Hair top.
		if ( 'bun' === $style ) {
			$s .= '<circle cx="50" cy="21" r="6.5" fill="' . $hair . '"/>';
		}
		$s .= '<path d="M34 41 C33 24 67 24 66 41 C66 33 59 27 50 27 C41 27 34 33 34 41 Z" fill="' . $hair . '"/>';
		// Eyes / glasses + brows.
		if ( $glass ) {
			$s .= '<g fill="none" stroke="#374151" stroke-width="1.6"><rect x="38" y="40.5" width="9" height="7" rx="3.5"/><rect x="53" y="40.5" width="9" height="7" rx="3.5"/><path d="M47 44h6"/></g>';
			$s .= '<circle cx="42.5" cy="44" r="1.5" fill="#1f2937"/><circle cx="57.5" cy="44" r="1.5" fill="#1f2937"/>';
		} else {
			$s .= '<circle cx="43" cy="44" r="1.9" fill="#1f2937"/><circle cx="57" cy="44" r="1.9" fill="#1f2937"/>';
			$s .= '<path d="M39 39 q4 -2.5 8 0M53 39 q4 -2.5 8 0" stroke="' . $hair . '" stroke-width="1.4" fill="none" stroke-linecap="round"/>';
		}
		// Smile.
		$s .= '<path d="M45 51 Q50 55.5 55 51" stroke="#b9603f" stroke-width="1.7" fill="none" stroke-linecap="round"/>';
		return $s;
	}
}

if ( ! function_exists( 'blogtechu_avatar_svg' ) ) {
	/** Circular avatar (soft gradient background + character). */
	function blogtechu_avatar_svg( $c ) {
		$id = 'av' . $c['id'];
		return '<svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg" class="au-avatar-svg" aria-hidden="true">'
			. '<defs><linearGradient id="' . $id . '" x1="0" y1="0" x2="0" y2="1"><stop offset="0" stop-color="' . $c['bgFrom'] . '"/><stop offset="1" stop-color="' . $c['bgTo'] . '"/></linearGradient>'
			. '<clipPath id="c' . $id . '"><circle cx="50" cy="50" r="50"/></clipPath></defs>'
			. '<g clip-path="url(#c' . $id . ')"><rect width="100" height="100" fill="url(#' . $id . ')"/>' . blogtechu_person_svg( $c ) . '</g></svg>';
	}
}

/* Tone → shirt + soft background palette. */
$au_tones = array(
	'blue'   => array( '#2563eb', '#dbeafe', '#bfdbfe' ),
	'purple' => array( '#7c3aed', '#ede9fe', '#ddd6fe' ),
	'green'  => array( '#059669', '#d1fae5', '#a7f3d0' ),
	'pink'   => array( '#db2777', '#fce7f3', '#fbcfe8' ),
	'orange' => array( '#ea580c', '#ffedd5', '#fed7aa' ),
	'sky'    => array( '#0284c7', '#e0f2fe', '#bae6fd' ),
);

/* Team members (sample placeholders — replace with real people). */
$au_members = array(
	array( 'name' => 'Sandeep Lodhi', 'role' => __( 'Founder & CEO', 'blogtechu-custom' ), 'tone' => 'blue', 'links' => array( $linkedin_url, $github_url ), 'skin' => '#e8b48f', 'hair' => '#241c14', 'style' => 'short', 'beard' => true, 'glasses' => true ),
	array( 'name' => 'Anjali Sharma', 'role' => __( 'Co-Founder & CTO', 'blogtechu-custom' ), 'tone' => 'purple', 'links' => array( '#', '#' ), 'skin' => '#f1c9a5', 'hair' => '#2a1a12', 'style' => 'long' ),
	array( 'name' => 'Vikram Singh', 'role' => __( 'Head of Development', 'blogtechu-custom' ), 'tone' => 'green', 'links' => array( '#', '#' ), 'skin' => '#d6a06a', 'hair' => '#1f2937', 'style' => 'short', 'beard' => true ),
	array( 'name' => 'Neha Verma', 'role' => __( 'UI/UX Lead', 'blogtechu-custom' ), 'tone' => 'pink', 'links' => array( '#', '#' ), 'skin' => '#f1c9a5', 'hair' => '#241c14', 'style' => 'long' ),
	array( 'name' => 'Arjun Patel', 'role' => __( 'Project Manager', 'blogtechu-custom' ), 'tone' => 'orange', 'links' => array( '#', '#' ), 'skin' => '#c68642', 'hair' => '#241c14', 'style' => 'short', 'beard' => true ),
	array( 'name' => 'Priya Mehta', 'role' => __( 'Marketing Head', 'blogtechu-custom' ), 'tone' => 'sky', 'links' => array( '#', '#' ), 'skin' => '#eebfa0', 'hair' => '#3a2418', 'style' => 'long' ),
);
/* Attach resolved colours + an id to each member. */
foreach ( $au_members as $i => &$m ) {
	$t            = $au_tones[ $m['tone'] ];
	$m['shirt']   = $t[0];
	$m['bgFrom']  = $t[1];
	$m['bgTo']    = $t[2];
	$m['id']      = $i;
}
unset( $m );

/* Inline icon helper. */
$au_icon = function ( $name ) {
	$icons = array(
		'users'   => '<circle cx="9" cy="8" r="3"/><path d="M2 20a7 7 0 0 1 14 0"/><circle cx="17" cy="9" r="2.5"/><path d="M22 19a5 5 0 0 0-7-4.6"/>',
		'rocket'  => '<path d="M12 3c3 1.6 5 5 5 9l-2.5 2.5h-5L7 12c0-4 2-7.4 5-9z"/><circle cx="12" cy="9" r="1.6"/><path d="M9.5 14.5l-2.5 4 4-1.5M14.5 14.5l2.5 4-4-1.5"/>',
		'globe'   => '<circle cx="12" cy="12" r="9"/><path d="M3 12h18M12 3a15 15 0 0 1 0 18M12 3a15 15 0 0 0 0 18"/>',
		'clock'   => '<circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/>',
		'support' => '<path d="M5 13a7 7 0 0 1 14 0"/><rect x="3" y="13" width="4" height="7" rx="1.5"/><rect x="17" y="13" width="4" height="7" rx="1.5"/><path d="M19 19a3 3 0 0 1-3 3h-2"/>',
		'diamond' => '<path d="M6 3h12l3 6-9 12L3 9z"/><path d="M3 9h18M9 3l-3 6 6 12 6-12-3-6"/>',
		'spark'   => '<path d="M13 2 4 14h7l-1 8 9-12h-7l1-8z"/>',
		'shield'  => '<path d="M12 3l8 3v5c0 5-3.5 8-8 10-4.5-2-8-5-8-10V6z"/><path d="M9 12l2 2 4-4"/>',
		'heart'   => '<path d="M19 14c1.4-1.5 2-3.4 2-5a4.5 4.5 0 0 0-8-2.6A4.5 4.5 0 0 0 5 9c0 1.6.6 3.5 2 5l5 5z"/>',
		'code'    => '<path d="M8 9l-4 3 4 3M16 9l4 3-4 3M13 6l-2 12"/>',
		'layers'  => '<path d="M12 2l9 5-9 5-9-5 9-5z"/><path d="M3 12l9 5 9-5M3 17l9 5 9-5"/>',
		'tag'     => '<path d="M20.6 13.4 13 21l-9-9V4h8l8.6 8.6a2 2 0 0 1 0 2.8z"/><circle cx="8" cy="8" r="1.3"/>',
	);
	$inner = isset( $icons[ $name ] ) ? $icons[ $name ] : $icons['users'];
	return '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">' . $inner . '</svg>';
};

/* Social icons. */
$au_social = array(
	'in'   => '<svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M20.45 20.45h-3.56v-5.57c0-1.33-.02-3.04-1.85-3.04-1.85 0-2.13 1.45-2.13 2.94v5.67H9.35V9h3.41v1.56h.05c.48-.9 1.64-1.85 3.37-1.85 3.6 0 4.27 2.37 4.27 5.46v6.28zM5.34 7.43a2.07 2.07 0 1 1 0-4.14 2.07 2.07 0 0 1 0 4.14zM7.12 20.45H3.56V9h3.56v11.45zM22.22 0H1.77C.79 0 0 .77 0 1.73v20.54C0 23.23.79 24 1.77 24h20.45c.98 0 1.78-.77 1.78-1.73V1.73C24 .77 23.2 0 22.22 0z"/></svg>',
	'tw'   => '<svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M18.9 1.2h3.7l-8 9.1L24 22.8h-7.4l-5.8-7.6-6.6 7.6H.5l8.6-9.8L0 1.2h7.6l5.2 6.9zM17.6 20.6h2L6.5 3.3H4.3z"/></svg>',
	'mail' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="M3 7l9 6 9-6"/></svg>',
);

/* ---- Build the hero scene (uses the first 3 team characters) ---- */
$hero_people = '';
$cx          = array( 200, 320, 440 );
foreach ( array_slice( $au_members, 0, 3 ) as $k => $m ) {
	$scale        = 1.05;
	$tx           = $cx[ $k ] - ( 50 * $scale );
	$hero_people .= '<g transform="translate(' . round( $tx, 1 ) . ' 196) scale(' . $scale . ')">' . blogtechu_person_svg( $m ) . '</g>';
}
?>

<!-- Hero -->
<section class="au-hero">
	<div class="au-hero-inner">
		<div class="au-hero-content">
			<span class="section-eyebrow"><?php esc_html_e( 'About TechuvaDojo', 'blogtechu-custom' ); ?></span>
			<h1 class="au-hero-title"><?php echo wp_kses( __( 'Building Digital Solutions That Drive <em>Real Impact</em>', 'blogtechu-custom' ), array( 'em' => array() ) ); ?></h1>
			<p class="au-hero-text"><?php esc_html_e( 'TechuvaDojo is a full-service digital solutions company. We help startups, businesses, and brands turn ideas into powerful digital products and experiences.', 'blogtechu-custom' ); ?></p>
			<p class="au-hero-text"><?php esc_html_e( 'From websites and applications to digital marketing and AI integration, we deliver solutions that are modern, scalable, and future-ready.', 'blogtechu-custom' ); ?></p>
			<div class="au-hero-actions">
				<a class="au-btn" href="<?php echo esc_url( $services_url ); ?>"><?php esc_html_e( 'Our Services', 'blogtechu-custom' ); ?> <span aria-hidden="true">→</span></a>
				<a class="au-btn is-ghost" href="<?php echo esc_url( $portfolio_url ); ?>"><?php esc_html_e( 'Our Work', 'blogtechu-custom' ); ?> <span aria-hidden="true">→</span></a>
			</div>

			<div class="au-stats">
				<div class="au-stat"><span class="au-stat-ico"><?php echo $au_icon( 'layers' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span><strong>20+</strong><em><?php esc_html_e( 'Technologies', 'blogtechu-custom' ); ?></em></div>
				<div class="au-stat"><span class="au-stat-ico"><?php echo $au_icon( 'globe' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span><strong>100%</strong><em><?php esc_html_e( 'Client Focus', 'blogtechu-custom' ); ?></em></div>
				<div class="au-stat"><span class="au-stat-ico"><?php echo $au_icon( 'support' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span><strong>24/7</strong><em><?php esc_html_e( 'Support', 'blogtechu-custom' ); ?></em></div>
				<div class="au-stat"><span class="au-stat-ico"><?php echo $au_icon( 'rocket' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span><strong><?php esc_html_e( 'Remote', 'blogtechu-custom' ); ?></strong><em><?php esc_html_e( 'First Team', 'blogtechu-custom' ); ?></em></div>
			</div>
		</div>

		<div class="au-hero-visual">
			<img class="au-hero-img" src="<?php echo esc_url( add_query_arg( 'v', filemtime( get_theme_file_path( '/assets/images/about-team.png' ) ), get_theme_file_uri( '/assets/images/about-team.png' ) ) ); ?>" alt="<?php esc_attr_e( 'The TechuvaDojo team in front of the office', 'blogtechu-custom' ); ?>" loading="eager" decoding="async" />
		</div>
	</div>
</section>

<!-- Story / Mission + Journey -->
<section class="au-story">
	<div class="au-story-inner">
		<div class="au-story-text">
			<span class="section-eyebrow"><?php esc_html_e( 'Our Story', 'blogtechu-custom' ); ?></span>
			<h2 class="au-h2"><?php echo wp_kses( __( 'Our Mission is to Empower Businesses Through <em>Technology</em>', 'blogtechu-custom' ), array( 'em' => array() ) ); ?></h2>
			<p class="au-p"><?php esc_html_e( 'We started TechuvaDojo with a simple goal — to make technology work for everyone. Our focus is to become a trusted digital partner for businesses that want to grow.', 'blogtechu-custom' ); ?></p>
			<p class="au-p"><?php esc_html_e( 'We believe in building long-term relationships, delivering quality work, and creating solutions that make a real difference.', 'blogtechu-custom' ); ?></p>
			<div class="au-sign">
				<span class="au-sign-name-cursive">Sandeep</span>
				<div class="au-sign-meta">
					<strong><?php esc_html_e( 'Sandeep Lodhi', 'blogtechu-custom' ); ?></strong>
					<em><?php esc_html_e( 'Founder & CEO', 'blogtechu-custom' ); ?></em>
				</div>
			</div>
		</div>

		<div class="au-journey">
			<h3 class="au-journey-title"><?php esc_html_e( 'Our Journey', 'blogtechu-custom' ); ?></h3>
			<ol class="au-timeline">
				<?php
				$journey = array(
					array( '2024', __( 'The Beginning', 'blogtechu-custom' ), __( 'TechuvaDojo was founded with a passion for technology and innovation.', 'blogtechu-custom' ) ),
					array( '2025', __( 'Building Momentum', 'blogtechu-custom' ), __( 'Refined our process and delivered quality projects for early clients.', 'blogtechu-custom' ) ),
					array( '2026', __( 'Growing Strong', 'blogtechu-custom' ), __( 'Expanding our services and partnering with more businesses.', 'blogtechu-custom' ) ),
					array( __( 'Beyond', 'blogtechu-custom' ), __( 'Building the Future', 'blogtechu-custom' ), __( 'Continuing to innovate and empower businesses with next-gen tech.', 'blogtechu-custom' ) ),
				);
				foreach ( $journey as $j ) :
					?>
					<li class="au-tl-item">
						<span class="au-tl-dot"></span>
						<span class="au-tl-year"><?php echo esc_html( $j[0] ); ?></span>
						<div class="au-tl-body">
							<strong><?php echo esc_html( $j[1] ); ?></strong>
							<p><?php echo esc_html( $j[2] ); ?></p>
						</div>
					</li>
				<?php endforeach; ?>
			</ol>
		</div>
	</div>
</section>

<!-- Values -->
<section class="au-values">
	<div class="au-values-inner">
		<div class="au-head-center">
			<span class="section-eyebrow"><?php esc_html_e( 'Our Values', 'blogtechu-custom' ); ?></span>
			<h2 class="au-h2"><?php esc_html_e( 'The Principles That Drive Us', 'blogtechu-custom' ); ?></h2>
		</div>
		<div class="au-values-grid">
			<?php
			$values = array(
				array( 'diamond', 'blue', __( 'Quality First', 'blogtechu-custom' ), __( 'We deliver high-quality solutions that exceed expectations.', 'blogtechu-custom' ) ),
				array( 'users', 'green', __( 'Client Success', 'blogtechu-custom' ), __( 'Your success is our success. We grow when you grow.', 'blogtechu-custom' ) ),
				array( 'spark', 'purple', __( 'Innovation', 'blogtechu-custom' ), __( 'We embrace new technologies and creative ideas.', 'blogtechu-custom' ) ),
				array( 'shield', 'orange', __( 'Integrity', 'blogtechu-custom' ), __( 'We believe in transparency, honesty, and trust.', 'blogtechu-custom' ) ),
				array( 'heart', 'pink', __( 'Passion', 'blogtechu-custom' ), __( 'We love what we do and it reflects in our work.', 'blogtechu-custom' ) ),
			);
			foreach ( $values as $v ) :
				?>
				<article class="au-value">
					<span class="au-value-ico au-grad-<?php echo esc_attr( $v[1] ); ?>"><?php echo $au_icon( $v[0] ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span>
					<h3 class="au-value-title"><?php echo esc_html( $v[2] ); ?></h3>
					<p class="au-value-text"><?php echo esc_html( $v[3] ); ?></p>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<!-- Why choose us -->
<section class="au-why">
	<div class="au-why-inner">
		<div class="au-why-text">
			<span class="section-eyebrow"><?php esc_html_e( 'Why Choose Us', 'blogtechu-custom' ); ?></span>
			<h2 class="au-h2"><?php echo wp_kses( __( 'Why Businesses Choose <em>TechuvaDojo</em>', 'blogtechu-custom' ), array( 'em' => array() ) ); ?></h2>
			<p class="au-p"><?php esc_html_e( "We don't just build websites or apps, we build long-term partnerships. Our approach is result-driven and focused on delivering real value.", 'blogtechu-custom' ); ?></p>
			<a class="au-btn" href="<?php echo esc_url( $contact_url ); ?>"><?php esc_html_e( 'Work With Us', 'blogtechu-custom' ); ?> <span aria-hidden="true">→</span></a>
		</div>
		<div class="au-why-grid">
			<?php
			$why = array(
				array( 'users', 'blue', __( 'Experienced Team', 'blogtechu-custom' ), __( 'Our team of skilled experts brings diverse skills and deep expertise.', 'blogtechu-custom' ) ),
				array( 'code', 'green', __( 'End-to-End Solutions', 'blogtechu-custom' ), __( 'From idea to deployment, we handle everything for you.', 'blogtechu-custom' ) ),
				array( 'layers', 'pink', __( 'Modern Technologies', 'blogtechu-custom' ), __( 'We use the latest tools and technologies to build scalable solutions.', 'blogtechu-custom' ) ),
				array( 'clock', 'orange', __( 'On-Time Delivery', 'blogtechu-custom' ), __( 'We respect deadlines and ensure timely delivery of every project.', 'blogtechu-custom' ) ),
				array( 'tag', 'purple', __( 'Affordable Pricing', 'blogtechu-custom' ), __( 'High-quality solutions at competitive and transparent pricing.', 'blogtechu-custom' ) ),
				array( 'support', 'sky', __( '24/7 Support', 'blogtechu-custom' ), __( 'We are always here to support you even after the project is completed.', 'blogtechu-custom' ) ),
			);
			foreach ( $why as $w ) :
				?>
				<div class="au-feature">
					<span class="au-feature-ico cr-tone-<?php echo esc_attr( $w[1] ); ?>"><?php echo $au_icon( $w[0] ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span>
					<div>
						<h3 class="au-feature-title"><?php echo esc_html( $w[2] ); ?></h3>
						<p class="au-feature-text"><?php echo esc_html( $w[3] ); ?></p>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<!-- Team -->
<section class="au-team" id="team">
	<div class="au-team-inner">
		<div class="au-head-center">
			<span class="section-eyebrow"><?php esc_html_e( 'Our Team', 'blogtechu-custom' ); ?></span>
			<h2 class="au-h2"><?php esc_html_e( 'Meet the People Behind TechuvaDojo', 'blogtechu-custom' ); ?></h2>
		</div>
		<div class="au-team-grid">
			<?php
			$au_avatar_slugs = array( 'sandeep', 'anjali', 'vikram', 'neha', 'arjun', 'priya' );
			foreach ( $au_members as $mi => $m ) :
				$av_slug = isset( $au_avatar_slugs[ $mi ] ) ? $au_avatar_slugs[ $mi ] : 'sandeep';
				$av_uri  = get_theme_file_uri( '/assets/images/team/' . $av_slug . '.svg' );
				$av_ver  = filemtime( get_theme_file_path( '/assets/images/team/' . $av_slug . '.svg' ) );
				?>
				<article class="au-member">
					<span class="au-avatar-img"><img src="<?php echo esc_url( add_query_arg( 'v', $av_ver, $av_uri ) ); ?>" alt="<?php echo esc_attr( $m['name'] ); ?>" loading="lazy" decoding="async" /></span>
					<h3 class="au-member-name"><?php echo esc_html( $m['name'] ); ?></h3>
					<p class="au-member-role"><?php echo esc_html( $m['role'] ); ?></p>
					<div class="au-member-socials">
						<a href="<?php echo esc_url( $m['links'][0] ); ?>" aria-label="LinkedIn"<?php echo '#' === $m['links'][0] ? '' : ' target="_blank" rel="noopener"'; ?>><?php echo $au_social['in']; // phpcs:ignore WordPress.Security.EscapeOutput ?></a>
						<a href="#" aria-label="Twitter"><?php echo $au_social['tw']; // phpcs:ignore WordPress.Security.EscapeOutput ?></a>
						<a href="<?php echo esc_url( $contact_url ); ?>" aria-label="Email"><?php echo $au_social['mail']; // phpcs:ignore WordPress.Security.EscapeOutput ?></a>
					</div>
				</article>
			<?php endforeach; ?>
		</div>
		<div class="au-team-cta">
			<a class="au-btn is-ghost" href="<?php echo esc_url( $careers_url ); ?>"><?php esc_html_e( 'Join Our Team', 'blogtechu-custom' ); ?> <span aria-hidden="true">→</span></a>
		</div>
	</div>
</section>

<?php
get_footer();
