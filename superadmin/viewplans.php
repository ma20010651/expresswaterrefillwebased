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
    h3 {
        color: #333333;
    }

    hr {
        margin-top: 10px;
        margin-bottom: 20px;
        border: 0;
        border-top: 1px solid #dee2e6;
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
  <a class="active" href="plans.php"> <img style="padding-right: 5px; margin-left: 35px" src="../images/plans.png" height="25px" width="30px"> Plans </a>
  <a href="applicant.php"> <img style="padding-right: 5px; margin-left: 35px" src="../images/applicant.png" height="25px" width="30px"> Applicants </a>
  <a href="clients.php"> <img style="padding-right: 5px; margin-left: 35px" src="../images/clients.png" height="25px" width="30px"> Clients </a>
  <a href="reports.php"> <img style="padding-right: 5px; margin-left: 35px" src="../images/reports.png" height="30px" width="30px"> Reports </a>
  <a href="settings.php"> <img style="padding-right: 5px; margin-left: 35px" src="../images/settings.png" height="25px" width="30px"> Settings </a>
  <br> <br> <br>
  <a href="../login.php"> <img style="padding-right: 5px; margin-left: 35px;" src="../images/logout.png" height="30px" width="30px"> Log Out</a>
</div>


<div class="content">

<?php
    require '../connection.php';
      $id = $_GET['id'];
      $query = "SELECT * FROM `plans` WHERE id='$id'";
      $result = mysqli_query($con,$query);
      $data =  mysqli_fetch_array($result);
    ?>

 <div class="container-fluid" style="border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); padding: 20px; margin-top: 10px; max-width: 98%;">
    <div class="row">
        <div class="col-md-12">
            <h3 style="color: #333333; margin-top: 0;"> Plan <b>No. <?php echo $data['id']?></b> Details</h3>
            <hr style="margin-top: 10px; margin-bottom: 20px; border: 0; border-top: 1px solid #dee2e6;">
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <label for="title" class="control-label"> <b> Title </b></label> <br>
            <?php echo $data['title']; ?>
        </div>
        <div class="col-md-6">
            <label for="description" class="control-label"> <b> Description </b></label> <br>
            <?php echo $data['description']; ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <label for="current_price" class="control-label"> <b> Current Price </b> </label> <br>
            <?php echo $data['current_price']; ?>
        </div>
        <div class="col-md-6">
            <label for="old_price" class="control-label"><b> Before Price </b></label> <br>
            <?php echo $data['old_price']; ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <label for="subscription_type" class="control-label"> <b> Subscription Type </b> </label> <br>
            <?php echo $data['subscription_type']; ?>
        </div>
        <div class="col-md-6">
            <label for="date_created" class="control-label"> <b> Date Created </b></label> <br>
            <?php echo $data['date_created']; ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <label for="status" class="control-label"> <b> Status </b> </label> <br>
            <?php if ($data['status'] == 1): ?>
                <span class="badge bg-success rounded-pill">Available</span>
            <?php else: ?>
                <span class="badge bg-danger rounded-pill">Unavailable</span>
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



</div>


</div>