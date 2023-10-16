<style>
.checkbox-2x {
    transform: scale(2);
    -webkit-transform: scale(2);
}
</style>

<script>
  $(document).ready(function() {
    $('#pt_member_detail').DataTable({
    "searching": true,
    paging: true,
   // scrollCollapse: true,
   // scrollY: '200px'
    });


    // Wait for the document to be fully loaded before binding the event
    $("#unlockptmeeting").change(function() {
      if (this.checked) {
        // Call the function when the checkbox is checked
        var checkboxValue = $(this).val();
       // alert('open '+ checkboxValue);
        unlock_ptmeeting("open",checkboxValue);
      //console.log("Checkbox value: " + checkboxValue);        
      }
      else {
        var checkboxValue = $(this).val();
       // alert('close '+ checkboxValue);
        unlock_ptmeeting("closed",checkboxValue);                
      }
    });


    
    $("#unlockvoting").change(function() {
     
        // Call the function when the checkbox is checked
        var selectedValue = $(this).val();
        if (selectedValue != 0) {
          //alert('open '+ selectedValue);
          unlockvoting(selectedValue);
        }

    });    
    

    $("#can_chairperson").change(function() {
      if (this.checked) {
        // Call the function when the checkbox is checked
        var mem_no_checkboxValue = $(this).val();       
        member_can('true',mem_no_checkboxValue,'for_chairperson');      
      }
      else {
        var mem_no_checkboxValue = $(this).val();       
        member_can('false',mem_no_checkboxValue,'for_chairperson');  
     }
    });


    $("#can_vicechairperson").change(function() {
      if (this.checked) {
        // Call the function when the checkbox is checked
        var mem_no_checkboxValue = $(this).val();       
        member_can('true',mem_no_checkboxValue,'for_vice_chairperson');      
      }
      else {
        var mem_no_checkboxValue = $(this).val();       
        member_can('false',mem_no_checkboxValue,'for_vice_chairperson');  
     }
    });   
    
    $("#can_secretary").change(function() {
      if (this.checked) {
        // Call the function when the checkbox is checked
        var mem_no_checkboxValue = $(this).val();       
        member_can('true',mem_no_checkboxValue,'for_secretary');      
      }
      else {
        var mem_no_checkboxValue = $(this).val();       
        member_can('false',mem_no_checkboxValue,'for_secretary');  
     }
    });  
    
    $("#can_treasurer").change(function() {
      if (this.checked) {
        // Call the function when the checkbox is checked
        var mem_no_checkboxValue = $(this).val();       
        member_can('true',mem_no_checkboxValue,'for_treasurer');      
      }
      else {
        var mem_no_checkboxValue = $(this).val();       
        member_can('false',mem_no_checkboxValue,'for_treasurer');  
     }
    }); 
    
    $("#can_auditor").change(function() {
      if (this.checked) {
        // Call the function when the checkbox is checked
        var mem_no_checkboxValue = $(this).val();       
        member_can('true',mem_no_checkboxValue,'for_auditor');      
      }
      else {
        var mem_no_checkboxValue = $(this).val();       
        member_can('false',mem_no_checkboxValue,'for_auditor');  
     }
    });
    
    /*
    $("#chairperson_win").change(function() {
      if (this.selected) {
        // Call the function when the checkbox is checked
        var mem_no_checkboxValue = $(this).val();       
        winner_pos(1,mem_no_checkboxValue);      
      }

    });  

    $("#vicechairperson_win").change(function() {
      if (this.checked) {
        // Call the function when the checkbox is checked
        var mem_no_checkboxValue = $(this).val();       
        winner_pos(2,mem_no_checkboxValue);      
      }
      else {
        var mem_no_checkboxValue = $(this).val();       
        winner_pos('null',mem_no_checkboxValue);      
     }
    });  


    $("#secretary_win").change(function() {
      if (this.checked) {
        // Call the function when the checkbox is checked
        var mem_no_checkboxValue = $(this).val();       
        winner_pos(3,mem_no_checkboxValue);      
      }
      else {
        var mem_no_checkboxValue = $(this).val();       
        winner_pos('null',mem_no_checkboxValue);      
     }
    });     
    
    $("#treasurer_win").change(function() {
      if (this.checked) {
        // Call the function when the checkbox is checked
        var mem_no_checkboxValue = $(this).val();       
        winner_pos(4,mem_no_checkboxValue);      
      }
      else {
        var mem_no_checkboxValue = $(this).val();       
        winner_pos('null',mem_no_checkboxValue);      
     }
    });  


    $("#auditor_win").change(function() {
      if (this.checked) {
        // Call the function when the checkbox is checked
        var mem_no_checkboxValue = $(this).val();       
        winner_pos(5,mem_no_checkboxValue);      
      }
      else {
        var mem_no_checkboxValue = $(this).val();       
        winner_pos('null',mem_no_checkboxValue);      
     }
    });      
*/
    
  });   
  
  function member_can(param,param2,param3) {
                    
                    $.ajax({
                        url : "pt_election_member_can_update_present_ajax.php",
                        type : "post",
                        dataType:"text",
                        data : {
                             bolyan: param , mem_no: param2 , pos: param3
                        },
                        success : function (a){
                        //    $('#member_voting_details').html(a);
						//	$('#myModal').modal('show');
                        alert('member no ' + param2 + ' update ' + param3  + ' success');
                        }
                    });
   }        

 

  function unlock_ptmeeting(param,param2) {
    bootbox.confirm({title: '', centerVertical: true,
                                message: 'Are you sure you want to Unlock/Lock PT Meeting?',
                                buttons: {
                                confirm: {
                                label: 'Yes',
                                className: 'btn-success'
                                },
                                cancel: {
                                label: 'No',
                                className: 'btn-danger'
                                }
                                },
                                callback: function (result) {
                                  if(result){
                    $.ajax({
                        url : "pt_election_unlock_ptmeeting_ajax.php",
                        type : "post",
                        dataType:"text",
                        data : {
                             id: param , org_id: param2
                        },
                        success : function (a){
                        //    $('#member_voting_details').html(a);
						//	$('#myModal').modal('show');
                      //  alert(param + ' unlock/lock pt meeting success');
                        $('#pt_panel').html(a);
                        }
                    });
                  }  
                  else {
    
      if ($("#unlockptmeeting").prop("checked")){
        $("#unlockptmeeting").prop("checked", false);
      } else {
        $("#unlockptmeeting").prop("checked", true);
      }      
    } 
                  console.log('This was logged in the callback: ' + result);
                  }
   
    
    });   

 
  }	 


function unlockvoting(param) {  
  bootbox.confirm({title: '', centerVertical: true,
                                message: 'Are you sure you want to Unlock/Lock Voting?',
                                buttons: {
                                confirm: {
                                label: 'Yes',
                                className: 'btn-success'
                                },
                                cancel: {
                                label: 'No',
                                className: 'btn-danger'
                                }
                                },
                                callback: function (result) {
                                  if(result){

                                    $.ajax({
                                    url : "pt_election_unlock_voting_ajax.php",
                                    type : "post",
                                    dataType:"text",
                                    data : {
                                    id: param 
                                    },
                                    success : function (a){
                                      $('#pt_panel').html(a);

                                     }
                                    });
        
                                  }  
                                console.log('This was logged in the callback: ' + result);
                                }




  });
}    


/*
        function unlockvoting(param) {
                    
                    $.ajax({
                        url : "pt_election_unlock_voting_ajax.php",
                        type : "post",
                        dataType:"text",
                        data : {
                             id: param 
                        },
                        success : function (a){
						//	$('#myModal').modal('show');
                       // alert(param + ' unlock/lock voting success');
                        $('#pt_panel').html(a);

                        }
                    });
        }   
*/        

        function winner_pos(param,param2) {
                  
                    $.ajax({
                        url : "pt_election_member_can_update_position_ajax.php",
                        type : "post",
                        dataType:"text",
                        data : {
                             pos: param, mem_no: param2 
                        },
                        success : function (a){

                        alert(param2 + ' update winner success');
                        }
                    });
        }          

  

</script>

<?php

include "db_connect.php";



$sql_members = pg_query($db, "

SELECT sc_acctno,concat(last_name, ',',first_name) as fullname,code,mem_no,
case
 when (select count(*) from attendance where attendance.mem_no=members.mem_no)>0 then 
'Yes'
else
'No'
end::varchar as attend

,(select organization from organizations where organizations.organization_id=members.organization_id),
       birthdate
  FROM public.members where membership_status_id=1 and organization_id='$_POST[id]' and  membership_date < '2023-07-01'  order by sc_acctno;


") or die ("Could not match data because ".pg_last_error()); 
$num_members=pg_num_rows($sql_members);


$sql_members_can = pg_query($db, "

SELECT mc.*,members.mem_no,sc_acctno,concat(last_name, ',',first_name) as fullname,code
,(select organization from organizations where organizations.organization_id=members.organization_id)
       birthdate
       FROM members 
  join members_candidates mc
  on  mc.mem_no=members.mem_no      
  
  where organization_id='$_POST[id]' and is_present=true order by sc_acctno;


") or die ("Could not match data because ".pg_last_error()); 
$num_members_can=pg_num_rows($sql_members_can);

 
$sql_org_voting = pg_query($db, "select *,(select organization from organizations where organizations.organization_id=organizations_voting.organization_id) from organizations_voting where organization_id='$_POST[id]' order  by organization_id;") or die ("Could not match data because ".pg_last_error());
$num_org=pg_num_rows($sql_org_voting);
$row_org = pg_fetch_assoc($sql_org_voting);


$sql_pos = pg_query($db, "select * from positions order  by position_id;") or die ("Could not match data because ".pg_last_error());
$num_pos=pg_num_rows($sql_pos);

//$sql_quorum = pg_query($db, "SELECT organization_id, quorum FROM pt_election_quorum_checker where organization_id='$row_org[organization_id]' and quorum=true limit 1;") or die ("Could not match data because ".pg_last_error());
//$num_quorum=pg_num_rows($sql_quorum);

$sql_quorum = pg_query($db, "
with quorum as (
  select count(*)::integer as migs_attend from attendance where mem_no in
 (
  select mem_no from members where organization_id='$row_org[organization_id]' and  membership_date < '2023-07-01' and membership_status_id=1   
 )
 )
 select (select count(*) * .25 from members where organization_id='$row_org[organization_id]'  and  membership_date < '2023-07-01' and membership_status_id=1) as migs,migs_attend,migs_attend/nullif(round((select  count(*)  from members where organization_id='$row_org[organization_id]'  and  membership_date < '2023-07-01' and membership_status_id=1),2),0)as migs_25  from quorum;
 ") or die ("Could not match data because ".pg_last_error()); 
 $num_quorum=pg_num_rows($sql_quorum);

$sql_votes = pg_query($db, "

select * from members a join 
(
select members_candidates.*,
(select count(*) from pt_election_master where candidate_mem_no=members_candidates.mem_no and position_id=1)::integer as votecount,
(select concat(last_name,',',first_name,' ',middle_name) from members where members.mem_no=members_candidates.mem_no)::varchar as fullname 
from members_candidates where for_chairperson=true
)
b
on a.mem_no=b.mem_no where organization_id='$row_org[organization_id]'
order by votecount desc

") or die ("Could not match data because ".pg_last_error());
$num_votes=pg_num_rows($sql_votes);

$sql_viceChairperson = pg_query($db, "

select * from members a join 
(
select members_candidates.*,
(select count(*) from pt_election_master where candidate_mem_no=members_candidates.mem_no and position_id=2)::integer as votecount,
(select concat(last_name,',',first_name,' ',middle_name) from members where members.mem_no=members_candidates.mem_no)::varchar as fullname 
from members_candidates where for_vice_chairperson=true
)
b
on a.mem_no=b.mem_no where organization_id='$row_org[organization_id]'
order by votecount desc

") or die ("Could not match data because ".pg_last_error());
$num_vice=pg_num_rows($sql_viceChairperson);

$sql_secretary = pg_query($db, "

select * from members a join 
(
select members_candidates.*,
(select count(*) from pt_election_master where candidate_mem_no=members_candidates.mem_no and position_id=3)::integer as votecount,
(select concat(last_name,',',first_name,' ',middle_name) from members where members.mem_no=members_candidates.mem_no)::varchar as fullname 
from members_candidates where for_secretary=true
)
b
on a.mem_no=b.mem_no where organization_id='$row_org[organization_id]'
order by votecount desc
") or die ("Could not match data because ".pg_last_error());
$num_secretary=pg_num_rows($sql_secretary);

$sql_treasurer = pg_query($db, "

select * from members a join 
(
select members_candidates.*,
(select count(*) from pt_election_master where candidate_mem_no=members_candidates.mem_no and position_id=4)::integer as votecount,
(select concat(last_name,',',first_name,' ',middle_name) from members where members.mem_no=members_candidates.mem_no)::varchar as fullname 
from members_candidates where for_treasurer=true
)
b
on a.mem_no=b.mem_no where organization_id='$row_org[organization_id]'
order by votecount desc
") or die ("Could not match data because ".pg_last_error());
$num_treasurer=pg_num_rows($sql_treasurer);

$sql_auditor = pg_query($db, "

select * from members a join 
(
select members_candidates.*,
(select count(*) from pt_election_master where candidate_mem_no=members_candidates.mem_no and position_id=5)::integer as votecount,
(select concat(last_name,',',first_name,' ',middle_name) from members where members.mem_no=members_candidates.mem_no)::varchar as fullname 
from members_candidates where for_auditor=true
)
b
on a.mem_no=b.mem_no where organization_id='$row_org[organization_id]'
order by votecount desc
") or die ("Could not match data because ".pg_last_error());
$num_auditor=pg_num_rows($sql_auditor);


$sql_expectedvote = pg_query($db, "

select * from members where membership_status_id=1 and organization_id='$row_org[organization_id]' and  membership_date < '2023-07-01'

") or die ("Could not match data because ".pg_last_error());
$num_expectedvote=pg_num_rows($sql_expectedvote);


$sql_migsnon = pg_query($db, "

select * from members where membership_status_id in (1,2) and organization_id='$row_org[organization_id]' and  membership_date < '2023-07-01'

") or die ("Could not match data because ".pg_last_error());
$num_migsnon=pg_num_rows($sql_migsnon);


$is_open_voting= pg_query($db, "

select * from organizations_voting where is_open_voting=true and (
  chairperson_status=true or vice_chairperson_status=true or secretary_status=true or treasurer_status=true or auditor_status=true or vice_chairperson_status=true) 
  and organization_id='$row_org[organization_id]' limit 1
  
") or die ("Could not match data because ".pg_last_error()); 
$num_is_open_voting=pg_num_rows($is_open_voting);
$row_isopen_voting = pg_fetch_assoc($is_open_voting);


$refused_1 = pg_query($db, "

select * from pt_election_master where refused_to_vote=true and position_id=1 and mem_no in (select mem_no from members where organization_id='$row_org[organization_id]')

") or die ("Could not match data because ".pg_last_error());
$num_refused_1=pg_num_rows($refused_1);

$refused_2 = pg_query($db, "

select * from pt_election_master where refused_to_vote=true and position_id=2 and mem_no in (select mem_no from members where organization_id='$row_org[organization_id]')

") or die ("Could not match data because ".pg_last_error());
$num_refused_2=pg_num_rows($refused_2);

$refused_3 = pg_query($db, "

select * from pt_election_master where refused_to_vote=true and position_id=3 and mem_no in (select mem_no from members where organization_id='$row_org[organization_id]')

") or die ("Could not match data because ".pg_last_error());
$num_refused_3=pg_num_rows($refused_3);

$refused_4 = pg_query($db, "

select * from pt_election_master where refused_to_vote=true and position_id=4 and mem_no in (select mem_no from members where organization_id='$row_org[organization_id]')

") or die ("Could not match data because ".pg_last_error());
$num_refused_4=pg_num_rows($refused_4);

$refused_5 = pg_query($db, "

select * from pt_election_master where refused_to_vote=true and position_id=5 and mem_no in (select mem_no from members where organization_id='$row_org[organization_id]')

") or die ("Could not match data because ".pg_last_error());
$num_refused_5=pg_num_rows($refused_5);
?> 




<br>
<div class="row justify-content-center">
        <div class="col-2 text-right">
            PT No.:
        </div>
        <div class="col-2 text-left">
           <b> <?php echo "$row_org[organization]"; ?></b><input type="hidden" class="form-control-plaintext"  value="" required  readonly >
        </div>
</div>

<div class="row justify-content-center">
        <div class="col-2 text-right">
          <label  for="unlockptmeeting">Unlock PT Meeting:</label>
        </div>
        <div class="col-2 text-left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php 
if ($_POST['open'] =='t') 
   echo "<input class=\"form-check-input checkbox-2x\" type=\"checkbox\" id=\"unlockptmeeting\" value='$row_org[organization_id]' checked >";
else 
   echo "<input class=\"form-check-input checkbox-2x\" type=\"checkbox\" id=\"unlockptmeeting\" value='$row_org[organization_id]' >";  
?>
        </div>
</div>

<?php
  $row_q = pg_fetch_assoc($sql_quorum);
  if ($num_quorum==1 && $_POST['open'] =='t') {
    if ($row_q['migs_25'] >= .25 )
     $d="";
    else
     $d="disabled";
  } 
  else {
    $d="disabled";
  }   
?>
<div class="row justify-content-center">
        <div class="col-2 text-right">
          <label  for="inlineCheckbox2">Unlock/Lock Voting:</label>
        </div>
        <div class="col-2">
            <select  class="form-control" id="unlockvoting" name="unlockvoting"  <?php echo $d; ?>  required >
             
            <?php		  
                //while($row_pos = pg_fetch_assoc($sql_pos)) 
                //{ 
                  if ($row_isopen_voting['chairperson_status'] =='t') {
                    echo "<option value=\"0_$row_org[organization_id]\">Closed</option>";
		                echo "<option selected value=\"1_$row_org[organization_id]\">Chairperson</option>";
                    echo "<option value=\"2_$row_org[organization_id]\">Vice Chairperson</option>";
                    echo "<option value=\"3_$row_org[organization_id]\">Secretary</option>";
                    echo "<option value=\"4_$row_org[organization_id]\">Treasurer</option>";  
                    echo "<option value=\"5_$row_org[organization_id]\">Auditor</option>";                                        
                  }  
                  elseif ($row_isopen_voting['vice_chairperson_status'] =='t') {
                    echo "<option value=\"0_$row_org[organization_id]\">Closed</option>";
		                echo "<option value=\"1_$row_org[organization_id]\">Chairperson</option>";
                    echo "<option selected value=\"2_$row_org[organization_id]\">Vice Chairperson</option>";
                    echo "<option value=\"3_$row_org[organization_id]\">Secretary</option>";
                    echo "<option value=\"4_$row_org[organization_id]\">Treasurer</option>";  
                    echo "<option value=\"5_$row_org[organization_id]\">Auditor</option>";  
                  }                     
                  elseif ($row_isopen_voting['secretary_status'] =='t') {
                    echo "<option value=\"0_$row_org[organization_id]\">Closed</option>";
		                echo "<option value=\"1_$row_org[organization_id]\">Chairperson</option>";
                    echo "<option value=\"2_$row_org[organization_id]\">Vice Chairperson</option>";
                    echo "<option selected  value=\"3_$row_org[organization_id]\">Secretary</option>";
                    echo "<option value=\"4_$row_org[organization_id]\">Treasurer</option>";  
                    echo "<option value=\"5_$row_org[organization_id]\">Auditor</option>";    
                  }
                  elseif ($row_isopen_voting['treasurer_status'] =='t') {
                    echo "<option value=\"0_$row_org[organization_id]\">Closed</option>";
		                echo "<option value=\"1_$row_org[organization_id]\">Chairperson</option>";
                    echo "<option value=\"2_$row_org[organization_id]\">Vice Chairperson</option>";
                    echo "<option value=\"3_$row_org[organization_id]\">Secretary</option>";
                    echo "<option selected  value=\"4_$row_org[organization_id]\">Treasurer</option>";  
                    echo "<option value=\"5_$row_org[organization_id]\">Auditor</option>"; 
                  }  
                  elseif ($row_isopen_voting['auditor_status'] =='t') {
                    echo "<option value=\"0_$row_org[organization_id]\">Closed</option>";
		                echo "<option value=\"1_$row_org[organization_id]\">Chairperson</option>";
                    echo "<option value=\"2_$row_org[organization_id]\">Vice Chairperson</option>";
                    echo "<option value=\"3_$row_org[organization_id]\">Secretary</option>";
                    echo "<option value=\"4_$row_org[organization_id]\">Treasurer</option>";  
                    echo "<option selected  value=\"5_$row_org[organization_id]\">Auditor</option>"; 
                  }
                  else {
                    echo "<option selected value=\"0_$row_org[organization_id]\">Closed</option>";
		                echo "<option value=\"1_$row_org[organization_id]\">Chairperson</option>";
                    echo "<option value=\"2_$row_org[organization_id]\">Vice Chairperson</option>";
                    echo "<option value=\"3_$row_org[organization_id]\">Secretary</option>";
                    echo "<option value=\"4_$row_org[organization_id]\">Treasurer</option>";  
                    echo "<option value=\"5_$row_org[organization_id]\">Auditor</option>"; 
                  }                                                             
                //}
            ?>	   
            </select>        
        </div>
</div>
<?php
 //}
?>

<br><br>

   <h3 class="text-center"><?php echo "Member Voting Details"; ?></h3>
  <br>
  <div class="table-responsive">
<?php    
    
echo '<table id="pt_member_detail"  class="table table-striped table-bordered table-hover text-center">';
echo '<thead class="bg-primary"><tr>';

echo "<td align='center'><b>Account No.</b></td>";
echo "<td align='center'><b>Name</b></td>";
echo "<td align='center'><b>Vote Code</b></td>";
echo "<td align='center'><b>PT No</b></td>";
echo "<td align='center'><b>Birthdate</b></td>";
echo "<td align='center'><b>Mem No.</b></td>";
echo "<td align='center'><b>Attendance</b></td>";
echo '</tr></thead>';

echo '<tbody>';

while ($row = pg_fetch_assoc($sql_members)) 
{
    echo "<tr id=trhover >";
    echo "<td align='center'>$row[sc_acctno]</td>";
    echo "<td align='center'>$row[fullname]</td>";
    echo "<td align='center'>$row[code]</td>";
    echo "<td align='center'>$row[organization]</td>";
    echo "<td align='center'>$row[birthdate]</td>";
    echo "<td align='center'>$row[mem_no]</td>";
    echo "<td align='center'>$row[attend]</td>";









    echo '</tr>';
} 

echo '</tbody>'; 


 echo "</table>";
?> 
</div> 
<br>


<br>
   <h3 class="text-center"><?php echo "Member Candidates Details"; ?></h3>
  <br>
  <div class="table-responsive">
<?php    
    
echo '<table  class="table table-striped table-bordered table-hover text-center">';
echo '<thead class="bg-primary"><tr>';

echo "<td align='center'><b>Name</b></td>";
echo "<td align='center'><b>Chairperson</b></td>";
echo "<td align='center'><b>Vice Chairperson</b></td>";
echo "<td align='center'><b>Secretary</b></td>";
echo "<td align='center'><b>Treasurer</b></td>";
echo "<td align='center'><b>Auditor</b></td>";
echo '</tr></thead>';

echo '<tbody>';

while ($row = pg_fetch_assoc($sql_members_can)) 
{

  //$elec_master = pg_query($db, "select * from pt_election_master where candidate_mem_no='$row[mem_no]' limit 1;") or die ("Could not match data because ".pg_last_error());
  
  
  
  $pos_1 = pg_query($db, "select * from members_candidates where  (position_id is not null and position_id=1 and mem_no='$row[mem_no]') limit 1;") or die ("Could not match data because ".pg_last_error());
  $pos_win1=pg_num_rows($pos_1);
  
  $pos_2 = pg_query($db, "select * from members_candidates where   (position_id is not null and position_id=2 and mem_no='$row[mem_no]')  limit 1;") or die ("Could not match data because ".pg_last_error());
  $pos_win2=pg_num_rows($pos_2);

  $pos_3 = pg_query($db, "select * from members_candidates where    (position_id is not null and position_id=3 and mem_no='$row[mem_no]')  limit 1;") or die ("Could not match data because ".pg_last_error());
  $pos_win3=pg_num_rows($pos_3);

  $pos_4 = pg_query($db, "select * from members_candidates where   (position_id is not null and position_id=4 and mem_no='$row[mem_no]')  limit 1;") or die ("Could not match data because ".pg_last_error());
  $pos_win4=pg_num_rows($pos_4);

  $pos_5 = pg_query($db, "select * from members_candidates where    (position_id is not null and position_id=5 and mem_no='$row[mem_no]')  limit 1;") or die ("Could not match data because ".pg_last_error());
  $pos_win5=pg_num_rows($pos_5);


  $ppos_1 = pg_query($db, "select * from members_candidates where  (position_id is not null and position_id=1)  limit 1;") or die ("Could not match data because ".pg_last_error());
  $ppos_win1=pg_num_rows($ppos_1);
  
  $ppos_2 = pg_query($db, "select * from members_candidates where  (position_id is not null and position_id=2)   limit 1;") or die ("Could not match data because ".pg_last_error());
  $ppos_win2=pg_num_rows($ppos_2);

  $ppos_3 = pg_query($db, "select * from members_candidates where  (position_id is not null and position_id=3) limit 1;") or die ("Could not match data because ".pg_last_error());
  $ppos_win3=pg_num_rows($ppos_3);

  $ppos_4 = pg_query($db, "select * from members_candidates where  (position_id is not null and position_id=4)   limit 1;") or die ("Could not match data because ".pg_last_error());
  $ppos_win4=pg_num_rows($ppos_4);

  $ppos_5 = pg_query($db, "select * from members_candidates where  (position_id is not null and position_id=5) limit 1;") or die ("Could not match data because ".pg_last_error());
  $ppos_win5=pg_num_rows($ppos_5);



    echo "<tr id=trhover >";

    echo "<td align='center'>$row[fullname]</td>";


if ($pos_win1==1 || $pos_win2==1 || $pos_win3==1 || $pos_win4==1 || $pos_win5==1){
  
     echo "<td align='center'></td>";
}
else {
/*
  if ($ppos_win1==1 )  
    echo "<td align='center'></td>";
  else { 
*/
  if ($row['for_chairperson']=='t')
     echo "<td align='center'><input checked class=\"form-check-input\" type=\"checkbox\" id=\"_can_chairperson\"  onclick=\"member_can('false','$row[mem_no]','for_chairperson')\"   value=\"$row[mem_no]\"></td>";
    else
     echo "<td align='center'><input class=\"form-check-input\" type=\"checkbox\" id=\"_can_chairperson\"  onclick=\"member_can('true','$row[mem_no]','for_chairperson')\"    value=\"$row[mem_no]\"></td>";
//  }
}


if ($pos_win1==1 || $pos_win2==1 || $pos_win3==1 || $pos_win4==1 || $pos_win5==1){
  
  echo "<td align='center'></td>";
}
else {
/*
  if ($ppos_win2==1 )  
    echo "<td align='center'></td>";
  else {   
*/
  if ($row['for_vice_chairperson']=='t')
  echo "<td align='center'><input checked class=\"form-check-input\" type=\"checkbox\" id=\"_can_vicechairperson\"  onclick=\"member_can('false','$row[mem_no]','for_vice_chairperson')\"    value=\"$row[mem_no]\"></td>";
 else
  echo "<td align='center'><input class=\"form-check-input\" type=\"checkbox\" id=\"_can_vicechairperson\"  onclick=\"member_can('true','$row[mem_no]','for_vice_chairperson')\"    value=\"$row[mem_no]\"></td>";
 // }
}

if ($pos_win1==1 || $pos_win2==1 || $pos_win3==1 || $pos_win4==1 || $pos_win5==1){
  
  echo "<td align='center'></td>";
}
else {
/*
  if ($ppos_win3==1 )  
    echo "<td align='center'></td>";
  else {   
*/
  if ($row['for_secretary']=='t')
  echo "<td align='center'><input checked class=\"form-check-input\" type=\"checkbox\" id=\"_can_secretary\"  onclick=\"member_can('false','$row[mem_no]','for_secretary')\"    value=\"$row[mem_no]\"></td>";
 else
  echo "<td align='center'><input class=\"form-check-input\" type=\"checkbox\" id=\"_can_secretary\"  onclick=\"member_can('true','$row[mem_no]','for_secretary')\"    value=\"$row[mem_no]\"></td>";
 // }
}

if ($pos_win1==1 || $pos_win2==1 || $pos_win3==1 || $pos_win4==1 || $pos_win5==1){
  
  echo "<td align='center'></td>";
}
else {
/*
  if ($ppos_win4==1 )  
    echo "<td align='center'></td>";
  else {     
*/
  if ($row['for_treasurer']=='t')
  echo "<td align='center'><input checked class=\"form-check-input\" type=\"checkbox\" id=\"_can_treasurer\"  onclick=\"member_can('false','$row[mem_no]','for_treasurer')\"    value=\"$row[mem_no]\"></td>";
 else
  echo "<td align='center'><input class=\"form-check-input\" type=\"checkbox\" id=\"_can_treasurer\"  onclick=\"member_can('true','$row[mem_no]','for_treasurer')\"    value=\"$row[mem_no]\"></td>";
 // }
}

if ($pos_win1==1 || $pos_win2==1 || $pos_win3==1 || $pos_win4==1 || $pos_win5==1){
  
  echo "<td align='center'></td>";
}
else {
/*
  if ($ppos_win5==1 )  
    echo "<td align='center'></td>";
  else {   
*/
  if ($row['for_auditor']=='t')
  echo "<td align='center'><input checked class=\"form-check-input\" type=\"checkbox\" id=\"_can_auditor\"  onclick=\"member_can('false','$row[mem_no]','for_auditor')\"    value=\"$row[mem_no]\"></td>";
 else
  echo "<td align='center'><input class=\"form-check-input\" type=\"checkbox\" id=\"_can_auditor\"  onclick=\"member_can('true','$row[mem_no]','for_auditor')\"    value=\"$row[mem_no]\"></td>";
 // }
}




  //  echo "<td colspan=5 align='center'><b>Meron ng bumoto hindi muna pwede i edit ang position</b></td>";








    echo '</tr>';
} 

echo '</tbody>'; 


 echo "</table>";
?> 
</div> 
<br>


<div id='tab_position'>
<nav>
  <div class="nav nav-tabs" id="nav-tab" role="tablist">
    <a class="nav-item nav-link active" id="Chairperson-tab" data-toggle="tab" href="#Chairperson" role="tab" aria-controls="Chairperson" aria-selected="true">Chairperson</a>
    <a class="nav-item nav-link" id="viceChairperson-tab" data-toggle="tab" href="#viceChairperson" role="tab" aria-controls="viceChairperson" aria-selected="true">Vice Chairperson</a>
    <a class="nav-item nav-link" id="secretary-tab" data-toggle="tab" href="#secretary" role="tab" aria-controls="secretary" aria-selected="true">Secretary</a>
    <a class="nav-item nav-link" id="treasurer-tab" data-toggle="tab" href="#treasurer" role="tab" aria-controls="treasurer" aria-selected="true">Treasurer</a>
    <a class="nav-item nav-link" id="auditor-tab" data-toggle="tab" href="#auditor" role="tab" aria-controls="auditor" aria-selected="true">Auditor</a>

  </div>
</nav>
<div class="tab-content" id="nav-tabContent">
  <div class="tab-pane fade show active" id="Chairperson" role="tabpanel" aria-labelledby="Chairperson-tab">
  <?php    
    
    echo '<table  class="table table-striped table-bordered table-hover text-center">';
    echo '<thead class="bg-primary"><tr>';
    
    echo "<td align='center'><b>Name</b></td>";
    echo "<td align='center'><b>No. of Votes</b></td>";
    echo "<td align='center'><b>Winner</b></td>";

    
    echo '</tr></thead>';
    
    echo '<tbody>';
    $chairperson_sum_vote=0;
    while ($row = pg_fetch_assoc($sql_votes)) 
    {
      $chairperson_sum_vote=$row['votecount'] + $chairperson_sum_vote;
        echo "<tr>";
        echo "<td align='center'>$row[fullname]</td>";
        echo "<td align='center'>$row[votecount]</td>";
        if ($row['position_id']<>null && $row['position_id']<>1) {
          echo "<td align='center'>Already winner from other position</td>";
        }        
        elseif ($row['position_id']==1) {
          echo "<td align='center'><input CHECKed class=\"form-check-input\" type=\"radio\"  id=\"chairperson_win\"  name=\"chairperson_win\" onclick=\"winner_pos(1,'$row[mem_no]')\"   value=\"$row[mem_no]\"></td>";
        }
        else {
        echo "<td align='center'><input class=\"form-check-input\" type=\"radio\"  id=\"chairperson_win\"  name=\"chairperson_win\" onclick=\"winner_pos(1,'$row[mem_no]')\"   value=\"$row[mem_no]\"></td>";
        }
        echo '</tr>';
    } 
    echo "<tr>";
    echo "<td align='center'><b>Total</b></td>";
    echo "<td align='center'><b>$chairperson_sum_vote</b></td>";
    echo "<td align='center'></td>";
    echo '</tr>';

    echo '</tbody>'; 
    
    
     echo "</table>";
    ?> 
<br>
<div class="row justify-content-center">
        <div class="col-2 text-right">
          <b>Chairperson empty Votes:</b>
        </div>
        <div class="col-2">
 
            <?php		  

		           echo $num_refused_1;

            ?>	   
        </div>
</div>  
  </div>

  <div class="tab-pane fade" id="viceChairperson" role="tabpanel" aria-labelledby="viceChairperson-tab">
  <?php    
    
    echo '<table  class="table table-striped table-bordered table-hover text-center">';
    echo '<thead class="bg-primary"><tr>';
    
    echo "<td align='center'><b>Name</b></td>";
    echo "<td align='center'><b>No. of Votes</b></td>";
    echo "<td align='center'><b>Winner</b></td>";

    
    echo '</tr></thead>';
    
    echo '<tbody>';
    $vicechairperson_sum_vote=0;
    while ($row = pg_fetch_assoc($sql_viceChairperson)) 
    {
      $vicechairperson_sum_vote=$row['votecount'] + $vicechairperson_sum_vote;
        echo "<tr>";
        echo "<td align='center'>$row[fullname]</td>";
        echo "<td align='center'>$row[votecount]</td>";
        if ($row['position_id']<>null && $row['position_id']<>2) {
          echo "<td align='center'>Already winner from other position</td>";
        }        
        elseif ($row['position_id']==2) {
          echo "<td align='center'><input CHECKed class=\"form-check-input\" type=\"radio\"  id=\"vicechairperson_win\"  name=\"vicechairperson_win\" onclick=\"winner_pos(2,'$row[mem_no]')\"   value=\"$row[mem_no]\"></td>";
        }
        else {
        echo "<td align='center'><input class=\"form-check-input\" type=\"radio\"  id=\"vicechairperson_win\"  name=\"vicechairperson_win\" onclick=\"winner_pos(2,'$row[mem_no]')\"   value=\"$row[mem_no]\"></td>";
        }        
        echo '</tr>';
    } 
    echo "<tr>";
    echo "<td align='center'><b>Total</b></td>";
    echo "<td align='center'><b>$vicechairperson_sum_vote</b></td>";
    echo "<td align='center'></td>";
    echo '</tr>';    
    echo '</tbody>'; 
    
    
     echo "</table>";
    ?> 
<br>
<div class="row justify-content-center">
        <div class="col-2 text-right">
          <b>Vice Chairperson empty Votes:</b>
        </div>
        <div class="col-2">
 
            <?php		  

		           echo $num_refused_2;

            ?>	   
        </div>
</div> 
  </div>

  <div class="tab-pane fade" id="secretary" role="tabpanel" aria-labelledby="secretary-tab">
  <?php    
    
    echo '<table  class="table table-striped table-bordered table-hover text-center">';
    echo '<thead class="bg-primary"><tr>';
    
    echo "<td align='center'><b>Name</b></td>";
    echo "<td align='center'><b>No. of Votes</b></td>";
    echo "<td align='center'><b>Winner</b></td>";

    
    echo '</tr></thead>';
    
    echo '<tbody>';
    $secretary_sum_vote=0;
    while ($row = pg_fetch_assoc($sql_secretary)) 
    {
      $secretary_sum_vote=$row['votecount'] + $secretary_sum_vote;
        echo "<tr>";
        echo "<td align='center'>$row[fullname]</td>";
        echo "<td align='center'>$row[votecount]</td>";
        if ($row['position_id']<>null && $row['position_id']<>3) {
          echo "<td align='center'>Already winner from other position</td>";
        }        
        elseif  ($row['position_id']==3) {
          echo "<td align='center'><input CHECKed class=\"form-check-input\" type=\"radio\"  id=\"secretary_win\"  name=\"secretary_win\" onclick=\"winner_pos(3,'$row[mem_no]')\"   value=\"$row[mem_no]\"></td>";
        }
        else {
        echo "<td align='center'><input class=\"form-check-input\" type=\"radio\"  id=\"secretary_win\"  name=\"secretary_win\" onclick=\"winner_pos(3,'$row[mem_no]')\"   value=\"$row[mem_no]\"></td>";
        }          
        echo '</tr>';
    } 
    echo "<tr>";
    echo "<td align='center'><b>Total</b></td>";
    echo "<td align='center'><b>$secretary_sum_vote</b></td>";
    echo "<td align='center'></td>";
    echo '</tr>';    
    echo '</tbody>'; 
    
    
     echo "</table>";
    ?> 
<br>
<div class="row justify-content-center">
        <div class="col-2 text-right">
          <b>Secretary empty Votes:</b>
        </div>
        <div class="col-2">
 
            <?php		  

		           echo $num_refused_3;

            ?>	   
        </div>
</div>  
  </div>  

  <div class="tab-pane fade" id="treasurer" role="tabpanel" aria-labelledby="treasurer-tab">
  <?php    
    
    echo '<table  class="table table-striped table-bordered table-hover text-center">';
    echo '<thead class="bg-primary"><tr>';
    
    echo "<td align='center'><b>Name</b></td>";
    echo "<td align='center'><b>No. of Votes</b></td>";
    echo "<td align='center'><b>Winner</b></td>";

    
    echo '</tr></thead>';
    
    echo '<tbody>';
    $treasurer_sum_vote=0;
    while ($row = pg_fetch_assoc($sql_treasurer)) 
    {
      $treasurer_sum_vote=$row['votecount'] + $treasurer_sum_vote;
        echo "<tr>";
        echo "<td align='center'>$row[fullname]</td>";
        echo "<td align='center'>$row[votecount]</td>";
        if ($row['position_id']<>null && $row['position_id']<>4) {
          echo "<td align='center'>Already winner from other position</td>";
        }        
        elseif ($row['position_id']==4) {
          echo "<td align='center'><input CHECKed class=\"form-check-input\" type=\"radio\"  id=\"treasurer_win\"  name=\"treasurer_win\" onclick=\"winner_pos(4,'$row[mem_no]')\"   value=\"$row[mem_no]\"></td>";
        }
        else {
        echo "<td align='center'><input class=\"form-check-input\" type=\"radio\"  id=\"treasurer_win\"  name=\"treasurer_win\" onclick=\"winner_pos(4,'$row[mem_no]')\"   value=\"$row[mem_no]\"></td>";
        }           
        echo '</tr>';
    } 
    echo "<tr>";
    echo "<td align='center'><b>Total</b></td>";
    echo "<td align='center'><b>$treasurer_sum_vote</b></td>";
    echo "<td align='center'></td>";
    echo '</tr>'; 
    echo '</tbody>'; 
    
    
     echo "</table>";
    ?> 
<br>
<div class="row justify-content-center">
        <div class="col-2 text-right">
          <b>Treasurer empty Votes:</b>
        </div>
        <div class="col-2">
 
            <?php		  

		           echo $num_refused_4;

            ?>	   
        </div>
</div> 
  </div>
  
  <div class="tab-pane fade" id="auditor" role="tabpanel" aria-labelledby="auditor-tab">
  <?php    
    
    echo '<table  class="table table-striped table-bordered table-hover text-center">';
    echo '<thead class="bg-primary"><tr>';
    
    echo "<td align='center'><b>Name</b></td>";
    echo "<td align='center'><b>No. of Votes</b></td>";
    echo "<td align='center'><b>Winner</b></td>";

    
    echo '</tr></thead>';
    
    echo '<tbody>';
    $auditor_sum_vote=0;
    while ($row = pg_fetch_assoc($sql_auditor)) 
    {
      $auditor_sum_vote=$row['votecount'] + $auditor_sum_vote;
        echo "<tr>";
        echo "<td align='center'>$row[fullname]</td>";
        echo "<td align='center'>$row[votecount]</td>";
        if ($row['position_id']<>null && $row['position_id']<>5) {
          echo "<td align='center'>Already winner from other position</td>";
        }        
        elseif ($row['position_id']==5) {
          echo "<td align='center'><input CHECKed class=\"form-check-input\" type=\"radio\"  id=\"auditor_win\"  name=\"auditor_win\" onclick=\"winner_pos(5,'$row[mem_no]')\"   value=\"$row[mem_no]\"></td>";
        }
        else {
        echo "<td align='center'><input class=\"form-check-input\" type=\"radio\"  id=\"auditor_win\"  name=\"auditor_win\" onclick=\"winner_pos(5,'$row[mem_no]')\"   value=\"$row[mem_no]\"></td>";
        }           
        echo '</tr>';
    } 
    echo "<tr>";
    echo "<td align='center'><b>Total</b></td>";
    echo "<td align='center'><b>$auditor_sum_vote</b></td>";
    echo "<td align='center'></td>";
    echo '</tr>';    
    echo '</tbody>'; 
    
    
     echo "</table>";
    ?> 
<br>
<div class="row justify-content-center">
        <div class="col-2 text-right">
          <b>Auditor empty Votes:</b>
        </div>
        <div class="col-2">
 
            <?php		  

		           echo $num_refused_5;

            ?>	   
        </div>
</div>
  </div>  

<br>

<div class="row justify-content-center">
        <div class="col-2 text-right">
          <b>Quorum:</b>
        </div>
        <div class="col-2">
 
            <?php		  

		            echo "$row_q[migs_attend]/$row_q[migs]";

            ?>	   
        </div>
</div>
<br>
<div class="row justify-content-center">
        <div class="col-2 text-right">
          <b>Expected Voters:</b>
        </div>
        <div class="col-2">
 
            <?php		  

		            echo $num_expectedvote;

            ?>	   
        </div>
</div>
<br>
<div class="row justify-content-center">
        <div class="col-2 text-right">
          <b>Active Members(MIGS/NON MIGS):</b>
        </div>
        <div class="col-2">
 
            <?php		  

		            echo $num_migsnon;

            ?>	   
        </div>
</div>
<?php $sum_vote=$chairperson_sum_vote + $vicechairperson_sum_vote + $secretary_sum_vote + $treasurer_sum_vote + $auditor_sum_vote; ?>
<!--
<br>
<div class="row justify-content-center">
        <div class="col-2 text-right">
          <b>Actual No. of Votes:</b>
        </div>
        <div class="col-2">
 
            <?php		  

		           // echo $sum_vote;$num_refused_5

            ?>	   
        </div>
</div>
  -->


 

 


</div><!-- id tab_position -->

<br>


<div class="text-center" ><a target="_blank"  href="<?php echo "pt_election_com_report.php?org_id=$row_org[organization_id]";  ?>" class='btn btn-primary'>Print</a></div> 




</div>


