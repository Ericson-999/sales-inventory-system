<?php
include '../config/db_connect.php';

$id = $_POST['id'];
$name = $_POST['name'];
$username = $_POST['username'];
$password = $_POST['password'];
$user_type = $_POST['user_type'];

if (!empty($password)) {
    $hashed = password_hash($password, PASSWORD_DEFAULT);
    $sql = "UPDATE users SET name='$name', username='$username', password='$hashed', user_type='$user_type' WHERE id=$id";
} else {
    $sql = "UPDATE users SET name='$name', username='$username', user_type='$user_type' WHERE id=$id";
}

$conn->query($sql);
header("Location: ../../frontend/staff_list.php");
?>
