<?php
    session_start();
    if(isset($_SESSION['uid'])){
        include("../dbconnection.php");
        // Check connection
        if (mysqli_connect_errno()){
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
        else{
            if(isset($_REQUEST['accept'])){
                //update request status
                $r_id=$_REQUEST['accept'];
                $c_id=$_REQUEST['c_id'];
                $s_id=$_REQUEST['s_id'];
                $update_query="UPDATE `service_request` SET `status`='Accepted' WHERE `id`='$r_id'";
                $update_status=mysqli_query($con, $update_query);
                //storing order info in the table
                $order_query="INSERT into `orders` (`customer_id`, `technician_id`, `service_id`, `request_id`, `status`, `timestamp`) 
                              VALUES ('$c_id', '$_SESSION[uid]', '$s_id', '$r_id', 'Under-Process', CURRENT_TIMESTAMP())";
                $save_order=mysqli_query($con, $order_query);
                if($update_status && $save_order){
                    echo "<script>alert('Customer Request Accepted Successfully And Order Placed')</script>";
                    echo "<script>window.location.href= 'repairing_requests.php'</script>";
                }
                else{
                    echo "<script>alert('Failed Due to an Error')</script>";
                }
            }
            if(isset($_REQUEST['reject'])){
                //update request status
                $r_id=$_REQUEST['reject'];
                $update_query="UPDATE `service_request` SET `status`='Rejected' WHERE `id`='$r_id'";
                $update_status=mysqli_query($con, $update_query);
                if($update_status){
                    echo "<script>alert('Customer Request Rejected')</script>";
                    echo "<script>window.location.href= 'repairing_request.php'</script>";
                }
                else{
                    echo "<script>alert('Failed Due to an Error')</script>";
                }
            }
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
                        <h4 class="mt-2 mb-2 d-flex justify-content-center">Repairing Requests</h3>
                    </div>
                    <div class="row p-2">
                        <div class="col-12">
                            <?php
                                $request_query="SELECT `id`, `message`, `status`, 
                                                (SELECT `name` FROM `register_customer` WHERE `id`=`customer_id`) as `name`,
                                                (SELECT `email` FROM `register_customer` WHERE `id`=`customer_id`) as `email`,
                                                (SELECT `contact` FROM `register_customer` WHERE `id`=`customer_id`) as `contact`,
                                                (SELECT `id` FROM `register_customer` WHERE `id`=`customer_id`) as `c_id`,
                                                (SELECT `id` FROM `services_offered` WHERE `id`=`service_id`) as `s_id`
                                                FROM `service_request` WHERE `technician_id`='$_SESSION[uid]' AND `status`='Pending'";
                                $run_query=mysqli_query($con, $request_query);
                                while($get_data=mysqli_fetch_array($run_query)){                        
                            ?>
                                <div class="row border bg-light rounded m-2 p-2">
                                    <div class="col-5">
                                        <h6 class="">Customer Name:-<?php echo $get_data['name'] ?></h6>
                                        <h6>Contact#:-<?php echo $get_data['contact'] ?></h6>
                                        <h6>Email:-<?php echo $get_data['email'] ?></h6>
                                    </div>
                                    <div class="col-6">
                                        <h6 class="d-flex justify-content-center"><b>Customer Messege For You</b></h6>
                                        <p class="border border-secondary"><?php echo $get_data['message'] ?></p>
                                    </div>
                                    <div class="col-1 d-flex flex-column align-items-start justify-content-center">
                                        <button class="rounded p-1 mb-1 align-self-center"><?php echo $get_data['status'] ?></button>
                                        <a href="repairing_requests.php?accept=<?php echo $get_data['id']; ?>&c_id=<?php echo $get_data['c_id'];?>&s_id=<?php echo $get_data['s_id'];?>" class="btn btn-primary p-1 mb-1 align-self-center" name="accept">Accept</a>
                                        <a href="repairing_requests.php?reject=<?php echo $get_data['id']; ?>" class="btn btn-danger p-1 mb-1 align-self-center" name="reject">Reject</a>
                                    </div>
                                </div>
                            <?php 
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