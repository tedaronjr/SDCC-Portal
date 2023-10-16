<?php
session_start();
set_time_limit(0);

session_destroy();


//session_unset();
?>

<!DOCTYPE html>
<html>
<head>
    <title>SDCC Portal</title>
<?php
include "scriptlink.php";

setlocale(LC_MONETARY,"en_PH.UTF-8"); 

//include "db_connect.php";

?> 
</head>

<body>




<div class="container">
<br>
<?php
include "title.php";
?>

<ul class="nav justify-content-center">
  <li class="nav-item">
    <a class="nav-link" href="PT_ELECTION/pt_election_attendance_select.php" target=_blank>PT Election Attendance</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="PT_ELECTION/pt_election_vote_select.php" target=_blank>PT Election Vote</a>
  </li>  
  <li class="nav-item">
    <a class="nav-link active" href="MIGS_check.php" target=_blank>Membership Status</a>
  </li>  

  <li class="nav-item">
    <a class="nav-link active" href="javascript:;" onclick="window.location='admin_login.php'">Sign In</a>
  </li>  

</ul>

<?php
include "footer.php";
?>
</body>
</html>
