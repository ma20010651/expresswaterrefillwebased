<?php
require '../connection.php';

?>
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <script src = "../js/bootstrap.bundle.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

  <title> Create Account </title>

</head>

<style>
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
  max-width: 58%;
  height: 50%;
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
<div class="topnav">
    <div class="system-logo">
       <center> 
Welcome to our Web-based System for Water Refilling Stations </center>
    </div>
  </div>
    <body>
<br>
<?php 
$sql = "SELECT * FROM `applicant` WHERE `status` = 1 ORDER BY `id` ASC";
$qry = $con->query($sql);
$i = 1;
?>

<div class="content">
 <center> <form method="POST" action="addc.php" enctype="multipart/form-data">
    <center> 
        <h1 style="font-size: 25px; padding-top: 20px; padding-bottom: 5px; padding-left: 20px; padding-right: 20px"><b> Create Account</h1></b><hr style=" border-color: white; ">
    </center>
    <div class="container-fluid">
        <form action="" id="plan-form">
            <input type="hidden" name="useradmin_id" value="<?php echo isset($useradmin_id) ? $useradmin_id : ''; ?>">
<br>
            <div class="row">
    <div class="col-md-3" style="margin-left: 30px;"> 
        <div class="form-group">
            <b><label for="firstname" class="control-label">Select Client's Name</label> <br></b>
            <select style="width: 100%" name="firstname" id="firstname" required class="form-control rounded-0">
                <option value="" disabled selected>Select Client</option>
                <?php while ($row = $qry->fetch_assoc()): ?>
                    <option value="<?php echo htmlspecialchars($row['firstname'] . ' ' . $row['lastname']); ?>"><?php echo htmlspecialchars($row['firstname'] . ' ' . $row['lastname']); ?></option>
                <?php endwhile; ?>
            </select>  
        </div>
    </div>

    <div class="col-md-5"> 
        <div class="form-group">
            <b><label for="company" class="control-label">Company Name</label> <br></b>
            <input style="width: 100%;" type="" name="company" id="company" required class="form-control rounded-0" placeholder="Company Name">
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            <b><label for="barangay" class="control-label">Barangay</label> <br></b>
            <input style="width: 100%;" type="" name="barangay" id="barangay" required class="form-control rounded-0" placeholder="Barangay">
        </div>
    </div>
</div>

<br>
           <div class="row">
    
            <input style="width: 100%;" type="hidden" name="codename" id="codename" required class="form-control rounded-0" placeholder="Company Code Name">

    <div class="col-md-4" style="margin-left: 30px;"> 
        <div class="form-group">
            <b><label for="username" class="control-label">Create Username</label> <br></b>
            <input style="width: 100%;" type="text" name="username" id="username" required class="form-control rounded-0" placeholder="Create Username">
        </div>
    </div>

    <div class="col-md-4"> 
        <div class="form-group">
            <b><label for="password" class="control-label">Create Password</label> <br></b>
            <input style="width: 100%;" type="password" name="password" id="password" required class="form-control rounded-0" placeholder="Create Password">
        </div>
    </div>

        <input type="hidden" name="status" value="Active">

    <div class="col-md-3" style="margin-top: 30px"> 
        <center> <input type="submit" name="add" class="btn btn-success" value="Create Account"> </center>
    </div>
</div>

<br><br>
         
        </form>
    </div>
</form>
</center>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
$(document).ready(function(){
  $('#firstname').change(function(){
    var selectedClient = $(this).val();

    $.ajax({
      type: 'POST',
      url: 'fetch_barangay.php',
      data: { client: selectedClient },
      dataType: 'json',
      success: function(response){
      
        $('#barangay').val(response.barangay.join(', '));
        $('#company').val(response.company.join(', '));
      },
      error: function(xhr, status, error) {
        console.error(error);
      }
    });
  });
});
</script>

</div>
</div>

</body>
</html>