<?php
session_start();
include_once dirname(__FILE__,3)."/class/InputSecurityClass.php";
include_once dirname(__FILE__,3)."/dataBase/dataBaseConnection.php";

if(InputSecurity::validateWithoutLetter($_POST['id'] , $vehicleId)
    && InputSecurity::isEmpty($_POST['model'] , $model) 
    && InputSecurity::validateWithoutLetter($_POST['license'] , $licensePlate, "licensePlate") 
    && InputSecurity::validateWithoutLetter($_POST['maxPassenger'] , $maxPassenger) 
    && InputSecurity::isEmpty($_POST['token'] , $token)
    && InputSecurity::isEmpty($_SESSION['token'] , $sessionToken)){

        if($token == $sessionToken){
            $state = $PDO->prepare("UPDATE Vehicle SET vehicleModel = :model, vehicleDriverlicense = :license, vehicleMaxPassenger = :maxPassenger WHERE vehiclelicensePlate = :plate");
            $state->execute([
                'model' => $model,
                'license' => $licensePlate,
                'maxPassenger' => $maxPassenger,
                'plate' => $vehicleId
            ]);
        }
        unset($_SESSION['token']);
        header("Location:".$_SERVER['HTTP_REFERER']);
}
else{
    header("Location:".dirname(__FILE__,3)."/vehicle.php");
}