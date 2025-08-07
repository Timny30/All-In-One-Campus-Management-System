// Programmer Name: Mr.Tang Chee Kin (TP075642)
// Program Name: Navbar Program
// Description: A Navbar that allow user to navigate to other interface
// First written on: Monday, 2 June 2025
// Edited on: Wednesday, 2 July 2025

function showHomepage(userType) {
    if (userType === 'Admin') {
        window.location.href = 'AdminHomepage.php';
    } else if (userType === 'Student') {
        window.location.href = 'StudentHomepage.php';
    } else if (userType === 'Lecturer') {
        window.location.href = 'LecturerHomepage.php';
    }
}

function goToNotifications() {
    window.location.href = 'Announcements.php';
}

function showSidebar(sidebarClass) {
  const sidebar = document.querySelector(sidebarClass);
  if (sidebar) {
      sidebar.classList.add('active');
  }
}

function hideSidebar(sidebarClass) {
    const sidebar = document.querySelector(sidebarClass);
    if (sidebar) {
        sidebar.classList.remove('active');
    }
}

document.addEventListener("DOMContentLoaded", function () {
    const body = document.body;
    const icon = document.getElementById("theme");
    const savedTheme = localStorage.getItem("theme") || "light";

    setTheme(savedTheme);

    document.querySelector(".themeToggle").addEventListener("click", function () {
        const currentTheme = body.classList.contains("darkmode") ? "dark" : "light";
        const newTheme = currentTheme === "dark" ? "light" : "dark";
        setTheme(newTheme);
    });

    function setTheme(theme){
        if (theme === "dark") {
            icon.classList.remove("bx-sun");
            icon.classList.add("bx-moon");
            body.classList.remove("lightmode");
            body.classList.add("darkmode");
        } else {
            icon.classList.remove("bx-moon");
            icon.classList.add("bx-sun");
            body.classList.remove("darkmode");
            body.classList.add("lightmode");
        }
        localStorage.setItem("theme", theme);
    }
})

window.addEventListener("pageshow", function(event) { 
    if (event.persisted) {
        location.reload();
    }
});

