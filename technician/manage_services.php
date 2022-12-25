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
                //fetching service id
                $s_id=$_POST['services'];
                $service_id=(int)$s_id[0];
                //fetching mobile type id
                $m_id=$_POST['mobile_types'];
                $mobile_id=(int)$m_id[0];
                $t_id=$_SESSION['uid'];
                $name=$_POST['services'];
                $sname=substr($name,2);
                $descript=$_POST['description'];
                $charges=$_POST['charges'];
                $detail=$_POST['detail'];
                $add_service_query="INSERT INTO `services_offered`(`s_id`, `mobile_type_id`, `technician_id`, `name`, `description`, `charges`, `details`) VALUES ('$service_id', '$mobile_id',  '$t_id', '$sname', '$descript', '$charges', '$detail') ";
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
                $updated_charges=$_POST['charges'];
                $updated_dsp=$_POST['description'];
                $updated_detail=$_POST['detail'];
                $updated_service_query="UPDATE `services_offered` SET `description`='$updated_dsp', `charges`='$updated_charges',`details`='$updated_detail' WHERE `id`='$updated_id'";
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
                $delete_service_query="DELETE FROM `services_offered` WHERE id='$del_id'";
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
                                                <!-- Fetching Mobile from Database table and displaying in Dropdown -->
                                                <?php
                                                    $mobile_type="SELECT * FROM `mobile_types`";
                                                    $result_mobile_type=mysqli_query($con,$mobile_type);
                                                ?>
                                                <select name="mobile_types" class="rounded w-100 p-2 mb-2">
                                                    <option value="">--Select An Mobile Type--</option>
                                                <?php
                                                    while($mobile_type_options=mysqli_fetch_array($result_mobile_type)){
                                                ?>
                                                    <option value="<?php echo $mobile_type_options['id'] ."-" . $mobile_type_options['name'];?>"><?php echo $mobile_type_options['name']; ?></option>
                                                <?php 
                                                    } 
                                                ?>
                                                </select>
                                                <!-- Fetching Services Name from Database table and displaying in Dropdown -->
                                                <?php
                                                    $services_query="SELECT * FROM `services`";
                                                    $services_result=mysqli_query($con,$services_query);
                                                ?>
                                                <select name="services" class="rounded w-100 p-2 mb-2">
                                                    <option value="">--Select An Service--</option>
                                                <?php
                                                    while($services_options=mysqli_fetch_array($services_result)){
                                                ?>
                                                    <option value="<?php echo $services_options['id'] ."-" . $services_options['name'];?>"><?php echo $services_options['name']; ?></option>
                                                <?php 
                                                    } 
                                                ?>
                                                </select>
                                                <input type="text" class="form-control mb-2" id="inputDescription" name="description" placeholder="Short Description">
                                                <input type="text" class="form-control mb-2" id="inputCharges" name="charges" placeholder="Charges">
                                                <textarea class="form-control mb-2" id="inputDetial" name="detail">Addtional Details</textarea>
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
                        <h4 class="mt-2 mb-2 d-flex justify-content-center">Exsisting Reparing Services</h4>
                    </div>
                    <div class="row p-2">                        
                        <!-------Displaying Exsisting Offered Services At Runtime------>
                        <?php
                            $query="SELECT * FROM `services_offered` WHERE `technician_id`='$_SESSION[uid]'";
                            $result=mysqli_query($con, $query);
                            while($row=mysqli_fetch_array($result)){
                        ?>
                        <div class='col-4 rounded border border-3 border-lite p-2'>
                            <div class='row'>
                                <div class='col-12 d-flex justify-content-center'>
                                    <img src='../profile.png' class="rounded">
                                </div>
                                <hr>
                                <div class='col-12'>
                                    <h6 ><?php echo $row['name']; ?></h6>
                                    <h6 ><?php echo $row['charges']; ?></h6>
                                    <h6 ><?php echo $row['description']; ?></h6>
                                    <h6 ><?php echo $row['details']; ?></h6>
                                    <h6 >Expected Time</h6>
                                </div>
                                <hr>
                                <div class='col-12 d-flex justify-content-center align-items-center'>
                                    <button class="btn btn-primary me-2">View</button>
                                    <!-- Update-Button trigger modal -->
                                    <a class='btn btn-primary me-2' data-bs-toggle='modal' data-bs-target="#updateForm<?php echo $row['id'];?>">
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
                                                        <!-- Fetching Mobile Types from Database table and displaying in Dropdown -->
                                                        <?php
                                                            $mobile_type_dropdown="SELECT * FROM `mobile_types`";
                                                            $mobile_type_dropdown_result=mysqli_query($con,$mobile_type_dropdown);
                                                        ?>
                                                        <select name="services" class="rounded w-100 p-2 mb-2">
                                                            <?php
                                                                while($mobile_type_data=mysqli_fetch_array($mobile_type_dropdown_result)){
                                                            ?>
                                                                    <option value="<?php echo $mobile_type_data['id'] ."-" . $mobile_type_data['name'];?>">
                                                                        <?php echo $mobile_type_data['name']; ?>
                                                                    </option>
                                                            <?php 
                                                                }
                                                            ?>
                                                        </select>
                                                        <!-- Fetching Services Name from Database table and displaying in Dropdown -->
                                                        <?php
                                                            $services_dropdown="SELECT * FROM `services`";
                                                            $services_dropdown_result=mysqli_query($con,$services_dropdown);
                                                        ?>
                                                        <select name="services" class="rounded w-100 p-2 mb-2">
                                                            <?php
                                                                while($services_data=mysqli_fetch_array($services_dropdown_result)){
                                                            ?>
                                                                    <option value="<?php echo $services_data['id'] ."-" . $services_data['name'];?>">
                                                                        <?php echo $services_data['name']; ?>
                                                                    </option>
                                                            <?php 
                                                                }
                                                            ?>
                                                        </select>
                                                        <!-- for some hack-->
                                                        <input type='text' class='invisible d-none' name='id' value="<?php echo $row['id'];?>">
                                                        
                                                        <input type='text' class='form-control mb-2' id='inputDescription' name='description' placeholder='Short Description' value="<?php echo $row['description'];?>">
                                                        <input type='text' class='form-control mb-2' id='inputCharges' name='charges' placeholder='Service Charges' value="<?php echo $row['charges'];?>">
                                                        <textarea type='text' class='form-control mb-2' id='inputDetail' name='detail' placeholder='Enter Service Detail Here...'><?php echo $row['details'];?></textarea>
                                                    </div>
                                                    <div class='modal-footer'>
                                                        <button class='btn btn-primary' name='update'>Update</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="manage_services.php?del=<?php echo $row['id'];?>" class="btn btn-primary" name='delete'>Delete</a>
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