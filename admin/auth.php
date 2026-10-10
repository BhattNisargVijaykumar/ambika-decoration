<?php
session_start();

// Admin Credentials (default: admin / admin123)
define('ADMIN_USERNAME', 'admin');
define('ADMIN_PASSWORD', 'admin123');

function check_admin_auth() {
    if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
        header('Location: login.php');
        exit;
    }
}
