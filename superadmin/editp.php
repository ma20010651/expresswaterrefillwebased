<?php
session_start();
require '../connection.php';

if(isset($_POST['edit'])){

	$id = $_POST['id'];
	$title = $_POST['title'];
	$description = $_POST['description'];
	$current_price = $_POST['current_price'];
	$old_price = $_POST['old_price'];
	$subscription_type = $_POST['subscription_type'];
	$status = $_POST['status'];
	
$query = "UPDATE `plans` SET

	`title`='$title',
	`description`='$description',
	`current_price`='$current_price',
	`old_price`='$old_price',
	`subscription_type`='$subscription_type',
	`status`='$status'

	 WHERE `id`='$id'";

	$result = mysqli_query($con,$query);

	if($result){
		$_SESSION['success'] = "Successfully Updated";
		echo "<script>window.location.href='plans.php'</script>";
	}else{
		$_SESSION['danger'] = "Failed to Update";
		echo "<script>window.location.href='plans.php?id=$id'</script>";
	}
}
?>