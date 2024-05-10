<?php 
session_start();
require '../connection.php';

if (isset($_POST ['add'])) {
 
 $title =  $_POST['title'];
 $description =  $_POST['description'];  
 $current_price =  $_POST['current_price'];
 $old_price =  $_POST['old_price'];
 $subscription_type =  $_POST['subscription_type'];  
 $status =  $_POST['status'];

$user_query = "INSERT INTO `plans`(`title`, `description`, `current_price`, `old_price`, `subscription_type`, `status`) VALUES ('$title','$description','$current_price','$old_price','$subscription_type','$status')";

$user_result = mysqli_query($con,$user_query);

if($user_result){

	 	$_SESSION['success'] = "Successfully Added!";
	 	echo"<script>window.location.href='plans.php'</script>";
	 }else{
	 	$_SESSION['danger'] = "Failed to Add";
	 	echo"<script>window.location.href='plans.php'</script>";
	 }
}
?>


