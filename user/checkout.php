<?php
require '../connection.php';
require 'settings_function.php';
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page if the user is not logged in
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>

  <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
  <script src = "../js/bootstrap.bundle.min.js"></script>

   <title> Checkout </title>

</head>
<body>

<style>

body {
    margin: 0;
    font-family: 'Copperplate', sans-serif;
    background-color: white;
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
  padding-left: 10px;
}

.header{
  background-color: #333;
  text-align: right;
  color: #333;
  font-size: 15px
}

  .container {
    max-width: 98%;
    margin: 10px auto;
    padding-top: 5px
  }

  .checkout-form {
    background-color: #f4f4f4;
    padding: 20px;
    border-radius: 10px;
  }

  .heading {
    text-align: center;
    color: #333;
    font-size: 28px;
    margin-bottom: 20px;
  }

  .display-order {
    text-align: center;
    margin-bottom: 20px;
  }

  .display-order span {
    display: inline-block;
    padding: 5px 10px;
    background-color: #ddd;
    margin: 5px;
    border-radius: 5px;
  }

  .grand-total {
    font-weight: bold;
    display: block;
    margin-top: 10px;
  }

  .flex {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
  }

  .inputBox {
    width: calc(50% - 10px);
    margin-bottom: 10px;
  }

  .inputBox span {
    display: block;
    margin-bottom: 5px;
    color: #333;
  }

  input,
  select {
    width: 100%;
    padding: 5px;
    border: 1px solid #ccc;
    border-radius: 5px;
  }

  .btn {
    background-color: #00C2FF;
    color: white;
    padding: 10px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    width: 30%;
  }

  .btn:hover {
    background-color: #00afe6;
  }

  .order-message-container {
    text-align: center;
    margin: 50px auto;
  }

  .message-container {
    background-color: #f4f4f4;
    padding: 20px;
    border-radius: 10px;
  }

  .order-detail span {
    display: block;
    margin-bottom: 10px;
  }

  .customer-details p {
    margin-bottom: 10px;
  }
</style>

<div class="header">
  .
</div>

<div class="sidenav">

  <p style="margin-top: 40px; background-color: #00C2FF; padding-right: 10px; padding-left: 10px"> <b>
    <?php
  require '../connection.php';
    // Assuming you have a user ID stored in your session
    $user_id = $_SESSION['user_id'];

    // Fetch the settings data
    $user = getUserSetting($user_id, $con);

    // Display the image from settings
   echo $user['company'];
?> </b>
  <center> <p style="color: white; font-size: 20px;padding-top: 40px; padding-bottom: 40px"> <?php
  require '../connection.php';
    // Assuming you have a user ID stored in your session
    $user_id = $_SESSION['user_id'];

    // Fetch the settings data
    $user = getUserSetting($user_id, $con);

    // Display the image from settings
    echo $user['fullname'];
?>  </p>  </center>

  <a href="myprofile.php"> <img style="padding-right: 5px; margin-left: 35px;" src="../images/login.png" height="20px" width="30px"> My Profile </a>
  <a class="active" href="products.php"> <img style="padding-right: 5px; margin-left: 35px" src="../images/products.png" height="25px" width="30px"> Products </a>
  <a href="feedback.php"> <img style="padding-right: 5px; margin-left: 35px" src="../images/review.png" height="30px" width="30px"> Reviews </a>
  <br> <br> <br> <br> <br>
  <a href="login.php"> <img style="padding-right: 5px; margin-left: 35px;" src="../images/logout.png" height="30px" width="30px"> Log Out</a>
</div>

<div class="content">
<div class="container">

<section class="checkout-form">

   <h1 class="heading"> Complete Your Order</h1>

   <form action="checkoutsuccess.php" method="post">

      <div class="flex">
         <div class="inputBox">
            <span> Full Name: </span>
            <input type="text" placeholder="Enter your Full Name" name="fullname" required>
         </div>
         <div class="inputBox">
            <span> Contact Number: </span>
            <input type="number" placeholder="Enter your Contact Number" name="contact" required>
         </div>
         <div class="inputBox">
            <span> Email Address: </span>
            <input type="email" placeholder="Enter your Email Address" name="email" required>
         </div>
         <div class="inputBox">
            <span> Payment Method </span>
            <select name="payment">
               <option value="Cash On Delivery" selected>Cash On Delivery</option>
               <option value="Gcash"> Gcash </option>
            </select>
         </div>
         <div class="inputBox">
            <span> House No. </span>
            <input type="text" placeholder="House No. / Purok " name="houseno" required>
         </div>
         <div class="inputBox">
            <span> Street </span>
            <input type="text" placeholder="Street Name" name="street" required>
         </div>
         <div class="inputBox">
            <span> Barangay </span>
            <input type="text" placeholder="Barangay" name="barangay" required>
         </div>
         <div class="inputBox">
            <span> City </span>
            <input type="text" placeholder="City " name="city" required>
         </div>
         <div class="inputBox">
            <span> Province </span>
            <input type="text" placeholder="Province " name="province" required>
         </div>
         <div class="inputBox">
            <span> Country </span>
            <input type="text" placeholder="Country" name="country" required>
         </div>
         <div class="inputBox">
            <span> Zip Code </span>
            <input type="text" placeholder="Zipcode" name="pin_code" required>
         </div>
            <input type="text" hidden="" value="To Be Deliver" name="status" required>
            <input type="text" hidden="" value="Online" name="category" required>
      </div>
      <center> <input type="submit" value="Checkout" name="order_btn" class="btn"> </center>
   </form>

</section>

</div>
</div>
</body>
</html>