<?php 
    if($_POST['userName'] == 'nikola.chevalliot' && $_POST['userPassWord'] == 'test'){
        session_start();

        /** date variables */
        $_SESSION['dateToday'] = 
        /** user variables */ 
        $_SESSION['userName'] = 'Nikola.chevalliot';
        $_SESSION['surName'] = 'Nikola';
        $_SESSION['name'] = 'chevalliot';
        $_SESSION['position'] = 'administrateur';
        $_SESSION['userPic'] ='../img/defaultPP.png';
        $_SESSION['userPhone'] = '0656782241';
        $_SESSION['userMail'] = 'nikola.chevalliot@gmail.com';

        $_SESSION['schedule'] = '7h 18h';
        header('Location: ../accueil.php');
        Exit();
    }
    else{
        header('Location: ../index.php');
        Exit();
    }


?>