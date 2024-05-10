<?php
require '../connection.php';
require 'settings_function.php';
require 'setting_functionimg.php';
session_start();

if (!isset($_SESSION['useradmin_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $useradmin_id = $_SESSION['useradmin_id'];
    $query = "SELECT * FROM useradmin WHERE useradmin_id = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("i", $useradmin_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    $codename = htmlspecialchars(trim($_POST['codename']));
    $firstname = htmlspecialchars(trim($_POST['firstname']));
    $username = htmlspecialchars(trim($_POST['username']));
    $company = htmlspecialchars(trim($_POST['company']));
    $description = htmlspecialchars(trim($_POST['description']));

    if (!empty($_POST['password'])) {
        $password = $_POST['password'];
    } else {
        $password = $user['password'];
    }

    if ($_FILES['logo']['error'] == 0) {
        $logo = handleImageUpload($_FILES['logo'], 'logo', $user['logo']);
    } else {
        $logo = $user['logo'];
    }

    if ($_FILES['cover']['error'] == 0) {
        $cover = handleImageUpload($_FILES['cover'], 'cover', $user['cover']);
    } else {
        $cover = $user['cover'];
    }

    $query = "UPDATE useradmin SET codename=?, firstname=?, username=?, password=?, company=?, description=?, logo=?, cover=? WHERE useradmin_id=?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("ssssssssi", $codename, $firstname, $username, $password, $company, $description, $logo, $cover, $useradmin_id);
    $stmt->execute();

    $stmt->close();

    header("Location: settings.php");
    exit();
}
?>


<!DOCTYPE html>
<html>
<head>

  <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
  <script src = "../js/bootstrap.bundle.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

   <title> Update Settings </title>

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
/* Add the following CSS styles to your existing styles */

.content {
  margin-left: 200px;
  padding-left: 10px;
}

.content1 {
  margin-left: 200px;
  padding-left: 10px
}

.system-logo {
  color: #333;
  font-size: 30px;
  margin-bottom: 20px;
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

  <a href="dashboard.php"> <img style="padding-right: 5px; margin-left: 35px" src="../images/dashboard.png" height="25px" width="30px"> Dashboard </a>
  <a href="products.php"> <img style="padding-right: 5px; margin-left: 35px" src="../images/products.png" height="25px" width="30px"> Products </a>
  <a href="orders.php"> <img style="padding-right: 5px; margin-left: 35px;" src="../images/notification.png" height="25px" width="30px"> Orders </a>
  <a href="reviews.php"> <img style="padding-right: 5px; margin-left: 35px" src="../images/review.png" height="30px" width="30px"> Feedback </a>
  <a href="reports.php"> <img style="padding-right: 5px; margin-left: 35px" src="../images/reports.png" height="25px" width="30px"> Reports </a>
  <a class="active" href="settings.php"> <img style="padding-right: 5px; margin-left: 35px" src="../images/settings.png" height="30px" width="30px">Settings </a>
  <br>
  <a href="login.php"> <img style="padding-right: 5px; margin-left: 35px;" src="../images/logout.png" height="30px" width="30px"> Log Out</a>
</div>

<div class="content">
    <br>
    
<form method="post" enctype="multipart/form-data" style="border-collapse: collapse; border-radius: 10px; overflow: hidden; border: 1px solid #ddd; width: 60%; margin: auto; padding: 20px;">


    <div style="display: flex; margin-bottom: 5px;">
        <div style=" color: #333; width: 30%; padding: 5px;"><b>Codename</b></div>
        <div style="width: 70%; padding: 5px;">
            <input type="text" name="codename" value="<?php echo $user['codename']; ?>" >
        </div>
    </div>


    <div style="display: flex; margin-bottom: 5px;">
        <div style=" color: #333; width: 30%; padding: 5px;"><b>Full Name</b></div>
        <div style="width: 70%; padding: 5px;">
            <input type="text" name="firstname" value="<?php echo $user['firstname']; ?>" >
        </div>
    </div>


    <div style="display: flex; margin-bottom: 5px;">
        <div style=" color: #333; width: 30%; padding: 5px;"><b>Username</b></div>
        <div style="width: 70%; padding: 5px;">
            <input type="text" name="username" value="<?php echo $user['username']; ?>">
        </div>
    </div>


    <div style="display: flex; margin-bottom: 5px;">
        <div style=" color: #333; width: 30%; padding: 5px;"><b>Password</b></div>
        <div style="width: 70%; padding: 5px;">
            <input type="password" name="password" autocomplete="off">
            <br><small><i>Leave this blank if you dont want to change the password.</i></small>
        </div>
    </div>


    <div style="display: flex; margin-bottom: 5px;">
        <div style=" color: #333; width: 30%; padding: 5px;"><b>Company</b></div>
        <div style="width: 70%; padding: 5px;">
            <input type="text" name="company" value="<?php echo $user['company']; ?>" >
        </div>
    </div>
    
    <div style="display: flex; margin-bottom: 5px;">
        <div style=" color: #333; width: 30%; padding: 5px;"><b>Description</b></div>
        <div style="width: 70%; padding: 5px;">
            <input type="text" name="description" value="<?php echo $user['description']; ?>" >
        </div>
    </div>


    <div style="display: flex; margin-bottom: 5px;">
        <div style=" color: #333; width: 30%; padding: 5px;"><b>Logo</b></div>
        <div style="width: 70%; padding: 5px;">
            <img src="<?php echo $user['logo']; ?>" alt="Existing Logo" width="100" style="margin-bottom: 10px;">
            <input type="file" name="logo" accept="image/*">
        </div>
    </div>


    <div style="display: flex; margin-bottom: 5px;">
        <div style=" color: #333; width: 30%; padding: 5px;"><b>Cover</b></div>
        <div style="width: 70%; padding: 5px;">
            <img src="<?php echo $user['cover']; ?>" alt="Existing Cover" width="100" style="margin-bottom: 10px;">
            <input type="file" name="cover" accept="image/*">
        </div>
    </div>


    <div style="text-align: right;">
        <input type="submit" value="Save" style="padding: 10px; background-color: #00C2FF; color: white; border: none; border-radius: 5px; cursor: pointer;">
    </div>

</form>

</div>
</body>
</html>