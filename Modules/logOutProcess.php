<?php
    if(isset($_SESSION['sessionOpen'])){
        $_SESSION = array();
        session_destroy();
        header('Location: ../index.php');
        Exit();
    }
    else{
        header('Location: ../index.php');
        Exit();
    }

?>