<?php
session_start();
include_once dirname(__FILE__,3)."/private/class/InputSecurityClass.php";
include_once dirname(__FILE__,3)."/private/dataBase/dataBaseConnection.php";

if(InputSecurity::isEmpty($_POST['id']) == $_POST['id'] && InputSecurity::isEmpty($_POST['idName']) == $_POST['idName'] && InputSecurity::isEmpty($_POST['table']) == $_POST['table'] && InputSecurity::isEmpty($_POST['token']) == $_POST['token'] && InputSecurity::isEmpty($_SESSION['token']) == $_SESSION['token']){
    if($_POST['token'] == $_SESSION['token']){
               
        $stat = $PDO->prepare("DELETE FROM {$_POST['table']} WHERE {$_POST['idName']} = :id");

        $stat->execute([
            'id' => $_POST['id']
        ]);
    }
}
header("Location:".$_SERVER['HTTP_REFERER']);