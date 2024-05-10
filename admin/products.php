<?php
require '../connection.php';
require 'settings_function.php';
session_start();

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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
   <title> Products </title>

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
        <h3 class="card-title">Product List</h3>
        <div class="card-tools align-middle">
          <a href="archive.php"> <button class="btn btn-danger" style="float: right; color: white;"> <img src="../images/trash.png" height="25px" width="20px"> Trash </button> </a>
            <a href="addproduct.php"> <button class="btn btn-success" style="float: right; color: white; margin-right: 10px  "> <img src="../images/add.png" height="25px" width="20px"> Add New Product </button> </a>

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
require'readp.php';
while($row = mysqli_fetch_array($user_result)){

?>

<?php } ?>
</table>
</div>

<script>
    $(document).ready(function () {
        var message = "<?php echo $message ?? ''; ?>";
        var status = "<?php echo $status ?? ''; ?>";

        if (message !== "") {
            var alertClass = status === 'success' ? 'alert-success' : 'alert-danger';
            var alertHtml = '<div class="alert ' + alertClass + ' alert-dismissible fade show" role="alert">' +
                message +
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                '<span aria-hidden="true">&times;</span>' +
                '</button>' +
                '</div>';

            $('.content').prepend(alertHtml);
        }
    });
</script>
</body>
</html>