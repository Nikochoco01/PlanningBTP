<?php

if(InputSecurity::validateWithoutNumber($_POST['id'], $id)
    && !InputSecurity::isEmpty($_POST['token'], $token)
    && !InputSecurity::isEmpty($_SESSION['token'], $sessionToken)){
        if($token == $sessionToken){
            $linksToEvent = $dataBase->read("UsedEquipment",
                [
                    'fields' => ['eventId'],
                    'conditions' => ['equipmentName' => $id]
                ]
            );
            
            foreach($linksToEvent as $event){
                $dataBase->deleteBtp("UsedEquipment", 
                    [
                        'eventId' => $event->eventId,
                        'equipmentName' => $id
                    ]
                );
            }

            $dataBase->deleteBtp("Equipment", ['equipmentName' => $id]);
        }

        unset($_SESSION['token']);
}
header("Location:".$_SERVER['HTTP_REFERER']);