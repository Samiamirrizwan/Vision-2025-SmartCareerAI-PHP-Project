
// JavaScript for mobile menu toggle for Index.php
const mobileMenuButton = document.getElementById('mobile-menu-button');
const mobileMenu = document.getElementById('mobile-menu');
mobileMenuButton.addEventListener('click', () => {
mobileMenu.classList.toggle('hidden');
});

// Responsive System *** Starts
console.log("SmartCareerAI loaded");
document.addEventListener("DOMContentLoaded", () => {
  console.log("Responsive system ready.");
});
// Responsive System *** ends



// Login Form JS *** starts
const togglePassword = document.querySelector('#togglePassword');
const password = document.querySelector('#password');
togglePassword.addEventListener('click', function (e) {
// toggle the type attribute
  const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
  password.setAttribute('type', type);
// toggle the eye slash icon
  this.classList.toggle('fa-eye-slash');
});

// Login Form JS *** ends
