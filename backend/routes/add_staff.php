<?php
include 'auth.php';
include '../config/db_connect.php';

$name      = $_POST['name'];
$username  = $_POST['username'];
$password  = password_hash($_POST['password'], PASSWORD_DEFAULT);
$user_type = $_POST['user_type'];

// ✅ Check if username already exists
$check = $conn->prepare("SELECT id FROM users WHERE username = ?");
$check->bind_param("s", $username);
$check->execute();
$check->store_result();

if ($check->num_rows > 0) {
    echo json_encode(["success" => false, "error" => "Username already exists."]);
    exit();
}

// ✅ Proceed with insert if username is unique
$sql = "INSERT INTO users (name, username, password, user_type) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $name, $username, $password, $user_type);

if ($stmt->execute()) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false, "error" => $stmt->error]);
}

$stmt->close();
$conn->close();
?>
