<?php
require 'config.php';

$errors = [];
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Trim & validate
    $username = trim($_POST['username'] ?? '');
    $email    = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($username === '' || strlen($username) < 3) $errors[] = 'Username must be at least 3 characters.';
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Invalid email address.';
    if (strlen($password) < 8) $errors[] = 'Password must be at least 8 characters.';

    if (empty($errors)) {
        // Prepared statement to avoid SQL injection
        $stmt = $conn->prepare("SELECT id FROM users WHERE email = ? OR username = ?");
        $stmt->bind_param('ss', $email, $username);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $errors[] = 'Email or username already taken.';
        } else {
            $stmt->close();
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $insert = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
            $insert->bind_param('sss', $username, $email, $hash);
            if ($insert->execute()) {
                $success = 'Registration successful. You can <a href="login.php">login now</a>.';
                // Optionally regenerate session id after registration
                session_regenerate_id(true);
            } else {
                $errors[] = 'Registration failed: ' . $insert->error;
            }
            $insert->close();
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Register</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-6 col-lg-5">
      <div class="card shadow-sm">
        <div class="card-body">
          <h3 class="card-title mb-3">Create account</h3>

          <?php if ($errors): ?>
            <div class="alert alert-danger">
              <?php foreach ($errors as $err) echo '<div>' . e($err) . '</div>'; ?>
            </div>
          <?php endif; ?>

          <?php if ($success): ?>
            <div class="alert alert-success"><?= $success ?></div>
          <?php endif; ?>

          <form method="POST" novalidate>
            <div class="mb-3">
              <label class="form-label">Username</label>
              <input class="form-control" name="username" required value="<?= e($_POST['username'] ?? '') ?>">
            </div>
            <div class="mb-3">
              <label class="form-label">Email</label>
              <input class="form-control" name="email" type="email" required value="<?= e($_POST['email'] ?? '') ?>">
            </div>
            <div class="mb-3">
              <label class="form-label">Password</label>
              <input class="form-control" name="password" type="password" required>
              <div class="form-text">At least 8 characters.</div>
            </div>
            <button class="btn btn-primary w-100" type="submit">Register</button>
          </form>

          <hr>
          <p class="text-center mb-0">Already registered? <a href="login.php">Login</a></p>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>
