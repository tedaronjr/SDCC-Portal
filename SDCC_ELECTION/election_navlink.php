
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">

  <!-- Links -->
  <ul class="navbar-nav">    
   <?php if ($_SESSION['admin_user']=="membership") { ?>
    <li class="nav-item">
      <a class="nav-link" href="add_voter.php" target=_blank>Add/Remove Member Voter</a>
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
    <li class="nav-item">
      <a class="nav-link" href="novote.php" target=_blank>No Vote</a>
    </li> 
    <li class="nav-item">
      <a class="nav-link" href="ptvotecount.php" target=_blank>PT Vote Count</a>
    </li>                     
   <?php } elseif ($_SESSION['admin_user']=="botica") { ?>
    <li class="nav-item">
      <a class="nav-link" href="member_voucher.php" target=_blank>Claim Member Voter Voucher</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="claimed_giveaway.php" target=_blank>Claimed List</a>
    </li>    
    <li class="nav-item">
      <a class="nav-link" href="votednoclaim.php" target=_blank>Unclaimed List</a>
    </li>        
       
    <?php } elseif ($_SESSION['admin_user']=="elecom") { ?>
    <!-- Dropdown -->
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
        Vote Report
      </a>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="statement_vote.php" target=_blank>Statement of Votes</a>
        <a class="dropdown-item" href="summary_vote.php" target=_blank>Summary of Votes</a>
        <a class="dropdown-item" href="tallysheet_vote.php" target=_blank>Tally Sheet</a>
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
        <a class="dropdown-item" href="statement_vote.php" target=_blank>Statement of Votes</a>
        <a class="dropdown-item" href="summary_vote.php" target=_blank>Summary of Votes</a>
        <a class="dropdown-item" href="tallysheet_vote.php" target=_blank>Tally Sheet</a>
      </div>
    </li>
    <li class="nav-item">
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

    </li> 
    <li class="nav-item">
 
    </li> 
    
    <?php }  ?>

    <li class="nav-item">
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    </li> 
    <li class="nav-item">
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    </li> 
    <li class="nav-item">
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    </li> 
    <li class="nav-item">
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    </li>   
    <li class="nav-item">
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    </li>               
    <li class="nav-item">
      <a class="nav-link" href="admin_logout.php" target=_self>Log out</a>
    </li>       
  </ul>
</nav>
