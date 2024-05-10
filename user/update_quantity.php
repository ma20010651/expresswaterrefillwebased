<?php
include('../connection.php'); 
require 'settings_function.php';

if(isset($_POST['cart_id']) && isset($_POST['quantity'])) {
    $cartId = $_POST['cart_id'];
    $newQuantity = $_POST['quantity'];

    $updateQuery = "UPDATE cart SET quantity = $newQuantity WHERE cart_id = $cartId";
    mysqli_query($con, $updateQuery);

    $selectPriceQuery = "SELECT price FROM cart WHERE cart_id = $cartId";
    $priceResult = mysqli_query($con, $selectPriceQuery);
    $price = mysqli_fetch_assoc($priceResult)['price'];

    echo $price * $newQuantity; 
}
?>