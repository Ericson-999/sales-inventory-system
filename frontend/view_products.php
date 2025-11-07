<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css">
  <link rel="stylesheet" href="style.css">
  <title>View Products</title>
</head>
<body>
  <?php
      include '../backend/config/db_connect.php';
      $result = $conn->query("SELECT * FROM products");
      echo "<table border='1'>";
      echo "<tr><th>Name</th><th>Category</th><th>Price</th><th>Qty</th><th>Actions</th></tr>";
      while ($row = $result->fetch_assoc()) {
        echo "<tr>
          <td>{$row['name']}</td>
          <td>{$row['category']}</td>
          <td>{$row['price']}</td>
          <td>{$row['quantity']}</td>
          <td>
            <a href='edit_product.php?id={$row['id']}'>Edit</a> |
            <a href='../backend/routes/delete_product.php?id={$row['id']}'>Delete</a>
          </td>
        </tr>";
      }
      echo "</table>";
?>
</body>
</html>


