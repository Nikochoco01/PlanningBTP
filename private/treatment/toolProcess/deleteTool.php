<?php

if(InputSecurity::validateWithoutNumber($_POST['id'], $id)
    && !InputSecurity::isEmpty($_POST['token'], $token)
    && !InputSecurity::isEmpty($_SESSION['token'], $sessionToken)){
        if($token == $sessionToken){
            $linksToEvent = $db->read("UsedEquipment",
                [
                    'fields' => ['eventId'],
                    'conditions' => ['equipmentName' => $id]
                ]
            );
            
            foreach($linksToEvent as $event){
                $db->deleteBtp("UsedEquipment", 
                    [
                        'eventId' => $event->eventId,
                        'equipmentName' => $id
                    ]
                );
            }

            $db->deleteBtp("Equipment", ['equipmentName' => $id]);
        }

        unset($_SESSION['token']);
}
header("Location:".$_SERVER['HTTP_REFERER']);