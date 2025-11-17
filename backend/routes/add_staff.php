<?php
include 'auth.php';

include '../config/db_connect.php';

$name      = $_POST['name'];
$username  = $_POST['username'];
$password  = password_hash($_POST['password'], PASSWORD_DEFAULT);
$user_type = $_POST['user_type'];

$sql = "INSERT INTO users (name, username, password, user_type) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $name, $username, $password, $user_type);

if ($stmt->execute()) {
    header("Location: ../../frontend/staff_list.php");
    exit();
} else {
    echo "Error: " . $stmt->error;
}
?>
