<!-------PHP Script------>
<?php
    session_start();
    if(isset($_SESSION['admin_id'])){
        include("../dbconnection.php");
        // Check connection
        if (mysqli_connect_errno()){
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
        //add Mobile Type
        if(isset($_POST['save'])){
            $sname=$_POST['mobiletype'];
            $detail=$_POST['detail'];
            $add_mobile_type_query= "INSERT INTO `mobile_types` (`name`, `detail`) VALUES ('$sname', '$detail')";
            $run_mobile_type_query=mysqli_query($con, $add_mobile_type_query);
            if(isset($run_mobile_type_query)){
                echo "<script>alert('Mobile Type Added Successfully')</script>";
                echo "<script>window.location.href='mobile_types.php'</script>";
                exit();
            }
            else{
                echo "<script>alert('Failed due to an error')</script>";
                exit();
            }
        }
        //update Mobile Type
        if(isset($_POST['update'])){
            $updated_id=$_POST['id'];
            $updated_name=$_POST['mobiletype'];
            $updated_detail=$_POST['detail'];
            $updated_mobile_type_query="UPDATE `mobile_types` SET `name`='$updated_name',`detail`='$updated_detail' WHERE `id`='$updated_id'";
            $run_updated_mobile_type_query=mysqli_query($con, $updated_mobile_type_query);
            if(isset($run_updated_mobile_type_query)){
                echo "<script>alert('Mobile Type Updated Successfully')</script>";
                echo "<script>window.location.href='mobile_types.php'</script>";
                exit();
            }
            else{
                echo "<script>alert('Failed due to an error')</script>";
                exit();
            }
        }

        //Delete Mobile Type
        if(isset($_REQUEST['del'])){
            $del_id=$_REQUEST['del'];
            $delete_mobile_type_query="DELETE FROM `mobile_types` WHERE id='$del_id'";
            $run_delete_mobile_type_query=mysqli_query($con, $delete_mobile_type_query);
            if(isset($run_delete_mobile_type_query)){
                echo "<script>alert('Mobile Type Deleted Successfully')</script>";
                echo "<script>window.location.href='mobile_types.php'</script>";
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
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addMobileTypeForm">Add Mobile Type</button>
                            <!-- Add Mobile Type Modal -->
                            <div class="modal fade" id="addMobileTypeForm" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5">Add Mobile Type</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form method="post">
                                            <div class="modal-body">
                                                    <input type="text" class="form-control mb-2" id="inputMobileType" name="mobiletype" placeholder="Mobile Type Name">
                                                    <textarea type="text" class="form-control mb-2" id="inputDetail" name="detail" placeholder="Enter Mobile Type Detail Here..."></textarea>
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
                        <h3 class="mt-2 mb-2 d-flex justify-content-center">Manage Exsisting Mobile Types</h3>
                    </div>
                    <div class="row p-2">
                        <!-------PHP Script------>
                        <?php
                            $query="SELECT * FROM mobile_types";
                            $result=mysqli_query($con, $query);
                            while($row=mysqli_fetch_array($result)){ 
                        ?>
                        <div class='col-6 bg-lite rounded border border-3 p-2'>
                            <div class='row'>
                                <div class='col-12'>
                                    <h6>Mobile Type ID:-<?php echo $row['id']; ?></h6>
                                    <h6>Mobile Type Name:-<?php echo $row['name']; ?></h6>
                                    <h6>Description:-<?php echo $row['detail']; ?></h6>
                                </div>
                                <div class='col-12 d-flex justify-content-end'>
                                    <!-- Update-Button trigger modal -->
                                    <a class='btn btn-primary me-2' data-bs-toggle='modal' data-bs-target="#updateForm<?php echo $row['id'];?>">
                                        Update
                                    </a>
                                    <!-- Update Mobile Type Modal -->
                                    <div class='modal fade' id="updateForm<?php echo $row['id'];?>" aria-hidden='true'>
                                        <div class='modal-dialog'>
                                            <div class='modal-content'>
                                                <div class='modal-header'>
                                                    <h1 class='modal-title fs-5'>Update Mobile Type</h1>
                                                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                                </div>
                                                <form method='post'>
                                                    <div class='modal-body'>
                                                        <input type='text' class='form-control mb-2' id='inputId' name='id' placeholder='Mobile Type ID' value="<?php echo $row['id'];?>">
                                                        <input type='text' class='form-control mb-2' id='inputMobileType' name='mobiletype' placeholder='Mobile Type Name' value="<?php echo $row['name'];?>">
                                                        <textarea type='text' class='form-control mb-2' id='inputDetail' name='detail' placeholder='Enter Mobile Type Detail Here...'><?php echo $row['detail'];?></textarea>
                                                    </div>
                                                    <div class='modal-footer'>
                                                        <button class='btn btn-primary' name='update'>Update</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="mobile_types.php?del=<?php echo $row['id'];?>" class='btn btn-primary' name='delete'>
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
        </div>
        <!------------ Scripts Files -------------->
        <script src="../scripts/js/bootstrap.bundle.min.js"></script>
    </body>
</html>