<?php
include "user_session.php";
$year = date("Y");
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
  if(!empty($_POST['d1']) and !empty($_POST['d2']) and !empty($_POST['d3']) and !empty($_POST['d4']) and !empty($_POST['d5'])) {

$sql_vote = pg_query($db, "select jar_insertvote(
  ARRAY[".implode(",",$_POST['d1'])."]".
  ",ARRAY[".implode(",",$_POST['d2'])."]".
  ",ARRAY[".implode(",",$_POST['d3'])."]".
  ",ARRAY[".implode(",",$_POST['d4'])."]".
  ",ARRAY[".implode(",",$_POST['d5'])."]".
  ",$_SESSION[user_id],'$_SESSION[sc_acctno]');") or die ("Could not match data because ".pg_last_error());
}
  /*
  $sql_vote = pg_query($db, "select jar_insertvote(
    ".intval(json_encode($_POST['d1'])).
    ",".$_POST['d2'].
    ",".json_encode(intval($_POST['d3'])).
    ",".json_encode(intval($_POST['d4'])).
    ",".json_encode(intval($_POST['d5'])).
    ",$_SESSION[user_id],'$_SESSION[sc_acctno]'::varchar);") or die ("Could not match data because ".pg_last_error());
    */


 /*
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
  
$sql_upd = pg_query($db, "insert into election_voted (user_id,sc_acctno,updated_at) values ($_SESSION[user_id],'$_SESSION[sc_acctno]',current_timestamp);") or die ("<script>window.location.href='voters_login.php';</script>");


}
*/

 
}
?>

</head>

<body>




<div class="container">
  <BR>
  <?php
include "title.php";
?>
<!--  
  <br><BR>
   <h2 class="text-center"></h2>
  -->   
  <br>
  <form autocomplete="off" role="form" method="post" action="submit_ag2.php">

  <div class="row">
      <div class="col-12">
        Name:&nbsp;&nbsp;<b><?php echo $row['fullname']?> </b>
      </div>
  </div>  

  <div class="row">
      <div class="col-12">
        Account No.:&nbsp;&nbsp;<b><?php echo $row['sc_acctno']?> </b>
      </div>
  </div>    

  <div class="row">
      <div class="col-12">
        PT No.:&nbsp;&nbsp;<b><?php echo $row['pt_no']?> </b>
      </div>
  </div>    
<br>

<div class=text-center><b>Matagumpay na naisumite ang inyong BOTO!</b></div> 
<br>
    <div class="row">
      <div class="col-12">

        
Maaari ng i-claim ang inyong Election Giveaway sa 
alin mang tatlong branch ng <b>Botica de San Dionisio</b>
at <b>Tanza Satellite Office</b> 
kung saan kayo mas malapit  simula Marso 18, <?php echo $year; ?>
  hanggang Disyembre 31, <?php echo $year; ?>. 
Sa pag claim ng Election Giveaway kinakailangan 
magprisenta ng valid I.D. 
Para sa mga magpapaclaim sa kamag anak,
kinakailangang magdala ng Authorization letter 
at valid. I.D.

</div>
    </div> 
    <br>
    <div class="row">
      <div class="col-12"> 
      Inaasahan namin ang inyong patuloy na pakikilahok at pakikipagtulungan sa mga gawaing pang Kooperatiba.
      </div>
    </div>  
    <br>
    <div class="row">
      <div class="col-12"> 
      Maraming Salamat at pagpalain tayo ng Poong Maykapal.
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
     session_unset();
     session_destroy();

include "footer.php";
?>
</body>
</html>
