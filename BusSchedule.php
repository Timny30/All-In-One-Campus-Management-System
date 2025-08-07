<?php
// Programmer Name: Mr.Tan Yik Yang (TP075377)
// Program Name: Bus Schedule
// Description: A interface for Lecturer and Student to view the bus schedule
// First written on: Monday, 2 June 2025
// Edited on: Wednesday, 2 July 2025
    session_start();
    include 'connection.php';
    include "getNotifications.php";

    $userType = '';
    if (isset($_SESSION['StudentID'])) {
        $userId = $_SESSION['StudentID'];
        $userType = 'Student';
    } elseif (isset($_SESSION['LecturerID'])) {
        $userId = $_SESSION['LecturerID'];
        $userType = 'Lecturer';
    } else {
        header("Location: Logout.php");
        exit;
    }

    $profilePage = '';

    if ($userType == 'Admin') {
        $profilePage = 'AdminProfile.php';
    } elseif ($userType == 'Lecturer') {
        $profilePage = 'LecturerProfile.php';
    } elseif ($userType == 'Student') {
        $profilePage = 'StudentProfile.php';
    }

    $profilePic = '';
    if ($userType == 'Admin') {
        $query = "SELECT ProfilePic, Name FROM admin_details WHERE AdminID = ?";
    } elseif ($userType == 'Lecturer') {
        $query = "SELECT ProfilePic, Name FROM lecturer_details WHERE LecturerID = ?";
    } elseif ($userType == 'Student') {
        $query = "SELECT ProfilePic, Name FROM student_details WHERE StudentID = ?";
    }

    $stmt = $connection->prepare($query);
    $stmt->bind_param("s", $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        $profilePic = $row['ProfilePic'];
        $userName = $row['Name'];
    } else {
        $profilePic = 'profile.png';
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UniSphere</title>
    <link rel="stylesheet" href="Navbar.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="BusSchedule.css?v=<?php echo time(); ?>">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href='https://cdn.boxicons.com/fonts/basic/boxicons.min.css' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="icon" href="img/UniSphere.png" type="image/png">
</head>
<body class="lightmode">
    <div class="background-overlay"></div>
    
    <header class="header">
        <div class="left-group">
            <div class="Logo hideOnMobile" onclick="showHomepage('<?php echo $userType; ?>')">
                <div class="circle red"></div>
                <div class="circle green"></div>
                <div class="circle blue"></div>
                <div class="umt-text">UMT</div>
            </div>
            <nav class="navbar hideOnMobile">
                <?php if ($userType === 'Admin'): ?>
                    <a href="IntakeTable.php">Manage Timetable</a>
                    <a href="Library.php">Library</a>
                    <a href="FeedbackList.php">Feedback Management</a>
                    <a href="CreateAcc.php">Account Creation</a>
                    <a href="MakeAnnouncement.php">Announcement</a>
                <?php elseif ($userType === 'Student'): ?>
                    <a href="StudentTimetable.php">Timetable</a>
                    <a href="Library.php">Library</a>
                    <a href="ChooseBookingType.php">Facility Reservation</a>
                    <a href="BusSchedule.php" class="Main-page">Transport Service</a>
                    <a href="submitFeedback.php">Feedback</a>
                <?php elseif ($userType ==='Lecturer'): ?>
                    <a href="LecturerTimetable.php">Timetable</a>
                    <a href="Library.php">Library</a>
                    <a href="ChooseBookingType.php">Facility Reservation</a>
                    <a href="BusSchedule.php" class="Main-page">Transport Service</a>
                    <a href="submitFeedback.php">Feedback</a>
                <?php else: ?>
                    <a href="Logout.php">Logout</a>
                <?php endif; ?>
            </nav>
        </div>

        <div class="menu-btn" onclick="showSidebar('.sidebar')">
            <a href="#"><i class='bx bx-menu'></i></a>
        </div>

        <div class="right-group">
            <div class="icon-wrapper notification-wrapper" onclick="goToNotifications()">
                <i class='bx bx-bell'></i>
                <?php if ($notificationCount > 0): ?>
                    <span class="notification-badge">
                        <?php echo ($notificationCount > 99) ? '99+' : $notificationCount; ?>
                    </span>
                <?php endif; ?>
            </div>
            <div class="icon-wrapper themeToggle">
                <i id="theme" class='bx bx-sun'></i> 
            </div>
            <a href="Logout.php" class="icon-wrapper">
                <i class='bx bx-arrow-out-right-square-half'></i> 
            </a>
            <a href="<?php echo $profilePage; ?>" class="Profile icon-wrapper">
                <img src="img/<?php echo htmlspecialchars($profilePic); ?>" alt="User Profile">
            </a>
        </div>
    </header>

    <header class="sidebar">
        <div class="close" onclick="hideSidebar('.sidebar')">
            <i class='bx bx-x'></i>
        </div>
        <div class="Logo" onclick="showHomepage('<?php echo $userType; ?>')">
            <div class="circle red"></div>
            <div class="circle green"></div>
            <div class="circle blue"></div>
            <div class="umt-text">UMT</div>
        </div>
        <nav class="navbar">
             <?php if ($userType === 'Admin'): ?>
                    <a href="IntakeTable.php">Manage Timetable</a>
                    <a href="Library.php">Library</a>
                    <a href="FeedbackList.php">Feedback Management</a>
                    <a href="CreateAcc.php">Account Creation</a>
                    <a href="MakeAnnouncement.php">Announcement</a>
                <?php elseif ($userType === 'Student'): ?>
                    <a href="StudentTimetable.php">Timetable</a>
                    <a href="Library.php">Library</a>
                    <a href="ChooseBookingType.php">Facility Reservation</a>
                    <a href="BusSchedule.php" class="Main-page">Transport Service</a>
                    <a href="submitFeedback.php">Feedback</a>
                <?php elseif ($userType ==='Lecturer'): ?>
                    <a href="LecturerTimetable.php">Timetable</a>
                    <a href="Library.php">Library</a>
                    <a href="ChooseBookingType.php" class="Main-page">Facility Reservation</a>
                    <a href="BusSchedule.php">Transport Service</a>
                    <a href="submitFeedback.php">Feedback</a>
                <?php else: ?>
                    <a href="Logout.php">Logout</a>
                <?php endif; ?>
            </nav>
    </header>

    <div class="schedule-section">
        <div class="toggle-wrapper">
            <div class="toggle-container">
                <p>Show All</p>
                <label class="switch">
                    <input type="checkbox" id="showAllToggle"/>
                    <span class="slider round"></span>
                </label>
            </div>
        </div>
        <div class="schedule-container">
            <div class="LRTtoUMT-schedule-container">
                <div class="schedule-head">
                    <h3><span class="material-icons">school</span> UMT &#9654; <span class="material-icons">train</span> LRT</h3>
                    <div class="countdown-container">
                        <p class="countdown-font">Countdown: <span id="countdown-lrt"></span></p>
                    </div>
                </div>
                <div class="schedule-body">
                    <p class="no-trip-message" id="no-trip-lrt">No Upcoming Trips</p>
                    <?php
                        $query = 'SELECT * from bus_schedule WHERE Origin = "UMT" and Destination = "LRT"';
                        $results = mysqli_query($connection,$query);
                        if ($results){
                            while ($row = mysqli_fetch_assoc($results)){
                                echo "<div>".  $row['Time']."</div>";
                            }
                        }
                        else{
                            echo "No schedule found";
                        }
                    ?>
                </div>
            </div>

            <div class="UMTtoLRT-schedule-container">
                <div class="schedule-head">
                    <h3><span class="material-icons">train</span> LRT  &#9654; <span class="material-icons">school</span> UMT </h3>
                    <div class="countdown-container">
                        <p class="countdown-font">Countdown: <span id="countdown-umt"></span></p>
                    </div>
                </div>
                <div class="schedule-body">
                    <p class="no-trip-message" id="no-trip-lrt">No Upcoming Trips</p>
                    <?php
                        $query = 'SELECT * from bus_schedule WHERE Origin = "LRT" and Destination = "UMT"';
                        $results = mysqli_query($connection,$query);
                        if ($results){
                            while ($row = mysqli_fetch_assoc($results)){
                                echo "<div>".  $row['Time']."</div>";
                            }
                        }
                        else{
                            echo "No schedule found";
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <script src="Navbar.js?v=<?php echo time(); ?>"></script>
    <script src="BusSchedule.js?v=<?php echo time(); ?>"></script>

</body>

</html>
<?php
    mysqli_close($connection);
?>