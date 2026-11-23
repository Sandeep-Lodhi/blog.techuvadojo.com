<?php
/**
 * Front page — TechuvaDojo home (lean marketing landing).
 *
 * Overview-level page: hero, tech strip, a services *teaser* (links to the full
 * Services page), why-choose-us, a portfolio/stats strip, latest blog posts,
 * general FAQ, CTA and trust strip. Deep service detail (industries, process,
 * tech stack, pricing) lives on the Services page to avoid duplication.
 *
 * @package Blogtechu_Custom
 */

get_header();
$contact_url = home_url( '/contact' );
?>

<!-- Hero -->
<section class="hero-section">
  <div class="hero-inner mx-auto max-w-7xl px-5 py-14 lg:py-20">
    <div class="grid gap-10 lg:grid-cols-[1.1fr_0.9fr] lg:items-center">
      <div>
        <span class="hero-label"><?php esc_html_e( 'Build · Learn · Grow', 'blogtechu-custom' ); ?></span>
        <h1 class="hero-heading"><?php esc_html_e( 'Empowering Ideas.', 'blogtechu-custom' ); ?><br><?php esc_html_e( 'Building Digital', 'blogtechu-custom' ); ?> <span class="text-blue-400"><?php esc_html_e( 'Futures.', 'blogtechu-custom' ); ?></span></h1>
        <p class="hero-text"><?php esc_html_e( 'TechuvaDojo is your all-in-one studio for web & app development, design, marketing and AI solutions — built to grow your business and brand.', 'blogtechu-custom' ); ?></p>

        <div class="hero-cta-row">
          <a href="<?php echo esc_url( $contact_url ); ?>" class="btn-primary"><?php esc_html_e( 'Get a Free Quote', 'blogtechu-custom' ); ?></a>
          <a href="<?php echo esc_url( home_url( '/services' ) ); ?>" class="btn-ghost"><?php esc_html_e( 'Explore Services', 'blogtechu-custom' ); ?></a>
        </div>

        <div class="hero-stats-row">
          <div class="hero-stat"><strong>100%</strong><span><?php esc_html_e( 'Commitment', 'blogtechu-custom' ); ?></span></div>
          <div class="hero-stat"><strong>24/7</strong><span><?php esc_html_e( 'Support', 'blogtechu-custom' ); ?></span></div>
          <div class="hero-stat"><strong>Fast</strong><span><?php esc_html_e( 'Delivery', 'blogtechu-custom' ); ?></span></div>
          <div class="hero-stat"><strong>Agile</strong><span><?php esc_html_e( 'Process', 'blogtechu-custom' ); ?></span></div>
        </div>
      </div>

      <div class="hero-visual-card relative">
        <div class="hero-dashboard">
          <div class="hero-dashboard-bar">
            <span class="hero-dashboard-dot bg-rose-400"></span>
            <span class="hero-dashboard-dot bg-amber-400"></span>
            <span class="hero-dashboard-dot bg-emerald-400"></span>
            <span class="ml-3 text-xs text-slate-400"><?php esc_html_e( 'Hello, Tech Innovator 👋', 'blogtechu-custom' ); ?></span>
          </div>
          <div class="hero-dashboard-tile-row">
            <div class="hero-dashboard-tile"><small><?php esc_html_e( 'Total Users', 'blogtechu-custom' ); ?></small><strong>1,260</strong><span>+8.2%</span></div>
            <div class="hero-dashboard-tile"><small><?php esc_html_e( 'Revenue', 'blogtechu-custom' ); ?></small><strong>$32,750</strong><span>+15.7%</span></div>
            <div class="hero-dashboard-tile"><small><?php esc_html_e( 'Orders', 'blogtechu-custom' ); ?></small><strong>986</strong><span>+4.1%</span></div>
          </div>
          <div class="hero-dashboard-chart">
            <i style="height:38%"></i><i style="height:55%"></i><i style="height:42%"></i><i style="height:70%"></i>
            <i style="height:65%"></i><i style="height:82%"></i><i style="height:60%"></i><i style="height:95%"></i>
            <i style="height:75%"></i><i style="height:88%"></i><i style="height:68%"></i><i style="height:96%"></i>
          </div>
        </div>
        <div class="hero-floating-card">
          <span class="hero-floating-card-ring">✓</span>
          <span class="text-sm font-bold"><?php esc_html_e( 'Performance', 'blogtechu-custom' ); ?><br><span class="text-xs font-normal text-slate-500"><?php esc_html_e( 'Optimized', 'blogtechu-custom' ); ?></span></span>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Powered-by tech strip -->
<section class="mx-auto max-w-7xl px-5 py-12">
  <p class="text-center text-xs font-semibold uppercase tracking-[0.22em] text-slate-400"><?php esc_html_e( 'Built with modern, trusted technologies', 'blogtechu-custom' ); ?></p>
  <div class="client-logos">
    <?php foreach ( array( 'React', 'Next.js', 'Node.js', 'WordPress', 'Shopify', 'AWS', 'MongoDB', 'Tailwind CSS' ) as $tech ) : ?>
      <span class="client-logo-chip"><?php echo esc_html( $tech ); ?></span>
    <?php endforeach; ?>
  </div>
</section>

<!-- Services overview (teaser → full Services page) -->
<section id="services" class="services-section">
  <div class="services-head">
    <div>
      <span class="section-eyebrow"><?php esc_html_e( 'What We Do', 'blogtechu-custom' ); ?></span>
      <h2 class="services-title"><?php esc_html_e( 'Powerful Services To', 'blogtechu-custom' ); ?> <em><?php esc_html_e( 'Grow Your Business', 'blogtechu-custom' ); ?></em></h2>
    </div>
    <p class="text-base leading-relaxed text-slate-500"><?php esc_html_e( 'A quick look at what we do. Explore the full Services page for the complete suite of development, design, marketing and support offerings.', 'blogtechu-custom' ); ?></p>
  </div>

  <div class="services-grid">
    <?php
    $services = array(
      array( 'icon' => '‹/›', 'title' => 'Web Development', 'desc' => 'Modern, responsive and high-performance websites built with the latest technologies.', 'tone' => '' ),
      array( 'icon' => 'W', 'title' => 'WordPress Development', 'desc' => 'Custom WordPress solutions that are fast, secure and easy to manage.', 'tone' => 'tone-violet' ),
      array( 'icon' => '🛒', 'title' => 'E-Commerce & Shopify', 'desc' => 'Feature-rich online stores that turn visitors into loyal customers.', 'tone' => 'tone-rose' ),
      array( 'icon' => '📈', 'title' => 'SEO & Marketing', 'desc' => 'Boost your visibility and rank higher with result-driven strategies.', 'tone' => 'tone-emerald' ),
      array( 'icon' => '📱', 'title' => 'App Development', 'desc' => 'Cross-platform mobile apps with smooth performance and clean UI.', 'tone' => 'tone-amber' ),
      array( 'icon' => '🎨', 'title' => 'UI/UX Design', 'desc' => 'Creative, user-first designs that make your brand stand out.', 'tone' => 'tone-violet' ),
      array( 'icon' => '🤖', 'title' => 'AI Solutions', 'desc' => 'Chatbots, automation and AI integrations that save time and scale.', 'tone' => 'tone-emerald' ),
      array( 'icon' => '▶', 'title' => 'Video Editing', 'desc' => 'Engaging video editing for YouTube, ads, reels and promotions.', 'tone' => 'tone-pink' ),
    );
    foreach ( $services as $svc ) :
      ?>
      <div class="service-card <?php echo esc_attr( $svc['tone'] ); ?>">
        <div class="service-icon"><?php echo esc_html( $svc['icon'] ); ?></div>
        <h3 class="service-card-title"><?php echo esc_html( $svc['title'] ); ?></h3>
        <p class="service-card-desc"><?php echo esc_html( $svc['desc'] ); ?></p>
        <a href="<?php echo esc_url( home_url( '/services' ) ); ?>" class="service-card-link"><?php esc_html_e( 'Learn More', 'blogtechu-custom' ); ?></a>
      </div>
    <?php endforeach; ?>
  </div>
  <div class="mt-10 text-center">
    <a href="<?php echo esc_url( home_url( '/services' ) ); ?>" class="btn-primary"><?php esc_html_e( 'View All Services', 'blogtechu-custom' ); ?></a>
  </div>
</section>

<!-- Featured Work -->
<section class="hpw-section">
  <div class="section-heading-row">
    <div>
      <span class="section-eyebrow"><?php esc_html_e( 'Featured Work', 'blogtechu-custom' ); ?></span>
      <h2 class="section-heading"><?php esc_html_e( 'Recent projects we are proud of', 'blogtechu-custom' ); ?></h2>
      <p class="section-subtitle mt-2"><?php esc_html_e( 'Real products we have designed, built and shipped across industries.', 'blogtechu-custom' ); ?></p>
    </div>
    <a href="<?php echo esc_url( home_url( '/projects' ) ); ?>" class="link-button"><?php esc_html_e( 'View All Projects', 'blogtechu-custom' ); ?> →</a>
  </div>

  <div class="hpw-grid">
    <?php
    $work_base     = get_theme_file_uri( '/assets/images/projects/' );
    $featured_work = array(
      array( 'img' => 'goask.png', 'badge' => 'AI Platform', 'title' => 'Go ASK Me', 'desc' => 'AI-powered services marketplace where an AI agent handles matching, negotiating and closing deals.', 'url' => 'https://goask.me/' ),
      array( 'img' => 'real-estate.png', 'badge' => 'Web App', 'title' => 'Real Estate Platform', 'desc' => 'Full-featured MERN real-estate marketplace for owners, buyers and agents.', 'url' => 'https://real-estate-d1ad.onrender.com/' ),
      array( 'img' => 'torahanytime.png', 'badge' => 'Enterprise', 'title' => 'TorahAnytime', 'desc' => 'Large-scale media & donations platform — led workflow, releases and DevOps.', 'url' => 'https://torahanytime.com/' ),
    );
    foreach ( $featured_work as $fw ) :
      ?>
      <a class="hpw-card group" href="<?php echo esc_url( $fw['url'] ); ?>" target="_blank" rel="noopener">
        <div class="hpw-media">
          <span class="hpw-badge"><?php echo esc_html( $fw['badge'] ); ?></span>
          <img src="<?php echo esc_url( $work_base . $fw['img'] ); ?>" alt="<?php echo esc_attr( $fw['title'] ); ?>" loading="lazy" decoding="async" />
        </div>
        <div class="hpw-body">
          <h3 class="hpw-title"><?php echo esc_html( $fw['title'] ); ?></h3>
          <p class="hpw-desc"><?php echo esc_html( $fw['desc'] ); ?></p>
          <span class="hpw-link"><?php esc_html_e( 'Visit Project', 'blogtechu-custom' ); ?> →</span>
        </div>
      </a>
    <?php endforeach; ?>
  </div>
</section>

<!-- Why Choose Us -->
<section class="why-section">
  <div class="services-head">
    <div>
      <span class="section-eyebrow"><?php esc_html_e( 'Why Choose Us', 'blogtechu-custom' ); ?></span>
      <h2 class="services-title"><?php echo wp_kses( __( 'Your <em>long-term tech partner</em>', 'blogtechu-custom' ), array( 'em' => array() ) ); ?></h2>
    </div>
    <p class="section-subtitle max-w-md"><?php esc_html_e( 'Enterprise-grade delivery with the agility and care of a focused team.', 'blogtechu-custom' ); ?></p>
  </div>
  <div class="why-grid">
    <?php
    $why = array(
      array( 'title' => 'Dedicated Experts', 'desc' => 'Senior engineers and designers assigned to your project — no juniors learning on your budget.', 'icon' => '<path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/>' ),
      array( 'title' => 'Agile & Fast Delivery', 'desc' => 'Iterative sprints with weekly demos so you see progress early and ship on time.', 'icon' => '<path d="M13 2 4 14h7l-1 8 9-12h-7l1-8z"/>' ),
      array( 'title' => 'Transparent Communication', 'desc' => 'Clear updates and a dedicated point of contact — you always know the status.', 'icon' => '<path d="M21 12a8 8 0 0 1-11.5 7.2L4 21l1.8-5.5A8 8 0 1 1 21 12z"/>' ),
      array( 'title' => 'Scalable & Secure', 'desc' => 'Architecture and security best practices that grow with your traffic.', 'icon' => '<path d="M12 3l8 3v5c0 5-3.5 8-8 10-4.5-2-8-5-8-10V6z"/><path d="M9 12l2 2 4-4"/>' ),
      array( 'title' => 'Modern Tech Stack', 'desc' => 'Proven, current technologies — fast, maintainable and future-ready.', 'icon' => '<path d="M12 2 2 7l10 5 10-5-10-5z"/><path d="M2 12l10 5 10-5M2 17l10 5 10-5"/>' ),
      array( 'title' => 'Ongoing Support', 'desc' => 'We do not disappear at launch — maintenance and improvements keep you running.', 'icon' => '<path d="M4 13a8 8 0 0 1 16 0"/><path d="M5 18v-4a1 1 0 0 1 1-1h1v6H6a1 1 0 0 1-1-1zM19 18v-4a1 1 0 0 0-1-1h-1v6h1a1 1 0 0 0 1-1z"/>' ),
    );
    foreach ( $why as $w ) :
      ?>
      <div class="why-card">
        <div class="why-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><?php echo $w['icon']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></svg></div>
        <h3 class="why-title"><?php echo esc_html( $w['title'] ); ?></h3>
        <p class="why-desc"><?php echo esc_html( $w['desc'] ); ?></p>
      </div>
    <?php endforeach; ?>
  </div>
</section>

<!-- Work / portfolio + stats strip -->
<section id="work" class="work-strip">
  <div class="work-strip-grid">
    <div>
      <span class="section-eyebrow text-blue-200"><?php esc_html_e( 'Our Work', 'blogtechu-custom' ); ?></span>
      <h2 class="work-strip-heading"><?php esc_html_e( 'Delivering quality', 'blogtechu-custom' ); ?><br><?php esc_html_e( 'digital solutions.', 'blogtechu-custom' ); ?></h2>
      <p class="mt-4 max-w-md text-sm text-blue-100"><?php esc_html_e( 'We help startups, businesses and brands build modern, reliable products that perform and scale.', 'blogtechu-custom' ); ?></p>
      <a href="<?php echo esc_url( home_url( '/portfolio' ) ); ?>" class="btn-primary mt-6"><?php esc_html_e( 'View Portfolio', 'blogtechu-custom' ); ?></a>
    </div>
    <div class="work-strip-stats">
      <div class="work-stat"><strong data-count-to="13" data-count-suffix="+">0</strong><span><?php esc_html_e( 'Projects Delivered', 'blogtechu-custom' ); ?></span></div>
      <div class="work-stat"><strong data-count-to="20" data-count-suffix="+">0</strong><span><?php esc_html_e( 'Technologies', 'blogtechu-custom' ); ?></span></div>
      <div class="work-stat"><strong data-count-to="6" data-count-suffix="+">0</strong><span><?php esc_html_e( 'Countries Served', 'blogtechu-custom' ); ?></span></div>
      <div class="work-stat"><strong data-count-to="100" data-count-suffix="%">0</strong><span><?php esc_html_e( 'Commitment', 'blogtechu-custom' ); ?></span></div>
    </div>
  </div>
</section>

<!-- Latest from blog -->
<section class="mx-auto max-w-7xl px-5 py-20">
  <div class="section-heading-row">
    <div>
      <span class="section-eyebrow"><?php esc_html_e( 'Latest from Blog', 'blogtechu-custom' ); ?></span>
      <h2 class="section-heading"><?php esc_html_e( 'Explore Our Latest Tech Insights', 'blogtechu-custom' ); ?></h2>
      <p class="section-subtitle mt-2"><?php esc_html_e( 'Tutorials, guides and insights from the world of technology.', 'blogtechu-custom' ); ?></p>
    </div>
    <a href="<?php echo esc_url( home_url( '/blog' ) ); ?>" class="link-button"><?php esc_html_e( 'View All Posts', 'blogtechu-custom' ); ?> →</a>
  </div>

  <div class="post-grid">
    <?php
    $featured_query = new WP_Query(
      array(
        'post_type'      => 'post',
        'posts_per_page' => 3,
        'post_status'    => 'publish',
        'ignore_sticky_posts' => true,
      )
    );
    if ( $featured_query->have_posts() ) :
      while ( $featured_query->have_posts() ) :
        $featured_query->the_post();
        blogtechu_render_post_card();
      endwhile;
      wp_reset_postdata();
    endif;
    ?>
  </div>
</section>

<!-- FAQ -->
<section class="faq-section">
  <div class="text-center">
    <span class="section-eyebrow"><?php esc_html_e( 'FAQ', 'blogtechu-custom' ); ?></span>
    <h2 class="services-title"><?php esc_html_e( 'Frequently asked questions', 'blogtechu-custom' ); ?></h2>
  </div>
  <div class="faq-list">
    <?php
    $faqs = array(
      array( 'q' => 'What services does TechuvaDojo offer?', 'a' => 'We offer web & app development, e-commerce, UI/UX design, SEO & marketing, AI solutions, and ongoing maintenance & support — everything to build and grow your digital presence.' ),
      array( 'q' => 'How long does a typical project take?', 'a' => 'Most websites launch within 2–6 weeks depending on scope. After our first call we give you a clear timeline with milestones.' ),
      array( 'q' => 'Do you offer ongoing support after launch?', 'a' => 'Yes. We offer affordable monthly maintenance packages for updates, security and improvements.' ),
      array( 'q' => 'How do we get started?', 'a' => 'Just reach out via our contact page or the "Let\'s Talk" button. Tell us about your project and we will reply within 24 hours with a free quote.' ),
    );
    foreach ( $faqs as $i => $faq ) :
      ?>
      <details class="faq-item" <?php echo 0 === $i ? 'open' : ''; ?>>
        <summary class="faq-q"><?php echo esc_html( $faq['q'] ); ?></summary>
        <div class="faq-a"><?php echo esc_html( $faq['a'] ); ?></div>
      </details>
    <?php endforeach; ?>
  </div>
</section>

<!-- CTA Banner -->
<section class="px-5">
  <div class="cta-banner">
    <div class="cta-banner-grid">
      <div class="cta-banner-icon">🚀</div>
      <div>
        <h3 class="cta-banner-title"><?php esc_html_e( 'Ready to Start Your Next Project?', 'blogtechu-custom' ); ?></h3>
        <p class="cta-banner-text"><?php esc_html_e( "Let's turn your ideas into reality. We're here to help you build, grow and succeed in the digital world.", 'blogtechu-custom' ); ?></p>
      </div>
      <a href="<?php echo esc_url( $contact_url ); ?>" class="cta-banner-button"><?php esc_html_e( 'Get Started Now', 'blogtechu-custom' ); ?></a>
    </div>
  </div>
</section>

<?php
get_footer();
