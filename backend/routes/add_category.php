<?php
include '../config/db_connect.php';
$id = intval($_POST['id']);
$category = $_POST['category'];

$stmt = $conn->prepare("UPDATE category SET category = ? WHERE id = ?");
$stmt->bind_param("si", $category, $id);

if ($stmt->execute()) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false, "error" => $stmt->error]);
}
?>
