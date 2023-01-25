<?php
session_start();
include_once dirname(__FILE__,3)."/class/InputSecurityClass.php";
include_once dirname(__FILE__,3)."/dataBase/dataBaseConnection.php";

if(InputSecurity::validateWithoutNumber($_POST["designation"]) 
    && InputSecurity::validateWithoutLetter($_POST["rmv"]) 
    && InputSecurity::isEmpty($_POST["token"]) 
    && InputSecurity::isEmpty($_SESSION["token"])){
        
        if($_POST["token"] == $_SESSION["token"]){
                $stat = $PDO->prepare("SELECT equipmentTotalQuantity, equipmentAvailableQuantity FROM Equipment WHERE equipmentName = :designation");
                $stat->execute(['designation' => $_POST["designation"]]);
                $res = $stat->fetch();
                $stat = $PDO->prepare("UPDATE Equipment SET equipmentTotalQuantity = equipmentTotalQuantity - :rmv, equipmentAvailableQuantity = equipmentAvailableQuantity - :rmv WHERE equipmentName = :designation");
                if($res->equipmentAvailableQuantity > $_POST['rmv']){
                        $stat->execute([
                                'rmv' => $_POST["rmv"],
                                'designation' => $_POST["designation"]
                        ]);
                }
                else{
                        $stat->execute([
                                'rmv' => $res->equipmentAvailableQuantity,
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