<?php

if(InputSecurity::validateWithoutLetter($_POST['id'] , $licensePlate , "licensePlate")
    && !InputSecurity::isEmpty($_POST['model'] , $model) 
    && !InputSecurity::isEmpty($_POST['license'] , $driverLicense) 
    && InputSecurity::validateWithoutLetter($_POST['maxPassenger'] , $maxPassenger) 
    && !InputSecurity::isEmpty($_POST['token'] , $token)
    && !InputSecurity::isEmpty($_SESSION['token'] , $sessionToken)){

        if($token == $sessionToken){
            $dataBase->updateBtp('Vehicle',
                [
                    'vehicleModel' => $model,
                    'vehicleDriverlicense' => $driverLicense,
                    'vehicleMaxPassenger' => $maxPassenger,
                ],
                ['vehiclelicensePlate' => $licensePlate]
            );
        }
        unset($_SESSION['token']);
        header("Location:".$_SERVER['HTTP_REFERER']);
}
else{
    header("Location:/vehicle");
}