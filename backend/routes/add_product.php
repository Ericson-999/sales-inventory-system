<?php
include '../config/db_connect.php';

$sku = $_POST['sku'];
$category = $_POST['category'];
$product_name = $_POST['product_name'];
$description = $_POST['description'];
$product_price = $_POST['product_price'];


$sql = "INSERT INTO products (SKU, Category, Product_Name, Description, Product_Price)
        VALUES ('$sku', '$category', '$product_name', '$description', '$product_price')";

$conn->query($sql);
header("Location: ../../frontend/product_list.php");
?>
