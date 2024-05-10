<?php
session_start();
require '../connection.php';

if(isset($_POST['edit'])){

	$id = $_POST['id'];
	$status = $_POST['status'];
	
$query = "UPDATE `applicant` SET
	`status`='$status'

	 WHERE `id`='$id'";

	$result = mysqli_query($con,$query);

	if($result){
		$_SESSION['success'] = "Successfully Updated";
		echo "<script>window.location.href='applicant.php'</script>";
	}else{
		$_SESSION['danger'] = "Failed to Update";
		echo "<script>window.location.href='applicant.php?id=$id'</script>";
	}
}
?>