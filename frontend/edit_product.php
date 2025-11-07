<?php
include '../backend/config/db_connect.php';
$id = $_GET['id'];
$product = $conn->query("SELECT * FROM products WHERE id=$id")->fetch_assoc();
?>
<form action="../backend/routes/update_product.php" method="POST">
  <input type="hidden" name="id" value="<?= $id ?>" />
  <input type="text" name="name" value="<?= $product['name'] ?>" required />
  <input type="text" name="category" value="<?= $product['category'] ?>" required />
  <input type="number" name="price" value="<?= $product['price'] ?>" step="0.01" required />
  <input type="number" name="quantity" value="<?= $product['quantity'] ?>" required />
  <input type="submit" value="Update" />
</form>
