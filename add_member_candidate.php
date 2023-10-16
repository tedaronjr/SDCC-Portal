<?php
session_start();
set_time_limit(0);
if (!isset($_SESSION['admin_user']) || !isset($_SESSION['admin_pass'])){
    unset($_SESSION['admin_user']);
    unset($_SESSION['admin_pass']);
    session_destroy();
    echo "<script>window.location.href=\"/SDCC-Portal/admin_login.php\"</script>";           

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

 $sql = pg_query($db, "SELECT * FROM members WHERE sc_acctno='$sc_acctno';") or die ("Could not match data because ".pg_last_error());

 $num=pg_num_rows($sql);

 } 
 
elseif (isset($_POST['submit_lastname'])) {

	$last_name=$_POST['last_name']; 
   
	$sql = pg_query($db, "SELECT * FROM members  WHERE last_name ilike '%$last_name%';") or die ("Could not match data because ".pg_last_error());
   
	$num=pg_num_rows($sql);
   
}

elseif (isset($_POST['Add_candidate'])) {

	include "db_connect.php";
	
  
    $mem_no = $_POST['mem_no'];

    
    
    
    $sql_add = pg_query($db, "
    INSERT INTO members_candidates(mem_no,is_present)
     select '$mem_no',true;") or die ("Could not match data because ".pg_last_error());
    $num=0;	
}
elseif (isset($_POST['Remove_candidate'])) {

	include "db_connect.php";
	
  
    $mem_no = $_POST['mem_no'];

    
    
    
    $sql_add = pg_query($db, "
    delete from members_candidates where mem_no='$mem_no';") or die ("Could not match data because ".pg_last_error());
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
   <h3 class="text-center"><?php echo "Add/Remove Member Candidate"; ?></h3><br>



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
                                    <td>Action</td> 

                               </tr>  
                          </thead>  
			<tbody>

                          <?php  


                          while($row = pg_fetch_assoc($sql))  
                          {  

$sql_ = pg_query($db, "SELECT member_candidate_id, mem_no, for_chairperson, for_vice_chairperson, 
for_secretary, for_treasurer, for_auditor, is_present, position_id, 
final_position
FROM public.members_candidates where mem_no='$row[mem_no]';
") or die ("Could not match data because ".pg_last_error());
$num_sql=pg_num_rows($sql_);





                               echo '<tr>';  
                               echo '<td>'.$row['sc_acctno'].'</td>'; 
                               echo '<td>'.$row['last_name'].'</td>';    
                               echo '<td>'.$row['first_name'].'</td>';                                   
                               echo '<td>'.$row['middle_name'].'</td>';
                              
                               if ($num_sql==0) {
    echo "<td><form  onsubmit='return confirm(\"Are you sure?\");' method=POST target=_self >
	<input type=hidden   name=mem_no  value='$row[mem_no]'  />
	<input type='submit'  class='btn btn-primary'  name='Add_candidate' value='Add Candidate' /></form></td>";
							   }
							   else {
								echo "<td>
								<form  onsubmit='return confirm(\"Are you sure?\");' method=POST target=_self >
								<input type=hidden   name=mem_no  value='$row[mem_no]'  />
								<input type='submit'  class='btn btn-danger'  name='Remove_candidate' value='Remove Candidate' /></form>								
								
								</td>";
							   }
    
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
 




