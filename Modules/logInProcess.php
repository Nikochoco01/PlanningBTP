<?php 
include_once '../dataBase/dataBaseConnection.php';
$statement = $PDO->prepare("select * from User where userId = (select userId from Login where loginUsername= :userName and loginUserPassword = :userPassword)");
$statement->execute(
    [
        'userName' => $_POST['userName'],
        'userPassword' => $_POST['userPassWord']
    ]
);

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
    $_SESSION['userName'] = $user->userId; //  connection ID
    $_SESSION['userRole'] = $user->userPosition; // set user permission
    $_SESSION['userPic'] = $user->userPicture; // profile picture 
    $_SESSION['surName'] = $user->userLastName; // first name of user
    $_SESSION['name'] = $user->userFirstName; // name of user 
    $_SESSION['position'] = $user->userPosition; // position in the companie
    $_SESSION['userPhone'] = $user->userPhone; // user phone number 
    $_SESSION['userMail'] = $user->userMail; // user mail address

    $_SESSION['schedule'] = '7h 18h'; // user schedule of day for the user 
    header('Location: ../accueil.php');
    Exit();
}
?>