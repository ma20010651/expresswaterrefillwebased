<?php
require '../connection.php';
require 'settings_function.php';
session_start();

if (!isset($_SESSION['useradmin_id'])) {
    header("Location: login.php");
    exit();
    
$useradmin_id = $_SESSION['useradmin_id'];
$user_result = mysqli_query($con, "SELECT * FROM `order` WHERE useradmin_id = '$useradmin_id' ORDER BY id DESC");
}
?>
<!DOCTYPE html>
<html>
<head>

  <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
  <script src = "../js/bootstrap.bundle.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


   <title> Orders </title>

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
  padding-top: 10px;
}

.content1 {
  margin-left: 200px;
  padding-left: 10px;
  width: 83%;
}
.header{
  background-color: #333;
  padding-right: 20px;
  padding-left: 900px;
  color: #333;
  padding-top: 5px;
}

.system-logo {
  color: #333;
  font-size: 25px;
  margin-bottom: 20px;
}
table, td, th {
  border: .5px solid grey;
  padding: 5px
}

table {
  border-collapse: collapse;
  width: 98%;
}

th {
  text-align: center;
  background-color: #333;
  padding-top: 5px;
  padding-bottom: 5px;
  color: white;
}

td{
  padding-top: 10px;
  padding-bottom: 10px;
  padding-left: 10px
}
tr:hover {background-color: #f0f0f0}

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
  <a class="active" href="orders.php"> <img style="padding-right: 5px; margin-left: 35px;" src="../images/notification.png" height="25px" width="30px"> Orders </a>
  <a href="reviews.php"> <img style="padding-right: 5px; margin-left: 35px" src="../images/review.png" height="30px" width="30px"> Feedback </a>
  <a href="reports.php"> <img style="padding-right: 5px; margin-left: 35px" src="../images/reports.png" height="25px" width="30px"> Reports </a>
  <a href="settings.php"> <img style="padding-right: 5px; margin-left: 35px" src="../images/settings.png" height="30px"width="30px">Settings </a>
  <br> <br> <br>
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
  <div class="card">
    <div class="card-header d-flex justify-content-between">
        <div>
            <a href="orders.php" class="btn btn-primary"> Walk-In Order List </a>
            <a href="pending.php" class="btn btn-secondary"> Online Order List </a>
        </div>
        <div class="card-tools align-middle">
            <a href="addcustomer.php"> <button class="btn btn-info" style="float: right; color: white "> <img src="../images/add.png" height="25px" width="20px"> Add Walk-in Customer </button> </a>

        </div>
    </div>
  <div class="card-body">
        <table id="myTable" class="table table-hover table-striped table-bordered">
            <colgroup>
                <col width="15%">
                <col width="15%">
                <col width="15%">
                <col width="25%">
                <col width="5%">
                <col width="10%">
                <col width="15%">
            </colgroup>
            <thead>
                <tr>
    <th class="text-center"> Full Name </th>
    <th class="text-center"> Contact No </th>
    <th class="text-center"> Address </th>
    <th class="text-center"> Orders </th>
    <th class="text-center"> Amount </th>
    <th class="text-center"> Category </th>
    <th class="text-center"> Date Ordered </th>
  </tr>
  </thead>
            <tbody>
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>


<script>
$(document).ready(function() {
    $('#myTable').DataTable({
        "order": [[ 8, "desc" ]],
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true
    });
});
</script>
<?php
require'reado.php';
while($row = mysqli_fetch_array($user_result)){

?>

<script>
  $(document).ready( function () {
    $('#myTable').DataTable();
  });
</script>

<tr>
  <td> <?php echo $row ['fullname']; ?> </td>
  <td> <?php echo $row ['contact']; ?> </td>
  <td> <?php echo $row ['houseno'].'&nbsp;'.$row['purok'].'&nbsp;'.$row['street']; ?> </td>
  <td> <?php echo $row ['total_products']; ?> </td>
  <td><center> <?php echo $row ['total_price']; ?> </center></td>
   <td><center> <span class="badge bg-success rounded-pill"><?php echo $row ['category']; ?>  </center></td>
    <td> <?php echo $row ['date']; ?> </td>

</td>
  </tr>
<?php } ?>
</table>
</div>

