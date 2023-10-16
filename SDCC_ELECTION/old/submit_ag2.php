<?php
include "user_session.php";

    if (isset($_POST['Proceed2'])) {

        $ag2 = $_POST['ag2'];
        if ($ag2=="Oo") {
            header('Location: vote.php');
        }
        else {
            header('Location: vote.php');
            //header('Location: voters_login.php');
        }        


    } 
    else {
        header('Location: voters_login.php');
    } 

?>    