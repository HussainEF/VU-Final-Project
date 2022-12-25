<!-------PHP Script------>
<?php
    session_start();
    if(isset($_SESSION['admin_id'])){
        include("../dbconnection.php");
        // Check connection
        if (mysqli_connect_errno()){
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
        
    }
    else{
        echo "<script>alert('Your are not logged in. Please Login again')</script>";
        echo "<script>window.location.href= 'admin_login.php'</script>";
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

        <!-- Bootstrap, Fontaweosme, Customized CSS -->
        <link rel="stylesheet" href="../fontawesome/css/font-awesome.min.css">
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
                <!-- sidebar section file included here -->
                <?php include("sidebar.php"); ?>
                <div class="col-9 bg-transparent">
                    <div class="row">
                        <h3 class="mt-2 mb-2 d-flex justify-content-center">Registered Technicians</h3>
                    </div>
                    <hr>
                    <div class="row p-2">
                        <div class="col-12">
                            <!-------PHP Script------>
                            <?php
                                $query="SELECT * FROM register_technician";
                                $result=mysqli_query($con, $query);
                                while($row=mysqli_fetch_array($result)){ 
                                    if($row['status']==true){
                            ?>
                                        <div class='row border border-2 border-secondary rounded mt-2 p-2'>
                                            <div class='col-2 p-2 d-flex justify-content-center border border-2 border-info rounded'>
                                                <img src='../profile.png'>
                                            </div>
                                            <div class='col-8 p-2 float-start border border-2 border-secondary rounded'>
                                                <h6>Name:- <?php echo $row['name']; ?></h6>
                                                <h6>Contact# <?php echo $row['contact']; ?></h6>
                                                <h6>Email:- <?php echo $row['email']; ?></h6>
                                                <h6><Address>Address:- <?php echo $row['address']; ?></Address></h6>
                                                <span class="">
                                                    <h6 class="d-inline">Rating:- </h6>
                                                    <label for="rating-5"><i class="fa fa-star"></i></label>
                                                    <label for="rating-3"><i class="fa fa-star"></i></label>
                                                    <label for="rating-2"><i class="fa fa-star"></i></label>
                                                    <label for="rating-1"><i class="fa fa-star"></i></label>
                                                    <label for="rating-1"><i class="fa fa-star"></i></label>
                                                </span>
                                                <h6><?php echo ($row['status']==true) ? "Active" : "Blocked"; ?></h6>
                                            </div>
                                            <div class='col-2 p-2 d-flex flex-column justify-content-center border border-2 border-success rounded'>
                                                <button class="col-12 btn btn-primary mb-2">View</button>
                                                <a href="view_technicians.php?<?php echo ($row['status']==true) ? "block" : "unblock"; ?>=<?php echo $row['id'];?>" class="col-12 btn btn-primary"><?php echo ($row['status']==false) ? "Activate" : "Block"; ?></a>
                                            </div>
                                        </div>      
                            <?php 
                                    }
                                }
                            ?>
                        </div>       
                    </div>
                </div>
            </div>
        </div>
        <!------------ Scripts Files -------------->
        <script src="../scripts/js/bootstrap.bundle.min.js"></script>
    </body>
</html>