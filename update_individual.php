<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  if (isset($_POST["id"]) && isset($_POST["firstName"]) && isset($_POST["lastName"]) && isset($_POST["profession"]) && isset($_POST["age"]) && isset($_POST["maritalStatus"]) && isset($_POST["email"])) {

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

    // Get the form data
    $id = $_POST["id"];
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $profession = $_POST["profession"];
    $age = $_POST["age"];
    $maritalStatus = $_POST["maritalStatus"];
    $email = $_POST["email"];

    // Update the user information in the database
    $sql = "UPDATE user_info SET first_name='$firstName', last_name='$lastName', profession='$profession', age='$age', marital_status='$maritalStatus', email='$email' WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
      // Data updated successfully, redirect to view_data.php
      header("Location: view_data.php");
      exit();
    } else {
      echo "Error updating data: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
  } else {
    echo "Invalid request.";
  }
}
?>
