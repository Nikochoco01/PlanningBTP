<?php 
    if($_POST['userName'] == 'nikola.chevalliot' && $_POST['userPassWord'] == 'test'){
        session_start();
        include_once 'translateDate.php';
        /** session existence test variables */
        $_SESSION['sessionOpen'] = true;
        /** date variables */
        $_SESSION['dateToday'] = translateDate();
        /** user variables */ 
        $_SESSION['userName'] = 'Nikola.chevalliot'; //  connection ID
        $_SESSION['userPic'] ='../img/defaultPP.png'; // profile picture 
        $_SESSION['surName'] = 'Nikola'; // first name of user
        $_SESSION['name'] = 'chevalliot'; // name of user 
        $_SESSION['position'] = 'administrateur'; // position in the companie
        $_SESSION['userPhone'] = '0656782241'; // user phone number 
        $_SESSION['userMail'] = 'nikola.chevalliot@gmail.com'; // user mail address

        $_SESSION['schedule'] = '7h 18h'; // user schedule of day for the user 
        header('Location: ../accueil.php?position='.'administrateur');
        Exit();
    }
    else if($_POST['userName'] == 'maria.chevalliot' && $_POST['userPassWord'] == 'test'){
        session_start();
        include_once 'translateDate.php';
        /** session existence test variables */
        $_SESSION['sessionOpen'] = true;
        /** date variables */
        $_SESSION['dateToday'] = translateDate();
        /** user variables */ 
        $_SESSION['userName'] = 'Maria.chevalliot';
        $_SESSION['surName'] = 'Maria';
        $_SESSION['name'] = 'chevalliot';
        $_SESSION['position'] = 'employe';
        $_SESSION['userPic'] ='../img/defaultPP.png';
        $_SESSION['userPhone'] = '0656782241';
        $_SESSION['userMail'] = 'maria.chevalliot@gmail.com';

        $_SESSION['schedule'] = '7h 18h';
        header('Location: ../accueil.php?position='.'employe');
        Exit();
    }
    else{
        header('Location: ../index.php');
        Exit();
    }
?>