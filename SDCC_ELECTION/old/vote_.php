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

$sql_position = pg_query($db, "select * from election_position where title_id=$row_title[title_id];") or die ("Could not match data because ".pg_last_error());
$row_pos = pg_fetch_assoc($sql_position);

?>

<script type="text/javascript">
    function d1control(j) {
        var total=0;
            for(var i=0; i < document.form1.elements["d1[]"].length; i++){
                if(document.form1.elements["d1[]"][i].checked){
                    total =total +1;
                }
                if(total > 3){
                    alert("Please Select only three") 
                    document.form1.elements["d1[]"][j].checked = false ;
                    return false;
                }
            }
    } 
</script>

</head>

<body>




<div class="container">
  <BR>
  <h1><span STYLE="color:blue;">SAN DIONISIO CREDIT COOPERATIVE</span></h1><hr>
  <br><BR>
   <h2 class="text-center"><?php echo $row_title['title_name']; ?></h2>
  <br>
  <form name=form1 autocomplete="off" role="form" method="post" >

  <div id="accordion">
    <div class="card">
      <div class="card-header">
        <a class="card-link" data-toggle="collapse" href="#collapseOne">
          <?php echo $row_pos['position_name']; ?>
        </a>
      </div>
    <div id="collapseOne" class="collapse show" data-parent="#accordion">
      <div class="card-body">
      <table class="table table-hover">
      <tbody>
<?php 
$sql_nominee = pg_query($db, "select * from election_nominee where position_id=$row_pos[position_id] order by nominee_name;") or die ("Could not match data because ".pg_last_error());
 
$d=0;
  while($row = pg_fetch_assoc($sql_nominee)) 
    {
      echo "<tr><td><input type='checkbox' class='form-check-input'  name=d1[] value=$row[nominee_id] onclick='d1control($d)'; >$row[nominee_name]</td></tr>";
      $d=$d+1;
    }                       
?>

</tbody>
</table>      
      </div>
    </div>

    <div class="card">
      <div class="card-header">
        <a class="card-link" data-toggle="collapse" href="#collapseOne">
          <?php $row_pos = pg_fetch_assoc($sql_position); echo $row_pos['position_name']; ?>
        </a>
      </div>
    <div id="collapseOne" class="collapse show" data-parent="#accordion">
      <div class="card-body">
      <table class="table table-hover">
      <tbody>
<?php 
$sql_nominee = pg_query($db, "select * from election_nominee where position_id=$row_pos[position_id] order by nominee_name;") or die ("Could not match data because ".pg_last_error());

  while($row = pg_fetch_assoc($sql_nominee)) 
    {
      echo "<tr><td>$row[nominee_name]</td></tr>";
    }                       
?>
</tbody>
</table>   
      </div>
    </div>    
  </div>

  </form>

</div>  






<BR><BR><BR><BR><BR><BR>
<?php
include "footer.php";
?>
</body>
</html>
