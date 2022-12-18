<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Required meta tags always come first -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" type="text/css" href="styles/style.css">
        <link rel="stylesheet" href="scripts/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="fonts/font-awesome.min.css">
        <title>Online Mobile Phone Technician Finder and Mobile Repairing</title>
    </head>
    <body>
        <nav class="navbar navbar-expand-xs bg-light">
            <div class="container">
                <div class="row container-fluid">
                    <h5 class="col-7 align-self-center">Online Mobile Phone Technician Finder and Mobile Repairing</h5>
                    <div class="col-5 d-flex justify-content-end">
                        <button  class="btn btn-secondary" onclick="window.open('login.php','_self')">Login</button>
                        <button  class="btn btn-primary" onclick="window.open('register.php','_self')">Register</button>
                        <button  class="btn btn-info">Admin-Panel</button>
                    </div>
                </div>
            </div>        
        </nav>
        <div class="container">
            <div class="row container-fluid">
                <div class="col-12">
                    <form class="d-flex justify-content-center" method="post">
                        <span class="col-8 me-2"><input class="form-control" type="text" id="inputSearch" placeholder="Type text here"></span>
                        <span class="col-4"><button class="btn btn-primary" name="btnsearch">Search</button></span>
                    </form>
                </div>
            </div>
            <div class="row container-fluid">
                <div class="col-12">
                    <!-- PHP Script Start Here -->
                    <?php
                        if(isset($_POST['btnsearch'])){
                            include("dbconnection.php");
                            // Check connection
                            if (mysqli_connect_errno()){
                                echo "Failed to connect to MySQL: " . mysqli_connect_error();
                            }
                            $query="SELECT * FROM register_technician";
                            $result=mysqli_query($con, $query);
                            while($row=mysqli_fetch_array($result)){
                                echo"<div class='col-5 container-fluid d-inline-flex rounded mt-2 me-2 shadow-lg'>
                                        <div class='row container-fluid'>
                                            <div class='col-5'>
                                                <img src='profile.png'>
                                            </div>
                                            <div class='col-7'>
                                                <h6>Name:-$row[name]</h6>
                                                <h6>Contact#:-$row[contact]</h6>
                                                <h6>Location:-$row[shop_location]</h6>
                                                <h6>Category:-$row[service_type]</h6>
                                                <h6>Price:-$row[min_charges]</h6>
                                            </div>
                                        </div>
                                    </div>"
                                ;
                            }
                        }
                    ?>
                </div>
            </div>
            <div class="row">
                <div>

                </div>
            </div>
        </div>
        <!------------ Scripts Files -------------->
        <script src="scripts/js/bootstrap.bundle.min.js"></script>
    </body>
</html>