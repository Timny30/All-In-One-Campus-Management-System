// Programmer Name: Mr.Timothy Ng Chong Sheng (TP075320)
// Program Name: Intake Timetable
// Description: A Intake Timetable for Administrator to manage
// First written on: Monday, 2 June 2025
// Edited on: Wednesday, 2 July 2025

function filterTable() {
const input = document.getElementById("searchInput");
const filter = input.value.toUpperCase();
const rows = document.querySelectorAll(".table-body .table-row");

rows.forEach(row => {
  const intakeCell = row.querySelector(".column");
  if (intakeCell) {
  const txtValue = intakeCell.textContent || intakeCell.innerText;
  if (txtValue.toUpperCase().indexOf(filter) > -1) {
      row.style.display = "";
  } else {
      row.style.display = "none";
  }
  }
  });
}