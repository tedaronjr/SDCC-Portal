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

 


//$sql_title = pg_query($db, "select * from election_title where closed='F' LIMIT 1;") or die ("Could not match data because ".pg_last_error());
//$num_title=pg_num_rows($sql_title);
$row_title = pg_fetch_assoc($sql_lock);

$sql_max = pg_query($db, "select sum(max_selection) as total_sel from election_position where title_id=$row_title[title_id];") or die ("Could not match data because ".pg_last_error());
$row_max = pg_fetch_assoc($sql_max);
$sql_position = pg_query($db, "select * from election_position where title_id=$row_title[title_id] order by position_id;") or die ("Could not match data because ".pg_last_error());

?>

<script type="text/javascript">
    function d1control(j,v) {
        var total1=0;
            for(var i=0; i < document.form1.elements["d1[]"].length; i++){
                if(document.form1.elements["d1[]"][i].checked){
                    total1 =total1 +1;
                }
                if(total1 > v){
                  $("#simpleModal").modal('show');
                   // alert("Vote more than " + v + " are not allowed") 
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
                  $("#simpleModal").modal('show');
                    //alert("Vote more than " + v + " are not allowed")  
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
                  $("#simpleModal").modal('show');
                    //alert("Vote more than " + v + " are not allowed")  
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
                  $("#simpleModal").modal('show');
                    //alert("Vote more than " + v + " are not allowed")  
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
                  $("#simpleModal").modal('show');
                    //alert("Vote more than " + v + " are not allowed")  
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
    if (d1Checked != $('#d1pos').val()) {
      $("#error_d1").html("<div class='alert alert-danger'><b>Does not match the required votes</b></div>");
      $('#error_d1').focus();
    }
    else
      $("#error_d1").html("");

    var d2Checked =$('input[name="d2[]"]:checked').length;
    if (d2Checked != $('#d2pos').val()) {
      $("#error_d2").html("<div class='alert alert-danger'><b>Does not match the required votes</b></div>");
      $('#error_d2').focus();
    }
    else
      $("#error_d2").html("");

    var d3Checked =$('input[name="d3[]"]:checked').length;
    if (d3Checked != $('#d3pos').val()) {
      $("#error_d3").html("<div class='alert alert-danger'><b>Does not match the required votes</b></div>");
      $('#error_d3').focus();
    }
    else
      $("#error_d3").html("");              

    var d4Checked =$('input[name="d4[]"]:checked').length;
    if (d4Checked != $('#d4pos').val()) {
      $("#error_d4").html("<div class='alert alert-danger'><b>Does not match the required votes</b></div>");
      $('#error_d4').focus();
    }
    else
      $("#error_d4").html("");

    var d5Checked =$('input[name="d5[]"]:checked').length;
    if (d5Checked != $('#d5pos').val()) {
      $("#error_d5").html("<div class='alert alert-danger'><b>Does not match the required votes</b></div>");
      $('#error_d5').focus();
    }
    else
      $("#error_d5").html("");

    var numberOfChecked =d1Checked + d2Checked + d3Checked + d4Checked + d5Checked;
     
    if (numberOfChecked == $('#maxpos').val()) {
      //$('#form1').attr('action','vote_confirmation.php'); 
      $(this).parents('form').submit()
      //alert(numberOfChecked);
    } 
   // else 
     //alert("Can't submit vote.Pls. check vote required.");
   
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
  <?php
include "title.php";
?>
  <br><BR>
   <h2 class="text-center"><?php echo $row_title['title_name']; ?></h2><hr>
  <br>
  <form name=form1 id=form1 autocomplete="off" role="form" method="post" action='vote_confirmation.php'  >

  <h4 class="text-center"><?php $row_pos = pg_fetch_assoc($sql_position);
        echo $row_pos['position_name']."  ".$row_pos['description']; ?></h4><hr>
  <b  class="text-danger">  
  <?php 
  if ($row_pos['max_selection']== 1)
   echo "<i>Isang ($row_pos[max_selection]) boto lamang [One ($row_pos[max_selection]) vote required]</i>"; 
  elseif  ($row_pos['max_selection']== 2)
   echo "<i>Dalawang ($row_pos[max_selection]) boto lamang [Required vote two ($row_pos[max_selection])]</i>";    
  ?>
  </b>
  <div id="error_d1" tabindex='1'></div>
  <input type="hidden" id="d1pos" name="d1pos" value="<?php echo $row_pos['max_selection'];?>">
      
  <div class="row row-bordered">
    <div class="col-4 text-center"></div> 
    <div class="col-8"></div>            
  </div>

  <?php 
$sql_nominee = pg_query($db, "select  nominee_id, initcap(nominee_name) as nominee_name, remarks, mem_no, position_id from election_nominee where position_id=$row_pos[position_id] order by nominee_id;") or die ("Could not match data because ".pg_last_error());
 
$d=0;
  while($row = pg_fetch_assoc($sql_nominee)) 
    {
      //<div class='col-4 text-center' data-toggle='tooltip' data-placement=right title='vote $row[nominee_name]'>
      echo "
      <div class='row  row-bordered'>
      <div class='col-4 text-center'>
      <input style='width: 20px; height: 16px;' type='checkbox' id=$row[mem_no]  class='form-check-input'  name=d1[] value=$row[nominee_id] onclick='d1control($d,$row_pos[max_selection])'; >
      <label for=$row[mem_no]><img src='GE/$row[mem_no].jpg' width='100' height='100' /></label>
      </div>
      <div class='col-8'>
      <h2>$row[nominee_name]</h2>
      </div>
      </div>";
      $d=$d+1;
    }                       
  ?>
   
<!-----------  ----->  
<br>
<h4 class="text-center"><?php $row_pos = pg_fetch_assoc($sql_position);
        echo $row_pos['position_name']."  ".$row_pos['description']; ?></h4><hr>
  <b  class="text-danger">  
  <?php 
  if ($row_pos['max_selection']== 1)
  echo "<i>Isang ($row_pos[max_selection]) boto lamang [One ($row_pos[max_selection]) vote required]</i>"; 
 elseif  ($row_pos['max_selection']== 2)
  echo "<i>Dalawang ($row_pos[max_selection]) boto lamang [Required vote two ($row_pos[max_selection])]</i>";   
  ?>
  </b> 
  <div id="error_d2" tabindex='2'></div>
  <input type="hidden" id="d2pos" name="d2pos" value="<?php echo $row_pos['max_selection'];?>">
     
  <div class="row  row-bordered">
    <div class="col-4 text-center"></div> 
    <div class="col-8"></div>            
  </div>

  <?php 
$sql_nominee = pg_query($db, "select  nominee_id, initcap(nominee_name) as nominee_name, remarks, mem_no, position_id from election_nominee where position_id=$row_pos[position_id] order by nominee_id;") or die ("Could not match data because ".pg_last_error());
 
$d=0;
  while($row = pg_fetch_assoc($sql_nominee)) 
    {
      echo "
      <div class='row  row-bordered'>
      <div class='col-4 text-center'>
      <input style='width: 20px; height: 16px;' type='checkbox' id=$row[mem_no] class='form-check-input'  name=d2[] value=$row[nominee_id] onclick='d2control($d,$row_pos[max_selection])'; >
      <label for=$row[mem_no]><img src='GE/$row[mem_no].jpg' width='100' height='100' /></label>
      </div>
      <div class='col-8'>
      <h2>$row[nominee_name]</h2>
      </div>
      </div>";
      $d=$d+1;
    }                       
  ?>
   
<!-----------  ----->  

<br>
<h4 class="text-center"><?php $row_pos = pg_fetch_assoc($sql_position);
        echo $row_pos['position_name']."  ".$row_pos['description']; ?></h4><hr>
  <b  class="text-danger">  
  <?php 
  if ($row_pos['max_selection']== 1)
  echo "<i>Isang ($row_pos[max_selection]) boto lamang [One ($row_pos[max_selection]) vote required]</i>"; 
 elseif  ($row_pos['max_selection']== 2)
  echo "<i>Dalawang ($row_pos[max_selection]) boto lamang [Required vote two ($row_pos[max_selection])]</i>";   
  ?>
  </b> 
  <div id="error_d3" tabindex='3'></div>

  <input type="hidden" id="d3pos" name="d3pos" value="<?php echo $row_pos['max_selection'];?>">
     
  <div class="row  row-bordered">
    <div class="col-4 text-center"></div> 
    <div class="col-8"></div>            
  </div>

  <?php 
$sql_nominee = pg_query($db, "select  nominee_id, initcap(nominee_name) as nominee_name, remarks, mem_no, position_id from election_nominee where position_id=$row_pos[position_id] order by nominee_id;") or die ("Could not match data because ".pg_last_error());
 
$d=0;
  while($row = pg_fetch_assoc($sql_nominee)) 
    {
      echo "
      <div class='row  row-bordered'>
      <div class='col-4 text-center' >
      <input style='width: 20px; height: 16px;' type='checkbox' id=$row[mem_no] class='form-check-input'  name=d3[] value=$row[nominee_id] onclick='d3control($d,$row_pos[max_selection])'; >
      <label for=$row[mem_no]><img src='GE/$row[mem_no].jpg' width='100' height='100' /></label>
      </div>
      <div class='col-8'>
      <h2>$row[nominee_name]</h2>
      </div>
      </div>";
      $d=$d+1;
    }                       
  ?>
   
<!-----------  ----->  

<br>
<h4 class="text-center"><?php $row_pos = pg_fetch_assoc($sql_position);
        echo $row_pos['position_name']."  ".$row_pos['description']; ?></h4><hr>
  <b  class="text-danger">  
  <?php 
  if ($row_pos['max_selection']== 1)
  echo "<i>Isang ($row_pos[max_selection]) boto lamang [One ($row_pos[max_selection]) vote required]</i>"; 
 elseif  ($row_pos['max_selection']== 2)
  echo "<i>Dalawang ($row_pos[max_selection]) boto lamang [Required vote two ($row_pos[max_selection])]</i>";   
  ?>
  </b>
  <div id="error_d4" tabindex='4'></div>
  <input type="hidden" id="d4pos" name="d4pos" value="<?php echo $row_pos['max_selection'];?>">
      
  <div class="row  row-bordered">
    <div class="col-4 text-center"></div> 
    <div class="col-8"></div>            
  </div>

  <?php 
$sql_nominee = pg_query($db, "select  nominee_id, initcap(nominee_name) as nominee_name, remarks, mem_no, position_id from election_nominee where position_id=$row_pos[position_id] order by nominee_id;") or die ("Could not match data because ".pg_last_error());
 
$d=0;
  while($row = pg_fetch_assoc($sql_nominee)) 
    {
      echo "
      <div class='row  row-bordered'>
      <div class='col-4 text-center' >
      <input style='width: 20px; height: 16px;' type='checkbox' id=$row[mem_no] class='form-check-input'  name=d4[] value=$row[nominee_id] onclick='d4control($d,$row_pos[max_selection])'; >
      <label for=$row[mem_no]><img src='GE/$row[mem_no].jpg' width='100' height='100' /></label>
      </div>
      <div class='col-8'>
      <h2>$row[nominee_name]</h2>
      </div>
      </div>";
      $d=$d+1;
    }                       
  ?>
   
<!-----------  ----->  

<br>
<h4 class="text-center"><?php $row_pos = pg_fetch_assoc($sql_position);
        echo $row_pos['position_name']."  ".$row_pos['description']; ?></h4><hr>
  <b  class="text-danger">  
  <?php 
  if ($row_pos['max_selection']== 1)
  echo "<i>Isang ($row_pos[max_selection]) boto lamang [One ($row_pos[max_selection]) vote required]</i>"; 
 elseif  ($row_pos['max_selection']== 2)
  echo "<i>Dalawang ($row_pos[max_selection]) boto lamang [Required vote two ($row_pos[max_selection])]</i>";   
  ?>
  </b>
  <div id="error_d5" tabindex='5'></div>
  <input type="hidden" id="d5pos" name="d5pos" value="<?php echo $row_pos['max_selection'];?>">
     
  <div class="row  row-bordered">
    <div class="col-4 text-center"></div> 
    <div class="col-8"></div>            
  </div>

  <?php 
$sql_nominee = pg_query($db, "select nominee_id, initcap(nominee_name) as nominee_name, remarks, mem_no, position_id from election_nominee where position_id=$row_pos[position_id] order by nominee_id;") or die ("Could not match data because ".pg_last_error());
 
$d=0;
  while($row = pg_fetch_assoc($sql_nominee)) 
    {
      echo "
      <div class='row  row-bordered'>
      <div class='col-4 text-center' >
      <input style='width: 20px; height: 16px;' type='checkbox' id=$row[mem_no] class='form-check-input'  name=d5[] value=$row[nominee_id] onclick='d5control($d,$row_pos[max_selection])'; >
      <label for=$row[mem_no]><img src='GE/$row[mem_no].jpg' width='100' height='100' /></label>
      </div>
      <div class='col-8'>
      <h2>$row[nominee_name]</h2>
      </div>
      </div>";
      $d=$d+1;
    }                       
  ?>
   
<!-----------  ----->  
<input type="hidden" id="maxpos" name="maxpos" value="<?php echo $row_max['total_sel'] ?>">

<BR><BR><BR>
<div class="col text-center">
   <button type="button" class="btn btn-primary" id="submit_vote"  name="submit_vote">Submit</button>
   <a  class="btn btn-primary" href="voters_login.php">Cancel</a>
 </div>
 
</form>


<div id="simpleModal" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title text-danger"></h1>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h1 class="text-danger">Exceeded required votes</h1>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<BR><BR><BR>
<?php
include "footer.php";
?>
</div>
</body>
</html>
