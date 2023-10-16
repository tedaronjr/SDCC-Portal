<?php
include "user_session.php";

    if (isset($_POST['Proceed1'])) {

        $ag2 = $_POST['ag1'];
        if ($ag2=="Oo") {
            header('Location: vote.php');
        }
        else {
            header('Location: voters_login.php');
            //header('Location: voters_login.php');
        }        


    } 
    else {
        header('Location: voters_login.php');
    } 

?>    