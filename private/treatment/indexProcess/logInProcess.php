<?php
InputSecurity::isEmpty($_POST['userName'] , $userName);
InputSecurity::isEmpty($_POST['userPassWord'] , $userPassword);
$userPassword = sha1($userPassword);

$userId = $dataBase->read("Login", [
                "conditions" => [
                    "loginUsername" => $userName,
                    "loginUserPassword" => $userPassword
                ],
                "fields" => ["userId"]
            ]);

$user = $dataBase->read("User", [
                "conditions" => [
                    "userId" => $userId[0]->userId
                ]
            ]);

$loginUsername = $dataBase->read("Login",[
                    "conditions" => [
                        "loginUsername" => $userName
                    ],
                    "fields" => ["loginUsername"]
                ]);

// $req = $PDO->prepare("select * from Picture where pictureId= $user[0]->userId limit 1");
// $req = $PDO->prepare("select * from Picture where pictureId= $user->userId limit 1");
// $req->setFetchMode(PDO::FETCH_ASSOC);
// $req->execute();
// $tab=$req->fetchAll();
// var_dump($tab);



if(isset($user[0]->userId) && isset($loginUsername[0]->loginUsername)){
    //include_once 'translateDate.php';
    /** session existence test variables */
    $_SESSION['sessionOpen'] = true;
    /** date variables */
    $_SESSION['dateToday'] = 0;//translateDate();
    /** user variables */

    foreach(PARAM_SESSION_TYPE as $key => $userFonction){
        if($key === $user[0]->userPosition){
            $_SESSION['userFonction'] = PARAM_SESSION_TYPE[$key];
        }
    };

    $_SESSION['userId'] = $user[0]->userId; //user id in data base
    $_SESSION['userName'] = $loginUsername[0]->loginUsername; //  connection ID

    if($tab == null){
        $_SESSION['userPicture'] = APP ."private/img/defaultPP.png";
    }
    else{
    //    $_SESSION['userPicture'] = $tab[0]["pictureBin"];
    }
    
    $_SESSION['userFirstName'] = $user[0]->userFirstName; // first name of user
    $_SESSION['userLastName'] = $user[0]->userLastName; // name of user 
    $_SESSION['userPosition'] = $user[0]->userPosition; // position in the company
    $_SESSION['userPhone'] = $user[0]->userPhone; // user phone number 
    $_SESSION['userMail'] = $user[0]->userMail; // user mail address

    $_SESSION['schedule'] = '7h 18h'; // user schedule of day for the user
    // include_once APP . "public/home.php";
    $host = $_SERVER['HTTP_HOST'];
    $path = "/home";
    header("Location: http://$host$path");
    Exit();
}
?>