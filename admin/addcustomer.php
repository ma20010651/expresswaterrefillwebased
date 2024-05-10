<?php
session_start();
require '../connection.php';
require 'settings_function.php';

if (isset($_POST['add_to_cart'])) {
    $type = $_POST['type'];
    $price = $_POST['price'];
    $image = $_POST['image'];
    $quantity = 1;

    $useradmin_id = $_SESSION['useradmin_id'];

    if (isset($_SESSION['notification'])) {
        echo "<div class='notification'>" . $_SESSION['notification'] . "</div>";
        unset($_SESSION['notification']);
    }

    $select_cart = mysqli_query($con, "SELECT * FROM `cartadmin` WHERE type = '$type' AND useradmin_id = '$useradmin_id'");

    if (mysqli_num_rows($select_cart) == 0) {
        $insert_query = mysqli_query($con, "INSERT INTO `cartadmin` (type, price, image, quantity, useradmin_id) VALUES ('$type', '$price', '$image', '$quantity', '$useradmin_id')");

        if ($insert_query) {
            $_SESSION['notification'] = "Item added to cart successfully!";
        } else {
            $_SESSION['notification'] = "Failed to add item to cart.";
        }
    } else {
        $_SESSION['notification'] = "Item already exists in the cart!";
    }
}

$useradmin_id = $_SESSION['useradmin_id'];
$products_query = mysqli_query($con, "SELECT * FROM `products` WHERE useradmin_id = '$useradmin_id'");
?>



<!DOCTYPE html>
<html>
<head>

  <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
  <script src = "../js/bootstrap.bundle.min.js"></script>

   <title> Add Customers | Walk-in </title>

</head>
<body>

<style>

body {
  margin: 0;
  font-family: Times New Roman;
  background-color:white;
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
  font-size: 15px;
  padding-right: 20px;
  padding: 10px;
}
table, td, th {
  border: .5px solid grey;
}

table {
  border-collapse: collapse;
  width: 95%;
  margin-top: 30px;
  margin-left: 20px;
}

th {
  text-align: center;
  background-color: #333;
  padding-top: 5px;
  padding-bottom: 5px;
  color: white;
}

td{
  padding-top: 10px;
  padding-bottom: 10px;
  padding-left: 10px
}
tr:hover {background-color: #DDDDDD}

form {
  display: flex;
  flex-direction: column;
  align-items: center;
}

.box-container {
  margin-block: 2rem;
  display: flex;
  flex-wrap: wrap;
  justify-content: left;
  gap: 1rem;
}

.box {
  border: 1px solid #ddd;
  padding: 20px;
  text-align: center;
  width: 250px;
  border-radius: 10px;
  flex: 1 1 auto;
}

.img-box {
    width: 100%;
    height: 180px; 
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden; 
}

.images {
    width: 90%; 
    height: auto; 
    object-fit: cover; 
}


.zoom {
    transition: transform 0.2s ease-in-out;
}

.zoom:hover {
    transform: scale(1.1);
}
h3 {
    margin-top: 10px;
    margin-bottom: 5px;
}

.btn {
    width: 100%;
    position: relative;
    border: none;
    border-radius: 5px;
    background-color: #00C2FF;
    padding: 7px 25px;
    cursor: pointer;
    color: white;
}

.btn:hover {
    background-color: #03c2c1;
}

.price {
    font-weight: bold;
    color: green;
    margin-bottom: 5px;
}
.cart-icon {
  font-size: 20px;
}
.cart {
  font-size: 20px;
  color: white;
  margin-right: 10px;
}
.notification-bar {
    position: fixed;
    top: 60px;
    right: 20px;
    background-color: #28a745;
    color: #fff;
    padding: 10px 20px;
    border-radius: 5px;
    display: none;
    z-index: 9999;
}

.notification-bar.show {
    display: block;
    animation: slideIn 0.5s forwards;
}

@keyframes slideIn {
    0% {
        transform: translateY(-100%);
    }
    100% {
        transform: translateY(0);
    }
}

</style>
<?php
$useradmin_id = $_SESSION['useradmin_id'];

$select_rows = mysqli_query($con, "SELECT * FROM `cartadmin` WHERE useradmin_id = '$useradmin_id'") or die('query failed');
$row_count = mysqli_num_rows($select_rows);
?>

<div class="header">
    <a href="cart.php" class="cart-link">
            <span class="cart-icon">&#x1F6D2;</span>
  <a href="cart.php" class="cart">Cart <span><?php echo $row_count; ?></span> </a>
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

  <a href="dashboard.php"> <img style="padding-right: 5px; margin-left: 35px" src="../images/dashboard.png" height="25px" width="30px"> Dashboard </a>
  <a href="products.php"> <img style="padding-right: 5px; margin-left: 35px" src="../images/products.png" height="25px" width="30px"> Products </a>
  <a class="active" href="orders.php"> <img style="padding-right: 5px; margin-left: 35px;" src="../images/notification.png" height="25px" width="30px"> Orders </a>
  <a href="reviews.php"> <img style="padding-right: 5px; margin-left: 35px" src="../images/review.png" height="30px" width="30px"> Feedback </a>
  <a href="reports.php"> <img style="padding-right: 5px; margin-left: 35px" src="../images/reports.png" height="25px" width="30px"> Reports </a>
  <a href="settings.php"> <img style="padding-right: 5px; margin-left: 35px" src="../images/settings.png" height="30px" width="30px">Settings </a>
  <br> <br> <br>
  <a href="login.php"> <img style="padding-right: 5px; margin-left: 35px;" src="../images/logout.png" height="30px" width="30px"> Log Out</a>
</div>

<div class="content">
<div class="notification-bar"></div>
  <center> <h1 style="color: #333; margin-top: 30px;"> <b> View Products </b> </h1> </center>
<div class="box-container">

<?php
        while ($row = mysqli_fetch_array($products_query)) {
            ?>
      <form action="" method="post">
            <input type="hidden" name="type" value="<?php echo $row['type']; ?>">
          <input type="hidden" name="price" value="<?php echo $row['price']; ?>">
          <input type="hidden" name="image" value="<?php echo $row['image']; ?>">
         <div class="box">
          <div>
              <img src="../upload/<?php echo $row['image']; ?>" style="width: 100%; height: 15rem; max-width:100%;" class="zoom">
          </div>
           <div>
             <h3><?php echo $row['type']; ?>
            </h3>
           </div>
            <div class="price"> <?php echo $row['price']; ?> Pesos </div>
         
            <input type="submit" class="btn" value="Add To Cart" name="add_to_cart">
          </div>
      </form>

<?php } ?>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var notificationBar = document.querySelector('.notification-bar');

            <?php if (isset($_SESSION['notification'])) { ?>
                notificationBar.innerText = "<?php echo $_SESSION['notification']; ?>";
                notificationBar.classList.add('show');

                setTimeout(function() {
                    notificationBar.classList.remove('show');
                }, 3000);
            <?php
                unset($_SESSION['notification']);
            } ?>
        });
    </script>
</body>
</html>