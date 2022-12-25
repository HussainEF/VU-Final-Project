<?php
    session_start();
    if(isset($_SESSION['admin_id'])){
        include("../dbconnection.php");
        // Check connection
        if (mysqli_connect_errno()){
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
        else{
            //Fetching Customers and Technicians Details...
            $customer_query="SELECT * FROM `register_customer`";
            $run_customer_query=mysqli_query($con,$customer_query);
            $total_customers=mysqli_num_rows($run_customer_query);
            $technician_query="SELECT * FROM `register_technician`";
            $run_technician_query=mysqli_query($con,$technician_query);
            $registered_technician=0;
            $reg_requeset=0;
            while($row=mysqli_fetch_array($run_technician_query)){
                if($row['status']==false){
                    $reg_requeset=$reg_requeset+1;
                }
                else{
                    $registered_technician++;
                }
            }
            //Fetching Orders Details...
            $order_query="SELECT `status` FROM `orders`";
            $order_query_result=mysqli_query($con, $order_query);
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

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" type="text/css" href="../styles/style.css">
        <link rel="stylesheet" href="../scripts/css/bootstrap.min.css">
        <title>Online Mobile Phone Technician Finder and Mobile Repairing</title>
    </head>
    <body>
        <nav class="navbar navbar-expand-xs bg-light">
            <div class="container">
                <div class="row container-fluid">
                    <h5 class="col-7 align-self-center">Online Mobile Phone Technician Finder and Mobile Repairing</h5>
                    <div class="col-5 d-flex justify-content-end">
                        <button class="btn btn-secondary" onclick="window.open('')">Notifications</button>
                        <button class="btn btn-primary" onclick="">Settings</button>
                        <button class="btn btn-info" onclick="window.open('logout.php', '_self')">Logout</button>
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
                        <h3 class="mt-2 mb-2 d-flex justify-content-center">Admin Dashboard</h3>
                    </div>
                    <div class="row">
                        <div class="col-6 border p-5 d-flex align-items-center justify-content-center">
                            <div class="border rounded bg-success text-white p-2">
                                <h3 class="d-flex justify-content-center"><?php echo $total_customers; ?></h3>
                                <h3>Registered Customers</h3>
                            </div>
                        </div>
                        <div class="col-6 border p-5 d-flex align-items-center justify-content-center">
                            <div class="border rounded bg-success text-white p-2">
                                <h3 class="d-flex justify-content-center"><?php echo $registered_technician; ?></h3>
                                <h3>Registered Technicians</h3>
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
                        <div class="col-12 border p-3 d-flex align-items-center justify-content-center">
                            <div class="border rounded bg-danger text-white p-2">
                                <h3 class="d-flex justify-content-center"><?php echo $reg_requeset ?></h3>
                                <h3>Pending Registeration Requests</h3>
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