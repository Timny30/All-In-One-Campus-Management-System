<?php
// Programmer Name: Mr.Tang Chee Kin (TP075642)
// Program Name: Logout Program
// Description: A function for all user to logout
// First written on: Monday, 2 June 2025
// Edited on: Wednesday, 2 July 2025
session_start();
session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UniSphere</title>
    <link rel="icon" href="img/UniSphere.png" type="image/png">
</head>
<body>
<script>
    localStorage.setItem('theme', 'light');
    window.location.href = "Login.php";
</script>
</body>
</html>