<?php
include "admin_session.php";
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

 $sql = pg_query($db, "SELECT a.*,b.*,concat(last_name,',',first_name,' ',middle_name) as fullname,a.sc_acctno as acctno FROM jar_coop_member a left join members_standing_scores b on a.sc_acctno=b.sc_acctno WHERE a.sc_acctno='$sc_acctno';") or die ("Could not match data because ".pg_last_error());

 $num=pg_num_rows($sql);

 } 
 
elseif (isset($_POST['submit_lastname'])) {

	$last_name=$_POST['last_name']; 
   
	$sql = pg_query($db, "SELECT *,concat(last_name,',',first_name,' ',middle_name) as fullname,a.sc_acctno as acctno FROM jar_coop_member a left join members_standing_scores b on a.sc_acctno=b.sc_acctno WHERE last_name ilike '%$last_name%';") or die ("Could not match data because ".pg_last_error());
   
	$num=pg_num_rows($sql);
   
}


elseif  (isset($_POST['submit_bday'])) {
  
	$acctno = $_POST['acctno'];
	$birthdate = $_POST['birthdate'];


	$sql_upd = pg_query($db, "UPDATE jar_coop_member set 
	 birthdate = '$birthdate'
	where sc_acctno='$acctno'") or die ("Could not match data because ".pg_last_error());

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
   <h3 class="text-center"><?php echo "Update Member Birthdate"; ?></h3><br>



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
<form autocomplete="off"  method="post" action="update_bday.php">
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
                                    <td>Birthday</td>

									 								



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



                               echo "<td>";
                               echo "<form autocomplete=\"off\"  method=\"post\" action=\"update_bday.php\">";
                               echo "<input type=hidden name=acctno class=form-control value='$row[acctno]'>";
                               echo "<input type=date name=birthdate class=form-control value='$row[birthdate]'>";
                               echo "</td>";

                               echo '<td>';    
                               echo  "<input type=submit  class=\"btn btn-primary\" onclick=\"if (confirm('Are you sure?')) return true; else return false;\" name=submit_bday  value='Update'>";
                               echo "</form>";
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
 




