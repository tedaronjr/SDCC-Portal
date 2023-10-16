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
    <title><?php echo $yeardiff."nd SDCC General Election Admin Login"; ?></title>
<?php
include "scriptlink.php";

setlocale(LC_MONETARY,"en_PH.UTF-8"); 

include "db_connect.php";

?> 



<?php

if (isset($_POST['SUBMIT_USER'])) {


$admin_user  = $_POST['admin_user'];
$admin_pass = $_POST['admin_pass'];




$sql_check = pg_query($db, "select * from election_admin where admin_user='$admin_user' and admin_pass='$admin_pass';") or die ("Could not match data because ".pg_last_error());
$num=pg_num_rows($sql_check);




$row = pg_fetch_assoc($sql_check);

 if ($num==1 ){ 

    $_SESSION['admin_user'] = $row['admin_user']; 
    $_SESSION['admin_pass'] = $row['admin_pass']; 

    //echo "<script>alert('login failed!');</script>";

    //header('Location: election_admin.php');
    echo "<script>window.location.replace('election_admin.php')</script>";

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
  if (isset($_POST['SUBMIT_USER']) && $num==0 ) {
      echo "<div class='alert alert-danger'>";
      echo "<strong>Login failed</strong>";
      echo "</div>";
    } 
        
  ?> 
  <br><BR>
   <h3 class="text-center"><?php echo "".$yeardiff."<sup>nd</sup> SDCC General Election Admin Login"; ?></h3>
  <br>
 <form autocomplete="off" role="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">




 <div class="row text-center">
 <div class="col-2">           
  </div>  
 <div class="col-3 text-right">
    
    <b>User:</b>
    

 </div> 
  <div class="col-3  mx-auto p-0">           
       <input type="text" class="form-control" placeholder=""  name="admin_user" id="sc_acctno" required  >   
  </div>
  <div class="col-3">           
  </div>     
</div>         
<br>
<div class="row text-center">
 <div class="col-2">           
  </div>  
 <div class="col-3 text-right">
    
    <b>Password:</b>
    

 </div> 
  <div class="col-3 mx-auto p-0">           
      <input type="password" class="form-control" placeholder=""  name="admin_pass" id="passcode"  required  >
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







 </form>
<BR><BR><BR><BR><BR><BR>
<?php
include "footer.php";
?>
</body>
</html>
