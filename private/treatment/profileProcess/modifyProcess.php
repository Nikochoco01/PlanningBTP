<?php
include_once APP . "/private/class/InputSecurityClass.php";
include_once APP . "/private/dataBase/dataBaseConnection.php";
include_once APP . "/private/class/Picture.php"; 
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

//if(isset($_POST["valider"])){
// $PDO->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE , PDO::FETCH_OBJ);
// var_dump($_FILES["userPicture"]["name"]!="");
// var_dump($_FILES["userPicture"]["name"]);
if ($_FILES["userPicture"]["name"] != "") {
    $pictureName = $_FILES["userPicture"]["name"];
    $pictureSize = $_FILES["userPicture"]["size"];
    $pictureType = $_FILES["userPicture"]["type"];
    $pictureBin = base64_encode(file_get_contents($_FILES["userPicture"]["tmp_name"]));

    Picture::add($dataBase , $userId , $pictureName , $pictureSize , $pictureType , $pictureBin );
    var_dump($_FILES);
    // $test = $PDO->prepare("select pictureId from Picture where userId = $userId");
    // $test->execute();
    // $test = $test->fetch();
    // //var_dump($test->pictureId);
    // if (empty($test->pictureId)) {
    //     $req = $PDO->prepare("insert into Picture(pictureId, pictureName, pictureSize, pictureType, pictureBin, userId) values ($userId, ?, ?, ?, ?, $userId)");
    //     $req->execute(array($_FILES["userPicture"]["name"], $_FILES["userPicture"]["size"], $_FILES["userPicture"]["type"], file_get_contents($_FILES["userPicture"]["tmp_name"])));
    //     //echo "if";
    // } else {
    //     $req = $PDO->prepare("update Picture set pictureName = ?, pictureSize = ?, pictureType = ?, pictureBin = ? where userId = $userId");
    //     $req->execute(array($_FILES["userPicture"]["name"], $_FILES["userPicture"]["size"], $_FILES["userPicture"]["type"], file_get_contents($_FILES["userPicture"]["tmp_name"])));
    //     //echo "else";
    // }
    //$req->execute(array($_FILES["userPicture"]["name"], $_FILES["userPicture"]["size"], $_FILES["userPicture"]["type"], file_get_contents($_FILES["userPicture"]["tmp_name"])));
}

// $sql = $PDO->prepare("select * from Picture");
// $sql->execute();

// $result = $sql->fetchAll();

//var_dump($result);

//}

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