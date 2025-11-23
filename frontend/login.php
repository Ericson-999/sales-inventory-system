<?php
session_start();
if (isset($_SESSION['username'])) {
  header("Location: home.php");
  exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="css/all.min.css">
  <title>Sales and Inventory Management System</title>
</head>
<body>
  <div class="form_container">
      <form class="login_form" action="../backend/routes/login.php" method="POST">
        <h1>Login</h1>
        <div class="input-group">
          <i class="fas fa-user"></i>
          <input type="text" name="username" placeholder="Username" required>
        </div>
        <div class="input-group password-wrapper">
          <i class="fas fa-lock"></i>
          <input type="password" id="loginPassword" name="password" placeholder="Password" required>
          <button type="button" class="toggle-password password-eye-btn" aria-label="Show password">
            <i class="fa fa-eye-slash"></i>
          </button>
        </div>
        <button type="submit">Login</button>
        <?php
          if (isset($_SESSION['login_error'])) {
              echo "<div class='error-message'>{$_SESSION['login_error']}</div>";
              unset($_SESSION['login_error']);
          }
        ?>
      </form>
  </div>
<script src="js/preventBack.js"></script>
<script src="js/passwordToggle.js"></script>
</body>
</html>

