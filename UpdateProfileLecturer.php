<?php
// Programmer Name: Mr.Wan Hon Kit (TP075041)
// Program Name: Update Lecturer Profile
// Description: A function that store and insert lecturer profile to database
// First written on: Monday, 2 June 2025
// Edited on: Wednesday, 2 July 2025 
session_start();
include 'connection.php';

$lecturerID = $_SESSION['LecturerID'];

if (isset($_FILES['profilePic']) && $_FILES['profilePic']['error'] === UPLOAD_ERR_OK) {
    $fileTmpPath = $_FILES['profilePic']['tmp_name'];
    $fileName = $_FILES['profilePic']['name'];
    $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    $newFileName = $lecturerID . '_' . uniqid() . '.' . $fileExtension;
    $uploadDir = 'img/';
    $destPath = $uploadDir . $newFileName;

    $allowedExtensions = ['jpg', 'jpeg', 'png'];

    if (in_array($fileExtension, $allowedExtensions)) {
        if (move_uploaded_file($fileTmpPath, $destPath)) {

            $query = "UPDATE lecturer_details SET ProfilePic = ? WHERE LecturerID = ?";
            $stmt = $connection->prepare($query);
            $stmt->bind_param("ss", $newFileName, $lecturerID);
            $stmt->execute();
            $stmt->close();
            exit();
        } else {
            echo "Error moving the uploaded file.";
        }
    } else {
        echo "File type not allowed.";
    }
} else {
    echo "No file uploaded or upload error.";
}
?>
