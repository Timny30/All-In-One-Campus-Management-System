<?php
// Programmer Name: Mr.Tang Chee Kin (TP075642)
// Program Name: Connection
// Description: A function for securely connection to UniShpere Database
// First written on: Monday, 2 June 2025
// Edited on: Wednesday, 2 July 2025
    $server = 'localhost'; 
    $user = 'root';
    $password = '';
    $database = 'unisphere';

    $connection = mysqli_connect($server, $user, $password, $database);

    if ($connection == false) {
        die('Connection failed!' . mysqli_connect_error());
    }
?>