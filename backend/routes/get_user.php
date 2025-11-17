<?php
include '../config/db_connect.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $result = $conn->query("SELECT * FROM users WHERE id=$id");

    if ($result && $result->num_rows > 0) {
        echo json_encode($result->fetch_assoc());
    } else {
        echo json_encode(null);
    }
}
?>
