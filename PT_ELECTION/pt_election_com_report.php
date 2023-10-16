<?php
session_start();
set_time_limit(0);
/*
if (!isset($_SESSION['pt_user']) || !isset($_SESSION['pt_pass']) || !isset($_GET['org_id'])){
    unset($_SESSION['pt_user']);
    unset($_SESSION['pt_pass']);
    session_destroy();
    echo "<script>window.location.href=\"pt_election_control_panel.php\"</script>";           

}*/
?>
<?php
date_default_timezone_set('Asia/Manila');
include "db_connect.php";
$year = date("Y");
?>

<!DOCTYPE html>
<html>
<head>



<title><?php echo "PT Election Committee Report"; ?></title>
<?php
include "scriptlink.php";

setlocale(LC_MONETARY,"en_PH.UTF-8"); 
?> 

<?php
$sql_= pg_query($db, "
select 1::integer n,'Chairperson'::varchar pos_name,concat(last_name,',',first_name,' ',middle_name)::varchar as fullname,(select count(*) from pt_election_master where position_id=1 and candidate_mem_no in (select mem_no from members_candidates where position_id=1))::integer as voteno from members where mem_no in
( select mem_no from members_candidates where  position_id=1) and organization_id='$_GET[org_id]'
union
select  2::integer n,'Vice Chairperson'::varchar pos_name,concat(last_name,',',first_name,' ',middle_name)::varchar as fullname,(select count(*) from pt_election_master where position_id=2 and candidate_mem_no in (select mem_no from members_candidates where position_id=2))::integer as voteno from members where mem_no in
( select mem_no from members_candidates where  position_id=2) and organization_id='$_GET[org_id]'
union    
select  3::integer n,'Secretary'::varchar pos_name,concat(last_name,',',first_name,' ',middle_name)::varchar as fullname,(select count(*) from pt_election_master where position_id=3 and candidate_mem_no in (select mem_no from members_candidates where position_id=3))::integer as voteno from members where mem_no in
( select mem_no from members_candidates where  position_id=3) and organization_id='$_GET[org_id]'
union    
select  4::integer n,'Treasurer'::varchar pos_name,concat(last_name,',',first_name,' ',middle_name)::varchar as fullname,(select count(*) from pt_election_master where position_id=4 and candidate_mem_no in (select mem_no from members_candidates where position_id=4))::integer as voteno from members where mem_no in
( select mem_no from members_candidates where  position_id=4) and organization_id='$_GET[org_id]'
union    
select  5::integer n,'Auditor'::varchar pos_name,concat(last_name,',',first_name,' ',middle_name)::varchar as fullname,(select count(*) from pt_election_master where position_id=5 and candidate_mem_no in (select mem_no from members_candidates where position_id=5))::integer as voteno from members where mem_no in
( select mem_no from members_candidates where  position_id=5) and organization_id='$_GET[org_id]' 
;") or die ("Could not match data because ".pg_last_error());
$num_=pg_num_rows($sql_);

$sql_org= pg_query($db, "select * from organizations where organization_id='$_GET[org_id]'
;") or die ("Could not match data because ".pg_last_error());

$sql_orgvoting= pg_query($db, "

SELECT organization_voting_id, organization_id, vote_date, is_open, 
       is_open_voting, chairperson_status, vice_chairperson_status, 
       secretary_status, treasurer_status, auditor_status,
       TO_CHAR(vote_date,'Month DD, yyyy') as dated
  FROM organizations_voting where organization_id='$_GET[org_id]'

;") or die ("Could not match data because ".pg_last_error());
$row_orgvoting = pg_fetch_assoc($sql_orgvoting);


?>



<style>
@page {
 size: auto !important;
}

</style>

</head>

<body>




<div class="container"><br>
   <h3 class="text-center"><?php echo "San Dionisio Credit Cooperative"; ?></h2>
   <h4 class="text-center"><?php echo "0554 Quirino Avenue, San Dionisio, Parañaque City, Philippines"; ?></h4>
 <br>   
 <br>
 <h5 class="text-center"><?php $ye=intval($year + 1); echo "Report of The Election Committee"; ?></h5>
<br>
<h5 class="text-center"><?php echo "Official Results of Pook Tulungan Election ".$year."-".$ye; ?></h5>
<h5 class="text-center">As of <?php echo $row_orgvoting['dated'];//echo date('F j, Y h:i:s A'); ?></h5>
<br><br>
 <h5 class="text-center"><b><?php $row = pg_fetch_assoc($sql_org); echo "$row[organization]"; ?></b></h5>
 <br>

<div class="table-responsive">
<?php    
    
echo '<table  class="table">';
echo '<thead><tr>';
echo  "<td align=center></td>";
echo  "<td align=center><b>Name of Officer</b></td>";
echo  "<td align=center><b>No. of Votes</b></td>";
echo '</tr></thead>';
echo '<tbody>';

while($row = pg_fetch_assoc($sql_)) {
    echo '<tr>';
    echo  "<td align=center><b>$row[pos_name]</b></td>";
    echo  "<td align=center>$row[fullname]</td>";
    echo  "<td align=center>$row[voteno]</td>";
    echo '</tr>';    
}
  
echo "</tbody>";
echo "</table>";
?> 
</div> 
<br><br><br>
                             
<div class="row justify-content-center" >
    <div class="col-6 text-center" >
        Prepared By
    </div>
    <div class="col-6 text-center" >
        Witnessed By
    </div>    
</div>   
<br>
<div class="row justify-content-center" >
    <div class="col-6 text-center" >
        ____________________________________
    </div>
    <div class="col-6 text-center" >
        ____________________________________
    </div>    
</div>  

<div class="row justify-content-center" >
    <div class="col-6 text-center" >
    <b> Deputized Volunteer</b>
    </div>
    <div class="col-6 text-center" >
    <b> Audit Committee</b>
    </div>    
</div> 
<br><br>
  <div class="text-center" >Certified True and Correct By </div>  <br>  
  <div class="text-center" >____________________________________</div>    
  <div class="text-center" ><b>Election Committee</b> </div> 
  
<br><br>
<p>Remarks:</p>  
<p>_________________________________________________________________________________________________________________________________________________________</p>  
<p>_________________________________________________________________________________________________________________________________________________________</p>  
<p>_________________________________________________________________________________________________________________________________________________________</p>     
<br>
<br>
<?php
include "footer.php";
?>
</div>
</body>
</html>
