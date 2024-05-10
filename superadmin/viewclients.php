<?php session_start();
 require '../connection.php';
?>
<!DOCTYPE html>
<html>
<head>

  <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
  <script src = "../js/bootstrap.bundle.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

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
  margin-right: 10px;
}


.header{
 background-color: #333;
  text-align: right;
  color: #333;
  font-size: 15px
}
.button-group {
    display: flex;
    gap: 0px; /* Adjust the gap according to your preference */
}

.button-group button {
    margin: 0; /* Reset default margin for buttons */
}
    h3 {
        color: #333333;
    }

    label {
        font-weight: bold;
        color: #333333;
    }

    .row {
        margin-bottom: 15px;
    }

    .col-md-6 {
        margin-bottom: 15px;
    }

    .badge {
        font-size: 14px;
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


<div class="content">

<?php
    require '../connection.php';
      $useradmin_id = $_GET['useradmin_id'];
      $query = "SELECT * FROM `useradmin` WHERE useradmin_id='$useradmin_id'";
      $result = mysqli_query($con,$query);
      $data =  mysqli_fetch_array($result);
    ?>

 <div class="container-fluid" style="border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); padding: 20px; margin-top: 10px; padding-left: 50px; padding-top: 20px">
    <div class="row">
        <div class="col-md-12">
            <h3 style="color: #333333; margin-top: 0;"> <b> <?php echo $data['firstname']. ' ' .$data['lastname']?>'s </b> Account Information</h3>
            <hr style="margin-top: 10px; margin-bottom: 20px; border: 0; border-top: 1px solid #dee2e6;">
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <label for="firstname" class="control-label"><b>Full Name</b></label> <br>
            <?php echo $data['firstname']. ' ' .$data['lastname']; ?>
        </div>

        <div class="col-md-6">
            <label for="codename" class="control-label"><b>Code Name</b></label> <br>
            <?php echo $data['codename']; ?>
        </div>
</div>
 <div class="row">
        <div class="col-md-6">
            <label for="company" class="control-label"><b>Codmpany Name</b></label> <br>
            <?php echo $data['company']; ?>
        </div>
    
        <div class="col-md-6">
            <label for="username" class="control-label"><b>Username</b></label> <br>
            <?php echo $data['username']; ?>
        </div>
</div>
 <div class="row">

  <div class="col-md-6">
            <label for="date" class="control-label"><b>Date Created</b></label> <br>
            <?php echo $data['date']; ?>
        </div>

        <div class="col-md-6">
            <label for="password" class="control-label"><b>Password</b></label> <br>
            <p> * </p>
        </div>
  
</div>
 <div class="row">
    <div class="col-md-6">
            <label for="status" class="control-label"><b>Status</b></label> <br>
            <?php if ($data['status'] == 1): ?>
                <span class="badge bg-success rounded-pill" style="font-size: 14px;">Active</span>
            <?php else: ?>
                <span class="badge bg-danger rounded-pill" style="font-size: 14px;">Unactive</span>
            <?php endif; ?>
        </div>
    </div>

    <form action="" id="plan-form" style="margin-left: 90%">
        <!-- ... (form fields) ... -->
        <div class="row">
            <div class="col-md-12">
                <button type="button" class="btn btn-secondary" onclick="goBack()">Cancel</button>
            </div>
        </div>
    </form>
</div>

<script>
    function goBack() {
        window.history.back();
    }
</script>


</div>
</body>
</html>