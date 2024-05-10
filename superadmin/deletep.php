<?php 
session_start();
require '../connection.php';

if (isset($_GET['userdelete'])) {

$id = $_GET['id'];

$del_query = "DELETE FROM `plans` WHERE id='$id'";

$del_result = mysqli_query($con,$del_query);

	if ($del_result) {
		$_SESSION['success'] = "Successfully Deleted";
		echo "<script>window.location.href='plans.php' </script>";
	} else{
		$_SESSION['danger'] = "Failed to Delete";
		echo "<script>window.location.href='plans.php' </script>";
	}
}

?>
