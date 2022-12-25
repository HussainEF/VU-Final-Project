<?php
    session_start();
    if(isset($_SESSION['uid'])){
        include("../dbconnection.php");
        // Check connection
        if (mysqli_connect_errno()){
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
        else{
            if(isset($_POST['reply'])){
                $fb_id=$_POST['id'];
                $message=$_POST['message'];
                $reply_query="UPDATE `feedback` SET `reply`='$message' WHERE `id`='$fb_id'";
                $run_reply_query=mysqli_query($con, $reply_query);
                if(isset($run_reply_query)){
                    echo "<script>alert('Reply on Feedback Sent Successfully')</script>";
                    echo "<script>window.location.href= 'customer_feedback.php'</script>";
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
                <!-- -->
                <?php include("sidebar.php"); ?>
                <div class="col-9 bg-transparent">
                    <div class="row">
                        <h3 class="mt-2 mb-2 d-flex justify-content-center">Customers Feedback & Ratings</h3>
                    </div>
                    <?php
                        $query="SELECT `id`, `order_id`, `messege`, `rating`, `timestamp`,
                        (SELECT `name` FROM `register_customer` WHERE `id`=`customer_id`) as `c_name`,
                        (SELECT `name` FROM `services_offered` WHERE `id`=`service_id`) as `s_name`
                        FROM `feedback` WHERE `technician_id`= '$_SESSION[uid]'";
                        $query_result=mysqli_query($con, $query);
                        while($data=mysqli_fetch_array($query_result)){ 
                    ?>
                    <div class="row border bg-light rounded mt-2 p-2 container-fluid">
                        <div class="col-5 bg-white rounded border-end border-lite border-3">
                            <h6>Order#<?php echo $data['order_id']; ?></h6>
                            <h6>Service Name:-<?php echo $data['s_name']; ?></h6>
                            <h6>Customer Name:-<?php echo $data['c_name']; ?></h6>
                        </div>
                        <div class="col-5 bg-white rounded border-end border-lite border-3">
                            <h6>Feedback Message:-<?php echo $data['messege'] ?></h6>
                            <span class="">
                                <h6 class="d-inline">Rating On this Service:-</h6>
                                <label for="rating-5"><i class="fa fa-star"></i></label>
                                <label for="rating-3"><i class="fa fa-star"></i></label>
                                <label for="rating-2"><i class="fa fa-star"></i></label>
                                <label for="rating-1"><i class="fa fa-star"></i></label>
                                <label for="rating-1"><i class="fa fa-star"></i></label>
                            </span>
                            <h6>Feedback Time:- <?php echo $data['timestamp']; ?></h6>
                        </div>
                        <div class="col-2 bg-white rounded d-flex justify-content-center">
                            <!--Modal Triggir Button -->    
                            <button class="btn btn-primary w-75 align-self-center"
                                    data-bs-toggle='modal' data-bs-target="#orderFeedback<?php echo $data['id'];?>">
                                Reply
                            </button>
                            <!--Modal for Feedback and Ratings-->
                            <div class='modal fade' id="orderFeedback<?php echo $data['id'];?>" aria-hidden='true'>
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Feedback Reply</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="" method="post">
                                            <div class="modal-body p-4">
                                                <h6>Feedback Message</h6>
                                                <textarea class="w-100 rounded mb-2" name="message"></textarea>
                                                
                                                <!-- for some hack-->
                                                <input type='text' class='invisible d-none' name='id' value="<?php echo $data['id'];?>">
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-primary" name="reply">Send Reply</button>
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