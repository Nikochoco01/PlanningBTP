<?php
$eventDescription = InputSecurity::validateWithoutTags($_POST['eventDescription']);
InputSecurity::isEmpty($_POST['eventStartDate'] , $eventStartDate);
InputSecurity::isEmpty($_POST['eventEndDate'] , $eventEndDate);
InputSecurity::isEmpty($_POST['eventStartTime'] , $eventStartTime);
InputSecurity::isEmpty($_POST['eventEndTime'] , $eventEndTime);

// // Faire le test des dates pour ajouter X fois l'event
/**
 * test 
 */
    // if($eventStartDate < date('Y-m-d')){
    //     // return error
    // }

    // switch($eventStartDate){
    //     case $eventStartDate < date('Y-m-d'):
    //             var_dump('date invalid');
    //             return false;
    //         break;
    //     case $eventStartDate >= date('Y-m-d'):
    //             $insertEvent->bindParam('varStartDate' , $eventStartDate);
    //             return true;
    //         break;
    // }

    // switch($eventEndDate){
    //     case $eventEndDate < date('Y-m-d'):
    //             var_dump('date invalid');
    //             return false;
    //         break;
    //     case $eventEndDate >= date('Y-m-d'):
    //             $insertEvent->bindParam('varEndDate' , $eventEndDate);
    //             return true;
    //         break;
    // }

    // switch($eventStartTime){
    //     case $eventStartTime < date('H:i'):
    //             var_dump('date invalid');
    //             return false;
    //         break;
    //     case $eventStartTime >= date('H:i'):
    //             $insertEvent->bindParam('varStartTime' , $eventStartTime);
    //             return true;
    //         break;
    // }

    // switch($eventEndTime){
    //     case $eventEndTime < date('H:i'):
    //             var_dump('date invalid');
    //             return false;
    //         break;
    //     case $eventEndTime >= date('H:i'):
    //             $insertEvent->bindParam('varEndTime' , $eventEndTime);
    //             return true;
    //         break;
    // }

$eventWorksite = $_POST['addWorksite'];

// $eventEmployees = $_POST['addEmployee'];

$eventVehicles = $_POST['addVehicle'];

$eventMaterials = $_POST['addMaterial'];
$eventMaterialName = $_POST['materialName'];

$eventMaterialsQuantity = $_POST['materialQuantity'];

var_dump($eventMaterialsQuantity);

// var_dump($_POST);

// var_dump($eventWorksite);
// var_dump($eventVehicles);
// var_dump($eventMaterials);
// var_dump($eventMaterialsQuantity);


    $insertEvent = $dataBase->save("Event",[
        "eventDescription" => $eventDescription,
        "eventStartDate" => $eventStartDate,
        "eventEndDate" => $eventEndDate,
        "eventStartTime" => $eventStartTime,
        "eventEndTime" => $eventEndTime,
        "worksiteId"=> $eventWorksite
    ],"");

    $getLastEvent = $dataBase->read("Event",[
        "fields" => ["max(eventID) eventId"]
    ])[0];

// if($eventEmployees){
//     foreach($eventEmployees as $eventEmployee){
//         $this->dataBase->save("Affected",[
//             "userId" => $eventEmployee,
//             "eventId" => $gettingLastEvent->eventId
//         ],"");
//     }
// }

if($eventVehicles){
    foreach($eventVehicles as $eventVehicle){
        // var_dump($eventVehicle);
        $dataBase->save("GoTo",[
            "vehicleId" => $eventVehicle,
            "eventId" => $getLastEvent->eventId
        ],"");
    }
}

if($eventMaterials){

    for($i = 0; $i < count($eventMaterials); $i++){

        $dataBase->save("UsedEquipment",[
            "eventId" => $getLastEvent->eventId,
            "equipmentId" => $eventMaterial, 
            "equipmentName" => $eventMaterialName[$i],
            "Quantity" => $eventMaterialsQuantity[$i]
        ],"");
    }
}

header('Location: /planning?onglet=missions&display=week&year=2023&month=01&week='.$_SESSION['CURRENTWEEK']);
Exit();

?>