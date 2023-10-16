<?php
include "user_session.php";
?>

<!DOCTYPE html>
<html>
<head>
    <title>VOTE CONFIRMATION</title>
<?php
include "scriptlink.php";

setlocale(LC_MONETARY,"en_PH.UTF-8"); 
?> 
<script>
$(document).ready(function(){
  $("#done").click(function(){

    window.location.href='voters_login.php';
   
  });
});
</script>


<?php

if (isset($_POST['maxpos'])) {

 
//if(empty($_POST['d1'])) {
  //echo "<script>alert('no vote'); window.location.href = 'vote.php';</script>";
//}
if(!empty($_POST['d1']) and !empty($_POST['d2']) and !empty($_POST['d3']) and !empty($_POST['d4']) and !empty($_POST['d5'])) {
  foreach ($_POST['d1'] as $key => $nominee_id) {
    $sql_vote = pg_query($db, "insert into election_vote (nominee_id,user_id) values ($nominee_id,$_SESSION[user_id]);") or die ("Could not match data because ".pg_last_error());
  }
  foreach ($_POST['d2'] as $key => $nominee_id) {
    $sql_vote = pg_query($db, "insert into election_vote (nominee_id,user_id) values ($nominee_id,$_SESSION[user_id]);") or die ("Could not match data because ".pg_last_error());
  }
  foreach ($_POST['d3'] as $key => $nominee_id) {
    $sql_vote = pg_query($db, "insert into election_vote (nominee_id,user_id) values ($nominee_id,$_SESSION[user_id]);") or die ("Could not match data because ".pg_last_error());
  }
  foreach ($_POST['d4'] as $key => $nominee_id) {
    $sql_vote = pg_query($db, "insert into election_vote (nominee_id,user_id) values ($nominee_id,$_SESSION[user_id]);") or die ("Could not match data because ".pg_last_error());
  }
  foreach ($_POST['d5'] as $key => $nominee_id) {
    $sql_vote = pg_query($db, "insert into election_vote (nominee_id,user_id) values ($nominee_id,$_SESSION[user_id]);") or die ("Could not match data because ".pg_last_error());
  } 
  
  $sql_upd = pg_query($db, "update election_user set ag1='T' WHERE user_id=$_SESSION[user_id];") or die ("Could not match data because ".pg_last_error());


}


 
}
?>

</head>

<body>




<div class="container">
  <BR>
  <h1><span STYLE="color:blue;">SAN DIONISIO CREDIT COOPERATIVE</span></h1><hr>
<!--  
  <br><BR>
   <h2 class="text-center"></h2>
  -->   
  <br>
  <form autocomplete="off" role="form" method="post" action="submit_ag2.php">

  <div class="row">
      <div class="col-xs-12">
        <b>Name:&nbsp;&nbsp;<?php echo $row['fullname']?> </b>
      </div>
  </div>  

  <div class="row">
      <div class="col-xs-12">
        <b>SC Account No:&nbsp;&nbsp;<?php echo $row['sc_acctno']?> </b>
      </div>
  </div>    

  <div class="row">
      <div class="col-xs-12">
        <b>PT No:&nbsp;&nbsp;<?php echo $row['pt_no']?> </b>
      </div>
  </div>    
<br>


    <div class="row">
      <div class="col-xs-12">

        <p>
        Matagumpay na naisumite ang inyong BOTO! Kayo ay kwalipikadong makapamili ng libreng mga produkto na nagkakahalaga ng Three Hundred Fifty Pesos (P350.00) sa alinmang tatlong (3) branch ng Botica De San Dionisio (BDSD) kung saan kayo mas malapit (SDCC Main Office, Satellite DASA, Satellite Las Pinas) simula Marso 21, 2023 hanggang Disyembre 31, 2023. Kinakailangang magpresenta ng valid I.D sa inyong pamimili sa BDSD.
      </p>
      </div>
    </div> 
    
    <div class="row">
      <div class="col-xs-12"> 
        <p>Inaasahan namin ang inyong patuloy na pakikilahok at pakikipagtulungan sa mga gawaing pang Kooperatiba.</p>
      </div>
    </div>  
    
    <div class="row">
      <div class="col-xs-12"> 
        <p>Maraming Salamat at pagpalain tayo ng Poong Maykapal.</p>
      </div>
    </div>     


   <br>
   <div class="col text-center">
    <button type="submit" class="btn btn-success"  name="done">Done</button>
   </div>

 






 </form>
 </div> 
<BR><BR><BR><BR><BR><BR>
<?php
include "footer.php";
?>
</body>
</html>
