<?php
include_once APP . "private/class/InputSecurityClass.php";
include_once APP . "private/dataBase/dataBaseConnection.php";

if(!InputSecurity::isEmpty($_POST['id'], $id)
    && !InputSecurity::isEmpty($_POST['idName'], $idName)
    && !InputSecurity::isEmpty($_POST['table'], $table) 
    && !InputSecurity::isEmpty($_POST['token'], $token) 
    && !InputSecurity::isEmpty($_SESSION['token'], $sessionToken)){
        if($_POST['token'] == $_SESSION['token']){

            $stat = $PDO->prepare("DELETE FROM {$_POST['table']} WHERE {$_POST['idName']} = :id");

            $stat->execute([
                'id' => $id
            ]);
        }
}
header("Location:".$_SERVER['HTTP_REFERER']);