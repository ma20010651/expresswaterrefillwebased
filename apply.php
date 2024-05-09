<?php
require 'connection.php';
require 'admin/settings_function.php';
?>

<!DOCTYPE html>
<html>
<head>
	<title> Apply </title>
	<link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<!DOCTYPE html>
<html lang="en">
<head>
  
  <style>
    body {
      margin: 0;
      font-family: Times New Roman;
      
    }

.form-group {
      margin-bottom: 15px;
    }

  form {
  position: relative;
  z-index: 1;
  max-width: 100%;
  text-align: left;
  color: #333;

}

input[type=text], input[type=password] {
  width: 50%;
  padding: 5px;
  display: inline-block;
  border: .5px solid;
  box-sizing: border-box;
}

input[type=submit] {
  background-color:  #333;
  color: white;
  padding-left: 30px;
  padding-right: 30px;
  padding-top: 5px;
  padding-bottom: 5px;
  margin-left: 77%;
  margin-bottom: 30px;
  margin-top: 10px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}
 .leftmaindiv {
   width: 50%;
    float: left;
  }

.rightmaindiv {
    width: 50%;
    float: right;
    background-image: url(images/bgg.jpg);
    background-size: cover; 
    height: 857px;
    color: white;
    position: relative;
}

.slideshow-container {
    margin-left: auto;
    margin-right: auto;
    text-align: center;
}

.mySlides {
    display: none;
}

img {
    max-width: 50%; /* Adjust image width */
    height: auto;
}

/* Style for navigation buttons */
.prev, .next {
    cursor: pointer;
    position: absolute;
    top: 50%;
    width: auto;
    padding: 15px;
    color: white;
    font-weight: bold;
    font-size: 20px;
    border-radius: 3px;
    user-select: none;
    -webkit-user-select: none;
    transition: background-color 0.3s ease;
}

.prev {
    left: 10px;
}

.next {
    right: 10px;
}

.prev:hover, .next:hover {
    background-color: rgba(159,197,232);
}


  </style>
</head>
<body>

<div class="leftmaindiv">
<form  method="POST"action="adda.php" enctype="multipart/form-data">

      <br> <br> <b>  <p style="font-size: 25px; margin-left: 60px"> Application Form </p></b> <br>


<div class="container">
    <div class="row">
      <div class="col-md-4">
        <div class="form-group" style="margin-left: 50px">
          <label for="firstname" class="control-label"><b>First Name</label></b> <br>
          <input style="width: 100%" type="text" name="firstname" id="firstname" required class="form-control rounded-0" placeholder="First Name">
        </div>
      </div>

      <div class="col-md-4">
        <div class="form-group" style="margin-right: 3px">
          <label for="lastname" class="control-label"><b>Last Name</label> </b><br>
          <input style="width: 100%" type="text" name="lastname" id="lastname" required class="form-control rounded-0" placeholder="Last Name">
        </div>
      </div>

      <div class="col-md-4">
        <div class="form-group" style="margin-right: 50px">
          <label for="middle" class="control-label"><b>Middle Initial</label></b> <br>
          <input style="width: 100%" type="text" name="middle" id="middle" required class="form-control rounded-0" placeholder="N/A if not applicable">
        </div>
      </div>
    </div>

  <div class="row">
      <div class="col-md-4">
        <div class="form-group" style="margin-left: 50px">
          <label for="age" class="control-label"><b>Age</label></b> <br>
          <input style="width: 100%" type="text" name="age" id="age" required class="form-control rounded-0" placeholder="0">
        </div>
      </div>

      <div class="col-md-4">
        <div class="form-group" style="margin-right: 3px">
          <label for="gender" class="control-label"><b>Gender</b></label>
          <select name="gender" id="gender" required class="form-control rounded-0">
            <option value="" disabled selected>Select your gender</option>
            <option value="male">Male</option>
            <option value="female">Female</option> </select>
        </div>
      </div>

      <div class="col-md-4">
          <div class="form-group" style="margin-right: 50px">
          <label for="contact" class="control-label"><b>Contact Number</label> </b><br>
          <input style="width: 100%" type="text" name="contact" id="contact" required class="form-control rounded-0" maxlength="11" placeholder="Contact Number">
        </div>
      </div>
  </div>

  <div class="row">
      <div class="col-md-4">
        <div class="form-group" style="margin-left: 50px">
          <label for="unit" class="control-label"><b>House Number</label></b> <br>
          <input style="width: 100%" type="text" name="unit" id="unit" required class="form-control rounded-0" placeholder="HouseNo/Purok/Block/Phase">
        </div>
      </div>

      <div class="col-md-4">
        <div class="form-group" style="margin-right: 3px">
          <label for="street" class="control-label"><b>Street</label></b> <br>
          <input style="width: 100%" type="text" name="street" id="street" required class="form-control rounded-0" placeholder="Street">
        </div>
      </div>

      <div class="col-md-4">
        <div class="form-group" style="margin-right: 50px">
          <label for="barangay" class="control-label"><b>Barangay</label></b> <br>
          <input style="width: 100%" type="text" name="barangay" id="barangay" required class="form-control rounded-0" placeholder="Barangay">
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-4">
        <div class="form-group" style="margin-left: 50px">
          <label for="city" class="control-label"><b>City/Province</label></b> <br>
          <input style="width: 100%" type="text" name="city" id="city" required class="form-control rounded-0" placeholder="City, Province">
        </div>
      </div>

      <div class="col-md-4">
        <div class="form-group" style="margin-right: 3px">
          <label for="country" class="control-label"><b>Country</label></b> <br>
          <input style="width: 100%" type="text" name="country" id="country" required class="form-control rounded-0" placeholder="Country">
        </div>
      </div>

      <div class="col-md-4">
        <div class="form-group" style="margin-right: 50px">
          <label for="zip" class="control-label"><b>Zip Code</label></b> <br>
          <input style="width: 100%" type="text" name="zip" id="zip" required class="form-control rounded-0" placeholder="0000">
        </div>
      </div>
    </div>

      <div class="row">
        <div class="col-md-5" style=" margin-left: 50px;"> 
          <div class="form-group">
              <label for="company" class="control-label"><b>Company Name</label></b> <br>
              <input style="width: 99%;" type="text" name="company" id="company" required class="form-control rounded-0" placeholder="Enter your Company Name">
              </div>
            </div>

          <div class="col-md-6"> 
          <div class="form-group">
               <label for="image" class="control-label"><b>Upload Business Permit</label></b> <br>
                <input style="width: 97%;" accept="image/png, image/gif, image/jpeg, image/jpg, image/jfif" type="file" name="image" id="image" required class="form-control rounded-0">
              </div>
            </div>
        </div>

<?php 
$sql = "SELECT * FROM `plans` ORDER BY `id` ASC";
$qry = $con->query($sql);
$i = 1;
?>
        <div class="row">
        <div class="col-md-5" style=" margin-left: 50px;"> 
          <div class="form-group">
               <label for="plan" class="control-label"><b>Plan</b></label>
        <select style="width: 97%" name="plan" id="plan" required class="form-control rounded-0">
            <option value="" disabled selected>Select your desired plan</option>
            <?php 
            $query = "SELECT title FROM plans WHERE status = 1";
            $result = mysqli_query($con, $query);
            while ($row = mysqli_fetch_assoc($result)): ?>
                <option value="<?php echo htmlspecialchars($row['title']); ?>"><?php echo htmlspecialchars($row['title']); ?></option>
            <?php endwhile; ?>
        </select>
              </div>
            </div>

          <div class="col-md-6"> 
          <div class="form-group">
                <label for="dti" class="control-label"><b>Upload DTI</label></b> <br>
                <input style="width: 97%;" accept="image/png, image/gif, image/jpeg, image/jpg, image/jfif" type="file" name="dti" id="dti" required class="form-control rounded-0">
              </div>
            </div>
        </div>



  <div class="row">
  <div class="col-md-5" style="margin-left: 50px;"> 
    <div class="form-group">
      <label for="email" class="control-label"><b>Email Address</label></b> <br>
      <input style="width: 98.7%;" type="email" name="email" id="email" required class="form-control rounded-0" placeholder="Enter your Email Address">
      <p style="color: red; font-size: 12px"> Note: Please input the correct email address</p>
    </div>
  </div>

<div class="col-md-6">
    <div class="form-group">
         <label for="validid" class="control-label"><b>Upload Valid ID</label></b> <br>
                <input style="width: 97%;" accept="image/png, image/gif, image/jpeg, image/jpg, image/jfif" type="file" name="validid" id="validid" required class="form-control rounded-0">
                <p style=" font-size: 12px"> Valid ID: Driver's License, SSS, Passport, PhilSys/National ID, NBI/Police Clearance, TIN ID, PagIbig ID, Postal ID, Voter's ID</p>
    </div>
</div>


        <input type="hidden" name="status" value="0" >

</div>
      <center> <input type="submit" name="submit" value="Submit"> 


   </form>
    </div>
  </center></div>

  </div>
            <div class="rightmaindiv">
                <center><h3 style="margin-top: 80px;">Our Clients</h3></center>
                <br><br><br>
                <div class="slideshow-container">
                    <?php
                    $sql = "SELECT * FROM useradmin WHERE status = 'Active'";
                    $result = $con->query($sql);

                    if ($result->num_rows > 0) {
                        while ($user = $result->fetch_assoc()) {
                            ?>
                            <div class="mySlides">
                                <img src="upload/<?php echo $user['logo']; ?>"
                                     style="display: block; margin: 0 auto;">
                                <div class="brand-info"><br><br>
                                    <?php echo $user['codename'] . ' - ' . $user['company']; ?>
                                </div>
                            </div>
                            <?php
                        }
                    } else {
                        echo "No clients found.";
                    }
                    ?>
                </div>
                <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                <a class="next" onclick="plusSlides(1)">&#10095;</a>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="scripts.js"></script>

<script>
    let slideIndex = 1;
    showSlides(slideIndex);

    function plusSlides(n) {
        showSlides(slideIndex += n);
    }

    function currentSlide(n) {
        showSlides(slideIndex = n);
    }

    function showSlides(n) {
        let i;
        let slides = document.getElementsByClassName("mySlides");
        if (n > slides.length) {
            slideIndex = 1;
        }
        if (n < 1) {
            slideIndex = slides.length;
        }
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        slides[slideIndex - 1].style.display = "block";
    }
</script>

</body>
</html>
