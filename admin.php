<?php
require 'config.php';
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    http_response_code(403);
    echo "Access denied. Admins only.";
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Admin Panel</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container py-5">
  <div class="card">
    <div class="card-body">
      <h3>Admin Panel</h3>
      <p>Only visible to users with role = admin.</p>
      <a href="dashboard.php" class="btn btn-primary">Back to Dashboard</a>
    </div>
  </div>
</div>
</body>
</html>
