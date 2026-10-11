<?php
require_once __DIR__ . '/config.php';

// Dynamic Gallery Loader from assets/images/row1 and assets/images/row2
$row1_dir = __DIR__ . '/assets/images/row1';
$row2_dir = __DIR__ . '/assets/images/row2';
$row1_images = [];
$row2_images = [];

if (is_dir($row1_dir)) {
    foreach (scandir($row1_dir) as $f) {
        if ($f !== '.' && $f !== '..' && preg_match('/\.(jpg|jpeg|png|webp)$/i', $f)) {
            $row1_images[] = 'assets/images/row1/' . $f;
        }
    }
}

if (is_dir($row2_dir)) {
    foreach (scandir($row2_dir) as $f) {
        if ($f !== '.' && $f !== '..' && preg_match('/\.(jpg|jpeg|png|webp)$/i', $f)) {
            $row2_images[] = 'assets/images/row2/' . $f;
        }
    }
}

// Merge with admin uploads from data/gallery.json if present
$data_file = __DIR__ . '/data/gallery.json';
if (file_exists($data_file)) {
    $json = json_decode(file_get_contents($data_file), true);
    if (is_array($json)) {
        if (!empty($json['row1']) && is_array($json['row1'])) {
            $row1_images = array_merge($row1_images, $json['row1']);
        }
        if (!empty($json['row2']) && is_array($json['row2'])) {
            $row2_images = array_merge($row2_images, $json['row2']);
        }
    }
}

// Fallbacks if folders are empty
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

  <!-- ===== PRIMARY SEO ===== -->
  <title>Ambika Decoretors Dahegam | Wedding Decoration, Event Planner & Party Plot Near Malhar Exotica</title>
  <meta name="description" content="Ambika Decoretors & Party Plot in Dahegam — Best wedding decoration, Chori Mandap setup, royal stage decor, event management, pure-veg catering & lawn venue. Serving Dahegam, Dehgam, Malhar Exotica area. Book now!">
  <meta name="keywords" content="Ambika Decoretors, Ambika Decoration, Ambica Decoration, Ambika Decorators Dahegam, decoration Dahegam, decoration Dehgam, event planner Dahegam, event management Dahegam, wedding decoration Dahegam, wedding planner Dahegam, marriage decoration Dahegam, reception decoration Dahegam, party plot Dahegam, lawn Dahegam, garden venue Dahegam, farm Dahegam, pooja farm Dahegam, Malhar Exotica, Malhar resort decoration, royal decoration, grand celebration, Chori Mandap, Mandap decoration, stage decor, royal event, pure veg catering, catering Dahegam, event venue Gujarat, party plot Gujarat, wedding venue near Malhar, decoration near Malhar Exotica, Ambika party plot, Ambika lawn, Ambika farm">
  <meta name="author" content="Ambika Decoretors, Dahegam">
  <meta name="robots" content="index, follow">
  <link rel="canonical" href="https://ambikadecoration.in/">

  <!-- ===== GEO TARGETING ===== -->
  <meta name="geo.region" content="IN-GJ">
  <meta name="geo.placename" content="Dahegam, Gujarat, India">
  <meta name="geo.position" content="23.1657;72.8243">
  <meta name="ICBM" content="23.1657, 72.8243">

  <!-- ===== OPEN GRAPH (Facebook / WhatsApp Preview) ===== -->
  <meta property="og:type" content="website">
  <meta property="og:url" content="https://ambikadecoration.in/">
  <meta property="og:title" content="Ambika Decoretors Dahegam | Wedding Decoration & Event Planner">
  <meta property="og:description" content="Best wedding decoration, Chori Mandap, royal stage decor, event management & pure-veg catering in Dahegam. Party plot & lawn venue near Malhar Exotica.">
  <meta property="og:image" content="https://ambikadecoration.in/assets/Logo.png">
  <meta property="og:image:width" content="1200">
  <meta property="og:image:height" content="630">
  <meta property="og:site_name" content="Ambika Decoretors">
  <meta property="og:locale" content="en_IN">

  <!-- ===== TWITTER CARD ===== -->
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="Ambika Decoretors Dahegam | Wedding Decoration & Event Planner">
  <meta name="twitter:description" content="Best wedding decoration, Chori Mandap, royal stage decor & event management in Dahegam near Malhar Exotica.">
  <meta name="twitter:image" content="https://ambikadecoration.in/assets/Logo.png">

  <!-- ===== JSON-LD STRUCTURED DATA ===== -->
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "LocalBusiness",
    "name": "Ambika Decoretors & Party Plot",
    "alternateName": ["Ambika Decoration", "Ambica Decoration", "Ambika Decorators Dahegam"],
    "url": "https://ambikadecoration.in/",
    "logo": "https://ambikadecoration.in/assets/Logo.png",
    "image": "https://ambikadecoration.in/assets/Logo.png",
    "description": "Premier wedding decoration, Chori Mandap setup, royal stage decor, event management, party plot lawn venue and pure-veg catering services in Dahegam, Gujarat.",
    "telephone": "+91-9876543210",
    "priceRange": "₹₹",
    "address": {
      "@type": "PostalAddress",
      "streetAddress": "Near Malhar Exotica, Dahegam",
      "addressLocality": "Dahegam",
      "addressRegion": "Gujarat",
      "postalCode": "382305",
      "addressCountry": "IN"
    },
    "geo": {
      "@type": "GeoCoordinates",
      "latitude": 23.1657,
      "longitude": 72.8243
    },
    "openingHours": "Mo-Su 09:00-21:00",
    "sameAs": [
      "https://github.com/BhattNisargVijaykumar/ambika-decoration"
    ],
    "serviceArea": {
      "@type": "GeoCircle",
      "geoMidpoint": {
        "@type": "GeoCoordinates",
        "latitude": 23.1657,
        "longitude": 72.8243
      },
      "geoRadius": "50000"
    },
    "hasOfferCatalog": {
      "@type": "OfferCatalog",
      "name": "Event & Decoration Services",
      "itemListElement": [
        { "@type": "Offer", "itemOffered": { "@type": "Service", "name": "Wedding Decoration & Mandap Setup" } },
        { "@type": "Offer", "itemOffered": { "@type": "Service", "name": "Reception Stage Decor" } },
        { "@type": "Offer", "itemOffered": { "@type": "Service", "name": "Party Plot & Lawn Venue" } },
        { "@type": "Offer", "itemOffered": { "@type": "Service", "name": "Pure Veg Catering & Live Counters" } },
        { "@type": "Offer", "itemOffered": { "@type": "Service", "name": "Sangeet & Pooja Decoration" } },
        { "@type": "Offer", "itemOffered": { "@type": "Service", "name": "Grand Royal Event Management" } }
      ]
    }
  }
  </script>

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
      <div class="preloader-emblem"><img src="assets/Logo.png" alt="Ambika Decoretors Logo"></div>
      
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
        <span class="char" style="--i:11">E</span>
        <span class="char" style="--i:12">T</span>
        <span class="char" style="--i:13">O</span>
        <span class="char" style="--i:14">R</span>
        <span class="char" style="--i:15">S</span>
      </h1>
      
      <p class="preloader-subtitle">ROYAL CELEBRATIONS</p>
      
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
    <a href="#party-plot" class="nav-link"><i class="fa-solid fa-hotel"></i> Event Venues</a>
    <a href="#chori-decor" class="nav-link"><i class="fa-solid fa-palette"></i> Our Work</a>
    <a href="#catering-menu" class="nav-link"><i class="fa-solid fa-utensils"></i> Catering Menu</a>
    <a href="#inquiry-section" class="nav-link"><i class="fa-solid fa-address-book"></i> Contact Us</a>
  </nav>

  <!-- Header / Navigation -->
  <header class="navbar" id="navbar">
    <div class="container navbar-container">
      <a href="#hero" class="brand-logo">
        <div class="logo-emblem"><img src="assets/Logo.png" alt="Ambika Decoretors Logo"></div>
        <div class="brand-text">
          <span class="brand-name">AMBIKA DECORETORS</span>
          <span class="brand-tagline">EVENT PLANNER & MANAGEMENT</span>
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
        Crafting Unforgettable <span class="text-gradient">Royal Celebrations</span> & Events
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
  <!-- Section 1: Event Venues (Main & Sider Venues) -->
  <section class="section party-plot-section" id="party-plot">
    <div class="container">
      <div class="section-header text-center scroll-zoom-in">
        <span class="section-subtitle"><i class="fa-solid fa-gem icon-gold"></i> Our Exclusive Venues</span>
        <h2 class="section-title">Explore Our <span class="text-gradient">3 Celebration Venues</span></h2>
        <p class="section-description">
          From our flagship Pooja Farm to our associate resort & party plot, we offer magnificent venues designed for your dream wedding, sangeet, and grand reception.
        </p>
      </div>

      <!-- Main Featured Venue (Pooja Farm) -->
      <div class="venues-main-featured">
        <div class="party-plot-main-card glass-card scroll-reveal" style="border: 2px solid var(--border-gold-bright);">
          <div class="image-wrapper" style="height: 380px;">
            <img src="assets/images/party_plot_lawn.jpg" alt="Pooja Farm Venue" class="showcase-img">
            <div class="img-badge"><i class="fa-solid fa-crown icon-gold"></i> Flagship Open Lawn</div>
          </div>
          <div class="card-content">
            <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 10px; margin-bottom: 12px;">
              <h3 style="margin-bottom: 0;">Pooja Farm</h3>
              <span class="img-badge" style="position: static;"><i class="fa-solid fa-users icon-gold"></i> 4,500+ Guest Capacity</span>
            </div>
            <p>A sprawling open-air green lawn bathed in warm fairytale lightings, grand chandelier overheads, designer entrance tunnels, and royal ambiance for grand celebrations.</p>
            <ul class="feature-checklist">
              <li><i class="fa-solid fa-check-circle icon-gold"></i> Spacious Open Lawn with Natural Greenery</li>
              <li><i class="fa-solid fa-check-circle icon-gold"></i> Premium Air-Conditioned Bridal & Groom Suites</li>
              <li><i class="fa-solid fa-check-circle icon-gold"></i> 300+ Car Parking Area with Dedicated Security</li>
              <li><i class="fa-solid fa-check-circle icon-gold"></i> 100% Uninterrupted Power Backup Generator</li>
            </ul>
            <div class="action-row">
              <a href="https://wa.me/<?php echo WHATSAPP_NUMBER_1; ?>?text=Hi%20Ambika%20Decoretors,%20I%20want%20to%20inquire%20about%20Pooja%20Farm%20Venue%20booking" target="_blank" rel="noopener" class="btn btn-whatsapp-sm">
                <i class="fa-brands fa-whatsapp"></i> Inquire Pooja Farm
              </a>
              <a href="https://www.google.com/maps/place/Pooja+Farm+and+Party+Plot/@23.1546425,72.7954944,48m/data=!3m1!1e3!4m14!1m7!3m6!1s0x395e7f0023496d85:0x23764e73e51d3d71!2sPooja+Farm,+Dahegam!8m2!3d23.1569018!4d72.7945838!16s%2Fg%2F11vx3byycg!3m5!1s0x395e7fea80e06cbf:0xfa676d91a330a0a!8m2!3d23.1545661!4d72.7955986!16s%2Fg%2F11jst34wxq?entry=ttu&g_ep=EgoyMDI2MTAwNy4wIKXMDSoASAFQAw%3D%3D" target="_blank" rel="noopener" class="btn btn-ghost-sm">
                <i class="fa-solid fa-location-dot icon-gold"></i> Get Directions
              </a>
            </div>
          </div>
        </div>
      </div>

      <!-- Associate Venues Grid (Malhar Exotica & Mangalyam Party Plot) -->
      <div class="venues-sider-grid">
        <!-- Venue 2: Malhar Exotica & Resort -->
        <div class="party-plot-sub-card glass-card scroll-reveal delay-1">
          <div class="image-wrapper" style="height: 260px;">
            <img src="assets/images/sangeet_stage_decor.jpg" alt="Malhar Exotica & Resort" class="showcase-img">
            <div class="img-badge"><i class="fa-solid fa-hotel icon-gold"></i> Resort & Lawn</div>
          </div>
          <div class="card-content">
            <h3>Malhar Exotica & Resort</h3>
            <p>Exotic resort ambiance featuring luxurious stay rooms, poolside lawn, elegant sangeet stage setup, and outdoor party space.</p>
            <ul class="feature-checklist">
              <li><i class="fa-solid fa-check-circle icon-gold"></i> Resort Stay Rooms & Poolside Party Lawn</li>
              <li><i class="fa-solid fa-check-circle icon-gold"></i> Ideal for Sangeet, Mehendi & Receptions</li>
            </ul>
            <div class="action-row">
              <a href="https://wa.me/<?php echo WHATSAPP_NUMBER_1; ?>?text=Hi%20Ambika%20Decoretors,%20I%20want%20to%20inquire%20about%20Malhar%20Exotica%20Resort" target="_blank" rel="noopener" class="btn btn-whatsapp-sm">
                <i class="fa-brands fa-whatsapp"></i> Inquire Malhar Exotica
              </a>
              <a href="https://www.google.com/maps/place/Malhaar+Resort/@23.1256917,72.826033,321m/data=!3m1!1e3!4m9!3m8!1s0x395e7917fe900127:0x823eb7d667f3ff2a!5m2!4m1!1i2!8m2!3d23.125609!4d72.828147!16s%2Fg%2F11zyrngbch?entry=ttu&g_ep=EgoyMDI2MTAwNy4wIKXMDSoASAFQAw%3D%3D" target="_blank" rel="noopener" class="btn btn-ghost-sm">
                <i class="fa-solid fa-location-dot icon-gold"></i> Get Directions
              </a>
            </div>
          </div>
        </div>

        <!-- Venue 3: Mangalyam Party Plot -->
        <div class="party-plot-sub-card glass-card scroll-reveal delay-2">
          <div class="image-wrapper" style="height: 260px;">
            <img src="assets/images/wedding_chori_mandap.jpg" alt="Mangalyam Party Plot" class="showcase-img">
            <div class="img-badge"><i class="fa-solid fa-archway icon-gold"></i> Party Plot</div>
          </div>
          <div class="card-content">
            <h3>Mangalyam Party Plot</h3>
            <p>Spacious party lawn with grand entrance arches, authentic Mandap/Chori setup space, and dedicated buffet dining layout.</p>
            <ul class="feature-checklist">
              <li><i class="fa-solid fa-check-circle icon-gold"></i> Traditional Mandap & Chori Setup Area</li>
              <li><i class="fa-solid fa-check-circle icon-gold"></i> Large Live Counter & Catering Dining Space</li>
            </ul>
            <div class="action-row">
              <a href="https://wa.me/<?php echo WHATSAPP_NUMBER_1; ?>?text=Hi%20Ambika%20Decoretors,%20I%20want%20to%20inquire%20about%20Mangalyam%20Party%20Plot" target="_blank" rel="noopener" class="btn btn-whatsapp-sm">
                <i class="fa-brands fa-whatsapp"></i> Inquire Mangalyam Plot
              </a>
              <a href="https://www.google.com/maps/place/Mangalyam+party+plot/@23.2845537,72.7600445,160m/data=!3m1!1e3!4m14!1m7!3m6!1s0x395dd39c4623a537:0xe6a37ddc88009e4a!2sGiyod+Ambaji+Mata+Temple!8m2!3d23.2838496!4d72.7607659!16s%2Fg%2F11bwqfsxm3!3m5!1s0x395dd30057b358f9:0xe5786a84d195491d!8m2!3d23.284603!4d72.7612381!16s%2Fg%2F11vz3r6s92?entry=ttu&g_ep=EgoyMDI2MTAwNy4wIKXMDSoASAFQAw%3D%3D" target="_blank" rel="noopener" class="btn btn-ghost-sm">
                <i class="fa-solid fa-location-dot icon-gold"></i> Get Directions
              </a>
            </div>
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
          Explore our signature event setups, party plot illuminations, stage backdrops, and grand entry gates.
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
        <a href="gallery.php" class="btn btn-gold glow-effect" style="font-size: 1.05rem; padding: 14px 32px;">
          <i class="fa-solid fa-folder-open"></i> Open Full Work Catalog & Gallery
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
            <p>Ambika Decoretors • Event Planner & Caterers</p>
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
            <h2>Plan Your Event With <span class="text-gradient">Ambika Decoretors</span></h2>
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
                <label for="venue-select">Select Preferred Venue</label>
                <select id="venue-select" required>
                  <option value="Pooja Farm" selected>Pooja Farm</option>
                  <option value="Malhar Exotica & Resort">Malhar Exotica & Resort</option>
                  <option value="Mangalyam Party Plot">Mangalyam Party Plot</option>
                  <option value="Decor & Catering Only (Other Location)">Decor & Catering Only (Other Location)</option>
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
        <div class="logo-emblem"><img src="assets/Logo.png" alt="Ambika Decoretors Logo"></div>
        <h3><?php echo strtoupper(SITE_NAME); ?></h3>
        <p>Your premier destination for party plot venue, royal decoration, gourmet veg catering, and end-to-end event management.</p>
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
              <small>Business Instagram</small>
              <strong><?php echo INSTAGRAM_HANDLE_1; ?></strong>
            </div>
          </a>

          <a href="<?php echo INSTAGRAM_URL_2; ?>" target="_blank" rel="noopener" class="footer-grid-card insta-card">
            <i class="fa-brands fa-instagram icon-insta"></i>
            <div>
              <small>Personal Instagram</small>
              <strong><?php echo INSTAGRAM_HANDLE_2; ?></strong>
            </div>
          </a>
        </div>
      </div>
    </div>

    <div class="footer-bottom text-center">
      <div class="container">
        <p>&copy; <?php echo date('Y'); ?> Ambika Decoretors. All rights reserved to Ambika Decoretors - Dahegam.</p>
      </div>
    </div>
  </footer>

  <!-- Lightbox Modal -->
  <div class="lightbox-modal" id="lightbox-modal">
    <div class="lightbox-content">
      <button class="lightbox-close" id="lightbox-close">&times;</button>
      <img src="" alt="" id="lightbox-img">
      <div class="lightbox-caption" id="lightbox-caption"></div>
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

  <!-- JS Frontend Script -->
  <script src="script.js"></script>
</body>
</html>
