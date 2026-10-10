<?php
require_once __DIR__ . '/auth.php';
clear_admin_login_session();
header('Location: login.php');
exit;
