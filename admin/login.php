<?php
require '../connection.php';
require '../superadmin/settings_function.php';
session_start();

if (isset($_POST['loginadmin'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $query = $con->prepare("SELECT * FROM `useradmin` WHERE `username` = ? AND `password` = ?");
    $query->bind_param("ss", $username, $password);
    $query->execute();

    $result = $query->get_result();
    
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if ($row['status'] == 'Active') {
            $_SESSION['useradmin_id'] = $row['useradmin_id'];
            header("Location: dashboard.php");
            exit();
        } else {
            $_SESSION['error'] = "Your account is disabled. We'll send you an email if your account is already confirm by admin.";
            header("Location: login.php"); 
            exit();
        }
    } else {
        $_SESSION['error'] = "Please Try Again. Username or Password is Incorrect!";
        header("Location: login.php"); 
        exit();
    }

    $query->close();
}
?>


<!DOCTYPE html>
<html>
<head>

  <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
  <script src = "../js/bootstrap.bundle.min.js"></script>
  
   <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
	<title> Log In </title>

</head>

<style>

 body{
    margin: 0;
    font-family: Times New Roman;
     }
     
#login-form input[type="password"],
#login-form input[type="text"]{
    box-sizing: border-box;
}
.password-container{
    width: 60%;
    position: relative;
}
.fa-eye{
    position: absolute;
    top: 56%;
    right: 10%;
    cursor: pointer;
    color: grey;
}

.topnav {
  background-color: white;
    overflow: hidden;
    color: #0492c2;
    font-size: 26px;
    padding-top: 20px;
    padding-bottom: 20px;
    
}

.system-logo img {
    width: 100%;
}

form {
  position: relative;
  z-index: 1;
  max-width: 380px;
  height: 360px;
  border-radius: 20px;
  text-align: left;
  color: white;
  background-image: url(../images/bgg.jpg);
  box-shadow: 0 0 10px 0 rgba(0, 0, 0, 0.2), 0 3px 3px 0 rgba(0, 0, 0, 0.24);
  border: 1px solid #ddd;
  font-size: 20px;
}

input[type=text], input[type=password] {
  width: 60%;
  padding: 2px;
  display: inline-block;
  border-collapse: collapse;
  border: 1px solid #ddd;
  box-sizing: border-box;
  border-radius: 10px;
  font-size: 20px
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
    margin-top: 10px;
}

.button-wrapper button:hover {
    background-color: #028080;
}
.alert{
    max-width: 30%;
}
</style>

<body>

<div class="topnav">
  <center>  <div class="system-logo">
        <?php
            $settingsData = getSettingsData();
  
            foreach ($settingsData as $row) {
                echo $row['codename'] . ' - ' . $row['systemname'];
            }
        ?>
    
    <div class="button-wrapper">
    <a href="../index.php">
        <button>HOME</button></center>
    </a>
</div>
		  </div>
    <body><br> <br>

 <?php
	if(isset($_SESSION['error'])){?>
		<div class="container alert alert-danger" role="alert" class="alert">
			<button onclick="window.location.href='login.php'" type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span></button>
			<?php echo $_SESSION['error'];

			session_unset();
			session_destroy();}?>
		</div>
		
   <center><form action="login.php"  method="post">
      <center>
         <h1 style="font-size: 25px; padding-top: 15px; padding-bottom: 15px"> Log In Admin </h1><hr style="border-color: white">
      </center>
      <br>
      <label style="font-size: 20px; padding-left: 33px"> Username </label>
      <input type="text" name="username" required placeholder="Enter your Username"> <br> <br>
 <div class="password-conatiner"> 
      <label style="font-size: 20px; margin-right: 7px; padding-left: 30px"> Password </label>
      <input type="password" id="password" name="password" required placeholder="Enter your Password">
      <i class="fa-solid fa-eye" id="show-password"></i></div>

      <center> <br><input type="submit" class="btn btn-success" name="loginadmin" value="Log In">
  </form>
  <script src = "../user/script.js"></script>
      </div></center>
</body>
</html>