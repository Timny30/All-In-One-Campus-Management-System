/* Programmer Name: Mr.Timothy Ng Chong Sheng (TP075320)
Program Name: Admin Timetable
Description: A specific Intake Timetable for Administrator to manage
First written on: Monday, 2 June 2025
Edited on: Wednesday, 2 July 2025  */

let timetableData = {};

document.addEventListener("DOMContentLoaded", function() {
    const isPost = window.isPost;
    const weekInput = document.getElementById('selectedWeekInput');
    const dayInput = document.getElementById('selectedDayInput');
    const weekButton = document.getElementById('selectedWeek');
    const dayButton = document.getElementById('selectedDay');
    
    function getSurroundingWeeks() {

        const today = new Date();

        const currentYear = today.getFullYear();
        const currentMonth = today.getMonth(); 

        const previousMonth = currentMonth === 0 ? 11 : currentMonth - 1;

        const firstOfMonth = new Date(currentYear, currentMonth, 1);

        let dayOfWeek = firstOfMonth.getDay(); 
        dayOfWeek = (dayOfWeek === 0) ? 6 : dayOfWeek - 1;
        const firstWeekStartDate = new Date(firstOfMonth);
        firstWeekStartDate.setDate(firstOfMonth.getDate() - dayOfWeek);

        const firstWeekDayNumber = firstWeekStartDate.getDate();

        const startDate = new Date(currentYear, previousMonth, firstWeekDayNumber);
        const weeks = [];

        for (let i = 0; i < 5; i++) {
            const weekStart = new Date(startDate);
            weekStart.setDate(startDate.getDate() + (i * 7));
            
            const weekEnd = new Date(weekStart);
            weekEnd.setDate(weekStart.getDate() + 4);
            
            const key = formatDate(weekStart) + ' - ' + formatDate(weekEnd);
            weeks.push({
                key,
                start: weekStart,
                end: weekEnd
            });
        }
        return weeks;
    }

    function formatDate(date) {
        const day = date.getDate();
        const month = date.toLocaleString('default', { month: 'short' });
        return `${day} ${month}`;
    }

    function populateWeekDropdown(selectedWeek) {
        const dropdown = document.getElementById("Dropdown");
        dropdown.innerHTML = "";
        
        const weeks = getSurroundingWeeks();
        weeks.forEach(week => {
            const option = document.createElement("a");
            option.href = "#";
            option.textContent = week.key;
            if (week.key === selectedWeek) {
                option.style.fontWeight = "bold";
            }
            option.onclick = (e) => {
                e.preventDefault();
                selectWeek(week.key);
            };
            dropdown.appendChild(option);
        });
    }

    function populateDayDropdown(selectedDay) {
        const dropdown = document.getElementById("DayDropdown");
        dropdown.innerHTML = "";
        
        const days = ["All Days", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday"];
        days.forEach(day => {
            const option = document.createElement("a");
            option.href = "#";
            option.textContent = day;
            if (day === selectedDay) {
                option.style.fontWeight = "bold";
            }
            option.onclick = (e) => {
                e.preventDefault();
                selectDay(day);
            };
            dropdown.appendChild(option);
        });
    }

    function toggleWeekDropdown() {
        document.getElementById("Dropdown").classList.toggle("show");
    }

    function toggleDayDropdown() {
        document.getElementById("DayDropdown").classList.toggle("show");
    }

    function selectWeek(weekKey) {
        weekInput.value = weekKey;
        weekButton.textContent = weekKey;
        sessionStorage.setItem('selectedWeek', weekKey);
        document.getElementById("Dropdown").classList.remove("show");
        document.getElementById("timetableForm").submit();
    }

    function selectDay(day) {
        const currentWeek = sessionStorage.getItem('selectedWeek') || weekButton.textContent;
        weekInput.value = currentWeek;
        dayInput.value = day;
        dayButton.textContent = day;
        sessionStorage.setItem('selectedDay', day);
        document.getElementById("DayDropdown").classList.remove("show");
        document.getElementById("timetableForm").submit();
    }

    const storedWeek = sessionStorage.getItem('selectedWeek');
    const storedDay = sessionStorage.getItem('selectedDay') || 'All Days';

    if (!isPost) {
        const storedWeek = sessionStorage.getItem('selectedWeek');
        const storedDay = sessionStorage.getItem('selectedDay') || 'All Days';

        if (storedWeek) {
            weekButton.textContent = storedWeek;
            weekInput.value = storedWeek;
        }

        if (storedDay) {
            dayButton.textContent = storedDay;
            dayInput.value = storedDay;
        }

        populateWeekDropdown(storedWeek);
        populateDayDropdown(storedDay);
    } else {
        populateWeekDropdown(weekInput.value);
        populateDayDropdown(dayInput.value);
    }

    weekButton.onclick = toggleWeekDropdown;
    dayButton.onclick = toggleDayDropdown;

    window.onclick = function(event) {
        if (!event.target.matches('.dropbtn')) {
            const dropdowns = document.getElementsByClassName("dropdown-content");
            for (const dropdown of dropdowns) {
                if (dropdown.classList.contains('show')) {
                    dropdown.classList.remove('show');
                }
            }
        }
    };

    window.selectWeek = selectWeek;
    window.selectDay = selectDay;
    window.toggleWeekDropdown = toggleWeekDropdown;
    window.toggleDayDropdown = toggleDayDropdown;

    const today = new Date();
    today.setHours(0, 0, 0, 0);

    const weekText = document.getElementById("selectedWeek")?.textContent || "";

    if (weekText.includes(" - ")) {
        const endDateStr = weekText.split(" - ")[1]; 
        const currentYear = today.getFullYear();

        const endDate = new Date(`${endDateStr} ${currentYear}`);
        endDate.setHours(0, 0, 0, 0);

        if (today > endDate) {
            const editButtons = document.querySelectorAll('.edit-btn');
            editButtons.forEach(btn => {
                btn.style.display = 'none';
            });
        }
    }
});

