<?php
include "admin_session.php";

?>

<!DOCTYPE html>
<html>
<head>
    <title>ELECTION ADMIN</title>
<?php
include "scriptlink.php";

setlocale(LC_MONETARY,"en_PH.UTF-8"); 
?> 

<script>
/*
$(document).ready(function(){  

 $("#open_election").click(function(){
    $('#display_date').show();
    $('#open_election').hide();  
 });



});
*/
</script>
<?php
if (isset($_POST['start_election'])) {

$title_id=1; 

$sql = pg_query($db, "update election_title set start_date=current_timestamp,closed='F' where title_id=$title_id;") or die ("Could not match data because ".pg_last_error());
echo "<meta http-equiv=\"refresh\" content=\"0;URL=election_admin.php\">";	
echo "<script>window.location.replace('election_admin.php')</script>";
} 
//$sql_close = pg_query($db, "select * from election_title where closed='T' limit 1;") or die ("Could not match data because ".pg_last_error());
//$numclose=pg_num_rows($sql_close);
?>
</head>

<body>




<div class="container-fluid">
<BR>
<?php
include "title.php";
include "election_navlink.php";
?>
<br>
<br>
<?php
if ($numlock==1) {
?>
<div id="display_date" >
<h1  class="text-center" >Election Start</h1>
<h1  class="text-center" ><?php
$date_start=date_create("$row_start[start_date]");
echo date_format($date_start,"M d,Y h:i:s A");
//echo date("M d,Y h:i:s A");
?>
</h1>
</div>
<?php
} elseif ($numlock==0 && date('Y-m-d H:i:s') >=$row_end['end_date']) {
?>
<div id="display_date" >
<h1  class="text-center" >Election End</h1>
<h1  class="text-center" ><?php
$date_end=date_create("$row_end[end_date]");
echo date_format($date_end,"M d,Y h:i:s A");
//echo date("M d,Y h:i:s A");
?>
</h1>
</div>
<?php
} 
?>
<BR><BR><BR><BR><BR><BR>
<?php
include "footer.php";
?>
</div>
</body>
</html>
