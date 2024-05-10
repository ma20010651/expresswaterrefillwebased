<?php
session_start();
require '../connection.php';
require 'settings_function.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$user_query = mysqli_query($con, "SELECT useradmin_id FROM `users` WHERE user_id = '$user_id'");

$billingQuery = mysqli_query($con, "SELECT user_id FROM `billing_information` WHERE user_id = '$user_id'");

$isBilling = false;

if(mysqli_num_rows($billingQuery) > 0){
  $isBilling = true;
} 


if ($user_query) {
    $user_result = mysqli_fetch_assoc($user_query);
    if ($user_result) {
        $useradmin_id = $user_result['useradmin_id'];

        if (isset($_POST['update_update_btn'])) {
            $update_value = $_POST['update_quantity'];
            $update_id = $_POST['update_quantity_id'];
            $update_quantity_query = mysqli_query($con, "UPDATE `cart` SET quantity = '$update_value' WHERE cart_id = '$update_id'");
            if ($update_quantity_query) {
                header('location:cart.php');
            }
        }

        if (isset($_GET['remove'])) {
            $remove_id = $_GET['remove'];
            mysqli_query($con, "DELETE FROM `cart` WHERE cart_id = '$remove_id'");
            header('location:cart.php');
        }

        if (isset($_GET['delete_all'])) {
            mysqli_query($con, "DELETE FROM `cart` WHERE useradmin_id = '$useradmin_id'");
            header('location:cart.php');
        }

        $products_query = mysqli_query($con, "SELECT * FROM `products` WHERE useradmin_id = '$useradmin_id' ");
        $products = mysqli_fetch_all($products_query, MYSQLI_ASSOC);

        $cart_items_query = mysqli_query($con, "SELECT * FROM `cart` WHERE useradmin_id = '$useradmin_id' AND user_id = '$user_id'");
        $cart_items = mysqli_fetch_all($cart_items_query, MYSQLI_ASSOC);

    } else {
        echo "Useradmin ID not found for the given user ID.";
    }
} else {
    echo "Error in user query: " . mysqli_error($con);
}





$cartList = array();
$userIdentity = array();

if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit();
} else {

  $supplierId = isset($_SESSION['supplier']) ? $_SESSION['supplier'] : 0;


  if ($supplierId != 0) {


    $getUserID = $_SESSION['user_id'];


    $billingQuery = mysqli_query($con, "SELECT * FROM `billing_information` WHERE user_id = '$getUserID'");


    $cart = mysqli_query($con, "SELECT * FROM `cart` WHERE useradmin_id = '$supplierId' AND user_id = '$getUserID'");


      $userIdentity = mysqli_fetch_assoc($billingQuery);

    while ($cartUser = mysqli_fetch_assoc($cart)) {
      $cartList[] = json_encode($cartUser);
    }
  }
}



?>


<!DOCTYPE html>
<html>
<head>

  <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
  <script src = "../js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
   <title> Cart </title>

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

table, td, th {
  border: .5px solid grey;
}

table {
  border-collapse: collapse;
  width: 95%;
  margin-top: 30px;
  margin-left: 20px;
}

th {
  text-align: center;
  background-color: #333;
  padding-top: 5px;
  padding-bottom: 5px;
  color: white;
}

td{
  padding-top: 10px;
  padding-bottom: 10px;
  padding-left: 10px
}
tr:hover {background-color: #DDDDDD}


.border--line:hover{
  border:1px dotted #7e7e7e;
  padding:0.5rem;
  cursor:pointer;
  border-radius: 4px;;
}


.border--active{
  border:1px dotted #7e7e7e;
  padding:0.5rem;
  cursor:pointer;
  border-radius: 4px;;
}

.quantity-arrow {
    display: inline-block;
    width: 25px;
    height: 25px;
    background-color: #ccc;
    color: #333;
    font-size: 20px;
    text-align: center;
    line-height: 25px;
    cursor: pointer;
}

.quantity-arrow:hover {
    background-color: #ddd;
}

.quantity-arrow.plus {
    border: 1px solid #999;
    border-radius: 5px
}

.quantity-arrow.minus {
    border: 1px solid #999;
    border-radius: 5px
}

.quantity-dropdown {
    display: flex;
    align-items: center;
}

input[type="number"] {
    width: 43px;
    text-align: right;
    border: 1px solid #ccc;
    border-radius: 5px;
    margin: 0 5px;
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
<input type="hidden" id='checkBillingInfo' value="<?php echo $isBilling ?>">

   <input type="hidden" id='getCartItems' value="<?php echo htmlspecialchars(json_encode($cartList)); ?>" />
  <input type="hidden" id='getUserIdentity' value="<?php echo htmlspecialchars(json_encode($userIdentity)); ?>" />

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
  <a class="active" href="products.php"> <img style="padding-right: 5px; margin-left: 35px" src="../images/products.png" height="25px" width="30px"> Products </a>
  <a href="feedback.php"> <img style="padding-right: 5px; margin-left: 35px" src="../images/review.png" height="30px" width="30px"> Reviews </a>
  <a href="order.php"> <img style="padding-right: 5px; margin-left: 35px" src="../images/order.png" height="30px" width="30px"> Orders </a>
  <br> <br> <br> <br>
  <a href="logout.php"> <img style="padding-right: 5px; margin-left: 35px;" src="../images/logout.png" height="30px" width="30px"> Log Out</a>
</div>

<div class="content">
<div class="container">

<section class="shopping-cart" style="padding-top: 20px">

   <h1 class="heading"> Shopping Cart</h1>

   <table>

      <thead>
         <th> Image </th>
         <th> Type of Container </th>
         <th> Price </th>
         <th> Quantity </th>
         <th> Total Price </th>
         <th> Action </th>
      </thead>

      <tbody>

         <?php 
    $user_id = $_SESSION['user_id'];

    $select_cart = mysqli_query($con, "SELECT * FROM `cart` WHERE useradmin_id = '$useradmin_id'");
    $grand_total = 0;

    if (mysqli_num_rows($select_cart) > 0) {
        while ($fetch_cart = mysqli_fetch_assoc($select_cart)) {
            $sub_total = floatval($fetch_cart['price']) * intval($fetch_cart['quantity']);
?>
           
         <tr>
            <td><img src="../upload/<?php echo  $fetch_cart['image']; ?>" height="100" alt=""></td>
            <td><?php echo $fetch_cart['type']; ?></td>
            <td><?php echo number_format((float)$fetch_cart['price']); ?>  Pesos</td>
            <td>
                <form action="" method="post" class="quantity-form">
                    <input type="hidden" name="update_quantity_id" value="<?php echo $fetch_cart['cart_id']; ?>">
                    <div class="quantity-dropdown">
                        <span class="quantity-arrow minus" onclick="decrementQuantity(this)">-</span>
                        <input type="number" name="update_quantity" min="1" value="<?php echo $fetch_cart['quantity']; ?>">
                        <span class="quantity-arrow plus" onclick="incrementQuantity(this)">+</span>
                    </div>
                    <input type="submit" value="Update" name="update_update_btn" style="display: none;">
                </form>
            </td>
            
            <td><?php echo number_format($sub_total); ?> Pesos</td>

            <td><a href="cart.php?remove=<?php echo $fetch_cart['cart_id']; ?>" onclick="return confirm('remove item from cart?')" class="delete-btn"> <i class="fas fa-trash"></i> Remove</a></td>
         </tr>
         <?php
           $grand_total += $sub_total;  
        }
    }
?>
<tr class="table-bottom">
    <td><a href="products.php" class="option-btn" style="margin-top: 0;"> Continue Shopping </a></td>
    <td colspan="3"> Overall Total</td>
    <td><?php echo number_format($grand_total); ?> Pesos </td>
    <td><a href="cart.php?delete_all" onclick="return confirm('are you sure you want to delete all?');" class="delete-btn"> <i class="fas fa-trash"></i> Delete All </a></td>
</tr>
<input type='hidden' id='getTotal' value='<?php echo $grand_total ?>' />

      </tbody>
   </table>
  <div style="gap:1rem;" class="d-flex justify-content-end align-items-end mr-5 mt-4">
    <input class='d-none' type="radio" id="cod" class="method"
          name="method_of_payment" value="cod"
          checked>
      <label class="border--line" for="cod"><img style="width:60px"
              src="../images/payment/cod.png" alt=""></label>

        <input class='d-none' type="radio" id="gcash" class="method"
      name="method_of_payment" value="gcash">
  <label for="gcash" class='border--line'><img style="width:60px"
          src="../images/payment/gcash.png"
          alt=""></label>
    </div>

   <div style="width:94%" class="d-flex justify-content-end align-items-end mt-3">
      <div id='placeOrder' class="checkout-btn d-none p-x-5 py-2">
      <a class="btn btn-success text-white font-weight-bold">Place order</a>
   </div>
   </div>

</section>

<input type="hidden" id='selectedType' value=''>

<!-- Button trigger modal -->
<button class='d-none invisible' id='onBillingForm' type="button" class="btn btn-primary" data-toggle="modal" data-target="#billingInfo">
</button>

<!-- Modal -->
<div class="modal fade" id="billingInfo" tabindex="-1" role="dialog" aria-labelledby="billingInfoTitle" aria-hidden="true" data-backdrop="static" >
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Home Address</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
     <form id='billingForm'>
      <div class="modal-body">

          <small id="housenoHelp" class="form-text text-muted "  aria-labelledby="housenoHelp">Provide a valid address to prevent conflict transaction</small>
        
  
  
         <div class="form-group">
          <label class="font-weight-bold" for="houseno"> House No. </label>
            <input class="form-control" type="text" placeholder="House No." id='houseno' name="houseno" required>
         </div>
         <div class="form-group">
          <label class="font-weight-bold" for="purok"> Purok </label>
            <input class="form-control" type="text" placeholder="Purok" id='purok' name="purok" required>
         </div>
         <div class="form-group">
            <label class="font-weight-bold" for="street"> Street </label>
            <input class="form-control" type="text" placeholder="Street Name" id='street' name="street" required>
         </div>
        

     
      </div>
      <div class="modal-footer">
        
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
   </form>
    
          <input type="hidden" id='status' value="Pending" name="status" required>
          <input type="hidden" id='category'  value="Online" name="category" required>
    </div>
  </div>
</div>

</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function incrementQuantity(element) {
        var inputField = element.parentNode.querySelector('input[type="number"]');
        inputField.stepUp();
        updateForm(element);
    }

    function decrementQuantity(element) {
        var inputField = element.parentNode.querySelector('input[type="number"]');
        inputField.stepDown();
        updateForm(element);
    }

    function updateForm(element) {
        var form = element.closest('form');
        var submitButton = form.querySelector('input[type="submit"]');
        submitButton.click();
    }
</script>
<script>

let searchPaymentStatus = new URLSearchParams(window.location.search);


console.log(searchPaymentStatus.get('payment'));



const elGcash = `<div class='d-flex flex-column justify-content-center align-items-center'><img src='../images/payment/gcash.png' class='img-responsive' width='150' height='100'/> <p class='text-danger font-weight-bold'>Gcash payment denied</p> </div>`;


if(searchPaymentStatus.get('payment') === 'failed'){
  Swal.fire({
        icon: "error",
        title: "Opps",
        html: elGcash
  }).then((result) => {
   
    if (result.isConfirmed) {
         const currentUrlWithoutParams = window.location.origin + window.location.pathname;
         window.location.href = currentUrlWithoutParams;
    }
  });


  
}

if(searchPaymentStatus.get('payment') === 'success'){


  const currentSession = sessionStorage.getItem('current_checkout_session');


  if(currentSession){
    let paymentDetails = JSON.parse(currentSession);




    let products = [];
    let prices = [];
    let quantity = [];
 



    let product = paymentDetails.attributes.line_items.map((product) =>{
        
        let productName = product.name;
        let quantityPrice = product.quantity;
        
        let productNameandPrice = `${productName} (${quantityPrice})`;

      products.push(productNameandPrice);
      prices.push(Number(product.amount / 100));
      quantity.push(Number(product.quantity));


    })


  let listProducts = products.join(',');
  let totalPrices = prices.reduce((acc,c) => acc + c ,0);
  let totalQuantity = quantity.reduce((acc,c) => acc + c ,0);

   let getTotalPrices = $('#getTotal').val();


  let status = $('#status').val();
  let category = $('#category').val();
  let getUserIdentity = $('#getUserIdentity').val();
  let getCurrentItemONCart = $('#getCartItems').val();
      
  let userList = JSON.parse(getUserIdentity);

  let getCart = JSON.parse(getCurrentItemONCart);

 
    
    
 

  let productsIds = [];
     

       getCart.map((product) =>{

           let productitem = JSON.parse(product);
            productsIds.push(Number(productitem.cart_id));

        })

      let ids = productsIds.join(',');

    const paymentInfo = {
      ref_number:paymentDetails.attributes.reference_number,
      paymentType:paymentDetails.attributes.payment_method_types[0],
      product_sold:listProducts,
      quantity:totalQuantity,
      amount:getTotalPrices,
      status:status,
      category:category,
      billingId:userList.billingId,
      productId:ids
    }


       $.ajax({
        url:'controller-cart.php?action=transaction',
        method:'POST',
        data: paymentInfo,
        dataType:'json',
        success:function(res){

          if(res.success){
                 Swal.fire({
                position: "center",
                icon: "success",
                title: res.message,
                showConfirmButton: true,
                timer: 1500
                });

                 // if (result.isConfirmed) {
              //     const currentUrlWithoutParams = window.location.origin + window.location.pathname;
              //     window.location.href = currentUrlWithoutParams;
              // }

                    setTimeout(() => {
                           window.location.href = 'products.php';
                    }, 1500);
          
              // location.reload();
            
          }else{
             Swal.fire({
            icon: "error",
            title: "Oops...",
            text: res.message
          });
          }
        

        },
        error:function(err){

          Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "Something went wrong!"+JSON.stringify(err),
          });
        }

      });


  }








 
}



$('[name="method_of_payment"]').on('click', function() {
    var selectedValue = $(this).val();
  let isBillingInfo = $('#checkBillingInfo').val();

  $('label').removeClass('border--active');

  if(isBillingInfo && selectedValue){
      $('#selectedType').val(selectedValue);
        $('#placeOrder').removeClass('d-none');

           let id = $(this).attr('id');

           let labelFor = $('label[for="' + id + '"]'); 
            
           labelFor.addClass('border--active'); 
         

  }else{
      $('#onBillingForm').click();
        $('#placeOrder').removeClass('d-none')
        $(this).removeClass('border--active');

  }
});





$('#placeOrder').on('click', function() {
  let selectedValue = $('#selectedType').val();

  if(selectedValue){
    console.log(selectedValue);
    if(selectedValue == 'cod'){
     


      

  

        let status = $('#status').val();
        let category = $('#category').val();
        let getUserIdentity = $('#getUserIdentity').val();
        let getCurrentItemONCart = $('#getCartItems').val();
      

        if(getCurrentItemONCart && getUserIdentity){
        let userList = JSON.parse(getUserIdentity);
        let getCart = JSON.parse(getCurrentItemONCart);


        console.log(getCart,'get cart')

        let products = [];
        let productsIds = [];
        let prices = [];
        let quantity = [];
      



          getCart.map((product) =>{

           let productitem = JSON.parse(product);


            let productName = productitem.type;
            let quantityPrice = productitem.quantity;
            
            let productNameandPrice = `${productName} (${quantityPrice})`;

            products.push(productNameandPrice);
            prices.push(Number(productitem.price));
            quantity.push(Number(productitem.quantity));
            productsIds.push(Number(productitem.cart_id));

          })


        let listProducts = products.join(',');
        // let totalPrices = prices.reduce((acc,c) => acc + c ,0);
        let totalQuantity = quantity.reduce((acc,c) => acc + c ,0);
         let ids = productsIds.join(',');
         
         let getTotalPrices = $('#getTotal').val();

            console.log(ids,'get ids')

          const paymentInfo = {
            ref_number: randomString(10, '#aA'),
            paymentType:'cod',
            product_sold:listProducts,
            quantity:totalQuantity,
            amount:getTotalPrices,
            status:status,
            category:category,
            billingId:userList.billingId,
            productId:ids
          }


          
           $.ajax({
              url:'controller-cart.php?action=transaction',
              method:'POST',
              data: paymentInfo,
              dataType:'json',
              success:function(res){

                if(res.success){
                    
                  Swal.fire({
                      position: "center",
                      icon: "success",
                      title: res.message,
                      showConfirmButton: false,
                      timer: 1500
                      }).then((result) => {
                      
                        
                        setTimeout(() => {
                           window.location.href = 'products.php';
                        }, 1500);

                      });
                
                   
                  
                }else{
                  Swal.fire({
                  icon: "error",
                  title: "Oops...",
                  text: res.message
                });
                }
              

              },
              error:function(err){

                Swal.fire({
                  icon: "error",
                  title: "Oops...",
                  text: "Something went wrong!"+JSON.stringify(err),
                });
              }

            });






        }





    }else{

      
    let getCurrentItemONCart = $('#getCartItems').val();
    let getUserIdentity = $('#getUserIdentity').val();
     

    if(getCurrentItemONCart && getUserIdentity){

      let parseIdentity = JSON.parse(getUserIdentity);

      let getCart = JSON.parse(getCurrentItemONCart);


        const billingAddress={ 
         address:`${parseIdentity.houseno} ${parseIdentity.street} ${parseIdentity.barangay} ${parseIdentity.city} ${parseIdentity.province} ${parseIdentity.country} ${parseIdentity.pin_code}}`,
          city:parseIdentity.city,
          state:parseIdentity.state,
          zipcode:parseIdentity.pin_code,
          name:parseIdentity.name,
          email:parseIdentity.email,
          phone:parseIdentity.phone
        };

    

        //  clone product
        let products = [];
          if(getCart){
              getCart.map((product) => {


                let productitem = JSON.parse(product);

               const amount = Math.floor(Number(productitem.price) * Number(100));


                  const listofProduct =   {
                            currency: 'PHP',
                            images: ['https://res.cloudinary.com/dtglatqdh/image/upload/v1709035239/WRS_opssdj.svg'],
                            amount:amount,
                            description: 'Payment subscription approve',
                            name: productitem.type,
                            quantity: Number(productitem.quantity)
                  }

                  products.push(listofProduct)
              });
          }

           createPaymentLisk('gcash',billingAddress,products);
     }
             
         



     


    




    }

   
  }else{   
       $('#placeOrder').addClass('d-none');
  }

});



$('#billingForm').on('submit',function(e){

e.preventDefault();



  $.ajax({
    url:'controller-cart.php?action=billing',
    method:'POST',
    data:$('#billingForm').serialize(),
    dataType:'json',
    success:function(res){

      if(res.success){
            Swal.fire({
              position: "center",
              icon: "success",
              title: res.message,
              showConfirmButton: false,
              timer: 1500
            });
          $('#billingInfo').hide();
          $('.modal-backdrop').hide();
          $('#checkBillingInfo').val(false);

          location.reload();
        
      }else{
         Swal.fire({
        icon: "error",
        title: "Oops...",
        text: res.message
      });
      }
    

    },
    error:function(err){

      Swal.fire({
        icon: "error",
        title: "Oops...",
        text: "Something went wrong!"+JSON.stringify(err),
      });

  }


  });
  




})






   function randomString(length, chars) {
                    var mask = '';
                    if (chars.indexOf('A') > -1) mask += 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                    if (chars.indexOf('#') > -1) mask += '0123456789';
                    var result = '';
                    for (var i = length; i > 0; --i) result += mask[Math.floor(Math.random() * mask.length)];
                    return result;
   }


   function createPaymentLisk(cardType,billing={},products=[]) {


            
        // payment mode
        // need to secure not upload on public server
        const apiLink = 'https://api.paymongo.com/v1/links';

        const apiKeySandbox='Basic c2tfdGVzdF8zY2IzUjh3RmpadFBob3Q4SHgxN1M4dlk6VGVhbXRhbG9uZ2lzdEA0';





                const options = {
                method: 'POST',
                headers: {
                    accept: 'application/json',
                    'Content-Type': 'application/json',
                    authorization: apiKeySandbox
                },
                body: JSON.stringify({
                    data: {
                    attributes: {
                        billing: {
                        address: {
                            line1: billing.address,
                            line2: '',
                            city: billing.city,
                            state: billing.state,
                            postal_code: billing.zipcode,
                            country: 'PH'
                        },
                        name: billing.name,
                        email: billing.email,
                        phone: billing.phone
                        },
                        send_email_receipt: true,
                        show_description: true,
                        show_line_items: true,
                        cancel_url: "https://expresswaterrefillwebased.com/user/cart.php?payment=failed",
                        description: 'WRS',
                        line_items: products,
                        payment_method_types: [cardType],
                        reference_number: randomString(10, '#aA'),
                        success_url: "https://expresswaterrefillwebased.com/user/cart.php?payment=success",
                        statement_descriptor: 'WRS'
                    }
                    }
                })
                };

        fetch('https://api.paymongo.com/v1/checkout_sessions', options)
        .then(response => response.json())
        .then(response =>   {

            sessionStorage.setItem('current_checkout_session',JSON.stringify(response.data))


           return  location.href = response.data.attributes.checkout_url

        })
        .catch(err => {
             Swal.fire({
            icon: "error",
            title: "Oops...",
            text: 'The total amount is greather than 20 pesos'
          });
        });

     }





$('#placeOrder').on('submit',function(e){

e.preventDefault();



   let formInput  = document.getElementById('addOrder');
    let formData = new FormData(formInput);


    let data = {};

    for(let pair of formData.entries()){
      data[pair[0]]= pair[1];
    }



})



</script>