<?php
session_start();
set_time_limit(0);
if (!isset($_SESSION['admin_user']) || !isset($_SESSION['admin_pass'])){
    unset($_SESSION['admin_user']);
    unset($_SESSION['admin_pass']);
    session_destroy();
    echo "<script>window.location.href=\"/SDCC-Portal/admin_login.php\"</script>";           

}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Menu</title>
<?php
include "scriptlink.php";

setlocale(LC_MONETARY,"en_PH.UTF-8"); 
?> 



</head>

<body>




<div class="container-fluid">
<BR>
<?php
include "title.php";
include "admin_navlink.php";
?>
<br>
<br>

<?php
include "footer.php";
?>
</div>
</body>
</html>
