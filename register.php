<?php
    include("dbconnection.php");
    if(isset($_POST['submit'])){
        $name=$_POST['fullname'];
        $email=$_POST['email'];
        $contact=$_POST['contact'];
        $address=$_POST['address'];
        $password=$_POST['password'];
        $gender=$_POST['sex'];
        $query="INSERT INTO `register_customer`(`email`, `name`, `address`, `gender`, `contact`, `password`, `time_date`, `status`) VALUES ('$email', '$name', '$address', '$gender', '$contact', '$password', CURRENT_TIMESTAMP(), true)";
        $run=mysqli_query($con,$query);
        if(isset($run)){
            echo "<script>alert('Registered as Customer Succefully')</script>";
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
            echo "<script>alert('Registered as Technician Succefully')</script>";
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
        <title>Online Mobile Phone Technician Finder and Mobile Repairing</title>
    </head>
    <body>
        <nav class="navbar navbar-expand-xs bg-light">
            <div class="container">
                <div class="row container-fluid">
                    <h5 class="col-7 align-self-center">Online Mobile Phone Technician Finder and Mobile Repairing</h5>
                    <div class="col-5 d-flex justify-content-end">
                        <button  class="btn btn-secondary" onclick="window.open('login.php','_self')">Login</button>
                        <button  class="btn btn-info">Contact Us</button>
                    </div>
                </div>
            </div>        
        </nav>
        <div class="container">
            <div class="row">
                <div class="col-6 bg-light">
                    <div class="d-flex justify-content-center mb-5">
                        <h1>For Customers</h1>
                    </div>
                    <div class="d-flex justify-content-center">
                        <form class="col-10 shadow-lg p-3 bg-body rounded" action="" method="post">
                            <div class="mb-3">
                                <input class="form-control" type="text" id="inputName" name="fullname" placeholder="Full Name">
                            </div>
                            <div class="mb-3">
                                <input class="form-control" type="email" id="inputEmail" name="email"  placeholder="Email">
                            </div>
                            <div class="mb-3">
                                <input class="form-control" type="text" id="inputContact" name="contact" placeholder="Contact">
                            </div>
                            <div class="mb-3">
                                <input class="form-control" type="text" id="inputAdress" name="address" placeholder="Address">
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
                <div class="col-6 bg-light">
                    <div class="d-flex justify-content-center mb-5">
                        <h1>For Technician</h1>
                    </div>
                    <div class="d-flex justify-content-center">
                        <form class="col-10 shadow-lg p-3 bg-body rounded" method="post">
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
                            <div class="d-flex mb-3">
                                <span class="me-2 col-8"><input class="form-control" type="text" id="inputShopAddress" name="shopaddress" placeholder="Shop Address"></span>
                                <span class="col-4">
                                    <select class="form-select" name="location">
                                        <option selected>--Location--</option>
                                        <option value="Lahore">Lahore</option>
                                        <option value="Islamabad">Islamabad</option>
                                        <option value="Krachi">Krachi</option>
                                        <option value="Peshawar">Peshawar</option>
                                        <option value="Multan">Multan</option>
                                        <option value="Faisalabad">Faisalabad</option>
                                        <option value="Bahawalpur">Bahawalpur</option>
                                        <option value="DG Khan">DG Khan</option>
                                        <option value="Gujranwala">Gujranwala</option>
                                    </select>
                                </span>
                            </div>
                            <div class="d-flex mb-3">
                                <span class="me-2 col-6">
                                    <select class="form-select" name="service">
                                        <option selected>--Service Type--</option>
                                        <option value="Screen Broken">Screen Broken</option>
                                        <option value="Touch Issues">Touch Issues</option>
                                        <option value="Signal Problems">Signal Problems</option>
                                        <option value="Charging Issues">Charging Issues</option>
                                        <option value="Camera Problems">Camera Problems</option>
                                        <option value="Software Issues">Software Issues</option>
                                    </select>
                                </span>
                                <span class="col-6">
                                    <input class="form-control" type="text" id="inputCharges" name="mincharges" placeholder="Minimum Charges">
                                </span>
                            </div>
                            <div class="mb-3">
                                <button class="form-control btn btn-secondary" name="submit">Register</button>
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