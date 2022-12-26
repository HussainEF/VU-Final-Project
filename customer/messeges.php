<?php
    session_start();
    if(isset($_SESSION['uid'])){
        include("../dbconnection.php");
        // Check connection
        if (mysqli_connect_errno()){
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
        else{
            if(isset($_POST['send'])){
                $text=$_POST['text'];
                $thread_id=$_POST['thread_id'];
                $send_query="INSERT INTO `messages` (`thread_id`, `text`, `sender_type`, `timestamp`) 
                                           VALUES ('$thread_id', '$text', 'Customer', CURRENT_TIMESTAMP())";
                $run_send_query=mysqli_query($con, $send_query);
                if($run_send_query){
                    echo "<script>alert('Messege Sent Sucessfully')</script>";
                }
                else{
                    echo "<script>alert('Fialed due to error')</script>";
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
                        <button  class="btn btn-info" onclick="window.open('logout.php','_self')">Logout</button>
                    </div>
                </div>
            </div>        
        </nav>
        <div class="container">
            <div class="row">
                <div class="col-3">
                    <div class="col-12 btn btn-light mt-2 mb-2 d-flex justify-content-center container-fluid">
                        <button class="btn" onclick="window.open('customer_home.php','_self')">Home</button>
                    </div>
                    <div class="d-flex flex-column justify-content-center container-fluid">
                        <h4 class="text-bg-success d-flex justify-content-center p-3">Technicians</h4>
                        <?php 
                            $threads_query="SELECT *,(SELECT `name` FROM `register_technician` WHERE `id`=`technician_id`) as 'name'
                                             FROM `threads` WHERE `customer_id`='$_SESSION[uid]'";
                            $run_threads_query=mysqli_query($con, $threads_query);
                            while($threads_data=mysqli_fetch_array($run_threads_query)){
                        ?>
                            <a href="messeges.php?thread_id=<?php echo $threads_data['id'];?>&technician_name=<?php echo $threads_data['name'];?>" class="btn btn btn-light mb-2">
                                <?php echo $threads_data['name']; ?>
                            </a>
                        <?php 
                            }
                        ?>
                    </div>
                </div>
                <div class="col-9 bg-transparent">
                    <div class="row">
                        <h3 class="mt-2 mb-2 text-bg-secondary d-flex justify-content-center">Messeges Section</h3>
                    </div>
                    <?php
                        if(isset($_REQUEST['thread_id'])){
                            $thread_id=$_REQUEST['thread_id'];
                    ?>
                            <div class="row">
                                <form action="" method="post" class="d-flex justify-content-center">
                                    <input class="col-10 d-inline rounded border border-dark border-1 pt-2 pb-2" name="text" type="text">
                                    <button class="col-2 d-inline btn btn-primary" name="send">Send</button>
                                    <!-- for some hack-->
                                    <input type='text' class='invisible d-none' name='thread_id' value="<?php echo $thread_id;?>">
                                </form>
                            </div>
                    <?php
                            $t_name=$_REQUEST['technician_name'];
                            //getting messeges details
                            $messege_query="SELECT * FROM `messages` WHERE `thread_id`='$thread_id'";
                            $messege_query_result=mysqli_query($con, $messege_query);; 
                            while($messege_data=mysqli_fetch_array($messege_query_result)){
                    ?>
                                <div class="row container-fluid p-2">
                                    <div class="col-12">
                                        <div class="d-flex flex-column <?php echo ($messege_data['sender_type']=="Customer")?"align-items-end":"align-items-start";?> p-2">
                                            <div class="text-bg-secondary rounded d-flex justify-content-center p-1" style="max-width: 9rem;">
                                                <?php echo ($messege_data['sender_type']=="Customer")?"You": $t_name ; ?>
                                            </div>
                                            <div class="border border-lite rounded text-bg-lite p-2" style="max-width: 18rem;">
                                                <div><?php echo $messege_data['text']; ?></div>
                                            </div>
                                            <div class="d-flex justify-content-center" style="max-width: 10rem;">
                                                <?php echo $messege_data['timestamp']; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                    <?php
                            }
                        }   
                    ?>
                </div>
            </div>
        </div>
        <!------------ Scripts Files -------------->
        <script src="../scripts/js/bootstrap.bundle.min.js"></script>
    </body>
</html>