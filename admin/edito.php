<?php
session_start();
require '../connection.php';

if(isset($_POST['edit'])){

	$ref_number = $_POST['ref_number'];
	$status = $_POST['status'];
	
$query = "UPDATE `transaction` SET
	`status`='$status'

	 WHERE `ref_number`='$ref_number'";

	$result = mysqli_query($con,$query);

	if($result){
		$_SESSION['success'] = "Successfully Updated";
		echo "<script>window.location.href='pending.php'</script>";
	}else{
		$_SESSION['danger'] = "Failed to Update";
		echo "<script>window.location.href='pending.php?ref_number=$ref_number'</script>";
	}
}
?>