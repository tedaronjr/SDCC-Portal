<?php
//Including Database configuration file.
include "db_connect.php";
//Getting value of "search" variable from "script.js".
if (isset($_POST['search'])) {
//Search box value assigning to $Acctno variable.
   $Acctno = $_POST['search'];
//Search query.
   $Query = "
   SELECT * FROM election_user where sc_acctno='$Acctno' and ag1='T' limit 1";

//Query execution
   $ExecQuery = pg_query($db, $Query);
   
   $num_=pg_num_rows($ExecQuery);

   if($num_==0)
    die ("<div class='alert alert-danger'><strong>No Voucher Found!</strong></div>");

//Creating unordered list to display result.



?>
  <?php 
  $Result = pg_fetch_assoc($ExecQuery);
  $sql_ = pg_query($db, "select * from election_voucher where sc_acctno='$Result[sc_acctno]' and claimed='T' limit 1") or die ("Could not match data because ".pg_last_error());
  $row_ = pg_fetch_assoc($sql_);


  $num_sql=pg_num_rows($sql_);



  if ($num_sql==1)
   echo "<div class='alert alert-success'><strong>Voucher Claimed</strong></div>" ;
 ?>
<form autocomplete=off onsubmit="return confirm('Are you sure?');" method=POST target=_self >
 <div class="table-responsive"> 

  <table  class="table table-striped table-bordered table-sm">  
   <thead>  
    <tr>
	

	 <td><B>MEM_NO</B></td> 
	 <td><B>NAME</B></td> 
     <td><B>LOCATION</B></td> 
	  	 
	 <td><B>ACTION</B></td>	 
	 

    </tr>  
   </thead>  
   <tbody>
    <?php  
	 //$x=0;
    // while($Result = pg_fetch_assoc($ExecQuery))  
    // {  


       
	  echo '<tr>';
	  echo '<td>'.$Result['mem_no'].'</td>'; 
	  echo '<td>'.$Result['fullname'].'</td>'; 
      //echo "<td><select class=form-control  name=loc_ required  > <option value='' hidden  ></option><option value='MAIN'  >MAIN</option><option value='DASA'  >DASA</option><option value='LPC'  >LPC</option><option value='TANZA'  >TANZA</option></select></td>";


	  echo '<td>'.'';
     if ($num_sql==1)
       echo $row_['loc_'];
     else
      echo "<select class=form-control  name=loc_ required  > <option value='' hidden  ></option><option value='MAIN'  >MAIN</option><option value='DASA'  >DASA</option><option value='LPC'  >LPC</option><option value='TANZA'  >TANZA</option></select></td>";
      
      echo '<td>';
     echo "<input type=hidden   name=sc_acctno  value='$Result[sc_acctno]'  />";
     echo "<input type=hidden   name=fullname  value='$Result[fullname]'  />";
     echo "<input type=hidden   name=mem_no  value='$Result[mem_no]'  />";
 
     //echo "<input type=hidden   name=passcode  value='$Result[passcode]'  />";
     echo "<input type=hidden   name=pt_no  value='$Result[pt_no]'  />";
     echo "<input type=hidden   name=updated_at  value=".date('Y-m-d')."/>";


     
     

    if ($num_sql==1)
     echo '<i class="fa fa-check" aria-hidden="true"></i><span class="btn btn-success">Already Claimed</span>' ; 
    else
     echo '<input type="submit"  class="btn btn-primary"  name="Claim" value="Claim" />' ;
   
     echo '</form>'.'</td>';	
     echo '</tr>';
     	  
      //++$x;  
     //}  
 
    ?>  
	

	</tbody>
   </table>  
  </div> 


<?php
}
?>


