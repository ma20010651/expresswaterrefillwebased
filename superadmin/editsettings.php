<?php
  session_start();
  require '../connection.php';
?>

<!DOCTYPE html>
<html>
<head>

  <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
  <script src = "../js/bootstrap.bundle.min.js"></script>

   <title> Settings </title>

</head>
<body>

<style>
	body {
  margin: 0;
  font-family: Copperplate;
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
  margin-left: 350px;
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
  margin-top: 30px;
  border-radius: 5px;
  text-align: left;
  color: #333;
  background-color: white;
  border: .5px solid #333;
  box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
}

input[type=text], input[type=password] {
  width: 60%;
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
  margin-left: 79%;
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
  <a href="plans.php"> <img style="padding-right: 5px; margin-left: 35px" src="../images/plans.png" height="25px" width="30px"> Plans </a>
  <a href="applicant.php"> <img style="padding-right: 5px; margin-left: 35px" src="../images/applicant.png" height="25px" width="30px"> Applicants </a>
  <a href="clients.php"> <img style="padding-right: 5px; margin-left: 35px" src="../images/clients.png" height="25px" width="30px"> Clients </a>
  <a href="reports.php"> <img style="padding-right: 5px; margin-left: 35px" src="../images/reports.png" height="30px" width="30px"> Reports </a>
  <a class="active" href="settings.php"> <img style="padding-right: 5px; margin-left: 35px" src="../images/settings.png" height="25px" width="30px"> Settings </a>
  <br> <br> <br>
  <a href="../login.php"> <img style="padding-right: 5px; margin-left: 35px;" src="../images/logout.png" height="30px" width="30px"> Log Out</a>
</div>

<div class="content"> 
<br>
<div class="form-container">

<?php
		require '../connection.php';
      $id = $_GET['id'];
      $query = "SELECT * FROM `settings` WHERE id='$id'";
      $result = mysqli_query($con,$query);
      $data =  mysqli_fetch_array($result);
		?>

<form method="POST" action="edits.php?id=<?= $id ?>" enctype="multipart/form-data">

<input type="hidden" name="id" value="<?=$data['id']?>">

<h1 style="font-size: 20px; background-color: #333; color: white; padding: 5px; border-top-left-radius: 5px; border-top-right-radius: 5px; padding-left: 40px"> Manage Settings </h1> <br>

  <label style="font-size: 18px; margin-left: 70px; margin-right: 51px"  for="systemname"> System Name: </label>
	<input type="text" id="systemname" name="systemname" value="<?php echo $data['systemname']?>"> <br>
	<br>

	<label style="font-size: 18px; margin-left: 70px; margin-right: 10px" for="codename"> System Code Name: </label>
	<input type="text" id="codename" name="codename" value="<?php echo $data['codename']?>"> <br>
	<br>

	<label style="font-size: 18px; margin-left: 70px; margin-right: 114px" for="image"> System Cover Photo: </label>
  	<img src="../upload/<?php echo $data['image'];?>" style="width: 250px; height: auto;" class="zoom"> <br> <br>
	<input style="width: 40%; font-size: 12px; margin-left: 253px; margin-right: 114px" accept="image/png, image/gif, image/jpeg, image/jpg, image/jfif" type="file" size="10" name="image" id="image"> <br> <br>

  <label style="font-size: 18px; margin-left: 70px; margin-right: 89px;" for="about"> About Us: </label>
  <input type="text" id="about" name="about" value="<?php echo $data['about']?>"> <br>
  <br>

	<input type="submit" value="Update" name="edit">

</form>

	</div>

</div>
</body>
</html>