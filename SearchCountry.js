// Programmer Name: Mr.Tan Yik Yang (TP075377)
// Program Name: Search Country
// Description: A function to sort out all the country
// First written on: Monday, 2 June 2025
// Edited on: Wednesday, 2 July 2025

fetch('https://restcountries.com/v3.1/all?fields=name')
    .then(response => response.json())
    .then(data => {
    const datalist = document.getElementById('countries');

    const sorted = data.sort((a, b) =>
        a.name.common.localeCompare(b.name.common)
    );

    sorted.forEach(country => {
        const option = document.createElement('option');
        option.value = country.name.common;
        datalist.appendChild(option);
    });
    })
    .catch(error => {
    console.error('Error fetching country list:', error);
    });



