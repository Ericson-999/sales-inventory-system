<?php
include '../backend/routes/auth.php';
include '../backend/config/db_connect.php';

$displayName = isset($_SESSION['name']) ? $_SESSION['name'] : $_SESSION['username'];

$customerQuery = $conn->query("SELECT * FROM customer ORDER BY id DESC");
$customers = $customerQuery->fetch_all(MYSQLI_ASSOC);
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

      <div class="customer-box">
        <h2 class="customer-head">Customer Management</h2>

        <!-- Customer Form -->
        <form action="../backend/routes/add_customer.php" method="POST" class="customer-form">
          <div class="form-row">
            <label for="name">Customer Name</label>
            <input type="text" name="name" required>
          </div>
          <div class="form-row">
            <label for="contact">Contact</label>
            <input type="text" name="contact">
          </div>
          <div class="form-row">
            <label for="address">Address</label>
            <input type="text" name="address">
          </div>
          <div class="form-actions">
            <button type="submit" class="save-btn">Save</button>
            <button type="reset" class="cancel-btn">Cancel</button>
          </div>
        </form>

        <!-- Customer List -->
        <table class="customer-table">
          <thead>
            <tr>
              <th>#</th>
              <th>Customer</th>
              <th>Contact</th>
              <th>Address</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($customers as $index => $customer): ?>
              <tr>
                <td><?php echo $index + 1; ?></td>
                <td><?php echo $customer['name']; ?></td>
                <td><?php echo $customer['contact']; ?></td>
                <td><?php echo $customer['address']; ?></td>
                <td>
                  <a href="edit_customer.php?id=<?php echo $customer['id']; ?>" class="edit-btn">Edit</a>
                  <a href="../backend/routes/delete_customer.php?id=<?php echo $customer['id']; ?>" class="delete-btn" onclick="return confirm('Delete this customer?')">Delete</a>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>



  </div>
  
</body>
</html>