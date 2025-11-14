<?php
require 'config.php';

// Require login
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Fetch fresh user info (optional)
$stmt = $conn->prepare("SELECT username, email, role, created_at FROM users WHERE id = ?");
$stmt->bind_param('i', $_SESSION['user_id']);
$stmt->execute();
$stmt->bind_result($username, $email, $role, $created_at);
$stmt->fetch();
$stmt->close();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="index.php">AuthSystem</a>
    <div class="ms-auto">
      <span class="text-white me-3">Hi, <?= e($username) ?></span>
      <a class="btn btn-outline-light btn-sm" href="logout.php">Logout</a>
    </div>
  </div>
</nav>

<div class="container py-4">
  <div class="card shadow-sm">
    <div class="card-body">
      <h3>Dashboard</h3>
      <p><strong>Username:</strong> <?= e($username) ?></p>
      <p><strong>Email:</strong> <?= e($email) ?></p>
      <p><strong>Role:</strong> <?= e($role) ?></p>
      <p><strong>Member since:</strong> <?= e($created_at) ?></p>

      <?php if ($role === 'admin'): ?>
        <a href="admin.php" class="btn btn-warning">Admin Panel</a>
      <?php endif; ?>
    </div>
  </div>
</div>
</body>
</html>
