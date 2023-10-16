
<?php
 include "admin_session.php";

?>
<!DOCTYPE html>
<html>
<head>
<style>  
@media (max-width: 400px) {  
    .table-responsive {
        font-size:10px !important;
    }
}
</style>  
<?php
   include "scriptlink.php";
   setlocale(LC_MONETARY,"en_PH.UTF-8"); 
   include "db_connect.php";

   function RemoveSpecialChar($str) {
 
    // Using str_replace() function
    // to replace the word
    $res = str_replace( array( '\'', '"' ), ' ', $str);
  
    // Returning the result
    return $res;
    }
    $sql = pg_query($db, "
    select *  FROM public.jar_coop_member where status_id=1 and mem_no not in (select mem_no from election_user);

      ") or die ("Could not match data because ".pg_last_error());        
      $novote=pg_num_rows($sql);
?>   
<script>
$(document).ready(function(){  
	$('#fb_tbl').DataTable( {"bLengthChange": false,"searching": true,
	paging: true,"lengthMenu": [[12, 25, 50, -1], [12, 25, 50, "All"]]
	}
	);  
 }); 
 
 function TestFunction(param) {
                    
                    $.ajax({
                        url : "modalresult.php",
                        type : "post",
                        dataType:"text",
                        data : {
                             id: param
                        },
                        success : function (a){
                            $('#result').html(a);
							$('#myModal').modal('show');
                        }
                    });
        }	

        function editdonefeedback(param) {
                    
                    $.ajax({
                        url : "edit_donefeedback.php",
                        type : "post",
                        dataType:"text",
                        data : {
                             id: param
                        },
                        success : function (a){
                            $('#result').html(a);
							$('#myModal').modal('show');
                        }
                    });
        }	         
 </script>
 
</head>

<body>

<?php
//include "navlink.php";
?>

<div class="container-fluid">
  <h3 class="text-center"><?php echo "San Dionisio Credit Cooperative"; ?></h2>
   <h4 class="text-center"><?php echo "0554 Quirino Avenue, San Dionisio, Parañaque City, Philippines"; ?></h4>

 <h5 class="text-center"><?php echo "62<sup>nd</sup> General Election (March 18-25,2023)"; ?></h5>
 <br>
 <h5 class="text-center"><?php echo '( '.number_format($novote).' ) '; ?>MIGS Not Voter As of <?php echo date('F j, Y h:i:s A');//echo date('F j, Y h:i:s A'); ?></h5>


  <div class="table-responsive">  
    <table id="fb_tbl" class="table table-bordered table-hover w-auto small" >
    <thead>        
    <tr> 
    <td><b>Account No.</b></td>	

      <td ><b>Name</b></td>	
      <td ><b>PT</b></td>
      <td><b>DC</b></td>


    </tr>
    </thead>
    <tbody>            
<?php 	
  $x=0;
  while($row = pg_fetch_assoc($sql)) 
  {


	  echo '<tr>';
      echo "<td>$row[sc_acctno]</td>";
      echo "<td>$row[last_name] $row[first_name]</td>";
      echo "<td>$row[pt_no]</td>";
      echo "<td>$row[managed_by]</td>";

     
               

    echo '</tr>'; 	  
	  echo "</form>";
    ++$x;  
  } 
?>  
    </tbody>
   </table>  
 </div> <!-- end table responsive -->
 </form>
 <div id="result"></div>

 <BR><BR>
<?php
include "footer.php";
?> 
</div>
</body>
</html> 
 




