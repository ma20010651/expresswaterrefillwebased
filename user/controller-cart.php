<?php


require '../connection.php';

$action  = isset($_GET['action']) ?  $_GET['action'] : '';
$response  = array();

if($action != ''){

  if ($action == 'billing') {
    session_start();

    $user_id = $_SESSION['user_id'];


    $houseno = $_POST['houseno'];
    $purok = $_POST['purok'];
    $street = $_POST['street'];


    $billingQuery = mysqli_query($con, "INSERT INTO billing_address SET user_id='$user_id',houseno='$houseno',purok='$purok',street='$street' ") or die('query failed');


    if ($billingQuery) {

      $response = array('success' => true, 'message' => 'Address added successfully');

    } else {
      $response = array('success' => false, 'message' => 'Failed to added');

    }


  }
  if ($action == 'transaction') {


    $ref_number = $_POST['ref_number'];
    $paymentType = $_POST['paymentType'];
    $products_sold = $_POST['product_sold'];
    $quantity = $_POST['quantity'];
    $amount = $_POST['amount'];
    $category = $_POST['category'];
    $status = $_POST['status'];
    $billingId = $_POST['billingId'];

    $selectQuery = "SELECT ref_number FROM transaction WHERE ref_number='$ref_number'";
    $checkTransaction = mysqli_query($con,$selectQuery);
    

    if(mysqli_num_rows($checkTransaction) > 0){
       $response = array('success' => false, 'message' => 'Transaction reference existed');

    }else{

      $productIds = $_POST['productId'];


      $deleteCartByUser = "DELETE FROM cart WHERE cart_id IN ($productIds)";


      if ($con->query($deleteCartByUser) === TRUE) {

        $response = array('success' => true, 'message' => 'Transaction has been completed');

        $transactionQuery = mysqli_query($con, "INSERT INTO transaction SET ref_number='$ref_number',payment_type='$paymentType',products_sold='$products_sold',quantity='$quantity',amount='$amount',status='$status',category='$category',billing_address='$billingId' ") or die('query failed');


        if ($transactionQuery) {


          $response = array('success' => true, 'message' => 'Transaction has been completed');

        } else {
          $response = array('success' => false, 'message' => 'Failed to added');

        }
      }else{
        $response = array('success' => false, 'message' => 'Id on card not found');
      }
    

    }



  }
}

else{
  $response = array('success' =>false,'message'=>'Something went wrong ask for help for administrator');
}

echo json_encode($response);