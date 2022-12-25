<?php
    session_start();
    include_once dirname(__FILE__,2)."/InputSecurityClass.php";
    include_once dirname(__FILE__,3)."/dataBase/dataBaseConnection.php";

    $mail = InputSecurity::validateMail($_POST['userMail']);

    // test FirstName
    $firstName = InputSecurity::validateWithoutNumber($_POST['userFirstName']);

    // test LastName
    $lastName = InputSecurity::validateWithoutNumber($_POST['userLastName']);

    // test Position
    $position = InputSecurity::validateWithoutNumber($_POST['userPosition']);

    // test phone number
    $phoneNumber = InputSecurity::validateWithoutLetter($_POST['userPhone'] , "phoneNumber");

    $picture = $_SESSION['userPicture'];
    $userId = $_SESSION['userId'];

    $statement = $PDO->prepare("update User  set userFirstName = :FirstName , userLastName = :LastName, userMail = :userMail , userPhone = :userPhone, userPicture = :userPicture , userPosition = :userPosition where userId = :userId");
    $statement->bindParam("FirstName" , $firstName);
    $statement->bindParam("LastName", $lastName);
    $statement->bindParam("userMail" , $mail);
    $statement->bindParam("userPhone" , $phoneNumber);
    $statement->bindParam("userPicture" , $picture);
    $statement->bindParam("userPosition" , $position);
    $statement->bindParam("userId" , $userId);
    $statement->execute();

    $getUser = $PDO->prepare("select * from User where userId = :userId ");
    $getUser->bindParam("userId" , $_SESSION['userId']);
    $getUser->execute();

    $getUser = $getUser->fetch();


    $password = InputSecurity::validatePassWord($_POST['userPassword']);

    /**
     * message to disconnect the user
     */
    InputSecurity::returnMessage("you will be disconnected");

    // faire le system de mise a jour du login 

    // var_dump($_SESSION['ERROR']);
    // InputSecurity::destroyError();
    // var_dump($_SESSION['ERROR']);

    // $_SESSION['userId'] = $getUser->userId; //user id in data base
    // $_SESSION['userName'] = $loginUsername->loginUsername; //  connection ID
    $_SESSION['userPicture'] = $getUser->userPicture; // profile picture 
    $_SESSION['userFirstName'] = $getUser->userFirstName; // first name of user
    $_SESSION['userLastName'] = $getUser->userLastName; // name of user 
    $_SESSION['userPosition'] = $getUser->userPosition; // position in the company
    $_SESSION['userPhone'] = $getUser->userPhone; // user phone number 
    $_SESSION['userMail'] = $getUser->userMail; // user mail address
    header('Location: ../../profil.php?&onglet='.'Personal'.'&display='.'View');
    Exit();
?>
