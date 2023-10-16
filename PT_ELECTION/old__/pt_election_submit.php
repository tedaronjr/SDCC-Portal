<?php

session_start();
set_time_limit(0);



?>

<!DOCTYPE html>
<html>
<head>
<title>PT Election Vote</title>
<?php
include "scriptlink.php";
include "db_connect.php";
?>
  
<?php 

if (isset($_POST['submit_ptvote'])) {
    $mem_no=$_POST['mem_no'];
    $sql_ptvote = pg_query($db, "

    SELECT public.submit_pt_vote(
        '$mem_no',
        <integer>,
        <integer>,
        <boolean>
    );

    select *,(select organization from organizations where ou_code=members_ou_code) from members where sc_acctno= '$_SESSION[sc_acctno]';   
    
    ") or die ("Could not match data because ".pg_last_error());  


}
  

    
    $sql_members = pg_query($db, "

    select *,(select organization from organizations where ou_code=members_ou_code) from members where sc_acctno= '$_SESSION[sc_acctno_vote]';   
    
    ") or die ("Could not match data because ".pg_last_error());  
    
    $row_members=pg_fetch_assoc($sql_members);

    $sql_chairperson = pg_query($db, "

    select * from members where mem_no in (select mem_no from members_candidates where for_chairperson=true) and members_ou_code='$row_members[members_ou_code]'
    
    
    ") or die ("Could not match data because ".pg_last_error());    


    $sql_vicechairperson = pg_query($db, "

    select * from members where mem_no in (select mem_no from members_candidates where for_vice_chairperson=true) and members_ou_code='$row_members[members_ou_code]'
    
    
    ") or die ("Could not match data because ".pg_last_error());  


    $sql_secretary = pg_query($db, "

    select * from members where mem_no in (select mem_no from members_candidates where for_secretary=true) and members_ou_code='$row_members[members_ou_code]'
    
    
    ") or die ("Could not match data because ".pg_last_error());   
    
    $sql_treasurer = pg_query($db, "

    select * from members where mem_no in (select mem_no from members_candidates where for_treasurer=true) and members_ou_code='$row_members[members_ou_code]'
    
    
    ") or die ("Could not match data because ".pg_last_error());
    
    $sql_auditor = pg_query($db, "

    select * from members where mem_no in (select mem_no from members_candidates where for_auditor=true) and members_ou_code='$row_members[members_ou_code]'
    
    
    ") or die ("Could not match data because ".pg_last_error());    




?>


<style>

.w1 {
  width: 20;
  border: 1px solid black;
}    
</style>    

</head>
<body>

 <div class="container-fluid">
 <BR>
<?php
include "title.php";
?>
   <h3 class="text-center">PT Election</h3><br>


<form autocomplete="off" role="form"  id="myForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" >


<div class="row justify-content-center">

    <div class="col-4 text-right" ><input type=hidden name="mem_no" value="<?php echo $row_members['mem_no']; ?>">
      Account No.:
    </div>

    <div class="col-4 text-left">
      <?php echo $row_members['sc_acctno']; ?>
    </div>

</div> 

<div class="row justify-content-center">

    <div class="col-4 text-right" >
      Name:
    </div>

    <div class="col-4 text-left">
      <?php echo $row_members['last_name'].",".$row_members['first_name']; ?>
    </div>

</div> 

<div class="row justify-content-center">

    <div class="col-4 text-right" >
      PT No.:
    </div>

    <div class="col-4 text-left">
      <?php echo $row_members['organization']; ?>
    </div>

</div> 

<hr>

<br>


<div class="text-center">
    List of Candidates for Chairperson (choose 1)
</div> 
<br>

<?php
    while($row_chairperson = pg_fetch_assoc($sql_chairperson)) {
?>

<div class="row justify-content-center">

    <div class="col-4 text-right" >
    <input class="form-check-input" name="chairman" type="radio"  id="<?php echo $row_chairperson['sc_acctno']; ?>" >
    </div>

    <div class="col-4 text-left">
        <label class="form-check-label" for="<?php echo $row_chairperson['sc_acctno']; ?>">
            <?php echo $row_chairperson['last_name'].' , '.$row_chairperson['first_name']; ?>
        </label>  
    </div>

</div> 

<?php
    }
?>  

<br>

<div class="text-center">
    List of Candidates for Vice Chairperson (choose 1)
</div> 
<br>

<?php
    while($row_vicechairperson = pg_fetch_assoc($sql_vicechairperson)) {
?>
        <div class="row justify-content-center">

        <div class="col-4 text-right" >
        <input class="form-check-input" name="vicechairman" type="radio"  id="<?php echo $row_vicechairperson['sc_acctno']; ?>">
        </div>    
        <div class="col-4 text-left" >
        <label class="form-check-label" for="<?php echo $row_vicechairperson['sc_acctno']; ?>">
        <?php echo $row_vicechairperson['last_name'].' , '.$row_vicechairperson['first_name']; ?>
      </label>
        </div> 

    </div>
<?php
    }
?> 
<br>

<div class="text-center">
    List of Candidates for Secretary (choose 1)
</div> 


<br>

<?php
    while($row_secretary = pg_fetch_assoc($sql_secretary)) {
?>
        <div class="row justify-content-center">

        <div class="col-4 text-right" >
        <input class="form-check-input" name="secretary" type="radio"  id="<?php echo $row_secretary['sc_acctno']; ?>">
        </div>    
        <div class="col-4 text-left" >
        <label class="form-check-label" for="<?php echo $row_secretary['sc_acctno']; ?>">
        <?php echo $row_secretary['last_name'].' , '.$row_secretary['first_name']; ?>
      </label>
        </div> 

    </div>
<?php
    }
?> 
<br>

<div class="text-center">
    List of Candidates for Treasurer (choose 1)
</div> 

<br>

<?php
    while($row_treasurer = pg_fetch_assoc($sql_treasurer)) {
?>
        <div class="row justify-content-center">

        <div class="col-4 text-right" >
        <input class="form-check-input" name="secretary" type="radio"  id="<?php echo $row_treasurer['sc_acctno']; ?>">
        </div>    
        <div class="col-4 text-left" >
        <label class="form-check-label" for="<?php echo $row_treasurer['sc_acctno']; ?>">
        <?php echo $row_treasurer['last_name'].' , '.$row_treasurer['first_name']; ?>
      </label>
        </div> 

    </div>
<?php
    }
?> 
<br>


<div class="text-center">
    List of Candidates for Auditor (choose 1)
</div> 

<br>

<?php
    while($row_auditor = pg_fetch_assoc($sql_auditor)) {
?>
        <div class="row justify-content-center">

        <div class="col-4 text-right" >
        <input class="form-check-input" name="auditor" type="radio"  id="<?php echo $row_auditor['sc_acctno']; ?>">
        </div>    
        <div class="col-4 text-left" >
        <label class="form-check-label" for="<?php echo $row_auditor['sc_acctno']; ?>">
        <?php echo $row_auditor['last_name'].' , '.$row_auditor['first_name']; ?>
      </label>
        </div> 

    </div>
<?php
    }
?> 
<br>





















<hr>

<br>
          <!-- Add more form inputs here if needed -->
          <div class="text-center">
            <button type="submit" onclick="if (confirm('Are you sure?')) return true; else return false;" name="submit_ptvote" class="btn btn-primary">Submit</button>
&nbsp;&nbsp;

            <a href="pt_election_login.php?cancel=1" id="cancel" name="cancel" class="btn btn-danger">Cancel</a>

          </div>

        </form>
</div>












<?php
include "footer.php";
?>
</div>
</body>
</html> 




