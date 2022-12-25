<!-------PHP Script------>
<?php
    session_start();
    if(isset($_SESSION['admin_id'])){
        include("../dbconnection.php");
        // Check connection
        if (mysqli_connect_errno()){
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
            exit();
        }
        else{
            //approve technician request
            if(isset($_REQUEST['approve'])){
                $approve_id=$_REQUEST['approve'];
                $approve_query="UPDATE `register_technician` SET `status`=true WHERE `id`='$approve_id'";
                $run_approve_query=mysqli_query($con, $approve_query);
                $mail_query="SELECT `email` FROM `register_technician` WHERE `id`='$approve_id'";
                $mail_result=mysqli_query($con, $mail_query);
                if(mysqli_num_rows($mail_result)>0){
                    $row=mysqli_fetch_array($mail_result);
                    compose_mail($row['email']);
                    echo "<script>alert('Technician Registeration Request Approved')</script>";
                    echo "<script>window.location.href='registeration_requests.php'</script>";
                    exit();
                }
                else{
                    echo "<script>alert('Failed due to an error')</script>";
                    exit();
                }
            }

            //disapprove technician request
            if(isset($_REQUEST['disapprove'])){
                $disapprove_id=$_REQUEST['disapprove'];
                $disapprove_query="UPDATE `register_technician` SET `status`=false WHERE `id`='$disapprove_id'";
                $run_disapprove_query=mysqli_query($con,$disapprove_query);
                if(isset($run_disapprove_query)){
                    echo "<script>alert('Technician Registeration Request Disapproved')</script>";
                    echo "<script>window.location.href='registeration_requests.php'</script>";
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
        echo "<script>window.location.href= 'admin_login.php'</script>";
        exit();
    }
    function compose_mail($email){
        $toemail = $email;
        $subject = "Registeration Request";
        $body = "Hi, This is informed to you that your registeration request has been accepted. You can access to your profile"; 
        $headers = "From: admin@services.com";
        if (mail($toemail, $subject, $body, $headers)) {
            echo "Email successfully sent to $toemail...";
        } 
        else {
            echo "Email sending failed...";
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
                        <h3 class="mt-2 mb-2 d-flex justify-content-center">Technicians Registeration Requests</h3>
                    </div>
                    <hr>
                    <div class="row p-2">
                        <div class="col-12">
                            <!-------PHP Script------>
                            <?php
                                $query="SELECT * FROM register_technician";
                                $result=mysqli_query($con, $query);
                                while($row=mysqli_fetch_array($result)){ 
                                    if($row['status']==false){
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
                                            </div>
                                            <div class='col-3 p-2 d-flex flex-column justify-content-center border border-2 border-success rounded'>
                                                <button class="col-12 btn btn-primary mb-2">View</button>
                                                <a href="registeration_requests.php?approve=<?php echo $row['id'] ?>>" class="col-12 btn btn-primary">Approve</a>
                                                <a href="registeration_requests.php?disapprove=<?php echo $row['id'] ?>" class="col-12 btn btn-primary mt-2 mb-2">Disapprove</a>
                                            </div>
                                        </div>      
                            <?php 
                                    }
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