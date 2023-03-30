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
        $query = "call Inscription(? , ? , ? , ? , ? , ?)";

        $dataBase->query($query, [
            $firstName , $lastName , $mail , $phoneNumber , $picture , $position
        ]);

    }
    else{
        InputSecurity::returnError("Un des champs ne correspond pas aux demandes du formulaire ");
    }

    header('Location:/profil?onglet=employees&display=view&add=false');
    Exit();
?>
