<?php 
require_once "functions.php"; 
require "../connection.php"; ?>
<?php 
$email = $_SESSION['email'];
if($email == false){
  header('Location: login.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Code Verification</title>
<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
  <script src = "../js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <style>

    	body{
    margin: 0;
    font-family: Times New Roman;
     }
form {
  position: relative;
  z-index: 1;
  max-width: 380px;
  height: 200px;
  margin-left: 20%;
  border-radius: 10px;
  margin-top: 10px;
  text-align: left;
  color: white;
  background-image: url(../images/bgg.jpg);
  box-shadow: 0 0 10px 0 rgba(0, 0, 0, 0.2), 0 3px 3px 0 rgba(0, 0, 0, 0.24);
  border: 1px solid #ddd;
}

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

    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form">
                <form action="reset-code.php" method="POST" autocomplete="off">
                    <h2 class="text-center">Code Verification</h2>
                    <?php 
                    if(isset($_SESSION['info'])){
                        ?>
                        <div class="alert alert-success text-center" style="padding: 0.4rem 0.4rem">
                            <?php echo $_SESSION['info']; ?>
                        </div>
                        <?php
                    }
                    ?>
                    <?php
                    if(count($errors) > 0){
                        ?>
                        <div class="alert alert-danger text-center">
                            <?php
                            foreach($errors as $showerror){
                                echo $showerror;
                            }
                            ?>
                        </div>
                        <?php
                    }
                    ?>
                    <div class="form-group">
                        <input class="form-control" type="text" name="code" placeholder="Enter code" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control button" type="submit" name="check-reset-otp" value="verify">
                        <a href="reset-code.php">Reset code?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
</body>
</html>