<?php
require '../connection.php';
require '../admin/settings_function.php';
require 'settings_function.php';
session_start();

if (!isset($_SESSION['user_id'])) {
  
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
  <script src = "../js/bootstrap.bundle.min.js"></script>

   <title> Feedback </title>

<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<body>

<style>

body {
  margin: 0;
  font-family: Times New Roman;
  background-color:white;
}

.sidenav {
  height: 100%;
  width: 200px;
  position: fixed;
  z-index: 1;
  top: 0;
  left: 0;
  background-color: #333;
  overflow-x: hidden;
  text-align: left;
  color: white;
}

.sidenav a {
  color: white;
  padding: 10px;
  text-decoration: none;
  display: block;
}

/* Change color on hover */
.sidenav a:hover {
  background-color: #DDDDDD;
  color: #333;
}
.sidenav a.active {
  background-color: #00C2FF;
  color:white;
}

.content {
  margin-left: 200px;
  padding-left: 20px;
}

.header{
  background-color: #333;
  text-align: right;
  color: #333;
  font-size: 15px;
  padding-right: 20px;
  padding: 10px;
}



</style>

<div class="header">
 	<div class="dropdown">

        <a href="#" class="dropdown-toggle" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: white; margin-right: 20px">
            <img style="padding-right: 5px; margin-left: 35px;" src="../images/login.png" height="20px" width="30px"> <?php
  require '../connection.php';
    $user_id = $_SESSION['user_id'];

    $user = getUserSetting($user_id, $con);

    echo $user['fullname'];
?> 
        </a>
        <ul class="dropdown-menu" aria-labelledby="profileDropdown">

            <li><a class="dropdown-item" href="myprofile.php">My Profile</a></li>
        </ul>
    </div>
</div>

<div class="sidenav">

  <p style="margin-top: 40px; background-color: #00C2FF; padding-right: 10px; padding-left: 10px"> <b>
    <?php
  require '../connection.php';

    $user_id = $_SESSION['user_id'];

    $user = getUserSetting($user_id, $con);

   echo $user['company'];
?> </b>
  <center> <p style="color: white; font-size: 20px;padding-top: 40px; padding-bottom: 40px"> <?php
  require '../connection.php';

    $user_id = $_SESSION['user_id'];

    $user = getUserSetting($user_id, $con);

    echo "@" . $user['username'];
?>  </p>  </center>

  <br>
  <a href="products.php"> <img style="padding-right: 5px; margin-left: 35px" src="../images/products.png" height="25px" width="30px"> Products </a>
   <a class="active" href="feedback.php"> <img style="padding-right: 5px; margin-left: 35px" src="../images/review.png" height="30px" width="30px"> Reviews </a>
  <a href="order.php"> <img style="padding-right: 5px; margin-left: 35px" src="../images/order.png" height="30px" width="30px"> Orders </a>
  <br> <br> <br> <br>
  <a href="logout.php"> <img style="padding-right: 5px; margin-left: 35px;" src="../images/logout.png" height="30px" width="30px"> Log Out</a>
</div>

  <div class="content">
    <br>
      <div class="card" style="margin-right: 50px">
        <div class="card-header"><h3>Feedback</h3></div>
        <div class="card-body">
          <div class="row">
            <div class="col-sm-4 text-center">
              <h1 class="text-warning mt-4 mb-4">
                <b><span id="average_rating">0.0</span> / 5</b>
              </h1>
              <div class="mb-3">
                <i class="fas fa-star star-light mr-1 main_star"></i>
                            <i class="fas fa-star star-light mr-1 main_star"></i>
                            <i class="fas fa-star star-light mr-1 main_star"></i>
                            <i class="fas fa-star star-light mr-1 main_star"></i>
                            <i class="fas fa-star star-light mr-1 main_star"></i>
              </div>
              <h3><span id="total_review">0</span> Review</h3>
            </div>
            <div class="col-sm-4">
              <p>
                            <div class="progress-label-left"><b>5</b> <i class="fas fa-star text-warning"></i></div>

                            <div class="progress-label-right">(<span id="total_five_star_review">0</span>)</div>
                            <div class="progress">
                                <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="five_star_progress"></div>
                            </div>
                        </p>
              <p>
                            <div class="progress-label-left"><b>4</b> <i class="fas fa-star text-warning"></i></div>
                            
                            <div class="progress-label-right">(<span id="total_four_star_review">0</span>)</div>
                            <div class="progress">
                                <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="four_star_progress"></div>
                            </div>               
                        </p>
              <p>
                            <div class="progress-label-left"><b>3</b> <i class="fas fa-star text-warning"></i></div>
                            
                            <div class="progress-label-right">(<span id="total_three_star_review">0</span>)</div>
                            <div class="progress">
                                <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="three_star_progress"></div>
                            </div>               
                        </p>
              <p>
                            <div class="progress-label-left"><b>2</b> <i class="fas fa-star text-warning"></i></div>
                            
                            <div class="progress-label-right">(<span id="total_two_star_review">0</span>)</div>
                            <div class="progress">
                                <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="two_star_progress"></div>
                            </div>               
                        </p>
              <p>
                            <div class="progress-label-left"><b>1</b> <i class="fas fa-star text-warning"></i></div>
                            
                            <div class="progress-label-right">(<span id="total_one_star_review">0</span>)</div>
                            <div class="progress">
                                <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="one_star_progress"></div>
                            </div>               
                        </p>
            </div>
            <div class="col-sm-4 text-center">
              <h3 class="mt-4 mb-3">Write Review Here</h3>
              <button type="button" name="add_review" id="add_review" class="btn btn-primary">Review</button>
            </div>
          </div>
        </div>
      </div>
      <div class="mt-5" id="review_content"></div>
    </div>
</body>
</html>

<form id="review_form" method="POST" enctype="multipart/form-data">
<div id="review_modal" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Submit Review</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <h4 class="text-center mt-2 mb-4">
              <i class="fas fa-star star-light submit_star mr-1" id="submit_star_1" data-rating="1"></i>
                    <i class="fas fa-star star-light submit_star mr-1" id="submit_star_2" data-rating="2"></i>
                    <i class="fas fa-star star-light submit_star mr-1" id="submit_star_3" data-rating="3"></i>
                    <i class="fas fa-star star-light submit_star mr-1" id="submit_star_4" data-rating="4"></i>
                    <i class="fas fa-star star-light submit_star mr-1" id="submit_star_5" data-rating="5"></i>
            </h4>
            <div class="form-group">
            <input type="text" name="user_name" id="user_name" class="form-control" value="<?php echo $user['fullname']; ?>" />
            </div>

            <div class="form-group">
              <textarea name="user_review" id="user_review" class="form-control" placeholder="Type Review Here"></textarea>
            </div>
            
            <div class="form-group">
             <label for="image" class="control-label"><b>Upload Photo</label></b> <br>
              <input style="width: 60%;" accept="image/png, image/gif, image/jpeg, image/jpg, image/jfif" type="file" name="image" id="user_image" required class="form-control rounded-0">
              </div>
            
                 <br>
            <div class="form-group text-center mt-4">
              <button type="submit" class="btn btn-primary" id="save_review">Submit</button>
            </div>
        
</form>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    var rating_data = 0;

    $('#add_review').click(function(){

        $('#review_modal').modal('show');

    });

    $(document).on('mouseenter', '.submit_star', function(){

        var rating = $(this).data('rating');

        reset_background();

        for(var count = 1; count <= rating; count++)
        {

            $('#submit_star_'+count).addClass('text-warning');

        }

    });

    function reset_background()
    {
        for(var count = 1; count <= 5; count++)
        {

            $('#submit_star_'+count).addClass('star-light');

            $('#submit_star_'+count).removeClass('text-warning');

        }
    }

    $(document).on('mouseleave', '.submit_star', function(){

        reset_background();

        for(var count = 1; count <= rating_data; count++)
        {

            $('#submit_star_'+count).removeClass('star-light');

            $('#submit_star_'+count).addClass('text-warning');
        }

    });

    $(document).on('click', '.submit_star', function(){

        rating_data = $(this).data('rating');

    });

   
 $('#save_review').click(function(){
    var user_id = <?php echo $user['user_id']; ?>;
    var useradmin_id = <?php echo $user['useradmin_id']; ?>;
    var user_name = $('#user_name').val();
    var user_review = $('#user_review').val();
    if(user_name == '' || user_review == '') {
        alert("Please fill both fields.");
        return false;
    } else {
        var formData = new FormData();
        formData.append('rating_data', rating_data);
        formData.append('user_id', user_id);
        formData.append('useradmin_id', useradmin_id);
        formData.append('user_name', user_name);
        formData.append('user_review', user_review);
        formData.append('user_image', $('#user_image')[0].files[0]);

        $.ajax({
            url:"submit_rating.php",
            method:"POST",
            dataType: "json",
            contentType: false,
            processData: false,
            data: formData,
            success:function(data) {
                $('#review_modal').modal('hide');
                load_rating_data();
                alert(data.message);
            }
        });
    }
});

 load_rating_data()
 
    function load_rating_data() {
    $.ajax({
        url: "submit_rating.php",
        method: "POST",
        data: { 
            action: 'load_data',
            useradmin_id: <?php echo $user['useradmin_id']; ?> 
        },
        dataType: "JSON",
        success: function(data) {
            
             $('#average_rating').text(data.average_rating);
                $('#total_review').text(data.total_review);

                var count_star = 0;

                $('.main_star').each(function(){
                    count_star++;
                    if(Math.ceil(data.average_rating) >= count_star)
                    {
                        $(this).addClass('text-warning');
                        $(this).addClass('star-light');
                    }
                });

                $('#total_five_star_review').text(data.five_star_review);

                $('#total_four_star_review').text(data.four_star_review);

                $('#total_three_star_review').text(data.three_star_review);

                $('#total_two_star_review').text(data.two_star_review);

                $('#total_one_star_review').text(data.one_star_review);

                $('#five_star_progress').css('width', (data.five_star_review/data.total_review) * 100 + '%');

                $('#four_star_progress').css('width', (data.four_star_review/data.total_review) * 100 + '%');

                $('#three_star_progress').css('width', (data.three_star_review/data.total_review) * 100 + '%');

                $('#two_star_progress').css('width', (data.two_star_review/data.total_review) * 100 + '%');

                $('#one_star_progress').css('width', (data.one_star_review/data.total_review) * 100 + '%');
                
                
            if (data.review_data.length > 0) {
                var html = '';
    
                for (var count = 0; count < data.review_data.length; count++) {
                    html += '<div class="row mb-3">';
                    html += '<div class="col-sm-1"><div class="rounded-circle bg-danger text-white pt-2 pb-2"><h3 class="text-center">' + data.review_data[count].user_name.charAt(0) + '</h3></div></div>';
                    html += '<div class="col-sm-11">';
                    html += '<div class="card">';
                    html += '<div class="card-header"><b>' + data.review_data[count].user_name + '</b></div>';
                    html += '<div class="card-body">';
    
                    for (var star = 1; star <= 5; star++) {
                        var class_name = '';
                        if (data.review_data[count].rating >= star) {
                            class_name = 'text-warning';
                        } else {
                            class_name = 'star-light';
                        }
                        html += '<i class="fas fa-star ' + class_name + ' mr-1"></i>';
                    }
    
                    html += '<br />';
                    html += data.review_data[count].user_review;
    
                    if (data.review_data[count].user_image !== null) {
                        html += '<br />';
                        html += '<img src="' + data.review_data[count].user_image +'" class="img-fluid" style="max-width: 200px; max-height: 200px;" alt="User Image">';
                    }
    
                    html += '</div>';
                    html += '<div class="card-footer text-right">On ' + data.review_data[count].datetime + '</div>';
                    html += '</div>';
                    html += '</div>';
                    html += '</div>';
                }
                $('#review_content').html(html);
            }
        }
    });
}

</script>