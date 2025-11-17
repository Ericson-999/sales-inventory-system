<?php
include '../config/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];

    if (!is_numeric($id)) {
        echo "invalid";
        exit;
    }

    $sql = "DELETE FROM users WHERE id = $id";

    if ($conn->query($sql)) {
        echo "success";
    } else {
        echo "error";
    }
} else {
    echo "missing";
}
?>
