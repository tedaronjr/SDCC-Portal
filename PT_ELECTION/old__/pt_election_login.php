<?php

session_start();
set_time_limit(0);

session_unset();

$year = date("Y");
$yeardiff = $year - 1961;
?>

<!DOCTYPE html>
<html>
<head>
<title>PT Election Login</title>    
<?php
include "scriptlink.php";

setlocale(LC_MONETARY,"en_PH.UTF-8"); 

include "db_connect.php";

?> 



<?php

if (isset($_POST['submit_login'])) {


$sc_acctno  = $_POST['sc_acctno'];
$votecode = $_POST['votecode'];




$sql_valid_member = pg_query($db, "SELECT *,(select organization from organizations where ou_code=members_ou_code) FROM members  WHERE  sc_acctno='$sc_acctno' and  code='$votecode' and membership_status_id in (1,2) and mem_no in (select mem_no from attendance where  sc_acctno='$sc_acctno');") or die ("Could not match data because ".pg_last_error());
$num_valid_member=pg_num_rows($sql_valid_member);




$row = pg_fetch_assoc($sql_valid_member);

 if ($num_valid_member==1 ){ 

    $_SESSION['sc_acctno'] = $row['sc_acctno']; 

    echo "<script>window.location.replace('pt_election_submit.php')</script>";

 }
 else {

      session_unset();
      session_destroy();
     // echo "<script>window.location.replace('pt_election_login.php?Invalid=1')</script>";
 }



}
?> 


<script>

$(document).ready(function(){


 $('#sc_acctno').mask('00-00000');

});
</script>
</head>

<body>




<div class="container">
<BR>
<?php
include "title.php";
?>

  <br><BR>
   <h3 class="text-center"><?php echo "PT Election"; ?></h3>
  <br>
  <?php
  if (isset($_POST['submit_login'])) {
    if ($num_valid_member==0){
      echo "<div class='alert alert-danger'>";
      echo "<strong>Invalid Credentials</strong>";
      echo "</div>";
    } 
}     
  ?> 
 <form autocomplete="off" role="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">




 <div class="row text-center">
 <div class="col-2">           
  </div>  
 <div class="col-3 text-right">
    
    <b>Account No:</b>
    

 </div> 
  <div class="col-3  mx-auto p-0">           
       <input type="text" class="form-control"  placeholder="##-#####"  name="sc_acctno" id="sc_acctno" required  >   
  </div>
  <div class="col-3">           
  </div>     
</div>         
<br>
<div class="row text-center">
 <div class="col-2">           
  </div>  
 <div class="col-3 text-right">
    
    <b>Vote Code:</b>
    

 </div> 
  <div class="col-3 mx-auto p-0">           
      <input type="password" class="form-control" placeholder=""  name="votecode" id="votecode"  required  >
  </div>
  <div class="col-3">           
  </div>     
</div>  




  <br>
   
    <BR>
    <div class="row">

      <div class="col-12 text-center">
            <button type="submit" class="btn btn-primary" id="submit" name="submit_login">Select</button>
      </div> 
  
    </div> 







 </form>
<BR><BR><BR><BR><BR><BR>
<?php
include "footer.php";
?>
</body>
</html>
