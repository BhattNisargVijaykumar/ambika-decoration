<?php
require_once __DIR__ . '/auth.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';

    if ($username === ADMIN_USERNAME && $password === ADMIN_PASSWORD) {
        $_SESSION['admin_logged_in'] = true;
        header('Location: index.php');
        exit;
    } else {
        $error = 'Invalid username or password!';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login | Ambika Decoration</title>
  <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600;700&family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="../styles.css">
  <style>
    body {
      display: flex;
      align-items: center;
      justify-content: center;
      min-height: 100vh;
      background: linear-gradient(135deg, #090c12 0%, #111723 100%);
    }
    .login-card {
      width: 100%;
      max-width: 420px;
      padding: 40px;
    }
    .login-header {
      text-align: center;
      margin-bottom: 30px;
    }
    .error-msg {
      background: rgba(220, 53, 69, 0.2);
      border: 1px solid #dc3545;
      color: #ff6b6b;
      padding: 10px 15px;
      border-radius: var(--radius-sm);
      margin-bottom: 20px;
      font-size: 0.9rem;
      text-align: center;
    }
  </style>
</head>
<body>

  <div class="login-card glass-card">
    <div class="login-header">
      <div class="logo-emblem" style="margin: 0 auto 15px auto;">A</div>
      <h2 style="color: #fff; font-size: 1.5rem;">Admin Login</h2>
      <p style="color: var(--text-muted); font-size: 0.85rem; margin-top: 5px;">Ambika Decoration & Party Plot</p>
    </div>

    <?php if (!empty($error)): ?>
      <div class="error-msg"><i class="fa-solid fa-triangle-exclamation"></i> <?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>

    <form method="POST" action="login.php">
      <div class="form-group">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" placeholder="Enter admin username" required>
      </div>

      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Enter admin password" required>
      </div>

      <button type="submit" class="btn btn-call btn-block" style="margin-top: 25px;">
        <i class="fa-solid fa-right-to-bracket"></i> Login to Dashboard
      </button>
    </form>
    
    <p style="text-align: center; color: var(--text-muted); font-size: 0.75rem; margin-top: 20px;">
      Default Credentials: <strong>admin</strong> / <strong>admin123</strong>
    </p>
  </div>

</body>
</html>
