<?php
// Programmer Name: Mr.Timothy Ng Chong Sheng (TP075320)
// Program Name: Get Holiday Infomation
// Description: A function to sort out all the Holiday
// First written on: Monday, 2 June 2025
// Edited on: Wednesday, 2 July 2025
    header('Content-Type: application/json');
    include "connection.php"; 

    $query = "SELECT * FROM holiday_schedule";
    $holiday_record = mysqli_query($connection, $query); 

    $holiday_list = [];

    while($holiday_info = mysqli_fetch_assoc($holiday_record)) {
        $holiday_list[] = $holiday_info;
    }

    echo json_encode(array_column($holiday_list, 'Date')); 
?>
