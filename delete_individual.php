<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  if (isset($_POST["id"])) {
    $id = $_POST["id"];

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

    // Delete the user information from the database based on the provided id
    $sql = "DELETE FROM user_info WHERE id = '$id'";

    if ($conn->query($sql) === TRUE) {
      // Data deleted successfully, redirect to view_data.php
      header("Location: view_data.php");
      exit();
    } else {
      echo "Error deleting data: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
  } else {
    echo "Invalid request.";
  }
}
?>
