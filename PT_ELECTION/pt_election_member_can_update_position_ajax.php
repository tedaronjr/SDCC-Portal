

<?php
/*

$chairperson= !isset($_POST['chair'])? "false" : "true";
$vicechairperson= !isset($_POST['for_vice_chairperson'])? "false" : "true";
$secretary= !isset($_POST['for_secretary'])? "false" : "true";
$treasurer= !isset($_POST['for_treasurer'])? "false" : "true";
$auditor= !isset($_POST['for_auditor'])? "false" : "true";


*/

include "db_connect.php";



    $update_members_candidates = pg_query($db, "
    DO $$
    DECLARE
     n integer;

    BEGIN
    UPDATE members_candidates
    SET position_id=null
    WHERE position_id=$_POST[pos];

    UPDATE members_candidates
    SET position_id=$_POST[pos]
    WHERE mem_no='$_POST[mem_no]';
    END
    $$;


    ") or die ("Could not match data because ".pg_last_error()); 
    





?>

