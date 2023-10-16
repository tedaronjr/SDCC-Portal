<?php
 include "db_connect.php";
 if (isset($_POST['submit_'])) { 
 $sc_acctno=$_POST['sc_acctno']; 
 $birthdate=$_POST['birthdate'];
 }
 else {
  echo "<script>window.location.href='MIGS_check.php?msg=x'</script>";
 } 
$year = date("Y");
$yeardiff = $year - 1961;
?>

<!DOCTYPE html>
<html>
<head>
    <title>MIGS Inquiry</title>
<?php
include "scriptlink.php";

setlocale(LC_MONETARY,"en_PH.UTF-8"); 
$num_mem=0;
$sql_mem = pg_query($db, "SELECT a.* FROM jar_coop_member a left join members_standing_scores b on a.sc_acctno=b.sc_acctno WHERE  a.sc_acctno='$sc_acctno' and  birthdate='$birthdate';") or die ("Could not match data because ".pg_last_error());
$num_mem=pg_num_rows($sql_mem);
$row = pg_fetch_assoc($sql_mem);


$sql_standingscore = pg_query($db, "select  *, replace(total,'%', '')::numeric as total_score from members_standing_scores where sc_acctno='$sc_acctno' limit 1;") or die ("Could not match data because ".pg_last_error());
$rowss = pg_fetch_assoc($sql_standingscore);
?> 

<script>

$(document).ready(function(){


$('#sc_acctno').mask('00-00000');

$("#submit_acctno").click(function(){	
 if($("#sc_acctno").val().length < 8) {
  alert('7 digits required for sc acctno');
  $("#sc_acctno").focus();
  $("#sc_acctno").css("border-color","#FF0000");
  return false;
 }
});


$("#submit_lastname").click(function(){	

var last_Length = $('#last_name').val().length;
if(last_Length > 1) {
	$('#myForm1').submit()
}	
else {
   //alert(last_Length + ' minimum of two char length required');
   alert(' minimum of three char length required');
   $("#last_name").focus();
   $("#last_name").css("border-color","#FF0000");   
   return false;
}
});

$('#mmaster_data').DataTable( {"bLengthChange": false,"searching": false,
	paging: false,"lengthMenu": [[5, 25, 50, -1], [5, 25, 50, "All"]]
	}
	);  
});
</script>  
</head>

<body>

<div class="container">
  <BR>
  <?php
include "title.php";
?>
<?php

 if($num_mem>0) {

?>

<br><BR>

  <div class="row">
      <div class="col-12">
      Account No.:&nbsp;&nbsp;<b><?php echo $row['sc_acctno']?> </b>   
       </div>
  </div>  

  <div class="row">
      <div class="col-12">
        
        Name:&nbsp;&nbsp;<b><?php echo $row['last_name'].",".$row['first_name']." ".$row['middle_name']; ?> </b>
      </div>
  </div>    

  <div class="row">
      <div class="col-12">
        PT No.:&nbsp;&nbsp;<b><?php echo $row['pt_no']?> </b>
      </div>
  </div>  
  
  <div class="row">
      <div class="col-12">
      Membership Status:&nbsp;&nbsp;<b>       
        <?php 
        if ($rowss['total_score']>=78){
         echo "<b  style='color:GREEN'>MIGS</b>&nbsp;&nbsp; ".$rowss['total_score']; echo "% / 125%";
        }
        else {
         echo "<b  style='color:red'>NOT MIGS</b>&nbsp;&nbsp; ".$rowss['total_score'] ; echo "% / 125%";
        }
        ?> 
</b>
      </div>
  </div>      
<br>
<?php 
        if ($rowss['total_score']>=78){

?> 

    <div class="row">
      <div class="col-12">
        Paalala para sa kasaping MIGS:
      </div>
    </div>   
<br>
<div class="row">
      <div class="col-12">
      Congratulations!
      </div>
</div>
<br>
    <div class="row">
      <div class="col-12">
      Malugod naming ipinapaalam sa inyo na kayo ay Member in Good Standing (MIGS) at kwalipikadong makaboto sa darating na ika-<?php echo "$yeardiff "; ?> Pantaunang Pangkalahatang Halalan (Annual General Election).

     </div>
    </div>  
<br>
    <div class="row">
      <div class="col-12">
      Sa pamamagitan ng “Electronic Communication” isasagawa ang Online Election ng SDCC. Ang Election ay magsisimula sa Marso 18, <?php echo $year ?> ng hapon pagkatapos ng Representative Assembly at matatapos sa Marso 25, <?php echo $year ?> ng 1:05 ng hapon, Manila, Philippines Time.

      
            <b style="text-decoration: underline"></b> 
      </div>
    </div>  
    <br>    
    <div class="row">
      <div class="col-12">
      Upang makaboto, may Election Passcode ang bawat kasapi na nakasaad sa inyong MIGS Notice. Mahigpit na ipinagbabawal ang pag “share” ng Passcode sa iba.
                                      
      </div>
    </div>

    <br>    
    <div class="row">
      <div class="col-12">
      <b>Election Passcode:</b>&nbsp;<b style="color: red"> <?php echo  $row['passcode']; ?></b>
      </div>
    </div>    
    
    <br>
    <div class="row">
      <div class="col-12">
      Inaasahan namin ang inyong patuloy na pakikilahok at pakikipagtulungan sa ating Kooperatiba.
      </div>
    </div>
    <br>


    <div class="row">
      <div class="col-12">
       Maraming Salamat at pagpalain tayo ng Poong Maykapal.
      </div>
    </div>      




<?php
        }
        else {

?>        
<div class="row">
      <div class="col-12">
      Paalala para sa kasaping Not-MIGS:
      </div>
</div>
   
<br>

<div class="row">
  <div class="col-12">
  Maaaring ayusin o i-update ang inyong account upang maging MIGS (Member in Good Standing) at makamit ang karapatan at pribilehiyo gaya ng pagboto sa Pantaunang Pangkalahatang Halalan (Annual General Election). Ang pagsasaayos ng inyong account ay hanggang Marso 25, <?php echo $year ?> ng 12:00 ng tanghali.                                    
  </div>  
</div>

<br>

<div class="row">
      <div class="col-12">
      Sa pamamagitan ng “Electronic Communication” isasagawa ang Online Election ng SDCC. Ang Election ay magsisimula sa Marso 18, <?php echo $year ?> ng hapon pagkatapos ng Representative Assembly at matatapos sa Marso 25, <?php echo $year ?> ng 1:05 ng hapon, Manila, Philippines Time.
      </div>
</div>

<br>

<div class="row">
      <div class="col-12">
      Makipag-ugnayan kay Bb. Icee G. Calma, Acting Member Records Admin. Officer o Gng. Elena E. Ferrer, MDMSS Group Head sa numero bilang 0998-2823650 / 0995-2736558 /  0995-4189630 para sa inyong katanungan at iba pang paglilinaw sa inyong estado bilang kasapi.      
    </div>
</div>

<br>

<div class="row">
  <div class="col-12">
      Maraming Salamat at pagpalain tayo ng Poong Maykapal!                            
  </div>
</div>

    <?php
        }
      
    ?>      
<br>
    <div class="row">
      <div class="col-12">
      <b>Breakdown of Scores:                          </b>
     </div>
    </div>   
    
    <br>
    <div class="row">
      <div class="col-12">
      <b>Financial:                          </b>
     </div>
    </div>  
    <br>
    <div class="row">
      <div class="col-4">
       Loan: 
      </div>
      <div class="col-8">
       <?php echo $rowss['loans'];?> 
      </div>

    </div> 
    <div class="row">
      <div class="col-4">
       Share Capital: 
      </div>
      <div class="col-8">
       <?php echo $rowss['share_capital_depositv'];?> 
      </div>
    </div>
    <div class="row">
      <div class="col-4">
      Savings and Services: 
      </div>
      <div class="col-8">
       <?php echo $rowss['savings_time_deposit'] ;?> 
      </div>
    </div> 
    <br>

    <div class="row">
      <div class="col-12">
      <b>Social:                          </b>
     </div>
    </div>  
    <br>
    <div class="row">
      <div class="col-4">
      Coop Activities:      
     </div>
      <div class="col-8">
       <?php echo $rowss['koop_activities'];?> 
      </div>
    </div>     

    <br>
    <div class="row">
      <div class="col-12">
      <b>Bonus Points:                          </b>
     </div>
    </div>  
    <br>
    <div class="row">
      <div class="col-4">
      Recruitment:      
     </div>
      <div class="col-8">
       <?php echo $rowss['recruit'] ;?> 
      </div>
    </div> 
    <div class="row">
      <div class="col-4">
      Additional Share Capital:      
     </div>
      <div class="col-8">
       <?php echo $rowss['share_capital_deposit_additional'] ;?> 
      </div>
    </div>         
    <div class="row">
      <div class="col-4">
      Planong Damayan Contribution:      
     </div>
      <div class="col-8">
       <?php echo $rowss['planong_damayan'];?> 
      </div>
    </div>
    <div class="row">
      <div class="col-4">
      Assistance to DL:
        </div>
      <div class="col-8">
       <?php echo '';?> 
      </div>
    </div>              

    <br>
    <div class="row">
      <div class="col-12">
      <b>Patronage of Other Services:                          </b>
     </div>
    </div>  
    <br>
    <div class="row">
      <div class="col-4">
      Botica:
    </div>
      <div class="col-8">
       <?php echo $rowss['botica_de_san_dionisio'] ;?> 
      </div>
    </div> 
    <div class="row">
      <div class="col-4">
      Rental:
        </div>
      <div class="col-8">
       <?php echo $rowss['rentals'];?> 
      </div>
    </div>         
    <div class="row">
      <div class="col-4">
      Insurance:      
     </div>
      <div class="col-8">
       <?php echo $rowss['insurance'] ;?> 
      </div>
    </div>
    <div class="row">
      <div class="col-4">
      Bayad Center:
            </div>
      <div class="col-8">
       <?php echo $rowss['bayad_center'] ;?> 
      </div>
    </div>  

    <br>
    <div class="row">
      <div class="col-4">
      <b>Total:</b>
            </div>
      <div class="col-8">
       <?php echo $rowss['total'] ;?> 
      </div>
    </div>    
  
<br>

<?php 
        if ($rowss['total_score']>=78){
?>            
<div class="row">
      <div class="col-12">
      Bilang isang MIGS ang mga sumusunod na pribilehiyo at karapatan ay inyong matatamasa:
                            </div>
</div>
<br>
<div class="row">
      <div class="col-12">
      Karapatang maiboto, kung kwalipikado sa ating Annual General Election at PT Election.
      </div>
</div>
<br>
<div class="row">
      <div class="col-12">
      Karapatang makaboto sa ating Annual General Election at PT Election.    
      </div>
</div>
<br>
<div class="row">
      <div class="col-12">
      Pribilehiyong maka-utang ng 100% ng inyong approved credit limit, matapos ikonsidera ang iba pang patakaran.      
    </div>
</div>

<?php
        } else {
?>        
 

<div class="row">
      <div class="col-12">
      Sang-ayon sa polisiya, ang pagiging Not-MIGS ay maaari ng mabago anumang oras matapos ang takdang cut-off sa pamamagitan ng pagsasaayos ng partikular na dahilan (criteria/criterion) nito. Kinakailangang mag-apply ang kasapi ng UPDATE ng kaniyang estado. Hinihikayat at inaanyayahan na patuloy nating gampanan ang mga tungkulin bilang mabuting kasapi ng ating kooperatiba at upang mapabilang tayo sa listahan ng MIGS at matatamas ang lahat ng mga karapatan at pribilehiyo ng ating samahan. Kung kayo at NOT MIGS dahil sa alin mang kadahilanan, maaaring gawin ang sumusunod:                            
    </div>   
</div> 
<br>
<div class="row">
      <div class="col-12">
      Loan - Sikapin na ma-update ang utang
          </div>
</div>
<br>
<div class="row">
      <div class="col-12">
      Share Capital - Sikaping ma-update ang ating  share capital
          </div>
</div>
<br>
<div class="row">
      <div class="col-12">
      Savings/Time Deposit - Mag-impok sa savings at/o time deposit
        </div>
</div>
<br>
<div class="row">
      <div class="col-12">
      PT Meeting - Magkaroon ng partisipasyon sa gawain ng kooperatiba
        </div>
</div>
<?php
        }
?>     
<BR><BR><BR>
<?php 
        if ($rowss['total_score']>=78){
         echo "<div class='col text-center'><a href='voters_login.php'>
         <button type='button' class='btn btn-primary'>Go to Voters Log in</button></a>
        </div>";
        }

?> 



</div> 




<?php
}
else {

  echo "<br>";
	echo "<div class='alert alert-danger'>";
	echo "<strong>Login failed</strong>";
	echo "</div>";
?>
   <h3 class="text-center"><?php echo "MIGS Checking"; ?></h3><br>

<form autocomplete="off" role="form"  id="myForm" method="post" >
	<div class="row">
		<div class="col-3">
		</div>
		<div class="col-3 text-right">
			Account No.:
		</div>

		<div class="col-3">
		 <input type="text" class="form-control"  placeholder="00-00000" id="sc_acctno" name="sc_acctno"  required >
		</div>

		<div class="col-3">
		</div>
	
	</div>
<!--</form>	-->
	<br>
<!--<form autocomplete="off" role="form"  id="myForm1" method="post" action="<?php //echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">-->
	<div class="row">
	<div class="col-3">
	</div>
	<div class="col-3 text-right">
			Birthdate:
	</div>	
	<div class="col-3">
	<input type="date" class="form-control"  placeholder="Enter birthdate" id="last_name" name="birthdate"  required   >			
	</div>
	<div class="col-3">
	</div>
	</div>	
	<br>
	<div class="text-center">
		 <input type="submit" class="btn btn-primary"  value="Submit"  name="submit_">
	</div>
</form>	
<?php

 
}    
?>


<BR><BR><BR><BR><BR><BR>
<?php
include "footer.php";
?>
</body>
</html>
