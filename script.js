// Function to validate the form inputs
function validateForm() {
    const firstName = document.getElementById("firstName").value;
    const lastName = document.getElementById("lastName").value;
    const profession = document.getElementById("profession").value;
    const age = document.getElementById("age").value;
    const id = document.getElementById("id").value;
    const email = document.getElementById("email").value;
  
    // Check if required fields are filled
    if (firstName === "" || lastName === "" || profession === "" || age === "" || id === "" || email === "") {
      alert("Please fill in all required fields.");
      return false;
    }
  
    // Validate age is a positive number
    if (isNaN(age) || age <= 0) {
      alert("Please enter a valid age.");
      return false;
    }
  
    // Validate ID is a positive number
    if (isNaN(id) || id <= 0) {
      alert("Please enter a valid ID.");
      return false;
    }
  
    // Validate email format using a regular expression
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!email.match(emailRegex)) {
      alert("Please enter a valid email address.");
      return false;
    }
  
    return true; // Form is valid, allow submission
  }
  
  // Attach the form validation function to the form submission event
  const userForm = document.getElementById("userForm");
  userForm.addEventListener("submit", function (event) {
    if (!validateForm()) {
      event.preventDefault(); // Prevent form submission if validation fails
    }
  });
  