<?php
include "admin_session.php";
?>
<?php
date_default_timezone_set('Asia/Manila');
include "db_connect.php";
$year = date("Y");
?>

<!DOCTYPE html>
<html>
<head>



    <title>VOTE STATEMENT</title>
<?php
include "scriptlink.php";

setlocale(LC_MONETARY,"en_PH.UTF-8"); 
?> 

<?php

//$sql_maxvote12 = pg_query($db, "SELECT vote_count_,nominee_name_ from jar_stmtvote() where position_id_=1 order by vote_count_  desc offset 1 ;") or die ("Could not match data because ".pg_last_error());
$sql_maxvote1 = pg_query($db, "SELECT vote_count_,nominee_name_ from jar_stmtvote() where position_id_=1 order by vote_count_ desc limit 2;") or die ("Could not match data because ".pg_last_error());
$sql_maxvote2 = pg_query($db, "SELECT vote_count_,nominee_name_ from jar_stmtvote() where position_id_=2 order by vote_count_ desc limit 1;") or die ("Could not match data because ".pg_last_error());
$sql_maxvote3 = pg_query($db, "SELECT vote_count_,nominee_name_ from jar_stmtvote() where position_id_=3 order by vote_count_ desc limit 1;") or die ("Could not match data because ".pg_last_error());
$sql_maxvote4 = pg_query($db, "SELECT vote_count_,nominee_name_ from jar_stmtvote() where position_id_=4 order by vote_count_ desc limit 1;") or die ("Could not match data because ".pg_last_error());
$sql_maxvote5 = pg_query($db, "SELECT vote_count_,nominee_name_ from jar_stmtvote() where position_id_=5 order by vote_count_ desc limit 1;") or die ("Could not match data because ".pg_last_error());




$sql_vote = pg_query($db, "select TO_CHAR(count(*), 'fm999G999') as vote_num from election_vote;") or die ("Could not match data because ".pg_last_error());
$sql_migs = pg_query($db, "select TO_CHAR(count(*), 'fm999G999') as migs,count(*) as migscount from jar_coop_member where status_id=1;") or die ("Could not match data because ".pg_last_error());
$sql_notmigs = pg_query($db, "select TO_CHAR(count(*), 'fm999G999') as not_migs from jar_coop_member where status_id<>1;") or die ("Could not match data because ".pg_last_error());
$sql_member = pg_query($db, "select TO_CHAR(count(*), 'fm999G999') as mem_num from jar_coop_member ;") or die ("Could not match data because ".pg_last_error());
$sql_voted = pg_query($db, "select TO_CHAR(count(*), 'fm999G999') as vote_num,count(*) as votecount from election_voted;") or die ("Could not match data because ".pg_last_error());

$sql_stmtvote1 = pg_query($db, "select nominee_name_ as Candidate,vote_count_ as boto,remarks_ as Remarks  from  jar_stmtvote() where position_id_=1 order by nominee_id_ ;") or die ("Could not match data because ".pg_last_error());
$sql_pos1 = pg_query($db, "select max_selection from election_position where position_id=1 ;") or die ("Could not match data because ".pg_last_error());
$row_pos1 = pg_fetch_assoc($sql_pos1);
$num_stmtvote1=$row_pos1['max_selection'];



$sql_stmtvote2 = pg_query($db, "select nominee_name_ as Candidate,vote_count_ as boto,remarks_ as Remarks  from  jar_stmtvote() where position_id_=2 order by nominee_id_ ;") or die ("Could not match data because ".pg_last_error());
$sql_pos2 = pg_query($db, "select max_selection from election_position where position_id=2 ;") or die ("Could not match data because ".pg_last_error());
$row_pos2 = pg_fetch_assoc($sql_pos2);
$num_stmtvote2=$row_pos2['max_selection'];


$sql_stmtvote3 = pg_query($db, "select nominee_name_ as Candidate,vote_count_ as boto,remarks_ as Remarks  from  jar_stmtvote() where position_id_=3 order by nominee_id_ ;") or die ("Could not match data because ".pg_last_error());
$sql_pos3 = pg_query($db, "select max_selection from election_position where position_id=3 ;") or die ("Could not match data because ".pg_last_error());
$row_pos3 = pg_fetch_assoc($sql_pos3);
$num_stmtvote3=$row_pos3['max_selection'];

$sql_stmtvote4 = pg_query($db, "select nominee_name_ as Candidate,vote_count_ as boto,remarks_ as Remarks  from  jar_stmtvote() where position_id_=4 order by nominee_id_ ;") or die ("Could not match data because ".pg_last_error());
$sql_pos4 = pg_query($db, "select max_selection from election_position where position_id=4 ;") or die ("Could not match data because ".pg_last_error());
$row_pos4 = pg_fetch_assoc($sql_pos4);
$num_stmtvote4=$row_pos4['max_selection'];

$sql_stmtvote5 = pg_query($db, "select nominee_name_ as Candidate,vote_count_ as boto,remarks_ as Remarks  from  jar_stmtvote() where position_id_=5 order by nominee_id_ ;") or die ("Could not match data because ".pg_last_error());
$sql_pos5 = pg_query($db, "select max_selection from election_position where position_id=5 ;") or die ("Could not match data because ".pg_last_error());
$row_pos5 = pg_fetch_assoc($sql_pos5);
$num_stmtvote5=$row_pos5['max_selection'];

//$sql_comm = pg_query($db, "select * from election_comm ;") or die ("Could not match data because ".pg_last_error());
//$num_comm=pg_num_rows($sql_comm);
//$row_comm = pg_fetch_assoc($sql_comm);

/*
$num_vote=pg_num_rows($sql_vote);
$num_migs=pg_num_rows($sql_migs);
$num_notmigs=pg_num_rows($sql_notmigs);
$num_member=pg_num_rows($sql_member);
*/
$row_migs = pg_fetch_assoc($sql_migs);
$row_notmigs = pg_fetch_assoc($sql_notmigs);
$row_member = pg_fetch_assoc($sql_member);
$row_voted = pg_fetch_assoc($sql_voted);







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




    table {
        table-layout: fixed;
        word-wrap: break-word;
    }

        table th, table td {
            overflow: hidden;
        }



</style>

</head>

<body>




<div class="container"><br>
   <h3 class="text-center"><?php echo "San Dionisio Credit Cooperative"; ?></h2>
   <h4 class="text-center"><?php echo "0554 Quirino Avenue, San Dionisio, Parañaque City, Philippines"; ?></h4>
   <h5 class="text-center">As of <?php echo date('F j, Y h:i:s A');//echo date('F j, Y h:i:s A'); ?></h5>
 <br>
 <h5 class="text-center"><?php echo "62<sup>nd</sup> General Election (March 18-25,2023)"; ?></h5>

 <h5 class="text-center"><b>Report of the Election Committee</b></h5><hr>
     <div class="row">
      <div class="col-5">
        <b>Total no. of Members in Good Standing (MIGS):</b>
      </div>
      <div class="col-3">
        <b><?php echo $row_migs['migs']; ?></b>
      </div> 
      <div class="col-4">
      </div>    
    </div> 
    <hr>
    <div class="row">
      <div class="col-5">
        <b>Total no. of Members Not In Good Standing (NOT MIGS):</b>
      </div>
      <div class="col-3">
        <b><?php echo $row_notmigs['not_migs']; ?></b>
      </div> 
      <div class="col-4">
      </div>    
    </div> 
    <hr>    
    <div class="row">
      <div class="col-5">
        <b>Total no. of Members as of December 31,2022:</b>
      </div>
      <div class="col-3">
        <b><?php echo $row_member['mem_num'];  ?></b>
      </div> 
      <div class="col-4">
      </div>    
    </div> 
    <hr>
    <div class="row">
      <div class="col-5">
        <b>Total no. of Votes Casted:</b>
      </div>
      <div class="col-3">
        <b><?php echo $row_voted['vote_num'];  ?></b>
      </div> 
      <div class="col-4">
      </div>    
    </div> 
    <hr>
    <div class="row">
      <div class="col-5">
        <b>Percentage of Votes over <?php echo $row_migs['migs']; ?> MIGS:</b>
      </div>
      <div class="col-3">
        <b><?php echo round($row_voted['votecount']/$row_migs['migscount'],2) * 100;  ?>%</b>
      </div> 
      <div class="col-4">
      </div>    
    </div> 
    <hr>               
<br>
    <h5 class="text-center"><b>Official Results of <?php echo $year; ?> Annual General Election</b></h5><hr>
    <h6 class="text-center"><?php echo "March 18-25 $year / Online General Election"; ?></h6>
    <?php //echo "<span style='color:red;font-weight:bold;'>Date: </span>". date('F j, Y g:i:a  '); ?>
<br>
<div class="text-center"> <span  style=font-weight:bold;font-size:12pt;>Board of Directors</span></div>
<div class="text-center"> <span  style=font-weight:bold;font-size:12pt;>Electoral District I (San Dionisio) (<?php echo $num_stmtvote1; ?> lamang ang nahalal)</span></div>
<br>
<div class="table-responsive">
<?php    
    $i = 0;
    echo '<table  class="table table-striped table-bordered text-center"><thead><tr>';
    while ($i < pg_num_fields($sql_stmtvote1))
    {
	$fieldName = pg_field_name($sql_stmtvote1, $i); 
  if (ucfirst($fieldName)=="Boto")
	  echo '<td ALIGN=CENTER><strong>' . "Number of Votes" . "</strong></td>";
  else
	  echo '<td ALIGN=CENTER><strong>' . ucfirst($fieldName) . "</strong></td>";
	$i = $i + 1;
    }
    echo '</tr></thead><tbody>';
    $i = 0;
    $row_max = pg_fetch_assoc($sql_maxvote1);
    $row_max2 = pg_fetch_assoc($sql_maxvote1);

    while ($row = pg_fetch_assoc($sql_stmtvote1)) 
    {
        echo '<tr>';

            echo '<td ALIGN=center>' . $row['candidate'] . '</td>';
            echo '<td ALIGN=center>' . $row['boto'] . '</td>';
            if ($numlock==0 && $row_max['nominee_name_']==$row['candidate'] && $row_max['vote_count_']>0)
             echo '<td ALIGN=center>' . $row['remarks'] . '</td>';
            elseif ($numlock==0 && $row_max2['nominee_name_']==$row['candidate'] && $row_max2['vote_count_']>0)
             echo '<td ALIGN=center>' . $row['remarks'] . '</td>'; 
            else
             echo '<td ALIGN=center></td>';

        echo '</tr>';
        $i = $i + 1;
    }    
    echo "</tbody>";
    echo "</table>";
?> 
</div> 
<!--- -->
<br>
<div class="text-center"> <span  style=font-weight:bold;font-size:12pt;>Board of Directors</span></div>
<div class="text-center"> <span  style=font-weight:bold;font-size:12pt;>Electoral District II (San Isidro) (<?php echo $num_stmtvote2; ?> lamang ang nahalal)</span></div>
<br>
<div class="table-responsive">
<?php    
    $i = 0;
    echo '<table  class="table table-striped table-bordered text-center"><thead><tr>';
    while ($i < pg_num_fields($sql_stmtvote2))
    {
	$fieldName = pg_field_name($sql_stmtvote2, $i); 
  if (ucfirst($fieldName)=="Boto")
	  echo '<td ALIGN=CENTER><strong>' . "Number of Votes" . "</strong></td>";
  else
	  echo '<td ALIGN=CENTER><strong>' . ucfirst($fieldName) . "</strong></td>";
	$i = $i + 1;
    }
    echo '</tr></thead><tbody>';
    $i = 0;
    $row_max = pg_fetch_assoc($sql_maxvote2);
    while ($row = pg_fetch_assoc($sql_stmtvote2)) 
    {
        echo '<tr>';

            echo '<td ALIGN=center>' . $row['candidate'] . '</td>';
            echo '<td ALIGN=center>' . $row['boto'] . '</td>';
            if ($numlock==0 && $row_max['nominee_name_']==$row['candidate'] && $row_max['vote_count_']>0)
             echo '<td ALIGN=center>' . $row['remarks'] . '</td>';
            else
             echo '<td ALIGN=center></td>';

        echo '</tr>';
        $i = $i + 1;
    }     
    echo "</tbody>";
    echo "</table>";
?> 
</div> 
<!--- -->
<br>
<div class="text-center"> <span  style=font-weight:bold;font-size:12pt;>Board of Directors</span></div>
<div class="text-center"> <span  style=font-weight:bold;font-size:12pt;>Electoral District III (San Antonio at BF Homes) (<?php echo $num_stmtvote3; ?> lamang ang nahalal)</span></div>
<br>
<div class="table-responsive">
<?php    
    $i = 0;
    echo '<table  class="table table-striped table-bordered text-center"><thead><tr>';
    while ($i < pg_num_fields($sql_stmtvote3))
    {
	$fieldName = pg_field_name($sql_stmtvote3, $i); 
  if (ucfirst($fieldName)=="Boto")
	  echo '<td ALIGN=CENTER><strong>' . "Number of Votes" . "</strong></td>";
  else
	  echo '<td ALIGN=CENTER><strong>' . ucfirst($fieldName) . "</strong></td>";
	$i = $i + 1;
    }
    echo '</tr></thead><tbody>';
    $i = 0;
    $row_max = pg_fetch_assoc($sql_maxvote3);
    while ($row = pg_fetch_assoc($sql_stmtvote3)) 
    {
        echo '<tr>';

            echo '<td ALIGN=center>' . $row['candidate'] . '</td>';
            echo '<td ALIGN=center>' . $row['boto'] . '</td>';
            if ($numlock==0 && $row_max['nominee_name_']==$row['candidate'] && $row_max['vote_count_']>0)
             echo '<td ALIGN=center>' . $row['remarks'] . '</td>';
            else
             echo '<td ALIGN=center></td>';

        echo '</tr>';
        $i = $i + 1;
    }     
    echo "</tbody>";
    echo "</table>";
?> 
</div> 
<!--- -->
<br>
<div class="text-center"> <span  style=font-weight:bold;font-size:12pt;>Audit Committee (<?php echo $num_stmtvote4; ?> lamang ang nahalal)</span></div>
<br>
<div class="table-responsive">
<?php    
    $i = 0;
    echo '<table  class="table table-striped table-bordered text-center"><thead><tr>';
    while ($i < pg_num_fields($sql_stmtvote4))
    {
	$fieldName = pg_field_name($sql_stmtvote4, $i); 
  if (ucfirst($fieldName)=="Boto")
	  echo '<td ALIGN=CENTER><strong>' . "Number of Votes" . "</strong></td>";
  else
	  echo '<td ALIGN=CENTER><strong>' . ucfirst($fieldName) . "</strong></td>";
	$i = $i + 1;
    }
    echo '</tr></thead><tbody>';
    $i = 0;
    $row_max = pg_fetch_assoc($sql_maxvote4);
    while ($row = pg_fetch_assoc($sql_stmtvote4)) 
    {
        echo '<tr>';

            echo '<td ALIGN=center>' . $row['candidate'] . '</td>';
            echo '<td ALIGN=center>' . $row['boto'] . '</td>';
            if ($numlock==0 && $row_max['nominee_name_']==$row['candidate'] && $row_max['vote_count_']>0)
             echo '<td ALIGN=center>' . $row['remarks'] . '</td>';
            else
             echo '<td ALIGN=center></td>';

        echo '</tr>';
        $i = $i + 1;
    }     
    echo "</tbody>";
    echo "</table>";
?> 
</div> 
<!--- -->
<br>
<div class="text-center"> <span  style=font-weight:bold;font-size:12pt;>Election Committee (<?php echo $num_stmtvote5; ?> lamang ang nahalal)</span></div>
<br>
<div class="table-responsive">
<?php    
    $i = 0;
    echo '<table  class="table table-striped table-bordered text-center"><thead><tr>';
    while ($i < pg_num_fields($sql_stmtvote5))
    {
	$fieldName = pg_field_name($sql_stmtvote5, $i); 
  if (ucfirst($fieldName)=="Boto")
	  echo '<td ALIGN=CENTER><strong>' . "Number of Votes" . "</strong></td>";
  else
	  echo '<td ALIGN=CENTER><strong>' . ucfirst($fieldName) . "</strong></td>";
	$i = $i + 1;
    }
    echo '</tr></thead><tbody>';
    $i = 0;
    $row_max = pg_fetch_assoc($sql_maxvote5);
    while ($row = pg_fetch_assoc($sql_stmtvote5)) 
    {
        echo '<tr>';

            echo '<td ALIGN=center>' . $row['candidate'] . '</td>';
            echo '<td ALIGN=center>' . $row['boto'] . '</td>';
            if ($numlock==0 && $row_max['nominee_name_']==$row['candidate'] && $row_max['vote_count_']>0)
             echo '<td ALIGN=center>' . $row['remarks'] . '</td>';
            else
             echo '<td ALIGN=center></td>';

        echo '</tr>';
        $i = $i + 1;
    }   
    echo "</tbody>";
    echo "</table>";
?> 
</div> 
<!--- -->
<br><br>
<span style=font-weight:bold;font-size:12pt;>Prepared by:</span><br><br><br>
<span style=font-weight:bold;font-size:12pt;><u>Evangeline B. Suyat</u></span><br>
<span style=font-weight:bold;font-size:12pt;>ELECOM Technical Assistant</span>
<br>
<div class="text-center"> <span style=font-weight:bold;font-size:12pt;>Certified True and Correct By</span></div>
<br><br>
<div class="row">
      <div class="col-4">
        <b><u>Jerry M. Santos</u></b>
      </div>
      <div class="col-4">
      <b><u>Raul G. Guzman</u></b>
      </div> 
      <div class="col-4">
      <b><u>Asuncion R. Santos</u></b>
      </div>    
</div>
<div class="row">
      <div class="col-4">
      <span style=font-weight:bold;font-size:12pt;>Chairperson, ELECOM</span>
      </div>
      <div class="col-4">
      <span style=font-weight:bold;font-size:12pt;>Vice-Chairperson, ELECOM</span>
      </div> 
      <div class="col-4">
      <span style=font-weight:bold;font-size:12pt;>Secretary, ELECOM</span>
      </div>    
</div>
<br><br>
<div class="text-center"> <span style=font-weight:bold;font-size:12pt;>Witnessed By</span></div>

<br><br>
<div class="row">
      <div class="col-4">
        <b><u>Clarita R.  Garcia</u></b>
      </div>
      <div class="col-4">
      <b><u>Leonila E. Cayaban</u></b>
      </div> 
      <div class="col-4">
      <b></b>
      </div>    
</div>
<div class="row">
      <div class="col-4">
      <span style=font-weight:bold;font-size:12pt;>Chairperson, Audit Committee</span>
      </div>
      <div class="col-4">
      <span style=font-weight:bold;font-size:12pt;>Secretary, Audit Committee</span>
      </div> 
      <div class="col-4">
      <span style=font-weight:bold;font-size:12pt;></span>
      </div>    
</div>

<br><br>
<div class="row">
      <div class="col-4">
        <b><u>Ma. Nanette L. Bernardo</u></b>
      </div>
      <div class="col-4">
      <b><u>Armando R. Cruz, Jr.</u></b>
      </div> 
      <div class="col-4">
      <b><u>Catherine P. Lopez</u></b>
      </div>    
</div>
<div class="row">
      <div class="col-4">
      <span style=font-weight:bold;font-size:12pt;>Audit Program Management Head</span>
      </div>
      <div class="col-4">
      <span style=font-weight:bold;font-size:12pt;>Social/Performance Auditor</span>
      </div> 
      <div class="col-4">
      <span style=font-weight:bold;font-size:12pt;>Financial Auditor</span>
      </div>    
</div>
<BR>
<?php
include "footer.php";
?>
</div>
</body>
</html>
