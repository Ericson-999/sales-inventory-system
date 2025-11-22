<?php
$newPassword = 'Admin@123';
$hashed = password_hash($newPassword, PASSWORD_DEFAULT);
echo $hashed;
?>
