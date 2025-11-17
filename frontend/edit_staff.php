<?php
include '../backend/config/db_connect.php';

if (isset($_GET['edit_id'])) {
    $id = $_GET['edit_id'];
    $result = $conn->query("SELECT * FROM users WHERE id=$id");

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
    } else {
        die("User not found.");
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Edit Staff</title>
</head>
<body>
  <h2>Edit Staff</h2>
  <form action="../backend/routes/update_staff.php" method="POST">
    <input type="hidden" name="id" value="<?php echo $user['id']; ?>">

    <label>Name</label>
    <input type="text" name="name" value="<?php echo $user['name']; ?>" required>

    <label>Username</label>
    <input type="text" name="username" value="<?php echo $user['username']; ?>" required>

    <label>Password</label>
    <input type="password" name="password" placeholder="Enter new password">

    <button type="submit">Update</button>
  </form>
</body>
</html>
