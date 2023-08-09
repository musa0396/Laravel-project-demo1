<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  // Retrieve user inputs
  $firstName = $_POST["firstName"];
  $lastName = $_POST["lastName"];
  $profession = $_POST["profession"];
  $age = $_POST["age"];
  $id = $_POST["id"];
  $maritalStatus = $_POST["maritalStatus"];
  $email = $_POST["email"];

  // Validate and sanitize the data (optional, based on requirements)

  // Connect to the MySQL database
  $servername = "127.0.0.1"; // Replace with your database servername
  $username = "root"; // Replace with your database username
  $password = ""; // Replace with your database password
  $dbname = "personnel_info"; // Replace with your database name

  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);

  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  // SQL query to insert user data into the database
  $sql = "INSERT INTO user_info (first_name, last_name, profession, age, id, marital_status, email)
          VALUES ('$firstName', '$lastName', '$profession', $age, $id, '$maritalStatus', '$email')";

  if ($conn->query($sql) === TRUE) {
    // If data insertion is successful, redirect to a success page
    header("Location: success_page.html");
    exit;
  } else {
    // If an error occurs, display an error message
    echo "Error: " . $sql . "<br>" . $conn->error;
  }

  // Close the database connection
  $conn->close();
}
?>
