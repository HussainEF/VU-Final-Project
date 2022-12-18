<?php
    session_start();
    if(isset($_SESSION['uid'])){
        include("../dbconnection.php");
        // Check connection
        if (mysqli_connect_errno()){
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
        else{
            //add service
            if(isset($_POST['save'])){
                $id=$_POST['services'];
                $s_id=(int)$id[0];
                $t_id=$_SESSION['uid'];
                $name=$_POST['services'];
                $charges=$_POST['charges'];
                $detail=$_POST['detail'];
                $add_service_query="INSERT INTO `services_offered`(`s_id`, `technician_id`, `name`, `charges`, `details`) VALUES ('$s_id', '$t_id', '$name', '$charges', '$detail') ";
                $run=mysqli_query($con,$add_service_query);
                if($run){
                    echo "<script>alert('Repairing Services Added Successfully')</script>";
                    echo "<script>window.location.href= 'manage_services.php'</script>";
                }
                else{
                    echo "<script>alert('Error Occoured')</script>";
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
                    echo "<script>window.location.href= 'manage_services.php'</script>";
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
                    echo "<script>window.location.href= 'manage_services.php'</script>";
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
                        <h3 class="mt-2 mb-2 d-flex justify-content-center">Manage Repairing Services</h3>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-12 mt-2 mb-2 d-flex justify-content-center">
                            <!-- Offer-Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#offerServiceForm">Offer An Service</button>
                            <!-- Offer Service Modal -->
                            <div class="modal fade" id="offerServiceForm" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5">Offer An Repairing Service</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form method="post">
                                            <div class="modal-body">
                                                    <!-- Fetching Services Name from Database table and displaying in Dropdown -->
                                                    <?php
                                                        $dropdown_query="SELECT * FROM `services`";
                                                        $result=mysqli_query($con,$dropdown_query);
                                                    ?>
                                                    <div>
                                                    <select name="services" class="rounded w-100 p-2 mb-2">
                                                        <option value="">--Select An Service--</option>
                                                        <?php
                                                            while($options=mysqli_fetch_array($result)){
                                                                echo "<option value=".$options['id']."-".$options['name'].">".$options['id']."-".$options['name']."</option>";
                                                            } 
                                                        ?>
                                                    </select>
                                                    <input type="text" class="form-control mb-2" id="inputCharges" name="charges" placeholder="Charges">
                                                    <input type="text" class="form-control mb-2" id="inputDetial" name="detail" placeholder="Additional Detilas">
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
                        <h4 class="mt-2 mb-2 d-flex justify-content-center">Exsisting Offered Reparing Services</h4>
                    </div>
                    <hr>
                    <div class="row">                        
                        <!-------Displaying Exsisting Offered Services At Runtime------>
                        <?php
                            $query="SELECT * FROM `services_offered`";
                            $result=mysqli_query($con, $query);
                            while($row=mysqli_fetch_array($result)){
                        ?>
                        <div class='col-5 rounded ms-2 mt-2 me-2 shadow-lg'>
                            <div class='row'>
                                <div class='col-12 d-flex justify-content-center me-1'>
                                    <img src='../profile.png' class="rounded">
                                </div>
                                <hr>
                                <div class='col-12'>
                                    <h6 ><?php echo $row['name']; ?></h6>
                                    <h6 ><?php echo $row['charges']; ?></h6>
                                    <h6 ><?php echo $row['details']; ?></h6>
                                    <h6 >Expected Time</h6>
                                </div>
                                <hr>
                                <div class='col-12 d-flex justify-content-center'>
                                    <button class="col-3 btn btn-primary ms-2 me-1">View</button>
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
                                    <a href="manage_services.php?del=<?php echo $row['id'];?>" class="col-3 btn btn-primary ms-1 me-2" name='delete'>Delete</a>
                                </div>
                            </div>
                        </div>
                        <?php }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <!------------ Scripts Files -------------->
        <script src="../scripts/js/bootstrap.bundle.min.js"></script>
    </body>
</html>