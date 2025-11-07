<?php
$conn = new mysqli("localhost", "root", "", "sales_inventory");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
