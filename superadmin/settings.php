<?php
  session_start();
  require '../connection.php';
  require 'settings_function.php';
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

.content1 {
  margin-left: 200px;
  padding-left: 30px;
  padding-top: 10px;
  width: 81%;
}

.header{
  background-color: #333;
  text-align: right;
  color: #333;
  font-size: 15px
}

table, td, th {
  border: .5px solid grey;
}

table {
  border-collapse: collapse;
  width: 95%;
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
.system-logo {
    color: #333;
    font-size: 30px
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
 
<div class="content1">
  <div class="system-logo">
        <?php
            // Fetch the settings data
            $settingsData = getSettingsData();

            // Display the image from settings
            foreach ($settingsData as $row) {
                echo $row['codename'] . ' - ' . $row['systemname'];
            }
        ?><hr>
    </div>
</div>

<div class="content"> 
<br>
<table>

  <tr>
    <th> System Name </th>
    <th> Code Name </th>
    <th> Cover Photo </th>
    <th> About Us </th>
    <th> Action </th>
  </tr>

<?php
require'reads.php';
while($row = mysqli_fetch_array($user_result)){

?>

<tr>
      <td> <?php echo $row ['systemname']; ?> </td>
      <td> <?php echo $row ['codename']; ?>  </td>
      <td> <img src="../upload/<?php echo $row['image'];?>" style="width: 300px; height: auto;" class="zoom"> </td>
      <td> <?php echo $row ['about']; ?> </td>

      <td> <a href="editsettings.php?id=<?php echo $row ['id']; ?>"> <button class="btn btn-infos" style="margin-bottom: 2px; margin-right: 8px; border-color: #333;"> <img src="../images/edit.png" height="20px" width="20px"> Update </button> </a> </td>

<?php } ?>
    </div>
  </div>
</div>
</body>
</html>