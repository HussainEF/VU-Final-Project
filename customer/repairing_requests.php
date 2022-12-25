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
                        <h3 class="mt-2 mb-2 d-flex justify-content-center">Repairing Requesets</h3>
                    </div>
                    <?php
                        $request_query="SELECT `message`, `status`, 
                                        (SELECT `name` FROM `register_technician` WHERE `id`=`technician_id`) as `name`,
                                        (SELECT `charges` FROM `services_offered` WHERE `id`=`service_id`) as `charges`,
                                        (SELECT `description` FROM `services_offered` WHERE `id`=`service_id`) as `description`
                                        FROM `service_request` WHERE `customer_id`='$_SESSION[uid]'";
                        $run_query=mysqli_query($con, $request_query);
                        while($get_data=mysqli_fetch_array($run_query)){
                    ?>
                        <div class="row border bg-light rounded m-2 p-2">
                            <div class="col-5 bg-white border-end border-3">
                                <h6 class=""><?php echo $get_data['name'] ?></h6>
                                <h6><?php echo $get_data['description'] ?></h6>
                                <h6><?php echo $get_data['charges'] ?></h6>
                            </div>
                            <div class="col-5 bg-white border-end border-3">
                                <h6 class="d-flex justify-content-center"><b>Your Messege For Technician</b></h6>
                                <p class="border-1 border-secondary"><?php echo $get_data['message'] ?></p>
                            </div>
                            <div class="col-2 bg-white d-flex flex-column justify-content-center border-end border-3">
                                <h6 class="align-self-center">Stauts</h6>
                                <button class="rounded p-1 align-self-center"><?php echo $get_data['status'] ?></button>
                            </div>
                        </div>
                    <?php
                        } 
                    ?>
                </div>
            </div> 
        </div>
        <!------------ Scripts Files -------------->
        <script src="../scripts/js/bootstrap.bundle.min.js"></script>
    </body>
</html>