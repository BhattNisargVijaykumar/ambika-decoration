<?php
require_once __DIR__ . '/config.php';

// Dynamic Gallery Loader from Admin Uploads JSON
$data_file = __DIR__ . '/data/gallery.json';
$row1_images = [];
$row2_images = [];

if (file_exists($data_file)) {
    $json = json_decode(file_get_contents($data_file), true);
    if (is_array($json)) {
        if (!empty($json['row1'])) $row1_images = $json['row1'];
        if (!empty($json['row2'])) $row2_images = $json['row2'];
    }
}

// Fallback sample images if no custom admin uploads yet
if (empty($row1_images)) {
    $row1_images = array_fill(0, 10, 'assets/images/wedding_chori_mandap.jpg');
}
if (empty($row2_images)) {
    $row2_images = array_fill(0, 10, 'assets/images/party_plot_lawn.jpg');
}

// Repeat items to ensure seamless infinite looping marquee
while (count($row1_images) < 10) {
    $row1_images = array_merge($row1_images, $row1_images);
}
while (count($row2_images) < 10) {
    $row2_images = array_merge($row2_images, $row2_images);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo SITE_NAME; ?> | Luxury Wedding Decor, Party Plot & Catering</title>
  <meta name="description" content="Premier Party Plot venue, traditional Chori & Mandap decoration, and royal pure-veg catering services for weddings, receptions, and grand events.">
  
  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;600;700;800;900&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  
  <!-- FontAwesome Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  
  <!-- Favicon & Tab Icon -->
  <link rel="icon" type="image/png" href="assets/Logo.png">
  <link rel="apple-touch-icon" href="assets/Logo.png">
  
  <!-- Custom Master Styles -->
  <link rel="stylesheet" href="styles.css">
</head>
<body>

  <!-- Royal Preloader Screen (3s Character Reveal & 0-100% Counter) -->
  <div id="preloader" class="preloader">
    <div class="preloader-bg-glow glow-top-left"></div>
    <div class="preloader-bg-glow glow-bottom-right"></div>
    
    <div class="preloader-content">
      <div class="preloader-emblem"><img src="assets/Logo.png" alt="Ambika Decoration Logo"></div>
      
      <h1 class="preloader-title" id="preloader-title">
        <span class="char char-gold" style="--i:0">A</span>
        <span class="char char-gold" style="--i:1">M</span>
        <span class="char char-gold" style="--i:2">B</span>
        <span class="char char-gold" style="--i:3">I</span>
        <span class="char char-gold" style="--i:4">K</span>
        <span class="char char-gold" style="--i:5">A</span>
        <span class="char-space">&nbsp;</span>
        <span class="char" style="--i:6">D</span>
        <span class="char" style="--i:7">E</span>
        <span class="char" style="--i:8">C</span>
        <span class="char" style="--i:9">O</span>
        <span class="char" style="--i:10">R</span>
        <span class="char" style="--i:11">A</span>
        <span class="char" style="--i:12">T</span>
        <span class="char" style="--i:13">I</span>
        <span class="char" style="--i:14">O</span>
        <span class="char" style="--i:15">N</span>
      </h1>
      
      <p class="preloader-subtitle">ROYAL CELEBRATIONS • POOJA FARM</p>
      
      <div class="preloader-progress-box">
        <div class="preloader-bar-bg">
          <div class="preloader-bar-fill" id="preloader-bar"></div>
        </div>
        <div class="preloader-counter" id="preloader-counter">000%</div>
      </div>
    </div>
  </div>

  <!-- Background Animated Canvas (Sparkles + Floating Petals) -->
  <canvas id="sparkle-canvas"></canvas>
  <div class="flower-petals-container" id="flower-petals"></div>

  <!-- Backdrop Overlay & Mobile Bottom Sheet Menu -->
  <div class="nav-backdrop" id="nav-backdrop"></div>

  <nav class="nav-menu" id="nav-menu">
    <div class="bottom-sheet-handle"></div>
    <a href="#party-plot" class="nav-link"><i class="fa-solid fa-hotel"></i> Party Plot Venue</a>
    <a href="#chori-decor" class="nav-link"><i class="fa-solid fa-om"></i> Chori & Mandap</a>
    <a href="#catering-menu" class="nav-link"><i class="fa-solid fa-utensils"></i> Catering Menu</a>
    <a href="#inquiry-section" class="nav-link"><i class="fa-solid fa-address-book"></i> Contact Us</a>
    <a href="#inquiry-section" class="nav-link btn-nav-cta"><i class="fa-brands fa-whatsapp"></i> Quick Inquiry</a>
  </nav>

  <!-- Header / Navigation -->
  <header class="navbar" id="navbar">
    <div class="container navbar-container">
      <a href="#hero" class="brand-logo">
        <div class="logo-emblem"><img src="assets/Logo.png" alt="Ambika Decoration Logo"></div>
        <div class="brand-text">
          <span class="brand-name">AMBIKA DECORATION</span>
          <span class="brand-tagline">POOJA FARM</span>
        </div>
      </a>

      <button class="mobile-toggle" id="mobile-toggle" aria-label="Toggle navigation menu">
        <i class="fa-solid fa-bars"></i>
      </button>
    </div>
  </header>

  <!-- Hero Section -->
  <section class="hero" id="hero">
    <div class="hero-overlay"></div>
    <div class="container hero-content">
      <div class="hero-badge fade-in">
        <i class="fa-solid fa-crown icon-gold"></i> <?php echo SITE_TAGLINE; ?>
      </div>
      <h1 class="hero-title fade-in delay-1">
        Crafting Unforgettable <span class="text-gradient">Royal Celebrations</span> & Weddings
      </h1>
      <p class="hero-subtitle fade-in delay-2">
        Spacious Party Plot • Authentic Traditional Chori & Mandap Setup • 100% Pure Veg Gourmet Catering • Full Party Event Management
      </p>

      <div class="hero-buttons fade-in delay-3">
        <a href="https://wa.me/<?php echo WHATSAPP_NUMBER_1; ?>?text=Hello%20Ambika%20Decoration,%20I%20would%20like%20to%20check%20available%20dates!" target="_blank" rel="noopener" class="btn btn-whatsapp glow-effect">
          <i class="fa-brands fa-whatsapp"></i> WhatsApp 1
        </a>
        <a href="https://wa.me/<?php echo WHATSAPP_NUMBER_2; ?>?text=Hello%20Ambika%20Decoration,%20I%20would%20like%20to%20check%20available%20dates!" target="_blank" rel="noopener" class="btn btn-whatsapp glow-effect">
          <i class="fa-brands fa-whatsapp"></i> WhatsApp 2
        </a>
        <a href="tel:<?php echo BUSINESS_PHONE_1_RAW; ?>" class="btn btn-call">
          <i class="fa-solid fa-phone"></i> Call Line 1
        </a>
        <a href="tel:<?php echo BUSINESS_PHONE_2_RAW; ?>" class="btn btn-call">
          <i class="fa-solid fa-phone"></i> Call Line 2
        </a>
      </div>

      <!-- Quick Metrics Strip -->
      <div class="hero-metrics fade-in delay-4">
        <?php foreach ($metrics as $index => $m): ?>
          <div class="metric-card">
            <span class="metric-number" data-target="<?php echo $m['number']; ?>">0</span><span class="metric-plus">+</span>
            <span class="metric-label"><?php echo $m['label']; ?></span>
          </div>
          <?php if ($index < count($metrics) - 1): ?>
            <div class="metric-divider"></div>
          <?php endif; ?>
        <?php endforeach; ?>
      </div>
    </div>
    
    <div class="scroll-down-indicator">
      <a href="#party-plot" aria-label="Scroll down">
        <i class="fa-solid fa-chevron-down"></i>
      </a>
    </div>
  </section>

  <!-- Section 1: Party Plot Venue (Zoom-In Opening Animation) -->
  <section class="section party-plot-section" id="party-plot">
    <div class="container">
      <div class="section-header text-center scroll-zoom-in">
        <span class="section-subtitle"><i class="fa-solid fa-gem icon-gold"></i> Our Exclusive Venue</span>
        <h2 class="section-title">Ambika Party Plot <span class="text-gradient">& Open Lawn</span></h2>
        <p class="section-description">
          A magnificent sprawling open-air green lawn bathed in warm fairytale lightings, designer entrance tunnels, and royal ambiance designed for your dream wedding & reception.
        </p>
      </div>

      <div class="party-plot-grid">
        <div class="party-plot-main-card glass-card scroll-reveal">
          <div class="image-wrapper">
            <img src="assets/images/party_plot_lawn.jpg" alt="Ambika Party Plot Night View" class="showcase-img">
            <div class="img-badge"><i class="fa-solid fa-star"></i> Night Lightings Setup</div>
          </div>
          <div class="card-content">
            <h3>Illuminated Lawn & Dining Setup</h3>
            <p>Our venue features lush carpet grass, grand chandelier overheads, sparkling fairy light tunnels, and comfortable seating layouts for over 2,500+ guests simultaneously.</p>
            <ul class="feature-checklist">
              <li><i class="fa-solid fa-check-circle icon-gold"></i> Spacious Open-Air Lawn with Natural Greenery</li>
              <li><i class="fa-solid fa-check-circle icon-gold"></i> Premium AC Bridal & Groom Changing Suites</li>
              <li><i class="fa-solid fa-check-circle icon-gold"></i> 200+ Car Parking Space with Security</li>
              <li><i class="fa-solid fa-check-circle icon-gold"></i> 100% Uninterrupted Power Backup Generator</li>
            </ul>
            <div class="action-row">
              <a href="https://wa.me/<?php echo WHATSAPP_NUMBER; ?>?text=Hi%20Ambika%20Decoration,%20I%20want%20to%20inquire%20about%20Party%20Plot%20Rental%20dates" target="_blank" class="btn btn-whatsapp-sm">
                <i class="fa-brands fa-whatsapp"></i> Inquire Plot Booking
              </a>
              <a href="tel:<?php echo BUSINESS_PHONE_RAW; ?>" class="btn btn-ghost-sm">
                <i class="fa-solid fa-phone"></i> Call Venue Manager
              </a>
            </div>
          </div>
        </div>

        <div class="party-plot-sub-card glass-card scroll-reveal delay-1">
          <div class="image-wrapper">
            <img src="assets/images/sangeet_stage_decor.jpg" alt="Royal Sangeet Stage Decor" class="showcase-img">
            <div class="img-badge"><i class="fa-solid fa-crown"></i> Stage Decor</div>
          </div>
          <div class="card-content">
            <h3>Grand Stage & Sangeet Backdrop</h3>
            <p>Custom theme stages featuring gold filigree lattice arches, plush velvet drapes, ambient spotlights, and floral arrangements.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Section 2: View Our Work - Dual Row Auto-Scrolling Marquee Gallery (NO DESCRIPTION) -->
  <section class="section chori-section dark-bg" id="chori-decor">
    <div class="container-fluid">
      <div class="section-header text-center scroll-zoom-in">
        <span class="section-subtitle"><i class="fa-solid fa-images icon-gold"></i> Visual Portfolio</span>
        <h2 class="section-title">View Our <span class="text-gradient">Decor & Event Work</span></h2>
        <p class="section-description">
          Explore our signature Mandap Chori setups, party plot illuminations, stage backdrops, and catering spreads.
        </p>
      </div>

      <!-- Infinite Dual-Row Auto-Scrolling Marquee Gallery (Dynamic Admin Uploads) -->
      <div class="marquee-wrapper">
        <!-- Row 1: Auto Scroll RIGHT -->
        <div class="marquee-row">
          <div class="marquee-track track-right">
            <?php foreach ($row1_images as $img_src): ?>
              <div class="marquee-card btn-lightbox-trigger" data-img="<?php echo htmlspecialchars($img_src); ?>" data-caption="Ambika Event Showcase Photo">
                <img src="<?php echo htmlspecialchars($img_src); ?>" alt="Event Showcase Photo">
              </div>
            <?php endforeach; ?>
          </div>
        </div>

        <!-- Row 2: Auto Scroll LEFT -->
        <div class="marquee-row">
          <div class="marquee-track track-left">
            <?php foreach ($row2_images as $img_src): ?>
              <div class="marquee-card btn-lightbox-trigger" data-img="<?php echo htmlspecialchars($img_src); ?>" data-caption="Ambika Event Showcase Photo">
                <img src="<?php echo htmlspecialchars($img_src); ?>" alt="Event Showcase Photo">
              </div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
      
      <div class="text-center margin-top-lg">
        <a href="https://wa.me/<?php echo WHATSAPP_NUMBER; ?>?text=Hi%20Ambika%20Decoration,%20I%20want%20to%20see%20more%20Chori%20Mandap%20designs" target="_blank" class="btn btn-whatsapp glow-effect">
          <i class="fa-brands fa-whatsapp"></i> Request Custom Decor Photo Catalogue on WhatsApp
        </a>
      </div>
    </div>
  </section>

  <!-- Section 3: Catering & Food Delicacies -->
  <section class="section catering-section" id="catering-menu">
    <div class="container">
      <div class="section-header text-center scroll-zoom-in">
        <span class="section-subtitle"><i class="fa-solid fa-utensils icon-gold"></i> Pure Veg Gourmet Experience</span>
        <h2 class="section-title">Royal Catering & <span class="text-gradient">Food Presentation</span></h2>
        <p class="section-description">
          We prepare 100% pure vegetarian culinary masterpieces — from authentic Gujarati thalis & traditional sweet spreads to live chaat counters, continental kitchens, and designer dessert displays.
        </p>
      </div>

      <!-- Royal Gujarati Thali Animated Feature Showcase -->
      <div class="gujarati-thali-hero scroll-reveal">
        <div class="thali-card-wrapper glass-card">
          <div class="thali-visual-container">
            <div class="thali-glow-ring"></div>
            <img src="assets/images/catering_sweets.jpg" alt="Royal Gujarati Thali & Sweets Showcase" class="thali-img">
          </div>
          <div class="thali-details">
            <span class="section-subtitle"><i class="fa-solid fa-crown icon-gold"></i> Authentic Culinary Pride</span>
            <h3>Royal Shahi Gujarati Thali</h3>
            <p>Serves authentic Gujarati delicacies including Kaju Undhiyu, Desi Ghee Jalebi, Basundi, Khandvi, Farsan, Saffron Rice, Panchmel Dal, and unlimited hot Puris in traditional silver brassware.</p>
            <div class="thali-badge-row">
              <span class="thali-pill"><i class="fa-solid fa-seedling icon-gold"></i> 100% Pure Desi Ghee</span>
              <span class="thali-pill"><i class="fa-solid fa-bowl-rice icon-gold"></i> Fresh Live Farsan</span>
              <span class="thali-pill"><i class="fa-solid fa-star icon-gold"></i> Chef Special Sweets</span>
            </div>
          </div>
        </div>
      </div>

      <div class="catering-hero-grid margin-bottom-xl">
        <div class="catering-feature-card glass-card scroll-reveal">
          <div class="image-wrapper">
            <img src="assets/images/catering_buffet.jpg" alt="Opulent Indian Catering Buffet" class="showcase-img">
            <div class="img-badge"><i class="fa-solid fa-leaf"></i> 100% Pure Veg</div>
          </div>
          <div class="card-body">
            <h3>Gourmet Buffet & Live Counters</h3>
            <p>Steaming silver chafing dishes with rich Paneer Butter Masala, Saffron Royal Biryani, Garlic Naans, and live food counters managed by master chefs.</p>
          </div>
        </div>

        <div class="catering-feature-card glass-card scroll-reveal delay-1">
          <div class="image-wrapper">
            <img src="assets/images/catering_sweets.jpg" alt="Traditional Indian Sweets Platter" class="showcase-img">
            <div class="img-badge"><i class="fa-solid fa-cookie-bite"></i> Signature Sweets</div>
          </div>
          <div class="card-body">
            <h3>Artisanal Sweets & Dessert Bar</h3>
            <p>Hot golden Jalebi with Rabdi, Silver-leaf Kaju Katli, Pistachio Barfi, Soft Gulab Jamun, Rasgulla, and Basundi served in traditional brassware.</p>
          </div>
        </div>
      </div>

      <!-- Dynamic Catering Menu Tabs with Zoom Animation -->
      <div class="menu-tab-container glass-card scroll-reveal">
        <div class="menu-tab-header">
          <?php $is_first = true; foreach ($catering_menu as $key => $cat): ?>
            <button class="menu-tab-btn <?php echo $is_first ? 'active' : ''; ?>" data-tab="<?php echo $key; ?>">
              <i class="<?php echo $cat['icon']; ?>"></i> <?php echo $cat['title']; ?>
            </button>
          <?php $is_first = false; endforeach; ?>
        </div>

        <div class="menu-tab-content">
          <?php $is_first_pane = true; foreach ($catering_menu as $key => $cat): ?>
            <div class="tab-pane <?php echo $is_first_pane ? 'active' : ''; ?>" id="tab-<?php echo $key; ?>">
              <div class="menu-grid">
                <?php foreach ($cat['items'] as $item): ?>
                  <div class="menu-item">
                    <div class="menu-item-header">
                      <span class="item-name"><?php echo htmlspecialchars($item['name']); ?></span>
                      <span class="badge-veg"><?php echo htmlspecialchars($item['tag']); ?></span>
                    </div>
                    <p class="item-desc"><?php echo htmlspecialchars($item['desc']); ?></p>
                  </div>
                <?php endforeach; ?>
              </div>
            </div>
          <?php $is_first_pane = false; endforeach; ?>
        </div>

        <div class="menu-footer-cta">
          <span>Need a customized catering menu for 200 to 5,000 guests?</span>
          <a href="https://wa.me/<?php echo WHATSAPP_NUMBER; ?>?text=Hi%20Ambika%20Catering,%20please%20send%20me%20your%20full%20Catering%20Menu%20PDF" target="_blank" class="btn btn-whatsapp-sm">
            <i class="fa-brands fa-whatsapp"></i> Get Full Menu PDF on WhatsApp
          </a>
        </div>
      </div>
    </div>
  </section>

  <!-- Section 4: Live Instagram Connect Banner (No Images) -->
  <section class="section instagram-section dark-bg" id="instagram-feed">
    <div class="container">
      <div class="section-header text-center scroll-zoom-in">
        <span class="section-subtitle"><i class="fa-brands fa-instagram icon-gold"></i> Live Social Showcase</span>
        <h2 class="section-title">Follow Our Work On <span class="text-gradient">Instagram</span></h2>
        <p class="section-description">
          Stay updated with our latest wedding decor reels, live chori setups, stage lighting videos, and catering spreads on Instagram <strong class="text-gold"><?php echo INSTAGRAM_HANDLE; ?></strong>.
        </p>
      </div>

      <div class="instagram-banner glass-card scroll-reveal">
        <div class="insta-profile-info">
          <div class="insta-avatar">
            <i class="fa-brands fa-instagram"></i>
          </div>
          <div class="insta-details">
            <h3><?php echo INSTAGRAM_HANDLE; ?></h3>
            <p><?php echo SITE_NAME; ?> • Event Planner & Caterers</p>
            <div class="insta-stats">
              <span><strong>500+</strong> Posts</span>
              <span><strong>15.2K</strong> Followers</span>
              <span><strong>100%</strong> Happy Clients</span>
            </div>
          </div>
        </div>
        <a href="<?php echo INSTAGRAM_URL; ?>" target="_blank" rel="noopener" class="btn btn-insta glow-effect">
          <i class="fa-brands fa-instagram"></i> Visit Our Instagram Page
        </a>
      </div>
    </div>
  </section>

  <!-- Section 5: Direct Quick Inquiry Form (PHP Backend API + Instant WhatsApp) -->
  <section class="section inquiry-section" id="inquiry-section">
    <div class="container">
      <div class="inquiry-box glass-card scroll-reveal">
        <div class="inquiry-grid">
          <div class="inquiry-info">
            <span class="section-subtitle"><i class="fa-solid fa-calendar-check icon-gold"></i> Fast Date Booking</span>
            <h2>Plan Your Event With <span class="text-gradient">Ambika Decoration</span></h2>
            <p>Select your event details below to calculate a quick instant estimate and send your inquiry directly to our team via WhatsApp or Phone Call.</p>
            
            <div class="direct-contact-pills">
              <!-- Contact Card Line 1 -->
              <div class="contact-line-box">
                <span class="contact-line-label"><i class="fa-solid fa-phone icon-gold"></i> Line 1: +91 75670 49869</span>
                <div class="contact-line-buttons">
                  <a href="tel:<?php echo BUSINESS_PHONE_1_RAW; ?>" class="contact-pill">
                    <i class="fa-solid fa-phone icon-gold"></i> Call
                  </a>
                  <a href="https://wa.me/<?php echo WHATSAPP_NUMBER_1; ?>?text=Hi%20Ambika%20Decoration!" target="_blank" class="contact-pill whatsapp-pill">
                    <i class="fa-brands fa-whatsapp"></i> WhatsApp
                  </a>
                </div>
              </div>

              <!-- Contact Card Line 2 -->
              <div class="contact-line-box">
                <span class="contact-line-label"><i class="fa-solid fa-phone icon-gold"></i> Line 2: +91 99248 37197</span>
                <div class="contact-line-buttons">
                  <a href="tel:<?php echo BUSINESS_PHONE_2_RAW; ?>" class="contact-pill">
                    <i class="fa-solid fa-phone icon-gold"></i> Call
                  </a>
                  <a href="https://wa.me/<?php echo WHATSAPP_NUMBER_2; ?>?text=Hi%20Ambika%20Decoration!" target="_blank" class="contact-pill whatsapp-pill">
                    <i class="fa-brands fa-whatsapp"></i> WhatsApp
                  </a>
                </div>
              </div>
            </div>

            <div class="office-hours">
              <i class="fa-solid fa-clock icon-gold"></i> <strong>Booking Office Hours:</strong> <?php echo OFFICE_HOURS; ?>
            </div>
          </div>

          <div class="inquiry-form-card">
            <h3><i class="fa-solid fa-paper-plane icon-gold"></i> Instant WhatsApp Inquiry</h3>
            <form id="whatsapp-inquiry-form" onsubmit="handleInquirySubmit(event)">
              <div class="form-group">
                <label for="whatsapp-recipient">Select WhatsApp Contact Number</label>
                <select id="whatsapp-recipient" required>
                  <option value="<?php echo WHATSAPP_NUMBER_1; ?>" selected>+91 75670 49869 (Primary Line)</option>
                  <option value="<?php echo WHATSAPP_NUMBER_2; ?>">+91 99248 37197 (Secondary Line)</option>
                </select>
              </div>

              <div class="form-group">
                <label for="event-type">Select Event Type</label>
                <select id="event-type" required>
                  <option value="Grand Wedding & Reception">Grand Wedding & Reception</option>
                  <option value="Sangeet & Mehendi Decor">Sangeet & Mehendi Decor</option>
                  <option value="Party Plot Venue Booking">Party Plot Venue Only</option>
                  <option value="Chori & Mandap Setup">Chori & Mandap Setup</option>
                  <option value="Pure Veg Catering Package">Pure Veg Catering Package</option>
                  <option value="Birthday & Ring Ceremony">Birthday / Ring Ceremony</option>
                </select>
              </div>

              <div class="form-row">
                <div class="form-group">
                  <label for="guest-count">Expected Guests</label>
                  <select id="guest-count" required>
                    <option value="200 - 500 Guests">200 - 500 Guests</option>
                    <option value="500 - 1,000 Guests" selected>500 - 1,000 Guests</option>
                    <option value="1,000 - 2,500 Guests">1,000 - 2,500 Guests</option>
                    <option value="2,500+ Grand Event">2,500+ Grand Event</option>
                  </select>
                </div>

                <div class="form-group">
                  <label for="event-date">Approx. Event Date</label>
                  <input type="date" id="event-date" required>
                </div>
              </div>

              <div class="form-group">
                <label for="user-name">Your Full Name</label>
                <input type="text" id="user-name" placeholder="Enter your name" required>
              </div>

              <div class="form-group">
                <label for="special-requirements">Requirements / Notes (Optional)</label>
                <textarea id="special-requirements" rows="2" placeholder="e.g. Need Mandap floral theme + 800 guests catering"></textarea>
              </div>

              <button type="submit" class="btn btn-whatsapp btn-block glow-effect">
                <i class="fa-brands fa-whatsapp"></i> Send Inquiry on WhatsApp Now
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="footer">
    <div class="container footer-content">
      <div class="footer-brand">
        <div class="logo-emblem"><img src="assets/Logo.png" alt="Ambika Decoration Logo"></div>
        <h3><?php echo strtoupper(SITE_NAME); ?></h3>
        <p>Your premier destination for party plot venue, royal chori/mandap decoration, gourmet veg catering, and end-to-end event management.</p>
      </div>

      <div class="footer-links">
        <h4>Direct Connect</h4>
        <div class="footer-connect-grid">
          <a href="https://wa.me/<?php echo WHATSAPP_NUMBER_1; ?>" target="_blank" rel="noopener" class="footer-grid-card wa-card">
            <i class="fa-brands fa-whatsapp icon-whatsapp"></i>
            <div>
              <small>WhatsApp 1</small>
              <strong><?php echo BUSINESS_PHONE_1; ?></strong>
            </div>
          </a>

          <a href="https://wa.me/<?php echo WHATSAPP_NUMBER_2; ?>" target="_blank" rel="noopener" class="footer-grid-card wa-card">
            <i class="fa-brands fa-whatsapp icon-whatsapp"></i>
            <div>
              <small>WhatsApp 2</small>
              <strong><?php echo BUSINESS_PHONE_2; ?></strong>
            </div>
          </a>

          <a href="tel:<?php echo BUSINESS_PHONE_1_RAW; ?>" class="footer-grid-card phone-card">
            <i class="fa-solid fa-phone icon-gold"></i>
            <div>
              <small>Call Line 1</small>
              <strong><?php echo BUSINESS_PHONE_1; ?></strong>
            </div>
          </a>

          <a href="tel:<?php echo BUSINESS_PHONE_2_RAW; ?>" class="footer-grid-card phone-card">
            <i class="fa-solid fa-phone icon-gold"></i>
            <div>
              <small>Call Line 2</small>
              <strong><?php echo BUSINESS_PHONE_2; ?></strong>
            </div>
          </a>

          <a href="<?php echo INSTAGRAM_URL_1; ?>" target="_blank" rel="noopener" class="footer-grid-card insta-card">
            <i class="fa-brands fa-instagram icon-insta"></i>
            <div>
              <small>Instagram 1</small>
              <strong><?php echo INSTAGRAM_HANDLE_1; ?></strong>
            </div>
          </a>

          <a href="<?php echo INSTAGRAM_URL_2; ?>" target="_blank" rel="noopener" class="footer-grid-card insta-card">
            <i class="fa-brands fa-instagram icon-insta"></i>
            <div>
              <small>Instagram 2</small>
              <strong><?php echo INSTAGRAM_HANDLE_2; ?></strong>
            </div>
          </a>
        </div>
      </div>
    </div>

    <div class="footer-bottom text-center">
      <div class="container">
        <p>&copy; <?php echo date('Y'); ?> Ambika Decoration. All rights reserved to Ambika Decoration - Dahegam.</p>
      </div>
    </div>
  </footer>

  <!-- Lightbox Modal -->
  <div class="lightbox-modal" id="lightbox-modal">
    <div class="lightbox-content">
      <button class="lightbox-close" id="lightbox-close">&times;</button>
      <img src="" alt="" id="lightbox-img">
      <div class="lightbox-caption" id="lightbox-caption"></div>
      <div class="lightbox-action">
        <a href="https://wa.me/<?php echo WHATSAPP_NUMBER_1; ?>?text=Hi%20Ambika%20Decoration,%20I%20am%20interested%20in%20this%20exact%20decoration%20design!" target="_blank" class="btn btn-whatsapp-sm">
          <i class="fa-brands fa-whatsapp"></i> WhatsApp Line 1
        </a>
        <a href="https://wa.me/<?php echo WHATSAPP_NUMBER_2; ?>?text=Hi%20Ambika%20Decoration,%20I%20am%20interested%20in%20this%20exact%20decoration%20design!" target="_blank" class="btn btn-whatsapp-sm">
          <i class="fa-brands fa-whatsapp"></i> WhatsApp Line 2
        </a>
      </div>
    </div>
  </div>

  <!-- Floating Sticky Action Buttons (2 Direct Call Buttons for Both Numbers) -->
  <div class="floating-actions">
    <a href="tel:<?php echo BUSINESS_PHONE_1_RAW; ?>" class="float-btn float-phone" title="Call Line 1 (+91 75670 49869)">
      <i class="fa-solid fa-phone"></i>
      <span class="float-tooltip">Call +91 75670 49869</span>
    </a>

    <a href="tel:<?php echo BUSINESS_PHONE_2_RAW; ?>" class="float-btn float-phone float-phone-alt" title="Call Line 2 (+91 99248 37197)">
      <i class="fa-solid fa-phone"></i>
      <span class="float-tooltip">Call +91 99248 37197</span>
    </a>
  </div>

  <!-- Mobile Bottom Action Navigation Bar -->
  <div class="mobile-bottom-bar">
    <a href="tel:<?php echo BUSINESS_PHONE_1_RAW; ?>" class="mobile-bar-item">
      <i class="fa-solid fa-phone"></i>
      <span>Call 1</span>
    </a>
    <a href="tel:<?php echo BUSINESS_PHONE_2_RAW; ?>" class="mobile-bar-item">
      <i class="fa-solid fa-phone"></i>
      <span>Call 2</span>
    </a>
    <a href="https://wa.me/<?php echo WHATSAPP_NUMBER_1; ?>?text=Hi%20Ambika%20Decoration!" target="_blank" class="mobile-bar-item highlight-wa">
      <i class="fa-brands fa-whatsapp"></i>
      <span>WhatsApp 1</span>
    </a>
    <a href="https://wa.me/<?php echo WHATSAPP_NUMBER_2; ?>?text=Hi%20Ambika%20Decoration!" target="_blank" class="mobile-bar-item highlight-wa">
      <i class="fa-brands fa-whatsapp"></i>
      <span>WhatsApp 2</span>
    </a>
    <a href="#inquiry-section" class="mobile-bar-item">
      <i class="fa-solid fa-calendar-check"></i>
      <span>Inquire</span>
    </a>
  </div>

  <!-- JS Frontend Script -->
  <script src="script.js"></script>
</body>
</html>
