<?php
include '../config/db_connect.php';

if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $conn->query("DELETE FROM supplier WHERE id=$id");
  http_response_code(200);
} else {
  http_response_code(400);
}
?>
