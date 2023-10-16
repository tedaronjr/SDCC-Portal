
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">

  <!-- Links -->
  <ul class="navbar-nav">    
   <?php if ($_SESSION['admin_user']=="membership") { ?>
    <!--
    <li class="nav-item">
      <a class="nav-link" href="PT_ELECTION/pt_election_control_panel_table.php" target=_blank>PT Election Control Panel</a>
    </li>

    <li class="nav-item">
     
      <a class="nav-link" href="/SDCC_ELECTION/add_voter.php" target=_blank>Add/Remove Member Voter</a>
       <a class="nav-link" href="" target=_blank>Add/Remove Member Voter</a>

    </li>
     --> 

     <li class="nav-item dropdown">
        <a  class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        PT Election
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="PT_ELECTION/pt_election_control_panel_table.php"target=_blank >PT Election Control Panel</a> 
          <a class="dropdown-item"  href="add_member_candidate.php"target=_blank>Add/Remove PT Candidate</a>
          <a class="dropdown-item"  href="update_pt.php"target=_blank>Update Member PT</a>

         
         
           
        </div>
      </li>
      
      <li class="nav-item dropdown">
        <a  class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        General Election
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="SDCC_ELECTION/add_voter.php"target=_blank >Add/Remove Member Voter</a> 
          <a class="dropdown-item"  href="SDCC_ELECTION/novote.php"target=_blank>No Vote</a>
          <a class="dropdown-item"  href="SDCC_ELECTION/ptvotecount.php"target=_blank>PT Vote Count</a>
         
         
           
        </div>
      </li>  
 
    <li class="nav-item">
      <a class="nav-link" href="MIGS_check.php" target=_blank>MIGS Checking</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="update_bday.php" target=_blank>Update Birthdate</a>
    </li>  
    <li class="nav-item">
      <a class="nav-link" href="update_score.php" target=_blank>Update Score</a>
    </li>  

                    
   <?php } elseif ($_SESSION['admin_user']=="botica") { ?>
    <li class="nav-item">
      <a class="nav-link" href="SDCC_ELECTION/member_voucher.php" target=_blank>Claim Member Voter Voucher</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="SDCC_ELECTION/claimed_giveaway.php" target=_blank>Claimed List</a>
    </li>    
    <li class="nav-item">
      <a class="nav-link" href="SDCC_ELECTION/votednoclaim.php" target=_blank>Unclaimed List</a>
    </li>        
       
    <?php } elseif ($_SESSION['admin_user']=="elecom") { ?>
    <!-- Dropdown -->
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
        Vote Report
      </a>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="SDCC_ELECTION/statement_vote.php" target=_blank>Statement of Votes</a>
        <a class="dropdown-item" href="SDCC_ELECTION/summary_vote.php" target=_blank>Summary of Votes</a>
        <a class="dropdown-item" href="SDCC_ELECTION/tallysheet_vote.php" target=_blank>Tally Sheet</a>
      </div>
    </li>
    <li class="nav-item">
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

    </li> 
    <li class="nav-item">
     <?php if ($numlock==0  && date('Y-m-d H:i:s')< $row_end['start_date']  ) { ?>
    <form onsubmit="return confirm('Are you sure?');" autocomplete="off"  method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">


        <input type="hidden" class="form-control"  name="title_id" value="<?php echo "$row_start[title_id]"; ?>" required >
        <input type="submit" class="btn btn-primary"   value="OPEN ELECTION" id="open_election" name="start_election" >
       
    </form> 
    <?php }  ?>  
    </li> 
    
    <?php } elseif ($_SESSION['admin_user']=="audit") { ?>
    <!-- Dropdown -->
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
        Vote Report
      </a>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="SDCC_ELECTION/statement_vote.php" target=_blank>Statement of Votes</a>
        <a class="dropdown-item" href="SDCC_ELECTION/summary_vote.php" target=_blank>Summary of Votes</a>
        <a class="dropdown-item" href="SDCC_ELECTION/tallysheet_vote.php" target=_blank>Tally Sheet</a>
      </div>
    </li>
    <li class="nav-item">
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

    </li> 
    <li class="nav-item">
 
    </li> 
    
    <?php }  ?>

          
    <li class="nav-item">
      <a class="nav-link" href="admin_logout.php" target=_self>Log out</a>
    </li>       
  </ul>
</nav>
