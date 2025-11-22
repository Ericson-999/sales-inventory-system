<?php
include '../backend/routes/auth.php';

$displayName = isset($_SESSION['name']) ? $_SESSION['name'] : $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
  <meta http-equiv="Pragma" content="no-cache">
  <meta http-equiv="Expires" content="0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css">
  <link rel="stylesheet" href="style.css">
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

    <?php
      include '../backend/config/db_connect.php';

      $editMode = false;
      $editData = [
        'id' => '',
        'sku' => '',
        'category' => '',
        'product_name' => '',
        'description' => '',
        'product_price' => ''
      ];

      if (isset($_GET['edit_id'])) {
        $editMode = true;
        $id = $_GET['edit_id'];
        $query = $conn->query("SELECT * FROM products WHERE id=$id");
        if ($query->num_rows > 0) {
          $editData = $query->fetch_assoc();
        }
      }
    ?>

    <div class="product-form-container">
      <form action="../backend/routes/<?php echo $editMode ? 'update_product.php' : 'add_product.php'; ?>" method="POST" class="product-form">
        <?php if ($editMode): ?>
          <input type="hidden" name="id" value="<?php echo $editData['id']; ?>" />
        <?php endif; ?>

        <label>SKU</label>
        <input type="text" name="sku" value="<?php echo $editData['sku']; ?>" placeholder="Enter SKU" required />

        <label>Category</label>
        <input list="category-options" name="category" value="<?php echo $editData['category']; ?>" placeholder="Select or type category" required />
        <datalist id="category-options">
          <option value="Drinks">
          <option value="Snacks">
          <option value="Can Goods">
          <option value="Hygiene">
          <option value="Shampoo">
          <option value="Milks">
        </datalist>

        <label>Product Name</label>
        <input type="text" name="product_name" value="<?php echo $editData['product_name']; ?>" placeholder="Enter product name" required />

        <label>Description</label>
        <input type="text" name="description" value="<?php echo $editData['description']; ?>" placeholder="Enter description" />

        <label>Price</label>
        <input type="number" name="product_price" value="<?php echo $editData['product_price']; ?>" placeholder="Enter price" step="0.01" required />

        <button type="submit"><?php echo $editMode ? 'Update Product' : 'Add Product'; ?></button>
      </form>
    </div>

    <div id="toast-container"></div>
    
    <div id="deleteProductModal" class="modal">
      <div class="modal-content">
        <h3>Confirm Deletion</h3>
        <p>Are you sure you want to delete this product?</p>
        <div class="modal-buttons">
          <button id="confirmProductDeleteBtn" class="btn btn-danger">Delete</button>
          <button type="button" onclick="closeProductDeleteModal()" class="btn btn-secondary">Cancel</button>
        </div>
      </div>
    </div>

    <div class="product-list">
      <?php
      include '../backend/config/db_connect.php';
      $result = $conn->query("SELECT * FROM products");

      echo "<table class='product-summary-table'>";
      echo "<thead>
              <tr>
                <th>#</th>
                <th>Product Info</th>
                <th>Action</th>
              </tr>
            </thead><tbody>";

      while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>{$row['id']}</td>";
        echo "<td>
                <strong>SKU:</strong> {$row['sku']}<br>
                <strong>Category:</strong> {$row['category']}<br>
                <strong>Name:</strong> {$row['product_name']}<br>
                <strong>Description:</strong> {$row['description']}<br>
                <strong>Price:</strong> ₱{$row['product_price']}
              </td>";
        echo "<td>
                <a href='product_list.php?edit_id={$row['id']}' class='btn-edit'>Edit</a>
                <button class='btn-delete' data-id='{$row['id']}'>Delete</button>
              </td>";
        echo "</tr>";
      }

      echo "</tbody></table>";
      ?>
    </div>
  </div>
  
  <script src="js/preventBack.js"></script>
  <script src="js/deleteProduct.js"></script>
  <script src="js/toast.js"></script>
</body>
</html>