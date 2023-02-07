<?php
include_once APP . "private/class/InputSecurityClass.php";
include_once APP . "private/dataBase/dataBaseConnection.php";

if(InputSecurity::validateWithoutLetter($_POST['id'], $id, "licensePlate")){
    $linksToEvent = $db->read("GoTo",
        [
            "fields" => ['eventId'],
            "conditions" => ["vehicleLicensePlate" => $id]
        ]);
    
    foreach($linksToEvent as $event){
        $db->del("GoTo", 
        [
            'eventId' => $event['eventId'],
            'vehicleLicensePlate' => $id
        ]);
    }

    $db->del("Vehicle", ['vehicleLicensePlate' => $id]);

}
header("Location:".$_SERVER['HTTP_REFERER']);