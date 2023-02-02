<?php
    session_start();
    include_once dirname(__FILE__,4). "/private/class/InputSecurityClass.php";
    include_once dirname(__FILE__,4). "/private/dataBase/dataBaseConnection.php";

    // test FirstName
    $testFirstName = InputSecurity::validateWithoutNumber($_POST['userFirstName'] , $firstName);

    // test LastName
    $testLastName = InputSecurity::validateWithoutNumber($_POST['userLastName'] , $lastName);

    // test mail
    $testMail = InputSecurity::validateMail($_POST['userMail'] , $mail);

    // test phone number
    $testNumberPhone = InputSecurity::validateWithoutLetter($_POST['userPhone'] , $phoneNumber , "phoneNumber");

    // test Position
    $testPosition = InputSecurity::validateWithoutNumber($_POST['userPosition'] , $position);

    $picture = $_SESSION['userPicture'];
    $userId = $_POST['userId'];

    if(isset($_POST["valider"])){
        if($_FILES["userPicture"]["name"]!=""){
            $test = $PDO->prepare("select pictureId from Picture where userId = $userId");
            $test->execute();
            $test = $test->fetch();
            //var_dump($test->pictureId);
            if(empty($test->pictureId)){
                $req = $PDO->prepare("insert into Picture(pictureId, pictureName, pictureSize, pictureType, pictureBin, userId) values ($userId, ?, ?, ?, ?, $userId)");
            }else{
                $req = $PDO->prepare("update Picture set pictureId = $userId, pictureName = ?, pictureSize = ?, pictureType = ?, pictureBin = ?, userId = userId");
            }
            $req->execute(array($_FILES["userPicture"]["name"], $_FILES["userPicture"]["size"], $_FILES["userPicture"]["type"], file_get_contents($_FILES["userPicture"]["tmp_name"])));
        }

        $sql = $PDO->prepare("select * from Picture");
        $sql->execute();

        $result = $sql->fetchAll();

    }

    if($testFirstName && $testLastName && $testMail && $testNumberPhone && $testPosition){
        $statement = $PDO->prepare('update User  set userFirstName = :FName , userLastName = :LName, userMail = :MAIL , userPhone = :PHONE, pictureId = :ID , userPosition = :POSITION where userId = :ID');
        $statement->bindParam("FName", $firstName);
        $statement->bindParam("LName", $lastName);
        $statement->bindParam("MAIL", $mail);
        $statement->bindParam("PHONE", $phoneNumber);
        $statement->bindParam("POSITION", $position);
        $statement->bindParam("ID", $userId);
        $statement->execute();
    }
    else{
        InputSecurity::returnError("Un des champs ne correspond pas aux demandes du formulaire ");
    }

    $getUser = $PDO->prepare("select * from User where userId = :userId ");
    $getUser->bindParam("userId" , $_SESSION['userId']);
    $getUser->execute();

    $getUser = $getUser->fetch();

    InputSecurity::validatePassWord($_POST['userPassword'] , $password);


    if($_SESSION['userId'] == $_POST['userId']){
        $_SESSION['userFirstName'] = $getUser->userFirstName; // first name of user
        $_SESSION['userLastName'] = $getUser->userLastName; // name of user 
        $_SESSION['userPosition'] = $getUser->userPosition; // position in the company
        $_SESSION['userPhone'] = $getUser->userPhone; // user phone number 
        $_SESSION['userMail'] = $getUser->userMail; // user mail address
    }
    header("Location: /public/profil.php?onglet=personal&display=view&add=false");
    Exit();
?>
