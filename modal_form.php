<?php
include "db_connect.php";
if (isset($_POST['acctno']))  {
$sql_memscore = pg_query($db, "SELECT a.*,b.sc_acctno,
 replace(koop_activities,'%','') as koop_activities, replace(share_capital_depositv,'%','') as share_capital_depositv, 
       replace(savings_time_deposit,'%','') as savings_time_deposit, replace(loans,'%','') as loans, replace(recruit,'%','') as recruit, replace(share_capital_deposit_additional,'%','') as share_capital_deposit_additional, 
       replace(planong_damayan,'%','') as planong_damayan, replace(botica_de_san_dionisio,'%','') as botica_de_san_dionisio, replace(rentals,'%','') as rentals,replace(insurance,'%','') as insurance, 
       replace(bayad_center,'%','') as bayad_center, replace(total,'%','') as total
,concat(last_name,',',first_name,' ',middle_name) as fullname,a.sc_acctno as acctno FROM members a left join members_standing_scores b on a.sc_acctno=b.sc_acctno WHERE a.sc_acctno='$_POST[acctno]';") or die ("Could not match data because ".pg_last_error());
$num_memscore=pg_num_rows($sql_memscore);
$row_memscore = pg_fetch_assoc($sql_memscore);

?> 
<script>
$(document).ready(function(){
/*
    $('#loan').keyup(total_v);
    $('#sc_dep').keyup(total_v);

function total_v() {

var totalscore = parseFloat($('#loan').val()) + parseFloat($('#sc_dep').val())
    $('#total_').val(totalscore) ;
}
*/

$(function(){
            $('#loan, #sc_dep,#sd, #ca,#recruit, #scadd,#pd, #botica, #rental, #insurance, #bayad_center').keyup(function(){
               var value1 = parseFloat($('#loan').val()) || 0;
               var value2 = parseFloat($('#sc_dep').val()) || 0;
               var value3 = parseFloat($('#sd').val()) || 0;
               var value4 = parseFloat($('#ca').val()) || 0;
               var value5 = parseFloat($('#recruit').val()) || 0;               
               var value6 = parseFloat($('#scadd').val()) || 0; 
               var value7 = parseFloat($('#pd').val()) || 0;   
               var value8 = parseFloat($('#botica').val()) || 0;  
               var value9 = parseFloat($('#rental').val()) || 0;   
               var value10 = parseFloat($('#insurance').val()) || 0;  
               var value11 = parseFloat($('#bayad_center').val()) || 0;                              
               $('#total_').val(value1 + value2 + value3 +value4 + value5 + value6 + value7 +value8 + value9 +value10 + value11);
            });
         });
});


</script>
<form autocomplete="off"   method="post" action="update_score.php">

 <div class="modal" id="myModal" >
    <div class="modal-dialog modal-xl">
     <div class="modal-content">
      
        
        <div class="modal-header">
         <h4 class="modal-title">Update Member Score</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
        <div class="row">
            <div class="col-3">  
               <b> Account No.:</b>
            </div>
            <div class="col-2">  
                <b><?php echo "$row_memscore[acctno]"; ?></b>
                <input type=hidden class="form-control"  name=acctno value='<?php echo "$row_memscore[acctno]"; ?>'  >
            </div>                            
        </div> 
        <br>
        <div class="row">
            <div class="col-3">  
                <b>Financial:</b>
            </div>
            <div class="col-2">  
            </div>                            
        </div> 
        <br>
        <div class="row">
            <div class="col-3">  
                Loan:
            </div>
            <div class="col-2">  
                <input type=number step="0.01" class="form-control"  id=loan    name=loans  value='<?php echo "$row_memscore[loans]"; ?>' required >
            </div>                            
        </div>
        <div class="row">
            <div class="col-3">  
                Share Capital:
            </div>
            <div class="col-2">  
                <input type=number step="0.01" class="form-control"     name=share_capital_depositv id=sc_dep value='<?php echo "$row_memscore[share_capital_depositv]"; ?>' required >
            </div>                            
        </div> 
        <div class="row">
            <div class="col-3">  
                Savings and Services:
            </div>
            <div class="col-2">  
                <input type=number step="0.01" class="form-control"     name=savings_time_deposit id=sd value='<?php echo "$row_memscore[savings_time_deposit]"; ?>' required >
            </div>                            
        </div>                          
        <br>
        <div class="row">
            <div class="col-3">  
               <b> Social:</b>
            </div>
            <div class="col-2">  
            </div>                            
        </div> 
        <br>
        <div class="row">
            <div class="col-3">  
                Coop Activities:
            </div>
            <div class="col-2">  
                <input type=number step="0.01" class="form-control"  name=koop_activities id=ca  value='<?php echo "$row_memscore[koop_activities]"; ?>' required >
            </div>                            
        </div>
        <br>
        <div class="row">
            <div class="col-3">  
               <b> Bonus Points:</b>
            </div>
            <div class="col-2">  
            </div>                            
        </div> 
        <br>
        <div class="row">
            <div class="col-3">  
                Recruitment:
            </div>
            <div class="col-2">  
                <input type=number step="0.01" class="form-control"     name=recruit id=recruit value='<?php echo "$row_memscore[recruit]"; ?>' required >
            </div>                            
        </div> 
        <div class="row">
            <div class="col-3">  
                Additional Share Capital:
            </div>
            <div class="col-2">  
                <input type=number step="0.01" class="form-control"  id=scadd    name=share_capital_deposit_additional  value='<?php echo "$row_memscore[share_capital_deposit_additional]"; ?>' required >
            </div>                            
        </div> 
        <div class="row">
            <div class="col-3">  
                Planong Damayan Contribution:
            </div>
            <div class="col-2">  
                <input type=number step="0.01" class="form-control" id=pd    name=planong_damayan  value='<?php echo "$row_memscore[planong_damayan]"; ?>' required >
            </div>                            
        </div>                 
        <div class="row">
            <div class="col-3">  
                Assistance to DL:
            </div>
            <div class="col-2">
            <input type=number step="0.01" class="form-control"   disabled >
            </div>                            
        </div> 
        <br>
        <div class="row">
            <div class="col-3">  
                <b>Patronage of Other Services:</b>
            </div>
            <div class="col-2">  
            </div>                            
        </div> 
        <br>
        <div class="row">
            <div class="col-3">  
                Botica:
            </div>
            <div class="col-2">  
                <input type=number step="0.01" class="form-control" id=botica     name=botica_de_san_dionisio  value='<?php echo "$row_memscore[botica_de_san_dionisio]"; ?>' required >
            </div>                            
        </div>
        <div class="row">
            <div class="col-3">  
                Rental:
            </div>
            <div class="col-2">  
                <input type=number step="0.01" class="form-control" id=rental    name=rentals  value='<?php echo "$row_memscore[rentals]"; ?>' required >
            </div>                            
        </div>        
        <div class="row">
            <div class="col-3">  
                Insurance:
            </div>
            <div class="col-2">  
                <input type=number step="0.01" class="form-control" id=insurance    name=insurance  value='<?php echo "$row_memscore[insurance]"; ?>' required >
            </div>                            
        </div>   
        <div class="row">
            <div class="col-3">  
                Bayad Center:
            </div>
            <div class="col-2">  
                <input type=number step="0.01" class="form-control" id=bayad_center    name=bayad_center  value='<?php echo "$row_memscore[bayad_center]"; ?>' required >
            </div>                            
        </div> 

        <br>
        <div class="row">
            <div class="col-3">  
                Total:
            </div>
            <div class="col-2">  
                <input type=number step="0.01" class="form-control"     name=total id=total_   readonly >
            </div>                            
        </div> 


        <div class="row">
            <div class="col-2">  
                
            </div>
            <div class="col-2">  
                <input type=submit  class="btn btn-primary" onclick="if (confirm('Are you sure?')) return true; else return false;" name=submit_score  value='Submit'>
            </div>                            
        </div>           
        

        </div>

        <!-- Modal footer -->

        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
 </div>
</form>
<?php  } ?>