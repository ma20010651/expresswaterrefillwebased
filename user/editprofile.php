<?php
require '../connection.php';
require 'settings_function.php';
session_start();

// Redirect to login page if user is not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize input data
    $fullname = htmlspecialchars($_POST['fullname']);
    $address = htmlspecialchars($_POST['address']);
    $contact = htmlspecialchars($_POST['contact']);
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);
    $email = htmlspecialchars($_POST['email']);

    // Update user data in the database
    $query = "UPDATE users SET fullname=?, address=?, contact=?, username=?, password=?, email=? WHERE user_id=?";
    $stmt = $con->prepare($query);
    // Bind parameters
    $stmt->bind_param("ssssssi", $fullname, $address, $contact, $username, $password, $email, $_SESSION['user_id']);
    // Execute the statement
    $stmt->execute();
    // Close the statement
    $stmt->close();
    // Redirect to settings page
    header("Location: myprofile.php");
    exit();
}

// Fetch user details
$user_id = $_SESSION['user_id'];
$query = $con->prepare("SELECT * FROM `users` WHERE `user_id` = ?");
$query->bind_param("i", $user_id);
$query->execute();
$result = $query->get_result();

if ($result->num_rows == 1) {
    // Fetch user details
    $userDetails = $result->fetch_assoc();
} else {
    // Handle the case where user details are not found
    echo "User details not found.";
    exit();
}

// Close the statement
$query->close();
// Close the database connection
$con->close();
?>


<!DOCTYPE html>
<html>
<head>

  <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
  <script src = "../js/bootstrap.bundle.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

   <title> Update My Profile </title>

</head>
<body>

<style>

body {
  margin: 0;
  font-family: Times New Roman;
  background-color:white;
}

.sidenav {
  height: 100%;
  width: 200px;
  position: fixed;
  z-index: 1;
  top: 0;
  left: 0;
  background-color: #333;
  overflow-x: hidden;
  text-align: left;
  color: white;
}

.sidenav a {
  color: white;
  padding: 10px;
  text-decoration: none;
  display: block;
}

/* Change color on hover */
.sidenav a:hover {
  background-color: #DDDDDD;
  color: #333;
}
.sidenav a.active {
  background-color: #00C2FF;
  color:white;
}

.content {
  margin-left: 200px;
  padding-left: 20px;
}

.header{
  background-color: #333;
  text-align: right;
  color: #333;
  font-size: 15px
}

.system-logo {
  color: #333;
  font-size: 25px;
  margin-bottom: 20px;
}

table {
        width: 90%;
        border-collapse: collapse;
        margin-left: 20px;
    }

    th, td {
        padding: 10px;
        border: 1px solid #ddd;
        text-align: left;
    }

    th {
        background-color: #f5f5f5;
        color: #333;
    }

    img {
        max-width: 100%;
        height: auto;
    }

    .btn {
        background-color: #00C2FF;
        color: white;
        padding: 5px 10px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .btn:hover {
        background-color: #009ccd;
    }
    input[type=text], input[type=password] {
  padding: 5px;
  display: inline-block;
  border: 1px solid #ddd;
  border-radius: 10px;
  box-sizing: border-box;
}
</style>

<div class="header">
    .
</div>

<div class="sidenav">

  <p style="margin-top: 40px; background-color: #00C2FF; padding-right: 10px; padding-left: 10px"> <b>
    <?php
  require '../connection.php';
    // Assuming you have a user ID stored in your session
    $user_id = $_SESSION['user_id'];

    // Fetch the settings data
    $user = getUserSetting($user_id, $con);

    // Display the image from settings
   echo $user['company'];
?> </b>
  <center> <p style="color: white; font-size: 20px;padding-top: 40px; padding-bottom: 40px"> <?php
  require '../connection.php';
    // Assuming you have a user ID stored in your session
    $user_id = $_SESSION['user_id'];

    // Fetch the settings data
    $user = getUserSetting($user_id, $con);

    // Display the image from settings
    echo $user['fullname'];
?>  </p>  </center>

  <a class="active" href="myprofile.php"> <img style="padding-right: 5px; margin-left: 35px;" src="../images/login.png" height="20px" width="30px"> My Profile </a>

  <a href="products.php"> <img style="padding-right: 5px; margin-left: 35px" src="../images/products.png" height="25px" width="30px"> Products </a>
  <a href="feedback.php"> <img style="padding-right: 5px; margin-left: 35px" src="../images/review.png" height="30px" width="30px"> Reviews </a>
  <br> <br> <br> <br> <br>
  <a href="logout.php"> <img style="padding-right: 5px; margin-left: 35px;" src="../images/logout.png" height="30px" width="30px"> Log Out</a>
</div>

<div class="content">
 <br>
<form method="post" enctype="multipart/form-data" style="border-collapse: collapse; border-radius: 10px; overflow: hidden; border: 1px solid #ddd; width: 60%; margin: auto; padding: 20px; margin-top: 50px">

    <!-- Fullname -->
    <div style="display: flex; margin-bottom: 5px;">
        <div style=" color: #333; width: 30%; padding: 5px;"><b>Full Name:</b></div>
        <div style="width: 70%; padding: 5px;">
            <input type="text" name="fullname" value="<?php echo $user['fullname']; ?>" >
        </div>
    </div>

    <!-- Address -->
    <div style="display: flex; margin-bottom: 5px;">
        <div style=" color: #333; width: 30%; padding: 5px;"><b>Address:</b></div>
        <div style="width: 70%; padding: 5px;">
            <input type="text" name="address" value="<?php echo $user['address']; ?>" >
        </div>
    </div>

    <!-- Contact Number -->
    <div style="display: flex; margin-bottom: 5px;">
        <div style=" color: #333; width: 30%; padding: 5px;"><b>Contact Number:</b></div>
        <div style="width: 70%; padding: 5px;">
            <input type="text" name="contact" value="<?php echo $user['contact']; ?>">
        </div>
    </div>

    <!-- Username -->
    <div style="display: flex; margin-bottom: 5px;">
        <div style=" color: #333; width: 30%; padding: 5px;"><b>Username:</b></div>
        <div style="width: 70%; padding: 5px;">
            <input type="text" name="username" value="<?php echo $user['username']; ?>">
        </div>
    </div>

    <!-- Password -->
    <div style="display: flex; margin-bottom: 5px;">
        <div style=" color: #333; width: 30%; padding: 5px;"><b>Password:</b></div>
        <div style="width: 70%; padding: 5px;">
            <input type="password" name="password" >
        </div>
    </div>

    <!-- Email Address -->
    <div style="display: flex; margin-bottom: 5px;">
        <div style=" color: #333; width: 30%; padding: 5px;"><b>Email Address:</b></div>
        <div style="width: 70%; padding: 5px;">
            <input type="text" name="email" value="<?php echo $user['email']; ?>" >
        </div>
    </div>

    <!-- Submit button -->
    <div style="text-align: right;">
        <input type="submit" value="Save" style="padding: 10px; background-color: #00C2FF; color: white; border: none; border-radius: 5px; cursor: pointer;">
    </div>

</form>

</div>
</body>
</html>