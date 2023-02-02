<?php
    include_once APP . "/private/class/InputSecurityClass.php";
    include_once APP . "/private/dataBase/dataBaseConnection.php";

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

    $picture = null;

    if($testFirstName && $testLastName && $testMail && $testNumberPhone && $testPosition){
        $statement = $PDO->prepare("call Inscription(:varUserFirstName , :varUserLastName , :varUserMail , :varUserPhone , :varUserPicture , :varUserPosition)");
        $statement->bindParam("varUserFirstName" , $firstName);
        $statement->bindParam("varUserLastName" , $lastName);
        $statement->bindParam("varUserMail" , $mail);
        $statement->bindParam("varUserPhone" , $phoneNumber);
        $statement->bindParam("varUserPicture" , $picture);
        $statement->bindParam("varUserPosition" , $position);
        $statement->execute();
    }
    else{
        InputSecurity::returnError("Un des champs ne correspond pas aux demandes du formulaire ");
    }

    header('Location:/profil?onglet=employees&display=view&add=false');
    Exit();
?>
