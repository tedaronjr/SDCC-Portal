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

 $sql = pg_query($db, "SELECT a.*,b.organization,concat(last_name,',',first_name,' ',middle_name) as fullname,a.sc_acctno as acctno FROM members a left join organizations b on a.organization_id=b.organization_id WHERE a.sc_acctno='$sc_acctno';") or die ("Could not match data because ".pg_last_error());

 $num=pg_num_rows($sql);

 } 
 



elseif  (isset($_POST['submit_pt'])) {
  
	$acctno = $_POST['acctno'];
	$organization_id = $_POST['organization_id'];


	$sql_upd2 = pg_query($db, "UPDATE members set 
	organization_id='$organization_id',members_ou_code='$organization_id' 
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
   <h3 class="text-center"><?php echo "Update Member PT"; ?></h3><br>



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









<br>





<?php

 if($num>0) {

?>

                     <table id="mmaster_data" class="table table-striped table-bordered">  
                          <thead>  
                               <tr> 
                                    <td>Account No.</td>  
                                    <td>Full Name</td>
                                    <td>PT</td>

									 								



                                    <td>Action</td>          
                               </tr>  
                          </thead>  
			<tbody>

                          <?php  


                          while($row = pg_fetch_assoc($sql))

                          {  

$sql_pt = pg_query($db, "select * from organizations order by organization") or die ("Could not match data because ".pg_last_error());
$num_pt=pg_num_rows($sql_pt);



                               echo '<tr>';  

                               echo '<td>'.$row['acctno'].'</td>'; 
                               echo '<td>'.$row['fullname'].'</td>';



                               echo "<td>";
                               echo "<form autocomplete=\"off\"  method=\"post\" action=\"update_pt.php\">";
                               echo "<input type=hidden name=acctno class=form-control value='$row[acctno]'>";
                               echo "<select class='form-control'  name='organization_id' required >";
                               echo "<option value='$row[organization_id]'>$row[organization]</option>";  

                               while($row_ = pg_fetch_assoc($sql_pt)) {
                                    echo "<option value='$row_[organization_id]'>$row_[organization]</option>";
                               }
                               echo "</select>";

                               echo "</td>";

                               echo '<td>';    
                               echo  "<input type=submit  class=\"btn btn-primary\" onclick=\"if (confirm('Are you sure?')) return true; else return false;\" name=submit_pt  value='Update'>";
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
elseif (isset($_POST['submit_acctno']) && $num==0) {
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
 



