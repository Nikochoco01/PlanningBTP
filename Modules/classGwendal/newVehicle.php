<?php 
session_start();
include_once dirname(__FILE__,3)."/private/class/InputSecurityClass.php";
include_once dirname(__FILE__,3)."/private/dataBase/dataBaseConnection.php";

if( InputSecurity::validateWithoutNumber($_POST['plate'])
    && InputSecurity::isEmpty($_POST['model']) 
    && InputSecurity::validateWithoutLetter($_POST['license'], "licensePlate") 
    && InputSecurity::validateWithoutNumber($_POST['maxPassenger'])
    && InputSecurity::isEmpty($_POST['token'])
    && InputSecurity::isEmpty($_SESSION['token'])){
        if($_POST['token'] == $_SESSION['token']){
            $stat = $PDO->prepare("SELECT vehicleLicensePlate FROM Vehicle WHERE vehicleLicensePlate = :plate");
            $stat->execute([ 'plate' => $_POST['plate']]);
            if(!$stat->fetch()){
                $stat = $PDO->prepare("insert into Vehicle values(:plate, :model, :license, :max, true);");
                $stat->execute([
                    'plate' => $_POST['plate'],
                    'model' => $_POST['model'],
                    'license' => $_POST['license'],
                    'max' => $_POST['maxPassenger'],
                ]);
            }
        }
        unset($_SESSION['token']);
        header("Location:".$_SERVER['HTTP_REFERER']);
}
else{
        header("Location:".dirname(__FILE__,3)."/vehicle.php");
}