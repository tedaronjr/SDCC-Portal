<?php
session_start();
set_time_limit(0);

session_destroy();


//session_unset();
?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo "PT Election"; ?></title>
<?php
include "scriptlink.php";

setlocale(LC_MONETARY,"en_PH.UTF-8"); 

include "db_connect.php";

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
    <a class="nav-link active" href="pt_election_control_panel.php">PT Election Control Panel</a>
  </li>
  <li class="nav-item">
    <a class="nav-link active" href="MIGS_check.php">MIGS Checking</a>
  </li>  
  <li class="nav-item">
    <a class="nav-link" href="pt_election_attendance_select.php">PT Election Attendance</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="pt_election_vote_select.php">PT Election Vote</a>
  </li>

</ul>

<?php
include "footer.php";
?>
</body>
</html>