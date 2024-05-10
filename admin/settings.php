<?php
require '../connection.php';
require 'settings_function.php';
session_start();

if (!isset($_SESSION['useradmin_id'])) {
    header("Location: login.php");
    exit();
}

$useradmin_id = $_SESSION['useradmin_id'];
$query = "SELECT * FROM useradmin WHERE useradmin_id = ?";
$stmt = $con->prepare($query);
$stmt->bind_param("i", $useradmin_id);
$stmt->execute();
$result = $stmt->get_result();

$user = $result->fetch_assoc();

$stmt->close();
$con->close();
?>
<!DOCTYPE html>
<html>
<head>

  <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
  <script src = "../js/bootstrap.bundle.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

   <title> Settings </title>

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
  margin-left: 210px;
  margin-right: 10px
}

.content1 {
  margin-left: 200px;
  padding-left: 10px;
  width: 83%;
}
.header{
  background-color: #333;
  text-align: right;
  color: #333;
  font-size: 15px
}
/* Add the following CSS styles to your existing styles */
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
  <br> <br> 
  <a href="login.php"> <img style="padding-right: 5px; margin-left: 35px;" src="../images/logout.png" height="30px" width="30px"> Log Out</a>
</div>

<div class="content1">
  <div class="system-logo">
  <?php
  require '../connection.php';

    $useradmin_id = $_SESSION['useradmin_id'];


    $user = getUserSettings($useradmin_id, $con);


    echo $user['codename'] . ' - ' . $user['company'];
?> <hr>

</div></div>

<div class="content">

        <a href="editsettings.php"><button class="btn btn-infos" style="border-color: #333; float: right; margin-right: 92px; margin-bottom: 20px"> <img src="../images/edit.png" height="20px" width="20px"> Update </button></a>
        <table border="1" style="border-collapse: collapse; border-radius: 10px; overflow: hidden;">
        <tr>
            <td style='background-color:#f5f5f5; color: #333; width: 10%;'><b>Code Name</b></td>
            <td style='width: 70%;'><?php echo $user['codename']; ?></td>
        </tr>

        <tr>
        <td style='background-color:#f5f5f5; color: #333; width: 10%;'><b>Full Name</b></td>
        <td><?php echo $user['firstname']; ?></td>
        </tr>

        <tr>
        <td style='background-color:#f5f5f5; color: #333; width: 10%;'><b>Username</b></td>
        <td><?php echo $user['username']; ?></td>
        </tr>

        <tr>
        <td style='background-color:#f5f5f5; color: #333; width: 10%;'><b>Company Name</b></td>
        <td><?php echo $user['company']; ?></td>
        </tr>
        
        <tr>
        <td style='background-color:#f5f5f5; color: #333; width: 10%;'><b>Description</b></td>
        <td><?php echo $user['description']; ?></td>
        </tr>

        <tr>
        <td style='background-color:#f5f5f5; color: #333; width: 10%;'><b>Company Logo</b></td>
        <td><img src="<?php echo $user['logo']; ?>" alt="Logo" width="50%"></td>
        </tr>

        <tr>
        <td style='background-color:#f5f5f5; color: #333; width: 10%;'><b>Company Cover</b></td>
        <td><img src="<?php echo $user['cover']; ?>" alt="Cover" width="50%"></td>
        </tr>

    </table>
    </div>
</body>
</html>
