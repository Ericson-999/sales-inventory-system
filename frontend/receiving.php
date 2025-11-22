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

      <div class="container">
        <h2>Manage Receiving</h2>
        <div class="form-section">
            <h3>New Receiving</h3>
            <div class="form-group">
                <label for="supplier">Supplier</label>
                <select id="supplier" name="supplier">
                    <option value="">Please Select</option>
                    <option value="add_new_supplier">Add New Supplier</option>
                    <option value="supplier1">Supplier 1</option>
                    <option value="supplier2">Supplier 2</option>
                    <option value="supplier3">Supplier 3</option>
                </select>
                <div id="newSupplierInput" style="display: none;">
                    <label for="newSupplierName">New Supplier Name:</label>
                    <input type="text" id="newSupplierName" name="newSupplierName">
                    <button class="button" onclick="addNewSupplier()">Add Supplier</button>
                </div>
            </div>
            <div class="form-group">
                <label for="product">Product</label>
                <select id="product" name="product">
                    <option value="">Please select here</option>
                    <option value="add_new_product">Add New Product</option>
                    <option value="powdered_milk">Powdered Milk - Sample product</option>
                    <option value="chips_big">Chips (Big)</option>
                    <option value="lemon_iced_tea">Lemon Iced Tea</option>
                    <!-- Add product options as needed -->
                </select>
                <div id="newProductInput" style="display: none;">
                    <label for="newProductName">New Product Name:</label>
                    <input type="text" id="newProductName" name="newProductName">
                    <button class="button" onclick="addNewProduct()">Add Product</button>
                </div>
            </div>
            <div class="form-group">
                <label for="qty">Qty</label>
                <input type="number" id="qty" name="qty" min="1">
            </div>
            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" id="price" name="price" step="0.01" min="0.01">
            </div>
            <button class="button add-button" onclick="addProduct()">+ Add to List</button>
        </div>

        <div class="form-section">
            <h3>Product List</h3>
            <table id="productListTable">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Qty</th>
                        <th>Price</th>
                        <th>Amount</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3" style="text-align: right;"><strong>Total</strong></td>
                        <td id="totalAmount"><strong>0.00</strong></td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>
            <button class="button" onclick="saveData()">Save</button>
        </div>

        <div class="form-section">
            <h3>Receiving Entries</h3>
            <div style="margin-bottom: 10px;">
                Show
                <select>
                    <option>10</option>
                </select>
                entries
                <div style="float: right;">
                    Search:
                    <input type="text">
                </div>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Date</th>
                        <th>Reference #</th>
                        <th>Supplier</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="receivingEntriesBody">
                </tbody>
            </table>
            <div>
                Showing 1 to 2 of 2 entries
                <div style="float: right;">
                    Previous 1 Next
                </div>
            </div>
        </div>
    </div>

  </div>
  
  <script src="js/receiving.js"></script>
</body>
</html>