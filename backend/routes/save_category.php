<?php
include '../config/db_connect.php';

$category = $_POST['category'] ?? null;
if (!$category) {
  echo json_encode(["success" => false, "error" => "Missing category"]);
  exit;
}

if (isset($_POST['id']) && $_POST['id'] !== '') {
    // Update
    $id = intval($_POST['id']);
    $stmt = $conn->prepare("UPDATE category SET category = ? WHERE id = ?");
    $stmt->bind_param("si", $category, $id);
    $ok = $stmt->execute();
    echo json_encode($ok ? ["success" => true, "id" => $id] : ["success" => false, "error" => $stmt->error]);
} else {
    // Add
    $stmt = $conn->prepare("INSERT INTO category (category) VALUES (?)");
    $stmt->bind_param("s", $category);
    $ok = $stmt->execute();
    if ($ok) {
      echo json_encode(["success" => true, "newId" => $stmt->insert_id]);
    } else {
      echo json_encode(["success" => false, "error" => $stmt->error]);
    }
}

?>
