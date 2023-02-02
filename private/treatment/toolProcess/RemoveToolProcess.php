<?php
include_once APP . "private/class/InputSecurityClass.php";
include_once APP . "private/dataBase/dataBaseConnection.php";

if(InputSecurity::validateWithoutNumber($_POST["designation"] , $designation) 
    && InputSecurity::validateWithoutLetter($_POST["rmv"] , $removeQuantity) 
    && InputSecurity::isEmpty($_POST["token"] , $token) 
    && InputSecurity::isEmpty($_SESSION["token"] , $sessionToken)){
        
        if($_POST["token"] == $sessionToken){
                $stat = $PDO->prepare("SELECT equipmentTotalQuantity, equipmentAvailableQuantity FROM Equipment WHERE equipmentName = :designation");
                $stat->execute(['designation' => $designation]);
                $res = $stat->fetch();
                $stat = $PDO->prepare("UPDATE Equipment SET equipmentTotalQuantity = equipmentTotalQuantity - :rmv, equipmentAvailableQuantity = equipmentAvailableQuantity - :rmv WHERE equipmentName = :designation");
                if($res->equipmentAvailableQuantity > $removeQuantity){
                        $stat->execute([
                                'rmv' => $removeQuantity,
                                'designation' => $designation
                        ]);
                }
                else{
                        $stat->execute([
                                'rmv' => $res->equipmentAvailableQuantity,
                                'designation' => $designation
                        ]);
                }
        }
        unset($_SESSION['token']);
        header("Location:".$_SERVER['HTTP_REFERER']);
}
else{
        header("Location:/tool");
}