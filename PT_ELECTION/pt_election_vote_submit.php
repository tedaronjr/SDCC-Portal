<?php
session_start();
set_time_limit(0);
if (!isset($_SESSION['sc_acctno_vote']) || !isset($_SESSION['code_vote'])){
    unset($_SESSION['sc_acctno_vote']);
    unset($_SESSION['code_vote']);
    session_destroy();
    echo "<script>window.location.href=\"pt_election_vote_select.php\"</script>";           

}


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
    $candidate_mem_no=$_POST['candidate_mem_no'];


    $sql_ptvote = pg_query($db, "

        select jar_pt_election_insert_vote('$_SESSION[sc_acctno_vote]', '$_SESSION[code_vote]','$mem_no','$candidate_mem_no' );
    
    ") or die ("Could not match data because ".pg_last_error());  

    $row_=pg_fetch_assoc($sql_ptvote);   

    if ($row_['jar_pt_election_insert_vote']=="success") {


    unset($_SESSION['sc_acctno_vote']);
    unset($_SESSION['code_vote']);
    session_destroy();
    echo "<script>window.location.href=\"pt_election_vote_select.php\"</script>";           

    }
    else {
        echo "<div class=\"alert alert-danger\" role=\"alert\">Vote failed!</div>";
    }

}
  

    
    $sql_members = pg_query($db, "

    select *,(select organization from organizations where ou_code=members_ou_code) from members where sc_acctno= '$_SESSION[sc_acctno_vote]';   
    
    ") or die ("Could not match data because ".pg_last_error());  
    
    $row_members=pg_fetch_assoc($sql_members);




    $sql_title = pg_query($db, "

    select title_ from jar_pt_election_active_candidate('$_SESSION[sc_acctno_vote]','$_SESSION[code_vote]') limit 1;     
    
    ") or die ("Could not match data because ".pg_last_error());    

    $row_title=pg_fetch_assoc($sql_title);   

    $num_title=pg_num_rows($sql_title);



    $sql_votelist = pg_query($db, "

    select * from jar_pt_election_active_candidate('$_SESSION[sc_acctno_vote]','$_SESSION[code_vote]');     
    
    ") or die ("Could not match data because ".pg_last_error());    



    $num_list=pg_num_rows($sql_votelist);

?>


<style>

.w1 {
  width: 20;
  border: 1px solid black;
} 
#refused {
 display: none;
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
      <b>Account No.:</b>
    </div>

    <div class="col-4 text-left">
      <?php echo $row_members['sc_acctno']; ?>
    </div>

</div> 

<div class="row justify-content-center">

    <div class="col-4 text-right" >
      <b>Name:</b>
    </div>

    <div class="col-4 text-left">
      <?php echo $row_members['last_name'].",".$row_members['first_name']; ?>
    </div>

</div> 

<div class="row justify-content-center">

    <div class="col-4 text-right" >
      <b>PT No.:</b>
    </div>

    <div class="col-4 text-left">
      <?php echo $row_members['organization']; ?>
    </div>

</div> 






<?php
    if ($num_title ==1 ) {
?>
<hr>

<br>
<div class="text-center">
    <b>List of Candidates for <?php echo $row_title['title_']; ?> (choose 1)</b>
</div> 
<br>
<div class="row justify-content-center">

<div class="col-4 text-right" >
<input required checked class="form-check-input" name="candidate_mem_no" type="radio" value="refused"  id="refused">
</div>    
<div class="col-4 text-left" >
<label class="form-check-label" for="refused">
 <b></b>
</label>
</div> 

</div>
<br>

<?php
    while($row_list = pg_fetch_assoc($sql_votelist)) {
?>
        <div class="row justify-content-center">

        <div class="col-4 text-right" >
        <input required class="form-check-input" name="candidate_mem_no" type="radio" value="<?php echo $row_list['mem_no_']; ?>"  id="<?php echo $row_list['mem_no_']; ?>">
        </div>    
        <div class="col-4 text-left" >
        <label class="form-check-label" for="<?php echo $row_list['mem_no_']; ?>">
       <b> <?php echo $row_list['last_name_'].' , '.$row_list['first_name_']; ?></b>
      </label>
        </div> 

    </div>
    <br>
<?php
    }
?> 

<?php
    }
?>





















<br>
          <!-- Add more form inputs here if needed -->
          <div class="text-center"> <!--

            <button type="submit" onclick="if (confirm('Are you sure?')) return true; else return false;" name="submit_ptvote" class="btn btn-primary">Submit</button>
&nbsp;&nbsp;

            <a href="pt_election_vote_select.php?cancel=1" id="cancel" name="cancel" class="btn btn-danger">Cancel</a>

          </div>
          -->
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
           Submit
          </button>       
            &nbsp;&nbsp;
<!--
<a href="pt_election_vote_select.php?cancel=1" id="cancel" name="cancel" class="btn btn-danger">Cancel</a>
-->
<a href="javascript:;" onclick="window.location='pt_election_vote_select.php?cancel=1'"  id="cancel" name="cancel" class="btn btn-danger">Cancel</a>
          </div>



<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">  </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body text-left">
                <!-- Modal content goes here -->
                Are you sure?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                <input type="submit"  id="submit_ptvote" name="submit_ptvote" class="btn btn-success" value="Yes">
            </div>
        </div>
    </div>
</div>





        </form>
</div>












<?php
include "footer.php";
?>
</div>
</body>
</html> 




