<?php
require_once __DIR__ . '/auth.php';
check_admin_auth();

$data_file = __DIR__ . '/../data/gallery.json';

if (isset($_GET['img']) && isset($_GET['row'])) {
    $img_path = urldecode($_GET['img']);
    $row_key = $_GET['row'];

    if (file_exists($data_file)) {
        $gallery_data = json_decode(file_get_contents($data_file), true);

        if (isset($gallery_data[$row_key])) {
            $gallery_data[$row_key] = array_values(array_filter($gallery_data[$row_key], function($item) use ($img_path) {
                return $item !== $img_path;
            }));

            file_put_contents($data_file, json_encode($gallery_data, JSON_PRETTY_PRINT));

            // Check if file can be safely unlinked
            $in_row1 = in_array($img_path, $gallery_data['row1']);
            $in_row2 = in_array($img_path, $gallery_data['row2']);

            if (!$in_row1 && !$in_row2) {
                $full_path = __DIR__ . '/../' . $img_path;
                if (file_exists($full_path) && strpos($img_path, 'assets/uploads/') === 0) {
                    @unlink($full_path);
                }
            }
        }
    }
}

header('Location: index.php?msg=deleted');
exit;
