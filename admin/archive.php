<?php
require '../connection.php';
require 'settings_function.php';
session_start();

if (!isset($_SESSION['useradmin_id'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];

    $query = "INSERT INTO archive (product_id, useradmin_id, image, type, price) SELECT product_id, useradmin_id, image, type, price FROM products WHERE product_id='$product_id';";

    if (mysqli_query($con, $query)) {
        $delete_query = "DELETE FROM products WHERE product_id='$product_id';";
        if (mysqli_query($con, $delete_query)) {
            echo "<script>window.location.href='products.php';</script>";
        } else {
            echo "<script>window.location.href='products.php';</script>";
        }
    } else {
        echo "<script>window.location.href='products.php';</script>";
    }
}

$useradmin_id = $_SESSION['useradmin_id'];
$archive_query = "SELECT * FROM archive WHERE useradmin_id = '$useradmin_id' ORDER BY product_id DESC";
$archive_result = mysqli_query($con, $archive_query);

?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <script src="../js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <title>Archived Products</title>

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
  padding-left: 30px;
  width: 83%;
}

.header{
  background-color: #333;
  padding-right: 20px;
  padding-left: 900px;
  color: #333;
  padding-top: 5px;
}

.button-group {
    display: flex;
    gap: 0px; /* Adjust the gap according to your preference */
}

.button-group button {
    margin: 0; /* Reset default margin for buttons */
}

.dropdown {
            position: relative;
            display: inline-block;
        }

        /* Basic styling for the button */
        .dropbtn {
            padding: 8px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            cursor: pointer;
        }

        /* Styling for the dropdown arrow */
        .dropbtn::after {
            content: '\25BC'; /* Unicode character for a downward-pointing triangle or arrow */
            
        }

        /* Styling for the dropdown content (the actual dropdown items) */
        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        /* Style for dropdown content items */
        .dropdown-content a {
            padding: 12px 16px;
            display: block;
            text-decoration: none;
            color: #333;
        }

        /* Change color on hover for dropdown content items */
        .dropdown-content a:hover {
            background-color: #f0f0f0;
        }

        /* Show the dropdown content when the button is hovered over */
        .dropdown:hover .dropdown-content {
            display: block;
        }
        .system-logo {
    color: #333;
    font-size: 30px
}
.system-logo {
    color: #333;
    font-size: 25px
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
  <div class="system-logo">
  <?php
  require '../connection.php';

    $useradmin_id = $_SESSION['useradmin_id'];
    $user = getUserSettings($useradmin_id, $con);

    echo $user['codename'] . ' - ' . $user['company'];
?> <hr> </div>
<div class="card">
    <div class="card-header d-flex justify-content-between">
        <h3 class="card-title">Archived Products</h3>
        <div class="card-tools align-middle">
          <a href="archive.php"> <button class="btn btn-danger" style="float: right; color: white"> <img src="../images/trash.png" height="25px" width="20px"> Trash </button> </a>
            <a href="products.php"> <button class="btn btn-success" style="float: right; color: white; margin-right: 10px  "> <img src="../images/products.png" height="25px" width="20px"> Products </button> </a>

        </div>
    </div>
            <div class="card-body">
        <table class="table table-hover table-striped table-bordered">
            <colgroup>
                <col width="15%">
                <col width="25%">
                <col width="30%">
                <col width="10%">
            </colgroup>
            <thead>
                <tr>
    <th class="text-center"> Image </th>
    <th class="text-center"> Type of Container</th>
    <th class="text-center"> Price </th>
    <th class="text-center"> Action </th>
  </tr>
  </thead>
            <tbody>
                        <?php
                        while ($row = mysqli_fetch_assoc($archive_result)) {
                            echo '<tr>';
                            echo '<td><img src="../upload/' . $row['image'] . '" style="width: 90px; height: auto;" class="zoom"></td>';
                            echo '<td>' . $row['type'] . '</td>';
                            echo '<td>' . $row['price'] . '</td>';
                            echo '<td>';
        echo '<div class="dropdown">';
        echo '<div class="dropbtn">Action</div>';
        echo '<div class="dropdown-content">';
        echo '<a style="padding-right: 78px" href="undo.php?product_id=' . $row['product_id'] . '"><img src="../images/update.png" height="25px" width="22px"> Undo </a>';
        echo '<form action="deletep.php" method="GET">';
        echo '<input type="hidden" name="product_id" value="' . $row['product_id'] . '">';
        echo '<button style="padding-right: 65px" type="submit" class="btn btn-infos" name="userdelete" onclick="return confirm(\'Are you sure you want to delete permanently?\')"><img src="../images/delete.jpg" height="22px" width="22px"> Trash </button>';
        echo '</form>';
        echo '</div>';
        echo '</div>';
        echo '</td>';
        echo '</tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>