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


   <title> Applicant </title>

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

    input[type=submit] {
  background-color:  #00C2FF;
  color: white;
  padding-left: 30px;
  padding-right: 30px;
  padding-top: 5px;
  padding-bottom: 5px;
  margin-left: 85%;
  margin-bottom: 30px;
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
  <a class="active" href="applicant.php"> <img style="padding-right: 5px; margin-left: 35px" src="../images/applicant.png" height="25px" width="30px"> Applicants </a>
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
      $query = "SELECT * FROM `applicant` WHERE id='$id'";
      $result = mysqli_query($con,$query);
      $data =  mysqli_fetch_array($result);
    ?>

<form method="POST" action="edita.php?id=<?= $id ?>" enctype="multipart/form-data">
<input type="hidden" name="id" value="<?=$data['id']?>">

 <div class="container-fluid" style="border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); padding: 20px; margin-top: 10px;">
    <div class="row">
        <div class="col-md-12">
            <h3 style="color: #333333; margin-top: 0;"> <b> <?php echo $data['firstname']. ' ' .$data['lastname']?>'s </b> Information</h3>
            <hr style="margin-top: 10px; margin-bottom: 20px; border: 0; border-top: 1px solid #dee2e6;">
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <label for="dti" class="control-label"><b>DTI</b></label> <br>
            <img src="../<?php echo $data['dti'];?>" style="width: 500px; height: auto;" class="zoom">
        </div>

        <div class="col-md-6">
            <label for="image" class="control-label"><b>Business Permit</b></label> <br>
            <img src="../<?php echo $data['image'];?>" style="width: 500px; height: auto;" class="zoom">
        </div>
      </div>

  <div class="row">

        <div class="col-md-6">
            <label for="validid" class="control-label"><b>Valid ID</b></label> <br>
            <img src="../<?php echo $data['validid'];?>" style="width: 500px; height: auto;" class="zoom">
        </div>
      </div>

       <div class="row">
        <div class="col-md-6">
            <label for="firstname" class="control-label"><b>Full Name</b></label> <br>
            <?php echo $data['firstname']. ' ' .$data['middle']. ' ' .$data['lastname']; ?>
        </div>

        <div class="col-md-6">
            <label for="age" class="control-label"><b>Age</b></label> <br>
            <?php echo $data['age']; ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <label for="gender" class="control-label"><b>Gender</b></label> <br>
            <?php echo $data['gender']; ?>
        </div>

        <div class="col-md-6">
            <label for="unit" class="control-label"><b>Complete Address</b></label> <br>
            <?php echo $data['unit'] . ' ' . $data['street'] . ' ' . $data['barangay'] . ' ' . $data['city'] . ' ' . $data['country']. ' ' . $data['zip']; ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <label for="company" class="control-label"><b>Company Name</b></label> <br>
            <?php echo $data['company']; ?>
        </div>


        <div class="col-md-6">
            <label for="email" class="control-label"><b>Email Address</b></label> <br>
            <?php echo $data['email']; ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <label for="plan" class="control-label"><b>Plan</b></label> <br>
            <?php echo $data['plan']; ?>
        </div>


        <div class="col-md-6">
            <label for="date" class="control-label"><b>Date Created</b></label> <br>
            <?php echo $data['date']; ?>
        </div>
    </div>

  <div class="row">
<div class="col-md-6">
            <label for="status" class="control-label"><b>Status</b></label> <br>
        <?php if ($data['status'] == 1): ?>
    <span class="badge bg-success rounded-pill" style="font-size: 14px;">Approved</span>
        <?php elseif ($data['status'] == 2): ?>
    <span class="badge bg-danger rounded-pill" style="font-size: 14px;">Denied</span>
        <?php else: ?>
    <span class="badge bg-primary rounded-pill" style="font-size: 14px;">Pending</span>
        <?php endif; ?>

</div>

    <div class="col-md-2">
        <div class="form-group">
            <label for="status" class="control-label">Status</label>
            <select name="status" id="status" class="form-select rounded-0">
                <option value="1" <?php echo (isset($status) && $status == 1 ) ? 'selected' : ''; ?>>Approved</option>
                <option value="2" <?php echo (isset($status) && $status == 2 ) ? 'selected' : ''; ?>>Denied</option>
            </select>
        </div>
    </div>
    <div class="col-md-1" style="margin-top: 2px">
        <div class="form-group">
            <label>&nbsp;</label>
            <input type="submit" name="edit" value="Save" class="btn btn-primary">
        </div>
    </div>
</div>
        </form> 

</div>

</div>

</div>
</body>
</html>