<!DOCTYPE html>
<html>
<head>
    <title>Restore Archived Product</title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
  <script src = "../js/bootstrap.bundle.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
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
  margin-left: 210px;
  margin-right: 10px
}

.content1 {
  margin-left: 200px;
  padding-left: 30px;
  width: 83%;
}

.header{
  background-color: #333;
  padding-right: 20px;
  padding-left: 900px;
  color: #333;
  padding-top: 5px;
}

.button-group {
    display: flex;
    gap: 0px; /* Adjust the gap according to your preference */
}

.button-group button {
    margin: 0; /* Reset default margin for buttons */
}

.dropdown {
            position: relative;
            display: inline-block;
        }

        /* Basic styling for the button */
        .dropbtn {
            padding: 8px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            cursor: pointer;
        }

        /* Styling for the dropdown arrow */
        .dropbtn::after {
            content: '\25BC'; /* Unicode character for a downward-pointing triangle or arrow */
            
        }

        /* Styling for the dropdown content (the actual dropdown items) */
        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        /* Style for dropdown content items */
        .dropdown-content a {
            padding: 12px 16px;
            display: block;
            text-decoration: none;
            color: #333;
        }

        /* Change color on hover for dropdown content items */
        .dropdown-content a:hover {
            background-color: #f0f0f0;
        }

        /* Show the dropdown content when the button is hovered over */
        .dropdown:hover .dropdown-content {
            display: block;
        }
        .system-logo {
    color: #333;
    font-size: 30px
}
.system-logo {
    color: #333;
    font-size: 25px
}
</style>

    
    <div class="card">
    <div class="card-header d-flex justify-content-between">
        <h3 class="card-title">Archive</h3>
        <div class="card-tools align-middle">
             <a href="products.php"> <button class="btn btn-info" style="float: right; color: white "> <img src="../images/products.png" height="25px" width="20px"> Products </button> </a>
       
        </div>
    </div>
    <center>
     <h3>Select a product to restore:</h3>
            <form action="products.php" method="POST">
        <select name="product_id">
    
            <?php
            require '../connection.php';

            $archiveSql = "SELECT * FROM archived_products";
            $archiveResult = mysqli_query($con, $archiveSql);

            while ($row = mysqli_fetch_assoc($archiveResult)) {
                echo "<option value='{$row['product_id']}'>{$row['type']}</option>";
            }
            ?>
        </select>
        <button type="submit" class="btn btn-danger" style="float: right; color: white ">Restore Product</button>
    </form>
 </center>
</div>
</body>
</html>

