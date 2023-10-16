<?php
session_start();
set_time_limit(0);
date_default_timezone_set('Asia/Manila');
$sc_acctno = $_SESSION['sc_acctno'];
$passcode = $_SESSION['passcode'];
$user_id = $_SESSION['user_id'];

include "db_connect.php";
$sql_check = pg_query($db, "select * from election_user where sc_acctno='$sc_acctno'  and passcode='$passcode';") or die ("Could not match data because ".pg_last_error());
$num=pg_num_rows($sql_check);
$row = pg_fetch_assoc($sql_check);

$sql_lock = pg_query($db, "select * from election_title where current_timestamp between start_date and end_date limit 1;") or die ("Could not match data because ".pg_last_error());
$numlock=pg_num_rows($sql_lock);

if ($num==0 && $numlock==1){ 

     session_unset();
     session_destroy();
     
     //header('Location: voters_login.php');
     echo "<script>window.location.replace('voters_login.php')</script>";
}
elseif ($numlock<>1){ 

     session_unset();
     session_destroy();
     
     //header('Location: access_closed.php');
     echo "<script>window.location.replace('access_closed.php')</script>";


}



?>

 

