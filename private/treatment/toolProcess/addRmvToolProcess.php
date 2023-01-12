<?php
session_start();
include_once dirname(__FILE__,2)."/InputSecurityClass.php";
include_once dirname(__FILE__,3)."/dataBase/dataBaseConnection.php";

if(InputSecurity::isEmpty($_POST["designation"]) == $_POST["designation"] && InputSecurity::isEmpty($_POST["add"]) == $_POST["add"] && InputSecurity::isEmpty($_POST["token"]) == $_POST["token"] && InputSecurity::isEmpty($_SESSION["token"]) == $_SESSION["token"]){
    if($_POST["token"] == $_SESSION["token"]){
        if(empty($_POST["rmv"])){
            $stat = $PDO->prepare("update Equipment set equipmentTotalQuantity = equipmentTotalQuantity + :add, equipmentAvailableQuantity = equipmentAvailableQuantity + :add2 where equipmentName = :designation");
            $stat->execute([
                'add' => $_POST["add"],
                'add2' => $_POST["add"],
                'designation' => $_POST["designation"]
            ]);
        }
        else{
            $stat = $PDO->prepare("update Equipment set equipmentTotalQuantity = equipmentTotalQuantity - :add, equipmentAvailableQuantity = equipmentAvailableQuantity - :add2 where equipmentName = :designation");
            $stat->execute([
                'add' => $_POST["add"],
                'add2' => $_POST["add"],
                'designation' => $_POST["designation"]
            ]);
        }
    }
    unset($_SESSION['token']);
    header("Location:".$_SERVER['HTTP_REFERER']);
}
else{
    header("Location:".dirname(__FILE__,3)."/public/toolManagement.php");
}