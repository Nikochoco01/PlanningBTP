<?php
    include_once APP . "/private/class/InputSecurityClass.php";
    include_once APP . "/private/dataBase/dataBaseConnection.php";

    // test FirstName
    $firstName = InputSecurity::validateWithoutNumber($_POST['userFirstName']);

    // test LastName
    $lastName = InputSecurity::validateWithoutNumber($_POST['userLastName']);

    // test mail
    $mail = InputSecurity::validateMail($_POST['userMail']);

    // test phone number
    $phoneNumber = InputSecurity::validateWithoutLetter($_POST['userPhone'] , "phoneNumber");

    // test Position
    $position = InputSecurity::validateWithoutNumber($_POST['userPosition']);

    $picture = null;

    $statement = $PDO->prepare("call Inscription(:varUserFirstName , :varUserLastName , :varUserMail , :varUserPhone , :varUserPicture , :varUserPosition)");
    $statement->bindParam("varUserFirstName" , $firstName);
    $statement->bindParam("varUserLastName" , $lastName);
    $statement->bindParam("varUserMail" , $mail);
    $statement->bindParam("varUserPhone" , $phoneNumber);
    $statement->bindParam("varUserPicture" , $picture);
    $statement->bindParam("varUserPosition" , $position);
    $statement->execute();


    InputSecurity::returnMessage("Votre mot de passe par default est 1234 changer le des que possible");

    header('Location:/profil?onglet=employees&display=view&add=false');
    Exit();
?>
