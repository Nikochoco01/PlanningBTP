<?php 
include_once dirname(__FILE__,2)."/Modules/Constant.php";
include_once dirname(__FILE__,2)."/dataBase/dataBaseConnection.php";

$user = $statement->fetch();
//var_dump($user);

$statementUserName = $PDO->prepare("select loginUsername from Login where loginUsername= :userName");
$statementUserName->bindParam('userName' , $_POST['userName']);
$statementUserName->execute();

$user = $statement->fetch();
$loginUsername = $statementUserName->fetch();

if(isset($user->userId) && isset($loginUsername->loginUsername)){
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
    header('Location: ../accueil.php');
    Exit();
}
?>