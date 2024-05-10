<?php
require '../connection.php';
require 'settings_function.php';
session_start();

// Check if the user is logged in
if (!isset($_SESSION['useradmin_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>

  <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
  <script src = "../js/bootstrap.bundle.min.js"></script>

   <title> Add Products </title>

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

form {
  position: relative;
  z-index: 1;
  max-width: 70%;
  height: 70%;
  margin-top: 90px;
  border-radius: 5px;
  text-align: left;
  color: #333;
  background-color: white;
  border: .5px solid #333;
  box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
}

input[type=text], input[type=password] {
  width: 50%;
  padding: 5px;
  display: inline-block;
  border: .5px solid;
  box-sizing: border-box;
}

input[type=submit] {
  background-color:  #00C2FF;
  color: white;
  padding-left: 30px;
  padding-right: 30px;
  padding-top: 5px;
  padding-bottom: 5px;
  margin-left: 71%;
  margin-bottom: 30px;
  margin-top: 10px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

input[type=submit]:hover {
  background-color: #009ccd;
  color: white;
}

</style>

<div class="header">
  .
</div>

<div class="sidenav">

  <p style="margin-top: 40px; background-color: #00C2FF; padding-right: 10px; padding-left: 10px"> <b>
    <?php
  require '../connection.php';
    
    $useradmin_id = $_SESSION['useradmin_id'];

    $user = getUserSettings($useradmin_id, $con);

   echo $user['codename']. ' - ' . $user['company'];
?> </b></p>
  <center> <p style="color: white; font-size: 20px;padding-top: 20px; padding-bottom: 20px"> <?php
  require '../connection.php';

    $useradmin_id = $_SESSION['useradmin_id'];

    $user = getUserSettings($useradmin_id, $con);

    echo $user['firstname'];
?>  </p> </center>

  <a href="dashboard.php"> <img style="padding-right: 5px; margin-left: 35px;" src="../images/dashboard.png" height="25px" width="30px"> Dashboard </a>
  <a class="active" href="products.php"> <img style="padding-right: 5px; margin-left: 35px" src="../images/products.png" height="25px" width="30px"> Products </a>
  <a href="orders.php"> <img style="padding-right: 5px; margin-left: 35px;" src="../images/notification.png" height="25px" width="30px"> Orders </a>
  <a href="reviews.php"> <img style="padding-right: 5px; margin-left: 35px" src="../images/review.png" height="30px" width="30px"> Feedback </a>
  <a href="reports.php"> <img style="padding-right: 5px; margin-left: 35px" src="../images/reports.png" height="25px" width="30px"> Reports </a>
  <a href="settings.php"> <img style="padding-right: 5px; margin-left: 35px" src="../images/settings.png" height="30px" width="30px">Settings </a>
  <br> <br> <br>
  <a href="login.php"> <img style="padding-right: 5px; margin-left: 35px;" src="../images/logout.png" height="30px" width="30px"> Log Out</a>
</div>

<div class="content"> 
<center>
<form  method="POST"action="add.php" enctype="multipart/form-data">
     
  <h1 style="font-size: 20px; background-color: #333; color: white; padding: 5px; border-top-left-radius: 5px; border-top-right-radius: 5px; padding-left: 40px"> Add New Product </h1> <br>
      
      <label style="font-size: 18px; margin-left: 85px; margin-right: 114px" for="image"> Image: </label>
      <input style="width: 40%" accept="image/png, image/gif, image/jpeg, image/jpg, image/jfif" type="file" size="10" id="image" name="image"> <br> <br>

      <label  style="font-size: 18px; margin-left: 85px; margin-right: 30px" for="type"> Type of Container: </label>
      <input type="text" name="type" placeholder="Enter what kind of container" required> <br><br>

      <label style="font-size: 18px; margin-left: 85px; margin-right: 123px" for="price"> Price: </label>
      <input type="number" name="price" placeholder="0" required> <br><br>

     <input type="submit" name="add" value="Save"> 

   </form>
</center>
</div>
</body>
</html>