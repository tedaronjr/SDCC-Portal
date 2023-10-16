<?php
session_start();

    session_unset();
    session_destroy();


    //    header('Location: admin_login.php');
    echo "<script>window.location.replace('/SDCC-Portal/admin_login.php')</script>";



?>

 

