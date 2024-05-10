<?php
require '../connection.php';
session_start();
if (isset($_POST['order_btn'])) {

    $useradmin_id = $_SESSION['useradmin_id'];

    $fullname = mysqli_real_escape_string($con, $_POST['fullname']);
    $contact = mysqli_real_escape_string($con, $_POST['contact']);
    $houseno = mysqli_real_escape_string($con, $_POST['houseno']);
    $purok = mysqli_real_escape_string($con, $_POST['purok']);
    $street = mysqli_real_escape_string($con, $_POST['street']);
    $category = mysqli_real_escape_string($con, $_POST['category']);

    $cart_query = mysqli_query($con, "SELECT * FROM `cartadmin` WHERE useradmin_id = '$useradmin_id'");
    $price_total = 0;
    $product_name = array();
    if (mysqli_num_rows($cart_query) > 0) {
        while ($product_item = mysqli_fetch_assoc($cart_query)) {
            $product_name[] = $product_item['type'] . ' (' . $product_item['quantity'] . ') ';
            $product_price = number_format((float)$product_item['price'] * $product_item['quantity']);
            $price_total += $product_price;
        };
    };

    $total_product = implode(', ', $product_name);

    $insert_stmt = $con->prepare("INSERT INTO `order`(`fullname`, `contact`, `houseno`, `purok`, `street`, `category`, `total_products`, `total_price`, `useradmin_id`) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $insert_stmt->bind_param("ssssssssi", $fullname, $contact, $houseno, $purok, $street, $category, $total_product, $price_total, $useradmin_id);

    $detail_query = $insert_stmt->execute();

    if ($detail_query) {

        $clear_cart_query = mysqli_query($con, "DELETE FROM `cartadmin` WHERE useradmin_id = '$useradmin_id'");
    } else {
        echo "Error: " . $insert_stmt->error;
    }

    $insert_stmt->close();
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
    font-family: Times New Roman;
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
    max-width: 50%
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

  <p style="margin-top: 40px; background-color: #00C2FF; padding-right: 10px; padding-left: 10px"> <b> Water Refilling Station </b></p>
  <center> <p style="color: white; font-size: 20px;padding-top: 20px; padding-bottom: 30px"> Administrator </p> </center>

  <a href="dashboard.php"> <img style="padding-right: 5px; margin-left: 35px" src="../images/dashboard.png" height="25px" width="30px"> Dashboard </a>
  <a href="products.php"> <img style="padding-right: 5px; margin-left: 35px" src="../images/products.png" height="25px" width="30px"> Products </a>
  <a class="active" href="orders.php"> <img style="padding-right: 5px; margin-left: 35px;" src="../images/notification.png" height="25px" width="30px"> Orders </a>
  <a href="reviews.php"> <img style="padding-right: 5px; margin-left: 35px" src="../images/review.png" height="30px" width="30px"> Feedback </a>
  <a href="reports.php"> <img style="padding-right: 5px; margin-left: 35px" src="../images/reports.png" height="25px" width="30px"> Reports </a>
  <a href="settings.php"> <img style="padding-right: 5px; margin-left: 35px" src="../images/settings.png" height="30px" width="30px">Settings </a>
  <br> <br> <br>
  <a href="login.php"> <img style="padding-right: 5px; margin-left: 35px;" src="../images/logout.png" height="30px" width="30px"> Log Out</a>
</div>

<div class="content">

<?php
if ($cart_query && $detail_query) {
    echo "
      <div class='order-message-container'>
      <div class='message-container'>
         <h3>Thank You For Trusting Our Products!</h3>
         <div class='display-order'>
            <span>" . $total_product . "</span> <br>
            <span class='total'> Total Amount: " . $price_total . " Pesos  </span>
         </div>
         <div class='customer-details'>
            <p> Fullname : <span>" . $fullname . "</span> </p>
            <p> Contact : <span>" . $contact . "</span> </p>
            <p> Address : <span>" . $houseno . ", " . $purok . ", " . $street . "</span> </p>
            <p> Category : <span>" . $category . "</span> </p>
         </div>
            <a href='orders.php' class='btn'> Exit </a>
         </div>
      </div>
      ";
}
?>
</html>