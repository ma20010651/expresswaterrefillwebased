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

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
	<title> Cancel Order </title>
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

.header{
  background-color: #333;
  text-align: right;
  color: #333;
  font-size: 15px;
  padding-right: 20px;
  padding: 10px;
}

.button-group {
    display: flex;
    gap: 0px; /* Adjust the gap according to your preference */
}

.button-group button {
    margin: 0; /* Reset default margin for buttons */
}
    h3 {
        color: #333333;
    }

    label {
        font-weight: bold;
        color: #333333;
    }

    .row {
        margin-bottom: 15px;
    }

    .col-md-6 {
        margin-bottom: 15px;
    }

    .badge {
        font-size: 14px;
    }

    input[type=submit] {
  background-color:  #00C2FF;
  color: white;
  padding-left: 30px;
  padding-right: 30px;
  padding-top: 5px;
  padding-bottom: 5px;
  margin-left: 90%;
  margin-bottom: 10px;
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

	<?php
    require '../connection.php';
      $ref_number = $_GET['ref_number'];
      $query = "SELECT * FROM `transaction` WHERE ref_number='$ref_number'";
      $result = mysqli_query($con,$query);
      $data =  mysqli_fetch_array($result);
    ?>

<form method="POST" action="editco.php?ref_number=<?= $ref_number ?>" enctype="multipart/form-data">
<input type="hidden" name="ref_number" value="<?=$data['ref_number']?>"> 

 <div class="container-fluid" style="border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); padding: 20px; margin-top: 10px;">
 	<h4> Cancellation of your Order </h4> <hr><br>
    <div class="row">
        <div class="col-md-4">
            <p style="color: #333333; margin-top: 0; font-size: 12px"> <b style="font-size: 15px"> Reference Number </b> <br><?php echo $data['ref_number']?></p>
        </div>

        <div class="col-md-4">
            <p style="color: #333333; margin-top: 0; font-size: 12px"> <b style="font-size: 15px"> Date Ordered </b> <br><?php echo $data['date']?></p>
        </div>

        <div class="col-md-4">
            <p style="color: #333333; margin-top: 0; font-size: 12px"> <b style="font-size: 15px"> Status </b> <br>
        <?php if ($data['status'] == 'Delivered'): ?>
    <span style="font-size: 12px" class="badge bg-success rounded-pill" >Delivered</span>
        <?php elseif ($data['status'] == 'Out for Delivery'): ?>
    <span style="font-size: 12px" class="badge bg-info rounded-pill" >Out for Delivery</span>
        <?php else: ?>
    <span style="font-size: 12px" class="badge bg-warning rounded-pill">Pending</span>
        <?php endif; ?> </td></p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <p style="color: #333333; margin-top: 0; font-size: 12px"> <b style="font-size: 15px"> Order Product </b> <br><?php echo $data['products_sold']?></p>
        </div>

        <div class="col-md-4">
            <p style="color: #333333; margin-top: 0; font-size: 12px"> <b style="font-size: 15px"> Total Amount </b> <br><?php echo $data['amount']?></p>
        </div>

    </div>
    <br>
    <h4> Why do you want to cancel your order? </h4>

    <textarea type="text" name="reason" cols="30" rows="6" required class="form-control rounded-0 summernote" ></textarea>

    	<input type="hidden" name="status" value="Cancelled" >
    <br>
            <input type="submit" name="edit" value="Submit">
        </form> 

</div>

</div>

</div>

</body>
</html>