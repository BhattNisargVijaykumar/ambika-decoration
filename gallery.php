<?php
require_once __DIR__ . '/config.php';

// Helper function to scan directory for files with given extensions
function scanMediaDir($dirPath, $relPrefix, $extensions) {
    $files = [];
    if (is_dir($dirPath)) {
        foreach (scandir($dirPath) as $f) {
            if ($f !== '.' && $f !== '..') {
                $ext = strtolower(pathinfo($f, PATHINFO_EXTENSION));
                if (in_array($ext, $extensions)) {
                    $files[] = [
                        'src' => $relPrefix . '/' . $f,
                        'name' => pathinfo($f, PATHINFO_FILENAME)
                    ];
                }
            }
        }
    }
    return $files;
}

// Only load images from row1 and row2 (no catalog, no root)
$row1_photos = scanMediaDir(__DIR__ . '/assets/images/row1', 'assets/images/row1', ['jpg', 'jpeg', 'png', 'webp']);
$row2_photos = scanMediaDir(__DIR__ . '/assets/images/row2', 'assets/images/row2', ['jpg', 'jpeg', 'png', 'webp']);

// Merge row1 + row2 only
$photo_files = array_merge($row1_photos, $row2_photos);

// Scan assets/videos folder for real video files only (no static fallback)
$video_files_scanned = scanMediaDir(__DIR__ . '/assets/videos', 'assets/videos', ['mp4', 'webm', 'mov', 'm4v']);

$video_files = [];
foreach ($video_files_scanned as $v) {
    $video_files[] = [
        'title' => ucwords(str_replace(['_', '-'], ' ', $v['name'])),
        'src'   => $v['src'],
        'desc'  => 'Ambika Decoretors - Live Event Video'
    ];
}
// No static fallback - JS will show empty state if no videos found
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gallery & Videos | Ambika Decoretors Dahegam | Wedding & Event Decoration Catalog</title>
  <meta name="description" content="Explore full photo & video catalog of Ambika Decoretors & Party Plot in Dahegam. Wedding mandap, stage decoration, party plot, lawn celebrations near Malhar Exotica.">
  <meta name="keywords" content="Ambika Decoretors gallery, Ambika decoration photos, wedding decoration videos Dahegam, event videos Dahegam, party plot photos Dahegam, Mandap decoration gallery, Malhar Exotica wedding decoration, royal celebration gallery, Dahegam decorators catalog">
  <meta name="robots" content="index, follow">
  <link rel="canonical" href="https://ambikadecoration.in/gallery.php">

  <!-- Geo Targeting -->
  <meta name="geo.region" content="IN-GJ">
  <meta name="geo.placename" content="Dahegam, Gujarat, India">
  <meta name="geo.position" content="23.1657;72.8243">
  <meta name="ICBM" content="23.1657, 72.8243">

  <!-- Open Graph -->
  <meta property="og:type" content="website">
  <meta property="og:url" content="https://ambikadecoration.in/gallery.php">
  <meta property="og:title" content="Gallery & Videos | Ambika Decoretors Dahegam">
  <meta property="og:description" content="Browse our wedding decor, grand stage setups, party plot celebrations and event videos in Dahegam.">
  <meta property="og:image" content="https://ambikadecoration.in/assets/Logo.png">
  <meta property="og:site_name" content="Ambika Decoretors">

  <!-- Twitter Card -->
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="Gallery & Videos | Ambika Decoretors Dahegam">
  <meta name="twitter:description" content="Browse wedding decor, stage setups and event videos in Dahegam.">
  <meta name="twitter:image" content="https://ambikadecoration.in/assets/Logo.png">
  
  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;600;700;800;900&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  
  <!-- FontAwesome Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  
  <!-- Favicon -->
  <link rel="icon" type="image/png" href="assets/Logo.png">
  
  <!-- Master Styles -->
  <link rel="stylesheet" href="styles.css">
  <style>
    .gallery-page-header {
      padding: 110px 0 25px 0;
      text-align: center;
      background: radial-gradient(circle at center, rgba(212, 175, 55, 0.12) 0%, rgba(9, 12, 18, 0.96) 70%);
      border-bottom: 1px solid var(--border-gold);
    }
    .gallery-filter-tabs {
      display: flex;
      justify-content: center;
      gap: 15px;
      margin: 25px 0 10px 0;
      flex-wrap: wrap;
    }
    .gallery-tab-btn {
      background: rgba(19, 25, 36, 0.85);
      border: 1px solid var(--border-gold);
      color: var(--text-main);
      padding: 12px 28px;
      border-radius: var(--radius-pill);
      font-size: 1rem;
      font-weight: 600;
      cursor: pointer;
      transition: var(--transition-normal);
      display: inline-flex;
      align-items: center;
      gap: 10px;
    }
    .gallery-tab-btn i {
      color: var(--gold-primary);
    }
    .gallery-tab-btn.active, .gallery-tab-btn:hover {
      background: var(--gold-gradient);
      color: #0b0e14;
      border-color: var(--gold-primary);
      box-shadow: 0 0 22px rgba(212, 175, 55, 0.45);
    }
    .gallery-tab-btn.active i, .gallery-tab-btn:hover i {
      color: #0b0e14;
    }

    /* Dynamic Masonry Auto-Fit Grid */
    .gallery-masonry-grid {
      column-count: 4;
      column-gap: 20px;
      padding: 30px 0;
    }

    @media (max-width: 1100px) {
      .gallery-masonry-grid {
        column-count: 3;
        column-gap: 16px;
      }
    }

    @media (max-width: 768px) {
      .gallery-page-header {
        padding: 65px 10px 15px 10px;
      }
      .gallery-page-header .section-subtitle {
        font-size: 0.75rem;
        padding: 4px 10px;
        margin-bottom: 6px;
      }
      .gallery-page-header .section-title {
        font-size: 1.25rem;
        line-height: 1.25;
        margin-bottom: 6px;
      }
      .gallery-page-header .section-description {
        font-size: 0.78rem;
        line-height: 1.35;
        margin: 0 auto;
        max-width: 96%;
      }
      .gallery-filter-tabs {
        flex-wrap: nowrap;
        gap: 6px;
        margin: 12px 0 5px 0;
      }
      .gallery-tab-btn {
        flex: 1;
        padding: 8px 6px;
        font-size: 0.76rem;
        gap: 5px;
        justify-content: center;
        white-space: nowrap;
      }
      .gallery-tab-btn i {
        font-size: 0.85rem;
      }
      .gallery-masonry-grid {
        column-count: 2;
        column-gap: 10px;
        padding: 15px 0;
      }
      .gallery-media-card {
        margin-bottom: 10px;
        border-radius: 8px;
      }
      .gallery-card-overlay {
        padding: 8px;
      }
      .gallery-card-title {
        font-size: 0.78rem;
        margin-bottom: 2px;
      }
      .gallery-card-sub {
        font-size: 0.68rem;
      }
      .video-play-badge {
        width: 36px;
        height: 36px;
        font-size: 0.95rem;
      }
    }

    @media (max-width: 480px) {
      .gallery-page-header {
        padding: 60px 8px 12px 8px;
      }
      .gallery-page-header .section-title {
        font-size: 1.15rem;
      }
      .gallery-tab-btn {
        padding: 7px 4px;
        font-size: 0.72rem;
        gap: 4px;
      }
      .gallery-masonry-grid {
        column-count: 2;
        column-gap: 8px;
        padding: 10px 0;
      }
      .gallery-media-card {
        margin-bottom: 8px;
        border-radius: 6px;
      }
    }

    .gallery-media-card {
      break-inside: avoid;
      margin-bottom: 25px;
      position: relative;
      border-radius: var(--radius-md);
      overflow: hidden;
      border: 1px solid var(--border-gold);
      background: var(--bg-card);
      transition: transform 0.4s ease, box-shadow 0.4s ease;
      cursor: pointer;
      display: inline-block;
      width: 100%;
    }
    .gallery-media-card:hover {
      transform: translateY(-6px);
      box-shadow: 0 15px 35px rgba(212, 175, 55, 0.3);
      border-color: var(--gold-primary);
    }
    .gallery-media-card img {
      width: 100%;
      height: auto;
      display: block;
      transition: transform 0.6s ease;
    }
    .gallery-media-card:hover img {
      transform: scale(1.05);
    }
    .gallery-card-overlay {
      position: absolute;
      inset: 0;
      background: linear-gradient(0deg, rgba(9, 12, 18, 0.92) 0%, rgba(9, 12, 18, 0.25) 60%, transparent 100%);
      opacity: 0;
      transition: opacity 0.35s ease;
      display: flex;
      flex-direction: column;
      justify-content: flex-end;
      padding: 20px;
    }
    .gallery-media-card:hover .gallery-card-overlay {
      opacity: 1;
    }
    .gallery-card-title {
      font-size: 1.05rem;
      font-weight: 700;
      color: #fff;
      margin-bottom: 4px;
    }
    .gallery-card-sub {
      font-size: 0.82rem;
      color: var(--gold-light);
    }
    .video-play-badge {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      width: 60px;
      height: 60px;
      border-radius: 50%;
      background: var(--gold-gradient);
      color: #0b0e14;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.5rem;
      box-shadow: 0 0 25px rgba(212, 175, 55, 0.8);
      transition: transform 0.3s ease;
    }
    .gallery-media-card:hover .video-play-badge {
      transform: translate(-50%, -50%) scale(1.15);
    }

    .load-more-box {
      text-align: center;
      margin: 20px 0 60px 0;
    }
  </style>
</head>
<body>

  <!-- Background Canvas -->
  <canvas id="sparkle-canvas"></canvas>
  <div class="flower-petals-container" id="flower-petals"></div>

  <!-- Header / Navbar -->
  <header class="navbar" id="navbar" style="position: fixed; top: 0; width: 100%; z-index: 100;">
    <div class="container navbar-container">
      <a href="index.html" class="brand-logo">
        <div class="logo-emblem"><img src="assets/Logo.png" alt="Ambika Decoretors Logo"></div>
        <div class="brand-text">
          <span class="brand-name">AMBIKA DECORETORS</span>
          <span class="brand-tagline">EVENT PLANNER & MANAGEMENT</span>
        </div>
      </a>

      <div>
        <a href="index.html" class="btn btn-ghost-sm" style="border: 1px solid var(--border-gold); padding: 6px 14px; font-size: 0.82rem; border-radius: 20px; color: var(--gold-light);">
          <i class="fa-solid fa-house"></i> Main Website
        </a>
      </div>
    </div>
  </header>

  <!-- Gallery Header Banner -->
  <section class="gallery-page-header">
    <div class="container">
      <!-- Top Back to Main Website Button -->
      <div class="gallery-top-back-bar" style="margin-bottom: 12px; text-align: center;">
        <a href="index.html" class="btn-back-home" style="display: inline-flex; align-items: center; gap: 8px; padding: 6px 18px; background: rgba(212, 175, 55, 0.15); border: 1px solid var(--border-gold); color: var(--gold-light); border-radius: 30px; font-size: 0.8rem; font-weight: 600; text-decoration: none; transition: all 0.3s ease; box-shadow: 0 4px 15px rgba(0,0,0,0.4);">
          <i class="fa-solid fa-arrow-left"></i> Go To Main Website
        </a>
      </div>

      <span class="section-subtitle"><i class="fa-solid fa-folder-open icon-gold"></i> Official Work Catalog</span>
      <h1 class="section-title">Explore Our <span class="text-gradient">Complete Catalog</span></h1>
      
      <p class="section-description" style="max-width: 750px; margin: 0 auto;">
        Browse our full catalog of images and video reels done by us.
      </p>

      <!-- Top 2 Filter Tabs -->
      <div class="gallery-filter-tabs">
        <button class="gallery-tab-btn active" id="tab-btn-photos" onclick="switchTab('photos')">
          <i class="fa-solid fa-images"></i> Images Catalog
        </button>
        <button class="gallery-tab-btn" id="tab-btn-videos" onclick="switchTab('videos')">
          <i class="fa-solid fa-film"></i> Videos Catalog
        </button>
      </div>
    </div>
  </section>

  <!-- Main Media Grid Section -->
  <section class="section">
    <div class="container">
      <!-- Photos Grid -->
      <div id="photos-section">
        <div class="gallery-masonry-grid" id="photos-grid">
          <!-- Dynamically Rendered Photos via JS Lazy Load -->
        </div>

        <div class="load-more-box" id="photos-load-more-container">
          <button class="btn btn-gold glow-effect" id="btn-load-more-photos" onclick="loadMorePhotos()">
            <i class="fa-solid fa-plus-circle"></i> Load More Catalog Images
          </button>
        </div>
      </div>

      <!-- Videos Grid -->
      <div id="videos-section" style="display: none;">
        <div class="gallery-masonry-grid" id="videos-grid">
          <!-- Dynamically Rendered Videos -->
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="footer">
    <div class="container footer-bottom text-center">
      <p>&copy; <?php echo date('Y'); ?> Ambika Decoretors. All rights reserved to Ambika Decoretors - Dahegam.</p>
    </div>
  </footer>

  <!-- Image Lightbox Modal -->
  <div class="lightbox-modal" id="lightbox-modal">
    <div class="lightbox-content">
      <button class="lightbox-close" id="lightbox-close">&times;</button>
      <img src="" alt="" id="lightbox-img">
      <div class="lightbox-caption" id="lightbox-caption"></div>
    </div>
  </div>

  <!-- Video Player Modal -->
  <div id="video-modal" style="display:none; position:fixed; inset:0; z-index:9999; background:rgba(0,0,0,0.97); align-items:center; justify-content:center; flex-direction:column;">
    <!-- Close -->
    <button onclick="closeVideoModal()" style="position:absolute; top:18px; right:24px; background:rgba(255,255,255,0.08); border:1px solid rgba(255,255,255,0.15); color:#fff; font-size:1.6rem; cursor:pointer; z-index:10000; line-height:1; width:42px; height:42px; border-radius:50%; display:flex; align-items:center; justify-content:center;">&times;</button>

    <!-- Counter badge -->
    <div id="video-modal-counter" style="position:absolute; top:22px; left:24px; color:var(--gold-light); font-size:0.82rem; font-weight:600; background:rgba(0,0,0,0.5); padding:4px 12px; border-radius:20px; border:1px solid var(--border-gold);"></div>

    <div style="width:100%; max-width:1100px; padding:0 16px; position:relative; display:flex; align-items:center; gap:12px;">

      <!-- Prev Button -->
      <button onclick="navigateVideo(-1)" id="btn-prev-video" style="flex-shrink:0; width:48px; height:48px; border-radius:50%; background:rgba(212,175,55,0.15); border:1.5px solid var(--border-gold); color:var(--gold-primary); font-size:1.3rem; cursor:pointer; display:flex; align-items:center; justify-content:center; transition:all 0.2s;" onmouseover="this.style.background='rgba(212,175,55,0.35)'" onmouseout="this.style.background='rgba(212,175,55,0.15)'">
        <i class="fa-solid fa-chevron-left"></i>
      </button>

      <div style="flex:1;">
        <div id="video-modal-title" style="color:var(--gold-primary); font-family:'Cinzel',serif; font-size:1rem; font-weight:700; margin-bottom:10px; text-align:center; letter-spacing:1px;"></div>
        <video id="video-modal-player"
          controls
          autoplay
          playsinline
          style="width:100%; max-height:78vh; border-radius:14px; border:1.5px solid var(--border-gold); background:#000; display:block; box-shadow:0 0 60px rgba(212,175,55,0.25);">
          Your browser does not support the video tag.
        </video>
        <div id="video-modal-desc" style="color:var(--gold-light); font-size:0.85rem; text-align:center; margin-top:10px;"></div>
      </div>

      <!-- Next Button -->
      <button onclick="navigateVideo(1)" id="btn-next-video" style="flex-shrink:0; width:48px; height:48px; border-radius:50%; background:rgba(212,175,55,0.15); border:1.5px solid var(--border-gold); color:var(--gold-primary); font-size:1.3rem; cursor:pointer; display:flex; align-items:center; justify-content:center; transition:all 0.2s;" onmouseover="this.style.background='rgba(212,175,55,0.35)'" onmouseout="this.style.background='rgba(212,175,55,0.15)'">
        <i class="fa-solid fa-chevron-right"></i>
      </button>
    </div>
  </div>

  <script>
    // All photo items loaded from assets/images/row1 and assets/images/row2
    const allPhotos = <?php echo json_encode($photo_files); ?>;
    const allVideos = <?php echo json_encode($video_files); ?>;

    let photoBatchIndex = 0;
    const batchSize = 12;

    document.addEventListener('DOMContentLoaded', () => {
      loadMorePhotos();
      renderVideos();
      initLightbox();
    });

    function switchTab(type) {
      const tabPhotos = document.getElementById('tab-btn-photos');
      const tabVideos = document.getElementById('tab-btn-videos');
      const photosSec = document.getElementById('photos-section');
      const videosSec = document.getElementById('videos-section');

      if (type === 'photos') {
        tabPhotos.classList.add('active');
        tabVideos.classList.remove('active');
        photosSec.style.display = 'block';
        videosSec.style.display = 'none';
      } else {
        tabVideos.classList.add('active');
        tabPhotos.classList.remove('active');
        videosSec.style.display = 'block';
        photosSec.style.display = 'none';
      }
    }

    function loadMorePhotos() {
      const grid = document.getElementById('photos-grid');
      const nextBatch = allPhotos.slice(photoBatchIndex, photoBatchIndex + batchSize);

      nextBatch.forEach((item) => {
        const card = document.createElement('div');
        card.className = 'gallery-media-card glass-card btn-lightbox-trigger';
        card.setAttribute('data-img', item.src);
        card.setAttribute('data-caption', 'Ambika Decoretors Catalog Image');

        card.innerHTML = `
          <img src="${item.src}" alt="Catalog Photo" loading="lazy">
          <div class="gallery-card-overlay">
            <div class="gallery-card-title">Ambika Catalog Photo</div>
            <div class="gallery-card-sub"><i class="fa-solid fa-magnifying-glass-plus icon-gold"></i> Click to View</div>
          </div>
        `;
        grid.appendChild(card);
      });

      photoBatchIndex += batchSize;

      const loadBtn = document.getElementById('photos-load-more-container');
      if (photoBatchIndex >= allPhotos.length) {
        loadBtn.style.display = 'none';
      } else {
        loadBtn.style.display = 'block';
      }

      // Re-attach lightbox listeners
      initLightbox();
    }

    function renderVideos() {
      const grid = document.getElementById('videos-grid');
      grid.innerHTML = '';

      if (!allVideos || allVideos.length === 0) {
        grid.innerHTML = `
          <div style="grid-column:1/-1; text-align:center; padding:60px 20px; color:var(--gold-light);">
            <i class="fa-solid fa-video-slash" style="font-size:3rem; color:var(--gold-primary); margin-bottom:18px; display:block;"></i>
            <div style="font-size:1.2rem; font-weight:700; color:#fff; margin-bottom:8px;">No Videos Yet</div>
            <div style="font-size:0.9rem;">Add video files to <code style="color:var(--gold-primary);">assets/videos/</code> folder to display them here.</div>
          </div>
        `;
        return;
      }

      allVideos.forEach((v, idx) => {
        const card = document.createElement('div');
        card.className = 'gallery-media-card glass-card';
        card.style.cursor = 'pointer';
        card.onclick = () => openVideoModal(v, idx);

        // Use a canvas thumbnail showing the real first frame of the video
        const thumbId = 'vthumb-' + idx;
        card.innerHTML = `
          <div style="width:100%; position:relative; background:#0b0e14; overflow:hidden;">
            <canvas id="${thumbId}" style="width:100%; display:block; aspect-ratio:16/9; object-fit:cover;"></canvas>
            <div class="video-play-badge"><i class="fa-solid fa-play"></i></div>
          </div>
          <div class="gallery-card-overlay" style="opacity:1; background:linear-gradient(0deg,rgba(9,12,18,0.92) 0%,rgba(9,12,18,0.1) 100%);">
            <div class="gallery-card-title"><i class="fa-solid fa-video icon-gold"></i> ${v.title}</div>
            <div class="gallery-card-sub"><i class="fa-solid fa-circle-play" style="margin-right:4px;"></i>Tap to play</div>
          </div>
        `;
        grid.appendChild(card);

        // Capture first frame of video into canvas as thumbnail
        const tmpVideo = document.createElement('video');
        tmpVideo.src = v.src;
        tmpVideo.muted = true;
        tmpVideo.playsInline = true;
        tmpVideo.preload = 'metadata';
        tmpVideo.crossOrigin = 'anonymous';
        tmpVideo.addEventListener('loadeddata', function() {
          tmpVideo.currentTime = 0.5;
        });
        tmpVideo.addEventListener('seeked', function() {
          const canvas = document.getElementById(thumbId);
          if (canvas) {
            canvas.width  = tmpVideo.videoWidth  || 640;
            canvas.height = tmpVideo.videoHeight || 360;
            const ctx = canvas.getContext('2d');
            ctx.drawImage(tmpVideo, 0, 0, canvas.width, canvas.height);
          }
          tmpVideo.src = '';
        });
        tmpVideo.load();
      });
    }

    let currentVideoIndex = 0;

    function openVideoModal(v, index) {
      currentVideoIndex = (index !== undefined) ? index : allVideos.findIndex(x => x.src === v.src);
      const modal   = document.getElementById('video-modal');
      const player  = document.getElementById('video-modal-player');
      const title   = document.getElementById('video-modal-title');
      const desc    = document.getElementById('video-modal-desc');
      const counter = document.getElementById('video-modal-counter');

      // Stop previous, reset fully before loading new
      player.pause();
      player.removeAttribute('src');
      player.load();

      player.src = v.src;
      player.currentTime = 0;
      title.textContent   = v.title;
      desc.textContent    = v.desc;
      counter.textContent = (currentVideoIndex + 1) + ' / ' + allVideos.length;

      // Show/hide prev-next based on position
      document.getElementById('btn-prev-video').style.opacity = currentVideoIndex === 0 ? '0.3' : '1';
      document.getElementById('btn-next-video').style.opacity = currentVideoIndex === allVideos.length - 1 ? '0.3' : '1';

      modal.style.display = 'flex';
      document.body.style.overflow = 'hidden';
      player.load();
      player.play().catch(() => {});
    }

    function navigateVideo(dir) {
      const newIndex = currentVideoIndex + dir;
      if (newIndex < 0 || newIndex >= allVideos.length) return;
      openVideoModal(allVideos[newIndex], newIndex);
    }

    function closeVideoModal() {
      const modal  = document.getElementById('video-modal');
      const player = document.getElementById('video-modal-player');
      player.pause();
      player.removeAttribute('src');
      player.load();
      modal.style.display = 'none';
      document.body.style.overflow = '';
    }

    // Close video modal on backdrop click
    document.getElementById('video-modal').addEventListener('click', function(e) {
      if (e.target === this) closeVideoModal();
    });

    // Keyboard: Escape = close, Left/Right = prev/next
    document.addEventListener('keydown', function(e) {
      const modal = document.getElementById('video-modal');
      if (modal.style.display === 'none') return;
      if (e.key === 'Escape')      closeVideoModal();
      if (e.key === 'ArrowRight')  navigateVideo(1);
      if (e.key === 'ArrowLeft')   navigateVideo(-1);
    });

    function initLightbox() {
      const modal = document.getElementById('lightbox-modal');
      const modalImg = document.getElementById('lightbox-img');
      const modalCaption = document.getElementById('lightbox-caption');
      const closeBtn = document.getElementById('lightbox-close');

      document.querySelectorAll('.btn-lightbox-trigger').forEach(trigger => {
        trigger.onclick = () => {
          const imgSrc = trigger.getAttribute('data-img');
          const caption = trigger.getAttribute('data-caption') || '';
          modalImg.src = imgSrc;
          modalCaption.textContent = caption;
          modal.classList.add('active');
        };
      });

      if (closeBtn) {
        closeBtn.onclick = () => modal.classList.remove('active');
      }
      if (modal) {
        modal.onclick = (e) => {
          if (e.target === modal) modal.classList.remove('active');
        };
      }
    }
  </script>
</body>
</html>
