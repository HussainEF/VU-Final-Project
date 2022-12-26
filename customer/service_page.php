<?php
    session_start();
    if(isset($_SESSION['uid'])){
        include("../dbconnection.php");
        // Check connection
        if (mysqli_connect_errno()){
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
        else{
            //getting details of specified service Offered by Technician
            $g_id=$_REQUEST['gig'];
            $gig_query="SELECT * FROM `services_offered` WHERE `id`='$g_id'";
            $gig_query_results=mysqli_query($con, $gig_query);
            $gig_info=mysqli_fetch_array($gig_query_results);
            //getting technician details
            $t_id=$gig_info['technician_id'];
            $technician_query="SELECT * FROM `register_technician` WHERE `id`='$t_id'";
            $technician_query_results=mysqli_query($con, $technician_query);
            $technician_info=mysqli_fetch_array($technician_query_results);
            //sending request
            if(isset($_POST['request'])){
                $message=$_POST['message'];
                $request_query="INSERT into `service_request` (`technician_id`, `customer_id`, `service_id`, `message`, `status`) VALUES ('$t_id', '$_SESSION[uid]', '$g_id', '$message', 'Pending')";
                $run_query=mysqli_query($con, $request_query);
                if($run_query){
                    echo "<script>alert('Your Request Submitted Successfully')</script>";
                }
                else{
                    echo "<script>alert('Failed Due to an Error')</script>";
                }
            }
            //Threads Check and Creation...
            if(isset($_POST['messege'])){
                $thread_check_query="SELECT * FROM `threads` WHERE `technician_id`='$t_id' AND `customer_id`='$_SESSION[uid]'";
                $run_check=mysqli_query($con, $thread_check_query);
                if((mysqli_num_rows($run_check)==0)){
                    //Creation of threads Chat...
                    $threads_query="INSERT INTO `threads` (`technician_id`, `customer_id`, `timestamp`) VALUES ('$t_id', '$_SESSION[uid]', CURRENT_TIMESTAMP())";
                    $run_threads_query=mysqli_query($con, $threads_query);
                    if($run_threads_query){
                        echo "<script>alert('Thread Created Successfully')</script>";
                        echo "<script>window.location.href='messeges.php'</script>";
                    }
                    else{
                        echo "<script>alert('Failed Due to an Error')</script>";
                    }
                }
                else{
                    echo "<script>window.location.href='messeges.php'</script>";
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
        <link rel="stylesheet" href="../custom_style.css">
        <link rel="stylesheet" href="../fontawesome/css/font-awesome.min.css">
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
                    <div class="row border border-3 border-light pt-2 pb-2">
                        <div class="col-8">
                            <div class="row card m-1">
                                <div class="col-12">
                                    <img src="../profile.png" class="align-self-center" atl="Pics"/>
                                    <div class="card-body">
                                        <h4 class="border border-light rounded p-2"><?php echo $gig_info['description']; ?></h4>
                                        <h5 class="border border-light rounded p-2">Details:-<?php echo $gig_info['details']; ?></h5>
                                        <h6 class="border border-light rounded p-2">Ratings:- <?php echo $gig_info['rating']; ?></h6>
                                        <div class="bg-secondary rounded d-flex justify-content-between p-2 mb-2">
                                            <h4 class="d-inline bg-secondary pt-1">Charges:-<?php echo $gig_info['charges']; ?></h4>
                                            <form action="" method="post">
                                                <button class='btn btn-primary d-inline' name="messege" onclick="">Messege</button>
                                            </form>
                                            <!-- Request Service Button trigger modal -->
                                            <a class='btn btn-primary d-inline' data-bs-toggle='modal' data-bs-target="#requestForm">
                                                Service Request
                                            </a>
                                            <!-- Request Service  Modal -->
                                            <div class='modal fade' id="requestForm" aria-hidden='true'>
                                                <div class='modal-dialog'>
                                                    <div class='modal-content'>
                                                        <div class='modal-header'>
                                                            <h1 class='modal-title fs-5'>Your Messege For Technician</h1>
                                                            <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                                        </div>
                                                        <form method='post'>
                                                            <div class='modal-body'>
                                                                <textarea type='text' class='form-control mb-2' id='inputMessage' name='message'>Enter Your Messege Here...</textarea>
                                                            </div>
                                                            <div class='modal-footer'>
                                                                <button class='btn btn-primary' name='request'>Send Service Request</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="border border-lite rounded">
                                        <h4 class="d-flex justify-content-center">Reviews</h4>
                                        <?php
                                            //getting reviews details
                                            $fb_query="SELECT `messege`, `rating`, `reply`, `timestamp`,
                                                        (SELECT `name` FROM `register_customer` WHERE `id`=`customer_id`) as 'c_name' 
                                                        FROM `feedback` WHERE `service_id`='$g_id' ";
                                            $fb_query_result=mysqli_query($con, $fb_query);; 
                                            while($fb_data=mysqli_fetch_array($fb_query_result)){
                                        ?>
                                            <div class="row container-fluid p-2">
                                                <div class="col-12">
                                                    <!-- Customer Messege Side -->
                                                    <div class="d-flex flex-column align-items-start p-2">
                                                        <div class="text-bg-secondary rounded d-flex justify-content-center p-1" style="max-width: 9rem;">
                                                            <?php echo $fb_data['c_name']; ?>
                                                        </div>
                                                        <div class="border border-lite rounded text-bg-lite p-2" style="max-width: 13rem;">
                                                            <div><?php echo $fb_data['messege']; ?></div>
                                                            <span class="">
                                                                <h6 class="d-inline">Rating:-</h6>
                                                                <label for="rating-5"><i class="fa fa-star"></i></label>
                                                                <label for="rating-4"><i class="fa fa-star"></i></label>
                                                                <label for="rating-3"><i class="fa fa-star"></i></label>
                                                                <label for="rating-2"><i class="fa fa-star"></i></label>
                                                                <label for="rating-1"><i class="fa fa-star"></i></label>
                                                            </span>
                                                        </div>
                                                        <div class="d-flex justify-content-center" style="max-width: 10rem;">
                                                            <?php echo $fb_data['timestamp']; ?>
                                                        </div>
                                                    </div>
                                                    <!-- Technician Reply Side -->
                                                    <div class="d-flex flex-column align-items-end p-2">
                                                        <div class="text-bg-secondary rounded d-flex justify-content-center p-1" style="max-width: 9rem;">
                                                            Technician
                                                        </div>
                                                        <div class="border border-lite rounded text-bg-lite p-2" style="max-width: 13rem;">
                                                            <div><?php echo $fb_data['reply']; ?></div>
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
                        </div>
                        <div class="col-4">
                            <div class="card m-1">
                                <img src="../profile.png" class="align-self-center" atl="Pics"/>
                                <div class="card-body">
                                    <h6><?php echo $technician_info['name']; ?></h6>
                                    <h6><?php echo $technician_info['email']; ?></h6>
                                    <h6><?php echo $technician_info['contact']; ?></h6>
                                    <h6><?php echo $technician_info['time_stamp']; ?></h6>
                                    <h6><?php echo $technician_info['city']; ?></h6>
                                    <h6>Overall Rating</h4>
                                </div>
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