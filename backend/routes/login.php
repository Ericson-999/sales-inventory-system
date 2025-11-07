<?php
session_start();
include '../config/db_connect.php';

$username = $_POST['username'];
$password = md5($_POST['password']);

$sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $_SESSION['username'] = $username;
    header("Location: ../../frontend/home.php");
} else {
    $_SESSION['login_error'] = "Invalid username or password.";
    header("Location: ../../frontend/login.php");
    exit();
}
?>
