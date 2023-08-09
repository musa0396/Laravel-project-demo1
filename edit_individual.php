<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Individual Information</title>
  <style>
    /* Your existing CSS styles for the page */
    body {
      font-family: Calibri, Helvetica, sans-serif;
      background-color: rgb(245, 5, 73);
      margin: 0;
      padding: 0;
    }

    .container {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      background-color: rgb(241, 246, 248);
      padding: 25px;
    }

    h1 {
      text-align: center;
    }

    /* Center the edit form */
    .edit-form-container {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      width: 100%;
    }

    /* Style the edit form */
    #editForm {
      max-width: 400px;
      width: 100%;
      background-color: #444; /* Dark gray background for the form */
      padding: 20px;
      border-radius: 8px;
      color: #fff; /* White text color for the form elements */
    }

    label {
      margin-bottom: 5px;
    }

    /* Style the "Save" button */
    .save-button {
      background-color: #2c3e50; /* Navy blue button background */
      color: #fff;
      cursor: pointer;
      transition: background-color 0.3s;
      padding: 6px 12px;
      border: none;
      border-radius: 4px;
      margin-top: 10px;
      text-decoration: none; /* Remove the default underline for anchor tag */
      text-align: center;
    }

    .save-button:hover {
      background-color: #3a97f5; /* Darker navy blue on hover */
    }

    /* Additional styles for the form elements */
    input[type="text"],
    select,
    input[type="number"],
    input[type="radio"],
    input[type="email"] {
      margin-bottom: 15px;
      padding: 8px;
      border: 1px solid #666;
      border-radius: 4px;
      width: 100%;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="edit-form-container">
      <?php
      if (isset($_GET["id"])) {
        $id = $_GET["id"];

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

        // Fetch individual user information from the database based on the provided id
        $sql = "SELECT * FROM user_info WHERE id = '$id'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
          // Display the edit form for individual user information
          while ($row = $result->fetch_assoc()) {
            ?>
            <h1>Edit Individual Information</h1>
            <form id="editForm" action="update_individual.php" method="post">
              <table>
                <tr>
                  <td><label for="firstName">First Name:</label></td>
                  <td><input type="text" id="firstName" name="firstName" value="<?php echo $row['first_name']; ?>" required></td>
                </tr>
                <tr>
                  <td><label for="lastName">Last Name:</label></td>
                  <td><input type="text" id="lastName" name="lastName" value="<?php echo $row['last_name']; ?>" required></td>
                </tr>
                <tr>
                  <td><label for="profession">Profession:</label></td>
                  <td>
                    <select id="profession" name="profession" required>
                      <option value="">Select One</option>
                      <option value="student" <?php if ($row['profession'] === 'student') echo 'selected'; ?>>Student</option>
                      <option value="working" <?php if ($row['profession'] === 'working') echo 'selected'; ?>>Working</option>
                      <option value="jobless" <?php if ($row['profession'] === 'jobless') echo 'selected'; ?>>Jobless</option>
                      <option value="retired" <?php if ($row['profession'] === 'retired') echo 'selected'; ?>>Retired</option>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td><label for="age">Age:</label></td>
                  <td><input type="number" id="age" name="age" value="<?php echo $row['age']; ?>" required></td>
                </tr>
                <tr>
                  <td><label>Marital Status:</label></td>
                  <td>
                    <input type="radio" id="married" name="maritalStatus" value="married" <?php if ($row['marital_status'] === 'married') echo 'checked'; ?> required>
                    <label for="married">Married</label>
                    <input type="radio" id="single" name="maritalStatus" value="single" <?php if ($row['marital_status'] === 'single') echo 'checked'; ?> required>
                    <label for="single">Single</label>
                  </td>
                </tr>
                <tr>
                  <td><label for="email">Email:</label></td>
                  <td><input type="email" id="email" name="email" value="<?php echo $row['email']; ?>" required></td>
                </tr>
                <!-- Add more questions here if needed -->
              </table>
              <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
              <input type="submit" value="Save" class="save-button">
            </form>
            <form id="deleteForm" action="delete_individual.php" method="post" onsubmit="return confirm('Are you sure you want to delete this record?');">
              <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
              <input type="submit" value="Delete" class="delete-button">
            </form>
            <?php
          }
        } else {
          echo "User information not found.";
        }

        // Close the database connection
        $conn->close();
      } else {
        echo "Invalid request.";
      }
      ?>
      <a href="view_data.php" class="view-data-button">Cancel</a>
    </div>
  </div>
  <footer class="footer">
    <p>&copy; 2023 Your Company. All rights reserved.</p>
  </footer>
</body>
</html>
