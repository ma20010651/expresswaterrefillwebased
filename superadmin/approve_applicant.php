<?php 
require '../connection.php';
require 'settings_function.php';
session_start();
 ?>
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" />
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

.sidenav a:hover {
  background-color: #DDDDDD;
  color: #333;
}
.sidenav a.active {
  background-color: #00C2FF;
  color:white;
}

.content {
  margin-left: 210px;
  margin-right: 10px;
}

.content1 {
  margin-left: 200px;
  padding-left: 30px;
  width: 83%;
}

.header{
  background-color: #333;
  padding-right: 20px;
  padding-left: 900px;
  color: #333;
  padding-top: 5px;
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
  <a class="active" href="applicant.php"> <img style="padding-right: 5px; margin-left: 35px" src="../images/applicant.png" height="25px" width="30px"> Applicants </a>
  <a href="clients.php"> <img style="padding-right: 5px; margin-left: 35px" src="../images/clients.png" height="25px" width="30px"> Clients </a>
  <a href="reports.php"> <img style="padding-right: 5px; margin-left: 35px" src="../images/reports.png" height="30px" width="30px"> Reports </a>
  <a href="settings.php"> <img style="padding-right: 5px; margin-left: 35px" src="../images/settings.png" height="25px" width="30px"> Settings </a>
  <br> <br> <br>
  <a href="../login.php"> <img style="padding-right: 5px; margin-left: 35px;" src="../images/logout.png" height="30px" width="30px"> Log Out</a>
</div>

<div class="content1">
  <div class="system-logo">
    <?php
        $settingsData = getSettingsData();
        foreach ($settingsData as $row) {
            echo $row['codename'] . ' - ' . $row['systemname'];
        }
    ?>
    <hr>
  </div>
</div>

<div class="content">
  <div class="card">
    <div class="card-header d-flex justify-content-between">
      <h3 class="card-title">List of Approved Applicants</h3>
      <div class="d-flex align-items-center">
        <a href="applicant.php" class="btn btn-primary mr-2">Pending</a>
        <a href="approve_applicant.php" class="btn btn-success mr-2">Approved</a>
        <a href="denied_applicant.php" class="btn btn-danger">Denied</a>
      </div>
    </div>
  </div>
  <div class="card-body">
    <table id="myTable" class="table table-hover table-striped table-bordered">
      <colgroup>
      </colgroup>
      <thead>
        <tr>
          <th>No</th>
          <th>Full Name</th>
          <th>Contact No</th>
          <th>Full Address</th>
          <th>Company</th>
          <th>Email Address</th>
          <th>Plan</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
          require 'reada.php';
          $counter = 1; 
          while ($row = mysqli_fetch_array($user_result)) {
            if ($row['status'] == 1) {
        ?>
        <tr>
          <td><?php echo $counter++; ?></td>
          <td><?php echo $row['firstname'] . ' ' . $row['middle'] . ' ' . $row['lastname']; ?></td>
          <td><?php echo $row['contact']; ?></td>
          <td><?php echo $row['unit'] . ' ' . $row['street'] . ' ' . $row['barangay'] . ' ' . $row['city'] . ' ' . $row['country']; ?></td>
          <td><?php echo $row['company']; ?></td>
          <td><?php echo $row['email']; ?></td>
          <td><?php echo $row['plan']; ?></td>
          <td><span class="badge bg-success rounded-pill" style="color: white;">Approved</span></td>
          <td><a class="btn btn-secondary" style="font-size: 12px;" href="viewapplicant.php?id=<?php echo $row['id']; ?>"><b>View Details</a></b></td>
        </tr>
        <?php 
          } 
        }
        ?>
      </tbody>
    </table>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
<script>
  $(document).ready( function () {
    $('#myTable').DataTable();
  });
</script>

</body>
</html>