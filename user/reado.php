<?php

require '../connection.php';

if (isset($_POST['usersearch'])) {
	$uservaluesearch = $_POST['uservaluesearch'];


	$user_query = "SELECT * FROM `order` WHERE CONCAT(`fullname`, `payment`, `street`, `status`) LIKE '%".$uservaluesearch."%'";

	$user_result = mysqli_query($con,$user_query);
}else{
$user_query = "SELECT * FROM `order`";



$user_result = mysqli_query($con,$user_query);
}


?>