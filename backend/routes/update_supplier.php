<?php
include '../config/db_connect.php';

$id = $_POST['id'];
$supplier_name = $_POST['supplier_name'];
$contact = $_POST['contact'];
$address = $_POST['address'];

$stmt = $conn->prepare("UPDATE supplier SET supplier_name=?, contact=?, address=? WHERE id=?");
$stmt->bind_param("sssi", $supplier_name, $contact, $address, $id);
if ($stmt->execute()) {
    // ✅ Insert redirect here
    header("Location: ../../frontend/supplier_list.php?edit_success=1");
    exit();
  } else {
    echo "Update failed: " . $stmt->error;
  }

  $stmt->close();
  $conn->close();
?>
