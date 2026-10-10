<?php
require_once __DIR__ . '/auth.php';
check_admin_auth();

if (isset($_GET['file'])) {
    $rel_file = urldecode($_GET['file']);
    $full_path = realpath(__DIR__ . '/../' . $rel_file);
    $base_dir = realpath(__DIR__ . '/../assets');

    // Security check: ensure file path is inside assets directory
    if ($full_path && strpos($full_path, $base_dir) === 0 && file_exists($full_path)) {
        @unlink($full_path);

        // Re-sync index.html and gallery.html
        @exec("php -r \"ob_start(); include '" . __DIR__ . "/../index.php'; file_put_contents('" . __DIR__ . "/../index.html', ob_get_clean()); ob_start(); include '" . __DIR__ . "/../gallery.php'; file_put_contents('" . __DIR__ . "/../gallery.html', ob_get_clean());\"");

        header('Location: index.php?msg=deleted');
        exit;
    }
}

header('Location: index.php?error=delete_failed');
exit;
