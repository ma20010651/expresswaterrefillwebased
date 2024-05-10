<?php
session_start();
require '../connection.php';

if(isset($_POST['edit'])){

	$useradmin_id = $_POST['useradmin_id'];
	$status = $_POST['status'];
	
$query = "UPDATE `useradmin` SET
	`status`='$status'

	 WHERE `useradmin_id`='$useradmin_id'";

	$result = mysqli_query($con,$query);

	if($result){
		$_SESSION['success'] = "Successfully Updated";
		echo "<script>window.location.href='clients.php'</script>";
	}else{
		$_SESSION['danger'] = "Failed to Update";
		echo "<script>window.location.href='clients.php?useradmin_id=$useradmin_id'</script>";
	}
}
?>