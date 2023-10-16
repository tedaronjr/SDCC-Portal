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
   alert(' minimum of two char length required');
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



        function TestFunction(param) {
                    
                    $.ajax({
                        url : "modal_form.php",
                        type : "post",
                        dataType:"text",
                        data : {
                             acctno: param
                        },
                        success : function (a){
                            $('#result').html(a);
							$('#myModal').modal('show');
                        }
                    });
        }	
 

</script>




  
<?php

  include "db_connect.php";
$num=0;
if (isset($_POST['submit_acctno'])) {

 $sc_acctno=$_POST['sc_acctno']; 

 $sql = pg_query($db, "SELECT a.*,b.*,concat(last_name,',',first_name,' ',middle_name) as fullname,a.sc_acctno as acctno FROM members a left join members_standing_scores b on a.sc_acctno=b.sc_acctno WHERE a.sc_acctno='$sc_acctno';") or die ("Could not match data because ".pg_last_error());

 $num=pg_num_rows($sql);

 } 
 
elseif (isset($_POST['submit_lastname'])) {

	$last_name=$_POST['last_name']; 
   
	$sql = pg_query($db, "SELECT *,concat(last_name,',',first_name,' ',middle_name) as fullname,a.sc_acctno as acctno FROM members a left join members_standing_scores b on a.sc_acctno=b.sc_acctno WHERE last_name ilike '%$last_name%';") or die ("Could not match data because ".pg_last_error());
   
	$num=pg_num_rows($sql);
   
}


elseif  (isset($_POST['submit_score'])) {
  
	$acctno = $_POST['acctno'];
	$koop_activities = $_POST['koop_activities'].'%';
	$share_capital_depositv = $_POST['share_capital_depositv'].'%';
	$savings_time_deposit = $_POST['savings_time_deposit'].'%';
	$loans = $_POST['loans'].'%';
	$recruit = $_POST['recruit'].'%';
	$share_capital_deposit_additional = $_POST['share_capital_deposit_additional'].'%';
	$planong_damayan = $_POST['planong_damayan'].'%';
	$botica_de_san_dionisio = $_POST['botica_de_san_dionisio'].'%';
	$rentals = $_POST['rentals'].'%';
	$insurance = $_POST['insurance'].'%';	
	$bayad_center = $_POST['bayad_center'].'%';	
	$total = $_POST['koop_activities'] + $_POST['share_capital_depositv'] +
	$_POST['savings_time_deposit'] + $_POST['loans'] +  $_POST['recruit'] + $_POST['share_capital_deposit_additional']
	+  $_POST['planong_damayan'] +  $_POST['botica_de_san_dionisio'] +  $_POST['rentals'] + $_POST['insurance']
	+ $_POST['bayad_center'] ;
	$total_s= $total;	
	$total= $total.'%';

	$sql_upd = pg_query($db, "UPDATE members_standing_scores set 
	 koop_activities = '$koop_activities',
	share_capital_depositv = '$share_capital_depositv',
	savings_time_deposit = '$savings_time_deposit',
	loans = '$loans',
	recruit = '$recruit',
	share_capital_deposit_additional = '$share_capital_deposit_additional',
	planong_damayan = '$planong_damayan',
	botica_de_san_dionisio = '$botica_de_san_dionisio',
	rentals = '$rentals',
	insurance = '$insurance',	
	bayad_center = '$bayad_center',
	total ='$total'
	where sc_acctno='$acctno'") or die ("Could not match data because ".pg_last_error());

if ($total_s >= 78) {
$sql_upd2 = pg_query($db, "update jar_coop_member set status_id=1 where sc_acctno='$acctno' AND  status_id<>1") or die ("Could not match data because ".pg_last_error());
$sql_upd3 = pg_query($db, "
UPDATE members
   SET  membership_status_id=1 
	   where sc_acctno='$acctno' AND  membership_status_id<>1") or die ("Could not match data because ".pg_last_error());
}
elseif($total_s < 78) {
$sql_upd2 = pg_query($db, "update jar_coop_member set status_id=2 where sc_acctno='$acctno' AND  status_id=1") or die ("Could not match data because ".pg_last_error());
$sql_upd3 = pg_query($db, "
UPDATE members
   SET  membership_status_id=2 
	   where sc_acctno='$acctno' AND  membership_status_id=1") or die ("Could not match data because ".pg_last_error());
}	 
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
   <h3 class="text-center"><?php echo "Update Member Score"; ?></h3><br>



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








<br>





<?php

 if($num>0) {

?>

                     <table id="mmaster_data" class="table table-striped table-bordered">  
                          <thead>  
                               <tr> 
                                    <td>Account No.</td>  
                                    <td>Full Name</td>
                                    <td>Total Score</td>

									 								



                                    <td>Action</td>          
                               </tr>  
                          </thead>  
			<tbody>

                          <?php  


                          while($row = pg_fetch_assoc($sql))

                          {  

$sql_ = pg_query($db, "select * from election_user where sc_acctno='$row[acctno]'") or die ("Could not match data because ".pg_last_error());
$num_sql=pg_num_rows($sql_);

$sqlvoted = pg_query($db, "select * from election_voted where sc_acctno='$row[acctno]' ") or die ("Could not match data because ".pg_last_error());
$num_voted=pg_num_rows($sqlvoted);

                               echo '<tr>';  

                               echo '<td>'.$row['acctno'].'</td>'; 
                               echo '<td>'.$row['fullname'].'</td>'; 
							   if (str_replace("%","",$row['total']) >= 78)
                               echo '<td class=btn-success>'.$row['total'].'</td>';
							   else 
                               echo '<td class=btn-danger>'.$row['total'].'</td>';

                               echo '<td>';    
							   echo "<a class=\"btn btn-primary\"  role=\"button\" href=\"#\"  value=Update onclick=\"TestFunction('$row[acctno]')\" >Edit</a>";
                               echo '</td>';    



						   
							            
                               echo '</tr>';  
                          }  
						  
                          ?>  
			</tbody>
                     </table>
<div id="result"></div>
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
 




