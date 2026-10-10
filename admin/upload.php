<?php
require_once __DIR__ . '/auth.php';
check_admin_auth();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['media_file'])) {
    $file = $_FILES['media_file'];
    $target_folder = isset($_POST['target_folder']) ? $_POST['target_folder'] : 'row1';

    if ($file['error'] === UPLOAD_ERR_OK) {
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        
        $image_exts = ['jpg', 'jpeg', 'png', 'webp'];
        $video_exts = ['mp4', 'webm', 'mov', 'm4v'];

        if ($target_folder === 'videos') {
            $dest_dir = __DIR__ . '/../assets/videos/';
            $allowed = array_merge($image_exts, $video_exts);
        } elseif ($target_folder === 'catalog') {
            $dest_dir = __DIR__ . '/../assets/images/catalog/';
            $allowed = $image_exts;
        } elseif ($target_folder === 'row2') {
            $dest_dir = __DIR__ . '/../assets/images/row2/';
            $allowed = $image_exts;
        } else { // default row1
            $dest_dir = __DIR__ . '/../assets/images/row1/';
            $allowed = $image_exts;
        }

        if (!is_dir($dest_dir)) {
            @mkdir($dest_dir, 0755, true);
        }

        if (in_array($ext, $allowed)) {
            $filename = 'media_' . time() . '_' . rand(100, 999) . '.' . $ext;
            $destination = $dest_dir . $filename;

            if (move_uploaded_file($file['tmp_name'], $destination)) {
                // Trigger static page build to keep HTML synced
                @exec("php -r \"ob_start(); include '" . __DIR__ . "/../index.php'; file_put_contents('" . __DIR__ . "/../index.html', ob_get_clean()); ob_start(); include '" . __DIR__ . "/../gallery.php'; file_put_contents('" . __DIR__ . "/../gallery.html', ob_get_clean());\"");

                header('Location: index.php?msg=success');
                exit;
            } else {
                header('Location: index.php?error=upload_failed');
                exit;
            }
        } else {
            header('Location: index.php?error=invalid_type');
            exit;
        }
    } else {
        header('Location: index.php?error=file_error');
        exit;
    }
}

header('Location: index.php');
exit;
