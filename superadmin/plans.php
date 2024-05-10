<?php 
require '../connection.php';
require 'settings_function.php';
session_start();
?>
<!DOCTYPE html>
<html>
<head>

  <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
  <script src = "../js/bootstrap.bundle.min.js"></script>
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
  <a class="active" href="plans.php"> <img style="padding-right: 5px; margin-left: 35px" src="../images/plans.png" height="25px" width="30px"> Plans </a>
  <a href="applicant.php"> <img style="padding-right: 5px; margin-left: 35px" src="../images/applicant.png" height="25px" width="30px"> Applicants </a>
  <a href="clients.php"> <img style="padding-right: 5px; margin-left: 35px" src="../images/clients.png" height="25px" width="30px"> Clients </a>
  <a href="reports.php"> <img style="padding-right: 5px; margin-left: 35px" src="../images/reports.png" height="30px" width="30px"> Reports </a>
  <a href="settings.php"> <img style="padding-right: 5px; margin-left: 35px" src="../images/settings.png" height="25px" width="30px"> Settings </a>
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

  <div class="card">
    <div class="card-header d-flex justify-content-between">
        <h3 class="card-title">Plan List</h3>
        <div class="card-tools align-middle">
            <a href="addplans.php"> <button class="btn btn-info" style="float: right; color: white "> <img src="../images/add.png" height="25px" width="20px"> Add New </button> </a>

        </div>
    </div>
<div class="card-body">
        <table class="table table-hover table-striped table-bordered">
            <colgroup>
                <col width="5%">
                <col width="15%">
                <col width="25%">
                <col width="30%">
                <col width="15%">
                <col width="10%">
            </colgroup>
            <thead>
                <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Date Created</th>
                    <th class="text-center">Title</th>
                    <th class="text-center">Description</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>

              <?php 
                $sql = "SELECT * FROM `plans` order by `id` asc";
                $qry = $con->query($sql);
                $i = 1;
                    while($row = $qry->fetch_assoc()):
                        $row['description'] = strip_tags(html_entity_decode($row['description']));
                ?>
                <tr>
                    <td class="text-center"><?php echo $i++; ?></td>
                    <td class=""><?php echo date("Y-m-d H:i",strtotime($row['date_created'])) ?></td>
                    
                    <td class=""><?php echo ($row['title']) ?></td>
                    <td class=""  title="<?php echo $row['description'] ?>"><p class="m-0 truncate-3 lh-1"><small><i><?php echo $row['description'] ?></i></small></p></td>
                    <td class=" text-center" style="color: white">
                    <?php if($row['status'] == 1): ?>
                        <span class="badge bg-success  rounded-pill">Available</span>
                    <?php else: ?>
                        <span class="badge bg-danger  rounded-pill">Unavailable</span>
                    <?php endif; ?>
                    </td>
                    <th class="text-center">

<div class="dropdown">
    <div class="dropbtn">Action</div>
    <div class="dropdown-content">
        <a style="padding-right: 78px" href="viewplans.php?id=<?php echo $row ['id']; ?>"> <img src="../images/info.png" height="15px" width="15px"> View </a>
        <a style="padding-right: 78px" href="editplans.php?id=<?php echo $row ['id']; ?>"> <img src="../images/edit.png" height="15px" width="15px"> Edit </a>
        <form action="deletep.php" method="GET">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <button style="padding-right: 65px" type="submit" class="btn btn-infos" name="userdelete" onclick="return confirm('Are you sure you want to delete?')"><img src="../images/delete.jpg" height="20px" width="22px"> Delete </button>
        </form>
    </div>
</div>

</th>

                </tr>
                <?php endwhile; ?>
               
            </tbody>
        </table>
    </div>
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