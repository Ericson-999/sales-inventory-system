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
  <script src="js/modal.js"></script>
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

    <!-- Add New User Button -->
    <div style="margin: 30px;">
      <button onclick="openModal()">Add New User</button>
    </div>

    <!-- Modal -->
    <div id="userModal" class="modal">
      <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <h2 id="modalTitle">New User</h2>
        <form id="userForm" action="/sales-inventory-system/backend/routes/add_staff.php" method="POST">
          <input type="hidden" name="id" id="userId">
          <label>Name</label>
          <input type="text" id="name" name="name" placeholder="Enter Name" required>

          <label>Username</label>
          <input type="text" id="username" name="username" placeholder="eSample" required>

          <label>Password</label>
          <input type="password" id="password" name="password" placeholder="********" required>

          <label>User Type</label>
          <select name="user_type" id="userType" required>
            <option value="admin">Admin</option>
            <option value="staff">Staff</option>
          </select>

          <div class="modal-buttons">
            <button type="submit">Save</button>
            <button type="button" onclick="closeModal()">Cancel</button>
          </div>
        </form>

      </div>
    </div>

    <!-- User Table -->
    <div class="product-list">
      <?php
      include '../backend/config/db_connect.php';
      $result = $conn->query("SELECT * FROM users");

      echo "<table class='product-summary-table'>";
      echo "<thead>
              <tr>
                <th>#</th>
                <th>User Info</th>
                <th>Action</th>
              </tr>
            </thead><tbody>";

      while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>{$row['id']}</td>";
        echo "<td>
                <strong>Name:</strong> {$row['name']}<br>
                <strong>Username:</strong> {$row['username']}
              </td>";
        echo "<td>
                <a href='edit_staff.php?edit_id={$row['id']}' class='btn-edit'>Edit</a>
                <button class='btn-delete' data-id='{$row['id']}'>Delete</button>
              </td>";
        echo "</tr>";
      }

      echo "</tbody></table>";
      ?>
    </div>
  </div>

  <script src="js/deleteStaff.js"></script>
  <script src="js/editStaff.js"></script>

</body>
</html>
