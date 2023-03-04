<?php

if( InputSecurity::validateWithoutNumber($_POST['designation'] , $designation)
    && InputSecurity::validateWithoutNumber($_POST['total'] , $total)
    && InputSecurity::isEmpty($_POST['token'] , $tokenPost)
    && InputSecurity::isEmpty($_SESSION['token'] , $tokenSession)){
        if($tokenPost == $tokenSession){
            $stat = $PDO->prepare("SELECT equipmentName FROM Equipment WHERE equipmentName = :equipmentName");
            $stat->execute([ 'equipmentName' => $_POST['designation']]);

            if(!$stat->fetch()){
                $stat = $PDO->prepare("INSERT INTO Equipment VALUES(:designation, :tt, :tt)");
                $stat->execute([
                    'designation' => $_POST['designation'],
                    'tt' => $_POST['total']
                ]);
            }
            else{
                // $stat = $PDO->prepare("UPDATE Equipment SET equipmentTotalQuantity = equipmentTotalQuantity + :add, equipmentAvailableQuantity = equipmentAvailableQuantity + :add WHERE equipmentName = :designation");
                // $stat->execute([
                //     'add' => $_POST["total"],
                //     'designation' => $_POST["designation"]
                // ]);
                // $dataBase->save("Equipment",[
                //     "equipmentTotalQuantity" => $total,
                //     "designation" => $designation
                // ]);
            }
        }
        unset($_SESSION['token']);
        header("Location:".$_SERVER['HTTP_REFERER']);
}
else{
    header("Location:/tool");
}