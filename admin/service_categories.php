<!-------PHP Script------>
<?php
    session_start();
    if(isset($_SESSION['admin_id'])){
        include("../dbconnection.php");
        // Check connection
        if (mysqli_connect_errno()){
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
        //add service
        if(isset($_POST['save'])){
            $sname=$_POST['service'];
            $detail=$_POST['detail'];
            $add_service_query= " INSERT INTO `services` (`name`, `detail`) VALUES ('$sname', '$detail')";
            $run_service_query=mysqli_query($con, $add_service_query);
            if(isset($run_service_query)){
                echo "<script>alert('Service Added Successfully')</script>";
                echo "<script>window.location.href='service_categories.php'</script>";
                exit();
            }
            else{
                echo "<script>alert('Failed due to an error')</script>";
                exit();
            }
        }
        //update service
        if(isset($_POST['update'])){
            $updated_id=$_POST['id'];
            $updated_name=$_POST['service'];
            $updated_detail=$_POST['detail'];
            $updated_service_query="UPDATE `services` SET `name`='$updated_name',`detail`='$updated_detail' WHERE `id`='$updated_id'";
            $run_updated_service_query=mysqli_query($con, $updated_service_query);
            if(isset($run_updated_service_query)){
                echo "<script>alert('Service Updated Successfully')</script>";
                echo "<script>window.location.href='service_categories.php'</script>";
                exit();
            }
            else{
                echo "<script>alert('Failed due to an error')</script>";
                exit();
            }
        }

        //Delete service
        if(isset($_REQUEST['del'])){
            $del_id=$_REQUEST['del'];
            $delete_service_query="DELETE FROM `services` WHERE id='$del_id'";
            $run_delete_service_query=mysqli_query($con, $delete_service_query);
            if(isset($run_delete_service_query)){
                echo "<script>alert('Service Deleted Successfully')</script>";
                echo "<script>window.location.href='service_categories.php'</script>";
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
                        <div class="col-12 mt-2 mb-2 d-flex justify-content-center">
                            <!-- Add-Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addServiceForm">Add New Service</button>
                            <!-- Add Service Modal -->
                            <div class="modal fade" id="addServiceForm" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5">Add Sercice</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form method="post">
                                            <div class="modal-body">
                                                    <input type="text" class="form-control mb-2" id="inputSerice" name="service" placeholder="Service Name">
                                                    <textarea type="text" class="form-control mb-2" id="inputDetail" name="detail" placeholder="Enter Service Detail Here..."></textarea>
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-primary" name="save">Save</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <h3 class="mt-2 mb-2 d-flex justify-content-center">Manage Exsisting Services</h3>
                    </div>
                    <!-------PHP Script------>
                  <?php
                        $query="SELECT * FROM services";
                        $result=mysqli_query($con, $query);
                        while($row=mysqli_fetch_array($result)){ 
                    ?>
                            <div class='col-5 container-fluid d-inline-flex rounded mt-2 me-2 shadow-lg'>
                                <div class='row container-fluid'>
                                    <div class='col-12'>
                                        <h6>Service ID:-<?php echo $row['id']; ?></h6>
                                        <h6>Service Name:-<?php echo $row['name']; ?></h6>
                                        <h6>Description:-<?php echo $row['detail']; ?></h6>
                                    </div>
                                    <div class='col-12'>
                                        <!-- Update-Button trigger modal -->
                                        <a class='btn btn-primary' data-bs-toggle='modal' data-bs-target="#updateForm<?php echo $row['id'];?>">
                                            Update
                                        </a>
                                        <!-- Update Service Modal -->
                                        <div class='modal fade' id="updateForm<?php echo $row['id'];?>" aria-hidden='true'>
                                            <div class='modal-dialog'>
                                                <div class='modal-content'>
                                                    <div class='modal-header'>
                                                        <h1 class='modal-title fs-5'>Update Service</h1>
                                                        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                                    </div>
                                                    <form method='post'>
                                                        <div class='modal-body'>
                                                            <input type='text' class='form-control mb-2' id='inputId' name='id' placeholder='Service ID' value="<?php echo $row['id'];?>">
                                                            <input type='text' class='form-control mb-2' id='inputService' name='service' placeholder='Service Name' value="<?php echo $row['name'];?>">
                                                            <textarea type='text' class='form-control mb-2' id='inputDetail' name='detail' placeholder='Enter Service Detail Here...'><?php echo $row['detail'];?></textarea>
                                                        </div>
                                                        <div class='modal-footer'>
                                                            <button class='btn btn-primary' name='update'>Update</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <a href="service_categories.php?del=<?php echo $row['id'];?>" class='btn btn-primary' name='delete'>
                                            Delete
                                        </a>
                                    </div>
                                </div>
                            </div>       
                  <?php }
                    ?>
                </div>
            </div>
        </div>
        <!------------ Scripts Files -------------->
        <script src="../scripts/js/bootstrap.bundle.min.js"></script>
    </body>
</html>