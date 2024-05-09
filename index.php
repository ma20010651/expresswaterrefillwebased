<?php
require 'connection.php';
require 'superadmin/settings_function.php';

?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <script src = "js/bootstrap.bundle.min.js"></script>


  <title> Home </title>

</head>

<style>

   body {
  margin: 0;
  font-family: Times New Roman;
}

.topnav {
    overflow: hidden;
    color: #0492c2;
    font-size: 26px;
    position: relative;
    margin-top: 20px; /* Add this line for top margin */
}

.system-logo {
    float: left;
    margin-left: 50px;
}

.nav-links {
    float: right;
    margin-right: 50px;
}

.topnav a {
    text-align: center;
    text-decoration: none;
     color: #0492c2;
    font-size: 17px;
    padding: 20px 10px;
}

.topnav a:hover {
    color: #03a9a8;
}

.topnav a.active {
    color: #333;
}

.dropdown {
    position: relative;
    display: inline-block;
}

.dropbtn {
    font-size: 15px;
    border: none;
    outline: none;
    color: white;
    padding: 8px 18px;
    background-color: #03c2c1;
    border-radius: 20px;
    margin: 0;
}

.dropdown-content {
    display: none;
    position: absolute;
    top: 100%;
    background-color: #f9f9f9;
    min-width: 150px;
    box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
    z-index: 1;
    
}

.dropdown-content a {
    float: none;
    color: black;
    padding: 8px 10px;
    text-decoration: none;
    display: block;
    text-align: left;
}

.dropdown-content a:hover {
    background-color: #03c2c1;
    color: white;
}

.dropdown:hover .dropdown-content {
    display: block;
}

.system-logo img {
    width: 100%;
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

.container {
    max-width: 100%;
    height: auto;
    margin-top: 20px;
    background-image: url(images/bgg.png);
    background-repeat: no-repeat;
    background-size: cover; 
    background-position: top; 
    padding-top: 100px;
    padding-bottom:50px;
    }

    .card {
      margin-bottom: 20px;
      border-radius: 15px;
      overflow: hidden;
       margin-left: 50px;
      margin-right: 50px;
    }

    .card-body {
      text-align: center;
    }

    h3 {
      margin-bottom: 10px;
    }

    p {
      margin: 0;
    }

    .description {
      margin-top: 10px;
    }

</style>

<body>

<div class="topnav">
    <div class="system-logo">
        <?php  
            $settingsData = getSettingsData();

            foreach ($settingsData as $row) {
                echo $row['codename'] . ' - ' . $row['systemname'];
            }
        ?>
    </div>
    <a href="index.php" class="active" style="margin-left: 160px;">HOME</a>
    <a href="apply.php" style="margin-left: 5px">APPLY NOW</a>
    <div class="dropdown">
        <button class="dropbtn" style="margin-left: 10px">LOG IN</button>
        <div class="dropdown-content">
            <a href="login.php">Super Admin</a>
            <a href="admin/login.php">Administrator</a>
             <a href="user/login.php">Customer</a>
        </div>
    </div>
<?php

    $settingsData = getSettingsData();

    foreach ($settingsData as $row) {
        echo '<img src="upload/' . $row['image'] . '" style="width: 100%; margin-top: 20px">';
    }
    ?> </div><br> <br> <br>

<center> <b><h1 style="font-size: 60px"> Plans</h1></b> </center>
<div class="container mt-">
    <div class="row">
        <?php
        require 'superadmin/readp.php';
        while($row = mysqli_fetch_array($user_result)) {
        ?>
        <div class="col-md-4">
            <div class="card mb-3" style="height: 93%; margin-top: 30px;margin-bottom: 30px">
                <div class="card-body d-flex flex-column justify-content-between text-center">
                    <div>
                        <h3 class="card-title"><?php echo $row['title']; ?></h3>
                        <p style="color: green"><?php echo $row['current_price']; ?> Pesos</p>
                        <p style="color: grey; text-decoration: line-through;" class="fw-bolder fs-5"><?php echo $row['old_price']; ?> Pesos</p>

                        <p class="card-subtitle mb-2 text-muted">/ <?php echo $row['subscription_type']; ?></p>
                        <hr>
                        <p class="card-text description"><?php echo $row['description']; ?></p>
                    </div>
                    <button type="button" class="btn btn-info mt-3" style="border-radius: 20px; background-color: #03A8A8"><a href="apply.php" class="text-white">Purchase</a></button>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>
<footer>
    <div class="container-fluid bg-white text-dark py-3">
        <div class="row">
            <div class="col text-center">
                <p>&copy; 2024 Cudal, De Roxas, Faustino, Meralles. All Rights Reserved.</p>
            </div>
        </div>
    </div>
</footer>

</body>
</html>