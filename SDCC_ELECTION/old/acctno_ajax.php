<?php
//Including Database configuration file.
include "db_connect.php";
//Getting value of "search" variable from "script.js".
if (isset($_POST['search'])) {
//Search box value assigning to $Acctno variable.
   $Acctno = $_POST['search'];
//Search query.
   $Query = "
   SELECT *,concat(last_name,',',first_name,' ',middle_name) as fullname FROM jar_coop_member where sc_acctno='$Acctno' limit 1";

//Query execution
   $ExecQuery = pg_query($db, $Query);
   
   $num_=pg_num_rows($ExecQuery);

   if($num_==0)
    die ("<div class='alert alert-danger'><strong>No Record Found!</strong></div>");

//Creating unordered list to display result.



?>
  <?php 
  $Result = pg_fetch_assoc($ExecQuery);
  $sql_ = pg_query($db, "select * from election_user where sc_acctno='$Result[sc_acctno]'") or die ("Could not match data because ".pg_last_error());
  $sqlvoted = pg_query($db, "select * from election_voted where sc_acctno='$Result[sc_acctno]' ") or die ("Could not match data because ".pg_last_error());

  $num_sql=pg_num_rows($sql_);
  $num_voted=pg_num_rows($sqlvoted);


  if ($num_sql==1)
   echo "<div class='alert alert-danger'><strong>Member Already Added</strong></div>" ;
 ?>

 <div class="table-responsive"> 

  <table  class="table table-striped table-bordered table-sm">  
   <thead>  
    <tr>
	

	 <td><B>MEM_NO</B></td> 
	 <td><B>NAME</B></td> 
    <td><B>STATUS</B></td>	  	 	  	 
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
     if ($Result['status_id']==1)
      echo '<td class="btn btn-success" >MIGS</td>'; 
     else
      echo '<td><span class="btn btn-danger">NOT MIGS</span></td>';       


	  echo '<td>'.'<form autocomplete=off onsubmit="return confirm(\'Are you sure?\');" method=POST target=_self >';
     echo "<input type=hidden   name=sc_acctno  value='$Result[sc_acctno]'  />";
     echo "<input type=hidden   name=fullname  value='$Result[fullname]'  />";
     echo "<input type=hidden   name=mem_no  value='$Result[mem_no]'  />";
     echo "<input type=hidden   name=ou_code  value='$Result[ou_code]'  />";
     echo "<input type=hidden   name=passcode  value='$Result[passcode]'  />";
     echo "<input type=hidden   name=pt_no  value='$Result[pt_no]'  />";
     echo "<input type=hidden   name=updated_at  value=".date('Y-m-d')."/>";
     echo "<input type=hidden   name=managed_by  value='$Result[managed_by]'  />";



     
     

    if ($num_sql==1)
     echo '<input type="submit"  class="btn btn-danger"  name="Del_Voter" value="DELETE" />' ;
    elseif ($num_voted==1)
     echo '<i class="fa fa-check" aria-hidden="true"></i><span class="btn btn-success">Already Voted</span>' ; 
    elseif ($Result['status_id']==1)
     echo '<input type="submit"  class="btn btn-primary"  name="Add_Voter" value="Add" />' ;
    else
     echo 'Pls. Update this Member to become MIGS <input type="submit"  class="btn btn-primary"  name="Add_Voter" value="Add" />' ;
   
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


