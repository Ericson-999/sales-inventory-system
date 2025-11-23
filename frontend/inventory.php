<?php
include '../backend/routes/auth.php';

$displayName = isset($_SESSION['name']) ? $_SESSION['name'] : $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="css/all.min.css">
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
          <i class="fa fa-sign-out"></i>
        </a>
      </li>
    </ul>
  </nav>

  <div class="home-container">
    <?php $currentPage = basename($_SERVER['PHP_SELF']); ?>
      <div class="sidebar">
        <ul>
          <li class="<?= $currentPage === 'home.php' ? 'active' : '' ?>">
            <a href="home.php"><i class="fa fa-home"></i>Home</a>
          </li>
          <li class="<?= $currentPage === 'inventory.php' ? 'active' : '' ?>">
            <a href="inventory.php"><i class="fas fa-clipboard-list"></i>Inventory</a>
          </li>
          <li class="<?= $currentPage === 'sales.php' ? 'active' : '' ?>">
            <a href="sales.php"><i class="fas fa-coins"></i>Sales</a>
          </li>

          <?php if ($_SESSION['user_type'] === 'admin'): ?>
            <li class="<?= $currentPage === 'receiving.php' ? 'active' : '' ?>">
              <a href="receiving.php"><i class="fas fa-clipboard-check"></i>Receiving</a>
            </li>
            <li class="<?= $currentPage === 'category_list.php' ? 'active' : '' ?>">
              <a href="category_list.php"><i class="fa fa-bars"></i>Category list</a>
            </li>
            <li class="<?= $currentPage === 'product_list.php' ? 'active' : '' ?>">
              <a href="product_list.php"><i class="fas fa-boxes"></i>Product list</a>
            </li>
            <li class="<?= $currentPage === 'supplier_list.php' ? 'active' : '' ?>">
              <a href="supplier_list.php"><i class="fas fa-truck"></i>Supplier list</a>
            </li>
            <li class="<?= $currentPage === 'customer_list.php' ? 'active' : '' ?>">
              <a href="customer_list.php"><i class="fas fa-shopping-cart"></i>Customer list</a>
            </li>
            <li class="<?= $currentPage === 'staff_list.php' ? 'active' : '' ?>">
              <a href="staff_list.php"><i class="fa fa-user"></i>Staff</a>
            </li>
          <?php endif; ?>
        </ul>
      </div>
      
      
      <div class="main-content">
        <div class="cards">
          <div class="card">
            <h3>Total Products</h3>
            <p id="total-products">120</p>
          </div>
          <div class="card">
            <h3>Categories</h3>
            <p id="categories">8</p>
          </div>
          <div class="card">
            <h3>Low Stock</h3>
            <p id="low-stock">5</p>
          </div>
          <div class="card">
            <h3>Out of Stock</h3>
            <p id="out-stock">2</p>
          </div>
        </div>

        <table>
          <thead>
            <tr>
              <th>Product Name</th>
              <th>Category</th>
              <th>Stock</th>
              <th>Price</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Maggi Kari</td>
              <td>Instant Noodles</td>
              <td class="stock">0</td>
              <td>₱129.00</td>
            </tr>

            <tr>
              <td>Century Tuna</td>
              <td>Can Goods</td>
              <td class="stock">15</td>
              <td>₱45.00</td>
            </tr>
            <tr>
              <td>Snickers Fun Size</td>
              <td>Chocolate Bar</td>
              <td class="stock">3</td>
              <td>₱400.00</td>
            </tr>
            <tr>
              <td>Del Monte Four Seasons Juice Drink 1L</td>
              <td>Drinks</td>
              <td class="stock">8</td>
              <td>₱214.00</td>
            </tr>
            <tr>
              <td>Clover Chips</td>
              <td>Chips</td>
              <td class="stock">0</td>
              <td>₱45.00</td>
            </tr>

            <tr>
              <td>Dogibeef 5kg</td>
              <td>Dog Food</td>
              <td class="stock">20</td>
              <td>₱300.00</td>
            </tr>
          </tbody>
        </table>
      </div>
  </div>

  <script src="js/stockCells.js"></script>
</body>
</html>