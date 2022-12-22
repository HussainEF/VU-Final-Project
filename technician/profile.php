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
        echo "<script>window.location.href= 'login_customer.php'</script>";
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
                <?php include("sidebar.php"); ?>
                <div class="col-9 bg-transparent">
                    <div class="row">
                        <div class="col-8">

                        </div>
                        <div class="col-4">

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <form action="" method="post">
                                <label>Name</label>
                                <input type="text" id="inputName" name="name" value="">
                                <label>Contact</label>
                                <input type="text" id="inputContact" name="contact" value="">
                                <label>Email</label>
                                <input type="text" id="inputEmail" name="email" value="">
                                <label>Address</label>
                                <input type="text" id="inputAddress" name="address" value="">
                                <label>City</label>
                                <input type="text" id="inputCity" name="city" value="">
                                <label>Gender</label>
                                <input type="radio" id="inputName" name="gender" value="">
                                <label>Male</label>
                                <input type="radio" id="inputName" name="gender" value="">
                                <label>Female</label>
                                <input type="radio" id="inputName" name="gender" value="">
                                <label>Others</label>
                                <label>Current Password</label>
                                <input type="password" id="inputCurrentPassword" name="currentpassword" value="">
                                <label>New Password</label>
                                <input type="password" id="inputNewPassword" name="newpassword" value="">
                                <label>Confirm Password</label>
                                <input type="password" id="inputConfirmPassword" name="confirmpassword" value="">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!------------ Scripts Files -------------->
        <script src="../scripts/js/bootstrap.bundle.min.js"></script>
    </body>
</html>