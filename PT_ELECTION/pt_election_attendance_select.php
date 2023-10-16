<?php
session_start();
set_time_limit(0);
session_unset();
?>
<!DOCTYPE html>
<html>
<head>
<title>PT Election Attendance</title>
<?php
include "scriptlink.php";
include "db_connect.php";
?>
  
<?php 
  $num=0;
?>


<style>
  /* Default font size */
  #accountno {
    font-size: 16px;
  }

  /* Custom styles for small devices (up to 767.98 pixels) */
  @media (max-width: 767.98px) {
    #accountno {
      font-size: 14px;
    }
  }

  /* Custom styles for medium devices (768px to 991.98 pixels) */
  @media (min-width: 768px) and (max-width: 991.98px) {
    #accountno {
      font-size: 18px;
    }
  }

  /* Custom styles for large devices (992px to 1199.98 pixels) */
  @media (min-width: 992px) and (max-width: 1199.98px) {
    #accountno {
      font-size: 20px;
    }
  }

  /* Custom styles for extra-large devices (1200px and above) */
  @media (min-width: 1200px) {
    #accountno {
      font-size: 22px;
    }
  }
</style>



<script>

$(document).ready(function(){


 $('#sc_acctno').mask('00-00000');

});
</script>
<?php

$remark="";
if (isset($_POST['select_'])) {

  $sc_acctno=$_POST['sc_acctno']; 

  $birthdate=$_POST['birthdate']; 

$sql_attendance = pg_query($db, "

select jar_select_pt_election_attendance('$sc_acctno','$birthdate'::date) as  remark

") or die ("Could not match data because ".pg_last_error());

$row_attendance=pg_fetch_assoc($sql_attendance);

$num_attendance=pg_num_rows($sql_attendance);

if ($row_attendance['remark']=="migs_valid_no_attendance") {   
  $_SESSION['sc_acctno_attendance'] = $sc_acctno; 
  $_SESSION['birthdate_attendance'] = $birthdate;  
 
  echo "<script>window.location.href=\"pt_election_attendance_submit.php\"</script>";           
}

$remark=$row_attendance['remark'];



}
?>

</head>
<body>

 <div class="container">
 <br>
<?php
include "title.php";
?>
   <h3 class="text-center">PT Election Attendance</h3><br>



<?php
if ($remark<>null){
  echo "<div class=\"alert alert-danger\" role=\"alert\">$remark</div>";
 }
/*
if ($remark=='PT Meeting Closed'){
 echo "<div class=\"alert alert-danger\" role=\"alert\">$remark</div>";
}
elseif ($remark=='Already have attendance'){
  echo "<div class=\"alert alert-info\" role=\"alert\">$remark</div>";
 }
elseif ($remark=='Invalid Credentials'){
  echo "<div class=\"alert alert-warning\" role=\"alert\">$remark</div>";
} 
*/
?>




  <form autocomplete="off" role="form"  id="myForm" method="post"  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" >

  <div class="row">
    <div class="col-1">
		</div>
		<div class="col-4 text-right">
			<b>Account No.:</b>
		</div>
		<div class="col-4">
      <input type="text" class="form-control" name="sc_acctno" id="sc_acctno" placeholder="##-#####"  required   >
		</div>
		<div class="col-3">
		</div>	
	</div>

  <br>

  <div class="row">
    <div class="col-2">
		</div>
		<div class="col-3 text-right">
      <b>Birthdate:</b>
		</div>
		<div class="col-4">
     <input type="date" class="form-control"  name="birthdate"  required   >			              
		</div>
		<div class="col-3">
		</div>	
	</div>
  
  <br>
  <div class="text-center">
    <button type="submit" name="select_" class="btn btn-primary">Select</button>
  </div>

  </form>














<?php
include "footer.php";
?>
</div>
</body>
</html> 




