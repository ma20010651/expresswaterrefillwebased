<?php
require '../connection.php';
require "readp.php";
require 'settings_function.php';
?>
<!DOCTYPE html>
<html>
<head>

  <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
  <script src = "../js/bootstrap.bundle.min.js"></script>

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

  <p style="margin-top: 40px; background-color: #00C2FF; padding-left: 10px; padding-bottom: 15px; font-size: 15px; margin-bottom: 90px"><b> Super Administrator </b> </p>

  <a class="active" href="dashboard.php"> <img style="padding-right: 5px; margin-left: 35px;" src="../images/dashboard.png" height="25px" width="30px"> Dashboard </a>
  <a href="plans.php"> <img style="padding-right: 5px; margin-left: 35px" src="../images/plans.png" height="25px" width="30px"> Plans </a>
  <a href="applicant.php"> <img style="padding-right: 5px; margin-left: 35px" src="../images/applicant.png" height="25px" width="30px"> Applicants </a>
  <a href="clients.php"> <img style="padding-right: 5px; margin-left: 35px" src="../images/clients.png" height="25px" width="30px"> Clients </a>
  <a href="reports.php"> <img style="padding-right: 5px; margin-left: 35px" src="../images/reports.png" height="30px" width="30px"> Reports </a>
  <a href="settings.php"> <img style="padding-right: 5px; margin-left: 35px" src="../images/settings.png" height="25px" width="30px"> Settings </a>
  <br> <br> <br>
  <a href="../login.php"> <img style="padding-right: 5px; margin-left: 35px;" src="../images/logout.png" height="30px" width="30px"> Log Out</a>
</div>

<div class="content">

  <div class="system-logo">
        <?php
            $settingsData = getSettingsData();
            foreach ($settingsData as $row) {
                echo $row['codename'] . ' - ' . $row['systemname'];
            }
        ?><hr>
    </div>

    <div class="row d-flex justify-content-start align-items-center mt-5">
      <div class="card text-white bg-info mb-3" style="width: 100%" >
        <div class="card-header">Active Plans</div>
        <div class="card-body">
          <h2 class="card-title">
                  <?php 
                     $status = $con->query("SELECT * FROM `plans` where `status` =1 ")->num_rows;
                     echo number_format($status);
                  ?> </h2>
                <p class="card-text text-white">Total of Active Plans</p>
        </div>
        </div>

        <div class="card text-white bg-primary mb-3" style="width: 100%" >
        <div class="card-header"> Inactive Plans </div>
                <div class="card-body">
            <h2 class="card-title">
                  <?php 
                     $status = $con->query("SELECT * FROM `plans` where `status` =0 ")->num_rows;
                     echo number_format($status);
                  ?> </h2>
                <p class="card-text text-white"> Total of Inactive Plans </p>
        </div>
        </div>

        <div class="card text-white bg-infos mb-3" style="width: 100%;" >
        <div class="card-header" style="color: #333"> Clients Account </div>
                <div class="card-body">
            <h2 class="card-title" style="color: #333">
                  <?php 
                    $username = $con->query("SELECT * FROM useradmin")->num_rows;
                    echo number_format($username);
                  ?> </h2>
                <p class="card-text" style="color: #333"> Total of Client Account </p>
        </div>
        </div>

        <div class="card text-white bg-warning mb-3" style="width: 100%">
        <div class="card-header">Pending Applicants</div>
        <div class="card-body">
          <?php
            $pendingCount = $con->query("SELECT COUNT(*) as count FROM applicant WHERE status = 0")->fetch_assoc()['count'];
          ?>
          <h2 class="card-title"><?php echo number_format($pendingCount); ?></h2>
          <p class="card-text text-white">Total of Pendings</p>
          </div>
        </div>

      <div class="card text-white bg-success mb-4" style=" width: 100%">
        <div class="card-header">Approved Applicants</div>
        <div class="card-body">
          <?php
    $pendingCount = $con->query("SELECT COUNT(*) as count FROM applicant WHERE status = 1")->fetch_assoc()['count'];
    ?>
    <h2 class="card-title"><?php echo number_format($pendingCount); ?></h2>
     <p class="card-text text-white">Total of Approved</p>
        </div>
      </div>

      <div class="card text-white bg-danger mb-4" style=" width: 100%">
        <div class="card-header">Denied Applicants</div>
        <div class="card-body">
          <?php
    $pendingCount = $con->query("SELECT COUNT(*) as count FROM applicant WHERE status = 2")->fetch_assoc()['count'];
    ?>
    <h2 class="card-title"><?php echo number_format($pendingCount); ?></h2>
     <p class="card-text text-white">Total of Denied</p>
        </div>
      </div>
    </div>
  </div>
         <?php ?>
</div>

<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

</body>
</html>