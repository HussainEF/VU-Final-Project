<?php
    session_start();
    if(isset($_SESSION['uid'])){
        include("../dbconnection.php");
        // Check connection
        if (mysqli_connect_errno()){
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
        
    }
    else{
        echo "<script>alert('Your are not logged in. Please Login again')</script>";
        echo "<script>window.location.href= 'login_technician.php'</script>";
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Required meta tags always come first -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" type="text/css" href="styles/style.css">
        <link rel="stylesheet" href="../scripts/css/bootstrap.min.css">
        <title>Online Mobile Phone Technician Finder and Mobile Repairing</title>
    </head>
    <body>
        <nav class="navbar navbar-expand-xs bg-light">
            <div class="container">
                <div class="row container-fluid">
                    <h5 class="col-7 align-self-center">Online Mobile Phone Technician Finder and Mobile Repairing</h5>
                    <div class="col-5 d-flex justify-content-end">
                        <button  class="btn btn-secondary" onclick="window.open('')">Notifications</button>
                        <button  class="btn btn-primary" onclick="window.open('')">Settings</button>
                        <button  class="btn btn-info" onclick="window.open('logout.php', '_self')">Logout</button>
                    </div>
                </div>
            </div>        
        </nav>
        <div class="container">
            <div class="row">
                <!-- -->
                <?php include("sidebar.php"); ?>
                <div class="col-9 bg-transparent">
                    <div class="row">
                        <div class="col-4 border p-3 d-flex align-items-center justify-content-center">
                            <div class="border rounded bg-primary text-white p-2">
                                <h3 class="d-flex justify-content-center">10</h3>
                                <h3>Order Placed</h3>
                            </div>
                        </div>
                        <div class="col-4 border p-3 d-flex align-items-center justify-content-center">
                            <div class="border rounded bg-success text-white p-2">
                                <h3 class="d-flex justify-content-center">10</h3>
                                <h3>Order Completed</h3>
                            </div>                           
                        </div>
                        <div class="col-4 border p-3 d-flex align-items-center justify-content-center">
                            <div class="border rounded bg-danger text-white p-2">
                                <h3 class="d-flex justify-content-center">10</h3>
                                <h3>Pending Order</h3>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 p-5 border d-flex align-items-center justify-content-center">
                            <div class="border rounded bg-danger text-white p-2">
                                <h3 class="d-flex justify-content-center">10</h3>
                                <h3>Overall Rating</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!------------ Scripts Files -------------->
        <script src="../scripts/js/bootstrap.bundle.min.js"></script>
    </body>
</html>