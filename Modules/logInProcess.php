<?php
include_once dirname(__FILE__,2)."/dataBase/dataBaseConnection.php";

$statement = $PDO->prepare("select * from User where idUser = (select idUser from Login where idUser= :userName and password = :userPassword)");
$statement->execute(
    [
        'userName' => $_POST['userName'],
        'userPassword' => $_POST['userPassWord']
    ]
);

$user = $statement->fetch();
//var_dump($user);
//var_dump($user->idUser);

if(isset($user->idUser)){
    session_start();
    include_once 'translateDate.php';
    /** session existence test variables */
    $_SESSION['sessionOpen'] = true;
    /** date variables */
    $_SESSION['dateToday'] = translateDate();
    /** user variables */ 
    $_SESSION['userName'] = $user->idUser; //  connection ID
    $_SESSION['userRole'] = $user->userRole; // set user permission
    $_SESSION['userPic'] = $user->profilePicture; // profile picture 
    $_SESSION['surName'] = $user->surname; // first name of user
    $_SESSION['name'] = $user->name; // name of user 
    $_SESSION['position'] = $user->position; // position in the companie
    $_SESSION['userPhone'] = $user->phoneNumber; // user phone number 
    $_SESSION['userMail'] = $user->mail; // user mail address

    $_SESSION['schedule'] = '7h 18h'; // user schedule of day for the user 
    header('Location: ../accueil.php?userRole='.$_SESSION['userRole']);
    Exit();
}







    // if($_POST['userName'] == 'nikola.chevalliot' && $_POST['userPassWord'] == 'test'){
    //     session_start();
    //     include_once 'translateDate.php';
    //     /** session existence test variables */
    //     $_SESSION['sessionOpen'] = true;
    //     /** date variables */
    //     $_SESSION['dateToday'] = translateDate();
    //     /** user variables */ 
    //     $_SESSION['userName'] = 'Nikola.chevalliot'; //  connection ID
    //     $_SESSION['userRole'] = 'administrateur';
    //     $_SESSION['userPic'] ='../img/defaultPP.png'; // profile picture 
    //     $_SESSION['surName'] = 'Nikola'; // first name of user
    //     $_SESSION['name'] = 'chevalliot'; // name of user 
    //     $_SESSION['position'] = 'patron'; // position in the companie
    //     $_SESSION['userPhone'] = '0656782241'; // user phone number 
    //     $_SESSION['userMail'] = 'nikola.chevalliot@gmail.com'; // user mail address

    //     $_SESSION['schedule'] = '7h 18h'; // user schedule of day for the user 
    //     header('Location: ../accueil.php?userRole='.'administrateur');
    //     Exit();
    // }
    // else if($_POST['userName'] == 'maria.chevalliot' && $_POST['userPassWord'] == 'test'){
    //     session_start();
    //     include_once 'translateDate.php';
    //     /** session existence test variables */
    //     $_SESSION['sessionOpen'] = true;
    //     /** date variables */
    //     $_SESSION['dateToday'] = translateDate();
    //     /** user variables */ 
    //     $_SESSION['userName'] = 'Maria.chevalliot';
    //     $_SESSION['userRole'] = 'employe';
    //     $_SESSION['surName'] = 'Maria';
    //     $_SESSION['name'] = 'chevalliot';
    //     $_SESSION['position'] = 'employe';
    //     $_SESSION['userPic'] ='../img/defaultPP.png';
    //     $_SESSION['userPhone'] = '0656782241';
    //     $_SESSION['userMail'] = 'maria.chevalliot@gmail.com';

    //     $_SESSION['schedule'] = '7h 18h';
    //     header('Location: ../accueil.php?userRole='.'employe');
    //     Exit();
    // }
    // else{
    //     header('Location: ../index.php');
    //     Exit();
    // }
?>