<?php 
include_once '../dataBase/dataBaseConnection.php';
$statement = $PDO->prepare("select * from user where idUser = (select idUser from Login where idUser= :userName and password = :userPassword)");
$statement->execute(
    [
        'userName' => $_POST['userName'],
        'userPassword' => $_POST['userPassWord']
    ]
);

$user = $statement->fetchAll();
//  var_dump($user);

if(isset($user)){
    session_start();
    include_once 'translateDate.php';
    /** session existence test variables */
    $_SESSION['sessionOpen'] = true;
    /** date variables */
    $_SESSION['dateToday'] = translateDate();
    /** user variables */ 
    $_SESSION['userName'] = $user[0]['idUser']; //  connection ID
    $_SESSION['userRole'] = $user[0]['userRole']; // set user permission
    $_SESSION['userPic'] = $user[0]['profilePicture']; // profile picture 
    $_SESSION['surName'] = $user[0]['surname']; // first name of user
    $_SESSION['name'] = $user[0]['name']; // name of user 
    $_SESSION['position'] = $user[0]['position']; // position in the companie
    $_SESSION['userPhone'] = $user[0]['phoneNumber']; // user phone number 
    $_SESSION['userMail'] = $user[0]['mail']; // user mail address

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