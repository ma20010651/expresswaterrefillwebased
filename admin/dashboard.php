<?php
require '../connection.php';
require 'settings_function.php';
session_start();

if (!isset($_SESSION['useradmin_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>

  <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
  <script src = "../js/bootstrap.bundle.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

   <title> Dashboard </title>

</head>
<body>

<style>

body {
  margin: 0;
  font-family: Times New Roman;
  background-color:white;
  overflow-x: hidden;
}

.sidenav {
  height: 100%;
  width: 200px;
  position: fixed;
  z-index: 1;
  top: 0;
  left: 0;
  background-color: #333;
  overflow-x: hidden;
  text-align: left;
  color: white;
}

.sidenav a {
  color: white;
  padding: 10px;
  text-decoration: none;
  display: block;
}

/* Change color on hover */
.sidenav a:hover {
  background-color: #DDDDDD;
  color: #333;
}
.sidenav a.active {
  background-color: #00C2FF;
  color:white;
}

.content {
  margin-left: 200px;
  padding-left: 20px;
}

.header{
  background-color: #333;
  text-align: right;
  color: #333;
  font-size: 15px
}

.system-logo {
    color: #333;
    font-size: 30px
}

.card {
      max-width: 18rem;
      margin-left: 30px;
      font-size: 20px
    }

</style>

<div class="header">
 	.
</div>

<div class="sidenav">

  <p style="margin-top: 40px; background-color: #00C2FF; padding-right: 10px; padding-left: 10px"> <b>
    <?php
  require '../connection.php';
    $useradmin_id = $_SESSION['useradmin_id'];
    $user = getUserSettings($useradmin_id, $con);
   echo $user['codename']. ' - ' . $user['company'];
?> </b></p>
  <center> <p style="color: white; font-size: 20px;padding-top: 20px; padding-bottom: 20px"> <?php
  require '../connection.php';
    $useradmin_id = $_SESSION['useradmin_id'];
    $user = getUserSettings($useradmin_id, $con);
    echo $user['firstname'];
?>  </p> </center>

  <a class="active" href="dashboard.php"> <img style="padding-right: 5px; margin-left: 35px;" src="../images/dashboard.png" height="25px" width="30px"> Dashboard </a>
  <a href="products.php"> <img style="padding-right: 5px; margin-left: 35px" src="../images/products.png" height="25px" width="30px"> Products </a>
  <a href="orders.php"> <img style="padding-right: 5px; margin-left: 35px;" src="../images/notification.png" height="25px" width="30px"> Orders </a>
  <a href="reviews.php"> <img style="padding-right: 5px; margin-left: 35px" src="../images/review.png" height="30px" width="30px"> Feedback </a>
  <a href="reports.php"> <img style="padding-right: 5px; margin-left: 35px" src="../images/reports.png" height="25px" width="30px"> Reports </a>
  <a href="settings.php"> <img style="padding-right: 5px; margin-left: 35px" src="../images/settings.png" height="30px" width="30px">Settings </a>
  <br> <br> <br>
  <a href="login.php"> <img style="padding-right: 5px; margin-left: 35px;" src="../images/logout.png" height="30px" width="30px"> Log Out</a>
</div>

<div class="content">
        <div class="system-logo">
            <?php
            $useradmin_id = $_SESSION['useradmin_id'];
            $user = getUserSettings($useradmin_id, $con);

            echo $user['codename'] . ' - ' . $user['company'];
            ?>
            <hr></div>
            <div class="row d-flex justify-content-start align-items-center mt-5">
                <div class="card text-white bg-primary mb-3" style="width: 100%">
                    <div class="card-header">Products</div>
                    <div class="card-body">
                        <?php
                        $useradmin_id = $_SESSION['useradmin_id'];
                        $query = "SELECT COUNT(*) AS product_count FROM `products` WHERE `useradmin_id` = $useradmin_id";
                        $result = $con->query($query);

                        if ($result && $result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            echo '<h2 class="card-title">' . number_format($row['product_count']) . '</h2>';
                            echo '<p class="card-text text-white"> Total of Products </p>';
                        } else {
                            echo "Error in query: " . $con->error;
                        }
                        ?>
                    </div>
                </div>
                
    <div class="card text-white bg-warning mb-3" style="width: 100%">
    <div class="card-header">Pending Orders</div>
    <div class="card-body">
        <h2 class="card-title">
             <?php
                        $useradmin_id = $_SESSION['useradmin_id'];
                        $query = "SELECT COUNT(*) AS order_count FROM transaction t
                    INNER JOIN billing_address b ON b.id = t.billing_address
                    INNER JOIN users u ON u.user_id = b.user_id
                    WHERE u.useradmin_id = '$useradmin_id' AND t.status = 'Pending'";
                        $result = $con->query($query);

                        if ($result && $result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            echo '<h2 class="card-title">' . number_format($row['order_count']) . '</h2>';
                        } else {
                            echo "Error in query: " . $con->error;
                        }
                        ?>

        </h2>
        <p class="card-text text-white">Total of Pending Orders</p>
    </div>
</div>

<div class="card text-white bg-info mb-3" style="width: 100%">
    <div class="card-header">Out for Delivery Orders</div>
    <div class="card-body">
        <h2 class="card-title">
            <?php
                        $useradmin_id = $_SESSION['useradmin_id'];
                        $query = "SELECT COUNT(*) AS order_count FROM transaction t
                    INNER JOIN billing_address b ON b.id = t.billing_address
                    INNER JOIN users u ON u.user_id = b.user_id
                    WHERE u.useradmin_id = '$useradmin_id' AND t.status = 'Out for Delivery'";
                        $result = $con->query($query);

                        if ($result && $result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            echo '<h2 class="card-title">' . number_format($row['order_count']) . '</h2>';
                        } else {
                            echo "Error in query: " . $con->error;
                        }
                        ?>
        </h2>
        <p class="card-text text-white">Total of Out for Delivery</p>
    </div>
</div>

<div class="card text-white bg-success mb-3" style="width: 100%">
    <div class="card-header">Delivered Orders</div>
    <div class="card-body">
        <h2 class="card-title">
            <?php
                        $useradmin_id = $_SESSION['useradmin_id'];
                        $query = "SELECT COUNT(*) AS order_count FROM transaction t
                    INNER JOIN billing_address b ON b.id = t.billing_address
                    INNER JOIN users u ON u.user_id = b.user_id
                    WHERE u.useradmin_id = '$useradmin_id' AND t.status = 'Delivered'";
                        $result = $con->query($query);

                        if ($result && $result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            echo '<h2 class="card-title">' . number_format($row['order_count']) . '</h2>';
                        } else {
                            echo "Error in query: " . $con->error;
                        }
                        ?>
        </h2>
        <p class="card-text text-white">Total of Delivered Orders</p>
    </div>
</div>

<div class="card text-white bg-danger mb-3" style="width: 100%">
    <div class="card-header">Cancelled Orders</div>
    <div class="card-body">
        <h2 class="card-title">
            <?php
                        $useradmin_id = $_SESSION['useradmin_id'];
                        $query = "SELECT COUNT(*) AS order_count FROM transaction t
                    INNER JOIN billing_address b ON b.id = t.billing_address
                    INNER JOIN users u ON u.user_id = b.user_id
                    WHERE u.useradmin_id = '$useradmin_id' AND t.status = 'Cancelled'";
                        $result = $con->query($query);

                        if ($result && $result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            echo '<h2 class="card-title">' . number_format($row['order_count']) . '</h2>';
                        } else {
                            echo "Error in query: " . $con->error;
                        }
                        ?>
        </h2>
        <p class="card-text text-white">Total of Cancelled Orders</p>
    </div>
</div>

<div class="card text-white bg-primary mb-3" style="width: 100%">
    <div class="card-header">Walk-In Orders</div>
    <div class="card-body">
        <h2 class="card-title">
            <?php
                        $useradmin_id = $_SESSION['useradmin_id'];
                        $query = "SELECT COUNT(*) AS order_count FROM `order` WHERE `useradmin_id` = $useradmin_id";
                        $result = $con->query($query);

                        if ($result && $result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            echo '<h2 class="card-title">' . number_format($row['order_count']) . '</h2>';
                        } else {
                            echo "Error in query: " . $con->error;
                        }
                        ?>
        </h2>
        <p class="card-text text-white">Total of Walk-In Orders</p>
    </div>
</div>
            </div>
        </div>
    </div>
</body>
</html>