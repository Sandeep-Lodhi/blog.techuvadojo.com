import '../css/app.css';

const themeRoot = document.documentElement;
console.log('Blogtechu Custom theme loaded');

if ( themeRoot ) {
  themeRoot.dataset.theme = 'blogtechu-custom';
}

/* ---- Portfolio category filter ---- */
function initPortfolioFilter() {
  const grid = document.querySelector('[data-pf-grid]');
  if ( ! grid ) {
    return;
  }

  const buttons = document.querySelectorAll('[data-pf-filter]');
  const items = grid.querySelectorAll('[data-pf-cats]');
  const emptyMsg = grid.querySelector('[data-pf-empty]');

  buttons.forEach((btn) => {
    btn.addEventListener('click', () => {
      const filter = btn.getAttribute('data-pf-filter');

      buttons.forEach((b) => b.classList.toggle('is-active', b === btn));

      let visible = 0;
      items.forEach((item) => {
        const cats = (item.getAttribute('data-pf-cats') || '').split(' ');
        const show = filter === '*' || cats.includes(filter);
        item.classList.toggle('is-hidden', ! show);
        if ( show ) {
          visible += 1;
        }
      });

      if ( emptyMsg ) {
        emptyMsg.style.display = visible === 0 ? '' : 'none';
      }
    });
  });
}

document.addEventListener('DOMContentLoaded', initPortfolioFilter);

/* ---- Careers: job filter + "Apply" auto-fill ---- */
function initCareers() {
  const list = document.querySelector('[data-cr-list]');

  // Job search + department filter.
  if ( list ) {
    const searchInput = document.querySelector('[data-cr-search]');
    const deptSelect = document.querySelector('[data-cr-dept]');
    const jobs = list.querySelectorAll('[data-cr-title]');
    const emptyMsg = document.querySelector('[data-cr-empty]');

    const applyFilter = () => {
      const q = (searchInput ? searchInput.value : '').trim().toLowerCase();
      const dept = deptSelect ? deptSelect.value : '';
      let visible = 0;

      jobs.forEach((job) => {
        const title = job.getAttribute('data-cr-title') || '';
        const jobDept = job.getAttribute('data-cr-dept') || '';
        const matchesQuery = ! q || title.indexOf(q) !== -1;
        const matchesDept = ! dept || jobDept === dept;
        const show = matchesQuery && matchesDept;
        job.classList.toggle('is-hidden', ! show);
        if ( show ) {
          visible += 1;
        }
      });

      if ( emptyMsg ) {
        emptyMsg.style.display = visible === 0 ? '' : 'none';
      }
    };

    if ( searchInput ) {
      searchInput.addEventListener('input', applyFilter);
    }
    if ( deptSelect ) {
      deptSelect.addEventListener('change', applyFilter);
    }
  }

  // "Apply" buttons → fill position field and scroll to the form (used when an
  // apply button targets an on-page form via [data-apply-position]).
  const positionField = document.getElementById('cr_position');
  const applyButtons = document.querySelectorAll('[data-apply-position]');

  applyButtons.forEach((btn) => {
    btn.addEventListener('click', () => {
      const position = btn.getAttribute('data-apply-position');
      if ( positionField && position ) {
        positionField.value = position;
      }
      const form = document.getElementById('apply-form');
      if ( form ) {
        form.scrollIntoView({ behavior: 'smooth', block: 'start' });
        const nameField = document.getElementById('cr_name');
        if ( nameField ) {
          window.setTimeout(() => nameField.focus(), 400);
        }
      }
    });
  });

  // Resume upload → show chosen filename in the styled drop box.
  const resumeInput = document.getElementById('cr_resume');
  const fileLabel = document.querySelector('[data-cr-file-label]');
  if ( resumeInput && fileLabel ) {
    const defaultLabel = fileLabel.textContent;
    resumeInput.addEventListener('change', () => {
      fileLabel.textContent = resumeInput.files && resumeInput.files.length
        ? resumeInput.files[0].name
        : defaultLabel;
    });
  }
}

document.addEventListener('DOMContentLoaded', initCareers);

/* ---- Projects: category filter ---- */
function initProjects() {
  const list = document.querySelector('[data-pj-list]');
  if (!list) return;
  const buttons = document.querySelectorAll('[data-pj-filter]');
  const cards = list.querySelectorAll('[data-pj-cat]');
  const emptyMsg = document.querySelector('[data-pj-empty]');

  buttons.forEach((btn) => {
    btn.addEventListener('click', () => {
      const filter = btn.getAttribute('data-pj-filter');
      buttons.forEach((b) => b.classList.toggle('is-active', b === btn));
      let visible = 0;
      cards.forEach((card) => {
        const show = filter === 'all' || card.getAttribute('data-pj-cat') === filter;
        card.classList.toggle('is-hidden', !show);
        if (show) visible += 1;
      });
      if (emptyMsg) emptyMsg.style.display = visible === 0 ? '' : 'none';
    });
  });
}

document.addEventListener('DOMContentLoaded', initProjects);

/* ---- Team: testimonials slider ---- */
function initTeamSlider() {
  const track = document.querySelector('[data-tm-track]');
  if (!track) return;
  const prev = document.querySelector('[data-tm-prev]');
  const next = document.querySelector('[data-tm-next]');
  const dotsWrap = document.querySelector('[data-tm-dots]');
  const cards = Array.from(track.querySelectorAll('.tm-voice'));
  if (!cards.length) return;

  const step = () => {
    const card = cards[0];
    const gap = parseFloat(getComputedStyle(track).columnGap || getComputedStyle(track).gap || '24') || 24;
    return card.offsetWidth + gap;
  };
  const perView = () => Math.max(1, Math.round(track.clientWidth / step()));

  // Build dots (one per "page").
  let dots = [];
  const buildDots = () => {
    if (!dotsWrap) return;
    const pages = Math.max(1, cards.length - perView() + 1);
    dotsWrap.innerHTML = '';
    dots = [];
    for (let i = 0; i < pages; i++) {
      const d = document.createElement('button');
      d.className = 'tm-dot';
      d.type = 'button';
      d.addEventListener('click', () => track.scrollTo({ left: i * step(), behavior: 'smooth' }));
      dotsWrap.appendChild(d);
      dots.push(d);
    }
  };

  const update = () => {
    const idx = Math.round(track.scrollLeft / step());
    dots.forEach((d, i) => d.classList.toggle('is-active', i === idx));
    if (prev) prev.disabled = track.scrollLeft < 4;
    if (next) next.disabled = track.scrollLeft >= track.scrollWidth - track.clientWidth - 4;
  };

  if (next) next.addEventListener('click', () => track.scrollBy({ left: step(), behavior: 'smooth' }));
  if (prev) prev.addEventListener('click', () => track.scrollBy({ left: -step(), behavior: 'smooth' }));
  track.addEventListener('scroll', () => window.requestAnimationFrame(update), { passive: true });
  window.addEventListener('resize', () => { buildDots(); update(); });

  buildDots();
  update();
}

document.addEventListener('DOMContentLoaded', initTeamSlider);

/* ---- Gallery: category filter ---- */
function initGallery() {
  const list = document.querySelector('[data-gl-list]');
  if (!list) return;
  const buttons = document.querySelectorAll('[data-gl-filter]');
  const tiles = list.querySelectorAll('[data-gl-cat]');
  const emptyMsg = document.querySelector('[data-gl-empty]');
  const lightbox = document.querySelector('[data-gl-lightbox]');

  buttons.forEach((btn) => {
    btn.addEventListener('click', () => {
      const filter = btn.getAttribute('data-gl-filter');
      buttons.forEach((b) => b.classList.toggle('is-active', b === btn));
      let visible = 0;
      tiles.forEach((tile) => {
        const show = filter === 'all' || tile.getAttribute('data-gl-cat') === filter;
        tile.classList.toggle('is-hidden', !show);
        if (show) visible += 1;
      });
      if (emptyMsg) emptyMsg.style.display = visible === 0 ? '' : 'none';
    });
  });

  if (lightbox) {
    const image = lightbox.querySelector('[data-gl-lightbox-img]');
    const title = lightbox.querySelector('[data-gl-lightbox-title]');
    const category = lightbox.querySelector('[data-gl-lightbox-category]');
    const caption = lightbox.querySelector('[data-gl-lightbox-caption]');
    const closeEls = lightbox.querySelectorAll('[data-gl-lightbox-close]');

    const closeLightbox = () => {
      lightbox.classList.remove('is-open');
      lightbox.setAttribute('aria-hidden', 'true');
      document.body.style.overflow = '';
      if (image) {
        image.removeAttribute('src');
        image.alt = '';
      }
    };

    tiles.forEach((tile) => {
      tile.addEventListener('click', () => {
        const src = tile.getAttribute('data-gl-full');
        if (!src || !image) return;

        const tileTitle = tile.getAttribute('data-gl-title') || '';
        image.src = src;
        image.alt = tileTitle;
        if (title) title.textContent = tileTitle;
        if (category) category.textContent = tile.getAttribute('data-gl-category') || '';
        if (caption) caption.textContent = tile.getAttribute('data-gl-caption') || '';
        lightbox.classList.add('is-open');
        lightbox.setAttribute('aria-hidden', 'false');
        document.body.style.overflow = 'hidden';
      });
    });

    closeEls.forEach((el) => el.addEventListener('click', closeLightbox));
    lightbox.addEventListener('click', (event) => {
      if (event.target === lightbox) {
        closeLightbox();
      }
    });
    document.addEventListener('keydown', (event) => {
      if (event.key === 'Escape' && lightbox.classList.contains('is-open')) {
        closeLightbox();
      }
    });
  }
}

document.addEventListener('DOMContentLoaded', initGallery);

/* ---- Search overlay ---- */
function initSearchOverlay() {
  const overlay = document.getElementById('site-search');
  if ( ! overlay ) {
    return;
  }

  const openButtons = document.querySelectorAll('[data-search-open]');
  const closeEls = overlay.querySelectorAll('[data-search-close]');
  const input = overlay.querySelector('.search-overlay-input');

  function openSearch() {
    overlay.classList.add('is-open');
    overlay.setAttribute('aria-hidden', 'false');
    document.body.style.overflow = 'hidden';
    window.setTimeout(() => {
      if ( input ) {
        input.focus();
        input.select();
      }
    }, 60);
  }

  function closeSearch() {
    overlay.classList.remove('is-open');
    overlay.setAttribute('aria-hidden', 'true');
    document.body.style.overflow = '';
  }

  openButtons.forEach((btn) => btn.addEventListener('click', openSearch));
  closeEls.forEach((el) => el.addEventListener('click', closeSearch));

  document.addEventListener('keydown', (e) => {
    if ( e.key === 'Escape' && overlay.classList.contains('is-open') ) {
      closeSearch();
    }
    // Quick-open with "/" when not typing in a field.
    const tag = (e.target && e.target.tagName) ? e.target.tagName.toLowerCase() : '';
    if ( e.key === '/' && tag !== 'input' && tag !== 'textarea' && ! overlay.classList.contains('is-open') ) {
      e.preventDefault();
      openSearch();
    }
  });

  // Prevent submitting an empty query.
  const form = overlay.querySelector('.search-overlay-form');
  if ( form ) {
    form.addEventListener('submit', (e) => {
      if ( ! input || input.value.trim() === '' ) {
        e.preventDefault();
        if ( input ) {
          input.focus();
        }
      }
    });
  }
}

document.addEventListener('DOMContentLoaded', initSearchOverlay);

/* ---- Mobile navigation drawer ---- */
function initMobileNav() {
  const nav = document.getElementById('mobile-nav');
  if ( ! nav ) {
    return;
  }

  const openButtons = document.querySelectorAll('[data-nav-open]');
  const closeEls = nav.querySelectorAll('[data-nav-close]');
  const links = nav.querySelectorAll('.mobile-nav-link, .mobile-nav-cta');

  function openNav() {
    nav.classList.add('is-open');
    nav.setAttribute('aria-hidden', 'false');
    document.body.style.overflow = 'hidden';
    openButtons.forEach((b) => b.setAttribute('aria-expanded', 'true'));
  }

  function closeNav() {
    nav.classList.remove('is-open');
    nav.setAttribute('aria-hidden', 'true');
    document.body.style.overflow = '';
    openButtons.forEach((b) => b.setAttribute('aria-expanded', 'false'));
  }

  openButtons.forEach((btn) => btn.addEventListener('click', openNav));
  closeEls.forEach((el) => el.addEventListener('click', closeNav));
  links.forEach((link) => link.addEventListener('click', closeNav));

  document.addEventListener('keydown', (e) => {
    if ( e.key === 'Escape' && nav.classList.contains('is-open') ) {
      closeNav();
    }
  });

  // Auto-close if the viewport grows to the desktop breakpoint.
  window.addEventListener('resize', () => {
    if ( window.innerWidth >= 1024 && nav.classList.contains('is-open') ) {
      closeNav();
    }
  });
}

document.addEventListener('DOMContentLoaded', initMobileNav);

/* ---- Animated number counters (count up when scrolled into view) ---- */
function initCounters() {
  if ( ! ('IntersectionObserver' in window) ) {
    return;
  }
  const counters = document.querySelectorAll('[data-count-to]');
  if ( ! counters.length ) {
    return;
  }

  function animate(el) {
    const target = parseFloat(el.getAttribute('data-count-to')) || 0;
    const suffix = el.getAttribute('data-count-suffix') || '';
    const duration = 1500;
    let startTime = null;
    function tick(now) {
      if ( startTime === null ) {
        startTime = now;
      }
      const progress = Math.min((now - startTime) / duration, 1);
      const eased = 1 - Math.pow(1 - progress, 3);
      el.textContent = Math.round(target * eased) + suffix;
      if ( progress < 1 ) {
        window.requestAnimationFrame(tick);
      } else {
        el.textContent = target + suffix;
      }
    }
    window.requestAnimationFrame(tick);
  }

  const io = new IntersectionObserver((entries, obs) => {
    entries.forEach((entry) => {
      if ( entry.isIntersecting ) {
        animate(entry.target);
        obs.unobserve(entry.target);
      }
    });
  }, { threshold: 0.4 });

  counters.forEach((c) => io.observe(c));
}

document.addEventListener('DOMContentLoaded', initCounters);

/* ---- Scroll reveal (fade/slide sections & cards into view) ---- */
function initScrollReveal() {
  if ( ! ('IntersectionObserver' in window) ) {
    return;
  }
  if ( window.matchMedia('(prefers-reduced-motion: reduce)').matches ) {
    return;
  }

  const selector = '.service-card, .why-card, .hpw-card, .post-card, .faq-item, .industry-card, .stack-group, .process-step, .model-card, .price-card, .trust-item, .pj-card';
  const els = Array.prototype.slice.call(document.querySelectorAll(selector));
  if ( ! els.length ) {
    return;
  }

  // Stagger siblings within the same parent for a smooth cascade.
  const groupCounts = new Map();
  els.forEach((el) => {
    el.classList.add('reveal-init');
    const parent = el.parentElement;
    const i = groupCounts.get(parent) || 0;
    el.style.transitionDelay = Math.min(i * 70, 350) + 'ms';
    groupCounts.set(parent, i + 1);
  });

  const io = new IntersectionObserver((entries, obs) => {
    entries.forEach((entry) => {
      if ( entry.isIntersecting ) {
        entry.target.classList.add('is-revealed');
        obs.unobserve(entry.target);
      }
    });
  }, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' });

  els.forEach((el) => io.observe(el));
}

document.addEventListener('DOMContentLoaded', initScrollReveal);

/* ---- Let's Talk modal (AJAX quick enquiry) ---- */
function initLetsTalk() {
  const modal = document.getElementById('lets-talk');
  if ( ! modal ) {
    return;
  }

  const openButtons = document.querySelectorAll('[data-talk-open]');
  const closeEls = modal.querySelectorAll('[data-talk-close]');
  const form = modal.querySelector('[data-talk-form]');
  const alertBox = modal.querySelector('[data-talk-alert]');
  const firstInput = modal.querySelector('input[name="name"]');

  function openModal(e) {
    if ( e ) {
      e.preventDefault();
    }
    modal.classList.add('is-open');
    modal.setAttribute('aria-hidden', 'false');
    document.body.style.overflow = 'hidden';
    window.setTimeout(() => {
      if ( firstInput ) {
        firstInput.focus();
      }
    }, 60);
  }

  function closeModal() {
    modal.classList.remove('is-open');
    modal.setAttribute('aria-hidden', 'true');
    document.body.style.overflow = '';
  }

  function showAlert(type, msg) {
    if ( ! alertBox ) {
      return;
    }
    if ( ! msg ) {
      alertBox.hidden = true;
      alertBox.className = 'talk-alert';
      alertBox.textContent = '';
      return;
    }
    alertBox.hidden = false;
    alertBox.className = 'talk-alert ' + ( type === 'success' ? 'ct-alert-success' : 'ct-alert-error' );
    alertBox.textContent = msg;
  }

  openButtons.forEach((btn) => btn.addEventListener('click', openModal));
  closeEls.forEach((el) => el.addEventListener('click', closeModal));

  document.addEventListener('keydown', (e) => {
    if ( e.key === 'Escape' && modal.classList.contains('is-open') ) {
      closeModal();
    }
  });

  if ( form ) {
    form.addEventListener('submit', async (e) => {
      e.preventDefault();
      const cfg = window.BlogtechuTalk || {};
      if ( ! cfg.ajaxUrl ) {
        return; // No config — fall back to the contact page link.
      }

      const submitBtn = form.querySelector('[type="submit"]');
      const originalText = submitBtn ? submitBtn.textContent : '';
      showAlert('', '');

      const data = new FormData(form);
      data.append('action', 'blogtechu_lets_talk');
      data.append('nonce', cfg.nonce || '');

      if ( submitBtn ) {
        submitBtn.disabled = true;
        submitBtn.textContent = 'Sending…';
      }

      try {
        const res = await fetch(cfg.ajaxUrl, { method: 'POST', body: data, credentials: 'same-origin' });
        const json = await res.json();
        if ( json && json.success ) {
          showAlert('success', json.data.message);
          form.reset();
        } else {
          showAlert('error', ( json && json.data && json.data.message ) ? json.data.message : 'Something went wrong. Please try again.');
        }
      } catch ( err ) {
        showAlert('error', 'Network error. Please try again.');
      }

      if ( submitBtn ) {
        submitBtn.disabled = false;
        submitBtn.textContent = originalText;
      }
    });
  }
}

document.addEventListener('DOMContentLoaded', initLetsTalk);

/* ---- Blog: AJAX category filter + Load More ---- */
function initBlog() {
  const grid = document.querySelector('[data-blog-grid]');
  if ( ! grid ) {
    return;
  }

  const cfg = window.BlogtechuBlog || {};
  if ( ! cfg.ajaxUrl ) {
    return; // No config — category links fall back to archive pages.
  }

  const pills = document.querySelectorAll('[data-blog-filter]');
  const loadMore = document.querySelector('[data-blog-loadmore]');
  const countEl = document.querySelector('[data-blog-count]');
  const state = { category: 'all', page: 1 };

  function setLoadMore(hasMore) {
    if ( ! loadMore ) {
      return;
    }
    loadMore.parentElement.style.display = hasMore ? '' : 'none';
  }

  async function fetchPosts(category, page, append) {
    const data = new FormData();
    data.append('action', 'blogtechu_get_blog_posts');
    data.append('nonce', cfg.nonce || '');
    data.append('category', category);
    data.append('paged', String(page));
    if ( cfg.exclude ) {
      data.append('exclude', cfg.exclude);
    }

    if ( append && loadMore ) {
      loadMore.classList.add('is-loading');
      loadMore.disabled = true;
    } else {
      grid.classList.add('is-loading');
    }

    try {
      const res = await fetch(cfg.ajaxUrl, { method: 'POST', body: data, credentials: 'same-origin' });
      const json = await res.json();
      if ( json && json.success ) {
        if ( append ) {
          grid.insertAdjacentHTML('beforeend', json.data.html);
        } else {
          grid.innerHTML = json.data.html;
        }
        setLoadMore(json.data.hasMore);
        if ( countEl && ! append ) {
          countEl.textContent = json.data.found
            ? json.data.found + ' article' + ( json.data.found === 1 ? '' : 's' )
            : '';
        }
      }
    } catch ( err ) {
      /* network error — leave current content in place */
    }

    grid.classList.remove('is-loading');
    if ( loadMore ) {
      loadMore.classList.remove('is-loading');
      loadMore.disabled = false;
    }
  }

  pills.forEach((pill) => {
    pill.addEventListener('click', (e) => {
      e.preventDefault();
      pills.forEach((p) => p.classList.toggle('is-active', p === pill));
      state.category = pill.getAttribute('data-blog-filter') || 'all';
      state.page = 1;
      fetchPosts(state.category, 1, false);
      grid.scrollIntoView({ behavior: 'smooth', block: 'start' });
    });
  });

  if ( loadMore ) {
    loadMore.addEventListener('click', () => {
      state.page += 1;
      fetchPosts(state.category, state.page, true);
    });
  }
}

document.addEventListener('DOMContentLoaded', initBlog);

/* ---- Single post: reading progress bar + copy link ---- */
function initSinglePost() {
  const bar = document.querySelector('[data-reading-progress]');
  const target = document.querySelector('[data-reading-target]');

  if ( bar && target ) {
    const update = () => {
      const rect = target.getBoundingClientRect();
      const total = target.offsetHeight - window.innerHeight;
      const scrolled = Math.min(Math.max(-rect.top, 0), Math.max(total, 0));
      const pct = total > 0 ? ( scrolled / total ) * 100 : 0;
      bar.style.width = pct + '%';
    };
    window.addEventListener('scroll', update, { passive: true });
    window.addEventListener('resize', update);
    update();
  }

  document.querySelectorAll('[data-copy-link]').forEach((btn) => {
    btn.addEventListener('click', async () => {
      const url = btn.getAttribute('data-copy-link');
      try {
        await navigator.clipboard.writeText(url);
        const original = btn.innerHTML;
        btn.innerHTML = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg>';
        btn.classList.add('text-emerald-600', 'border-emerald-300');
        window.setTimeout(() => {
          btn.innerHTML = original;
          btn.classList.remove('text-emerald-600', 'border-emerald-300');
        }, 1500);
      } catch ( err ) {
        /* clipboard not available */
      }
    });
  });

  // Build Table of Contents from the article headings.
  const tocNav = document.querySelector('[data-toc]');
  const tocCard = document.querySelector('[data-toc-card]');
  let tocLinks = [];
  let headings = [];

  if ( tocNav && target ) {
    headings = Array.from(target.querySelectorAll('h2, h3'));
    if ( headings.length >= 2 ) {
      headings.forEach((h, i) => {
        if ( ! h.id ) {
          h.id = 'section-' + ( i + 1 ) + '-' + h.textContent.trim().toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/(^-|-$)/g, '').slice(0, 40);
        }
        const a = document.createElement('a');
        a.href = '#' + h.id;
        a.textContent = h.textContent;
        if ( h.tagName === 'H3' ) {
          a.classList.add('toc-h3');
        }
        a.addEventListener('click', (e) => {
          e.preventDefault();
          const top = h.getBoundingClientRect().top + window.pageYOffset - 90;
          window.scrollTo({ top: top, behavior: 'smooth' });
        });
        tocNav.appendChild(a);
        tocLinks.push(a);
      });
      if ( tocCard ) {
        tocCard.hidden = false;
      }
    }
  }

  // Scroll-spy for the TOC.
  function onScroll() {
    if ( headings.length ) {
      let activeIndex = 0;
      headings.forEach((h, i) => {
        if ( h.getBoundingClientRect().top <= 120 ) {
          activeIndex = i;
        }
      });
      tocLinks.forEach((a, i) => a.classList.toggle('is-active', i === activeIndex));
    }

    if ( backTop ) {
      backTop.classList.toggle('is-visible', window.pageYOffset > 600);
    }
  }

  // Back-to-top button.
  const backTop = document.querySelector('[data-back-to-top]');
  if ( backTop ) {
    backTop.addEventListener('click', () => window.scrollTo({ top: 0, behavior: 'smooth' }));
  }

  window.addEventListener('scroll', onScroll, { passive: true });
  onScroll();
}

document.addEventListener('DOMContentLoaded', initSinglePost);

/* ---- Services page: category filter ---- */
function initServiceFilter() {
  const grid = document.querySelector('[data-svc-grid]');
  if ( ! grid ) {
    return;
  }
  const buttons = document.querySelectorAll('[data-svc-filter]');
  const cards = grid.querySelectorAll('[data-svc-cat]');
  const empty = grid.querySelector('[data-svc-empty]');

  buttons.forEach((btn) => {
    btn.addEventListener('click', () => {
      const filter = btn.getAttribute('data-svc-filter');
      buttons.forEach((b) => b.classList.toggle('is-active', b === btn));

      let visible = 0;
      cards.forEach((card) => {
        const cats = ( card.getAttribute('data-svc-cat') || '' ).split(' ');
        const show = filter === '*' || cats.includes(filter);
        card.classList.toggle('is-hidden', ! show);
        if ( show ) {
          visible += 1;
        }
      });
      if ( empty ) {
        empty.style.display = visible === 0 ? '' : 'none';
      }
    });
  });
}

document.addEventListener('DOMContentLoaded', initServiceFilter);

/* ---- News page: AJAX category filter + load more ---- */
function initNews() {
  const grid = document.querySelector('[data-news-grid]');
  if ( ! grid ) {
    return;
  }
  const cfg = window.BlogtechuNews || {};
  if ( ! cfg.ajaxUrl ) {
    return;
  }

  const pills = document.querySelectorAll('[data-news-filter]');
  const loadMore = document.querySelector('[data-news-loadmore]');
  const countHint = document.querySelector('[data-news-count]');
  const loadWrap = loadMore ? loadMore.closest('.load-more-wrap') : null;
  const state = { category: 'all', page: 1, busy: false };

  function setLoadMoreVisible(show) {
    if ( loadWrap ) {
      loadWrap.style.display = show ? '' : 'none';
    }
  }

  async function fetchNews(append) {
    if ( state.busy ) {
      return;
    }
    state.busy = true;

    const data = new FormData();
    data.append('action', 'blogtechu_get_news_posts');
    data.append('nonce', cfg.nonce || '');
    data.append('category', state.category);
    data.append('paged', String(state.page));
    if ( cfg.exclude ) {
      data.append('exclude', cfg.exclude);
    }

    if ( append && loadMore ) {
      loadMore.classList.add('is-loading');
    } else {
      grid.classList.add('is-loading');
    }

    try {
      const res = await fetch(cfg.ajaxUrl, { method: 'POST', body: data, credentials: 'same-origin' });
      const json = await res.json();
      if ( json && json.success ) {
        if ( append ) {
          grid.insertAdjacentHTML('beforeend', json.data.html);
        } else {
          grid.innerHTML = json.data.html;
        }
        setLoadMoreVisible(!! json.data.hasMore);
        if ( countHint ) {
          const total = parseInt(json.data.found, 10) || 0;
          const active = document.querySelector('[data-news-filter].is-active');
          const label = active ? active.textContent.replace(/\s*\d+\s*$/, '').trim() : 'All';
          countHint.textContent = total ? total + ' article' + ( total === 1 ? '' : 's' ) + ' in “' + label + '”' : '';
        }
      }
    } catch ( err ) {
      /* keep server-rendered content */
    }

    grid.classList.remove('is-loading');
    if ( loadMore ) {
      loadMore.classList.remove('is-loading');
    }
    state.busy = false;
  }

  pills.forEach((pill) => {
    pill.addEventListener('click', (e) => {
      e.preventDefault();
      pills.forEach((p) => p.classList.toggle('is-active', p === pill));
      state.category = pill.getAttribute('data-news-filter') || 'all';
      state.page = 1;
      fetchNews(false);
      const section = document.querySelector('.nw-section');
      if ( section ) {
        window.scrollTo({ top: section.offsetTop - 90, behavior: 'smooth' });
      }
    });
  });

  if ( loadMore ) {
    loadMore.addEventListener('click', () => {
      state.page += 1;
      fetchNews(true);
    });
  }
}

document.addEventListener('DOMContentLoaded', initNews);

/* ---- News home: infinite-scroll feed ---- */
function initNewsFeed() {
  const grid = document.querySelector('[data-newsfeed]');
  const sentinel = document.querySelector('[data-newsfeed-sentinel]');
  if ( ! grid || ! sentinel ) {
    return;
  }
  const cfg = window.BlogtechuNewsFeed || {};
  if ( ! cfg.ajaxUrl ) {
    return;
  }

  const loadEl = document.querySelector('[data-newsfeed-loading]');
  const endEl = document.querySelector('[data-newsfeed-end]');
  const total = parseInt(cfg.totalPages, 10) || 1;
  let page = 1;
  let busy = false;
  let done = total <= 1;

  if ( done && endEl ) {
    endEl.hidden = false;
  }

  async function loadMore() {
    if ( busy || done ) {
      return;
    }
    busy = true;
    if ( loadEl ) {
      loadEl.classList.add('is-active');
    }
    page += 1;

    const data = new FormData();
    data.append('action', 'blogtechu_get_news_posts');
    data.append('nonce', cfg.nonce || '');
    data.append('category', 'all');
    data.append('paged', String(page));

    try {
      const res = await fetch(cfg.ajaxUrl, { method: 'POST', body: data, credentials: 'same-origin' });
      const json = await res.json();
      if ( json && json.success ) {
        grid.insertAdjacentHTML('beforeend', json.data.html);
        if ( ! json.data.hasMore || page >= total ) {
          done = true;
          if ( endEl ) {
            endEl.hidden = false;
          }
          observer.disconnect();
        }
      }
    } catch ( err ) {
      /* network error — stop gracefully */
    }

    if ( loadEl ) {
      loadEl.classList.remove('is-active');
    }
    busy = false;
  }

  const observer = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if ( entry.isIntersecting ) {
          loadMore();
        }
      });
    },
    { rootMargin: '500px 0px' }
  );
  observer.observe(sentinel);
}

document.addEventListener('DOMContentLoaded', initNewsFeed);

/* ---- Global scroll-reveal (subtle fade/slide-in for sections) ---- */
function initReveal() {
  if ( ! ( 'IntersectionObserver' in window ) ) {
    return;
  }
  const selectors = [
    '.services-section', '.why-section', '.industries-section', '.stack-section',
    '.process-section', '.models-section', '.pricing-section', '.faq-section',
    '.testi-section', '.work-strip', '.cta-banner', '.trust-strip', '.tech-section',
    '.section-heading-row', '.blog-layout', '.featured-post', '.single-related',
    '.na-related', '.ab-story', '.ab-values', '.ab-skills', '.ab-team', '.ab-timeline',
    '.cr-perks', '.cr-jobs', '.cr-apply', '.ct-layout', '.ct-map',
    '.pf-grid', '.prj-grid', '.prj-featured',
    '.po-case', '.po-build-card', '.po-tile', '.po-step',
    '.nb-top', '.nb-featured-grid', '.nb-bottom', '.nb-catblock', '.industries-grid'
  ];
  const els = document.querySelectorAll(selectors.join(','));
  if ( ! els.length ) {
    return;
  }

  const observer = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if ( entry.isIntersecting ) {
          entry.target.classList.add('is-visible');
          observer.unobserve(entry.target);
        }
      });
    },
    { rootMargin: '0px 0px -8% 0px', threshold: 0.05 }
  );

  els.forEach((el) => {
    el.classList.add('reveal');
    observer.observe(el);
  });

  // Safety net: if anything is still hidden after 2s, reveal it.
  window.setTimeout(() => {
    document.querySelectorAll('.reveal:not(.is-visible)').forEach((el) => {
      const rect = el.getBoundingClientRect();
      if ( rect.top < window.innerHeight ) {
        el.classList.add('is-visible');
      }
    });
  }, 2000);
}

document.addEventListener('DOMContentLoaded', initReveal);

/* Privacy Policy: highlight the active "On This Page" link while scrolling. */
function initPrivacyToc() {
  const links = Array.from(document.querySelectorAll('.pp-toc-link'));
  if (!links.length) return;
  const map = new Map();
  links.forEach((l) => {
    const id = l.getAttribute('href').slice(1);
    const sec = document.getElementById(id);
    if (sec) map.set(sec, l);
  });
  const setActive = (link) => {
    links.forEach((l) => l.classList.toggle('is-active', l === link));
  };
  const obs = new IntersectionObserver((entries) => {
    const visible = entries.filter((e) => e.isIntersecting)
      .sort((a, b) => a.boundingClientRect.top - b.boundingClientRect.top);
    if (visible.length) setActive(map.get(visible[0].target));
  }, { rootMargin: '-120px 0px -65% 0px', threshold: 0 });
  map.forEach((_, sec) => obs.observe(sec));
}

document.addEventListener('DOMContentLoaded', initPrivacyToc);
