<?php
require '../connection.php';
require 'mail.php';
require 'functions.php';


$errors = array();

	if($_SERVER['REQUEST_METHOD'] == "GET" && isset($_GET['email'])){
	    $email = $_GET['email'];
	    
	
		$vars['code'] =  rand(10000,99999);

		$vars['expires'] = (time() + (60 * 5));
		$vars['email'] = $email;
		
		
		
         $query = $con->prepare("SELECT * from `verify` WHERE `email` = ? ORDER BY id DESC LIMIT 1");
         $query->bind_param("s", $email);
         $query->execute();
    	 $result = $query->get_result();
    	 
    	 
          $row = $result->fetch_assoc();  

                if($row['email_verified'] == 1){
                    $errors[] = "You are already verified!";
                }else{
                    
            		$query = "insert into verify (code,expires,email) values (:code,:expires,:email)";
                	database_run($query,$vars);
            
            		$message = "<h1>Welcome to Water Refilling Station!</h1><br><h2>We're happy that you're here.</h2><br><h4>To get started, please verify your email address so that we know it's really you.<br><br><strong>Your code is</strong></h4> " . $vars['code'] . "<br><br><h3>Best regards,<br>Water Refilling Station</h3><br><h4>Don't hesitate to contact us if you have any questions.<br>-Via Email: <a href='wrsteamtalongist@gmail.com'>Water Refilling Station</a> <br>-Via Address: Malolos, Bulacan</h4>";
            		$subject = "Water Refilling Station";
            		$recipient = $email;
                  
                  send_mail($recipient,$subject,$message);
                }
		
	
	}

if($_SERVER['REQUEST_METHOD'] == "POST"){
    if(isset($_GET['email'])){
        $email = $_GET['email'];
        
        $query = $con->prepare("SELECT * FROM `verify` WHERE `email` = ? ORDER BY id DESC LIMIT 1");
        $query->bind_param("s", $email);
        $query->execute();
        $result = $query->get_result();
        $row = $result->fetch_assoc();
        
        if($_POST['code'] == $row['code']){
            $time = time();
            
            if($row['expires'] > $time){
                $update = "UPDATE users SET email_verified = 1 WHERE email = ?";
                $queryUpdate = $con->prepare($update);
                $queryUpdate->bind_param("s", $email);
                
                if ($queryUpdate->execute()) {
                    $newuser = $con->prepare("SELECT * FROM `users` WHERE `email` = ?");
                    $newuser->bind_param("s", $email);
                    $newuser->execute();
                    
                    $result = $newuser->get_result();
                    if ($result->num_rows == 1) {
                        $rowDb = $result->fetch_assoc();
                        
                        session_start();
                        $_SESSION['user_id'] = $rowDb['user_id'];
                        $_SESSION['supplier'] = $rowDb['useradmin_id'];
                        $_SESSION['user_identity'] = [
                            "fullname" => $rowDb['username'],
                            "phone" => $rowDb['contact'],
                            "email" => $rowDb['email']
                        ];
                        
    
                         echo '<script>alert("Email verification successfully!"); window.location.href = "products.php?success=1";</script>';
                         exit;
                         
                        
                    }
                } else {
                    $errors[] = "Error updating user email verification status.";
                }
            } else {
                $errors[] = "Verification code has expired.";
            }
        } else {
            $errors[] = "Wrong verification code.";
        }
    } else {
        $errors[] = "Email not found.";
    }
}


if(isset($_GET['reset'])){
    $email = $_GET['email'];
    $query = $con->prepare("UPDATE `verify` SET `code` = ?, `expires` = ? WHERE `email` = ?");
    $newCode = rand(100000, 999999);
    $expires = time() + 3600; 
    $query->bind_param("sis", $newCode, $expires, $email);
    $query->execute();
    
   
    $subject = "New Verification Code";
    $message = "Your new verification code is: $newCode";
   
    
    echo '<script>alert("New verification code sent to your email!"); window.location.href = "verify.php?email='.$email.'";</script>';
    exit;
}

?>



<!DOCTYPE html>
<html lang="en">
    <head>
	    <meta charset="UTF-8">
		<meta name="viewport" width="device-width, initial-scale=1.0">
	    <title>Water Reffilin Station</title>
		<link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>

    	<style>

	body{
    margin: 0;
    font-family: Darker Grotesque;  }

.topnav {
  overflow: hidden;
  background-color: #0492c2;
  color: white;
  text-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
  box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
  font-size: 26px;
  padding-bottom: 10px;
}

.topnav a {
  float: right;
  color: white;
  margin: 20px 20px;
  padding: 6px 8px 6px 8px;
  border-radius: 10px;
  text-decoration: none;
  font-size: 17px;
}

.topnav a:hover {
  background-color: #03a9a8;
}

.topnav a.active {
  background-color:  #03c2c1;
  color: white;
}

form {
  position: relative;
  z-index: 1;
  height: 350px;
  margin: 0 auto 60px;
  border-radius: 20px;
  margin-top: 80px;
  text-align: center;
  color: #333;
  background-color: white;
  box-shadow: 0 0 10px 0 rgba(0, 0, 0, 0.2), 0 3px 3px 0 rgba(0, 0, 0, 0.24);
  border: 1px solid #333;
}

.button {
	background-color: #333;
  color: white;
  padding-top: 10px;
  padding-bottom: 10px;
  padding-left: 20px;
  padding-right: 20px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  margin-top: 30px;
  margin-bottom: 20px;
}

.button:hover {
  background-color: #262626;
  color: white;
  }

  input[type=text] {
  width: 40%;
  padding: 10px;
  display: inline-block;
  border: .5px solid;
  box-sizing: border-box;
}
</style>


		<div class="alert">
			 <?php if(count($errors) > 0):?>
				 <?php foreach ($errors as $error):?>
					<?= $error?> <br>	
				<?php endforeach;?>
			<?php endif;?>
		</div>

		<div class="container" style="min-height: 380px; max-width: 50%; margin-left: 25%">
            
            <div class="form-container" style="position: relative;">
                <form method="POST">
					<br>
					<h1>Code Verification</h1><br>
					<p>An email was sent to your address. Enter the code from the email here.</p>
                    <input class="form-wrapper" type="text" name="code" style="width: 50%;" placeholder="Enter your Code" required>
                    <br>
                    <button class="button" type="submit" value="verify">Verify</button>
                    <a href="verify.php?reset=1&email=<?php echo $_GET['email']; ?>">Reset code?</a>
                </form>
            </div>
	    </div>
	    



    </body>
</html>