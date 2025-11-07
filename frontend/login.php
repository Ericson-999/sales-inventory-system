<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css">
  <link rel="stylesheet" href="style.css">
  <script src="js/preventBack.js"></script>
  <title>Sales and Inventory Management System</title>
</head>
<body>
  <div class="form_container">
      <div>
        <img src="../images/heroImage.png" width="850px" height="730px" alt="hero Image">
      </div>
      <form class="login_form" action="../backend/routes/login.php" method="POST">
        <h1>Login</h1>
        <input type="text" name="username" placeholder="Username" required />
        <input type="password" name="password" placeholder="Password" required />
        <button type="submit">Login</button>
        <?php
          session_start();
          if (isset($_SESSION['login_error'])) {
              echo "<div class='error-message'>{$_SESSION['login_error']}</div>";
              unset($_SESSION['login_error']);
          }
        ?>
      </form>
  </div>

</body>
</html>

