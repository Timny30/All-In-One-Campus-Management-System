// Programmer Name: Mr.Tang Chee Kin (TP075642)
// Program Name: My Booking
// Description: A Pop up window for Lecturer and Student to view the booking they made
// First written on: Monday, 2 June 2025
// Edited on: Wednesday, 2 July 2025

document.addEventListener("DOMContentLoaded", function () {
    const body = document.body;
    const savedTheme = localStorage.getItem("theme") || "light";

    setTheme(savedTheme);

    function setTheme(theme){
        if (theme === "dark") {
            body.classList.remove("lightmode");
            body.classList.add("darkmode");
        } else {
            body.classList.remove("darkmode");
            body.classList.add("lightmode");
        }
        localStorage.setItem("theme", theme);
    }
})


