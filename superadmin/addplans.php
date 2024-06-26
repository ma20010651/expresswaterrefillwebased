<?php
require 'settings_function.php';
require_once("../connection.php");
if(isset($_GET['id'])){
$qry = $con->query("SELECT * FROM `plans` where id = '{$_GET['id']}'");
    foreach($qry->fetchArray() as $k => $v){
        $$k = $v;
    }
}
?>
<!DOCTYPE html>
<html>
<head>

  <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
  <script src = "../js/bootstrap.bundle.min.js"></script>
  

   <title> Plans </title>

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

form {
  position: relative;
  z-index: 1;
  max-width: 80%;
  height: 70%;
  margin-top: 50px;
  margin-left: 110px;
  border-radius: 5px;
  text-align: left;
  color: #333;
  background-color: white;
  border: .5px solid #333;
  box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
}

input[type=text], input[type=password] {
  width: 50%;
  padding: 5px;
  display: inline-block;
  border: .5px solid;
  box-sizing: border-box;
}

input[type=submit] {
  background-color:  #00C2FF;
  color: white;
  padding-left: 30px;
  padding-right: 30px;
  padding-top: 5px;
  padding-bottom: 5px;
  margin-left: 81%;
  margin-bottom: 30px;
  margin-top: 10px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

input[type=submit]:hover {
  background-color: #009ccd;
  color: white;
}
</style>

<div class="header">
  .
</div>

<div class="sidenav">

  <p style="margin-top: 40px; background-color: #00C2FF; padding-left: 10px; padding-bottom: 15px; font-size: 15px; margin-bottom: 90px"><b> Super Administrator </b> </p>

  <a href="dashboard.php"> <img style="padding-right: 5px; margin-left: 35px;" src="../images/dashboard.png" height="25px" width="30px"> Dashboard </a>
  <a class="active" href="plans.php"> <img style="padding-right: 5px; margin-left: 35px" src="../images/plans.png" height="25px" width="30px"> Plans </a>
  <a href="applicant.php"> <img style="padding-right: 5px; margin-left: 35px" src="../images/applicant.png" height="25px" width="30px"> Applicants </a>
  <a href="clients.php"> <img style="padding-right: 5px; margin-left: 35px" src="../images/clients.png" height="25px" width="30px"> Clients </a>
  <a href="reports.php"> <img style="padding-right: 5px; margin-left: 35px" src="../images/reports.png" height="30px" width="30px"> Reports </a>
  <a href="settings.php"> <img style="padding-right: 5px; margin-left: 35px" src="../images/settings.png" height="25px" width="30px"> Settings </a>
  <br> <br> <br>
  <a href="../login.php"> <img style="padding-right: 5px; margin-left: 35px;" src="../images/logout.png" height="30px" width="30px"> Log Out</a>
</div>

<div class="content">
  <form  method="POST"action="addp.php" enctype="multipart/form-data">
    <h1 style="font-size: 20px; background-color: #333; color: white; padding: 5px; border-top-left-radius: 5px; border-top-right-radius: 5px; padding-left: 40px"> Add New Plan </h1> <br>
    <div class="container-fluid">
        <form action="" id="plan-form">
            <input type="hidden" name="id" value="<?php echo isset($id) ? $id : ''; ?>">
            <div class="row">
                <div class="col-md-12" style=" margin-left: 30px;"> 
                    <div class="form-group">
                        <label for="title" class="control-label">Title:</label> <br>
                        <input type="text" name="title" autofocus id="title" required class="form-control rounded-0" value="<?php echo isset($title) ? $title : ''; ?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="description" class="control-label" style="margin-left: 30px;">Description:</label>
                        <textarea name="description" id="description" cols="30" rows="4" required class="form-control rounded-0 summernote" style="margin-left: 30px; max-width: 90%"><?php echo isset($description) ? html_entity_decode($description) : ''; ?></textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="current_price" class="control-label" style="margin-left: 30px;">Current Price:</label>
                        <input style="margin-left: 30px; max-width: 50%" type="number" name="current_price" id="current_price" required class="form-control rounded-0" value="<?php echo isset($current_price) ? $current_price : ''; ?> " placeholder="0">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="old_price" class="control-label">Old Price:</label>
                        <input style="max-width: 50%" type="number" name="old_price" id="old_price" required class="form-control rounded-0" value="<?php echo isset($old_price) ? $old_price : ''; ?>" placeholder="0">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="subscription_type" class="control-label" style="margin-left: 30px;">Subscription Type:</label>
                        <input type="text" name="subscription_type" id="subscription_type" required class="form-control rounded-0" value="<?php echo isset($subscription_type) ? $subscription_type : ''; ?>" placeholder="(Monthly, Yearly)">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="status" class="control-label">Status:</label>
                        <select name="status" id="status" class="form-select rounded-0" style="margin-left: 21px;">
                            <option value="1" <?php echo (isset($status) && $status == 1 ) ? 'selected' : ''; ?>>Available</option>
                            <option value="0" <?php echo (isset($status) && $status == 0 ) ? 'selected' : ''; ?>>Unavailable</option>
                        </select>
                    </div>
                </div>
            </div>

            <input type="submit" name="add" value="Save">
        </form>
    </div>
</div>
</body>
</html>