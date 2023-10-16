<?php
if (isset($_POST['submit_'])) {
  include "MIGS_inquiry.php";
}  
else {
 //include "admin_session.php";
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
	paging: false,"lengthMenu": [[5, 25, 50, -1], [5, 25, 50, "All"]]
	}
	);  
});
</script>




  
<?php

  include "db_connect.php";
$num=0;
//if (isset($_POST['submit_'])) {
/*
 $sc_acctno=$_POST['sc_acctno']; 
 $birthdate=$_POST['birthdate']; 

 $sql = pg_query($db, "SELECT a.*,score FROM jar_coop_member a left join members b on a.sc_acctno=b.acctno WHERE  sc_acctno='$sc_acctno' and  birthdate='$birthdate';") or die ("Could not match data because ".pg_last_error());

 $num=pg_num_rows($sql);
*/

//window.location.href="agreement1.php";
 //header('Location: MIGS_inquiry.php');

 //} 
 




?>


<style type="text/css">
    table {
        table-layout: fixed;
        word-wrap: break-word;
    }

        table th, table td {
            overflow: hidden;
        }
</style>
</head>
<body>

 <div class="container">
 <BR>
<?php
include "title.php";
?>
   <h3 class="text-center"><?php echo "Membership Status"; ?></h3><br>



  <div class="_script">
  </div>




<form autocomplete="off" role="form"  id="myForm" method="post" >
	<div class="row">
		<div class="col-2">
		</div>
		<div class="col-3 text-right">
			Account No.:
		</div>

		<div class="col-3">
		 <input type="text" class="form-control"  placeholder="00-00000" id="sc_acctno" name="sc_acctno"  required >
		</div>

		<div class="col-4">
		</div>
	
	</div>
<!--</form>	-->
	<br>
<!--<form autocomplete="off" role="form"  id="myForm1" method="post" action="<?php //echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">-->
	<div class="row">
	<div class="col-2">
	</div>
	<div class="col-3 text-right">
			Birthdate:
	</div>	
	<div class="col-3">
	<input type="date" class="form-control"  placeholder="Enter birthdate" id="last_name" name="birthdate"  required   >			
	</div>
	<div class="col-4">
	</div>
	</div>	
	<br>
	<div class="text-center">
		 <input type="submit" class="btn btn-primary"  value="Submit"  name="submit_">
	</div>
</form>	







</form>

<br>

<?php

 if($num>0) {

?>

                     <table  class="table table-striped table-bordered">  
                          <thead>  
                               <tr> 
                                    <td>Account No.</td>  
                                    <td>Last Name</td> 
                                    <td>First Name</td>     
                                    
                                    <td>Birthdate</td>									
                                    <td>Passcode</td>          
                               </tr>  
                          </thead>  
			<tbody>

                          <?php  


                          while($row = pg_fetch_assoc($sql))  
                          {  

//$sql_ = pg_query($db, "select * from election_user where sc_acctno='$row[sc_acctno]'") or die ("Could not match data because ".pg_last_error());
//$num_sql=pg_num_rows($sql_);

//$sqlvoted = pg_query($db, "select * from election_voted where sc_acctno='$row[sc_acctno]' ") or die ("Could not match data because ".pg_last_error());
//$num_voted=pg_num_rows($sqlvoted);

                               echo '<tr>';  
                               echo '<td>'.$row['sc_acctno'].'</td>'; 
                               echo '<td>'.$row['last_name'].'</td>';    
                               echo '<td>'.$row['first_name'].'</td>';                                   
                               echo '<td>'.$row['birthdate'].'</td>';
if ($row['score'] >= 78) {							   
                               echo '<td>'.$row['passcode'].'</td>';
} else {
								echo '<td></td>';
}								   


        
                               echo '</tr>';  
                          }  
						  
                          ?>  
			</tbody>
                     </table>

<?php
}
elseif (isset($_POST['submit_'])) {
	echo "<div class='alert alert-info'>";
	echo "<strong>Login failed</strong>";
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
 
<?php } ?>



