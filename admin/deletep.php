<?php
session_start();
require '../connection.php';

if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];

    $del_query = "DELETE FROM archive WHERE product_id='$product_id'";

    $del_result = mysqli_query($con, $del_query);

    if ($del_result) {
        $_SESSION['success'] = "Product successfully deleted";
        header("Location: archive.php");
        exit();
    } else {
        $_SESSION['danger'] = "Failed to delete product";
        header("Location: archive.php");
        exit();
    }
} else {
    $_SESSION['danger'] = "Product ID not specified";
    header("Location: archive.php");
    exit();
}
?>
