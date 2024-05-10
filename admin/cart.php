<?php
session_start();
require '../connection.php';
require 'settings_function.php';

$useradmin_id = $_SESSION['useradmin_id'];

if(isset($_POST['update_update_btn'])){
   $update_value = $_POST['update_quantity'];
   $update_id = $_POST['update_quantity_id'];
   $update_quantity_query = mysqli_query($con, "UPDATE `cartadmin` SET quantity = '$update_value' WHERE cart_id = '$update_id'");
   if($update_quantity_query){
      header('location:cart.php');
   }
}

if(isset($_GET['remove'])){
   $remove_id = $_GET['remove'];
   mysqli_query($con, "DELETE FROM `cartadmin` WHERE cart_id = '$remove_id'");
   header('location:cart.php');
}

if(isset($_GET['delete_all'])){
   mysqli_query($con, "DELETE FROM `cartadmin`");
   header('location:cart.php');
}

$cart_items_query = mysqli_query($con, "SELECT * FROM `cartadmin` WHERE useradmin_id = '$useradmin_id'");
$cart_items = mysqli_fetch_all($cart_items_query, MYSQLI_ASSOC);

?>
<!DOCTYPE html>
<html>
<head>

  <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
  <script src = "../js/bootstrap.bundle.min.js"></script>

   <title> Cart </title>

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

table, td, th {
  border: .5px solid grey;
}

table {
  border-collapse: collapse;
  width: 95%;
  margin-top: 30px;
  margin-left: 20px;
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
tr:hover {background-color: #DDDDDD}

.quantity-arrow {
    display: inline-block;
    width: 25px;
    height: 25px;
    background-color: #ccc;
    color: #333;
    font-size: 20px;
    text-align: center;
    line-height: 25px;
    cursor: pointer;
}

.quantity-arrow:hover {
    background-color: #ddd;
}

.quantity-arrow.plus {
    border: 1px solid #999;
    border-radius: 5px
}

.quantity-arrow.minus {
    border: 1px solid #999;
    border-radius: 5px
}

.quantity-dropdown {
    display: flex;
    align-items: center;
}

input[type="number"] {
    width: 43px;
    text-align: right;
    border: 1px solid #ccc;
    border-radius: 5px;
    margin: 0 5px;
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
  <a href="settings.php"> <img style="padding-right: 5px; margin-left: 35px" src="../images/settings.png" height="30px" width="30px">Settings </a>
  <br> <br> <br>
  <a href="login.php"> <img style="padding-right: 5px; margin-left: 35px;" src="../images/logout.png" height="30px" width="30px"> Log Out</a>
</div>

<div class="content">
<div class="container">

<section class="shopping-cart" style="padding-top: 20px">

   <h1 class="heading"> Shopping Cart</h1>

   <table>

      <thead>
         <th> Image </th>
         <th> Type of Container </th>
         <th> Price </th>
         <th> Quantity </th>
         <th> Total Price </th>
         <th> Action </th>
      </thead>

      <tbody>

          <?php 
         $useradmin_id = $_SESSION['useradmin_id'];

         $select_cart = mysqli_query($con, "SELECT * FROM `cartadmin` WHERE useradmin_id = '$useradmin_id'");
          $grand_total = 0;

    if (mysqli_num_rows($select_cart) > 0) {
        while ($fetch_cart = mysqli_fetch_assoc($select_cart)) {
            $sub_total = floatval($fetch_cart['price']) * intval($fetch_cart['quantity']);
          ?>
           
         <tr>
            <td><img src="../upload/<?php echo  $fetch_cart['image']; ?>" height="100" alt=""></td>
            <td><?php echo $fetch_cart['type']; ?></td>
            <td><?php echo number_format((float)$fetch_cart['price']); ?>  Pesos</td>
            <td>
                <form action="" method="post" class="quantity-form">
                    <input type="hidden" name="update_quantity_id" value="<?php echo $fetch_cart['cart_id']; ?>">
                    <div class="quantity-dropdown">
                        <span class="quantity-arrow minus" onclick="decrementQuantity(this)">-</span>
                        <input type="number" name="update_quantity" min="1" value="<?php echo $fetch_cart['quantity']; ?>">
                        <span class="quantity-arrow plus" onclick="incrementQuantity(this)">+</span>
                    </div>
                    <input type="submit" value="Update" name="update_update_btn" style="display: none;">
                </form>
            </td>
            
            <td><?php echo number_format($sub_total); ?> Pesos</td>

            <td><a href="cart.php?remove=<?php echo $fetch_cart['cart_id']; ?>" onclick="return confirm('remove item from cart?')" class="delete-btn"> <i class="fas fa-trash"></i> Remove</a></td>
         </tr>
         <?php
           $grand_total += $sub_total;  
        }
    }
?>
        <tr class="table-bottom">
    <td><a href="addcustomer.php" class="option-btn" style="margin-top: 0;"> Continue Shopping </a></td>
    <td colspan="3"> Overall Total</td>
    <td><?php echo number_format($grand_total); ?> Pesos </td>
    <td><a href="cart.php?delete_all" onclick="return confirm('are you sure you want to delete all?');" class="delete-btn"> <i class="fas fa-trash"></i> Delete All </a></td>
</tr>
<input type='hidden' id='getTotal' value='<?php echo $grand_total ?>' />

      </tbody>

   </table>

   <div class="checkout-btn"> <center>
      <a href="checkout.php" class="btn <?= ($grand_total > 1)?'':'disabled'; ?>"> Proceed to Checkout</a>
   </div></center>

<script>
    function incrementQuantity(element) {
        var inputField = element.parentNode.querySelector('input[type="number"]');
        inputField.stepUp();
        updateForm(element);
    }

    function decrementQuantity(element) {
        var inputField = element.parentNode.querySelector('input[type="number"]');
        inputField.stepDown();
        updateForm(element);
    }

    function updateForm(element) {
        var form = element.closest('form');
        var submitButton = form.querySelector('input[type="submit"]');
        submitButton.click();
    }
</script>
</section>
</div>
</div>
</body>
</html>
