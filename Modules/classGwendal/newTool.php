<?php
session_start();
include_once dirname(__FILE__,3)."/private/class/InputSecurityClass.php";
include_once dirname(__FILE__,3)."/private/dataBase/dataBaseConnection.php";

if( InputSecurity::isEmpty($_POST['designation']) == $_POST['designation'] && InputSecurity::isEmpty($_POST['total']) == $_POST['total'] && InputSecurity::isEmpty($_POST['token']) == $_POST['token'] && InputSecurity::isEmpty($_SESSION['token']) == $_SESSION['token'] ){
    if($_POST['token'] == $_SESSION['token']){
        $stat = $PDO->prepare("INSERT INTO Equipment VALUES(:designation, :tt, :tt)");
        $stat->execute([
            'designation' => $_POST['designation'],
            'tt' => $_POST['total']
        ]);
    }
    unset($_SESSION['token']);
    header("Location:".$_SERVER['HTTP_REFERER']);
}
else{
    header("Location:".dirname(__FILE__,3)."/public/toolManagement.php");
}