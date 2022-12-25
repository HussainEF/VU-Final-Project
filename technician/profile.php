<?php
    session_start();
    if(isset($_SESSION['uid'])){
        include("../dbconnection.php");
        // Check connection
        if (mysqli_connect_errno()){
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
        else{
            //Fetch Technician Detials from Database
            $technician_query="SELECT * FROM `register_technician` WHERE `id`='$_SESSION[uid]'";
            $run_technician_query=mysqli_query($con, $technician_query);
            $technician_detail=mysqli_fetch_array($run_technician_query);

            //update technician Information
            if(isset($_POST['btnupdate'])){
                $name=$_POST['name'];
                $email=$_POST['email'];
                $contact=$_POST['contact'];
                $address=$_POST['address'];
                $city=$_POST['city'];
                $gender=$_POST['gender'];
                $update_info_query="UPDATE `register_technician`SET `name`='$name', `email`='$email', `contact`='$contact', `city`='$city', `address`='$address', `gender`='$gender' WHERE `id`='$_SESSION[uid]'";
                $run_update_info_query=mysqli_query($con, $update_info_query);
                if($run_update_info_query){
                    echo "<script>alert('Your Personal Information Updated Successfully')</script>";
                    echo "<script>window.location.href= 'profile.php'</script>";
                }
                else{
                    echo "<script>alert('Error Occured')</script>";
                    echo "<script>window.location.href= 'profile.php'</script>";
                }
            }

            //update password
            if(isset($_POST['btnpassword'])){
                $c_password=$_POST['currentpassword'];
                $new_password=$_POST['newpassword'];
                $prev_password_query="SELECT `password` FROM `register_technician` WHERE `id`='$_SESSION[uid]'";
                $result_prev_password=mysqli_query($con, $prev_password_query);
                $prev_password=mysqli_fetch_array($result_prev_password);
                if($prev_password['password']===$c_password){
                    //update password
                    $update_password_query="UPDATE `register_technician` SET `password`='$new_password' WHERE `id`='$_SESSION[uid]'";
                    $run_update_password_query=mysqli_query($con, $update_password_query);
                    if($run_update_password_query){
                        echo "<script>alert('Password Updated Successfully. Please Login Again')</script>";
                        echo "<script>window.location.href= 'login_technician.php'</script>";
                    }
                    else{
                        echo "<script>alert('Error Occured')</script>";
                        echo "<script>window.location.href= 'profile.php'</script>";
                    }
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
                <?php include("sidebar.php"); ?>
                <div class="col-9 bg-transparent">
                    <div class="row">
                        <div class="col-6 d-flex justify-content-end">
                            <div class="border border-secondary rounded rounded-circle p-4">
                                <img src="../user.png" alt="profile" />
                            </div>
                        </div>
                        <div class="col-6 d-flex justify-content-start align-items-center">
                            <form action="" class="d-flex flex-column">
                                <input type="file" id="img" name="img" accept="image/*" class="w-50 mb-2">
                                <input type="submit" class="w-50" value="Upload Photo">
                            </form>
                        </div>
                    </div>
                    <div class="row p-2">
                        <div class="col-12">
                            <form action="" method="post" class="row bg-light rounded ps-5 pe-5 pt-3 pb-3">
                                <div class="col-4 d-flex flex-column ps-5">
                                    <label class="pt-2 mb-3 border border-dark" for="inputName">Name:-</label>
                                    <label class="pb-1 mb-2 border border-dark" for="inputContact">Contact:-</label>
                                    <label class="pt-1 pb-1 mb-2 border border-dark" for="inputEmail">Email:-</label>
                                    <label class="pt-2 mb-2 border border-dark" for="inputAddress">Address:-</label>
                                    <label class="pt-2 mb-2 border border-dark" for="inputCity">City:-</label>
                                    <label class="pt-1 pb-1 mb-2 border border-dark">Gender:-</label>
                                </div>
                                <div class="col-8 d-flex flex-column pe-5">
                                    <input class="p-1 rounded mb-2 w-75" type="text" id="inputName" name="name" value="<?php echo $technician_detail['name']; ?>">
                                    <input class="p-1 rounded mb-2 w-75" type="text" id="inputContact" name="contact" value="<?php echo $technician_detail['contact']; ?>">
                                    <input class="p-1 rounded mb-2 w-75" type="text" id="inputEmail" name="email" value="<?php echo $technician_detail['email']; ?>">
                                    <input class="p-1 rounded mb-2 w-75" type="text" id="inputAddress" name="address" value="<?php echo $technician_detail['address']; ?>">
                                    <input class="p-1 rounded mb-2 w-75" type="text" id="inputCity" name="city" value="<?php echo $technician_detail['city']; ?>">
                                    <span class="w-75">
                                        <span>
                                            <input type="radio" id="male" name="gender" value="Male" <?php echo ($technician_detail['gender']=='Male')?"checked":""; ?>>
                                            <label for="male">Male</label>
                                        </span>
                                        <span>
                                            <input type="radio" id="female" name="gender" value="Female" <?php echo ($technician_detail['gender']=='Female')?"checked":""; ?>>
                                            <label for="female">Female</label>
                                        </span>
                                        <span>
                                            <input type="radio" id="other" name="gender" value="Other" <?php echo ($technician_detail['gender']=='Other')?"checked":""; ?>>
                                            <label for="other">Others</label>
                                        </span>
                                    </span>
                                    <span class="d-flex justify-content-center w-75 mt-3">
                                        <button class="btn btn-primary me-2" name="btnupdate">Update Info</button>
                                        <button class="btn btn-secondary" name="btnreset">Reset</button>
                                    </span>
                                </div>
                            </form>
                            <form action="" method="post" class="row bg-light rounded mt-4 ps-5 pe-5 pt-3 pb-3">
                                <div class="col-4 d-flex flex-column ps-5">
                                    <label class="pt-2 mb-2 border border-dark" for="inputCurrentPassword">Current Password:-</label>
                                    <label class="pt-2 mb-2 border border-dark" for="inputNewPassword">New Password:-</label>
                                    <label class="pt-2 mb-2 border border-dark" for="inputConfirmPassword">Confirm Password:-</label>
                                </div>
                                <div class="col-8 d-flex flex-column pe-5">
                                    <input class="p-1 rounded mb-2 w-75" type="password" id="inputCurrentPassword" name="currentpassword" value="">
                                    <input class="p-1 rounded mb-2 w-75" type="password" id="inputNewPassword" name="newpassword" value="">
                                    <input class="p-1 rounded mb-2 w-75" type="password" id="inputConfirmPassword" name="confirmpassword" value="">
                                    <div class="d-flex justify-content-center w-75 pt-4">
                                        <button class="btn btn-primary" name="btnpassword">Update Password</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!------------ Scripts Files -------------->
        <script src="../scripts/js/bootstrap.bundle.min.js"></script>
    </body>
</html>