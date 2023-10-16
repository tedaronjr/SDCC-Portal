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
$(document).ready(function(){
  $("#Cancel2_btn").click(function(){

    window.location.href='voters_login.php';
   
  });
});
</script>


<?php

    if (isset($_POST['Proceed1'])) {

        $ag1 = $_POST['ag1'];
        if ($ag1=="Oo") {
            $ag1 = $_POST['ag1'];
        }
        else {
            header('Location: voters_login.php');
        }        


    } 
    else {
        header('Location: voters_login.php');
    }   

?>

</head>

<body>




<div class="container">
  <BR>
  <?php
include "title.php";
?>

  <br>
  <form autocomplete="off" role="form" method="post" action="submit_ag2.php">


<br>
    <div class="row">
      <div class="col-12 text-center">
        <h3>Proposed Amendments In SDCC's Article Of Cooperation And By-Laws</h3>
      </div>
    </div>

    <div class="row">
      <div class="col-12">

        
        Sinasang-ayunan ang mga mungkahing pagbabago sa Articles of Cooperation and By-Laws na tinalakay sa General Assembly through PT District Recessing from time to time mula Marso 5-12, 2022.        
      </div>
    </div>  

    <div class="row">
   <div class="col-12 text-center">    
     <input class="form-check-input" type="radio" name="ag2" id="exampleRadios1" value="Oo" required>
        <label class="form-check-label" for="exampleRadios1"><b>Oo</b></label>
    
   </div> 
  </div> 
  
  <div class="row">
   <div class="col-12 text-center"> &nbsp; &nbsp;  
    <input class="form-check-input" type="radio" name="ag2" id="exampleRadios2" value="Hindi" required>
        <label class="form-check-label" for="exampleRadios2"><b>Hindi</b></label>
    
  </div>
 </div>
   <br>
   <div class="col text-center">
   <button type="submit" class="btn btn-primary"  name="Proceed2">Proceed</button>
   <button type="button" class="btn btn-primary" id ="Cancel2_btn"  name ="Cancel2" >Cancel</button>

</div>

</div>  






 </form>
<BR><BR><BR><BR><BR><BR>
<?php
include "footer.php";
?>
</body>
</html>
