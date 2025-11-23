<?php
// Delete endpoint: ../backend/routes/delete_category.php
header('Content-Type: application/json');          // ensure JSON header
// Turn off notices in output (log instead) to keep JSON clean
// ini_set('display_errors', 0);

include '../config/db_connect.php';

if (!isset($_POST['id']) || $_POST['id'] === '') {
  echo json_encode(["success" => false, "error" => "Missing id"]);
  exit;
}

$id = intval($_POST['id']);
$stmt = $conn->prepare("DELETE FROM category WHERE id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false, "error" => $stmt->error]);
}

?>