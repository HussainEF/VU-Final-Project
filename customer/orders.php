<?php
    session_start();
    if(isset($_SESSION['uid'])){
        include("../dbconnection.php");
        // Check connection
        if (mysqli_connect_errno()){
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
        else{
            if(isset($_POST['feedback'])){
                //query geting order table data
                $o_id=$_POST['id'];
                $order_query="SELECT * FROM `orders` WHERE `id`='$o_id'";
                $run_order_query=mysqli_query($con, $order_query);
                $order_data=mysqli_fetch_array($run_order_query);

                $rating=$_POST['rating'];
                $feedback=$_POST['fb'];
                $feedback_query="INSERT into `feedback` (`order_id`, `customer_id`, `technician_id`, `service_id`, `messege`, `rating`, `timestamp`) 
                                        VALUES('$o_id', '$order_data[customer_id]', '$order_data[technician_id]', '$order_data[service_id]', '$feedback', '$rating', CURRENT_TIMESTAMP())";
                $run_feedback_query=mysqli_query($con, $feedback_query);
                if(isset($run_feedback_query)){
                    echo "<script>alert('Thanks For Your Feedback')</script>";
                    echo "<script>window.location.href= 'orders.php'</script>";
                    exit();
                }
                else{
                    echo "<script>alert('Failed due to an error')</script>";
                    exit();
                }
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

        <!-- Bootstrap, Fontaweosme, Customized CSS -->
        <link rel="stylesheet" href="../fontawesome/css/font-awesome.min.css">
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
                        <h3 class="mt-2 mb-2 d-flex justify-content-center">Order List</h3>
                    </div>
                    <?php
                        $request_query="SELECT `id`, `timestamp`, `status`, 
                                        (SELECT `name` FROM `register_customer` WHERE `id`=`customer_id`) as `name`,
                                        (SELECT `email` FROM `register_customer` WHERE `id`=`customer_id`) as `email`,
                                        (SELECT `contact` FROM `register_customer` WHERE `id`=`customer_id`) as `contact`,
                                        (SELECT `name` FROM `services_offered` WHERE `id`=`service_id`) as `service_name`,
                                        (SELECT `message` FROM `service_request` WHERE `id`=`request_id`) as `message`,
                                        (SELECT `charges` FROM `services_offered` WHERE `id`=`service_id`) as `charges`
                                        FROM `orders` WHERE `technician_id`='$_SESSION[uid]'";
                        $run_query=mysqli_query($con, $request_query);
                        while($get_data=mysqli_fetch_array($run_query)){   
                    ?>
                        <div class="row border bg-light rounded mt-2 p-2 container-fluid">
                            <div class="col-5 bg-white border-end border-lite border-3">
                                <h6 class="d-flex justify-content-center"><b>Order Details</b></h6>
                                <h6 class="">Order#:-<?php echo $get_data['id']; ?></h6>
                                <h6>Service Name:-<?php echo $get_data['service_name']; ?></h6>
                                <h6>Time/Date:-<?php echo $get_data['timestamp']; ?></h6>
                                <h6>Charges:-<?php echo $get_data['charges']; ?></h6>
                            </div>
                            <div class="col-5 bg-white border-end border-lite border-3">
                                <h6 class="d-flex justify-content-center"><b>Customer Details</b></h6>
                                <h6>Customer Name:-<?php echo $get_data['name']; ?></h6>
                                <h6>Contact#:-<?php echo $get_data['contact']; ?></h6>
                                <h6>Email:-<?php echo $get_data['email']; ?></h6>
                                <label for="message">Messege:-</label>
                                <p class="border border-1 border-secondary p-2" id="message"><?php echo $get_data['message']; ?></p>
                            </div>
                            <div class="col-2 d-flex flex-column justify-content-center bg-white">
                                <h6 class="align-self-center"><b>Status</b></h6>
                                <button class="rounded p-1 mb-1 align-self-center"><?php echo $get_data['status']; ?></button>
                                <!--Modal Triggir Button -->
                                <button class="btn btn-primary <?php echo ($get_data['status']=="Completed")?"visible":"invisible d-none";?> p-1 mb-1 align-self-center" 
                                        data-bs-toggle='modal' data-bs-target="#orderFeedback<?php echo $get_data['id'];?>">
                                    Feedback
                                </button>
                                <!--Modal for Feedback and Ratings-->
                                <div class='modal fade' id="orderFeedback<?php echo $get_data['id'];?>" aria-hidden='true'>
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Feedback</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="" method="post">
                                                <div class="modal-body p-4">
                                                    <h6>Feedback Message</h6>
                                                    <textarea class="w-100 rounded mb-2" name="fb"></textarea>
                                                    <span class="">
                                                        <h6 class="d-inline">Please rate this Service:-</h6>
                                                        <input id="rating-5" type="radio" name="rating" value="1"/>
                                                        <label for="rating-5"><i class="fa fa-2x fa-star"></i></label>

                                                        <input id="rating-4" type="radio" name="rating" value="2"/>     
                                                        <label for="rating-4"><i class="fa fa-2x fa-star"></i></label>

                                                        <input id="rating-3" type="radio" name="rating" value="3"/>
                                                        <label for="rating-3"><i class="fa fa-2x fa-star"></i></label>

                                                        <input id="rating-2" type="radio" name="rating" value="4"/>
                                                        <label for="rating-2"><i class="fa fa-2x fa-star"></i></label>

                                                        <input id="rating-1" type="radio" name="rating" value="5"/>
                                                        <label for="rating-1"><i class="fa fa-2x fa-star"></i></label>
                                                    </span>
                                                    <!-- for some hack-->
                                                    <input type='text' class='invisible d-none' name='id' value="<?php echo $get_data['id'];?>">
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-primary" name="feedback">Send Feedback</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
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