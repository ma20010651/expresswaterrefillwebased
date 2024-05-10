<?php
require '../connection.php';
require '../superadmin/settings_function.php';
session_start();

?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
  <script src = "../js/bootstrap.bundle.min.js"></script>
	<title> Category </title>
</head>

<body>

<style>
 body{
    margin: 0;
    font-family: Times New Roman;
     }

.topnav {
  background-color: white;
    overflow: hidden;
    color: #0492c2;
    font-size: 26px;
    position: relative;
    padding-top: 20px;
    padding-bottom: 20px;
    
}

.nav-links {
    float: right;
    margin-right: 50px;
}

.topnav a {
    text-align: center;
    text-decoration: none;
     color: #0492c2;
    font-size: 17px;
    padding: 20px 10px;
}

.topnav a:hover {
    color: #03a9a8;
}

.topnav a.active {
    color: #333;
}

.dropdown {
    position: relative;
    display: inline-block;
}

.dropbtn {
    font-size: 15px;
    border: none;
    outline: none;
    color: white;
    padding: 8px 18px;
    background-color: #03c2c1;
    border-radius: 20px;
    margin: 0;
}

.dropdown-content {
    display: none;
    position: absolute;
    top: 100%;
    background-color: #f9f9f9;
    min-width: 150px;
    box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
    z-index: 1;
    
}

.dropdown-content a {
    float: none;
    color: black;
    padding: 8px 10px;
    text-decoration: none;
    display: block;
    text-align: left;
}

.dropdown-content a:hover {
    background-color: #03c2c1;
    color: white;
}

.dropdown:hover .dropdown-content {
    display: block;
}

.system-logo img {
    width: 100%;
}

 form {
  position: relative;
  z-index: 1;
  max-width: 450px;
  height: 380px;
  margin-left: 300px;
  border-radius: 20px;
  margin-top: 10px;
  text-align: left;
  color: white;
  background-image: url(../images/bgg.jpg);
  box-shadow: 0 0 10px 0 rgba(0, 0, 0, 0.2), 0 3px 3px 0 rgba(0, 0, 0, 0.24);
  border: 1px solid #ddd;
}

.button-wrapper {
    float: left;
    margin-right: 20px;
}

.button-wrapper a {
    text-decoration: none;
    color: white;
}

.button-wrapper button {
    font-size: 15px;
    border: none;
    outline: none;
    color: white;
    padding: 8px 18px;
    background-color: #03c2c1;
    border-radius: 20px;
    margin: 0;
}

.button-wrapper button:hover {
    background-color: #028080;
}
</style>
<body></body>
<div class="topnav" style="margin-left: 125px">
    <div class="system-logo">
        <?php
            $settingsData = getSettingsData();
            foreach ($settingsData as $row) {
                echo $row['codename'] . ' - ' . $row['systemname'];
            }
        ?>
    
    <div class="dropdown" style="margin-left: 20px">
        <button class="dropbtn">LOG IN</button>
        <div class="dropdown-content">
            <a href="../admin/login.php">Administrator</a>
            <a href="../user/category.php">Customer</a>
        </div>
    </div>
    <div class="button-wrapper">
    <a href="../index.php">
        <button>HOME</button>
    </a>
</div>
  </div>
<br> <br>

<form action="../home.php" method="GET" id="plan-form">
         <?php 
$sql = "SELECT DISTINCT barangay FROM `useradmin` WHERE `status` = 'Active' ORDER BY `useradmin_id` ASC";
$qry = $con->query($sql);
$i = 1;
?>
    <center> 
        <h1 style="font-size: 20px; padding-top: 20px; padding-bottom: 5px; padding-left: 20px; padding-right: 20px"> <b>Choose your barangay or<br> Water Refilling Station nearest to you!</h1></b><hr style=" border-color: white; ">
    </center>
    <input type="hidden" name="id" value="<?php echo isset($useradmin_id) ? $useradmin_id : ''; ?>">

    <div class="row">
        <div class="col-md-5" style="margin-left: 35px;"> 
            <div class="form-group">
                <b><label for="barangay" class="control-label" style="font-size: 17px">Select Barangay</label> <br></b>
                <select style="width: 100%" name="barangay" id="barangay" required class="form-control rounded-0">
                    <option value="" disabled selected>Select Barangay</option>
                    <?php while ($row = $qry->fetch_assoc()): ?>
                        <option value="<?php echo htmlspecialchars($row['barangay']); ?>"><?php echo htmlspecialchars($row['barangay']); ?></option>
                    <?php endwhile; ?>
                </select>  
            </div>
        </div><br>

        <div class="col-md-5">
            <div class="form-group">
                <b><label for="company" class="control-label" style="font-size: 17px">Company Name</label> <br></b>
                <select style="width: 100%;" name="company" id="company" required class="form-control rounded-0">
                    <option value="" disabled selected>Select Company</option>
                   
                </select>
            </div>
        </div>
    </div>

    <center><input type="submit" name="add" class="btn btn-success" value="Proceed"> <hr>
    <p style="font-size: 18px"> Already have an account? <a style="color: #333;" href="login.php"> Log In Now </a></center> </p>

</form>
</div>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
$(document).ready(function(){
    $('#barangay').change(function(){
        var barangay = $(this).val();

        // Send an AJAX request to fetch the company names based on the selected barangay
        $.ajax({
            type: 'POST',
            url: 'fetch_companies.php',
            data: { barangay: barangay },
            success: function(response){
                // Clear existing options
                $('#company').html('<option value="" disabled selected>Select Company</option>');
                
                // Split the response into an array of companies
                var companies = response.split(', ');
                
                // Append new options
                $.each(companies, function(index, value) {
                    $('#company').append('<option value="' + value + '">' + value + '</option>');
                });
            }
        });
    });
});
</script>



</body>
</html>