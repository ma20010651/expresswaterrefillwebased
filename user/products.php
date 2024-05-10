<?php
session_start();
require '../connection.php';
require 'settings_function.php';

$user_id = $_SESSION['user_id'];
$user_query = mysqli_query($con, "SELECT useradmin_id FROM `users` WHERE user_id = '$user_id'");

if (isset($_SESSION['notification'])) {
    echo "<div class='notification'>" . $_SESSION['notification'] . "</div>";
    unset($_SESSION['notification']); // Remove the notification message from the session
}

if ($user_query) {
    $user_row = mysqli_fetch_assoc($user_query);
    $useradmin_id = $user_row['useradmin_id'];

    $products_query = mysqli_query($con, "SELECT * FROM `products` WHERE useradmin_id = '$useradmin_id'");

} else {
    
    echo "Error fetching user information";
}

$insert_query = false; 

if (isset($_POST['add_to_cart'])) {
    $type = $_POST['type'];
    $price = $_POST['price'];
    $image = $_POST['image'];

    $check_query = mysqli_query($con, "SELECT * FROM `cart` WHERE useradmin_id = '$useradmin_id' AND type = '$type' AND user_id = '$user_id'");
    $check_row = mysqli_fetch_assoc($check_query);

    if (!$check_row) {
        $insert_query = mysqli_query($con, "INSERT INTO `cart` (useradmin_id, type, price, image,user_id) VALUES ('$useradmin_id', '$type', '$price', '$image','$user_id')");

}
}

?>

<!DOCTYPE html>
<html>
<head>

  <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
  <script src = "../js/bootstrap.bundle.min.js"></script>

   <title> Products </title>

</head>
<body>

<style>

body {
  margin: 0;
  font-family: Times New Roman;
  background-color:white;
}

.notification {
    background-color: #28a745;
    color: #fff;
    padding: 10px;
    margin: 10px 0;
    border-radius: 5px;
    text-align: center;
    width: 100%;
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
  float: right;
  margin-right: 20px
}
.cart {
  font-size: 20px;
  color: #333;
  float: right;
 
}
.notification-bar {
    position: fixed;
    top: 20px;
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
$user_id = $_SESSION['user_id'];

$select_rows = mysqli_query($con, "SELECT * FROM `cart` WHERE useradmin_id = '$useradmin_id' AND user_id = '$user_id'") or die('query failed');
$row_count = mysqli_num_rows($select_rows);
?>

<div class="header">

        <div class="dropdown">

        <a href="#" class="dropdown-toggle" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: white; margin-right: 20px">
            <img style="padding-right: 5px; margin-left: 35px;" src="../images/login.png" height="20px" width="30px"> <?php
  require '../connection.php';

    $user_id = $_SESSION['user_id'];

    $user = getUserSetting($user_id, $con);

    echo $user['fullname'];
?> 
        </a>
        <ul class="dropdown-menu" aria-labelledby="profileDropdown">

            <li><a class="dropdown-item" href="myprofile.php">My Profile</a></li>
        </ul>
    </div>
</div>

<div class="sidenav">

  <p style="margin-top: 40px; background-color: #00C2FF; padding-right: 10px; padding-left: 10px"> <b>
   <?php
  require '../connection.php';

    $user_id = $_SESSION['user_id'];

    $user = getUserSetting($user_id, $con);

   echo $user['company'];
?> </b>
  <center> <p style="color: white; font-size: 20px;padding-top: 40px; padding-bottom: 40px"> <?php
  require '../connection.php';

    $user_id = $_SESSION['user_id'];

    $user = getUserSetting($user_id, $con);

    echo "@" . $user['username'];
?>  </p>  </center>

<br>
  <a class="active" href="products.php"> <img style="padding-right: 5px; margin-left: 35px" src="../images/products.png" height="25px" width="30px"> Products </a>
  <a href="feedback.php"> <img style="padding-right: 5px; margin-left: 35px" src="../images/review.png" height="30px" width="30px"> Reviews </a>
  <a href="order.php"> <img style="padding-right: 5px; margin-left: 35px" src="../images/order.png" height="30px" width="30px"> Orders </a>
  <br> <br> <br> <br>
  <a href="logout.php"> <img style="padding-right: 5px; margin-left: 35px;" src="../images/logout.png" height="30px" width="30px"> Log Out</a>
  
</div>

<div class="content">
<a href="cart.php" class="cart-link">
            <span class="cart-icon">&#x1F6D2;</span>
            <a href="cart.php" class="cart">Cart <span><?php echo $row_count; ?></span> </a>
        </a>
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
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    var notificationBar = document.querySelector('.notification-bar');

    <?php if ($insert_query) { ?>
    notificationBar.innerText = "Item added to cart successfully!";
    notificationBar.classList.add('show');

    setTimeout(function() {
        notificationBar.classList.remove('show');
    }, 3000);
    <?php } ?>
});
</script>
<div class="notification-bar"></div>
</body>
</html>