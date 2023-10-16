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



    <title>VOTE SUMMARY</title>
<?php
include "scriptlink.php";

setlocale(LC_MONETARY,"en_PH.UTF-8"); 
?> 

<?php

 


$sql_vote = pg_query($db, "select TO_CHAR(count(*), 'fm999G999') as vote_num from election_vote;") or die ("Could not match data because ".pg_last_error());
$sql_migs = pg_query($db, "select TO_CHAR(count(*), 'fm999G999') as migs,count(*) as migscount from jar_coop_member where status_id=1;") or die ("Could not match data because ".pg_last_error());
$sql_notmigs = pg_query($db, "select TO_CHAR(count(*), 'fm999G999') as not_migs from jar_coop_member where status_id<>1;") or die ("Could not match data because ".pg_last_error());
$sql_member = pg_query($db, "select TO_CHAR(count(*), 'fm999G999') as mem_num from jar_coop_member ;") or die ("Could not match data because ".pg_last_error());
$sql_voted = pg_query($db, "select TO_CHAR(count(*), 'fm999G999') as vote_num,count(*) as votecount from election_voted;") or die ("Could not match data because ".pg_last_error());

$sql_stmtvote1 = pg_query($db, "select nominee_name_ as Candidate,vote_count_ as Vote_Count,remarks_ as Remarks  from  jar_stmtvote() where position_id_=1 order by vote_count_,position_id_,nominee_id_ ;") or die ("Could not match data because ".pg_last_error());
$num_stmtvote1=pg_num_rows($sql_stmtvote1);

$sql_stmtvote2 = pg_query($db, "select nominee_name_ as Candidate,vote_count_ as Vote_Count,remarks_ as Remarks  from  jar_stmtvote() where position_id_=2 order by vote_count_,position_id_,nominee_id_ ;") or die ("Could not match data because ".pg_last_error());
$num_stmtvote2=pg_num_rows($sql_stmtvote2);

$sql_stmtvote3 = pg_query($db, "select nominee_name_ as Candidate,vote_count_ as Vote_Count,remarks_ as Remarks  from  jar_stmtvote() where position_id_=3 order by vote_count_,position_id_,nominee_id_ ;") or die ("Could not match data because ".pg_last_error());
$num_stmtvote3=pg_num_rows($sql_stmtvote3);

$sql_stmtvote4 = pg_query($db, "select nominee_name_ as Candidate,vote_count_ as Vote_Count,remarks_ as Remarks  from  jar_stmtvote() where position_id_=4 order by vote_count_,position_id_,nominee_id_ ;") or die ("Could not match data because ".pg_last_error());
$num_stmtvote4=pg_num_rows($sql_stmtvote4);

$sql_stmtvote5 = pg_query($db, "select nominee_name_ as Candidate,vote_count_ as Vote_Count,remarks_ as Remarks  from  jar_stmtvote() where position_id_=5 order by vote_count_,position_id_,nominee_id_ ;") or die ("Could not match data because ".pg_last_error());
$num_stmtvote5=pg_num_rows($sql_stmtvote5);



$sql_sumvote = pg_query($db, "
with a as (
  select count(*)::integer as mar18,2023::integer as id from  election_voted where updated_at::date='2023-03-18'  
  )
  , b as (
  select count(*)::integer as mar19,2023::integer as id  from  election_voted where updated_at::date='2023-03-19'   
  )
  , c as (
  select count(*)::integer as mar20,2023::integer as id  from  election_voted where updated_at::date='2023-03-20'   
  )
  , d as (
  select count(*)::integer as mar21,2023::integer as id  from  election_voted where updated_at::date='2023-03-21'   
  )
  , e as (
  select count(*)::integer as mar22,2023::integer as id  from   election_voted  where updated_at::date='2023-03-22'   
  )
  , f as (
  select count(*)::integer as mar23,2023::integer as id  from  election_voted  where updated_at::date='2023-03-23'   
  )
  , g as (
  select count(*)::integer as mar24,2023::integer as id  from   election_voted where updated_at::date='2023-03-24'   
  )
  , h as (
  select count(*)::integer as mar25,2023::integer as id  from  election_voted where updated_at::date='2023-03-25'   
  )
  SELECT * 
  FROM
       a t1
       INNER JOIN 
       b t2
       using(id)
       INNER JOIN
       c t3 using(id)
       INNER JOIN
       d t4 using(id)
       INNER JOIN
       e t5 using(id)
       INNER JOIN
       f t6 using(id)          
       INNER JOIN
       g t7 using(id)
       INNER JOIN
       h t8 using(id)     
  ;

  ") or die ("Could not match data because ".pg_last_error());

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
$row_sum = pg_fetch_assoc($sql_sumvote);

?>



<style>
@page {
 size: auto !important;
}
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

 <h5 class="text-center"><b>Summary of Votes</b></h5><hr>


<div class="table-responsive">
<?php    
    
echo '<table  class="table table-striped table-bordered text-center"><thead><tr>';
echo "<td ALIGN=CENTER></td>";
//
echo "<td ALIGN=CENTER><b>March 18</b></td>";
echo "<td ALIGN=CENTER><b>March 19</b></td>";
echo "<td ALIGN=CENTER><b>March 20</b></td>";
echo "<td ALIGN=CENTER><b>March 21</b></td>";
echo "<td ALIGN=CENTER><b>March 22</b></td>";
echo "<td ALIGN=CENTER><b>March 23</b></td>";
echo "<td ALIGN=CENTER><b>March 24</b></td>";
echo "<td ALIGN=CENTER><b>March 25</b></td>";
echo "<td ALIGN=CENTER><b>Total</b></td>";
echo '</tr></thead><tbody>';
echo '<tr>';
echo "<td ALIGN=CENTER><b>Total No. of Votes Casted</b></td>";
//
echo "<td ALIGN=CENTER><b>$row_sum[mar18]</b></td>";
echo "<td ALIGN=CENTER><b>$row_sum[mar19]</b></td>";
echo "<td ALIGN=CENTER><b>$row_sum[mar20]</b></td>";
echo "<td ALIGN=CENTER><b>$row_sum[mar21]</b></td>";
echo "<td ALIGN=CENTER><b>$row_sum[mar22]</b></td>";
echo "<td ALIGN=CENTER><b>$row_sum[mar23]</b></td>";
echo "<td ALIGN=CENTER><b>$row_sum[mar24]</b></td>";
echo "<td ALIGN=CENTER><b>$row_sum[mar25]</b></td>";
echo "<td ALIGN=CENTER><b>$row_voted[vote_num]</b></td>";
echo '</tr>';

echo '<tr>';
echo "<td ALIGN=CENTER><b>Percentage of Votes over $row_migs[migs] MIGS</b></td>";
//

echo "<td ALIGN=CENTER><b>".round($row_sum['mar18']/$row_migs['migscount'],2) * 100 ."%</b></td>";
echo "<td ALIGN=CENTER><b>".round($row_sum['mar19']/$row_migs['migscount'],2) * 100 ."%</b></td>";
echo "<td ALIGN=CENTER><b>".round($row_sum['mar20']/$row_migs['migscount'],2) * 100 ."%</b></td>";
echo "<td ALIGN=CENTER><b>".round($row_sum['mar21']/$row_migs['migscount'],2) * 100 ."%</b></td>";
echo "<td ALIGN=CENTER><b>".round($row_sum['mar22']/$row_migs['migscount'],2) * 100 ."%</b></td>";
echo "<td ALIGN=CENTER><b>".round($row_sum['mar23']/$row_migs['migscount'],2) * 100 ."%</b></td>";
echo "<td ALIGN=CENTER><b>".round($row_sum['mar24']/$row_migs['migscount'],2) * 100 ."%</b></td>";
echo "<td ALIGN=CENTER><b>".round($row_sum['mar25']/$row_migs['migscount'],2) * 100 ."%</b></td>";
echo "<td ALIGN=CENTER><b>".round($row_voted['votecount']/$row_migs['migscount'],2) * 100 ."%</b></td>";
echo '</tr>';
  
    echo "</tbody>";
    echo "</table>";
?> 
</div> 

                             
  
              

   
<br>
<BR>
<?php
include "footer.php";
?>
</div>
</body>
</html>
