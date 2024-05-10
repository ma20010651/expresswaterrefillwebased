<?php
require '../connection.php';

session_start();

$user_id = $_SESSION['user_id'];

$fullname = $_POST['fullname'];
$contact = $_POST['contact'];
$username = $_POST['username'];
$email = $_POST['email'];

$houseno = $_POST['houseno'];
$purok = $_POST['purok'];
$street = $_POST['street'];

$response = array();


$updateUserQuery = mysqli_query($con, "UPDATE users SET fullname='$fullname', contact='$contact', username='$username', email='$email' WHERE user_id='$user_id'") or die('User update query failed');


$updateAddressQuery = mysqli_query($con, "UPDATE billing_address SET houseno='$houseno', purok='$purok', street='$street' WHERE user_id='$user_id'") or die('Address update query failed');

if ($updateUserQuery && $updateAddressQuery) {
    $response = array('success' => true, 'message' => 'Profile updated successfully');
} else {
    $response = array('success' => false, 'message' => 'Failed to update');
}

echo json_encode($response);
?>
