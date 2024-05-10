<!DOCTYPE html>
<html>
<head>

  <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
  <script src = "../js/bootstrap.bundle.min.js"></script>


    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.20/b-1.6.1/b-flash-1.6.1/b-html5-1.6.1/b-print-1.6.1/r-2.2.3/datatables.min.css" />


   <title> Reports </title>

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
  font-size: 15px
}

</style>

<div class="header">
  .
</div>

<div class="sidenav">

  <p style="margin-top: 40px; background-color: #00C2FF; padding-left: 10px; padding-bottom: 15px; font-size: 15px; margin-bottom: 90px"><b> Super Administrator </b> </p>

  <a href="dashboard.php"> <img style="padding-right: 5px; margin-left: 35px;" src="../images/dashboard.png" height="25px" width="30px"> Dashboard </a>
  <a href="plans.php"> <img style="padding-right: 5px; margin-left: 35px" src="../images/plans.png" height="25px" width="30px"> Plans </a>
  <a href="applicant.php"> <img style="padding-right: 5px; margin-left: 35px" src="../images/applicant.png" height="25px" width="30px"> Applicants </a>
  <a href="clients.php"> <img style="padding-right: 5px; margin-left: 35px" src="../images/clients.png" height="25px" width="30px"> Clients </a>
  <a class="active" href="reports.php"> <img style="padding-right: 5px; margin-left: 35px" src="../images/reports.png" height="30px" width="30px"> Reports </a>
  <a href="settings.php"> <img style="padding-right: 5px; margin-left: 35px" src="../images/settings.png" height="25px" width="30px"> Settings </a>
  <br> <br> <br>
  <a href="../logout.php"> <img style="padding-right: 5px; margin-left: 35px;" src="../images/logout.png" height="30px" width="30px"> Log Out</a>
</div>

<div class="content">
<div class="container" style="max-width: 100%;">
    <div class="row">
        <div class="col-md-12 mt-5">
            <h1>Reports</h1>
            <hr>
        </div>
    </div>
    <div class="row">
    <div class="col-md-12">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text bg-info text-white" id="start_date_icon"><i class="fas fa-calendar-alt"></i></span>
            </div>
            <input type="text" class="form-control mr-2" id="start_date" placeholder="Start Date" readonly>
            <div class="input-group-prepend">
                <span class="input-group-text bg-info text-white" id="end_date_icon"><i class="fas fa-calendar-alt"></i></span>
            </div>
            <input type="text" class="form-control mr-2" id="end_date" placeholder="End Date" readonly>
            <div class="input-group-append">
                <button id="filter" class="btn btn-outline-info btn-sm">Filter</button>
            </div>
            <div class="input-group-append">
                <button id="reset" class="btn btn-outline-warning btn-sm ml-2">Reset</button>
            </div>
        </div>
    </div>
</div>
                <div class="row mt-3">
                    <div class="col-md-12">
                        <!-- Table -->
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered nowrap" id="records" style="width:100%">
                                <thead>
                                    <tr>
                                        <th> No </th>                 
                                        <th> Name </th>
                                        <th> Contact no.</th>  
                                        <th> Address </th>
                                        <th> Company </th>
                                        <th> Email Accounts </th>
                                        <th> Plan</th>
                                        <th> Status </th>
                                        <th> Date</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
</div>
</div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.0.min.js"
        integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"></script>
    <!-- Datepicker -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <!-- Datatables -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript"
        src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.20/b-1.6.1/b-flash-1.6.1/b-html5-1.6.1/b-print-1.6.1/r-2.2.3/datatables.min.js">
    </script>
    <!-- Momentjs -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script>
    $(function() {
        $("#start_date").datepicker({
            "dateFormat": "yy-mm-dd"
        });
        $("#end_date").datepicker({
            "dateFormat": "yy-mm-dd"
        });
    });
    </script>

    <script>
    // Fetch records

    $(function() {
    $("#start_date").datepicker({
        "dateFormat": "yy-mm-dd"
    });
    $("#end_date").datepicker({
        "dateFormat": "yy-mm-dd"
    });
});

function fetch(start_date, end_date) {
    $.ajax({
        url: "records.php",
        type: "POST",
        data: {
            start_date: start_date,
            end_date: end_date
        },
        dataType: "json",
        success: function(data) {
            // Filter records with status 1
            var filteredData = data.filter(function(record) {
                return record.status === "1";
            });

            // Datatables
            var i = "1";

            $('#records').DataTable({
                "data": filteredData,
                // buttons
                "dom": "<'row'<'col-sm-12 col-md-4'l><'col-sm-12 col-md-4'B><'col-sm-12 col-md-4'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                "buttons": [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
                // responsive
                "responsive": true,
                "columns": [{
                        "data": "id",
                        "render": function(data, type, row, meta) {
                            return i++;
                        }
                    },
                    {
                        "data": null,
                        "render": function(data, type, row, meta) {
                            return row.firstname + " " + row.lastname;
                        }
                    },
                    {
                        "data": "contact",
                    },
                    {
                        "data": null,
                        "render": function(data, type, row, meta) {
                            return row.unit + " " + row.street+ " " + row.barangay+ " " + row.city+ " " + row.country;
                        }
                    },
                    {
                        "data": "company"
                    },
                    {
                        "data": "email"
                    },
                    {
                        "data": "plan"
                    },
                    {
                        "data": "status",
                        "render": function(data, type, row, meta) {
                            var badgeClass = 'badge badge-success';
                            var statusText = '';
                            switch (row.status) {
                                case '1':
                                    statusText = 'Approved';
                                    break;
                                case '2':
                                    badgeClass = 'badge badge-danger';
                                    statusText = 'Denied';
                                    break;
                                default:
                                    badgeClass = 'badge badge-primary';
                                    statusText = 'Pending';
                                    break;
                            }
                            return '<span class="' + badgeClass + '">' + statusText + '</span>';
                        }
                    },
                    {
                        "data": "date",
                        "render": function(data, type, row, meta) {
                            return moment(row.date).format('DD-MM-YYYY');
                        }
                    }
                ]
            });
        }
    });
}

    fetch();

    // Filter

    $(document).on("click", "#filter", function(e) {
        e.preventDefault();

        var start_date = $("#start_date").val();
        var end_date = $("#end_date").val();

        if (start_date == "" || end_date == "") {
            alert("both date required");
        } else {
            $('#records').DataTable().destroy();
            fetch(start_date, end_date);
        }
    });

    // Reset

    $(document).on("click", "#reset", function(e) {
        e.preventDefault();

        $("#start_date").val(''); // empty value
        $("#end_date").val('');

        $('#records').DataTable().destroy();
        fetch();
    });
    </script>
</body>

</html>