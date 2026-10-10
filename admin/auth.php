<?php
if (session_status() === PHP_SESSION_NONE) {
    @session_start();
}

// Admin Credentials
define('ADMIN_USERNAME', 'admin');
define('ADMIN_PASSWORD', 'nisuBhatt16@20#310');
define('AUTH_SECRET_HASH', md5(ADMIN_USERNAME . ':' . ADMIN_PASSWORD . ':AMBIKA_DECOR_SECRET_2026'));

function is_admin_logged_in() {
    if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
        return true;
    }
    if (isset($_COOKIE['admin_auth_token']) && $_COOKIE['admin_auth_token'] === AUTH_SECRET_HASH) {
        $_SESSION['admin_logged_in'] = true;
        return true;
    }
    return false;
}

function set_admin_login_session() {
    $_SESSION['admin_logged_in'] = true;
    setcookie('admin_auth_token', AUTH_SECRET_HASH, time() + (86400 * 30), '/');
}

function clear_admin_login_session() {
    $_SESSION = [];
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }
    @session_destroy();
    setcookie('admin_auth_token', '', time() - 3600, '/');
}

function check_admin_auth() {
    if (!is_admin_logged_in()) {
        header('Location: login.php');
        exit;
    }
}
