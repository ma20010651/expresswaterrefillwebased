<?php
require '../connection.php';
session_start();

if (!isset($_SESSION['useradmin_id'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];

    $useradmin_id = $_SESSION['useradmin_id'];
    $archive_query = "SELECT * FROM archive WHERE product_id = '$product_id' AND useradmin_id = '$useradmin_id'";
    $archive_result = mysqli_query($con, $archive_query);

    if ($archive_result && mysqli_num_rows($archive_result) > 0) {
        $archive_row = mysqli_fetch_assoc($archive_result);

        $insert_query = "INSERT INTO products (product_id, useradmin_id, image, type, price) VALUES ('{$archive_row['product_id']}', '{$archive_row['useradmin_id']}', '{$archive_row['image']}', '{$archive_row['type']}', '{$archive_row['price']}')";
        if (mysqli_query($con, $insert_query)) {

            $delete_query = "DELETE FROM archive WHERE product_id='$product_id' AND useradmin_id='$useradmin_id'";
            if (mysqli_query($con, $delete_query)) {
                echo "<script>alert('Product successfully restored!');</script>";
                echo "<script>window.location.href='archive.php';</script>";
            } else {
                echo "<script>alert('Failed to restore product!');</script>";
                echo "<script>window.location.href='archive.php';</script>";
            }
        } else {
            echo "<script>alert('Failed to restore product!');</script>";
            echo "<script>window.location.href='archive.php';</script>";
        }
    } else {
        echo "<script>alert('Product not found in archive!');</script>";
        echo "<script>window.location.href='archive.php';</script>";
    }
} else {
    echo "<script>alert('Product ID not specified!');</script>";
    echo "<script>window.location.href='archive.php';</script>";
}
?>
