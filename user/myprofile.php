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


$query = $con->prepare("SELECT * FROM `billing_information` WHERE `user_id` = ?");
$query->bind_param("i", $user_id);
$query->execute();
$result = $query->get_result();

if ($result->num_rows == 1) {
   
    $billingDetails = $result->fetch_assoc();
    $userDetails['houseno'] = $billingDetails['houseno'];
    $userDetails['purok'] = $billingDetails['purok'];
    $userDetails['street'] = $billingDetails['street'];
} else {
    
    if (!isset($_SESSION['user_id'])) {

    header("Location: login.php");
    exit();
}}

$query->close();
?>



<!DOCTYPE html>
<html>
<head>

  <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
  <script src = "../js/bootstrap.bundle.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

   <title> My Profile </title>

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
  font-size: 15px;
  padding-right: 20px;
  padding: 10px;
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
  <a href="order.php"> <img style="padding-right: 5px; margin-left: 35px" src="../images/order.png" height="30px" width="30px"> Orders </a>
  <br> <br> <br> <br>
  <a href="logout.php"> <img style="padding-right: 5px; margin-left: 35px;" src="../images/logout.png" height="30px" width="30px"> Log Out</a>
</div>

<div class="content">
  
   <form id='updateFormInput'>

    <h4 style="margin-top: 20px" class='text-center'>My Profile </h4>
     <button style='margin-right: 100px; float: right' class="btn btn-warning"> Update </button>

   <table border="1" style="border-collapse: collapse; border-radius: 10px; overflow: hidden;">

    <tr>
    <td style='background-color:#f5f5f5; color: #333; width: 10%;'><b>Full Name</b></td>
    <td style='width: 70%;'>
    <input type="text" name="fullname" class="form-control"  value='<?php echo $userDetails['fullname']; ?>'>
  
        </td>
      </tr>
  
      <tr>
        <td style='background-color:#f5f5f5; color: #333; width: 10%;'><b>Contact</b></td>
        <td style='width: 70%;'>
          <input type="text" name="contact" class="form-control" value='<?php echo $userDetails['contact']; ?>'>
  
        </td>
      </tr>
  
      <tr>
        <td style='background-color:#f5f5f5; color: #333; width: 10%;'><b>Username</b></td>
        <td style='width: 70%;'>
          <input type="text" name="username" class="form-control" value='<?php echo $userDetails['username']; ?>'>
  
        </td>
      </tr>
      
      <tr>
        <td style='background-color:#f5f5f5; color: #333; width: 10%;'><b>Email Address</b></td>
        <td style='width: 70%;'>
          <input type="text" name="email" class="form-control" value='<?php echo $userDetails['email']; ?>'>
  
        </td>
      </tr>
  <tr>
    <td style="background-color: white"></td>
</tr>
<tr>
    <td style='background-color:#f5f5f5; color: #333; width: 10%;'><b>Home Address</b></td>
    <td style='width: 70%; background-color:#f5f5f5;'>
        <?php
        if (isset($userDetails['houseno']) && isset($userDetails['purok']) && isset($userDetails['street'])) {
            // Display the address if all keys are set
            echo $userDetails['houseno'] . '&nbsp;' . $userDetails['purok'] . '&nbsp;' . $userDetails['street'] . '&nbsp;' . $userDetails['barangay'];
        } else {
            echo "Address not available";
        }
        ?>
    </td>
</tr>
<tr>
    <td style='background-color:#f5f5f5; color: #333; width: 10%;'><b>House Number</b></td>
    <td style='width: 70%;'>
        <input type="text" name="houseno" class="form-control" value='<?php echo isset($userDetails['houseno']) ? $userDetails['houseno'] : ''; ?>'>
    </td>
</tr>
<tr>
    <td style='background-color:#f5f5f5; color: #333; width: 10%;'><b>Purok</b></td>
    <td style='width: 70%;'>
        <input type="text" name="purok" class="form-control" value='<?php echo isset($userDetails['purok']) ? $userDetails['purok'] : ''; ?>'>
    </td>
</tr>
<tr>
    <td style='background-color:#f5f5f5; color: #333; width: 10%;'><b>Street</b></td>
    <td style='width: 70%;'>
        <input type="text" name="street" class="form-control" value='<?php echo isset($userDetails['street']) ? $userDetails['street'] : ''; ?>'>
    </td>
</tr>

  </form>

</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>

  $('#updateFormInput').on('submit',function(e){

    e.preventDefault();
    
      
    $.ajax({
        url:'controller-user.php',
        type:'POST',
        data:$('#updateFormInput').serialize(),
        dataType:'json',
        success:function(res){
            
            if(res.success == true){
               Swal.fire({
                position: "center",
                icon: "success",
                title: res.message,
                showConfirmButton: true,
                timer: 1500
                });


                setTimeout(() => {
                  location.reload();
                }, 1500);

                

            }
            
        }
    })



  })

</script> 