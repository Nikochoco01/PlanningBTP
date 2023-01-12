<?php 
session_start();
include_once dirname(__FILE__,3)."/private/class/InputSecurityClass.php";
include_once dirname(__FILE__,3)."/private/dataBase/dataBaseConnection.php";

if( InputSecurity::isEmpty($_POST['plate']) == $_POST['plate'] && InputSecurity::isEmpty($_POST['model']) == $_POST['model'] && InputSecurity::isEmpty($_POST['license']) == $_POST['license'] && InputSecurity::isEmpty($_POST['maxPassenger']) == $_POST['maxPassenger'] && InputSecurity::isEmpty($_POST['token']) == $_POST['token'] && InputSecurity::isEmpty($_SESSION['token']) == $_SESSION['token']){
    if($_POST['token'] == $_SESSION['token']){
        $stat = $PDO->prepare("insert into Vehicle values(:plate, :model, :license, :max, true);");
        $plate = InputSecurity::validateWithoutLetter($_POST['plate'], "licensePlate");
        if($plate != ""){
            $stat->execute([
                'plate' => $plate,
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