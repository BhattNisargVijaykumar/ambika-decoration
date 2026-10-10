<?php
require_once __DIR__ . '/auth.php';
check_admin_auth();

$data_file = __DIR__ . '/../data/gallery.json';
$upload_dir = __DIR__ . '/../assets/uploads/';

if (!is_dir($upload_dir)) {
    @mkdir($upload_dir, 0755, true);
}

// Load gallery JSON
$gallery_data = ['row1' => [], 'row2' => []];
if (file_exists($data_file)) {
    $json = json_decode(file_get_contents($data_file), true);
    if (is_array($json)) {
        $gallery_data = array_merge($gallery_data, $json);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['work_image'])) {
    $file = $_FILES['work_image'];
    $target_row = isset($_POST['target_row']) ? $_POST['target_row'] : 'row1';

    if ($file['error'] === UPLOAD_ERR_OK) {
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png', 'webp'];

        if (in_array($ext, $allowed)) {
            $new_name = 'work_' . time() . '_' . rand(100, 999) . '.' . $ext;
            $destination = $upload_dir . $new_name;
            $relative_path = 'assets/uploads/' . $new_name;

            if (move_uploaded_file($file['tmp_name'], $destination)) {
                if ($target_row === 'row1' || $target_row === 'both') {
                    $gallery_data['row1'][] = $relative_path;
                }
                if ($target_row === 'row2' || $target_row === 'both') {
                    $gallery_data['row2'][] = $relative_path;
                }

                file_put_contents($data_file, json_encode($gallery_data, JSON_PRETTY_PRINT));
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
