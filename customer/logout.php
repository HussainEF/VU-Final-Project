<?php   
    session_start(); //to ensure you are using same session
    session_destroy(); //destroy the session
    echo "<script>alert('You are logout successfully')</script>";
    echo "<script>window.location.href='login_customer.php'</script>"; //to redirect back to "admin_login.php" after logging out
    exit();
?>