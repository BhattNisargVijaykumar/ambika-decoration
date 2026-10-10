<?php
require_once __DIR__ . '/auth.php';
check_admin_auth();

$data_file = __DIR__ . '/../data/gallery.json';
$gallery_data = ['row1' => [], 'row2' => []];

if (file_exists($data_file)) {
    $json = json_decode(file_get_contents($data_file), true);
    if (is_array($json)) {
        $gallery_data = array_merge($gallery_data, $json);
    }
}

$msg = isset($_GET['msg']) ? $_GET['msg'] : '';
$error = isset($_GET['error']) ? $_GET['error'] : '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard | Ambika Decoration</title>
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
      grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
      gap: 20px;
      margin-top: 20px;
    }
    .admin-img-card {
      position: relative;
      height: 240px;
      border-radius: var(--radius-sm);
      overflow: hidden;
      border: 1px solid var(--border-gold);
    }
    .admin-img-card img {
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
      width: 32px;
      height: 32px;
      border-radius: 50%;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .btn-delete:hover {
      background: #dc3545;
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
  </style>
</head>
<body>

  <!-- Admin Header -->
  <header class="admin-navbar">
    <div class="container admin-nav-content">
      <div class="brand-logo">
        <div class="logo-emblem">A</div>
        <div class="brand-text">
          <span class="brand-name">AMBIKA DECORATION</span>
          <span class="brand-tagline">ADMIN PANEL</span>
        </div>
      </div>
      <div>
        <a href="../index.php" target="_blank" class="btn btn-outline" style="padding: 8px 16px; font-size: 0.85rem; margin-right: 10px;">
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
      <div class="alert-banner alert-success"><i class="fa-solid fa-circle-check"></i> Image uploaded successfully! It is now live in your gallery.</div>
    <?php elseif ($msg === 'deleted'): ?>
      <div class="alert-banner alert-success"><i class="fa-solid fa-circle-check"></i> Image removed from gallery.</div>
    <?php elseif ($error): ?>
      <div class="alert-banner alert-danger"><i class="fa-solid fa-triangle-exclamation"></i> Error processing image upload. Please try again.</div>
    <?php endif; ?>

    <!-- Upload Card -->
    <div class="upload-card glass-card">
      <h2 style="color: #fff; font-size: 1.4rem; margin-bottom: 10px;">
        <i class="fa-solid fa-cloud-arrow-up icon-gold"></i> Upload New Work Image
      </h2>
      <p style="color: var(--text-muted); font-size: 0.9rem; margin-bottom: 25px;">
        Upload photo of your Mandap, Chori, Stage Decor, or Catering setup. It will automatically populate into your dynamic scrolling gallery.
      </p>

      <form action="upload.php" method="POST" enctype="multipart/form-data" class="form-row">
        <div class="form-group" style="flex: 2;">
          <label for="work_image">Select Image File (JPG, PNG, WEBP)</label>
          <input type="file" id="work_image" name="work_image" accept="image/*" required style="padding: 9px 14px;">
        </div>

        <div class="form-group" style="flex: 1;">
          <label for="target_row">Target Marquee Row</label>
          <select id="target_row" name="target_row" required>
            <option value="row1">Row 1 (Scroll Right)</option>
            <option value="row2">Row 2 (Scroll Left)</option>
            <option value="both" selected>Both Rows (Recommended)</option>
          </select>
        </div>

        <div class="form-group" style="flex: 1; display: flex; align-items: flex-end;">
          <button type="submit" class="btn btn-call btn-block">
            <i class="fa-solid fa-upload"></i> Upload Image
          </button>
        </div>
      </form>
    </div>

    <!-- Active Gallery Manager -->
    <div class="admin-gallery-section">
      <h2 style="color: #fff; font-size: 1.4rem; margin-bottom: 20px;">
        <i class="fa-solid fa-images icon-gold"></i> Active Marquee Work Gallery
      </h2>

      <!-- Row 1 Images -->
      <div class="glass-card" style="padding: 20px; margin-bottom: 25px;">
        <h3 style="color: var(--gold-light); font-size: 1.1rem;">
          <i class="fa-solid fa-arrow-right icon-gold"></i> Row 1 Uploads (Auto-Scroll Right)
        </h3>
        <?php if (empty($gallery_data['row1'])): ?>
          <p style="color: var(--text-muted); font-size: 0.85rem; margin-top: 10px;">No custom images uploaded yet for Row 1. (Default sample images active on live site).</p>
        <?php else: ?>
          <div class="admin-grid">
            <?php foreach ($gallery_data['row1'] as $img): ?>
              <div class="admin-img-card">
                <img src="../<?php echo htmlspecialchars($img); ?>" alt="Row 1 Image">
                <a href="delete.php?img=<?php echo urlencode($img); ?>&row=row1" class="btn-delete" title="Delete Image" onclick="return confirm('Remove this image from Row 1?')">
                  <i class="fa-solid fa-trash-can"></i>
                </a>
              </div>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>
      </div>

      <!-- Row 2 Images -->
      <div class="glass-card" style="padding: 20px;">
        <h3 style="color: var(--gold-light); font-size: 1.1rem;">
          <i class="fa-solid fa-arrow-left icon-gold"></i> Row 2 Uploads (Auto-Scroll Left)
        </h3>
        <?php if (empty($gallery_data['row2'])): ?>
          <p style="color: var(--text-muted); font-size: 0.85rem; margin-top: 10px;">No custom images uploaded yet for Row 2. (Default sample images active on live site).</p>
        <?php else: ?>
          <div class="admin-grid">
            <?php foreach ($gallery_data['row2'] as $img): ?>
              <div class="admin-img-card">
                <img src="../<?php echo htmlspecialchars($img); ?>" alt="Row 2 Image">
                <a href="delete.php?img=<?php echo urlencode($img); ?>&row=row2" class="btn-delete" title="Delete Image" onclick="return confirm('Remove this image from Row 2?')">
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
