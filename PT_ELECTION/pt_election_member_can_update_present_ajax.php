

<?php
/*

$chairperson= !isset($_POST['chair'])? "false" : "true";
$vicechairperson= !isset($_POST['for_vice_chairperson'])? "false" : "true";
$secretary= !isset($_POST['for_secretary'])? "false" : "true";
$treasurer= !isset($_POST['for_treasurer'])? "false" : "true";
$auditor= !isset($_POST['for_auditor'])? "false" : "true";


*/

include "db_connect.php";

$final_pos = pg_query($db, "select * from members_candidates where position_id is null and mem_no='$_POST[mem_no]' ;") or die ("Could not match data because ".pg_last_error());
$num_final_pos=pg_num_rows($final_pos);

//if ($num_final_pos==0) {
if ($_POST['bolyan']=="true") {

    $update_members_candidates = pg_query($db, "

    UPDATE members_candidates
    SET $_POST[pos]=true
    WHERE mem_no='$_POST[mem_no]' ;

    ") or die ("Could not match data because ".pg_last_error()); 
    
}

elseif ($_POST['bolyan']=="false") {

    $update_members_candidates = pg_query($db, "

    UPDATE members_candidates
    SET $_POST[pos]=false
    WHERE mem_no='$_POST[mem_no]' ;

    ") or die ("Could not match data because ".pg_last_error()); 
    
}
//}

//else {
//    echo "<script>alert ('Meron ng bumoto.Hindi muna pwede i edit ang position.Pa refresh nalang uli ang pahina.Salamat.');</script>";
//}
?>

