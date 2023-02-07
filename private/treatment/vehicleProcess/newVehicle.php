<?php
include_once APP . "private/class/InputSecurityClass.php";
include_once APP . "private/dataBase/dataBaseConnection.php";

if( InputSecurity::validateWithoutLetter($_POST['plate'], $licensePlate, "licensePlate")
    && !InputSecurity::isEmpty($_POST['model'], $model) 
    && !InputSecurity::isEmpty($_POST['license'], $driverLicense) 
    && InputSecurity::validateWithoutLetter($_POST['maxPassenger'], $maxPassenger)
    && !InputSecurity::isEmpty($_POST['token'], $token)
    && !InputSecurity::isEmpty($_SESSION['token'], $sessionToken)){

        if($token == $sessionToken){
            $stat = $PDO->prepare("SELECT vehicleLicensePlate FROM Vehicle WHERE vehicleLicensePlate = :plate");
            $stat->execute([ 'plate' => $licensePlate]);
            if(!$stat->fetch()){
                $stat = $PDO->prepare("insert into Vehicle values(:plate, :model, :license, :max, true);");
                $stat->execute([
                    'plate' => $licensePlate,
                    'model' => $model,
                    'license' => $driverLicense,
                    'max' => $maxPassenger,
                ]);
            }
        }
        unset($_SESSION['token']);
        header("Location:".$_SERVER['HTTP_REFERER']);
}
else{
        header("Location:/vehicle");
}