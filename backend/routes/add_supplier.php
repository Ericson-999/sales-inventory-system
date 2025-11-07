<?php
include '../config/db_connect.php';

$supplier_name = $_POST['supplier_name'];
$contact = $_POST['contact'];
$address = $_POST['address'];


$sql = "INSERT INTO supplier (supplier_name, contact, address)
        VALUES ('$supplier_name', '$contact', '$address')";

$conn->query($sql);
header("Location: ../../frontend/supplier_list.php");
?>
