function validateForm() {
  // Get form inputs
  const email = document.querySelector("input[name='email']").value.trim();
  const password = document.querySelector("input[name='password']").value.trim();
  const errorMessage = document.getElementById("error-message");

  // Regular expression for email validation
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

  // Clear previous error messages
  errorMessage.textContent = "";

  // Validation checks
  if (email === "") {
    errorMessage.textContent = "Email is required.";
    return false; // Prevent form submission
  }

  if (!emailRegex.test(email)) {
    errorMessage.textContent = "Please enter a valid email address.";
    return false; // Prevent form submission
  }

  if (password === "") {
    errorMessage.textContent = "Password is required.";
    return false; // Prevent form submission
  }

  return true; // Allow form submission if all validations pass
}

function openPage() {
  window.location.href = "signup.html"; 
} 

document.getElementById('signup-form').addEventListener('submit', function (event) {
  // Get form elements
  const name = document.getElementById('name').value.trim();
  const email = document.getElementById('email').value.trim();
  const password = document.getElementById('password').value;
  const confirmPassword = document.getElementById('confirm-password').value;

  // Regular expression for email validation
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

  // Validation logic
  if (name === '') {
    alert('Name is required.');
    event.preventDefault();
    return;
  }

  if (email === '' || !emailRegex.test(email)) {
    alert('Please enter a valid email address.');
    event.preventDefault();
    return;
  }

  if (password.length < 8) {
    alert('Password must be at least 8 characters long.');
    event.preventDefault();
    return;
  }

  if (password !== confirmPassword) {
    alert('Passwords do not match.');
    event.preventDefault();
    return;
  }


  // If all validations pass, allow form submission
  alert('Welcome You Registered successfully!');
});

document.getElementById('contact_us_form').addEventListener('submit', function (event) {
  // Get form elements
  const name = document.getElementById('customer_name').value.trim();
  const email = document.getElementById('customer_email').value.trim();
  const message = document.getElementById('message').value.trim();

  // Regular expression for email validation
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

  // Validation logic
  if (name === '') {
    alert('Name is required.');
    event.preventDefault();
    return;
  }

  if (email === '' || !emailRegex.test(email)) {
    alert('Please enter a valid email address.');
    event.preventDefault();
    return;
  }

  // If all validations pass, allow form submission
  alert('Thank you for your feedbacks');
});