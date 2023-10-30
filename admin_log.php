<?php
if(isset($_POST['a_name'])){
$servername = "localhost:3308";
$username = "root";
$password = "";
$dbname = "airio_";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

// Get the entered username and password from the HTML form
$a_name = $_POST["a_name"];
$a_password = $_POST["a_password"];

// Query the database to fetch the hashed password for the entered username
$sql = "SELECT a_password FROM admin WHERE a_name = '$a_name';";
$result = mysqli_query($conn, $sql);

if ($result->num_rows > 0) {
    // Username exists, check the password
    $row = $result->fetch_assoc();
    $hashedPasswordFromDB = $row["a_password"];

    if ($a_password==$hashedPasswordFromDB) {
        // Password is correct, redirect to the desired page
        header("Location: admin_h.html");
        exit();
    } else {
        // Incorrect password
        echo "Incorrect password. Please try again.";
    }
} else {
    // Username does not exist
    echo "Username not found. Please try again.";
}

// Close the database connection
$conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin login</title>
    <link rel="stylesheet" href="css/style_l.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
    <img class="log" src="images/admin_log.jpg" alt="login">
    <div class="container">
    <h1>Login</h1>
    <form action="" method="post">
        <label class="form_" for="form1">Username:</label>
        <input type="text" name="a_name" id="a_name" placeholder="Enter username" required>
        <label class="form_" for="form1">Password:</label>
        <input type="password" name="a_password" id="a_password" placeholder="Enter password" required>
        <button type="button" class="btn" onclick="goBack()">Back</button>
        <button type="submit" class="btn">Login</button>
    </form>
    </div>
    <script>
        function goBack() {
          window.history.back();
        }
      
      </script>
        </body>
        </html>


