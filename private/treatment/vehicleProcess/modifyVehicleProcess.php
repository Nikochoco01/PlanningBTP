<?php
include_once APP . "private/class/InputSecurityClass.php";
include_once APP . "private/dataBase/dataBaseConnection.php";

if(InputSecurity::validateWithoutLetter($_POST['id'] , $licensePlate , "licensePlate")
    && !InputSecurity::isEmpty($_POST['model'] , $model) 
    && !InputSecurity::isEmpty($_POST['license'] , $driverLicense) 
    && InputSecurity::validateWithoutLetter($_POST['maxPassenger'] , $maxPassenger) 
    && !InputSecurity::isEmpty($_POST['token'] , $token)
    && !InputSecurity::isEmpty($_SESSION['token'] , $sessionToken)){

        if($token == $sessionToken){
            $state = $PDO->prepare("UPDATE Vehicle SET vehicleModel = :model, vehicleDriverlicense = :license, vehicleMaxPassenger = :maxPassenger WHERE vehiclelicensePlate = :plate");
            $state->execute([
                'model' => $model,
                'license' => $driverLicense,
                'maxPassenger' => $maxPassenger,
                'plate' => $licensePlate
            ]);
        }
        unset($_SESSION['token']);
        header("Location:".$_SERVER['HTTP_REFERER']);
}
else{
    header("Location:/vehicle");
}