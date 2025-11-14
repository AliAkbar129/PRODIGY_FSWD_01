<?php
require 'config.php';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Provide a valid email.';
    if ($password === '') $errors[] = 'Provide a password.';

    if (empty($errors)) {
        $stmt = $conn->prepare("SELECT id, username, password, role FROM users WHERE email = ?");
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows === 1) {
            $stmt->bind_result($id, $username, $hash, $role);
            $stmt->fetch();
            if (password_verify($password, $hash)) {
                // login success
                session_regenerate_id(true);
                $_SESSION['user_id'] = $id;
                $_SESSION['username'] = $username;
                $_SESSION['role'] = $role;
                header('Location: dashboard.php');
                exit;
            } else {
                $errors[] = 'Invalid credentials.';
            }
        } else {
            $errors[] = 'Invalid credentials.';
        }
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-5">
      <div class="card shadow-sm">
        <div class="card-body">
          <h3 class="card-title mb-3">Login</h3>

          <?php if ($errors): ?>
            <div class="alert alert-danger">
              <?php foreach ($errors as $err) echo '<div>' . e($err) . '</div>'; ?>
            </div>
          <?php endif; ?>

          <form method="POST">
            <div class="mb-3">
              <label class="form-label">Email</label>
              <input class="form-control" name="email" type="email" required value="<?= e($_POST['email'] ?? '') ?>">
            </div>
            <div class="mb-3">
              <label class="form-label">Password</label>
              <input class="form-control" name="password" type="password" required>
            </div>
            <button class="btn btn-success w-100" type="submit">Login</button>
          </form>

          <hr>
          <p class="text-center mb-0">Don't have account? <a href="register.php">Register</a></p>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>
