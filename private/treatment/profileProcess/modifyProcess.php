<?php
$testFirstName = InputSecurity::validateWithoutNumber($_POST['userFirstName'], $firstName);
$testLastName = InputSecurity::validateWithoutNumber($_POST['userLastName'], $lastName);
$testMail = InputSecurity::validateMail($_POST['userMail'], $mail);
$testNumberPhone = InputSecurity::validateWithoutLetter($_POST['userPhone'], $phoneNumber, "phoneNumber");
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
        "userId" => $userId
    ],
    "fields" => ["distinct *"]
]);

if ($_FILES["userPicture"]["name"] != "") {
    $pictureName = $_FILES["userPicture"]["name"];
    $pictureSize = $_FILES["userPicture"]["size"];
    $pictureType = $_FILES["userPicture"]["type"];
    $pictureBin = base64_encode(file_get_contents($_FILES["userPicture"]["tmp_name"]));

    $pictureWebsite->add($pictureName , $pictureSize , $pictureType , $pictureBin , $getUser->userId);
}

if($_SESSION['userId'] == $userId){
    // $_SESSION['userPicture'] = $getUser[0]->userPicture;
    $_SESSION['userFirstName'] = $getUser[0]->userFirstName;
    $_SESSION['userLastName'] = $getUser[0]->userLastName;
    $_SESSION['userPosition'] = $getUser[0]->userPosition;
    $_SESSION['userPhone'] = $getUser[0]->userPhone;
    $_SESSION['userMail'] = $getUser[0]->userMail;
}
header('Location:/profil?onglet=personal&display=view');
exit();