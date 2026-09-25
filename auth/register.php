<?php
session_start();
require_once '../config/db.php';

$error = "";
$success = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';
    $role = $_POST['role'] ?? '';

    if ($name === '' || $email === '' || $password === '' || $role === '') {
        $error = "Please fill in all fields.";
    } elseif ($password !== $confirm_password) {
        $error = "Passwords do not match.";
    } elseif (strlen($password) < 6) {
        $error = "Password must be at least 6 characters.";
    } else {
        // Check if email already exists
        $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $error = "An account with this email already exists.";
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $insert = $conn->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)");
            $insert->bind_param("ssss", $name, $email, $hashed_password, $role);

            if ($insert->execute()) {
                $success = "Account created successfully! You can now log in.";
            } else {
                $error = "Something went wrong. Please try again.";
            }
            $insert->close();
        }
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Register - Mobile Shop Management System</title>
<link rel="stylesheet" href="/mobile-shop-management-system/assets/css/style.css">
</head>
<body>

<div class="auth-page">
  <div class="auth-card">
    <div class="auth-logo">
      <span style="font-size:24px;">📱</span>
      <h1>Mobile Shop<br>Management System</h1>
    </div>

    <h2>Create account</h2>
    <p class="subtitle">Register to get started</p>

    <?php if ($error): ?>
      <div class="auth-error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    <?php if ($success): ?>
      <div class="auth-error" style="background:#f0fdf4; color:#16a34a;"><?= htmlspecialchars($success) ?> <a href="login.php">Login here</a></div>
    <?php endif; ?>

    <?php if (!$success): ?>
    <form method="POST" action="">
      <div class="form-group">
        <label for="name">Full Name</label>
        <input type="text" id="name" name="name" placeholder="Your name" required value="<?= htmlspecialchars($_POST['name'] ?? '') ?>">
      </div>

      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="you@example.com" required value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
      </div>

      <div class="form-group">
        <label for="role">Role</label>
        <select id="role" name="role" required>
          <option value="">Select role</option>
          <option value="admin">Admin</option>
          <option value="sales_staff">Sales Staff</option>
          <option value="technician">Technician</option>
        </select>
      </div>

      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="••••••••" required>
      </div>

      <div class="form-group">
        <label for="confirm_password">Confirm Password</label>
        <input type="password" id="confirm_password" name="confirm_password" placeholder="••••••••" required>
      </div>

      <button type="submit" class="btn-primary">Register</button>
    </form>
    <?php endif; ?>

    <div class="auth-footer">
      Already have an account? <a href="login.php">Login</a>
    </div>
  </div>
</div>

</body>
</html>