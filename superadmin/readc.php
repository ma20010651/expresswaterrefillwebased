<?php

require '../connection.php';

if (isset($_POST['usersearch'])) {
	$uservaluesearch = $_POST['uservaluesearch'];

	$user_query = "SELECT * FROM `useradmin` where CONCAT(`firstname`, `codename`) LIKE '%".$uservaluesearch."%'";

	$user_result = mysqli_query($con,$user_query);
}else{
$user_query = "SELECT * FROM `useradmin`";


$user_result = mysqli_query($con,$user_query);
}

?>