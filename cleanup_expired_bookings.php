<?php
// Programmer Name: Mr.Sylvester Ng Jun Hong (TP076143)
// Program Name: Clean expired booking
// Description: A function for remove the facility reservation in the database weekly
// First written on: Monday, 2 June 2025
// Edited on: Wednesday, 2 July 2025
function deleteExpiredBookings($connection) {
    $today = date('Y-m-d');
    $sql = "DELETE FROM bookingtable WHERE booked_date < ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("s", $today);
    $stmt->execute();
    $stmt->close();
}
?>