<?php
session_start();

include "db_connect.php";

//include "user_session.php";
$sql_lock = pg_query($db, "select * from election_title where current_timestamp between start_date and end_date limit 1;") or die ("Could not match data because ".pg_last_error());
$numlock=pg_num_rows($sql_lock);
if ($numlock==1){ 

  session_unset();
  //session_destroy();
  
  //header('Location: voters_login.php');
  echo "<script>window.location.replace('voters_login.php')</script>";

}
elseif ($numlock<>1){ 

  session_unset();
  //session_destroy();
  
  //header('Location: access_closed.php');
  //echo "<script>window.location.replace('access_closed.php')</script>";


}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Access Closed</title>
<?php
include "scriptlink.php";

setlocale(LC_MONETARY,"en_PH.UTF-8"); 

?>


</head>

<body>




<div class="container">
<BR>
<?php
include "title.php";
?>

  <br><BR><br><BR>
   <h1 class="text-center">Access to SDCC General Election is Closed</h1>
   <br></br>
<div class='col text-center'><a href='MIGS_check.php'  class='btn btn-success'>MIGS Checking</a>
</div>
<BR><BR>
<?php
include "footer.php";
session_destroy();
?>
</body>
</html>
