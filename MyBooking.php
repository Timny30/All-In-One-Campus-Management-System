<?php
// Programmer Name: Mr.Tang Chee Kin (TP075642)
// Program Name: My Booking
// Description: A Pop up window for Lecturer and Student to view the booking they made
// First written on: Monday, 2 June 2025
// Edited on: Wednesday, 2 July 2025
    session_start();
    include 'connection.php';

    $userType = '';
    if (isset($_SESSION['StudentID'])) {
        $userId = $_SESSION['StudentID'];
        $userType = 'Student';
        $Homepage = 'StudentHomepage.php';
    } elseif (isset($_SESSION['LecturerID'])) {
        $userId = $_SESSION['LecturerID'];
        $userType = 'Lecturer';
        $Homepage = 'LecturerHomepage.php';
    } else {
        header("Location: Logout.php");
        exit;
    }

    $sql = "
        SELECT b.booked_date, '9:00 am - 10:59 am' AS time_slot, f.Type AS facility_type
        FROM bookingtable b
        JOIN booking_slot1 s ON b.BookTableSlot1 = s.Slot1_ID
        JOIN facility_information f ON s.FacilityID = f.FacilityID
        WHERE b.UserID = ?

        UNION

        SELECT b.booked_date, '11:00 am - 12:59 pm' AS time_slot, f.Type AS facility_type
        FROM bookingtable b
        JOIN booking_slot2 s ON b.BookTableSlot2 = s.Slot2_ID
        JOIN facility_information f ON s.FacilityID = f.FacilityID
        WHERE b.UserID = ?

        UNION

        SELECT b.booked_date, '1:00 pm - 2:59 pm' AS time_slot, f.Type AS facility_type
        FROM bookingtable b
        JOIN booking_slot3 s ON b.BookTableSlot3 = s.Slot3_ID
        JOIN facility_information f ON s.FacilityID = f.FacilityID
        WHERE b.UserID = ?

        UNION

        SELECT b.booked_date, '3:00 pm - 4:59pm' AS time_slot, f.Type AS facility_type
        FROM bookingtable b
        JOIN booking_slot4 s ON b.BookTableSlot4 = s.Slot4_ID
        JOIN facility_information f ON s.FacilityID = f.FacilityID
        WHERE b.UserID = ?
        ORDER BY booked_date, time_slot
    ";

    $stmt = $connection->prepare($sql);
    $stmt->bind_param("ssss", $userId, $userId, $userId, $userId);
    $stmt->execute();
    $booking = $stmt->get_result();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UniSphere</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href='https://cdn.boxicons.com/fonts/basic/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="MyBooking.css?v=<?php echo time(); ?>">
    <link rel="icon" href="img/UniSphere.png" type="image/png">
</head>
<body class="lightmode">
    <iframe src="<?php echo $Homepage; ?>"></iframe>
    <div class="overlay"></div>
    
    <div class="Container">
        <a href="<?php echo $Homepage; ?>" class="close-btn"><i class='bx bx-chevron-left-circle'></i></a>
        <h1 class="header">My Booking</h1>

        <div class="booking-info">
            <?php if ($booking->num_rows > 0): ?>
                <?php while ($row = $booking->fetch_assoc()): ?>
                    <div class="booking-card">
                        <div class="row">
                            <span class="label">Venue:</span>
                            <span class="value"><?php echo htmlspecialchars($row['facility_type']); ?></span>
                        </div>
                        <div class="row">
                            <span class="label">Date:</span>
                            <span class="value"><?php echo htmlspecialchars($row['booked_date']); ?></span>
                        </div>
                        <div class="row">
                            <span class="label">Time:</span>
                            <span class="value"><?php echo htmlspecialchars($row['time_slot']); ?></span>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p style="margin-top: 20px; font-size: 1.2rem; color: var(--Text);">No booking available</p>
            <?php endif; ?>
        </div>
    </div>
    <script src="MyBooking.js?v=<?php echo time(); ?>"></script>
</body>
</html>