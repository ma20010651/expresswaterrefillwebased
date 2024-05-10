<?php

require __DIR__ . '/../connection.php';
// perform ALL the queries
if (isset($_POST['usersearch'])) {
	$uservaluesearch = $_POST['uservaluesearch'];
//concat() = function that adds two or more function together

	$user_query = "SELECT * FROM `settings` WHERE CONCAT(`type`) LIKE '%".$uservaluesearch."%'";

	$user_result = mysqli_query($con,$user_query);
}else{
$user_query = "SELECT * FROM `settings`";

// mysqli_query() - perform query againts the table on the DB.

$user_result = mysqli_query($con,$user_query);
}
//print_r($user_result)

?>