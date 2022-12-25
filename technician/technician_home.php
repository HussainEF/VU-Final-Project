<?php
    session_start();
    if(isset($_SESSION['uid'])){
        include("../dbconnection.php");
        // Check connection
        if (mysqli_connect_errno()){
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
        //Fetching Requests Details...
        $request_query="SELECT `status` FROM `service_request` WHERE `technician_id`='$_SESSION[uid]'";
        $request_query_result=mysqli_query($con, $request_query);
        $t_requests=0;
        $r_accepted=0;
        $r_rejected=0;
        while($request_data=mysqli_fetch_array($request_query_result)){
            if($request_data['status']==="Accepted")
                $r_accepted++;
            else
              $r_rejected++;
            $t_requests++;
        }
        //Fetching Orders Details...
        $order_query="SELECT `status` FROM `orders` WHERE `technician_id`='$_SESSION[uid]'";
        $order_query_result=mysqli_query($con, $order_query);
        $t_orders=0;
        $order_completed=0;
        $order_pending=0;
        while($order_data=mysqli_fetch_array($order_query_result)){
            if($order_data['status']==="Completed")
                $order_completed++;
            else
              $order_pending++;
            $t_orders++;
        }
        //getting overall ratings...       
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
                        <h3 class="mt-2 mb-2 d-flex justify-content-center">Technician Dashboard</h3>
                    </div>
                    <div class="row">
                        <div class="col-4 border p-3 d-flex align-items-center justify-content-center">
                            <div class="border rounded bg-primary text-white p-2">
                                <h3 class="d-flex justify-content-center"><?php echo $t_requests; ?></h3>
                                <h3>Services Requests</h3>
                            </div>
                        </div>
                        <div class="col-4 border p-2 d-flex align-items-center justify-content-center">
                            <div class="border rounded bg-success text-white p-2">
                                <h3 class="d-flex justify-content-center"><?php echo $r_accepted; ?></h3>
                                <h3>Requests Accepted</h3>
                            </div>                           
                        </div>
                        <div class="col-4 border p-3 d-flex align-items-center justify-content-center">
                            <div class="border rounded bg-danger text-white p-2">
                                <h3 class="d-flex justify-content-center"><?php echo $r_rejected; ?></h3>
                                <h3>Request Rejected</h3>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4 border p-3 d-flex align-items-center justify-content-center">
                            <div class="border rounded bg-primary text-white p-2">
                                <h3 class="d-flex justify-content-center"><?php echo $t_orders; ?></h3>
                                <h3>Order Placed</h3>
                            </div>
                        </div>
                        <div class="col-4 border p-3 d-flex align-items-center justify-content-center">
                            <div class="border rounded bg-success text-white p-2">
                                <h3 class="d-flex justify-content-center"><?php echo $order_completed; ?></h3>
                                <h3>Order Completed</h3>
                            </div>                           
                        </div>
                        <div class="col-4 border p-3 d-flex align-items-center justify-content-center">
                            <div class="border rounded bg-danger text-white p-2">
                                <h3 class="d-flex justify-content-center"><?php echo $order_pending; ?></h3>
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