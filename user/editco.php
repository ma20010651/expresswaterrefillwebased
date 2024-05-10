<?php
session_start();
require '../connection.php';

if(isset($_POST['edit'])){

	$ref_number = $_POST['ref_number'];
	$status = $_POST['status'];
	$reason = $_POST['reason'];
	
$query = "UPDATE `transaction` SET
	`status`='$status',
	`reason`='$reason'

	 WHERE `ref_number`='$ref_number'";

	$result = mysqli_query($con,$query);

	if($result){
		$_SESSION['success'] = "Successfully Updated";
		echo "<script>window.location.href='cancellation.php'</script>";
	}else{
		$_SESSION['danger'] = "Failed to Update";
		echo "<script>window.location.href='cancellation.php?ref_number=$ref_number'</script>";
	}
}
?>