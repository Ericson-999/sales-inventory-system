<?php
include '../config/db_connect.php';

$id = $_POST['id'];
$sku = $_POST['sku'];
$category = $_POST['category'];
$product_name = $_POST['product_name'];
$description = $_POST['description'];
$product_price = $_POST['product_price'];

$stmt = $conn->prepare("UPDATE products SET sku=?, category=?, product_name=?, description=?, product_price=? WHERE id=?");
$stmt->bind_param("ssssdi", $sku, $category, $product_name, $description, $product_price, $id);
if ($stmt->execute()) {
    // ✅ Insert redirect here
    header("Location: ../../frontend/product_list.php?edit_success=1");
    exit();
  } else {
    echo "Update failed: " . $stmt->error;
  }

  $stmt->close();
  $conn->close();
?>
