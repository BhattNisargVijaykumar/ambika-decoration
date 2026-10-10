<?php
require_once __DIR__ . '/auth.php';
check_admin_auth();

// Helper to scan directory for media files
function scanAdminDir($dirPath, $relPrefix) {
    $files = [];
    if (is_dir($dirPath)) {
        foreach (scandir($dirPath) as $f) {
            if ($f !== '.' && $f !== '..') {
                $ext = strtolower(pathinfo($f, PATHINFO_EXTENSION));
                if (in_array($ext, ['jpg', 'jpeg', 'png', 'webp', 'mp4', 'webm', 'mov', 'm4v'])) {
                    $files[] = [
                        'name' => $f,
                        'rel' => $relPrefix . '/' . $f,
                        'is_video' => in_array($ext, ['mp4', 'webm', 'mov', 'm4v'])
                    ];
                }
            }
        }
    }
    return $files;
}

$row1_files = scanAdminDir(__DIR__ . '/../assets/images/row1', 'assets/images/row1');
$row2_files = scanAdminDir(__DIR__ . '/../assets/images/row2', 'assets/images/row2');
$catalog_files = scanAdminDir(__DIR__ . '/../assets/images/catalog', 'assets/images/catalog');
$video_files = scanAdminDir(__DIR__ . '/../assets/videos', 'assets/videos');

$msg = isset($_GET['msg']) ? $_GET['msg'] : '';
$error = isset($_GET['error']) ? $_GET['error'] : '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard | Ambika Decoretors</title>
  <link rel="icon" type="image/png" href="../assets/Logo.png">
  <link rel="apple-touch-icon" href="../assets/Logo.png">
  <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600;700&family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="../styles.css">
  <style>
    .admin-navbar {
      background: rgba(9, 12, 18, 0.95);
      border-bottom: 1px solid var(--border-gold);
      padding: 15px 0;
    }
    .admin-nav-content {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    .dashboard-container {
      padding: 40px 0;
    }
    .upload-card {
      padding: 30px;
      margin-bottom: 40px;
    }
    .admin-gallery-section {
      margin-top: 30px;
    }
    .admin-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
      gap: 20px;
      margin-top: 15px;
    }
    .admin-img-card {
      position: relative;
      height: 180px;
      border-radius: var(--radius-sm);
      overflow: hidden;
      border: 1px solid var(--border-gold);
      background: rgba(9, 12, 18, 0.8);
    }
    .admin-img-card img, .admin-img-card video {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }
    .btn-delete {
      position: absolute;
      top: 10px;
      right: 10px;
      background: rgba(220, 53, 69, 0.9);
      color: #fff;
      border: none;
      width: 34px;
      height: 34px;
      border-radius: 50%;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 4px 12px rgba(0,0,0,0.5);
      transition: var(--transition-fast);
      z-index: 5;
    }
    .btn-delete:hover {
      background: #dc3545;
      transform: scale(1.1);
    }
    .alert-banner {
      padding: 12px 20px;
      border-radius: var(--radius-sm);
      margin-bottom: 20px;
      font-size: 0.9rem;
    }
    .alert-success {
      background: rgba(40, 167, 69, 0.2);
      border: 1px solid #28a745;
      color: #28a745;
    }
    .alert-danger {
      background: rgba(220, 53, 69, 0.2);
      border: 1px solid #dc3545;
      color: #ff6b6b;
    }
    .folder-badge {
      position: absolute;
      bottom: 8px;
      left: 8px;
      background: rgba(9,12,18,0.85);
      color: var(--gold-primary);
      padding: 3px 8px;
      border-radius: var(--radius-pill);
      font-size: 0.72rem;
      border: 1px solid var(--border-gold);
    }
  </style>
</head>
<body>

  <!-- Admin Header -->
  <header class="admin-navbar">
    <div class="container admin-nav-content">
      <div class="brand-logo">
        <div class="logo-emblem"><img src="../assets/Logo.png" alt="Ambika Decoretors Logo"></div>
        <div class="brand-text">
          <span class="brand-name">AMBIKA DECORETORS</span>
          <span class="brand-tagline">ADMIN PANEL</span>
        </div>
      </div>
      <div>
        <a href="../index.html" target="_blank" class="btn btn-outline" style="padding: 8px 16px; font-size: 0.85rem; margin-right: 10px;">
          <i class="fa-solid fa-arrow-up-right-from-square"></i> View Live Site
        </a>
        <a href="logout.php" class="btn btn-ghost-sm" style="padding: 8px 16px; font-size: 0.85rem; color: #ff6b6b;">
          <i class="fa-solid fa-power-off"></i> Logout
        </a>
      </div>
    </div>
  </header>

  <div class="container dashboard-container">

    <?php if ($msg === 'success'): ?>
      <div class="alert-banner alert-success"><i class="fa-solid fa-circle-check"></i> File uploaded successfully into selected folder! It is now live in your gallery.</div>
    <?php elseif ($msg === 'deleted'): ?>
      <div class="alert-banner alert-success"><i class="fa-solid fa-circle-check"></i> Media file removed from gallery folder.</div>
    <?php elseif ($error): ?>
      <div class="alert-banner alert-danger"><i class="fa-solid fa-triangle-exclamation"></i> Error processing file upload. Please check file type (Image/Video).</div>
    <?php endif; ?>

    <!-- Upload Card -->
    <div class="upload-card glass-card">
      <h2 style="color: #fff; font-size: 1.4rem; margin-bottom: 10px;">
        <i class="fa-solid fa-cloud-arrow-up icon-gold"></i> Upload New Media (Image / Video)
      </h2>
      <p style="color: var(--text-muted); font-size: 0.9rem; margin-bottom: 25px;">
        Upload photo or video for Row 1 Marquee, Row 2 Marquee, or Video Catalog. Uploaded files save directly into their respective folders.
      </p>

      <form action="upload.php" method="POST" enctype="multipart/form-data" class="form-row">
        <div class="form-group" style="flex: 2;">
          <label for="media_file">Select Image or Video File (JPG, PNG, WEBP, MP4, WEBM)</label>
          <input type="file" id="media_file" name="media_file" accept="image/*,video/*" required style="padding: 9px 14px;">
        </div>

        <div class="form-group" style="flex: 1.5;">
          <label for="target_folder">Destination Target Folder</label>
          <select id="target_folder" name="target_folder" required>
            <option value="row1" selected>Row 1 Images (assets/images/row1/)</option>
            <option value="row2">Row 2 Images (assets/images/row2/)</option>
            <option value="catalog">Catalog Only Images (assets/images/catalog/)</option>
            <option value="videos">Videos & Reels (assets/videos/)</option>
          </select>
        </div>

        <div class="form-group" style="flex: 1; display: flex; align-items: flex-end;">
          <button type="submit" class="btn btn-call btn-block">
            <i class="fa-solid fa-upload"></i> Upload Media
          </button>
        </div>
      </form>
    </div>

    <!-- Active Gallery Manager -->
    <div class="admin-gallery-section">
      <h2 style="color: #fff; font-size: 1.4rem; margin-bottom: 20px;">
        <i class="fa-solid fa-folder-open icon-gold"></i> Manage Folder Media Galleries
      </h2>

      <!-- Row 1 Folder Images -->
      <div class="glass-card" style="padding: 20px; margin-bottom: 25px;">
        <h3 style="color: var(--gold-light); font-size: 1.1rem;">
          <i class="fa-solid fa-images icon-gold"></i> Row 1 Folder Images (`assets/images/row1/`) - Total: <?php echo count($row1_files); ?>
        </h3>
        <?php if (empty($row1_files)): ?>
          <p style="color: var(--text-muted); font-size: 0.85rem; margin-top: 10px;">No images in Row 1 folder yet.</p>
        <?php else: ?>
          <div class="admin-grid">
            <?php foreach ($row1_files as $f): ?>
              <div class="admin-img-card">
                <img src="../<?php echo htmlspecialchars($f['rel']); ?>" alt="Row 1 Image">
                <span class="folder-badge">Row 1</span>
                <a href="delete.php?file=<?php echo urlencode($f['rel']); ?>" class="btn-delete" title="Delete File" onclick="return confirm('Delete this image from Row 1 folder?')">
                  <i class="fa-solid fa-trash-can"></i>
                </a>
              </div>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>
      </div>

      <!-- Row 2 Folder Images -->
      <div class="glass-card" style="padding: 20px; margin-bottom: 25px;">
        <h3 style="color: var(--gold-light); font-size: 1.1rem;">
          <i class="fa-solid fa-images icon-gold"></i> Row 2 Folder Images (`assets/images/row2/`) - Total: <?php echo count($row2_files); ?>
        </h3>
        <?php if (empty($row2_files)): ?>
          <p style="color: var(--text-muted); font-size: 0.85rem; margin-top: 10px;">No images in Row 2 folder yet.</p>
        <?php else: ?>
          <div class="admin-grid">
            <?php foreach ($row2_files as $f): ?>
              <div class="admin-img-card">
                <img src="../<?php echo htmlspecialchars($f['rel']); ?>" alt="Row 2 Image">
                <span class="folder-badge">Row 2</span>
                <a href="delete.php?file=<?php echo urlencode($f['rel']); ?>" class="btn-delete" title="Delete File" onclick="return confirm('Delete this image from Row 2 folder?')">
                  <i class="fa-solid fa-trash-can"></i>
                </a>
              </div>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>
      </div>

      <!-- Catalog Only Folder Images -->
      <div class="glass-card" style="padding: 20px; margin-bottom: 25px;">
        <h3 style="color: var(--gold-light); font-size: 1.1rem;">
          <i class="fa-solid fa-book-open icon-gold"></i> Catalog Only Images (`assets/images/catalog/`) - Total: <?php echo count($catalog_files); ?>
        </h3>
        <?php if (empty($catalog_files)): ?>
          <p style="color: var(--text-muted); font-size: 0.85rem; margin-top: 10px;">No images in Catalog Only folder yet. (Uploaded images here display only in the full catalog, not on homepage marquee rows).</p>
        <?php else: ?>
          <div class="admin-grid">
            <?php foreach ($catalog_files as $f): ?>
              <div class="admin-img-card">
                <img src="../<?php echo htmlspecialchars($f['rel']); ?>" alt="Catalog Image">
                <span class="folder-badge">Catalog Only</span>
                <a href="delete.php?file=<?php echo urlencode($f['rel']); ?>" class="btn-delete" title="Delete File" onclick="return confirm('Delete this image from Catalog folder?')">
                  <i class="fa-solid fa-trash-can"></i>
                </a>
              </div>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>
      </div>

      <!-- Videos Folder -->
      <div class="glass-card" style="padding: 20px;">
        <h3 style="color: var(--gold-light); font-size: 1.1rem;">
          <i class="fa-solid fa-video icon-gold"></i> Videos Folder (`assets/videos/`) - Total: <?php echo count($video_files); ?>
        </h3>
        <?php if (empty($video_files)): ?>
          <p style="color: var(--text-muted); font-size: 0.85rem; margin-top: 10px;">No videos uploaded in `assets/videos/` folder yet. (Showing showcase reels on live catalog).</p>
        <?php else: ?>
          <div class="admin-grid">
            <?php foreach ($video_files as $f): ?>
              <div class="admin-img-card">
                <video src="../<?php echo htmlspecialchars($f['rel']); ?>" controls></video>
                <span class="folder-badge">Video</span>
                <a href="delete.php?file=<?php echo urlencode($f['rel']); ?>" class="btn-delete" title="Delete Video" onclick="return confirm('Delete this video file?')">
                  <i class="fa-solid fa-trash-can"></i>
                </a>
              </div>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>
      </div>

    </div>

  </div>

</body>
</html>
