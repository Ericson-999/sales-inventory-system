<?php
session_start();
include '../config/db_connect.php';

$username = $_POST['username'];
$password = $_POST['password'];

// Look up user by username
$sql = "SELECT * FROM users WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();   
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    // Verify password using password_verify
    if (password_verify($password, $row['password'])) {
        $_SESSION['username']  = $row['username'];
        $_SESSION['name']      = $row['name'];
        $_SESSION['user_type'] = $row['user_type']; // 'admin' or 'staff'

        header("Location: ../../frontend/home.php");
        exit();
    } else {
        $_SESSION['login_error'] = "Invalid username or password.";
        header("Location: ../../frontend/login.php");
        exit();
    }
} else {
    $_SESSION['login_error'] = "Invalid username or password.";
    header("Location: ../../frontend/login.php");
    exit();
}
?>
