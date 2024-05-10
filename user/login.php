<?php
session_start(); 
require '../connection.php';
require "functions.php";

$msg = '';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = $con->prepare("SELECT * FROM `users` WHERE `email` = ?");
    $query->bind_param("s", $email);
    $query->execute();

    $result = $query->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            if ($row['email_verified'] == 1) {
                $_SESSION['user_id'] = $row['user_id'];
                $_SESSION['supplier'] = $row['useradmin_id'];
                $_SESSION['user_identity'] = [
                    "fullname" => $row['username'],
                    "phone" => $row['contact'],
                    "email" => $row['email']
                ];
                header("Location: products.php");
                exit(); 
            } else {
                header("Location: verify.php?email=" . urlencode($email));
                exit(); 
            }
        } else {
            $_SESSION['error'] = "Invalid Credentials";
            header("Location: login.php");
            exit(); 
        }
    } else {
        $_SESSION['error'] = "Please Try Again. Email or Password is Incorrect.";
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
    top: 37%;
    right: 14%;
    cursor: pointer;
    color: grey;
}

form {
  position: relative;
  z-index: 1;
  max-width: 380px;
  height: 480px;
  border-radius: 20px;
  margin-top: 20px;
  text-align: left;
  color: white;
  background-image: url(../images/bgg.jpg);
  box-shadow: 0 0 10px 0 rgba(0, 0, 0, 0.2), 0 3px 3px 0 rgba(0, 0, 0, 0.24);
  border: 1px solid #ddd;
}

input[type=text], input[type=password], input[type=email] {
  width: 60%;
  padding: 10px;
  display: inline-block;
  border-collapse: collapse;
  border: 1px solid #ddd;
  box-sizing: border-box;
  border-radius: 10px
}

.button-wrapper {
    float: center;
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
    padding: 8px 45px;
    background-color: #03c2c1;
    border-radius: 20px;
    margin: 0;
}

.button-wrapper button:hover {
    background-color: #028080;
}


</style>

<body>

    <body><br> <br>
    
    <?php
	if(isset($_SESSION['error'])){?>
		<div class="container alert alert-danger" role="alert" class="alert" style="width: 25%;">
			<button onclick="window.location.href='login.php'" type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span></button>
			<?php echo $_SESSION['error'];

			session_unset();
			session_destroy();}?>
		</div>
<center>
<form method="post" id="login-form">

      <center>
         <h1 style="font-size: 25px; padding-top: 15px; padding-bottom: 15px"><b> Log In User </b></h1> <br>
      </center>

      <label style="font-size: 18px; padding-left: 30px; margin-right: 35px;"> Email </label>
      <input type="email" name="email" required placeholder="Enter your Email"> <br> <br>

     <div class="password-conatiner"> 
      <label style="font-size: 18px; margin-right: 7px; padding-left: 30px"> Password </label>
      <input type="password" id="password" name="password" required placeholder="Enter your Password">
      <i class="fa-solid fa-eye" id="show-password"></i></div>

      <center><br> <br> <input class="btn btn-success" type="submit" name="login" value="Log In"> <br> <br>
      <a href="reset-password.php" class="float-end" style="color:white">Forgot Your Password </a>
      <hr style=" border-color: white; ">
      
       
  </form>
<script src = "script.js"></script>
      
      <p style="font-size: 17px"> Don't have an account? <div class="button-wrapper"><a href="category.php"><button> Register Now </a></button> </p></center>
</center>
</body>
</html>