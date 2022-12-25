<!-------PHP Script------>
<?php
    session_start();
    if(isset($_SESSION['admin_id'])){
        include("../dbconnection.php");
        // Check connection
        if (mysqli_connect_errno()){
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
        //block and unblock an customer
        if(isset($_REQUEST['block'])||isset($_REQUEST['unblock'])){
            if(isset($_REQUEST['block'])){
                $status=$_REQUEST['block'];
                $update_status_query="UPDATE `register_customer` SET `status`=false WHERE `id`='$status'";
            }
            else if(isset($_REQUEST['unblock'])){
                $status=$_REQUEST['unblock'];
                $update_status_query="UPDATE `register_customer` SET `status`=true WHERE `id`='$status'";
            }
            $run_update_status_query=mysqli_query($con, $update_status_query);
            if(isset($run_update_status_query)){
                echo "<script>alert('Customer Status Updated Successfully')</script>";
                echo "<script>window.location.href='view_customers.php'</script>";
                exit();
            }
            else{
                echo "<script>alert('Failed due to an error')</script>";
                exit();
            }
        }

        //Delete an Customer
        if(isset($_REQUEST['del'])){
            $del_id=$_REQUEST['del'];
            $delete_customer_query="DELETE FROM `register_customer` WHERE id='$del_id'";
            $run_delete_customer_query=mysqli_query($con, $delete_customer_query);
            if(isset($run_delete_customer_query)){
                echo "<script>alert('Cutomer Deleted Successfully')</script>";
                echo "<script>window.location.href='view_customers.php'</script>";
                exit();
            }
            else{
                echo "<script>alert('Failed due to an error')</script>";
                exit();
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
                        <h3 class="mt-2 mb-2 d-flex justify-content-center">Customers Details</h3>
                    </div>
                    <hr>
                    <div class="row p-2">
                        <div class="col-12">
                            <!-------PHP Script------>
                            <?php
                                $query="SELECT * FROM register_customer";
                                $result=mysqli_query($con, $query);
                                while($row=mysqli_fetch_array($result)){ 
                            ?>
                                    <div class='row border border-2 border-secondary rounded mt-2 p-2'>
                                        <div class='col-2 p-2 d-flex justify-content-center border border-2 border-info rounded'>
                                            <img src='../profile.png'>
                                        </div>
                                        <div class='col-7 p-2 float-start border border-2 border-secondary rounded'>
                                            <h6>Name:- <?php echo $row['name']; ?></h6>
                                            <h6>Contact# <?php echo $row['contact']; ?></h6>
                                            <h6>Email:- <?php echo $row['email']; ?></h6>
                                            <h6><Address>Address:- <?php echo $row['address']; ?></Address></h6>
                                            <h6>Status:- <?php echo ($row['status']==true) ? "Active" : "Blocked"; ?></h6>
                                        </div>
                                        <div class='col-3 p-2 d-flex flex-column justify-content-center border border-2 border-success rounded'>
                                            <button class="col-12 btn btn-primary mb-2">View</button>
                                            <a href="view_customers.php?<?php echo ($row['status']==true) ? "block" : "unblock"; ?>=<?php echo $row['id'];?>" class="col-12 btn btn-primary"><?php echo ($row['status']==false) ? "Activate" : "Block"; ?></a>
                                            <a href="view_customers.php?del=<?php echo $row['id'] ?>" class="col-12 btn btn-primary mt-2 mb-2">Delete</a>
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