
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
    if (isset($_POST['submit'])) {
     // echo "$_POST[loc_] $_POST[inqdate]";
    if($_POST['loc_']=="CONSOLIDATED"){
    $sql = pg_query($db, "
    select *,to_char(updated_at, 'MON. DD,YYYY HH12:MI:SS AM') as updatedat  FROM election_voucher  where substr(updated_at::varchar,0,11)='$_POST[inqdate]'  ;

      ") or die ("Could not match data because ".pg_last_error());        
      $novote=pg_num_rows($sql);
    }  
    else {
      $sql = pg_query($db, "
      select *,to_char(updated_at, 'MON. DD,YYYY HH12:MI:SS AM') as updatedat  FROM election_voucher where 
      loc_='$_POST[loc_]' and substr(updated_at::varchar,0,11)='$_POST[inqdate]'  ;
  
        ") or die ("Could not match data because ".pg_last_error());        
        $novote=pg_num_rows($sql);
    }

    }
    else {
     echo "<script>window.location.replace('search_claimed.php');</script>";
    }
?>   
<script>
$(document).ready(function(){  
	$('#fb_tbl').DataTable( {"bLengthChange": false,"searching": true,
	paging: false,"lengthMenu": [["All", 25, 50, -1], ["All", 25, 50, "All"]]
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
if ($_POST['loc_']=="DASA")
  $loca="Sucat";
elseif ($_POST['loc_']=="LPC")
  $loca="Las Piñas"; 
elseif ($_POST['loc_']=="TANZA")
  $loca="Tanza";
elseif ($_POST['loc_']=="MAIN")
  $loca="Main";  
elseif ($_POST['loc_']=="CONSOLIDATED")
  $loca="Consolidated";  
else
 die();  

?>

<div class="container-fluid">
  <h3 class="text-center"><?php echo "San Dionisio Credit Cooperative"; ?></h2>
   <h4 class="text-center"><?php echo "0554 Quirino Avenue, San Dionisio, Parañaque City, Philippines"; ?></h4>

 <h5 class="text-center"><?php echo "62<sup>nd</sup> General Election (March 18-25,2023)"; ?></h5>
 <br>
 <h5 class="text-center"><?php echo '( '.number_format($novote).' ) '.$loca; ?> Claimed List As of <?php $date_=date_create("$_POST[inqdate]"); echo date_format($date_,"F j, Y"); ?></h5>


  <div class="table-responsive">  
<!--    <table  class="table table-bordered table-striped  w-auto small" > -->
    <table id="fb_tbl" class="table table-bordered table-striped w-auto small" >

    <thead>        
    <tr> 
    <td><b>Account No.</b></td>	

      <td ><b>Name</b></td>	
      <td ><b>Location</b></td>
      <td><b>Date Claimed</b></td>


    </tr>
    </thead>
    <tbody>            
<?php 	
  $x=0;
  while($row = pg_fetch_assoc($sql)) 
  {


	  echo '<tr>';
      echo "<td>$row[sc_acctno]</td>";
      echo "<td>$row[fullname]</td>";
      echo "<td>$row[loc_]</td>";
      echo "<td>$row[updatedat]</td>";

     
               

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
 




