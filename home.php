<?php
require 'connection.php';
require 'admin/settings_function.php';
session_start();

$barangay = isset($_GET['barangay']) ? $_GET['barangay'] : '';
$company = isset($_GET['company']) ? $_GET['company'] : '';

$sql = "SELECT useradmin_id FROM `useradmin` WHERE barangay = '$barangay' AND company = '$company' AND status = 'Active' LIMIT 1";
$result = $con->query($sql);

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $useradmin_id = $row['useradmin_id'];

    $user = getUserSettings($useradmin_id, $con);
} else {
    echo "Invalid parameters";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
  <script>
        function redirectToRegister() {
            window.location.href = 'user/signup.php?barangay=<?php echo htmlspecialchars($barangay); ?>&company=<?php echo htmlspecialchars($company); ?>&useradmin_id=<?php echo htmlspecialchars($useradmin_id); ?>';
        }
    </script>
    <title> Home </title>

    <style>

	body {
  margin: 0;
  font-family: Times New Roman;
}

   .topnav {
      overflow: hidden;
      background-color: #0492c2;
      color: white;
      text-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
      box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
      font-size: 26px;
      margin-bottom: 7px;
    }

    .topnav img {
      margin-left: 50px;
      padding-top: 10px;
      float: left;
    }

    .brand-info {
      margin: 20px 20px;
      float: left;
    }

    .topnav a, .register-button {
      margin: 20px 20px; /* Adjusted the margins for both elements */
      padding: 6px 8px;
      border-radius: 10px;
      text-decoration: none;
      font-size: 17px;
      float: right;
    }


    .register-button {
      background-color: #03c2c1;
      color: white;
      font-size: 17px;
      border: none;
      cursor: pointer;
    }

    .register-button:hover {
      background-color: #03b3c2;
      color: white;
    }

.leftdiv{
  width: 50%;
  height: 500px;
  float: left;
  color: #333;
}

.rightdiv{
  width: 50%;
  height: 500px;
  float: right;
  color: #333;
}

.leftmaindiv{
  width: 50%;
  height: 500px;
  float: left;
  color: #333;
}

.rightmaindiv{
  width: 50%;
  height: 500px;
  float: right;
  color: #333;
}

.leftmaindiv1{
  width: 50%;
  height: 530px;
  float: left;
  color: #333;
}
.rightmaindiv1{
  width: 50%;
  height: 530px;
  float: right;
  color: #333;
}

.maindiv{
  width: 100%;
  height: 550px;
  float: right;
  color: #333;
}

table, td, th {
  border: 1px solid #333;
  padding: 10px;
}

table {
  border-collapse: collapse;
  width: 80%;
  margin-top: 30px;
  border-radius: 20px;
}

th {
  text-align: center;
  color: white;
  background-color: #333;
}

</style>
<body>
 <div class="topnav">
    <img src="upload/<?php echo $user['logo']; ?>" alt="Logo" width="50">
    <div class="brand-info">
      <?php echo $user['codename'] . ' - ' . $user['company']; ?>
    </div>
    <button  style="margin-right: 50px" class="register-button" onclick="redirectToRegister()">Register</button>
    <a href="" style="color: white">HOME</a>
  </div>


    <div class="leftdiv">
        <center>
            <img style="margin-left: 50px; padding-top: 10px;" src="upload/<?php echo $user['logo']; ?>" alt="Logo" width="80%">
        </center>
    </div>

    <div class="rightdiv">
        <center>
            <h2 style="font-size: 45px; padding-top: 90px; padding-right: 50px; color: #0492c2"> <i> Welcome To  <?php echo $user['codename'] . ' - ' . $user['company']; ?> </i> </h2>
            <p style="font-size: 20px; padding-top: 10px; padding-right: 50px; color: #0492c2"> <?php echo $user['description']?> </p>
        </center>
    </div>

</body>
</html>