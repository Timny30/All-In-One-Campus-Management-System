// Programmer Name: Mr.Tan Yik Yang (TP075377)
// Program Name: Show & Hide Password Program
// Description: A function that show and hide the password
// First written on: Monday, 2 June 2025
// Edited on: Wednesday, 2 July 2025

function showHidePassword(input_id,toggle_id){
    const passwordInput = document.getElementById(input_id);
    const togglePassword = document.getElementById(toggle_id);
    const isPassword = passwordInput.type === "password";
        if (isPassword){
            passwordInput.type = "text";
            togglePassword.textContent = "visibility";

        }
        else{
            passwordInput.type = "password";
            togglePassword.textContent = "visibility_off";
}}
  

