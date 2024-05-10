<?php
require '../connection.php';
require 'settings_function.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$query = $con->prepare("SELECT * FROM `users` WHERE `user_id` = ?");
$query->bind_param("i", $user_id);
$query->execute();
$result = $query->get_result();

if ($result->num_rows == 1) {
    $userDetails = $result->fetch_assoc();
} else {
    echo "User details not found.";
    exit();
}

$query->close();
?>


<!DOCTYPE html>
<html>
<head>

  <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
  <script src = "../js/bootstrap.bundle.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

   <title> Cancelled Orders </title>

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
}

.header{
  background-color: #333;
  text-align: right;
  color: #333;
  font-size: 15px;
  padding-right: 20px;
  padding: 10px;
}

.system-logo {
  color: #333;
  font-size: 25px;
  margin-bottom: 20px;
}

</style>

<div class="header">

        <div class="dropdown">

        <a class="dropdown-toggle" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: white; margin-right: 20px">
            <img style="padding-right: 5px; margin-left: 35px;" src="../images/login.png" height="20px" width="30px"> <?php
  require '../connection.php';

    $user_id = $_SESSION['user_id'];

    $user = getUserSetting($user_id, $con);

    echo $user['fullname'];
?> 
        </a>
        <ul class="dropdown-menu" aria-labelledby="profileDropdown">

            <li><a class="dropdown-item" href="myprofile.php">My Profile</a></li>
        </ul>
    </div>
</div>

<div class="sidenav">

  <p style="margin-top: 40px; background-color: #00C2FF; padding-right: 10px; padding-left: 10px"> <b>
   <?php
  require '../connection.php';
    $user_id = $_SESSION['user_id'];

    $user = getUserSetting($user_id, $con);

   echo $user['company'];
?> </b>
  <center> <p style="color: white; font-size: 20px;padding-top: 40px; padding-bottom: 40px"> <?php
  require '../connection.php';

    $user_id = $_SESSION['user_id'];

    $user = getUserSetting($user_id, $con);

    echo "@" . $user['username'];
?>  </p>  </center>

<br>
  <a href="products.php"> <img style="padding-right: 5px; margin-left: 35px" src="../images/products.png" height="25px" width="30px"> Products </a>
  <a href="feedback.php"> <img style="padding-right: 5px; margin-left: 35px" src="../images/review.png" height="30px" width="30px"> Reviews </a>
  <a class="active" href="order.php"> <img style="padding-right: 5px; margin-left: 35px" src="../images/order.png" height="30px" width="30px"> Orders </a>
  <br> <br> <br> <br>
  <a href="logout.php"> <img style="padding-right: 5px; margin-left: 35px;" src="../images/logout.png" height="30px" width="30px"> Log Out</a>
  
</div>


<div class="content">
    
<div class="card">
    <div class="card-header d-flex justify-content-between">
 <div class="card-body">
  <div style="margin-bottom: 10px;">
  <h4>  List of your Orders</h4>
            <a href="order.php" class="btn btn-primary" style="color: white"> All </a>
            <a href="pending.php" class="btn btn-warning" style="color: white"> Pending </a>
            <a href="out_for_delivery.php" class="btn btn-info" style="color: white"> Out for Delivery </a>
            <a href="delivered.php" class="btn btn-success"> Delivered </a>
            <a href="cancellation.php" class="btn btn-danger"> Cancelled </a>
        </div>
        <table class="table table-hover table-striped table-bordered">
            <colgroup>
    <col width="10%">
    <col width="10%">
    <col width="12%">
    <col width="12%">
    <col width="8%">
    <col width="8%">
    <col width="9%">
    <col width="6%">
    <col width="6%">
            </colgroup>
            <thead>
    <tr>
    <th class="text-center"> Reference No </th>
    <th class="text-center"> Recipient's Name</th>
    <th class="text-center"> Address</th> 
    <th class="text-center"> Order Products </th>
    <th class="text-center"> Total Amount </th>
    <th class="text-center"> Payment </th>
    <th class="text-center"> Date </th>
    <th class="text-center"> Reason </th>
    <th class="text-center"> Status </th>
  </tr>
  </thead>
            <tbody>

<?php
require'readooo.php';
while ($row = mysqli_fetch_array($user_result)) {
    if ($row['status'] == 'Cancelled') { 
        ?>

<tr>
  <td> <?php echo $row ['ref_number']; ?> </td>
  <td> <?php echo $row ['fullname']; ?> </td>
  <td> <?php echo $row ['houseno'].'&nbsp;'.$row['purok'].'&nbsp;'.$row['street'] .'&nbsp;'.$row['barangay']?> </td>
  <td> <?php echo $row ['products_sold']; ?> </td>
  <td><center> <?php echo $row ['amount']; ?> </center></td>
  <td><center> <?php echo $row ['payment_type']; ?>  </center></td>
  <td> <?php echo $row ['date']; ?> </td>
  <td> <?php echo $row ['reason']; ?> </td>

 <td><center>
    <?php if ($row['status'] == 'Delivered'): ?>
        <span class="badge bg-success rounded-pill">Delivered</span>
    <?php elseif ($row['status'] == 'Out for Delivery'): ?>
        <span class="badge bg-info rounded-pill">Out for Delivery</span>
    <?php elseif ($row['status'] == 'Cancelled'): ?>
        <span class="badge bg-danger rounded-pill">Cancelled</span>
    <?php else: ?>
        <span class="badge bg-warning rounded-pill">Pending</span>
    <?php endif; ?>
</center>

</tr>

<?php } } ?>
</div>
</tbody>
</table>
</div>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
