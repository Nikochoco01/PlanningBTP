<?php
include_once APP . "private/class/InputSecurityClass.php";
include_once APP . "private/dataBase/dataBaseConnection.php";

if( InputSecurity::validateWithoutNumber($_POST['designation'], $designation)
    && InputSecurity::validateWithoutLetter($_POST['total'], $total)
    && !InputSecurity::isEmpty($_POST['token'], $token)
    && !InputSecurity::isEmpty($_SESSION['token'], $sessionToken)){
        if($token == $sessionToken){
            $stat = $PDO->prepare("SELECT equipmentName FROM Equipment WHERE equipmentName = :equipmentName");
            $stat->execute([ 'equipmentName' => $designation]);
            if(!$stat->fetch()){
                $stat = $PDO->prepare("INSERT INTO Equipment VALUES(:designation, :tt, :tt)");
                $stat->execute([
                    'designation' => $designation,
                    'tt' => $total
                ]);
            }
            else{
                $stat = $PDO->prepare("UPDATE Equipment SET equipmentTotalQuantity = equipmentTotalQuantity + :add, equipmentAvailableQuantity = equipmentAvailableQuantity + :add WHERE equipmentName = :designation");
                $stat->execute([
                    'add' => $total,
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