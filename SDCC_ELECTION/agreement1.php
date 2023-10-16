<?php
include "user_session.php";
?>

<!DOCTYPE html>
<html>
<head>
    <title>VOTERS AGREEMENT</title>
<?php
include "scriptlink.php";

setlocale(LC_MONETARY,"en_PH.UTF-8"); 
?> 
<script>
  /*
$(document).ready(function(){
  $("#ag1_form").submit(function(){

    var radioValue =  $("input[name='ag1']:checked").val();
                //alert("Your are a - " + radioValue);
   
  });



});*/
$(document).ready(function(){
  $("#Cancel1_btn").click(function(){

    window.location.href='voters_login.php';
   
  });
/*
  $('#agform').submit(function(e) {
  e.preventDefault(); // Stop your form from submitting.
  if (!$("input[name='ag1']:checked").val()) {
    alert("test");
    //$('#errorInPopup').html('Please select close reason');
    return false;
  } else {
    this.submit();
  }
});
*/

});
</script>

</head>

<body>




<div class="container">
  <BR>
  <?php
include "title.php";
?>
  <br><BR>

    <div class="row">
      <div class="col-12 text-center">
        <h3>Integrity and Confidentiality Clause</h3>
      </div>
    </div>
   
  <form autocomplete="off" role="form" method="post" id="ag1_form" action="submit_ag2.php" >


    <div class="row">
      <div class="col-12">

        
        Data Privacy Act of 2012 Ang iyong personal na impormasyon at karapatang pampribado ay aming pinahahalagahan, kung kaya kaming nasa SDCC ay naghahangad na makasunod sa mga batas at obligasyong pampribado tungkol sa pangongolekta, paggamit, pagbabahagi, pagpapahayag pag-iingat at pagpapasiya ng mga kaugnay na impormasyong personal bilang pagtalima sa itinatagubiling pamantayan ng RA 10173 (Data Privacy Act of 2012).
        
      </div>
    </div>  

<br>
  <div class="row">
   <div class="col-12 text-center">    
     <input class="form-check-input" type="radio" name="ag1" id="exampleRadios1" value="Oo" required>
        <label class="form-check-label" for="exampleRadios1"><b>Oo</b></label>
    
   </div> 
  </div> 
  
  <div class="row">
   <div class="col-12 text-center"> &nbsp; &nbsp;  
    <input class="form-check-input" type="radio" name="ag1" id="exampleRadios2" value="Hindi" required>
        <label class="form-check-label" for="exampleRadios2"><b>Hindi</b></label>
    
  </div>
 </div>
   <br>
   <div class="col text-center">
   <button type="submit" class="btn btn-primary"  id="Proceed1_btn" name="Proceed1">Proceed</button>
   <button type="button" class="btn btn-primary"  id ="Cancel1_btn" name="Cancel1">Cancel</button>

</div>

</div>  






 </form>
<BR><BR><BR><BR><BR><BR>
<?php
include "footer.php";
?>
</body>
</html>
