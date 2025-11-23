<?php
include '../backend/routes/auth.php';
include '../backend/config/db_connect.php';

$displayName = isset($_SESSION['name']) ? $_SESSION['name'] : $_SESSION['username'];

$customerQuery = $conn->query("SELECT * FROM customer");
$customers = $customerQuery->fetch_all(MYSQLI_ASSOC);

$productQuery = $conn->query("SELECT * FROM products");
$products = $productQuery->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="css/all.min.css">
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

      <div class="content-container"> 
      <div class="sales-box">
        <h2>Sales</h2>

        <!-- Hidden fields -->
        <input type="hidden" id="reference-number" value="<?php echo uniqid('ref_'); ?>">
        <input type="hidden" id="staff-id" value="<?php echo isset($_SESSION['user_id']) ? $_SESSION['user_id'] : ''; ?>">

        <!-- Customer -->
        <div class="form-row">
          <label for="customer-select">Customer</label>
          <select id="customer-select">
            <?php foreach ($customers as $customer): ?>
              <option value="<?php echo $customer['id']; ?>"><?php echo $customer['name']; ?></option>
            <?php endforeach; ?>
          </select>
        </div>

        <!-- Product, Qty -->
        <div class="form-row product-input-row">
          <div class="product-select-group">
            <label for="product-select">Product</label>
            <select id="product-select">
              <?php foreach ($products as $product): ?>
                <option value="<?php echo $product['id']; ?>" data-price="<?php echo $product['product_price']; ?>">
                  <?php echo $product['product_name']; ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="qty-input-group">
            <label for="product-qty">Qty</label>
            <input type="number" id="product-qty" min="1" value="1">
          </div>
          <button type="button" class="add-to-list-btn">+ Add to List</button>
        </div>

        <!-- Sales list table -->
        <div class="sales-table-container">
          <table>
            <thead>
              <tr>
                <th>Product</th><th>Qty</th><th>Price</th><th>Amount</th><th></th>
              </tr>
            </thead>
            <tbody id="sales-list-body"></tbody>
            <tfoot>
              <tr>
                <td colspan="3" class="total-label">Total</td>
                <td colspan="2" class="total-amount" id="total-sales-amount">0.00</td>
              </tr>
            </tfoot>
          </table>
        </div>

        <button type="button" class="pay-btn">Pay</button>
      </div>
    </div>
  </div>
  
  <script src="js/preventBack.js"></script>
  <script src="js/sales.js"></script>
</body>
</html>