<?php
session_start();
set_time_limit(0);
date_default_timezone_set('Asia/Manila');

include "db_connect.php";

if (!isset($_SESSION['user_id'])){ 

     session_unset();
     session_destroy();
     
     header('Location: voters_login.php');

}

$sc_acctno = $_SESSION['sc_acctno'];
//$passcode = $_SESSION['passcode'];
$user_id = $_SESSION['user_id'];


$sql_check = pg_query($db, "select * from election_user where user_id=$user_id and ag1 IS null;") or die ("Could not match data because ".pg_last_error());

$num=pg_num_rows($sql_check);
$row = pg_fetch_assoc($sql_check);

 if ($num<>1){ 

      session_unset();
      session_destroy();
      
      header('Location: voters_login.php');

 }
?>

 

