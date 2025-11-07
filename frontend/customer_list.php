<?php
include '../backend/routes/auth.php';

$username = $_SESSION['username'];
$displayName = ($username === 'admin') ? 'Administrator' : ucfirst($username);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css">
  <link rel="stylesheet" href="style.css">
  <script src="js/preventBack.js"></script>
  <title>Home</title>
</head>
<body>
  <nav class="nav-container">
    <div class="logo-name">
      <img src="../images/sims-logo.jpg" alt="logo" class="sims-logo">
      <h1>Sales and Inventory Management System</h1>
    </div>
    
    <ul class="admin-label">
      <li>
        <a href="../backend/routes/logout.php">
          <span><?php echo $displayName; ?></span>
          <i class="fas fa-power-off"></i>
        </a>
      </li>
    </ul>
  </nav>

  <div class="home-container">
    <div class="sidebar">
      <ul>
        <li><a href="home.php"><i class="fa fa-home"></i>Home</a></li>
        <li><a href="inventory.php"><i class="fas fa-clipboard-list"></i>Inventory</a></li>
        <li><a href="sales.php"><i class="fas fa-coins"></i>Sales</a></li>
        <li><a href="receiving.php"><i class="fas fa-clipboard-check"></i>Receiving</a></li>
        <li><a href="category_list.php"><i class="fa fa-bars"></i></i>Category list</a></li>
        <li><a href="product_list.php"><i class="fas fa-boxes"></i></i>Product list</a></li>
        <li><a href="supplier_list.php"><i class="fas fa-truck"></i></i>Supplier list</a></li>
        <li class="active"><a href="customer_list.php"><i class="fas fa-shopping-cart"></i></i>Customer list</a></li>
        <li><a href="user.php"><i class="fa fa-user"></i></i>User</a></li>
      </ul>
    </div>

  </div>
  
</body>
</html>