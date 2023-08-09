<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>View Data</title>
  <style>
    /* Your existing CSS styles for the page */
    body {
      font-family: Calibri, Helvetica, sans-serif;
      background-color: rgb(245, 5, 73);
      margin: 0;
      padding: 0;
    }

    .navbar {
      background-color: #333;
      overflow: hidden;
    }

    .navbar a {
      float: left;
      display: block;
      color: white;
      text-align: center;
      padding: 14px 16px;
      text-decoration: none;
    }

    .navbar a:hover {
      background-color: #ddd;
      color: black;
    }

    @media screen and (max-width: 600px) {
      .navbar a {
        float: none;
        display: block;
        text-align: left;
      }
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

    .data-container {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      width: 100%;
    }

    .data-table {
      width: 100%;
      background-color: #444;
      padding: 20px;
      border-radius: 8px;
    }

    .data-table th,
    .data-table td {
      padding: 8px;
      color: #fff;
      border: 1px solid #666;
    }

    .data-table th {
      background-color: #2c3e50;
    }

    .data-table tr:nth-child(even) {
      background-color: #333;
    }

    .footer {
      text-align: center;
      background-color: #2c3e50;
      color: white;
      padding: 10px;
    }
  </style>
</head>
<body>
  <div class="navbar">
    <a href="index.html">Home</a>
    <a href="view_data.php">View Data</a>
  </div>

  <div class="container">
    <div class="data-container">
      <?php
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

      // Fetch all user information from the database
      $sql = "SELECT * FROM user_info";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
        echo "<h1>User Information</h1>";
        echo "<table class='data-table'>";
        echo "<tr>";
        echo "<th>ID</th>";
        echo "<th>First Name</th>";
        echo "<th>Last Name</th>";
        echo "<th>Profession</th>";
        echo "<th>Age</th>";
        echo "<th>Marital Status</th>";
        echo "<th>Email</th>";
        echo "<th>Actions</th>"; // New column for the "View" button
        echo "</tr>";

        // Loop through each row of data and display it in the table
        while ($row = $result->fetch_assoc()) {
          echo "<tr>";
          echo "<td>" . $row['id'] . "</td>";
          echo "<td>" . $row['first_name'] . "</td>";
          echo "<td>" . $row['last_name'] . "</td>";
          echo "<td>" . $row['profession'] . "</td>";
          echo "<td>" . $row['age'] . "</td>";
          echo "<td>" . $row['marital_status'] . "</td>";
          echo "<td>" . $row['email'] . "</td>";
          echo "<td><a href='view_individual.php?id=" . $row['id'] . "'>View</a></td>"; // View button with link to view_individual.php
          echo "</tr>";
        }
        echo "</table>";
      } else {
        echo "No user information found.";
      }

      // Close the database connection
      $conn->close();
      ?>
    </div>
  </div>

  <footer class="footer">
    <p>&copy; 2023 Data collection. All rights reserved.</p>
  </footer>
</body>
</html>
