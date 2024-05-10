<?php
require '../connection.php';
require 'settings_function.php';
session_start();

if (!isset($_SESSION['useradmin_id'])) {
    header("Location: login.php");
    exit();

}
?>
<!DOCTYPE html>
<html>
<head>

 <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
  <script src = "../js/bootstrap.bundle.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

   <title> Orders </title>

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
  padding-top: 10px;
}

.content1 {
  margin-left: 200px;
  padding-left: 10px;
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
  font-size: 25px;
  margin-bottom: 20px;
}
table, td, th {
  border: .5px solid grey;
  padding: 5px
}

table {
  border-collapse: collapse;
  width: 98%;
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
tr:hover {background-color: #f0f0f0}

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
</style>

<div class="header">
  .
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
  <a href="settings.php"> <img style="padding-right: 5px; margin-left: 35px" src="../images/settings.png" height="30px"width="30px">Settings </a>
  <br> <br> <br>
  <a href="login.php"> <img style="padding-right: 5px; margin-left: 35px;" src="../images/logout.png" height="30px" width="30px"> Log Out</a>
</div>

<div class="content1">
<div class="system-logo">
  <?php
  require '../connection.php';
    $useradmin_id = $_SESSION['useradmin_id'];
    $user = getUserSettings($useradmin_id, $con);
    echo $user['codename'] . ' - ' . $user['company'];
?> <hr>

</div></div>

<div class="content" style="font-size: 15px">
  <div class="card">
    <div class="table-responsive">
    <div class="card-header d-flex justify-content-between">
        <div>
            <a href="orders.php" class="btn btn-secondary"> Walk-In Order List </a>
            <a href="pending.php" class="btn btn-primary"> Online Order List </a>
        </div>
        <div>
            <a href="pending.php" class="btn btn-warning" style="color: white"> Pending </a>
            <a href="out_for_delivery.php" class="btn btn-info" style="color: white"> Out for Delivery </a>
            <a href="delivered.php" class="btn btn-success"> Delivered </a>
            <a href="cancel.php" class="btn btn-danger"> Cancelled </a>
        </div>
    </div>
  <div class="card-body">
        <table  id="myTable" class="table table-hover table-striped table-bordered">
            <colgroup>
    <col width="10%">
    <col width="10%">
    <col width="12%">
    <col width="8%">
    <col width="12%">
    <col width="8%">
    <col width="8%">
    <col width="9%">
    <col width="6%">
    <col width="14%">
            </colgroup>
            <thead>
    <tr>
    <th class="text-center"> Reference No </th>
    <th class="text-center"> Recipient's Name</th>
    <th class="text-center"> Address</th> 
    <th class="text-center"> Contact</th>
    <th class="text-center"> Order Products </th>
    <th class="text-center"> Total Amount </th>
    <th class="text-center"> Payment </th>
    <th class="text-center"> Date </th>
    <th class="text-center"> Status </th>
    <th class="text-center"> Action </th>
  </tr>
  </thead>
            <tbody>
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

<script>
$(document).ready(function() {
    $('#myTable').DataTable({
        "order": [[ 8, "desc" ]],
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true
    });
});
</script>

<?php
require '../user/readoo.php';
while ($row = mysqli_fetch_array($user_result)) {
    if ($row['status'] == 'Pending') {
        ?>
        
        <script>
  $(document).ready( function () {
    $('#myTable').DataTable();
  });
</script>
        <tr>
            <td><?php echo $row['ref_number']; ?></td>
            <td><?php echo $row['fullname']; ?></td>
            <td><?php echo $row['houseno'] . '&nbsp;' . $row['purok'] . '&nbsp;' . $row['street'] . '&nbsp;' . $row['barangay'] ?></td>
            <td><?php echo $row['contact']; ?></td>
            <td><?php echo $row['products_sold']; ?></td>
            <td><center><?php echo $row['amount']; ?></center></td>
            <td><center><?php echo $row['payment_type']; ?></center></td>
            <td><?php echo $row['date']; ?></td>
            <td>
                <span class="badge bg-warning rounded-pill">Pending</span>
            </td>
            <td>
                <form method="POST" action="edito.php?ref_number=<?= $row['ref_number'] ?>">
                    <input type="hidden" name="ref_number" value="<?= $row['ref_number'] ?>">
                    <select name="status" id="status" class="form-select rounded-0" style="margin-bottom: 10px">
                        <option value="Out for Delivery">Out for Delivery</option>
                        <option value="Delivered">Delivered</option>
                    </select>
                    <input class="btn btn-primary" type="submit" name="edit" value="Update Status">
                </form>
            </td>
        </tr>
    <?php
    }
}
?>

</div>
</tbody>
</table>
</div>
</div>
</div>
</body>
</html>

