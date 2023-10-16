<?php
session_start();
set_time_limit(0);
date_default_timezone_set('Asia/Manila');

include "db_connect.php";

$sql_lock = pg_query($db, "select * from election_title where current_timestamp between start_date and end_date limit 1;") or die ("Could not match data because ".pg_last_error());
$numlock=pg_num_rows($sql_lock);
$row_start = pg_fetch_assoc($sql_lock);

$sql_end = pg_query($db, "select * from election_title limit 1;") or die ("Could not match data because ".pg_last_error());
$numend=pg_num_rows($sql_end);
$row_end = pg_fetch_assoc($sql_end);

$sql_check = pg_query($db, "select * from election_admin where admin_user='$_SESSION[admin_user]' and admin_pass='$_SESSION[admin_pass]';") or die ("Could not match data because ".pg_last_error());
$num=pg_num_rows($sql_check);

$row = pg_fetch_assoc($sql_check);

 if ($num==0 ){ 

    session_unset();
    session_destroy();
        //echo "<script>alert('session not match');</script>";

        //header('Location: admin_login.php');
        echo "<script>window.location.replace('admin_login.php')</script>";


 }

?>

 

