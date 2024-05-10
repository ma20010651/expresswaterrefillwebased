<?php
require '../connection.php';
require 'settings_function.php';
session_start();

if (!isset($_SESSION['user_id'])) {

    header("Location: login.php");
    exit();
}


$user_id = $_SESSION['user_id'];
$query = $con->prepare("SELECT * FROM `billing_information` WHERE `user_id` = ?");
$query->bind_param("i", $user_id);
$query->execute();
$result = $query->get_result();

if ($result->num_rows == 1) {

    $userDetails = $result->fetch_assoc();
} else {
 
   header("Location: myprofile.php?failed=billing");
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

   <title>Delivery Address</title>

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

    $user_id = $_SESSION['user_id'];


    $user = getUserSetting($user_id, $con);


   echo $user['company'];
?> </b>
  <center> <p style="color: white; font-size: 20px;padding-top: 40px; padding-bottom: 40px"> <?php
  require '../connection.php';
  
    $user_id = $_SESSION['user_id'];

    
    $user = getUserSetting($user_id, $con);

  
    echo $user['fullname'];
?>  </p>  </center>

  <a href="myprofile.php"> <img style="padding-right: 5px; margin-left: 35px;" src="../images/login.png" height="20px" width="30px"> My Profile </a>
   <a class="active" href="shipping_address.php"> <img style="padding-right: 5px; margin-left: 35px;" src="../images/delivery.png" height="20px" width="30px">Delivery Address</a>

  <a href="products.php"> <img style="padding-right: 5px; margin-left: 35px" src="../images/products.png" height="25px" width="30px"> Products </a>
  <a href="feedback.php"> <img style="padding-right: 5px; margin-left: 35px" src="../images/review.png" height="30px" width="30px"> Reviews </a>
  <a href="order.php"> <img style="padding-right: 5px; margin-left: 35px" src="../images/order.png" height="30px" width="30px"> Orders </a>
  <br> <br> <br>
  <a href="logout.php"> <img style="padding-right: 5px; margin-left: 35px;" src="../images/logout.png" height="30px" width="30px"> Log Out</a>
</div>

<div class="content">

<?php
$isBilling = count($userDetails) > 0 ? true : false;




if($isBilling){
  ?>
  <form id='updateFormInput'>
   <div style='width:94%;' class='d-flex justify-content-end align-items-end my-4'>
     <button type="submit" class="btn btn-success"> <img src="../images/edit.png" height="20px" width="20px"> Update </button>

   </div>
   <table border="1" style="border-collapse: collapse; border-radius: 10px; overflow: hidden;">
    <h4 class='text-center'>Delivery Address Information </h4>
    <tr>
    <td style='background-color:#f5f5f5; color: #333; width: 10%;'><b>House Number</b></td>
    <td style='width: 70%;'>
    <input type="text" name="houseno" class="form-control"  value='<?php echo $userDetails['houseno']; ?>'>
  
        </td>
      </tr>
  
      <tr>
        <td style='background-color:#f5f5f5; color: #333; width: 10%;'><b>Street</b></td>
        <td style='width: 70%;'>
          <input type="text" name="street" class="form-control" value='<?php echo $userDetails['street']; ?>'>
  
        </td>
      </tr>
  
      <tr>
        <td style='background-color:#f5f5f5; color: #333; width: 10%;'><b>Barangay</b></td>
        <td style='width: 70%;'>
          <input type="text" name="barangay" class="form-control" value='<?php echo $userDetails['barangay']; ?>'>
  
        </td>
      </tr>
  
      <tr>
        <td style='background-color:#f5f5f5; color: #333; width: 10%;'><b>City</b></td>
        <td style='width: 70%;'>
          <input type="text" name="city" class="form-control" value='<?php echo $userDetails['city']; ?>'>
  
        </td>
      </tr>
  
      <tr>
        <td style='background-color:#f5f5f5; color: #333; width: 10%;'><b>Province</b></td>
        <td style='width: 70%;'>
          <input type="text" name="province" class="form-control" value='<?php echo $userDetails['province']; ?>'>
  
        </td>
      </tr>
  
  
      <tr>
        <td style='background-color:#f5f5f5; color: #333; width: 10%;'><b>Zip code</b></td>
        <td style='width: 70%;'>
          <input type="text" name="pin_code" class="form-control" value='<?php echo $userDetails['pin_code']; ?>'>
  
        </td>
  
      </tr>
  
  
      <tr>
        <td style='background-color:#f5f5f5; color: #333; width: 10%;'><b>Country</b></td>
        <td style='width: 70%;'>
          <input type="text" name="country" class="form-control" value='<?php echo $userDetails['country']; ?>'>
  
        </td>
  
      </tr>
  
  </form>
  <?php
}
  else{
    ?>

    <div class="alert alert-warning" role="alert">
      No billing address found
    </div>

    <?php
  }
?>

</div>
</div>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>

<script>

  $('#updateFormInput').on('submit',function(e){

    e.preventDefault();
    
      
    $.ajax({
        url:'controller-users.php',
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