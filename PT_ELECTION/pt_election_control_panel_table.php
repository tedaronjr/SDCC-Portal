<?php
session_start();
set_time_limit(0);
if (!isset($_SESSION['admin_user']) || !isset($_SESSION['admin_pass'])){
    unset($_SESSION['admin_user']);
    unset($_SESSION['admin_pass']);
    session_destroy();
    echo "<script>window.location.href=\"/SDCC-Portal/admin_login.php\"</script>";           

}
?>


<!DOCTYPE html>
<html>
<head>
    <title><?php echo "PT Election Control Panel"; ?></title>
<?php
include "scriptlink.php";

setlocale(LC_MONETARY,"en_PH.UTF-8"); 

include "db_connect.php";

?> 



<?php






$sql_orgvoting = pg_query($db, "select *,(select organization from organizations where organizations.organization_id=organizations_voting.organization_id) from organizations_voting order by organization_id;") or die ("Could not match data because ".pg_last_error());
$num=pg_num_rows($sql_orgvoting);





?> 

<script>
$(document).ready(function(){      
$('#pt_table').DataTable({
    "searching": true,
    paging: true
    //scrollCollapse: true,
   // scrollY: '200px'
});



}); 

 function member_voting_detail(param,param2) {
                    
                    $.ajax({
                        url : "pt_election_member_voting_details_ajax.php",
                        type : "post",
                        dataType:"text",
                        data : {
                             id: param ,open: param2
                        },
                        success : function (a){
                            $('#member_voting_details').html(a);
						//	$('#myModal').modal('show');
                        }
                    });
        }	




        
     
</script>
<style>

#trhover:hover {
background:#00ff00;
}
</style>
</head>

<body>
<div class="container-fluid">
<br>
<?php
include "title.php";
?>
<!--
<div class="text-left" ><a href="javascript:;" onclick="window.open('update_score.php', '_blank');"     class="btn btn-primary btn-sm">
Update Member Score</a>
</div>
<div class="text-right" ><a href="javascript:;" onclick="window.location='pt_election_control_panel.php'"  id="logout" name="logout" class="btn btn-danger btn-sm">
Logout</a>
</div>
-->
<div id="pt_panel">


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

</div>

<br>
<div id="member_voting_details">

</div>


<!--- -->
<br>

<?php
include "footer.php";
?>
</body>
</html>
