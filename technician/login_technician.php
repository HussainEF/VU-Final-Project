<!----------------For Login-------------->
<?php
    include("../dbconnection.php");
    if(isset($_POST['btnLogin'])){
        $email=$_POST['email'];
        $password=$_POST['password'];
        $query="SELECT * FROM `register_technician` WHERE  `email`='$email' AND `password`='$password'";
        $run=mysqli_query($con,$query);
        if(mysqli_num_rows($run)==1){
            $data=mysqli_fetch_assoc($run);
            if($data['status']==true){
                session_start();
                $_SESSION['uid']=$data['id'];
                $_SESSION['username']=$data['name'];
                //login time updation
                $timestamp_query="UPDATE `register_technician` SET `time_stamp`=CURRENT_TIMESTAMP() WHERE `id`='$data[id]'";
                mysqli_query($con,$timestamp_query);
                //Checking that Is technician logging in first time?....
                if($data['time_stamp']==NULL){
                    echo "<script>window.location.href='manage_services.php'</script>";
                }
                else{
                    echo "<script>window.location.href='technician_home.php'</script>";
                }
            }
            else{
                echo "<script>window.location.href='request_pending.php'</script>";
            }
        }
        else{
            echo "<script>alert('Failed due to an error')</script>";
            echo "<script>window.location.href='login_technician.php'</script>";
            exit();
        }
    }
?>

<!----------------For Registeration-------------->
<?php
    include("../dbconnection.php");
    if(isset($_POST['submit'])){
        $name=$_POST['fullname'];
        $email=$_POST['email'];
        $contact=$_POST['contact'];
        $address=$_POST['address'];
        $password=$_POST['password'];
        $gender=$_POST['sex'];
        $query="INSERT INTO `register_technician`(`email`, `name`, `gender`, `address`, `password`, `contact`) VALUES ('$email', '$name', '$gender', '$address', '$password', '$contact')";
        $run=mysqli_query($con,$query);
        if(isset($run)){
            echo "<script>window.location.href='request_pending.php'</script>";
            echo "<script>alert('Registeration Request Submitted Successfully')</script>";
            exit();
        }
        else{
            echo "<script>alert('Failed due to an error')</script>";
            echo "<script>window.location.href='login_technician.php'</script>";
            exit();
        }
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
                    <h5 class="col-8 align-self-center">Online Mobile Phone technician finder and Mobile Repairing</h5>
                    <div class="col-4 d-flex justify-content-end">
                        <button  class="btn btn-info">Contact Us</button>
                    </div>
                </div>
            </div>        
        </nav>
        <div class="d-flex justify-content-center mb-5">
            <h1>For Technician</h1>
        </div>
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-4 shadow-lg p-3 mb-5 bg-body rounded">
                    <nav>
                        <div class="nav nav-tabs mb-2 d-flex justify-content-center" id="nav-tab" role="tablist">
                            <button class="col-6 nav-link active" id="nav-login-tab" data-bs-toggle="tab" data-bs-target="#nav-login" type="button" role="tab" aria-controls="nav-login" aria-selected="true">Login</button>
                            <button class="col-6 nav-link" id="nav-register-tab" data-bs-toggle="tab" data-bs-target="#nav-register" type="button" role="tab" aria-controls="nav-register" aria-selected="false">Register</button>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-login" role="tabpanel" aria-labelledby="nav-login-tab" tabindex="0">
                            <form class="" action="" method="post">
                                <div class="mb-3">
                                    <input class="form-control" type="text" name="email" id="inputUsername" placeholder="Username or Email">
                                </div>
                                <div class="mb-3">
                                    <input class="form-control" type="password" name="password" id="inputPassword" placeholder="Password">
                                </div>
                                <div class="mb-3">
                                    <button class="form-control btn btn-secondary" name="btnLogin">Login</button>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="nav-register" role="tabpanel" aria-labelledby="nav-register-tab" tabindex="0">
                            <form class="" method="post" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <input class="form-control" type="text" id="inputName" name="fullname" placeholder="Full Name">
                                </div>
                                <div class="mb-3">
                                    <input class="form-control" type="email" id="inputEmail" name="email"  placeholder="Email">
                                </div>
                                <div class="mb-3">
                                    <input class="form-control" type="text" id="inputContact" name="contact" placeholder="Mobile Number">
                                </div>
                                <div class="mb-3">
                                    <input class="form-control" type="text" id="inputAdress" name="address" placeholder="Home Address">
                                </div>
                                <div class="mb-3">
                                    <input class="form-control" type="password" id="inputPassword" name="password" placeholder="Password">
                                </div>
                                <div class="row container">
                                    <label class="col form-label">Gender:-</label>
                                    <div class="col form-check">
                                        <input class="form-check-input" type="radio" value="Male" name="sex" id="radioMale">
                                        <label class="form-check-label" for="radioMale">Male</label>
                                    </div>
                                    <div class="col form-check">
                                        <input class="form-check-input" type="radio" value="Female" name="sex" id="radioFemale">
                                        <label class="form-check-label" for="radioFemale">Female</label>
                                    </div>
                                    <div class="col form-check">
                                        <input class="form-check-input" type="radio" value="Other" name="sex" id="radioOther">
                                        <label class="form-check-label" for="radioOther">Others</label>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <button class="form-control btn btn-secondary" name="submit">Register</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center mt-5 mb-5">
                        <span class="align-self-center me-2"><h5>Don't have an account?</h5></span><br><br>
                        <span><button class="btn btn-primary">Register</button></span>
                    </div>
                </div>
            </div>
        </div>
        <!------------ Scripts Files -------------->
        <script src="../scripts/js/bootstrap.bundle.min.js"></script>
    </body>
</html>