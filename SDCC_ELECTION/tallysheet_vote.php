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



    <title>TALLY SHEET VOTE</title>
<?php
include "scriptlink.php";

setlocale(LC_MONETARY,"en_PH.UTF-8"); 
?> 

<?php

 


$sql_tally = pg_query($db, " 
SELECT candidate
,dc01
,dc02
,dc03
,dc04
,dc05
,dc06
,dc07
,dc08
,dc09
,dc10
,dc11
,dc12
,dc13
,dc14
,dc15
,dc16
,dc17
,dc18
,dc19
,dc20
,dc21
,dc22
,dc23
,dc24
,dc25
,other_areas
,total

from jar_tallysheet() order by pos_id,candidate_id;") or die ("Could not match data because ".pg_last_error());



/*
$num_vote=pg_num_rows($sql_vote);
$num_migs=pg_num_rows($sql_migs);
$num_notmigs=pg_num_rows($sql_notmigs);
$num_member=pg_num_rows($sql_member);
*/


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


/*

    table {
        table-layout: fixed;
        word-wrap: break-word;
    }

        table th, table td {
            overflow: hidden;
        }

*/

</style>

</head>

<body>




<div class="container-fluid"><br>
   <h3 class="text-center"><?php echo "San Dionisio Credit Cooperative"; ?></h2>
   <h4 class="text-center"><?php echo "0554 Quirino Avenue, San Dionisio, Parañaque City, Philippines"; ?></h4>
   <h5 class="text-center">As of <?php echo date('F j, Y h:i:s A');//echo date('F j, Y h:i:s A'); ?></h5>
 <br>
 <h5 class="text-center"><?php echo "62<sup>nd</sup> General Election (March 18-25,2023)"; ?></h5>

 <h5 class="text-center"><b>Tally Sheet of Votes</b></h5><hr>


 <br>
 <div class="row justify-content-center">
    <div class="col-auto">
<?php    
    $i = 0; 
    echo '<table  class="table table-striped table-bordered table-hover table-responsive table-sm"><thead><tr>';
    
echo "<td ALIGN=CENTER><b>Candidate</b></td>";
echo "<td ALIGN=CENTER><b>DC 1</b></td>";
echo "<td ALIGN=CENTER><b>DC 2</b></td>";
echo "<td ALIGN=CENTER><b>DC 3</b></td>";
echo "<td ALIGN=CENTER><b>DC 4</b></td>";
echo "<td ALIGN=CENTER><b>DC 5</b></td>";
echo "<td ALIGN=CENTER><b>DC 6</b></td>";
echo "<td ALIGN=CENTER><b>DC 7</b></td>";
echo "<td ALIGN=CENTER><b>DC 8</b></td>";
echo "<td ALIGN=CENTER><b>DC 9</b></td>";
echo "<td ALIGN=CENTER><b>DC 10</b></td>";
echo "<td ALIGN=CENTER><b>DC 11</b></td>";
echo "<td ALIGN=CENTER><b>DC 12</b></td>";
echo "<td ALIGN=CENTER><b>DC 13</b></td>";
echo "<td ALIGN=CENTER><b>DC 14</b></td>";
echo "<td ALIGN=CENTER><b>DC 15</b></td>";
echo "<td ALIGN=CENTER><b>DC 16</b></td>";
echo "<td ALIGN=CENTER><b>DC 17</b></td>";
echo "<td ALIGN=CENTER><b>DC 18</b></td>";
echo "<td ALIGN=CENTER><b>DC 19</b></td>";
echo "<td ALIGN=CENTER><b>DC 20</b></td>";
echo "<td ALIGN=CENTER><b>DC 21</b></td>";
echo "<td ALIGN=CENTER><b>DC 22</b></td>";
echo "<td ALIGN=CENTER><b>DC 23</b></td>";
echo "<td ALIGN=CENTER><b>DC 24</b></td>";
echo "<td ALIGN=CENTER><b>DC 25</b></td>";
echo "<td ALIGN=CENTER><b>Other Areas</b></td>";
echo "<td ALIGN=CENTER><b>Total</b></td>";

echo '</tr></thead><tbody>';

    $i = 0;
    while ($row_tally = pg_fetch_assoc($sql_tally)) 
    {
        $i = $i + 1;
        echo '<tr>';
        echo "<td ALIGN=left>$i. $row_tally[candidate]</td>";
        echo "<td ALIGN=center>$row_tally[dc01]</td>";
        echo "<td ALIGN=center>$row_tally[dc02]</td>";
        echo "<td ALIGN=center>$row_tally[dc03]</td>";
        echo "<td ALIGN=center>$row_tally[dc04]</td>";
        echo "<td ALIGN=center>$row_tally[dc05]</td>";
        echo "<td ALIGN=center>$row_tally[dc06]</td>";
        echo "<td ALIGN=center>$row_tally[dc07]</td>";
        echo "<td ALIGN=center>$row_tally[dc08]</td>";
        echo "<td ALIGN=center>$row_tally[dc09]</td>";
        echo "<td ALIGN=center>$row_tally[dc10]</td>";
        echo "<td ALIGN=center>$row_tally[dc11]</td>";
        echo "<td ALIGN=center>$row_tally[dc12]</td>";
        echo "<td ALIGN=center>$row_tally[dc13]</td>";
        echo "<td ALIGN=center>$row_tally[dc14]</td>";
        echo "<td ALIGN=center>$row_tally[dc15]</td>";
        echo "<td ALIGN=center>$row_tally[dc16]</td>";
        echo "<td ALIGN=center>$row_tally[dc17]</td>";
        echo "<td ALIGN=center>$row_tally[dc18]</td>";
        echo "<td ALIGN=center>$row_tally[dc19]</td>";
        echo "<td ALIGN=center>$row_tally[dc20]</td>";
        echo "<td ALIGN=center>$row_tally[dc21]</td>";
        echo "<td ALIGN=center>$row_tally[dc22]</td>";
        echo "<td ALIGN=center>$row_tally[dc23]</td>";
        echo "<td ALIGN=center>$row_tally[dc24]</td>";
        echo "<td ALIGN=center>$row_tally[dc25]</td>";
        echo "<td ALIGN=center>$row_tally[other_areas]</td>";
        echo "<td ALIGN=center>$row_tally[total]</td>";

        echo '</tr>';
        
    }    
    echo "</tbody>";
    echo "</table>";
?> 
    </div>
  </div>
<!--- -->

                             
  
              

   
<br>
<BR>
<?php
include "footer.php";
?>
</div>
</body>
</html>
