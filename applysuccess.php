<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
  <script src = "../js/bootstrap.bundle.min.js"></script>
	<title>Successfully Send</title>
</head>
<body>
<style>
body, html {
  height: 100%;
  margin: 0;
  font-family: Times New Roman;
}

* {
  box-sizing: border-box;
}

.bg-image {
  background-image: url("images/bgg.jpg");
  filter: blur(2px);
  -webkit-filter: blur(2px);
  height: 100%; 
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
}


.bg-text {
  background-color: rgb(0,0,0); 
  background-color: rgba(19,60,88,0.5); 
  color: white;
  font-weight: bold;
  border-radius: 25px;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  z-index: 2;
  width: 80%;
  height: 85%;
  padding: 20px;
  text-align: center;
  box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
}


.maindiv{
  max-width: 100%;

}

form {
  position: relative;
  z-index: 1;
  max-width: 100%;
  height: 500px;
  margin: 0 auto 60px;
  padding: 40px;
  padding-top: 50px;
  text-align: left;
  color: white;
  border-radius: 25px;
  box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
}

input[type=text], input[type=password] {
  width: 100%;
  padding: 7px 7px;
  margin: 0px 0;
  display: inline-block;
  border: .5px solid;
  box-sizing: border-box;
}

</style>

<div class="bg-image"></div>

<div class="bg-text">
  <div class="maindiv">


    <form method="post">

      <div style="text-align: right;">
        <b><a href="index.php" class="btn btn-infos" style="color: red">X</a></b>
    </div>
      <center> 
         <h1 style="font-size: 45px;">Successfully Sent your Application Form! </h1><hr>
     

      <label style="font-size: 25px"> Make sure that the email address you put was correct. <br> We will send an email to you once we check your application form and send a referral link for your payment. <br> The approval takes within this day. Thankyou so much! <br> <br></label>

      <label> For more inquiries or questions please contact us 
      	<br>waterrefillingstation0@gmail.com<br>09753713523</label>
 </center>


   </form>
 </div>
</div>
</body>
</html>