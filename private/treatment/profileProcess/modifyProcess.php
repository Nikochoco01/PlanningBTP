<?php

// test Password
// $testPassword = InputSecurity::validatePassWord($_POST['userPassword'] , $passwordVerify);

// test FirstName
$testFirstName = InputSecurity::validateWithoutNumber($_POST['userFirstName'], $firstName);

// test LastName
$testLastName = InputSecurity::validateWithoutNumber($_POST['userLastName'], $lastName);

// test mail
$testMail = InputSecurity::validateMail($_POST['userMail'], $mail);

// test phone number
$testNumberPhone = InputSecurity::validateWithoutLetter($_POST['userPhone'], $phoneNumber, "phoneNumber");

// test Position
$testPosition = InputSecurity::validateWithoutNumber($_POST['userPosition'], $position);

$userId = $_POST['userId'];

if ($testFirstName && $testLastName && $testMail && $testNumberPhone && $testPosition) {

    $dataBase->save("User",[
        "userFirstName"=> $firstName,
        "userLastName" => $lastName,
        "userMail" => $mail,
        "userPhone" => $phoneNumber,
        "userPosition" => $position,
        "pictureId" => $userId,
        "userId" => $userId,
    ] , "userId");
} else {
    InputSecurity::returnError("Un des champs ne correspond pas aux demandes du formulaire ");
}

$getUser = $dataBase->read("User",[
    "conditions"=>[
        "userId" => $_SESSION['userId']
    ],
    "fields" => ["distinct *"]
]);

// var_dump($_POST["userPassword"]);
// var_dump(InputSecurity::isEmpty($_POST["userPassword"] , $return));
// var_dump($return);
// var_dump($firstName);
// var_dump($lastName);
// var_dump($mail);
// var_dump($phoneNumber);
// var_dump($position);
// var_dump($testPassword);

// var_dump($passwordVerify);
// var_dump($getUser);

// $REGEX = "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/";

// if(preg_match($REGEX , "AbC13me@?")){
//     var_dump("AbC13me@?");
// }
// else{
//     var_dump("correspond pas ");
// }

// InputSecurity::validatePassWord("AbC13me@?" , $ret);

// var_dump("result : ".$ret);


// AbC13me@?    
header('Location:/profil?onglet=employees&display=view&add=false');
exit();