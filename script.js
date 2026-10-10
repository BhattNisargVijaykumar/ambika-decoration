/* ==========================================================================
   Ambika Decoration & Party Plot - PHP API & JS Frontend Scripts
   ========================================================================== */

document.addEventListener('DOMContentLoaded', () => {
  initPreloader();
  initSparkleCanvas();
  initFlowerPetalShower();
  initAllSectionsScrollZoom();
  initScrollReveal();
  initAnimatedCounters();
  initGalleryFilters();
  initLightbox();
  initMenuTabs();
  initMobileMenu();
  initNavbarScroll();
  initDefaultDate();
});

/* --------------------------------------------------------------------------
   0. Royal Preloader Screen (3s Character Reveal & 0-100% Counter)
   -------------------------------------------------------------------------- */
function initPreloader() {
  const preloader = document.getElementById('preloader');
  const bar = document.getElementById('preloader-bar');
  const counter = document.getElementById('preloader-counter');

  if (!preloader || !bar || !counter) return;

  const totalDuration = 2800;
  const startTime = performance.now();

  function updatePreloader(currentTime) {
    const elapsed = currentTime - startTime;
    const progress = Math.min(1, elapsed / totalDuration);

    const easedProgress = Math.pow(progress, 0.85);
    const percent = Math.floor(easedProgress * 100);

    bar.style.width = `${percent}%`;
    counter.textContent = `${String(percent).padStart(3, '0')}%`;

    if (progress < 1) {
      requestAnimationFrame(updatePreloader);
    } else {
      counter.textContent = '100%';
      bar.style.width = '100%';

      setTimeout(() => {
        preloader.classList.add('preloader-hide');
        document.body.classList.add('preloader-complete');
      }, 300);
    }
  }

  requestAnimationFrame(updatePreloader);
}

/* --------------------------------------------------------------------------
   1. Background Golden Sparkle Particles Canvas
   -------------------------------------------------------------------------- */
function initSparkleCanvas() {
  const canvas = document.getElementById('sparkle-canvas');
  if (!canvas) return;
  const ctx = canvas.getContext('2d');

  let width = canvas.width = window.innerWidth;
  let height = canvas.height = window.innerHeight;

  window.addEventListener('resize', () => {
    width = canvas.width = window.innerWidth;
    height = canvas.height = window.innerHeight;
  });

  const particleCount = 45;
  const particles = [];

  class Particle {
    constructor() {
      this.reset();
    }

    reset() {
      this.x = Math.random() * width;
      this.y = Math.random() * height;
      this.size = Math.random() * 2.5 + 0.8;
      this.speedY = -(Math.random() * 0.4 + 0.1);
      this.speedX = (Math.random() - 0.5) * 0.3;
      this.alpha = Math.random() * 0.7 + 0.2;
      this.fade = Math.random() * 0.008 + 0.003;
    }

    update() {
      this.y += this.speedY;
      this.x += this.speedX;
      this.alpha -= this.fade;

      if (this.alpha <= 0 || this.y < 0) {
        this.reset();
        this.y = height + 10;
      }
    }

    draw() {
      ctx.save();
      ctx.globalAlpha = this.alpha;
      ctx.fillStyle = '#d4af37';
      ctx.beginPath();
      ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2);
      ctx.fill();

      // Soft glow
      ctx.shadowBlur = 8;
      ctx.shadowColor = '#f5e49f';
      ctx.restore();
    }
  }

  for (let i = 0; i < particleCount; i++) {
    particles.push(new Particle());
  }

  function animate() {
    ctx.clearRect(0, 0, width, height);
    particles.forEach(p => {
      p.update();
      p.draw();
    });
    requestAnimationFrame(animate);
  }

  animate();
}

/* --------------------------------------------------------------------------
   1b. Indian Wedding Flower Petals Dropping Animation (Rose & Marigold)
   -------------------------------------------------------------------------- */
function initFlowerPetalShower() {
  const container = document.getElementById('flower-petals');
  if (!container) return;

  const petalSymbols = ['🌸', '🌺', '🌹', '🌼', '✨'];
  const petalCount = 20;

  for (let i = 0; i < petalCount; i++) {
    const petal = document.createElement('div');
    petal.className = 'petal';
    petal.textContent = petalSymbols[Math.floor(Math.random() * petalSymbols.length)];
    
    const size = Math.random() * 1.4 + 0.9;
    const left = Math.random() * 100;
    const delay = Math.random() * 8;
    const duration = Math.random() * 5 + 6;

    petal.style.fontSize = `${size}rem`;
    petal.style.left = `${left}%`;
    petal.style.animationDelay = `${delay}s`;
    petal.style.animationDuration = `${duration}s`;

    container.appendChild(petal);
  }
}

/* --------------------------------------------------------------------------
   1c. Scroll Zoom-Out & Zoom-In Section Entrance/Exit Transition (All Sections)
   -------------------------------------------------------------------------- */
function initAllSectionsScrollZoom() {
  const zoomableSections = document.querySelectorAll('.hero, .portal-hero-wrapper, .section, footer');
  if (!zoomableSections.length) return;

  zoomableSections.forEach(sec => {
    sec.classList.add('section-zoom-container');
  });

  let ticking = false;

  function updateSectionZooms() {
    const vh = window.innerHeight;
    const vpCenter = vh / 2;

    zoomableSections.forEach(sec => {
      const rect = sec.getBoundingClientRect();
      
      // Skip sections far off screen
      if (rect.bottom < -300 || rect.top > vh + 300) {
        return;
      }

      const secCenter = rect.top + rect.height / 2;
      const distFromCenter = Math.abs(secCenter - vpCenter);
      const maxDistance = (vh + rect.height) / 2;

      // Distance ratio normalized between 0 (viewport center) and 1 (outer boundary)
      let normDist = Math.min(1, distFromCenter / maxDistance);

      // Hero Section specific parallax tuning
      if (sec.classList.contains('hero') || sec.classList.contains('portal-hero-wrapper')) {
        const scrollY = window.scrollY;
        const heroHeight = sec.offsetHeight || vh;
        const progress = Math.min(1, Math.max(0, scrollY / (heroHeight * 0.85)));
        const scale = 1 - (progress * 0.16);
        const opacity = 1 - (progress * 0.7);
        sec.style.transform = `scale(${Math.max(0.84, scale)})`;
        sec.style.opacity = `${Math.max(0.4, opacity)}`;
        return;
      }

      // Dynamic Section Zoom: 1.0 scale at viewport center, smooth zoom-out down to ~0.88 on scroll exit/entrance (capped on mobile)
      const isMobile = window.innerWidth <= 768;
      const minScale = isMobile ? 0.98 : 0.88;
      const scaleFactor = isMobile ? 0.02 : 0.12;
      
      const scale = 1 - (normDist * scaleFactor);
      const opacity = 1 - (normDist * (isMobile ? 0.2 : 0.4));
      const borderRadius = isMobile ? 0 : normDist * 22; // BeyondTheMap style framed portal window curvature on scroll

      sec.style.transform = `scale(${Math.max(minScale, scale)})`;
      sec.style.opacity = `${Math.max(0.6, opacity)}`;
      sec.style.borderRadius = `${borderRadius}px`;
    });

    ticking = false;
  }

  window.addEventListener('scroll', () => {
    if (!ticking) {
      requestAnimationFrame(updateSectionZooms);
      ticking = true;
    }
  }, { passive: true });

  // Initial call on page load
  updateSectionZooms();
}

/* --------------------------------------------------------------------------
   2. Scroll Reveal & Zoom-In Entrance Animations
   -------------------------------------------------------------------------- */
function initScrollReveal() {
  const revealElements = document.querySelectorAll('.scroll-reveal, .scroll-zoom-in');

  const observerOptions = {
    threshold: 0.12,
    rootMargin: '0px 0px -40px 0px'
  };

  const observer = new IntersectionObserver((entries, obs) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('revealed');
        obs.unobserve(entry.target);
      }
    });
  }, observerOptions);

  revealElements.forEach(el => observer.observe(el));
}

/* --------------------------------------------------------------------------
   3. Animated Stat Counters
   -------------------------------------------------------------------------- */
function initAnimatedCounters() {
  const counterElements = document.querySelectorAll('.metric-number');
  let started = false;

  const metricsSection = document.querySelector('.hero-metrics');
  if (!metricsSection) return;

  const observer = new IntersectionObserver((entries) => {
    if (entries[0].isIntersecting && !started) {
      started = true;
      counterElements.forEach(counter => {
        const target = parseInt(counter.getAttribute('data-target'), 10);
        const duration = 2000;
        const stepTime = 30;
        const steps = duration / stepTime;
        const increment = target / steps;

        let current = 0;
        const timer = setInterval(() => {
          current += increment;
          if (current >= target) {
            counter.textContent = target.toLocaleString();
            clearInterval(timer);
          } else {
            counter.textContent = Math.floor(current).toLocaleString();
          }
        }, stepTime);
      });
    }
  }, { threshold: 0.5 });

  observer.observe(metricsSection);
}

/* --------------------------------------------------------------------------
   4. Gallery Filtering System
   -------------------------------------------------------------------------- */
function initGalleryFilters() {
  const filterBtns = document.querySelectorAll('.filter-btn');
  const galleryCards = document.querySelectorAll('.gallery-card');

  filterBtns.forEach(btn => {
    btn.addEventListener('click', () => {
      filterBtns.forEach(b => b.classList.remove('active'));
      btn.classList.add('active');

      const filterValue = btn.getAttribute('data-filter');

      galleryCards.forEach(card => {
        const category = card.getAttribute('data-category');
        if (filterValue === 'all' || category === filterValue) {
          card.style.display = 'flex';
          setTimeout(() => {
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
          }, 50);
        } else {
          card.style.opacity = '0';
          card.style.transform = 'translateY(20px)';
          setTimeout(() => {
            card.style.display = 'none';
          }, 300);
        }
      });
    });
  });
}

/* --------------------------------------------------------------------------
   5. Lightbox Image Viewer Modal
   -------------------------------------------------------------------------- */
function initLightbox() {
  const modal = document.getElementById('lightbox-modal');
  const modalImg = document.getElementById('lightbox-img');
  const captionText = document.getElementById('lightbox-caption');
  const closeBtn = document.getElementById('lightbox-close');
  const triggers = document.querySelectorAll('.btn-lightbox-trigger');

  triggers.forEach(trigger => {
    trigger.addEventListener('click', (e) => {
      e.preventDefault();
      const imgSrc = trigger.getAttribute('data-img');
      const caption = trigger.getAttribute('data-caption');

      modalImg.src = imgSrc;
      captionText.textContent = caption;
      modal.classList.add('active');
    });
  });

  if (closeBtn) {
    closeBtn.addEventListener('click', () => {
      modal.classList.remove('active');
    });
  }

  if (modal) {
    modal.addEventListener('click', (e) => {
      if (e.target === modal) {
        modal.classList.remove('active');
      }
    });
  }
}

/* --------------------------------------------------------------------------
   6. Catering Menu Tabs System with Indian Style Zoom Animation
   -------------------------------------------------------------------------- */
function initMenuTabs() {
  const tabBtns = document.querySelectorAll('.menu-tab-btn');
  const tabPanes = document.querySelectorAll('.tab-pane');

  tabBtns.forEach(btn => {
    btn.addEventListener('click', () => {
      tabBtns.forEach(b => b.classList.remove('active'));
      tabPanes.forEach(p => p.classList.remove('active'));

      btn.classList.add('active');
      const targetTab = btn.getAttribute('data-tab');
      const targetPane = document.getElementById(`tab-${targetTab}`);
      if (targetPane) {
        targetPane.classList.add('active');
      }
    });
  });
}

/* --------------------------------------------------------------------------
   7. Mobile Navigation Toggle
   -------------------------------------------------------------------------- */
function initMobileMenu() {
  const toggleBtn = document.getElementById('mobile-toggle');
  const navMenu = document.getElementById('nav-menu');
  const navBackdrop = document.getElementById('nav-backdrop');
  const navLinks = document.querySelectorAll('.nav-link');

  function closeMenu() {
    if (navMenu) navMenu.classList.remove('active');
    if (navBackdrop) navBackdrop.classList.remove('active');
    if (toggleBtn) {
      const icon = toggleBtn.querySelector('i');
      if (icon) {
        icon.classList.add('fa-bars');
        icon.classList.remove('fa-xmark');
      }
    }
  }

  if (toggleBtn && navMenu) {
    closeMenu();
    toggleBtn.addEventListener('click', () => {
      const isActive = navMenu.classList.contains('active');
      if (isActive) {
        closeMenu();
      } else {
        navMenu.classList.add('active');
        if (navBackdrop) navBackdrop.classList.add('active');
        const icon = toggleBtn.querySelector('i');
        if (icon) {
          icon.classList.remove('fa-bars');
          icon.classList.add('fa-xmark');
        }
      }
    });

    if (navBackdrop) {
      navBackdrop.addEventListener('click', closeMenu);
    }

    navLinks.forEach(link => {
      link.addEventListener('click', closeMenu);
    });
  }
}

/* --------------------------------------------------------------------------
   8. Navbar Glass Effect on Scroll
   -------------------------------------------------------------------------- */
function initNavbarScroll() {
  const navbar = document.getElementById('navbar');
  window.addEventListener('scroll', () => {
    if (window.scrollY > 50) {
      navbar.style.background = 'rgba(7, 9, 14, 0.95)';
      navbar.style.boxShadow = '0 10px 30px rgba(0,0,0,0.5)';
    } else {
      navbar.style.background = 'rgba(9, 12, 18, 0.85)';
      navbar.style.boxShadow = 'none';
    }
  });
}

/* --------------------------------------------------------------------------
   9. Set Default Date in Form
   -------------------------------------------------------------------------- */
function initDefaultDate() {
  const dateInput = document.getElementById('event-date');
  if (dateInput) {
    const today = new Date();
    today.setDate(today.getDate() + 30);
    dateInput.value = today.toISOString().split('T')[0];
  }
}

/* --------------------------------------------------------------------------
   10. Form Handling -> PHP API Integration & WhatsApp Redirect
   -------------------------------------------------------------------------- */
async function handleInquirySubmit(event) {
  event.preventDefault();

  const eventType = document.getElementById('event-type').value;
  const guestCount = document.getElementById('guest-count').value;
  const eventDate = document.getElementById('event-date').value;
  const userName = document.getElementById('user-name').value;
  const notes = document.getElementById('special-requirements').value;
  const recipientEl = document.getElementById('whatsapp-recipient');
  const recipient = recipientEl ? recipientEl.value : '917567049869';

  const submitBtn = event.target.querySelector('button[type="submit"]');
  const originalBtnText = submitBtn.innerHTML;
  submitBtn.innerHTML = '<i class="fa-solid fa-circle-notch fa-spin"></i> Processing Inquiry...';
  submitBtn.disabled = true;

  try {
    const response = await fetch('api/inquiry.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({
        user_name: userName,
        event_type: eventType,
        guest_count: guestCount,
        event_date: eventDate,
        notes: notes,
        recipient: recipient
      })
    });

    const data = await response.json();

    if (data.success && data.whatsapp_url) {
      window.open(data.whatsapp_url, '_blank');
    } else {
      fallbackWhatsAppRedirect(userName, eventType, guestCount, eventDate, notes, recipient);
    }
  } catch (err) {
    console.warn('API Endpoint unreachable, using client-side WhatsApp generator:', err);
    fallbackWhatsAppRedirect(userName, eventType, guestCount, eventDate, notes, recipient);
  } finally {
    submitBtn.innerHTML = originalBtnText;
    submitBtn.disabled = false;
  }
}

function fallbackWhatsAppRedirect(userName, eventType, guestCount, eventDate, notes, recipient = '917567049869') {
  const message = `Hello Ambika Decoration & Party Plot! 🌟\nMy name is *${userName}*.\n\nI would like to inquire about event booking:\n• *Event Type:* ${eventType}\n• *Guests Count:* ${guestCount}\n• *Event Date:* ${eventDate}\n${notes ? `• *Special Note:* ${notes}\n` : ''}\nPlease share packages & menu options. Thank you!`;
  const url = `https://wa.me/${recipient}?text=${encodeURIComponent(message)}`;
  window.open(url, '_blank');
}
