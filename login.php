<?php
require 'connection.php';
require 'superadmin/settings_function.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM `usersuperadmin` WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($con, $query);

    if ($result) {
 
        if (mysqli_num_rows($result) == 1) {

            $_SESSION['username'] = $username;
            header("Location: superadmin/dashboard.php");
            exit();
        } else {

        }
         }   
         }
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
  <title> Log In </title>

</head>

<style>
#login-form input[type="password"],
#login-form input[type="text"]{
    box-sizing: border-box;
}
.password-container{
    width: 60%;
    position: relative;
}
.fa-eye{
    position: absolute;
    top: 52%;
    right: 14%;
    cursor: pointer;
    color: grey;
}

  body{
    margin: 0;
    font-family: Times New Roman;
    background-image: url(images/bgg.jpg);
     }

.topnav {
  background-color: white;
    overflow: hidden;
    color: #0492c2;
    font-size: 26px;
    position: relative;
    padding-top: 20px;
    padding-bottom: 20px;
    box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
}

.system-logo {
    float: left;
    margin-left: 50px;
}

.nav-links {
    float: right;
    margin-right: 50px;
}

.topnav a {
    text-align: center;
    text-decoration: none;
     color: #0492c2;
    font-size: 17px;
    padding: 20px 10px;
}

.topnav a:hover {
    color: #03a9a8;
}

.topnav a.active {
    color: #333;
}

.dropdown {
    position: relative;
    display: inline-block;
}

.dropbtn {
    font-size: 15px;
    border: none;
    outline: none;
    color: white;
    padding: 8px 18px;
    background-color: #03c2c1;
    border-radius: 20px;
    margin: 0;
}

.dropdown-content {
    display: none;
    position: absolute;
    top: 100%;
    background-color: #f9f9f9;
    min-width: 150px;
    box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
    z-index: 1;
    
}

.dropdown-content a {
    float: none;
    color: black;
    padding: 8px 10px;
    text-decoration: none;
    display: block;
    text-align: left;
}

.dropdown-content a:hover {
    background-color: #03c2c1;
    color: white;
}

.dropdown:hover .dropdown-content {
    display: block;
}

.system-logo img {
    width: 100%;
}

form {
  position: relative;
  z-index: 1;
  max-width: 390px;
  height: 300px;
  margin: 0 auto 60px;
  border-radius: 20px;
  margin-top: 80px;
  text-align: left;
  color: #333;
  background-color: white;
  box-shadow: 0 0 10px 0 rgba(0, 0, 0, 0.2), 0 3px 3px 0 rgba(0, 0, 0, 0.24);
  border: 1px solid #333;
}

input[type=text], input[type=password] {
  width: 60%;
  padding: 10px;
  display: inline-block;
  border: .5px solid;
  box-sizing: border-box;
}

input[type=submit] {
  background-color: #333;
  color: white;
  padding-top: 14px;
  padding-bottom: 14px;
  padding-left: 40px;
  padding-right: 40px;
  border: none;
  border-radius: 10px;
  cursor: pointer;
  margin-top: 30px;
  margin-bottom: 20px;
}

input[type=submit]:hover {
  background-color: #262626;
  color: white;
}

.content {
  margin-left: 200px;
  padding-left: 20px;
}

</style>


<div class="topnav">
    <div class="system-logo">
        <?php
            $settingsData = getSettingsData();

            foreach ($settingsData as $row) {
                echo $row['codename'] . ' - ' . $row['systemname'];
            }
        ?>
    </div>
    <a href="index.php" style="margin-left: 200px;">HOME</a>
    <a class="active">SUPER ADMINISTRATOR</a>
  </div>
    <body>
<form action="login.php" method="post">
      <center> 
         <h1 style="font-size: 25px;"> Log In</h1><hr>      </center>

      <br><label style="font-size: 18px; padding-left: 33px"> Username: </label>
      <input type="text" name="username" required placeholder="Enter your Username"> <br> <br>
<div class="password-conatiner"> 
      <label style="font-size: 18px; margin-right: 7px; padding-left: 30px"> Password: </label>
      <input type="password" id="password" name="password" required placeholder="Enter your Password">
 <i class="fa-solid fa-eye" id="show-password"></i></div>
      <center> <input type="submit" name="loginadmin" value="Log In">
  </form>
      <script src = "user/script.js"></script>

</body>
</html>