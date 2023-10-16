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
    <title><?php echo $yeardiff."nd SDCC General Election Login"; ?></title>
<?php
include "scriptlink.php";

setlocale(LC_MONETARY,"en_PH.UTF-8"); 

include "db_connect.php";
$sql_lock = pg_query($db, "select * from election_title where current_timestamp between start_date and end_date limit 1;") or die ("Could not match data because ".pg_last_error());
$numlock=pg_num_rows($sql_lock);
if ($numlock<>1){ 

  session_unset();
  session_destroy();
  
  //header('Location: access_closed.php');
  echo "<script>window.location.replace('access_closed.php')</script>";

}
?> 

<script>
    $(document).ready(function(){
     $('#sc_acctno').mask('00-00000');
     $('#sc_acctno').mask('00-00000');
    });
</script>

<?php
   function RemoveSpecialChar($str) {
 
    // Using str_replace() function
    // to replace the word
    $res = str_replace( array( '\'', '"' ), ' ', $str);
  
    // Returning the result
    return $res;
    }
if (isset($_POST['SUBMIT_USER'])) {


$sc_acctno = $_POST['sc_acctno'];
$passcode = RemoveSpecialChar($_POST['passcode']);

$sql_t = pg_query($db, "select * from election_voted where sc_acctno='$sc_acctno';") or die ("Could not match data because ".pg_last_error());
$numt=pg_num_rows($sql_t);


$sql_check = pg_query($db, "select * from election_user where sc_acctno='$sc_acctno' and passcode='$passcode';") or die ("Could not match data because ".pg_last_error());
$num=pg_num_rows($sql_check);


$sql_notvoter = pg_query($db, "select * from election_user where sc_acctno='$sc_acctno';") or die ("Could not match data because ".pg_last_error());
$num_notvoter=pg_num_rows($sql_notvoter);

$row = pg_fetch_assoc($sql_check);

 if ($num==1 && $numt==0){ 

    $_SESSION['sc_acctno'] = $row['sc_acctno']; 
    $_SESSION['passcode'] = $row['passcode']; 
    $_SESSION['user_id'] = $row['user_id']; 
    //echo "<script>alert('login failed!');</script>";

    //header('Location: agreement1.php');
    echo "<script>window.location.replace('agreement1.php')</script>";

   //header('Location: MIGS_inquiry.php');

 }
 elseif ($num==1 && $numt==1){ 
   echo "";
 } 
 else {

      session_unset();
      session_destroy();
     // echo "<script>alert('Login failed');</script>";

 }



}
?> 



</head>

<body>




<div class="container">
<BR>
<?php
include "title.php";
?>
  <?php
    if (isset($_POST['SUBMIT_USER']) && $numt==1) {
      echo "<div class='alert alert-info'>";
      echo "<strong>Unable to login, already voted</strong>";
      echo "</div>";
    }      
    elseif (isset($_POST['SUBMIT_USER']) && $num==0 && $num_notvoter==1) {
      echo "<div class='alert alert-danger'>";
      echo "<strong>Login failed</strong>";
      echo "</div>";
    } 
    elseif (isset($_POST['SUBMIT_USER']) && $num==0 && $num_notvoter==0) {
      echo "<div class='alert alert-danger'>";
      echo "<strong>Not qualified to vote</strong>";
      echo "</div>";
    }          
  ?> 
  <br><BR>
   <h3 class="text-center"><?php echo "".$yeardiff."<sup>nd</sup> SDCC General Election Login"; ?></h3>
  <br>
 <form autocomplete="off" role="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">




 <div class="row text-center">
 <div class="col-2">           
  </div>  
 <div class="col-3 text-right">
    
    <b>Account No.:</b>
    

 </div> 
  <div class="col-3  mx-auto p-0">           
       <input type="text" class="form-control" placeholder="Account No."  name="sc_acctno" id="sc_acctno" required  >   
  </div>
  <div class="col-3">           
  </div>     
</div>         
<br>
<div class="row text-center">
 <div class="col-2">           
  </div>  
 <div class="col-3 text-right">
    
    <b>Passcode:</b>
    

 </div> 
  <div class="col-3 mx-auto p-0">           
      <input type="password"  class="form-control" placeholder="Passcode"  name="passcode" id="passcode"  required  >
  </div>
  <div class="col-3">           
  </div>     
</div>  




  <br>
   
    <BR>
    <div class="row">

      <div class="col-12 text-center">
            <button type="submit" class="btn btn-primary" id="SUBMIT" name="SUBMIT_USER">Log In</button>
      </div> 
  
    </div> 

<br></br>
<div class='col text-center'><a href='MIGS_check.php'  class='btn btn-success'>MIGS Checking</a>
         
</div>         





 </form>
<BR><BR><BR><BR><BR><BR>
<?php
include "footer.php";
?>
</body>
</html>
