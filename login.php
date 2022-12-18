<?php
    include("dbconnection.php");
    if(isset($_POST['btnLogin'])){
        $email=$_POST['email'];
        $password=$_POST['password'];
        $query="SELECT * FROM `register_technician` WHERE  `email`='$email' AND `password`='$password'";
        $run=mysqli_query($con,$query);
        if(mysqli_num_rows($run)==1){
            $data=mysqli_fetch_assoc($run);
            $_SESSION['uid']=$data['id'];
            echo "<script>window.location.href='../technician/technician_home.php'</script>";
            exit();
        }
        else{
            echo "<script>alert('Failed due to an error')</script>";
            exit();
        }
    }
?>

<?php
    include("dbconnection.php");
    if(isset($_POST['btnLogin'])){
        $email=$_POST['email'];
        $password=$_POST['password'];
        $query="SELECT * FROM `register_customer` WHERE  `email`='$email' AND `password`='$password'";
        $run=mysqli_query($con,$query);
        if(mysqli_num_rows($run)==1){
            $data=mysqli_fetch_assoc($run);
            $_SESSION['uid']=$data['id'];
            echo "<script>window.location.href='../customer/customer_home.php'</script>";
            exit();
        }
        else{
            echo "<script>alert('Failed due to an error')</script>";
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
        <link rel="stylesheet" href="scripts/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="fonts/font-awesome.min.css">
        <title>Online Mobile Phone Technician Finder and Mobile Repairing</title>
    </head>
    <body>
        <nav class="navbar navbar-expand-xs bg-light">
            <div class="container">
                <div class="row container-fluid">
                    <h5 class="col-7 align-self-center">Online Mobile Phone Technician Finder and Mobile Repairing</h5>
                    <div class="col-5 d-flex justify-content-end">
                        <button  class="btn btn-secondary" onclick="window.open('register.php','_self')">Register</button>
                        <button  class="btn btn-info">Contact Us</button>
                    </div>
                </div>
            </div>        
        </nav>
        <div class="container">
            <div class="row">
                <div class="col-6 bg-info">
                    <div class="d-flex justify-content-center mb-5">
                        <h1>For Customers</h1>
                    </div>
                    <div class="d-flex justify-content-center">
                        <form class="col-6 shadow-lg p-3 bg-body rounded" action="" method="post">
                            <div class="mb-3">
                                <input class="form-control" type="text" name="email" id="inputEmail" placeholder="Username or Email">
                            </div>
                            <div class="mb-3">
                                <input class="form-control" type="password" name="password" id="inputPassword" placeholder="Password">
                            </div>
                            <div class="mb-3">
                                <button class="form-control btn btn-secondary" name="btnLogin">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-6 bg-light">
                    <div class="d-flex justify-content-center mb-5">
                        <h1>For Technician</h1>
                    </div>
                    <div class="d-flex justify-content-center">
                        <form class="col-6 shadow-lg p-3 bg-body rounded" action="" method="post">
                            <div class="mb-3">
                                <input class="form-control" type="text" name="email" id="inputEmail" placeholder="Username or Email">
                            </div>
                            <div class="mb-3">
                                <input class="form-control" type="password" name="password" id="inputPassword" placeholder="Password">
                            </div>
                            <div class="mb-3">
                                <button class="form-control btn btn-secondary" name="btnLogin">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!------------ Scripts Files -------------->
        <script src="scripts/js/bootstrap.bundle.min.js"></script>
    </body>
</html>