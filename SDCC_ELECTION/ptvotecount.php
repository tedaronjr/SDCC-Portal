
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
    select pt_no,count(pt_no) as vote_count FROM ELECTION_VOTED A LEFT JOIN election_user B USING(SC_ACCTNO) group by pt_no order by vote_count desc;

      ") or die ("Could not match data because ".pg_last_error());        
      $novote=pg_num_rows($sql);
?>   
<script>
$(document).ready(function(){  
	$('#fb_tbl').DataTable( {"bLengthChange": false,"searching": false,
	paging: true,"lengthMenu": [[All, 25, 50, -1], [12, 25, 50, "All"]]
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
 <h5 class="text-center">Vote Count Per PT  <?php //echo date('F j, Y h:i:s A');//echo date('F j, Y h:i:s A'); ?></h5>

 <div class="row justify-content-center">
    <div class="col-auto">
    <table  class="table table-bordered table-striped text-center w-auto small" >
    <thead>        
    <tr> 
	
      <td ><b>PT</b></td>
      <td><b>Vote Count</b></td>


    </tr>
    </thead>
    <tbody>            
<?php 	
  $x=0;
  while($row = pg_fetch_assoc($sql)) 
  {


	  echo '<tr>';
 
      echo "<td>$row[pt_no]</td>";
      echo "<td>$row[vote_count]</td>";

     
               

    echo '</tr>'; 	  
	  echo "</form>";
    ++$x;  
  } 
?>  
    </tbody>
   </table>  
   </div>
  </div>

 <BR><BR>
<?php
include "footer.php";
?> 
</div>
</body>
</html> 
 




