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
                <!-- sidebar section file included here -->
                <?php include("sidebar.php"); ?>
                <div class="col-9 bg-transparent">
                    <div class="row">
                        <h3 class="mt-2 mb-2 d-flex justify-content-center">Order List</h3>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <?php
                                $request_query="SELECT `id`, `timestamp`, `status`, 
                                                (SELECT `name` FROM `register_customer` WHERE `id`=`customer_id`) as `name`,
                                                (SELECT `email` FROM `register_customer` WHERE `id`=`customer_id`) as `email`,
                                                (SELECT `contact` FROM `register_customer` WHERE `id`=`customer_id`) as `contact`,
                                                (SELECT `name` FROM `services_offered` WHERE `id`=`service_id`) as `service_name`,
                                                (SELECT `message` FROM `service_request` WHERE `id`=`request_id`) as `message`,
                                                (SELECT `charges` FROM `services_offered` WHERE `id`=`service_id`) as `charges`,
                                                (SELECT `name` FROM `register_technician` WHERE `id`=`technician_id`) as `t_name`,
                                                (SELECT `email` FROM `register_technician` WHERE `id`=`technician_id`) as `t_email`,
                                                (SELECT `contact` FROM `register_technician` WHERE `id`=`technician_id`) as `t_contact`
                                                FROM `orders`";
                                $run_query=mysqli_query($con, $request_query);
                                while($get_data=mysqli_fetch_array($run_query)){  
                            ?>
                                <div class="row border bg-light rounded mt-2 p-2 container-fluid">
                                    <div class="col-5 bg-white border-end border-lite border-3">
                                        <h6 class="d-flex justify-content-center"><b>Order Details</b></h6>
                                        <h6 class="">Order#:- <?php echo $get_data['id']; ?></h6>
                                        <h6>Service Name:- <?php echo $get_data['service_name']; ?></h6>
                                        <h6>Time/Date:- <?php echo $get_data['timestamp']; ?></h6>
                                        <h6>Charges:- <?php echo $get_data['charges']; ?></h6>
                                        <hr>
                                        <h6>Technician Name:- <?php echo $get_data['t_name']; ?></h6>
                                        <h6>Contact# <?php echo $get_data['t_contact']; ?></h6>
                                        <h6>Email:- <?php echo $get_data['t_email']; ?></h6>
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
                                        <h6 class="align-self-center"><b>Action</b></h6>
                                        <!--Modal Triggir Button -->
                                        <button class="btn btn-primary p-1 mb-1 align-self-center" 
                                                data-bs-toggle='modal' data-bs-target="#updateForm<?php echo $get_data['id'];?>">
                                            Update
                                        </button>
                                        <!--Modal for Update status of order -->
                                        <div class='modal fade' id="updateForm<?php echo $get_data['id'];?>" aria-hidden='true'>
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Update Order Status</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form action="" method="post">
                                                        <div class="modal-body">
                                                            <select name="status" class="rounded w-100 p-2 mb-2">
                                                                <option value="">--Select Order Status</option>
                                                                <option value="Under-Procees">Under-Procees</option>
                                                                <option value="Completed">Completed</option>
                                                                <option value="Other">Other</option>
                                                            </select>
                                                            <!-- for some hack-->
                                                            <input type='text' class='invisible d-none' name='id' value="<?php echo $get_data['id'];?>">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button class="btn btn-primary" name="updateorder">Save changes</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <a href="" class="btn btn-primary p-1 mb-1 align-self-center">Delete</a>
                                        <h6 class="align-self-center border-top border-lite border-3"><b>Status</b></h6>
                                        <button class="rounded p-1 mb-1 align-self-center"><?php echo $get_data['status']; ?></button>
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