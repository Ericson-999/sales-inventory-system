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
  <script src="js/deleteSupplier.js"></script>
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
        'supplier_name' => '',
        'contact' => '',
        'address' => ''
      ];

      if (isset($_GET['edit_id'])) {
        $editMode = true;
        $id = $_GET['edit_id'];
        $query = $conn->query("SELECT * FROM supplier WHERE id=$id");
        if ($query->num_rows > 0) {
          $editData = $query->fetch_assoc();
        }
      }
    ?>

    <div class="product-form-container">
      <form action="../backend/routes/<?php echo $editMode ? 'update_supplier.php' : 'add_supplier.php'; ?>" method="POST" class="product-form">
        <?php if ($editMode): ?>
          <input type="hidden" name="id" value="<?php echo $editData['id']; ?>" />
        <?php endif; ?>

        <label>Supplier Name</label>
        <input type="text" name="supplier_name" value="<?php echo $editData['supplier_name']; ?>" placeholder="Enter Supplier Name" required />

        <label>Contact</label>
        <input type="text" name="contact" value="<?php echo $editData['contact']; ?>" placeholder="Enter Contact" required />

        <label class="supplier-address">Address</label>
        <textarea name="address" rows="4" placeholder="Enter Address"><?php echo $editData['address'] ?? ''; ?></textarea>

        <button type="submit"><?php echo $editMode ? 'Update Product' : 'Add Product'; ?></button>
      </form>
    </div>


    <div class="product-list">
      <?php
      include '../backend/config/db_connect.php';
      $result = $conn->query("SELECT * FROM supplier");

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
                <strong>Supplier Name:</strong> {$row['supplier_name']}<br>
                <strong>Contact:</strong> {$row['contact']}<br>
                <strong>Address:</strong> {$row['address']}<br>
              </td>";
        echo "<td>
                <a href='supplier_list.php?edit_id={$row['id']}' class='btn-edit'>Edit</a>
                <button class='btn-delete' data-id='{$row['id']}'>Delete</button>
              </td>";
        echo "</tr>";
      }

      echo "</tbody></table>";
      ?>
    </div>

  </div>
  
</body>
</html>