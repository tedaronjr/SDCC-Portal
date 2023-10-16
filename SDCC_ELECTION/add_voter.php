<?php
session_start();
set_time_limit(0);
if (!isset($_SESSION['admin_user']) || !isset($_SESSION['admin_pass'])){
    unset($_SESSION['admin_user']);
    unset($_SESSION['admin_pass']);
    session_destroy();
    echo "<script>window.location.href=\"/SDCC-Portal/control/\"</script>";           

}
?>

<!DOCTYPE html>
<html>
<head>

<?php
include "scriptlink.php";
?>
<script>

$(document).ready(function(){


$('#sc_acctno').mask('00-00000');

$("#submit_acctno").click(function(){	
 if($("#sc_acctno").val().length < 8) {
  alert('7 digits required for sc acctno');
  $("#sc_acctno").focus();
  $("#sc_acctno").css("border-color","#FF0000");
  return false;
 }
});


$("#submit_lastname").click(function(){	

var last_Length = $('#last_name').val().length;
if(last_Length > 1) {
	$('#myForm1').submit()
}	
else {
   //alert(last_Length + ' minimum of two char length required');
   alert(' minimum of three char length required');
   $("#last_name").focus();
   $("#last_name").css("border-color","#FF0000");   
   return false;
}
});

$('#mmaster_data').DataTable( {"bLengthChange": false,"searching": false,
	paging: true,"lengthMenu": [[5, 25, 50, -1], [5, 25, 50, "All"]]
	}
	);  
});
</script>




  
<?php

  include "db_connect.php";
$num=0;
if (isset($_POST['submit_acctno'])) {

 $sc_acctno=$_POST['sc_acctno']; 

 $sql = pg_query($db, "SELECT *,concat(last_name,',',first_name,' ',middle_name) as fullname FROM jar_coop_member WHERE sc_acctno='$sc_acctno';") or die ("Could not match data because ".pg_last_error());

 $num=pg_num_rows($sql);

 } 
 
elseif (isset($_POST['submit_lastname'])) {

	$last_name=$_POST['last_name']; 
   
	$sql = pg_query($db, "SELECT *,concat(last_name,',',first_name,' ',middle_name) as fullname FROM jar_coop_member WHERE last_name ilike '%$last_name%';") or die ("Could not match data because ".pg_last_error());
   
	$num=pg_num_rows($sql);
   
}

elseif (isset($_POST['Add_Voter'])) {

	include "db_connect.php";
	
	$sc_acctno = $_POST['sc_acctno'];
	$fullname = $_POST['fullname'];
	$mem_no = $_POST['mem_no'];
	$ou_code = $_POST['ou_code'];
	$passcode = $_POST['passcode'];
	$pt_no = $_POST['pt_no'];
	$updated_at = $_POST['updated_at'];
	$managed_by = $_POST['managed_by'];
	
	
	$sql_add = pg_query($db, "INSERT INTO election_user(
	  fullname, mem_no, sc_acctno, ou_code, passcode, pt_no,updated_at,managed_by)
	 select '$fullname','$mem_no','$sc_acctno','$ou_code','$passcode','$pt_no',current_timestamp,'$managed_by';") or die ("Could not match data because ".pg_last_error());
	$num=0;	
}
elseif  (isset($_POST['Del_Voter'])) {
	include "db_connect.php";
  
	$sc_acctno = $_POST['sc_acctno'];
  
	$sql_del = pg_query($db, "DELETE FROM election_user WHERE sc_acctno='$sc_acctno';") or die ("Could not match data because ".pg_last_error());  
	$num=0;
}

?>


<style type="text/css">
table.gridtable {
	font-family: verdana,arial,sans-serif;
	font-size:11px;
	color:#333333;
	border-width: 1px;
	border-color: #666666;
	border-collapse: collapse;
}
table.gridtable th {
	border-width: 1px;
	padding: 8px;
	border-style: solid;
	border-color: #666666;
	background-color: #dedede;
}
table.gridtable td {
	border-width: 1px;
	padding: 8px;
	border-style: solid;
	border-color: #666666;
	background-color: #ffffff;
}

/*
.form-control {
    
    width: 50px;
}
*/
</style>
</head>
<body>

 <div class="container">
 <BR>
<?php
include "title.php";
?>
   <h3 class="text-center"><?php echo "Add/Remove Member Voter"; ?></h3><br>



  <div class="_script">
  </div>




<form autocomplete="off" role="form"  id="myForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	<div class="row">
		<div class="col-4">
		</div>
		<div class="col-2">
		 <input type="text" class="form-control"  placeholder="00-00000" id="sc_acctno" name="sc_acctno"    required >
		</div>
		<div class="col-3">
		 <input type="submit" class="btn btn-primary"  value="Search Account No." id="submit_acctno" name="submit_acctno">
		</div>
		<div class="col-3">
		</div>				
	</div>
</form>	
	<br>
<form autocomplete="off" role="form"  id="myForm1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	<div class="row">
		<div class="col-4">
		</div>
		<div class="col-2">
		 <input type="text" class="form-control"  placeholder="Last Name" id="last_name" name="last_name"  required   >
		</div>
		<div class="col-3">
		 <input type="submit" class="btn btn-primary"  value="Search Last Name" id="submit_lastname" name="submit_lastname">
		</div>
		<div class="col-3">
		</div>				
	</div>
</form>	







</form>

<br>

<?php

 if($num>0) {

?>

                     <table id="mmaster_data" class="table table-striped table-bordered">  
                          <thead>  
                               <tr> 
                                    <td>Account No.</td>  
                                    <td>Last Name</td> 
                                    <td>First Name</td>     
                                    <td>Middle Name</td>
                                    <td>Status</td>									
                                    <td>Action</td>          
                               </tr>  
                          </thead>  
			<tbody>

                          <?php  


                          while($row = pg_fetch_assoc($sql))  
                          {  

$sql_ = pg_query($db, "select * from election_user where sc_acctno='$row[sc_acctno]'") or die ("Could not match data because ".pg_last_error());
$num_sql=pg_num_rows($sql_);

$sqlvoted = pg_query($db, "select * from election_voted where sc_acctno='$row[sc_acctno]' ") or die ("Could not match data because ".pg_last_error());
$num_voted=pg_num_rows($sqlvoted);

                               echo '<tr>';  
                               echo '<td>'.$row['sc_acctno'].'</td>'; 
                               echo '<td>'.$row['last_name'].'</td>';    
                               echo '<td>'.$row['first_name'].'</td>';                                   
                               echo '<td>'.$row['middle_name'].'</td>';
if ($num_voted==1 || $num_sql==1 || $row['status_id']==1)								   
                               echo '<td class=btn-success><b>MIGS</b></td>';
else
								echo '<td class=btn-info><b>NOT MIGS</b></td>';

if ($num_voted==1)							   						   
echo '<td>'."<form  onsubmit='return confirm(\"Are you sure?\");' method=POST target=_self ><input type='button'  class='btn btn-success'  value='Already Voted' />".'</td>';
elseif ($num_sql==1)
echo '<td>'."<form  onsubmit='return confirm(\"Are you sure?\");' method=POST target=_self ><input type='submit'  class='btn btn-danger'  name='Del_Voter' value='Remove Voter' />".'</td>';
else
							   echo '<td>'."<form  onsubmit='return confirm(\"Are you sure?\");' method=POST target=_self ><input type='submit'  class='btn btn-primary'  name='Add_Voter' value='Add Voter' />".'</td>';
							   echo "<input type=hidden   name=sc_acctno  value='$row[sc_acctno]'  />";
							   echo "<input type=hidden   name=fullname  value='$row[fullname]'  />";
							   echo "<input type=hidden   name=mem_no  value='$row[mem_no]'  />";
							   echo "<input type=hidden   name=ou_code  value='$row[ou_code]'  />";
							   echo "<input type=hidden   name=passcode  value='$row[passcode]'  />";
							   echo "<input type=hidden   name=pt_no  value='$row[pt_no]'  />";
							   echo "<input type=hidden   name=updated_at  value=".date('Y-m-d')."/>";
							   echo "<input type=hidden   name=managed_by  value='$row[managed_by]'  /></form>";							   
							            
                               echo '</tr>';  
                          }  
						  
                          ?>  
			</tbody>
                     </table>

<?php
}
elseif ((isset($_POST['submit_lastname'])  || isset($_POST['submit_acctno'])) && $num==0) {
	echo "<div class='alert alert-info'>";
	echo "<strong>No Data</strong>";
	echo "</div>";
  } 
?>
<BR><BR><BR>
<?php
include "footer.php";
?>
</div>
</body>
</html> 
 




