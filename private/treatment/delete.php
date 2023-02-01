<?php
include_once APP . "private/class/InputSecurityClass.php";
include_once APP . "private/dataBase/dataBaseConnection.php";
if(InputSecurity::isEmpty($_POST['id'])
    && InputSecurity::isEmpty($_POST['idName'])
    && InputSecurity::isEmpty($_POST['table']) 
    && InputSecurity::isEmpty($_POST['token']) 
    && InputSecurity::isEmpty($_SESSION['token'])){
        if($_POST['token'] == $_SESSION['token']){
                
            $stat = $PDO->prepare("DELETE FROM {$_POST['table']} WHERE {$_POST['idName']} = :id");

            $stat->execute([
                'id' => $_POST['id']
            ]);
        }
}
header("Location:".$_SERVER['HTTP_REFERER']);