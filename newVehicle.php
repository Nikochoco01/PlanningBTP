<?php 
session_start();
include_once __DIR__."/dataBase/dataBaseConnection.php";

if( isset($_POST['plate'], $_POST['type'], $_POST['model'], $_POST['license'], $_POST['token'], $_SESSION['token'])){
    if($_POST['token'] == $_SESSION['token']){
        $license = $PDO->quote($_POST['license']);
        $idLice = $PDO->query("select idDriverLicense from DriverLicense where driverLicenseName = $license;")->fetch();
        $stat = $PDO->prepare("insert into Vehicle values(:plate, :type, true, :model, :idLicense);");

        $stat->execute([
            'plate' => $_POST['plate'],
            'type' => $_POST['type'],
            'model' => $_POST['model'],
            'idLicense' => $idLice->idDriverLicense
        ]);
    }
    unset($_SESSION['token']);
    header("Location:".$_SERVER['HTTP_REFERER']);
}
else{
    header("Location:".__DIR__."/vehicle.php");
}