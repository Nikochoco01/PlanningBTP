<?php

if( InputSecurity::validateWithoutLetter($_POST['plate'], $licensePlate, "licensePlate")
    && !InputSecurity::isEmpty($_POST['model'], $model) 
    && !InputSecurity::isEmpty($_POST['license'], $driverLicense) 
    && InputSecurity::validateWithoutLetter($_POST['maxPassenger'], $maxPassenger)
    && !InputSecurity::isEmpty($_POST['token'], $token)
    && !InputSecurity::isEmpty($_SESSION['token'], $sessionToken)){

        if($token == $sessionToken){
            $db->add("Vehicle",
                [
                    'vehicleDisponibility' => true,
                    'vehicleModel' => $model,
                    'vehicleDriverLicense' => $driverLicense,
                    'vehicleMaxPassenger' => $maxPassenger
                ],
                ['vehicleLicensePlate' => $licensePlate]
            );
        }
        unset($_SESSION['token']);
        header("Location:".$_SERVER['HTTP_REFERER']);
}
else{
        header("Location:/vehicle");
}