<?php
session_start();
include_once dirname(__FILE__,3)."/class/InputSecurityClass.php";
include_once dirname(__FILE__,3)."/dataBase/dataBaseConnection.php";

if(InputSecurity::isEmpty($_POST['id']) == $_POST['id'] 
    && InputSecurity::isEmpty($_POST['model']) == $_POST['model'] 
    && InputSecurity::isEmpty($_POST['license']) == $_POST['license'] 
    && InputSecurity::isEmpty($_POST['maxPassenger']) == $_POST['maxPassenger'] 
    && InputSecurity::isEmpty($_POST['token']) == $_POST['token'] 
    && InputSecurity::isEmpty($_SESSION['token']) == $_SESSION['token']){

        if($_POST['token'] == $_SESSION['token']){
            $state = $PDO->prepare("UPDATE Vehicle SET vehicleModel = :model, vehicleDriverLicense = :license, vehicleMaxPassenger = :maxPassenger WHERE vehicleLicensePlate = :plate");
            $plate = InputSecurity::validateWithoutLetter($_POST['id'], "licensePlate");
            $state->execute([
                'model' => $_POST['model'],
                'license' => $_POST['license'],
                'maxPassenger' => $_POST['maxPassenger'],
                'plate' => $plate
            ]);
        }
        unset($_SESSION['token']);
        header("Location:".$_SERVER['HTTP_REFERER']);
}
else{
    header("Location:".dirname(__FILE__,3)."/vehicle.php");
}