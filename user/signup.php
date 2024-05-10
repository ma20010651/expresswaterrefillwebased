<?php  

require '../connection.php';
require "functions.php";

$errors = array();

$barangay = isset($_GET['barangay']) ? $_GET['barangay'] : '';
$company = isset($_GET['company']) ? $_GET['company'] : '';
$useradmin_id = isset($_GET['useradmin_id']) ? $_GET['useradmin_id'] : '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullname = $_POST['fullname'];
    $contact = $_POST['contact'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
 
    $useradmin_id = $_POST['useradmin_id'];
    $barangay = $_POST['barangay'];
    $company = $_POST['company'];

    $errors = signup($_POST);

    if (count($errors) == 0) {
        $stmt = $con->prepare("INSERT INTO users (fullname, contact, username, email, password, useradmin_id, barangay, company) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

        if ($stmt) {
            $stmt->bind_param("ssssssss", $fullname, $contact, $username, $email, $password, $useradmin_id, $barangay, $company);
            $stmt->execute();
            $stmt->close();

            header('Location: login.php');
            exit;
        } else {
            echo "Error in prepared statement: " . $con->error;
        }
    }
}

?>



<!DOCTYPE html>
<html>
<head>
	
	<title> Sign Up </title>

</head>

<style>

	body{
    margin: 0;
    font-family: Times New Roman;
     }

form {
  position: relative;
  z-index: 1;
  max-width: 50%;
  height: 100%;
  margin-left: 280px;
  border-radius: 20px;
  margin-top: 20px;
  margin-bottom: 20px;
  text-align: left;
  color: white;
  background-image: url(../images/bgg.jpg);
  box-shadow: 0 0 10px 0 rgba(0, 0, 0, 0.2), 0 3px 3px 0 rgba(0, 0, 0, 0.24);
  border: 1px solid #ddd;
}

input[type=text], input[type=password], input[type=email] {
  width: 65%;
  padding: 10px;
  display: inline-block;
  border-collapse: collapse;
  border: 1px solid #ddd;
  box-sizing: border-box;
  border-radius: 10px
}

input[type=submit] {
  background-color: #ddd;
  color: #333;
  padding-top: 10px;
  padding-bottom: 10px;
  padding-left: 40px;
  padding-right: 40px;
  border: none;
  border-radius: 10px;
  cursor: pointer;
  margin-top: 30px;
  margin-bottom: 20px;
  font: Time New Roman;
}

input[type=submit]:hover {
  background-color: #d3d3d3;
  color: #333;
}

.content {
  margin-left: 200px;
  padding-left: 20px;
}
</style>

<body>
 
<div class="alert">
      <?php if(count($errors) > 0):?>
        <?php foreach ($errors as $error):?>
          <?= $error?> <br> 
        <?php endforeach;?>
      <?php endif;?>
    </div>
    
<form method="post" action="signup.php?useradmin_id=<?php echo htmlspecialchars($useradmin_id); ?>&barangay=<?php echo htmlspecialchars($barangay); ?>&company=<?php echo htmlspecialchars($company); ?>'">
      <center> 
         <h1 style="font-size: 25px;"> Sign Up </h1> <br>
      </center>

      <label style="font-size: 18px; margin-right: 70px; padding-left: 30px">  Full Name: </label>
      <input type="text" name="fullname" required placeholder="Enter your Full Name"> <br> <br>

      <label style="font-size: 18px; margin-right: 22px; padding-left: 30px">  Contact Number: </label> 
      <input type="text" name="contact" maxlength="11" required placeholder="Enter your Contact Number"> <br> <br>

      <label style="font-size: 18px; margin-right: 66px; padding-left: 30px">  Username: </label> 
      <input type="text" name="username" required placeholder="Enter your Username"> <br> <br>

      <label style="font-size: 18px; margin-right: 39px; padding-left: 30px"> Email Address: </label>
      <input type="text" name="email" required placeholder="Enter your Email Address">  <br> <br>

      <label style="font-size: 18px;margin-right: 20px; padding-left: 30px"> Create Password: </label>
      <input type="password" name="password" required placeholder="Enter your Password"> <br> <br>

      <label style="font-size: 18px;margin-right: 10px; padding-left: 30px"> Confirm Password: </label>
      <input type="password" name="password2" required placeholder="Confirm your Password"> <br> <br>
      
      <input type="hidden" name="useradmin_id" value="<?php echo htmlspecialchars($useradmin_id); ?>">
      <input type="hidden" name="barangay" value="<?php echo htmlspecialchars($barangay); ?>">
      <input type="hidden" name="company" value="<?php echo htmlspecialchars($company); ?>">
     
      <div class="input-field checkbox-option" style="margin-left: 200px">
           <input type="checkbox" id="cb1" required>
           <label for="cb1"> I agree with <a style="color: #333;" href="terms-and-conditions.html"> Terms and Conditions </a>
                    </div>
      <div class="input-field checkbox-option" style="margin-left: 200px">
           <input type="checkbox" id="cb2" required>
           <label for="cb2"> I agree with <a style="color: #333;" href="privacy-policy.html"> Privacy Policy</a>
                    </div>

      <center> <input type="submit" value="Submit"> <hr>

      <p style="padding-top: 10px; padding-bottom:  10px"> Already have an account? <a style="color: #333;" href="login.php"> Log In Now </a></center> </p>

   </form>


</body>
</html>