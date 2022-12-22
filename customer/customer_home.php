<?php
    session_start();
    if(isset($_SESSION['uid'])){
        include("../dbconnection.php");
        // Check connection
        if (mysqli_connect_errno()){
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
        else{
            if(isset($_POST['filter'])){
                $services=$_POST['services'];
                $charges=$_POST['charges'];
                $city=$_POST['city'];
                $services=$_POST['ratings'];
                $filter_query="SELECT * FROM `register_technician`";
            }
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
        <link rel="stylesheet" href="../custom_style.css">
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
                    <div class="border border-3 border-light pt-2 pb-2">
                        <div class="row">
                            <form action="" method="post" class="d-flex justify-content-center">
                                <input class="col-9 d-inline rounded border border-dark border-1 pt-2 pb-2" name="search" type="text" id="inputSearch" placeholder="Type text here">
                                <button class="col-2 d-inline btn btn-primary" name="search">Search</button>
                            </form>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <form action="" method="post" class="mt-2 d-flex justify-content-center">
                                    <span class="me-2">
                                        <!-- Fetching Services Name from Database table and displaying in Dropdown -->
                                        <?php
                                            $services_query="SELECT * FROM `services`";
                                            $services_result=mysqli_query($con,$services_query);
                                        ?>
                                        <select name="services" class="rounded w-100 p-2 mb-2">
                                            <option value="">--Select An Service--</option>
                                        <?php
                                            while($services_options=mysqli_fetch_array($services_result)){
                                        ?>
                                            <option value="<?php echo $services_options['id'] ."-" . $services_options['name'];?>"><?php echo $services_options['name']; ?></option>
                                        <?php 
                                            } 
                                        ?>
                                        </select>
                                    </span>
                                    <span class="me-2">
                                        <select class="form-select border border-dark border-1 pt-2 pb-2" name="charges">
                                            <option selected>--Expected Charges--</option>
                                            <option value="1">100-500</option>
                                            <option value="2">500-1000</option>
                                            <option value="3">1000-1500</option>
                                            <option value="4">1500-2000</option>
                                            <option value="5">2000-3000</option>
                                            <option value="6">3000-4000</option>
                                            <option value="7">4000-5000</option>
                                            <option value="8">5000-10000</option>
                                        </select>
                                    </span>
                                    <span class="me-2">
                                        <!-- Fetching Services Name from Database table and displaying in Dropdown -->
                                        <?php
                                            $location_query="SELECT * FROM `register_technician`";
                                            $location_result=mysqli_query($con,$location_query);
                                        ?>
                                        <select name="city" class="rounded w-100 p-2 mb-2">
                                            <option value="">--Location--</option>
                                        <?php
                                            while($location_options=mysqli_fetch_array($location_result)){
                                        ?>
                                            <option value="<?php echo $location_options['id'] ."-" . $location_options['city'];?>"><?php echo $location_options['city']; ?></option>
                                        <?php 
                                            } 
                                        ?>
                                        </select>
                                    </span>
                                    <span>
                                        <select class="form-select border border-dark border-1 pt-2 pb-2" name="ratings">
                                            <option selected>--Ratings--</option>
                                            <option value="1">One Star</option>
                                            <option value="2">Two Star</option>
                                            <option value="3">Three Star</option>
                                            <option value="4">Four Star</option>
                                            <option value="5">Five Star</option>
                                        </select>
                                    </span>
                                    <span>
                                        <button class="btn btn-primary pt-2 pb-2" name="filter">Filter Result</button>
                                    </span>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <?php
                            $query="SELECT `id`, `description`, `charges` ,
                            (SELECT `name` FROM `register_technician` Where `id`=`technician_id`) as 'name', 
                            (SELECT `rating` FROM `feedback` Where `id`=`technician_id`) as 'rating'
                            FROM `services_offered`" ;
                            $result=mysqli_query($con, $query);
                            while($row=mysqli_fetch_array($result)){
                        ?>
                        <div class="card m-1 zoom" style="width: 17rem;" onclick="window.location.href='service_page.php?gig=<?php echo $row['id'];?>', '_self'">
                            <img src="../profile.png" class="align-self-center" atl="Pics"/>
                            <div class="card-body">
                                <h4><?php echo $row['name']; ?></h4>
                                <h5><?php echo $row['description']; ?></h5>
                                <h5>Ratings:- <?php echo $row['rating']; ?></h5>
                                <h4 class="bg-secondary">Charges:-<?php echo $row['charges'] ?></h4>
                            </div>
                        </div>
                        <?php 
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <!------------ Scripts Files -------------->
        <script src="../scripts/js/bootstrap.bundle.min.js"></script>
    </body>
</html>