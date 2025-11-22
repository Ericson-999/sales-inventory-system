<?php
include '../config/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = $_POST['name'];
  $contact = $_POST['contact'];
  $address = $_POST['address'];

  $stmt = $conn->prepare("INSERT INTO customer (name, contact, address) VALUES (?, ?, ?)");
  $stmt->bind_param("sss", $name, $contact, $address);
  $stmt->execute();

  header("Location: ../../frontend/customer_list.php");
  exit;
}
?>
