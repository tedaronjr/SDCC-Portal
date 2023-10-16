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



});
</script>

</head>

<body>




<div class="container">
  <BR>
  <h1><span STYLE="color:blue;">SAN DIONISIO CREDIT COOPERATIVE</span></h1><hr>
  <br><BR>
   <h2 class="text-center">VOTERS AGREEMENT</h2>
  <br>
  <form autocomplete="off" role="form" method="post" id="ag1_form" action="agreement2.php" >

  <div class="row">
      <div class="col-xs-12">
        <b>Name:&nbsp;&nbsp;<?php echo $row['fullname']?> </b>
      </div>
  </div>  

  <div class="row">
      <div class="col-xs-12">
        <b>SC Account No:&nbsp;&nbsp;<?php echo $row['sc_acctno']?> </b>
      </div>
  </div>    

  <div class="row">
      <div class="col-xs-12">
        <b>PT No:&nbsp;&nbsp;<?php echo $row['pt_no']?> </b>
      </div>
  </div>    
<br>
    <div class="row">
      <div class="col-xs-12 center-block text-center">
        <h3>Integrity and Confidentiality Clause</h3>
      </div>
    </div>

    <div class="row">
      <div class="col-xs-12">

        <p>
        Data Privacy Act of 2012 Ang iyong personal na impormasyon at karapatang pampribado ay aming pinahahalagahan, kung kaya kaming nasa SDCC ay naghahangad na makasunod sa mga batas at obligasyong pampribado tungkol sa pangongolekta, paggamit, pagbabahagi, pagpapahayag pag-iingat at pagpapasiya ng mga kaugnay na impormasyong personal bilang pagtalima sa itinatagubiling pamantayan ng RA 10173 (Data Privacy Act of 2012).
        </p>
      </div>
    </div>  

    <div class="row">
     <div class="col-3 mx-auto">
        <div class="text-center">
        <div class="form-check">
        <input class="form-check-input" type="radio" name="ag1" id="exampleRadios1" value="Oo" required>
        <label class="form-check-label" for="exampleRadios1">
            Oo
        </label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="ag1" id="exampleRadios2" value="Hindi" required>
        <label class="form-check-label" for="exampleRadios2">
            Hindi
        </label>
    </div>
        </div>
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
