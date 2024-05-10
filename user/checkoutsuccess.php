<?php

require '../connection.php';

if(isset($_POST['order_btn'])){

   $fullname = $_POST['fullname'];
   $contact = $_POST['contact'];
   $email = $_POST['email'];
   $payment = $_POST['payment'];
   $houseno = $_POST['houseno'];
   $street = $_POST['street'];
   $barangay = $_POST['barangay'];
   $city = $_POST['city'];
   $province = $_POST['province'];
   $country = $_POST['country'];
   $pin_code = $_POST['pin_code'];
   $status = $_POST['status'];
   $category = $_POST['category'];

   $cart_query = mysqli_query($con, "SELECT * FROM `cart`");
   $price_total = 0;
   if(mysqli_num_rows($cart_query) > 0){
      while($product_item = mysqli_fetch_assoc($cart_query)){
         $product_name[] = $product_item['type'] .' ('. $product_item['quantity'] .') ';
         $product_price = number_format((float)$product_item['price'] * $product_item['quantity']);
         $price_total += $product_price;
      };
   };

   $total_product = implode(', ',$product_name);
   $detail_query = mysqli_query($con, "INSERT INTO `order`(`fullname`, `contact`, `email`, `payment`, `houseno`, `street`, `barangay`, city, `province`, `country`, `pin_code`, `status`, `category`, `total_products`, `total_price`) VALUES('$fullname','$contact','$email','$payment','$houseno','$street','$barangay','$city','$province','$country','$pin_code','$status','$category','$total_product','$price_total')") or die('query failed');

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
    margin-bottom: 15px;
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
    max-width: 60%
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

  <p style="margin-top: 40px; background-color: #00C2FF; padding-right: 10px; padding-left: 10px"> <b> Chrislin Water Refilling Station </b></p>
  <center> <p style="color: white; font-size: 20px;padding-top: 40px; padding-bottom: 40px"> User </p> </center>

  <a href="myprofile.php"> <img style="padding-right: 5px; margin-left: 35px;" src="../images/login.png" height="20px" width="30px"> My Profile </a>
  <a class="active" href="products.php"> <img style="padding-right: 5px; margin-left: 35px" src="../images/products.png" height="25px" width="30px"> Products </a>
  <a href="feedback.php"> <img style="padding-right: 5px; margin-left: 35px;" src="../images/delivery.png" height="25px" width="30px"> Reviews </a>
  <br> <br> <br> <br> <br>
  <a href="login.php"> <img style="padding-right: 5px; margin-left: 35px;" src="../images/logout.png" height="30px" width="30px"> Log Out</a>
</div>

<div class="content">

<?php
if($cart_query && $detail_query){
      echo "
      <div class='order-message-container'>
      <div class='message-container'>
         <h3>Thank You For Trusting Our Products!</h3>
         <div class='display-order'>
            <span>".$total_product."</span>
            <span class='total'> Total Amount: ".$price_total." Pesos  </span>
         </div>
         <div class='customer-details'>
            <p> Fullname : <span>".$fullname."</span> </p>
            <p> Contact : <span>".$contact."</span> </p>
            <p> Email Address : <span>".$email."</span> </p>
            <p> Address : <span>".$houseno.", ".$street.", ".$barangay.", ".$city.", ".$province.", ".$country." - ".$pin_code."</span> </p>
            <p> Payment Mode : <span>".$payment."</span> </p>
            <p>(Your order has been successfully placed. Just wait for it to be delivered.)</p>
            <p> Status : <span>".$status."</span> </p>
            <p> Category : <span>".$category."</span> </p>
         </div>
            <a href='products.php' class='btn'> Cancel </a>
         </div>
      </div>
      ";
   } ?>
</html>