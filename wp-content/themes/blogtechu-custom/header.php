<!doctype html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header">
  <div class="announcement-bar">
    <div class="announcement-inner">
      <p class="announcement-text"><?php echo esc_html__( 'Empowering Ideas. Building Digital Futures.', 'blogtechu-custom' ); ?></p>
      <a href="<?php echo esc_url( home_url( '/careers' ) ); ?>" class="announcement-cta"><?php esc_html_e( "We're Hiring! Join Our Team", 'blogtechu-custom' ); ?></a>
    </div>
  </div>

  <div class="navbar">
    <div class="navbar-inner mx-auto max-w-7xl">
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="brand-logo-group">
        <?php if ( has_custom_logo() ) : ?>
          <?php the_custom_logo(); ?>
        <?php else : ?>
          <img src="<?php echo esc_url( get_theme_file_uri( '/assets/images/logo-techuvadojo.svg' ) ); ?>" alt="<?php bloginfo( 'name' ); ?>" class="custom-logo" width="220" height="48" />
        <?php endif; ?>
      </a>

      <nav class="site-navigation hidden lg:block">
        <?php if ( has_nav_menu( 'primary' ) ) : ?>
          <?php wp_nav_menu(
            array(
              'theme_location' => 'primary',
              'container'      => false,
              'menu_class'     => 'menu',
              'fallback_cb'    => false,
            )
          ); ?>
        <?php else : ?>
          <ul class="menu">
            <li class="<?php echo esc_attr( blogtechu_nav_current_class( 'home' ) ); ?>"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'blogtechu-custom' ); ?></a></li>
            <li class="<?php echo esc_attr( blogtechu_nav_current_class( 'blog' ) ); ?>"><a href="<?php echo esc_url( home_url( '/blog' ) ); ?>"><?php esc_html_e( 'Blog', 'blogtechu-custom' ); ?></a>
              <?php // Mega-menu dropdown disabled — Blog now links directly to the Blog page. ?>
              <?php if ( false ) : ?>
              <div class="mega-menu-panel" role="menu">
                <div>
                  <span class="mega-col-title"><?php esc_html_e( 'Content', 'blogtechu-custom' ); ?></span>
                  <a class="mega-link" href="#"><span class="mega-link-icon">📝</span><span class="mega-link-body"><span class="mega-link-title"><?php esc_html_e( 'Blog', 'blogtechu-custom' ); ?></span><span class="mega-link-desc"><?php esc_html_e( 'Tech articles & tutorials', 'blogtechu-custom' ); ?></span></span></a>
                  <a class="mega-link" href="#"><span class="mega-link-icon">📁</span><span class="mega-link-body"><span class="mega-link-title"><?php esc_html_e( 'Categories', 'blogtechu-custom' ); ?></span><span class="mega-link-desc"><?php esc_html_e( 'Explore by topics', 'blogtechu-custom' ); ?></span></span></a>
                  <a class="mega-link" href="#"><span class="mega-link-icon">🏷️</span><span class="mega-link-body"><span class="mega-link-title"><?php esc_html_e( 'Tags', 'blogtechu-custom' ); ?></span><span class="mega-link-desc"><?php esc_html_e( 'Browse all tags', 'blogtechu-custom' ); ?></span></span></a>
                  <a class="mega-link" href="#"><span class="mega-link-icon">📰</span><span class="mega-link-body"><span class="mega-link-title"><?php esc_html_e( 'News', 'blogtechu-custom' ); ?></span><span class="mega-link-desc"><?php esc_html_e( 'Latest tech & market news', 'blogtechu-custom' ); ?></span></span></a>
                </div>
                <div>
                  <span class="mega-col-title"><?php esc_html_e( 'Services', 'blogtechu-custom' ); ?></span>
                  <a class="mega-link" href="#"><span class="mega-link-icon">🌐</span><span class="mega-link-body"><span class="mega-link-title"><?php esc_html_e( 'Web Development', 'blogtechu-custom' ); ?></span><span class="mega-link-desc"><?php esc_html_e( 'Modern & responsive websites', 'blogtechu-custom' ); ?></span></span></a>
                  <a class="mega-link" href="#"><span class="mega-link-icon">📰</span><span class="mega-link-body"><span class="mega-link-title"><?php esc_html_e( 'WordPress', 'blogtechu-custom' ); ?></span><span class="mega-link-desc"><?php esc_html_e( 'Custom WP solutions', 'blogtechu-custom' ); ?></span></span></a>
                  <a class="mega-link" href="#"><span class="mega-link-icon">🛍️</span><span class="mega-link-body"><span class="mega-link-title"><?php esc_html_e( 'Shopify Development', 'blogtechu-custom' ); ?></span><span class="mega-link-desc"><?php esc_html_e( 'E-commerce stores', 'blogtechu-custom' ); ?></span></span></a>
                  <a class="mega-link" href="#"><span class="mega-link-icon">🎬</span><span class="mega-link-body"><span class="mega-link-title"><?php esc_html_e( 'Video Editing', 'blogtechu-custom' ); ?></span><span class="mega-link-desc"><?php esc_html_e( 'Pro video editing', 'blogtechu-custom' ); ?></span></span></a>
                  <a class="mega-link" href="#"><span class="mega-link-icon">📈</span><span class="mega-link-body"><span class="mega-link-title"><?php esc_html_e( 'Digital Marketing', 'blogtechu-custom' ); ?></span><span class="mega-link-desc"><?php esc_html_e( 'SEO, ads & marketing', 'blogtechu-custom' ); ?></span></span></a>
                  <a class="mega-col-cta" href="#"><?php esc_html_e( 'View All Services', 'blogtechu-custom' ); ?></a>
                </div>
                <div>
                  <span class="mega-col-title"><?php esc_html_e( 'Work', 'blogtechu-custom' ); ?></span>
                  <a class="mega-link" href="#"><span class="mega-link-icon">📊</span><span class="mega-link-body"><span class="mega-link-title"><?php esc_html_e( 'Portfolio', 'blogtechu-custom' ); ?></span><span class="mega-link-desc"><?php esc_html_e( 'Our work & collaborations', 'blogtechu-custom' ); ?></span></span></a>
                  <a class="mega-link" href="#"><span class="mega-link-icon">‹/›</span><span class="mega-link-body"><span class="mega-link-title"><?php esc_html_e( 'Projects', 'blogtechu-custom' ); ?></span><span class="mega-link-desc"><?php esc_html_e( 'Source code & case studies', 'blogtechu-custom' ); ?></span></span></a>
                  <a class="mega-link" href="#"><span class="mega-link-icon">📋</span><span class="mega-link-body"><span class="mega-link-title"><?php esc_html_e( 'Case Studies', 'blogtechu-custom' ); ?></span><span class="mega-link-desc"><?php esc_html_e( 'Solutions & results', 'blogtechu-custom' ); ?></span></span></a>
                  <a class="mega-link" href="#"><span class="mega-link-icon">⭐</span><span class="mega-link-body"><span class="mega-link-title"><?php esc_html_e( 'Testimonials', 'blogtechu-custom' ); ?></span><span class="mega-link-desc"><?php esc_html_e( 'What clients say', 'blogtechu-custom' ); ?></span></span></a>
                  <a class="mega-col-cta" href="#"><?php esc_html_e( 'View All Work', 'blogtechu-custom' ); ?></a>
                </div>
                <div>
                  <span class="mega-col-title"><?php esc_html_e( 'Resources', 'blogtechu-custom' ); ?></span>
                  <a class="mega-link" href="#"><span class="mega-link-icon">📚</span><span class="mega-link-body"><span class="mega-link-title"><?php esc_html_e( 'E-books', 'blogtechu-custom' ); ?></span><span class="mega-link-desc"><?php esc_html_e( 'Premium guides & ebooks', 'blogtechu-custom' ); ?></span></span></a>
                  <a class="mega-link" href="#"><span class="mega-link-icon">☁️</span><span class="mega-link-body"><span class="mega-link-title"><?php esc_html_e( 'Resources', 'blogtechu-custom' ); ?></span><span class="mega-link-desc"><?php esc_html_e( 'Tools & useful resources', 'blogtechu-custom' ); ?></span></span></a>
                  <a class="mega-link" href="#"><span class="mega-link-icon">🎓</span><span class="mega-link-body"><span class="mega-link-title"><?php esc_html_e( 'Courses', 'blogtechu-custom' ); ?></span><span class="mega-link-desc"><?php esc_html_e( 'Learn & upskill with us', 'blogtechu-custom' ); ?></span></span></a>
                  <a class="mega-link" href="#"><span class="mega-link-icon">❓</span><span class="mega-link-body"><span class="mega-link-title"><?php esc_html_e( 'FAQs', 'blogtechu-custom' ); ?></span><span class="mega-link-desc"><?php esc_html_e( 'Find answers quickly', 'blogtechu-custom' ); ?></span></span></a>
                  <a class="mega-col-cta" href="#"><?php esc_html_e( 'Explore More', 'blogtechu-custom' ); ?></a>
                </div>
                <div>
                  <span class="mega-col-title"><?php esc_html_e( 'Company', 'blogtechu-custom' ); ?></span>
                  <a class="mega-link" href="#"><span class="mega-link-icon">🏢</span><span class="mega-link-body"><span class="mega-link-title"><?php esc_html_e( 'About Us', 'blogtechu-custom' ); ?></span><span class="mega-link-desc"><?php esc_html_e( 'Our story & mission', 'blogtechu-custom' ); ?></span></span></a>
                  <a class="mega-link" href="#"><span class="mega-link-icon">💼</span><span class="mega-link-body"><span class="mega-link-title"><?php esc_html_e( 'Careers', 'blogtechu-custom' ); ?></span><span class="mega-link-desc"><?php esc_html_e( 'Join our growing team', 'blogtechu-custom' ); ?></span></span></a>
                  <a class="mega-link" href="#"><span class="mega-link-icon">🖼️</span><span class="mega-link-body"><span class="mega-link-title"><?php esc_html_e( 'Gallery', 'blogtechu-custom' ); ?></span><span class="mega-link-desc"><?php esc_html_e( 'Moments & memories', 'blogtechu-custom' ); ?></span></span></a>
                  <a class="mega-link" href="#"><span class="mega-link-icon">📞</span><span class="mega-link-body"><span class="mega-link-title"><?php esc_html_e( 'Contact Us', 'blogtechu-custom' ); ?></span><span class="mega-link-desc"><?php esc_html_e( 'Get in touch with us', 'blogtechu-custom' ); ?></span></span></a>
                  <a class="mega-col-cta" href="#"><?php esc_html_e( 'More Info', 'blogtechu-custom' ); ?></a>
                </div>
              </div>
              <?php endif; ?>
            </li>
            <li class="<?php echo esc_attr( blogtechu_nav_current_class( 'services' ) ); ?>"><a href="<?php echo esc_url( home_url( '/services' ) ); ?>"><?php esc_html_e( 'Services', 'blogtechu-custom' ); ?></a>
              <?php // Services dropdown disabled — Services now links directly to the Services page. ?>
              <?php if ( false ) : ?>
              <ul class="sub-menu">
                <li><a href="<?php echo esc_url( home_url( '/services' ) ); ?>"><?php esc_html_e( 'Web Development', 'blogtechu-custom' ); ?></a></li>
                <li><a href="<?php echo esc_url( home_url( '/services' ) ); ?>"><?php esc_html_e( 'WordPress Development', 'blogtechu-custom' ); ?></a></li>
                <li><a href="<?php echo esc_url( home_url( '/services' ) ); ?>"><?php esc_html_e( 'Shopify Development', 'blogtechu-custom' ); ?></a></li>
                <li><a href="<?php echo esc_url( home_url( '/services' ) ); ?>"><?php esc_html_e( 'Digital Marketing', 'blogtechu-custom' ); ?></a></li>
                <li><a href="<?php echo esc_url( home_url( '/services' ) ); ?>"><?php esc_html_e( 'SEO Optimization', 'blogtechu-custom' ); ?></a></li>
              </ul>
              <?php endif; ?>
            </li>
            <li class="<?php echo esc_attr( blogtechu_nav_current_class( 'portfolio' ) ); ?>"><a href="<?php echo esc_url( home_url( '/portfolio' ) ); ?>"><?php esc_html_e( 'Portfolio', 'blogtechu-custom' ); ?></a></li>
            <li class="<?php echo esc_attr( blogtechu_nav_current_class( 'news' ) ); ?>"><a href="<?php echo esc_url( home_url( '/news' ) ); ?>"><?php esc_html_e( 'News', 'blogtechu-custom' ); ?></a></li>
            <li class="<?php echo esc_attr( blogtechu_nav_current_class( 'about' ) ); ?>"><a href="<?php echo esc_url( home_url( '/about' ) ); ?>"><?php esc_html_e( 'About', 'blogtechu-custom' ); ?></a></li>
            <li class="<?php echo esc_attr( blogtechu_nav_current_class( 'contact' ) ); ?>"><a href="<?php echo esc_url( home_url( '/contact' ) ); ?>"><?php esc_html_e( 'Contact', 'blogtechu-custom' ); ?></a></li>
          </ul>
        <?php endif; ?>
      </nav>

      <div class="header-actions">
        <button type="button" class="icon-button" data-search-open aria-label="<?php esc_attr_e( 'Search', 'blogtechu-custom' ); ?>" aria-haspopup="dialog" aria-controls="site-search"></button>
        <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="button max-sm:hidden" data-talk-open><?php esc_html_e( "Let's Talk", 'blogtechu-custom' ); ?> →</a>
        <button type="button" class="nav-toggle lg:hidden" data-nav-open aria-label="<?php esc_attr_e( 'Open menu', 'blogtechu-custom' ); ?>" aria-controls="mobile-nav" aria-expanded="false">
          <span></span><span></span><span></span>
        </button>
      </div>
    </div>
  </div>
</header>

<!-- Mobile navigation drawer -->
<div class="mobile-nav" id="mobile-nav" aria-hidden="true">
  <div class="mobile-nav-backdrop" data-nav-close></div>
  <aside class="mobile-nav-panel" role="dialog" aria-modal="true" aria-label="<?php esc_attr_e( 'Menu', 'blogtechu-custom' ); ?>">
    <div class="mobile-nav-head">
      <span class="mobile-nav-title"><?php esc_html_e( 'Menu', 'blogtechu-custom' ); ?></span>
      <button type="button" class="mobile-nav-close" data-nav-close aria-label="<?php esc_attr_e( 'Close menu', 'blogtechu-custom' ); ?>">&times;</button>
    </div>
    <nav class="mobile-nav-menu" aria-label="<?php esc_attr_e( 'Mobile', 'blogtechu-custom' ); ?>">
      <a class="mobile-nav-link<?php echo blogtechu_nav_current_class( 'home' ) ? ' is-current' : ''; ?>" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'blogtechu-custom' ); ?></a>
      <a class="mobile-nav-link<?php echo blogtechu_nav_current_class( 'blog' ) ? ' is-current' : ''; ?>" href="<?php echo esc_url( home_url( '/blog' ) ); ?>"><?php esc_html_e( 'Blog', 'blogtechu-custom' ); ?></a>
      <a class="mobile-nav-link<?php echo blogtechu_nav_current_class( 'services' ) ? ' is-current' : ''; ?>" href="<?php echo esc_url( home_url( '/services' ) ); ?>"><?php esc_html_e( 'Services', 'blogtechu-custom' ); ?></a>
      <a class="mobile-nav-link<?php echo blogtechu_nav_current_class( 'portfolio' ) ? ' is-current' : ''; ?>" href="<?php echo esc_url( home_url( '/portfolio' ) ); ?>"><?php esc_html_e( 'Portfolio', 'blogtechu-custom' ); ?></a>
      <a class="mobile-nav-link<?php echo blogtechu_nav_current_class( 'news' ) ? ' is-current' : ''; ?>" href="<?php echo esc_url( home_url( '/news' ) ); ?>"><?php esc_html_e( 'News', 'blogtechu-custom' ); ?></a>
      <a class="mobile-nav-link<?php echo blogtechu_nav_current_class( 'about' ) ? ' is-current' : ''; ?>" href="<?php echo esc_url( home_url( '/about' ) ); ?>"><?php esc_html_e( 'About', 'blogtechu-custom' ); ?></a>
      <a class="mobile-nav-link<?php echo blogtechu_nav_current_class( 'contact' ) ? ' is-current' : ''; ?>" href="<?php echo esc_url( home_url( '/contact' ) ); ?>"><?php esc_html_e( 'Contact', 'blogtechu-custom' ); ?></a>
    </nav>
    <a class="button mobile-nav-cta" href="<?php echo esc_url( home_url( '/contact' ) ); ?>"><?php esc_html_e( "Let's Talk", 'blogtechu-custom' ); ?> →</a>
  </aside>
</div>

<!-- Search overlay -->
<div class="search-overlay" id="site-search" aria-hidden="true">
    <div class="search-overlay-backdrop" data-search-close></div>
    <div class="search-overlay-panel" role="dialog" aria-modal="true" aria-label="<?php esc_attr_e( 'Search', 'blogtechu-custom' ); ?>">
      <button type="button" class="search-overlay-close" data-search-close aria-label="<?php esc_attr_e( 'Close search', 'blogtechu-custom' ); ?>">&times;</button>
      <span class="search-overlay-label"><?php esc_html_e( 'Search the site', 'blogtechu-custom' ); ?></span>
      <form class="search-overlay-form" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
        <input type="search" name="s" class="search-overlay-input" placeholder="<?php esc_attr_e( 'Search articles, news, projects…', 'blogtechu-custom' ); ?>" value="<?php echo get_search_query(); ?>" autocomplete="off" />
        <button type="submit" class="search-overlay-submit"><?php esc_html_e( 'Search', 'blogtechu-custom' ); ?></button>
      </form>
      <div class="search-overlay-hints">
        <span><?php esc_html_e( 'Popular:', 'blogtechu-custom' ); ?></span>
        <?php
        $search_hints = array( 'AI', 'WordPress', 'React', 'Cloud', 'SEO' );
        foreach ( $search_hints as $hint ) :
          ?>
          <a href="<?php echo esc_url( add_query_arg( 's', rawurlencode( $hint ), home_url( '/' ) ) ); ?>"><?php echo esc_html( $hint ); ?></a>
        <?php endforeach; ?>
      </div>
    </div>
  </div>

  <!-- Let's Talk modal -->
  <div class="talk-modal" id="lets-talk" aria-hidden="true">
    <div class="talk-backdrop" data-talk-close></div>
    <div class="talk-panel" role="dialog" aria-modal="true" aria-label="<?php esc_attr_e( "Let's Talk", 'blogtechu-custom' ); ?>">
      <button type="button" class="talk-close" data-talk-close aria-label="<?php esc_attr_e( 'Close', 'blogtechu-custom' ); ?>">&times;</button>
      <span class="talk-eyebrow">💬 <?php esc_html_e( "Let's Talk", 'blogtechu-custom' ); ?></span>
      <h2 class="talk-title"><?php esc_html_e( 'Tell us about your project', 'blogtechu-custom' ); ?></h2>
      <p class="talk-text"><?php esc_html_e( "Fill in a few details and we'll get back to you within 24 hours.", 'blogtechu-custom' ); ?></p>

      <div class="talk-alert" data-talk-alert role="alert" hidden></div>

      <form class="talk-form" data-talk-form novalidate>
        <div class="ct-field">
          <label class="ct-label" for="talk_name"><?php esc_html_e( 'Your Name', 'blogtechu-custom' ); ?> <span class="req">*</span></label>
          <input class="ct-input" type="text" id="talk_name" name="name" placeholder="<?php esc_attr_e( 'John Doe', 'blogtechu-custom' ); ?>" required />
        </div>
        <div class="ct-field">
          <label class="ct-label" for="talk_email"><?php esc_html_e( 'Email', 'blogtechu-custom' ); ?> <span class="req">*</span></label>
          <input class="ct-input" type="email" id="talk_email" name="email" placeholder="<?php esc_attr_e( 'you@example.com', 'blogtechu-custom' ); ?>" required />
        </div>
        <div class="ct-field">
          <label class="ct-label" for="talk_phone"><?php esc_html_e( 'Phone (optional)', 'blogtechu-custom' ); ?></label>
          <input class="ct-input" type="tel" id="talk_phone" name="phone" placeholder="<?php esc_attr_e( '+91 …', 'blogtechu-custom' ); ?>" />
        </div>
        <div class="ct-field">
          <label class="ct-label" for="talk_subject"><?php esc_html_e( 'Subject', 'blogtechu-custom' ); ?></label>
          <input class="ct-input" type="text" id="talk_subject" name="subject" placeholder="<?php esc_attr_e( 'e.g. Website project enquiry', 'blogtechu-custom' ); ?>" />
        </div>
        <div class="ct-field">
          <label class="ct-label" for="talk_message"><?php esc_html_e( 'Message', 'blogtechu-custom' ); ?> <span class="req">*</span></label>
          <textarea class="ct-textarea" id="talk_message" name="message" placeholder="<?php esc_attr_e( 'How can we help?', 'blogtechu-custom' ); ?>" required></textarea>
        </div>

        <?php // Honeypot. ?>
        <div style="position:absolute;left:-9999px;" aria-hidden="true">
          <label for="talk_website"><?php esc_html_e( 'Website', 'blogtechu-custom' ); ?></label>
          <input type="text" id="talk_website" name="website" tabindex="-1" autocomplete="off" />
        </div>

        <button type="submit" class="talk-submit"><?php esc_html_e( 'Send Message', 'blogtechu-custom' ); ?></button>
      </form>

      <p class="talk-foot"><?php esc_html_e( 'Prefer email?', 'blogtechu-custom' ); ?> <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>"><?php esc_html_e( 'Visit our contact page', 'blogtechu-custom' ); ?></a></p>
    </div>
  </div>
  <script>
    window.BlogtechuTalk = {
      ajaxUrl: <?php echo wp_json_encode( admin_url( 'admin-ajax.php' ) ); ?>,
      nonce: <?php echo wp_json_encode( wp_create_nonce( 'blogtechu_lets_talk' ) ); ?>
    };
  </script>
<main class="site-content">
