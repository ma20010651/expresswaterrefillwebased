<?php
require '../connection.php';

session_start();

$user_id = $_SESSION['user_id'];


$houseno = $_POST['houseno'];
$street = $_POST['street'];
$barangay = $_POST['barangay'];
$city = $_POST['city'];
$province = $_POST['province'];
$country = $_POST['country'];
$pin_code = $_POST['pin_code'];

$response = array();


$updateQuery = mysqli_query($con, "UPDATE  billing_address SET houseno='$houseno',street='$street',barangay='$barangay',city='$city',province='$province',country='$country',pin_code='$pin_code' WHERE user_id='$user_id' ") or die('query failed');


if ($updateQuery) {

  $response = array('success' => true, 'message' => 'Billing information updated successfully');

} else {
  $response = array('success' => false, 'message' => 'Failed to update');

}


echo json_encode($response);