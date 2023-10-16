<?php
 include "admin_session.php";
?>
<!DOCTYPE html>
<html>
<head>

<?php
include "scriptlink.php";
?>

</head>
<body>
<?php
include "title.php";
?>


 <div class="container">
  <br><br>
  <h2>Search Claimed Giveaway
  </h2><hr>

  <form autocomplete="off" role="form"   method="POST" target="_blank" action="<?php echo "claimed_giveaway.php"; ?>" >

  <br>

    <b>Location</b>
    <select  class="form-control"  name="loc_" required > 
        <option value="MAIN" >MAIN</option>
        <option value="DASA">DASA</option>
        <option value="LPC">LP</option>
        <option value="TANZA">TANZA</option> 
        <option value="CONSOLIDATED">CONSOLIDATED</option> 
                   

    </select>
<br>
    <b>Date</b>
  <input  type="date" name="inqdate" class="form-control" REQUIRED   />
  <br><div class="text-center">
  <input type="submit" class="btn btn-primary"  name="submit"   />  
</div>

  </form>
 </div>


 <BR><BR><BR><BR><BR><BR>
 <?php
include "footer.php";
?>
</body>
</html> 
 




