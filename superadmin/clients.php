<?php 
require '../connection.php';
require 'settings_function.php';
session_start(); ?>
<!DOCTYPE html>
<html>
<head>

  <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
  <script src = "../js/bootstrap.bundle.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" />

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

   <title> Clients </title>

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
  margin-left: 210px;
  margin-right: 10px
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

.button-group {
    display: flex;
    gap: 0px; /* Adjust the gap according to your preference */
}

.button-group button {
    margin: 0; /* Reset default margin for buttons */
}

.dropdown {
            position: relative;
            display: inline-block;
        }

        /* Basic styling for the button */
        .dropbtn {
            padding: 8px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            cursor: pointer;
        }

        /* Styling for the dropdown arrow */
        .dropbtn::after {
            content: '\25BC'; /* Unicode character for a downward-pointing triangle or arrow */
            
        }

        /* Styling for the dropdown content (the actual dropdown items) */
        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        /* Style for dropdown content items */
        .dropdown-content a {
            padding: 12px 16px;
            display: block;
            text-decoration: none;
            color: #333;
        }

        /* Change color on hover for dropdown content items */
        .dropdown-content a:hover {
            background-color: #f0f0f0;
        }

        /* Show the dropdown content when the button is hovered over */
        .dropdown:hover .dropdown-content {
            display: block;
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
  <a class="active" href="clients.php"> <img style="padding-right: 5px; margin-left: 35px" src="../images/clients.png" height="25px" width="30px"> Clients </a>
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
        ?><hr>
    </div>
</div>

<div class="content">
  <div class="card">
    <div class="card-header d-flex justify-content-between">
        <h3 class="card-title">List of Clients Account</h3>
    </div>
<div class="card-body">
        <table id="myTable" class="table table-hover table-striped table-bordered">
            <colgroup>
                <col width="15%">
                <col width="15%">
                <col width="15%">
                <col width="30%">

                <col width="10%">
            </colgroup>
            <thead>
                <tr>
    <th> Date Created </th>
    <th> Code Name </th>
    <th> Client's Name </th>
    <th> Company Name </th>
    <th> Status </th>

     <th> Action </th>
   </tr>
</thead>
<tbody>


<?php
require'readc.php';
while($row = mysqli_fetch_array($user_result)){
?>



<tr>
    <td><?php echo date("Y-m-d H:i",strtotime($row['date'])) ?></td>
    <td> <?php echo $row ['codename']; ?> </td>
    <td> <?php echo $row ['firstname']. ' ' .$row ['lastname']; ?> </td>
    <td> <?php echo $row ['company']; ?> </td>
    <td><center>
    <?php if ($row['status'] == 'Inactive'): ?>
        <span class="badge bg-danger rounded-pill">Inactive</span>
    <?php else: ?>
        <span class="badge bg-success rounded-pill">Active</span>
    <?php endif; ?></center>
</td>
    
         
          <td>
           <center> <form action="deletec.php" method="GET">
            <input type="hidden" name="useradmin_id" value="<?php echo $row['useradmin_id']; ?>">
            <button type="submit" style="font-size: 14px" class="btn btn-danger" name="userdelete" onclick="return confirm('Are you sure you want to delete?')"><b>Delete</b>  </button>
        </form></center>
          </td>

</th>

                </tr>
                <?php } ?>
               
            </tbody>
</table>
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