<?php
    
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
                        <button  class="btn btn-secondary" onclick="window.open('customer/login_customer.php','_self')">For Customers</button>
                        <button  class="btn btn-primary" onclick="window.open('technician/login_technician.php','_self')">For Technicians</button>
                        <button  class="btn btn-info" onclick="window.open('admin/admin_login.php','_self')">Admin-Panel</button>
                    </div>
                </div>
            </div>        
        </nav>
        <div class="container">
            <div class="row container-fluid">
                <div class="col-8">
                    <h3 class="mt-5 mb-5">Matching the Customers with the Expert Mobile Technician</h3>
                    <div class="d-flex">
                        <span class="col-10 me-1"><input class="form-control" type="text" id="inputSearch" placeholder="Type text here"></span>
                        <span class="col-2"><button class="btn btn-primary">Search</button></span>
                    </div>
                    <div>
                        <h6 class="mt-2">Search Filters</h6>
                        <div class="d-flex">
                            <span class="me-2">
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
                            <span class="me-2">
                                <select class="form-select">
                                    <option selected>--Expected Charges--</option>
                                    <option value="1">100-500</option>
                                    <option value="2">500-1000</option>
                                    <option value="3">1000-1500</option>
                                    <option value="4">1500-2000</option>
                                    <option value="5">2000-3000</option>
                                    <option value="6">3000-4000</option>
                                    <option value="7">4000-5000</option>
                                    <option value="8">5000-10000</option>
                                </select>
                            </span>
                            <span class="me-2">
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
                            <span>
                                <select class="form-select">
                                    <option selected>--Ratings--</option>
                                    <option value="1">One Star</option>
                                    <option value="2">Two Star</option>
                                    <option value="3">Three Star</option>
                                    <option value="4">Four Star</option>
                                    <option value="5">Five Star</option>
                                </select>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <img>
                </div>
            </div>
        </div>
        <!------------ Scripts Files -------------->
        <script src="scripts/js/bootstrap.bundle.min.js"></script>
    </body>
</html>