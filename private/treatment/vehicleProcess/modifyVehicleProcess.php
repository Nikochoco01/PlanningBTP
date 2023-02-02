<?php
session_start();
include_once dirname(__FILE__,3)."/class/InputSecurityClass.php";
include_once dirname(__FILE__,3)."/dataBase/dataBaseConnection.php";

if(InputSecurity::validateWithoutLetter($_POST['id'])
    && InputSecurity::isEmpty($_POST['model']) 
    && InputSecurity::validateWithoutLetter($_POST['license'], "licensePlate") 
    && InputSecurity::validateWithoutLetter($_POST['maxPassenger']) 
    && InputSecurity::isEmpty($_POST['token'])
    && InputSecurity::isEmpty($_SESSION['token'])){

        if($_POST['token'] == $_SESSION['token']){
            $state = $PDO->prepare("UPDATE Vehicle SET vehicleModel = :model, vehicleDriverlicense = :license, vehicleMaxPassenger = :maxPassenger WHERE vehiclelicensePlate = :plate");
            $state->execute([
                'model' => $_POST['model'],
                'license' => $_POST['license'],
                'maxPassenger' => $_POST['maxPassenger'],
                'plate' => $_POST['id']
            ]);
        }
        unset($_SESSION['token']);
        header("Location:".$_SERVER['HTTP_REFERER']);
}
else{
    header("Location:".dirname(__FILE__,3)."/vehicle.php");
}