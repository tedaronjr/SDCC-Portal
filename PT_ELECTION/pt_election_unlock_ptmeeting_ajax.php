<script>
$(document).ready(function(){      
$('#pt_table').DataTable({
    "searching": true,
    paging: true
    //scrollCollapse: true,
   // scrollY: '200px'
});




});     
</script>

<?php
/*

$chairperson= !isset($_POST['chair'])? "false" : "true";
$vicechairperson= !isset($_POST['for_vice_chairperson'])? "false" : "true";
$secretary= !isset($_POST['for_secretary'])? "false" : "true";
$treasurer= !isset($_POST['for_treasurer'])? "false" : "true";
$auditor= !isset($_POST['for_auditor'])? "false" : "true";


*/
include "db_connect.php";

if ($_POST['id']=="open") {

$sql_ = pg_query($db, "

UPDATE organizations_voting
SET is_open=true,vote_date = CURRENT_DATE																
WHERE organization_id='$_POST[org_id]';          

") or die ("Could not match data because ".pg_last_error()); 
     
}

elseif ($_POST['id']=="closed") {
    $d="disabled";
    $sql_ = pg_query($db, "
    
    UPDATE organizations_voting
    SET is_open=false, 
    is_open_voting=false, chairperson_status=false, vice_chairperson_status=false, 
    secretary_status=false, treasurer_status=false, auditor_status=false
    WHERE organization_id='$_POST[org_id]';          
    
    ") or die ("Could not match data because ".pg_last_error()); 
         
    }

    $sql_orgvoting = pg_query($db, "select *,(select organization from organizations where organizations.organization_id=organizations_voting.organization_id) from organizations_voting order by organization_id;") or die ("Could not match data because ".pg_last_error());
    $num=pg_num_rows($sql_orgvoting);    
?>


<h3 class="text-center"><?php echo "PT Election Control Panel"; ?></h3>
  <br>
  <div class="table-responsive">
<?php    
    
echo '<table id="pt_table"  class="table table-striped table-bordered table-hover text-center">';
echo '<thead class="bg-primary"><tr>';

echo "<td align='center'><b>PT No.</b></td>";
echo "<td align='center'><b>Vote Date</b></td>";
echo "<td align='center'><b>Status</b></td>";
echo "<td align='center'><b>Voting Status</b></td>";
echo "<td align='center'><b>Chairperson</b></td>";
echo "<td align='center'><b>Vice Chairperson</b></td>";
echo "<td align='center'><b>Secretary</b></td>";
echo "<td align='center'><b>Treasurer</b></td>";
echo "<td align='center'><b>Auditor</b></td>";

echo '</tr></thead>';

echo '<tbody>';

while ($row = pg_fetch_assoc($sql_orgvoting)) 
{
    echo "<tr id='trhover' onclick=member_voting_detail('$row[organization_id]','$row[is_open]')>";
    echo "<td align='center'>$row[organization]</td>";
    echo "<td align='center'>$row[vote_date]</td>"; 

    if($row['is_open']=='t')
     echo "<td class='bg-success' id='is_open_ptmeeting' align='center'><b>Open</b></td>";
    else
     echo "<td class='btn-secondary' id='is_open_ptmeeting' align='center'>Closed</td>";

     if($row['is_open_voting']=='t')
     echo "<td  class='bg-success' align='center'><b>Open</b></td>";
    else
     echo "<td class='btn-secondary' align='center'>Closed</td>";

     if($row['chairperson_status']=='t')
     echo "<td  class='bg-success' align='center'><b>Open</b></td>";
    else
     echo "<td  class='btn-secondary' align='center'>Closed</td>";     

     if($row['vice_chairperson_status']=='t')
     echo "<td  class='bg-success' align='center'><b>Open</b></td>";
    else
     echo "<td class='btn-secondary' align='center'>Closed</td>";     

     if($row['secretary_status']=='t')
     echo "<td  class='bg-success' align='center'><b>Open</b></td>";
    else
     echo "<td class='btn-secondary' align='center'>Closed</td>";     

     if($row['treasurer_status']=='t')
     echo "<td  class='bg-success' align='center'><b>Open</b></td>";
    else
     echo "<td class='btn-secondary' align='center'>Closed</td>";     

     if($row['auditor_status']=='t')
     echo "<td  class='bg-success' align='center'><b>Open</b></td>";
    else
     echo "<td class='btn-secondary' align='center'>Closed</td>";     






    echo '</tr>';
} 

echo '</tbody>'; 


 echo "</table>";
?> 
</div> 