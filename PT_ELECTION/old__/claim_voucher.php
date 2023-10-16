<?php

session_start();
set_time_limit(0);

session_unset();

$year = date("Y");
$yeardiff = $year - 1961;
?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo "Claim Member Voucher"; ?></title>
<?php
include "scriptlink.php";

setlocale(LC_MONETARY,"en_PH.UTF-8"); 
?> 

<script>
$(document).ready(function() {
	
	$('#search').mask('00-00000');
	
   //On pressing a key on "Search box" in "search.php" file. This function will be called.
   $("#search").keyup(function() {
       //Assigning search box value to javascript variable named as "name".
       var nam = $('#search').val().length;
       var name = $('#search').val();

       //Validating, if "name" is empty.
       if (nam !=8 ) {
           //Assigning empty value to "display" div in "search.php" file.
           $("#display").html("");
       }
       //If name is not empty.
       else {
           //AJAX is called.
           $.ajax({
               //AJAX type is "Post".
               type: "POST",
               //Data will be sent to "ajax.php".
               url: "voucher_ajax.php",
               //Data, that will be sent to "ajax.php".
               data: {
                   //Assigning value of "name" into "search" variable.
                   search: name
               },
               //If result found, this funtion will be called.
               success: function(html) {
                   //Assigning result to "display" div in "search.php" file.
                   $("#display").html(html).show();
               }
           });
       }
   });
});

/*
$('#submit_sd').click(function(){
     
    alert('submitting');
    $('#formfield').submit();
});

function confirm_sub() {
  var txt;
  var r = confirm("Are you sure you want to close this account?");
  if (r == true) {
    submit();
  } else {
    return false;
  }
}
*/

</script>


<?php

if (isset($_POST['Claim'])) {

include "db_connect.php";

$sc_acctno = $_POST['sc_acctno'];
$fullname = $_POST['fullname'];
$mem_no = $_POST['mem_no'];
$loc_ = $_POST['loc_'];
//$passcode = $_POST['passcode'];
$pt_no = $_POST['pt_no'];
//$updated_at = $_POST['updated_at'];


$sql_add = pg_query($db, "INSERT INTO election_voucher(
  fullname, mem_no, sc_acctno, pt_no,updated_at,loc_,claimed)
 select '$fullname','$mem_no','$sc_acctno','$pt_no',current_timestamp,'$loc_','T';") or die ("Could not match data because ".pg_last_error());

//$add_num=pg_num_rows($sql_add);


//$row = pg_fetch_assoc($sql_check);





}
 

?> 



</head>

<body>




<div class="container">
<BR>
<?php
include "title.php";
?>

  <br><BR>
   <h3 class="text-center"><?php echo "Claim Member Voucher"; ?></h3>
  <br>

     <div class="row">
      <div class="col-3 col-lg-5">
      </div>
      <div class="col-6 col-lg-2">
        <b>Account No.:</b>
      </div> 
      <div class="col-3 col-lg-5">
      </div>    
    </div> 

    <div class="row">
      <div class="col-3 col-lg-5">
      </div>
      <div class="col-6 col-lg-2 text-center">
        <input type="text" class="form-control" placeholder="Account No."  name="search" id="search" required  >
      </div> 
      <div class="col-3 col-lg-5">
      </div>
    </div>



   
    <BR>
    <div class="row">

      <div class="col-12 text-center" id="display">
            
      </div> 
  
    </div> 








<BR><BR><BR><BR><BR><BR>
<?php
include "footer.php";
?>
</body>
</html>
