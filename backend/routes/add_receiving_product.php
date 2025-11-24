<?php
include '../backend/config/db_connect.php';

if (!empty($_POST['newProductName'])) {
    $newProduct = trim($_POST['newProductName']);
    $stmt = $conn->prepare("INSERT INTO receiving_products (product_name) VALUES (?)");
    $stmt->bind_param("s", $newProduct);
    $stmt->execute();
    echo "success";
}
?>
