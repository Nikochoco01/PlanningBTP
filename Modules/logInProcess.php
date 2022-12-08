<?php
include_once dirname(__FILE__,2)."/dataBase/dataBaseConnection.php";

$statement = $PDO->prepare("select * from User where userId = (select userId from Login where loginUsername= :userName and loginUserPassword = :userPassword)");
$statement->bindParam('userName' , $_POST['userName']);
$statement->bindParam('userPassword' , $_POST['userPassWord']);
$statement->execute();

$statementUserName = $PDO->prepare("select loginUsername from Login where loginUsername= :userName");
$statementUserName->bindParam('userName' , $_POST['userName']);
$statementUserName->execute();

$user = $statement->fetch();
$loginUsername = $statementUserName->fetch();
//var_dump($user);
//var_dump($user->idUser);

if(isset($user->userId) && isset($loginUsername->loginUsername)){
    session_start();
    include_once 'translateDate.php';
    /** session existence test variables */
    $_SESSION['sessionOpen'] = true;
    /** date variables */
    $_SESSION['dateToday'] = translateDate();
    /** user variables */ 
    $_SESSION['userName'] = $loginUsername->loginUsername; //  connection ID
    $_SESSION['userPic'] = $user->userPicture; // profile picture 
    $_SESSION['surName'] = $user->userFirstName; // first name of user
    $_SESSION['name'] = $user->userLastName; // name of user 
    $_SESSION['position'] = $user->userPosition; // position in the companie
    $_SESSION['userPhone'] = $user->userPhone; // user phone number 
    $_SESSION['userMail'] = $user->userMail; // user mail address

    $_SESSION['schedule'] = '7h 18h'; // user schedule of day for the user 
    header('Location: ../accueil.php?userRole='.$_SESSION['position']);
    Exit();
}
?>