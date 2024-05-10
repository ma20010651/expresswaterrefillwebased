<?php

require '../connection.php';

if (isset($_POST['usersearch'])) {
	$uservaluesearch = $_POST['uservaluesearch'];


	$user_query = "SELECT * FROM `applicant` where CONCAT(`firstname`) LIKE '%".$uservaluesearch."%'";

	$user_result = mysqli_query($con,$user_query);
}else{
$user_query = "SELECT * FROM `applicant` ORDER BY id DESC";



$user_result = mysqli_query($con,$user_query);
}


?>