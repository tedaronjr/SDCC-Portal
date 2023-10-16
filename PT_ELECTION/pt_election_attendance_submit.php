<?php
session_start();
set_time_limit(0);
if (!isset($_SESSION['sc_acctno_attendance'])) {
  echo "<script>window.location.href=\"pt_election_attendance_select.php\"</script>";           
}
?>
<!DOCTYPE html>
<html>
<head>
<title>PT Election Attendance</title>
<?php
include "scriptlink.php";
include "db_connect.php";
?>

<?php 


  if (isset($_POST['submit_attendance'])) {

    $sc_acctno=$_POST['sc_acctno'];
    $mem_no=$_POST['mem_no']; 
    $chairman= !isset($_POST['chairman'])? "false" : "true";
    $vicechairman=!isset($_POST['vicechairman'])? "false" : "true";
    $secretary= !isset($_POST['secretary'])? "false" : "true";
    $treasurer= !isset($_POST['treasurer'])? "false" : "true";
    $auditor=!isset($_POST['auditor'])? "false" : "true";


 

    $sql_insert = pg_query($db, "

    INSERT INTO public.attendance(attendance_date, mem_no,sc_acctno) SELECT current_date,'$mem_no','$sc_acctno';
    
    
    ") or die ("Could not match data because ".pg_last_error());    

    if (isset($_POST['update_candidate'])) {

    $sql_update = pg_query($db, "

    UPDATE members_candidates SET is_present=true,mem_no='$mem_no', for_chairperson=$chairman, for_vice_chairperson=$vicechairman, for_secretary=$secretary, for_treasurer=$treasurer, for_auditor=$auditor  WHERE mem_no='$mem_no';
    
    ") or die ("Could not match data because ".pg_last_error());

    }
    
    session_unset();
    session_destroy();
    die ("<script>window.location.href=\"pt_election_attendance_select.php?remarks=Success\"</script>");           
  }


 


    $sc_acctno=$_SESSION['sc_acctno_attendance']; 
    $birthdate=$_SESSION['birthdate_attendance']; 

    $sql = pg_query($db, "SELECT *,(select organization from organizations where ou_code=members_ou_code) FROM members  WHERE  sc_acctno='$sc_acctno' and  birthdate='$birthdate' and membership_status_id in (1,2);") or die ("Could not match data because ".pg_last_error());

    $num=pg_num_rows($sql);
    
    $row=pg_fetch_assoc($sql);


?>


<style>

.w1 {
  width: 20;
  border: 1px solid black;
}    
</style>    
<script>
  /*
        $(document).ready(function() {
          $("#myForm").submit(function(e) {
                e.preventDefault(); // Prevent the form from submitting immediately

                // Display a confirmation dialog
                if (confirm("Are you sure you want to submit the form?")) {
                    // If user confirms, submit the form
                    return true;
                    //this.submit();
                } else {
                   return false;
                    // If user cancels, do nothing
                }
            });
        });
*/        
</script>



</head>
<body>

 <div class="container-fluid">
 <BR>
<?php
include "title.php";
?>
   <h3 class="text-center">PT Election Attendance</h3><br>


<form autocomplete="off" role="form"  id="myForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" >


<div class="row">
    <div class="col-3">
      
    </div>
    <div class="col-3 text-right" ><input type=hidden name="mem_no" value="<?php echo $row['mem_no']; ?>">
    <input type=hidden name="sc_acctno" value="<?php echo $sc_acctno; ?>">
      <b>Account No.:</b>
    </div>

    <div class="col-3 text-left">
      <?php echo $sc_acctno; ?>
    </div>
    <div class="col-3">
      
    </div>
</div> 

<div class="row">
      <div class="col-3">
      
      </div>  

    <div class="col-3 text-right" >
      <b>Name:</b>
    </div>

    <div class="col-4 text-left">
      <?php echo $row['last_name'].",".$row['first_name']; ?>
    </div>

    <div class="col-2">
      
    </div>    

</div> 

<div class="row">
    <div class="col-3">
      
    </div> 

    <div class="col-3 text-right" >
      <b>PT No.:</b>
    </div>

    <div class="col-3 text-left">
      <?php echo $row['organization']; ?>
    </div>

    <div class="col-3">
      
    </div>     

</div> 

<?php
 if ($row['membership_status_id']==1 && $row['membership_date'] < '2023-07-01') {
?>

<div class="row justify-content-center">
    <div class="col-1">      
    </div>
    <div class="col-5 text-right" >
      <b>Vote Code:(<i>Isulat sa papel ang code na ito</i>)</b>
    </div>

    <div class="col-3 text-left text-danger">
      <b><?php echo $row['code']; ?></b>
    </div>
    <div class="col-3">      
    </div>    

</div> 

<br>

<?php
    $sql_candidate = pg_query($db, "SELECT * from members_candidates where mem_no='$row[mem_no]' limit 1 ;") or die ("Could not match data because ".pg_last_error());

    $num_candidate=pg_num_rows($sql_candidate);
    
if ($num_candidate==1)    {
?>

<br>
<div class="row">

    <div class="col-12 text-center" >
      <b>You are nominated to all the positions below:</b><input type=hidden name="update_candidate" value="<?php echo "update_candidate"; ?>">
    </div>


</div> 

<br>

<div class="row justify-content-center">

    <div class="col-12 text-center" >
      Choose one (1) or more preferred position/s:
    </div>

</div> 

<br>













<div class="row justify-content-center">

    <div class="col-6 text-right" >
    <input class="form-check-input" name="chairman" type="checkbox"  id="flexCheckDefault">
    </div>

    <div class="col-6 text-left" >
    <label class="form-check-label" for="flexCheckDefault">
   Chairman
  </label>
    </div> 

</div> 

<div class="row justify-content-center">

    <div class="col-6 text-right" >
    <input class="form-check-input" name="vicechairman" type="checkbox" id="flexCheckDefault1">
    </div>        

    <div class="col-6 text-left" >
    <label class="form-check-label" for="flexCheckDefault1">
   Vice Chairman
  </label>
    </div>       


</div> 


<div class="row justify-content-center">

   

    <div class="col-6 text-right" >
    <input class="form-check-input" name="secretary" type="checkbox" id="flexCheckDefault2">
    </div>        

    <div class="col-6 text-left" >
    <label class="form-check-label" for="flexCheckDefault2">
   Secretary
  </label>
    </div> 

</div> 

<div class="row justify-content-center">

    <div class="col-6 text-right" >
    <input class="form-check-input" name="treasurer" type="checkbox"  id="flexCheckDefault3">
    </div>        

    <div class="col-6 text-left" >
    <label class="form-check-label" for="flexCheckDefault3">
   Treasurer
  </label>
    </div> 

</div> 

<div class="row justify-content-center">

    <div class="col-6 text-right" >
    <input class="form-check-input" name="auditor" type="checkbox"  id="flexCheckDefault4">
    </div>        

    <div class="col-6 text-left" >
    <label class="form-check-label" for="flexCheckDefault4">
   Auditor
  </label>
    </div> 

</div> 
<?php
}
}
?>
<br>
          <!-- Add more form inputs here if needed -->
          <div class="text-center">
 <!--             
            <button type="submit" onclick="if (confirm('Are you sure?')) return true; else return false;" name="submit_attendance" class="btn btn-primary">Submit</button>
 
 
-->

 <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
 Submit
</button>       
            &nbsp;&nbsp;

<a href="pt_election_attendance_select.php?cancel=1" id="cancel" name="cancel" class="btn btn-danger">Cancel</a>

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
                <input type="submit"  id="submit_attendance" name="submit_attendance" class="btn btn-success" value="Yes">
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




