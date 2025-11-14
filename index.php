<?php require 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Secure User Authentication</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: #f8f9fa;
    }
    .hero {
      background: linear-gradient(135deg, #4e73df, #1cc88a);
      color: white;
      padding: 100px 20px 60px;
      text-align: center;
      border-radius: 15px;
      box-shadow: 0 4px 15px rgba(0,0,0,0.2);
    }
    .hero h1 {
      font-weight: 700;
      margin-bottom: 20px;
    }
    .hero p {
      font-size: 1.2rem;
    }
    .action-btns a {
      width: 180px;
      transition: transform 0.2s;
    }
    .action-btns a:hover {
      transform: translateY(-5px);
    }
  </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
  <div class="container">
    <a class="navbar-brand fw-bold" href="#">AuthSystem</a>
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="register.php">Register</a></li>
        <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
        <li class="nav-item"><a class="nav-link" href="dashboard.php">Dashboard</a></li>
      </ul>
    </div>
  </div>
</nav>

<!-- Hero Section -->
<div class="container my-5">
  <div class="hero mx-auto">
    <h1>Secure User Authentication</h1>
    <p>Build a robust and safe login system. Passwords are hashed, sessions are secure, and routes are protected.</p>
  </div>
</div>

<!-- Action Buttons -->
<div class="container text-center mb-5">
  <div class="d-flex justify-content-center gap-3 flex-wrap action-btns">
    <a class="btn btn-primary btn-lg shadow-sm" href="register.php">Register</a>
    <a class="btn btn-success btn-lg shadow-sm" href="login.php">Login</a>
    <a class="btn btn-info btn-lg shadow-sm" href="dashboard.php">Dashboard</a>
  </div>
</div>

<!-- Footer -->
<footer class="text-center py-4 bg-light border-top">
  <p class="mb-0">&copy; <?= date('Y') ?> Secure Auth System. All rights reserved.</p>
</footer>

</body>
</html>

