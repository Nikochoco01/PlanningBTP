<?php

if(InputSecurity::validateWithoutLetter($_POST['id'], $id, "licensePlate")){
    $linksToEvent = $db->read("GoTo",
        [
            "fields" => ['eventId'],
            "conditions" => ["vehicleLicensePlate" => $id]
        ]);
    
    foreach($linksToEvent as $event){
        $db->deleteBtp("GoTo", 
        [
            'eventId' => $event->eventId,
            'vehicleLicensePlate' => $id
        ]);
    }

    $db->deleteBtp("Vehicle", ['vehicleLicensePlate' => $id]);

}
header("Location:".$_SERVER['HTTP_REFERER']);