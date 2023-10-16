<?php
include "user_session.php";
?>

<!DOCTYPE html>
<html>
<head>



    <title>VOTE</title>
<?php
include "scriptlink.php";

setlocale(LC_MONETARY,"en_PH.UTF-8"); 
?> 

<?php

 


$sql_title = pg_query($db, "select * from election_title where closed='F' LIMIT 1;") or die ("Could not match data because ".pg_last_error());
$num_title=pg_num_rows($sql_title);
$row_title = pg_fetch_assoc($sql_title);

$sql_max = pg_query($db, "select sum(max_selection) as total_sel from election_position where title_id=$row_title[title_id];") or die ("Could not match data because ".pg_last_error());
$row_max = pg_fetch_assoc($sql_max);
$sql_position = pg_query($db, "select * from election_position where title_id=$row_title[title_id];") or die ("Could not match data because ".pg_last_error());

?>

<script type="text/javascript">
    function d1control(j,v) {
        var total1=0;
            for(var i=0; i < document.form1.elements["d1[]"].length; i++){
                if(document.form1.elements["d1[]"][i].checked){
                    total1 =total1 +1;
                }
                if(total1 > v){
                    //alert(v + "required vote") 
                    document.form1.elements["d1[]"][j].checked = false ;
                    return false;
                }
            }            
    } 

    function d2control(j,v) {
        var total=0;
            for(var i=0; i < document.form1.elements["d2[]"].length; i++){
                if(document.form1.elements["d2[]"][i].checked){
                    total =total +1;
                }
                if(total > v){
                    //alert(v + "required vote") 
                    document.form1.elements["d2[]"][j].checked = false ;
                    return false;
                }
            }
    }   

    function d3control(j,v) {
        var total=0;
            for(var i=0; i < document.form1.elements["d3[]"].length; i++){
                if(document.form1.elements["d3[]"][i].checked){
                    total =total +1;
                }
                if(total > v){
                    //alert(v + "required vote") 
                    document.form1.elements["d3[]"][j].checked = false ;
                    return false;
                }
            }
    }  
    
    function d4control(j,v) {
        var total=0;
            for(var i=0; i < document.form1.elements["d4[]"].length; i++){
                if(document.form1.elements["d4[]"][i].checked){
                    total =total +1;
                }
                if(total > v){
                    //alert(v + "required vote") 
                    document.form1.elements["d4[]"][j].checked = false ;
                    return false;
                }
            }
    }
    
    function d5control(j,v) {
        var total=0;
            for(var i=0; i < document.form1.elements["d5[]"].length; i++){
                if(document.form1.elements["d5[]"][i].checked){
                    total =total +1;
                }
                if(total > v){
                    //alert(v + "required vote") 
                    document.form1.elements["d5[]"][j].checked = false ;
                    return false;
                }
            }
    }      
   /*
    function myFunction() {
       
        var x = document.getElementById("myDIV");
        if (x.style.display === "none") {
          x.style.display = "block";
        } else {
          x.style.display = "none";
        }
     
    }    
  */

</script>
<script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
  
  $('#submit_vote').click(function(){
    var d1Checked =$('input[name="d1[]"]:checked').length;
    var d2Checked =$('input[name="d2[]"]:checked').length;
    var d3Checked =$('input[name="d3[]"]:checked').length;
    var d4Checked =$('input[name="d4[]"]:checked').length;
    var d5Checked =$('input[name="d5[]"]:checked').length;
    var numberOfChecked =d1Checked + d2Checked + d3Checked + d4Checked + d5Checked;
     
    if (numberOfChecked == $('#maxpos').val()) {
      //$('#form1').attr('action','vote_confirmation.php'); 
      $(this).parents('form').submit()
      //alert(numberOfChecked);
    } 
    else 
     alert("Can't submit vote.Pls. check vote required.");
   
  });

   
  /*
  var numberOfChecked =$('input[name="d1[]"]:checked');
  alert(numberOfChecked.length);
  if (numberOfChecked.length == 1) {
    $('#myDIV').show();
    alert(numberOfChecked);
  }  
  */
});
</script>
<?php
/*
if (isset($_POST['submit_vote'])) {

 
if(empty($_POST['d1'])) {
  echo "<script>alert('no vote'); window.location.href = 'vote.php';</script>";
  //header('Location: vote.php');
  //  die("Given Array is empty");
}
elseif(!empty($_POST['d1'])) {
  foreach ($_POST['d1'] as $key => $nominee_id) {
    $sql_vote = pg_query($db, "insert into election_vote (nominee_id,user_id) values ($nominee_id,$_SESSION[user_id]);") or die ("Could not match data because ".pg_last_error());
  }  
}
 // $id = implode(",", $_POST['d1']);
 // echo $id; //Should print "1,2,3"

 
}
*/
?>

<style>
  .row-bordered {
  position: relative;
}

.row-bordered:after {
  content: "";
  display: block;
  border-bottom: 1px solid #ccc;
  position: absolute;
  bottom: 0;
  left: 15px;
  right: 15px;
}
</style>

</head>

<body>




<div class="container">
  <BR>
  <h1><span STYLE="color:blue;">SAN DIONISIO CREDIT COOPERATIVE</span></h1><hr>
  <br><BR>
   <h2 class="text-center"><?php echo $row_title['title_name']; ?></h2>
  <br>
  <form name=form1 id=form1 autocomplete="off" role="form" method="post" action='vote_confirmation.php'  >

  <h4><?php $row_pos = pg_fetch_assoc($sql_position);
        echo $row_pos['position_name']."  ".$row_pos['description']; ?></h4><hr>
  <b  class="text-danger">  
  <?php 
  if ($row_pos['max_selection']> 1)
   echo "Required votes -  $row_pos[max_selection]"; 
  else 
   echo "Required vote -  $row_pos[max_selection]"; 
  ?>
  </b>      
  <div class="row row-bordered">
    <div class="col-4 text-center">Check box</div> 
    <div class="col-8">Candidate</div>            
  </div>

  <?php 
$sql_nominee = pg_query($db, "select * from election_nominee where position_id=$row_pos[position_id] order by nominee_name;") or die ("Could not match data because ".pg_last_error());
 
$d=0;
  while($row = pg_fetch_assoc($sql_nominee)) 
    {
      //<div class='col-4 text-center' data-toggle='tooltip' data-placement=right title='vote $row[nominee_name]'>
      echo "
      <div class='row  row-bordered'>
      <div class='col-4 text-center'>
      <input style='width: 20px; height: 16px;' type='checkbox'  class='form-check-input'  name=d1[] value=$row[nominee_id] onclick='d1control($d,$row_pos[max_selection])'; >
      </div>
      <div class='col-8'>
      <b>$row[nominee_name]</b>
      </div>
      </div>";
      $d=$d+1;
    }                       
  ?>
   
<!-----------  ----->  
<br>
<h4><?php $row_pos = pg_fetch_assoc($sql_position);
        echo $row_pos['position_name']."  ".$row_pos['description']; ?></h4><hr>
  <b  class="text-danger">  
  <?php 
  if ($row_pos['max_selection']> 1)
   echo "Required votes -  $row_pos[max_selection]"; 
  else 
   echo "Required vote -  $row_pos[max_selection]"; 
  ?>
  </b>      
  <div class="row  row-bordered">
    <div class="col-4 text-center">Check box</div> 
    <div class="col-8">Candidate</div>            
  </div>

  <?php 
$sql_nominee = pg_query($db, "select * from election_nominee where position_id=$row_pos[position_id] order by nominee_name;") or die ("Could not match data because ".pg_last_error());
 
$d=0;
  while($row = pg_fetch_assoc($sql_nominee)) 
    {
      echo "
      <div class='row  row-bordered'>
      <div class='col-4 text-center'>
      <input style='width: 20px; height: 16px;' type='checkbox' class='form-check-input'  name=d2[] value=$row[nominee_id] onclick='d2control($d,$row_pos[max_selection])'; >
      </div>
      <div class='col-8'>
      <b>$row[nominee_name]</b>
      </div>
      </div>";
      $d=$d+1;
    }                       
  ?>
   
<!-----------  ----->  

<br>
<h4><?php $row_pos = pg_fetch_assoc($sql_position);
        echo $row_pos['position_name']."  ".$row_pos['description']; ?></h4><hr>
  <b  class="text-danger">  
  <?php 
  if ($row_pos['max_selection']> 1)
   echo "Required votes -  $row_pos[max_selection]"; 
  else 
   echo "Required vote -  $row_pos[max_selection]"; 
  ?>
  </b>      
  <div class="row  row-bordered">
    <div class="col-4 text-center">Check box</div> 
    <div class="col-8">Candidate</div>            
  </div>

  <?php 
$sql_nominee = pg_query($db, "select * from election_nominee where position_id=$row_pos[position_id] order by nominee_name;") or die ("Could not match data because ".pg_last_error());
 
$d=0;
  while($row = pg_fetch_assoc($sql_nominee)) 
    {
      echo "
      <div class='row  row-bordered'>
      <div class='col-4 text-center' >
      <input style='width: 20px; height: 16px;' type='checkbox' class='form-check-input'  name=d3[] value=$row[nominee_id] onclick='d3control($d,$row_pos[max_selection])'; >
      </div>
      <div class='col-8'>
      <b>$row[nominee_name]</b>
      </div>
      </div>";
      $d=$d+1;
    }                       
  ?>
   
<!-----------  ----->  

<br>
<h4><?php $row_pos = pg_fetch_assoc($sql_position);
        echo $row_pos['position_name']."  ".$row_pos['description']; ?></h4><hr>
  <b  class="text-danger">  
  <?php 
  if ($row_pos['max_selection']> 1)
   echo "Required votes -  $row_pos[max_selection]"; 
  else 
   echo "Required vote -  $row_pos[max_selection]"; 
  ?>
  </b>      
  <div class="row  row-bordered">
    <div class="col-4 text-center">Check box</div> 
    <div class="col-8">Candidate</div>            
  </div>

  <?php 
$sql_nominee = pg_query($db, "select * from election_nominee where position_id=$row_pos[position_id] order by nominee_name;") or die ("Could not match data because ".pg_last_error());
 
$d=0;
  while($row = pg_fetch_assoc($sql_nominee)) 
    {
      echo "
      <div class='row  row-bordered'>
      <div class='col-4 text-center' >
      <input style='width: 20px; height: 16px;' type='checkbox' class='form-check-input'  name=d4[] value=$row[nominee_id] onclick='d4control($d,$row_pos[max_selection])'; >
      </div>
      <div class='col-8'>
      <b>$row[nominee_name]</b>
      </div>
      </div>";
      $d=$d+1;
    }                       
  ?>
   
<!-----------  ----->  

<br>
<h4><?php $row_pos = pg_fetch_assoc($sql_position);
        echo $row_pos['position_name']."  ".$row_pos['description']; ?></h4><hr>
  <b  class="text-danger">  
  <?php 
  if ($row_pos['max_selection']> 1)
   echo "Required votes -  $row_pos[max_selection]"; 
  else 
   echo "Required vote -  $row_pos[max_selection]"; 
  ?>
  </b>      
  <div class="row  row-bordered">
    <div class="col-4 text-center">Check box</div> 
    <div class="col-8">Candidate</div>            
  </div>

  <?php 
$sql_nominee = pg_query($db, "select * from election_nominee where position_id=$row_pos[position_id] order by nominee_name;") or die ("Could not match data because ".pg_last_error());
 
$d=0;
  while($row = pg_fetch_assoc($sql_nominee)) 
    {
      echo "
      <div class='row  row-bordered'>
      <div class='col-4 text-center' >
      <input style='width: 20px; height: 16px;' type='checkbox' class='form-check-input'  name=d5[] value=$row[nominee_id] onclick='d5control($d,$row_pos[max_selection])'; >
      </div>
      <div class='col-8'>
      <b>$row[nominee_name]</b>
      </div>
      </div>";
      $d=$d+1;
    }                       
  ?>
   
<!-----------  ----->  
<input type="hidden" id="maxpos" name="maxpos" value="<?php echo $row_max['total_sel'] ?>">

<BR><BR><BR>
<div class="col text-center">
   <button type="button" class="btn btn-primary" id="submit_vote"  name="submit_vote">Submit Vote</button>
   <a  class="btn btn-primary" href="voters_login.php">Cancel</a>
 </div>
 
</form>




<BR><BR><BR>
<?php
include "footer.php";
?>
</div>
</body>
</html>
