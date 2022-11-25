<?php include_once __DIR__."/dataBase/dataBaseConnection.php";
session_start();
if( isset($_POST['plate']) && isset($_POST['type']) && isset($_POST['model']) && isset($_POST['license'])){
    $license = $PDO->quote($_POST['license']);
    $idLice = $PDO->query("select idDriverLicense from DriverLicense where driverLicenseName = $license;")->fetch();
    $stat = $PDO->prepare("insert into Vehicle values(:plate, :type, true, :model, :idLicense);");

    $stat->execute([
        'plate' => $_POST['plate'],
        'type' => $_POST['type'],
        'model' => $_POST['model'],
        'idLicense' => $idLice->idDriverLicense
    ]);
    header("Location:".$_SERVER['HTTP_REFERER']);
}
else{
    header("Location:".__DIR__."/vehicle.php");
}