<?php 
session_start();
include_once dirname(__FILE__,4). "/private/dataBase/dataBaseConnection.php";
include_once dirname(__FILE__,4). "/private/class/InputSecurityClass.php";

$eventDescription = InputSecurity::validateWithoutTags($_POST['eventDescription']);
$eventStartDate = InputSecurity::isEmpty($_POST['eventStartDate']);
$eventEndDate = InputSecurity::isEmpty($_POST['eventEndDate']);
$eventStartTime = InputSecurity::isEmpty($_POST['eventStartTime']);
$eventEndTime = InputSecurity::isEmpty($_POST['eventEndTime']);

// if(isset($_SESSION['ERROR'])){

// }

var_dump($eventStartDate);
var_dump($eventEndDate);
var_dump($eventStartTime);
var_dump($eventEndTime);

// $_SESSION['testArray'] = array();
// array_push($_SESSION['testArray'] , ['Test1' => '1']);
// array_push($_SESSION['testArray'] , ['Test2' => '2']);
// var_dump($_SESSION['testArray']);

// for($i = 0; $i < count($_SESSION['testArray']); $i++){
//     // if($_SESSION['testArray'][$i] == 'test1'){
//         var_dump(" Test erreur t: " . $_SESSION['testArray'][$i]['Test1']);
//     // }
// }

// foreach($_SESSION['testArray'] as $test){
//     var_dump(" Test erreur t: " . $test['Test1']);
// }
// var_dump(" test erreur " .$_SESSION['testArray'][0]['Test1']);

// // Faire le test des dates pour ajouter X fois l'event
/**
 * test 
 */
    // if($eventStartDate < date('Y-m-d')){
    //     // return error
    // }

    switch($eventStartDate){
        case $eventStartDate < date('Y-m-d'):
                var_dump('date invalid');
                return false;
            break;
        case $eventStartDate >= date('Y-m-d'):
                $insertEvent->bindParam('varStartDate' , $eventStartDate);
                return true;
            break;
    }

    switch($eventEndDate){
        case $eventEndDate < date('Y-m-d'):
                var_dump('date invalid');
                return false;
            break;
        case $eventEndDate >= date('Y-m-d'):
                $insertEvent->bindParam('varEndDate' , $eventEndDate);
                return true;
            break;
    }

    switch($eventStartTime){
        case $eventStartTime < date('H:i'):
                var_dump('date invalid');
                return false;
            break;
        case $eventStartTime >= date('H:i'):
                $insertEvent->bindParam('varStartTime' , $eventStartTime);
                return true;
            break;
    }

    switch($eventEndTime){
        case $eventEndTime < date('H:i'):
                var_dump('date invalid');
                return false;
            break;
        case $eventEndTime >= date('H:i'):
                $insertEvent->bindParam('varEndTime' , $eventEndTime);
                return true;
            break;
    }

$eventWorksite = $_POST['addWorksite'];

$eventEmployees = $_POST['addEmployee'];

$eventVehicles = $_POST['addVehicle'];

$eventMaterials = $_POST['addMaterial'];
$eventMaterialsQuantity = $_POST['materialQuantity'];


// function addEvent(){
//     /**
//      * Query to insert into Event the new event
//      */
//     $insertEvent = $PDO->prepare("insert into Event values(0 , :varDescription , :varStartDate , :varEndDate , :varStartTime , :varEndTime , :varWorksite)");
//     $insertEvent->bindParam('varDescription', $eventDescription);
//     $insertEvent->bindParam('varStartDate' , $eventStartDate);
//     $insertEvent->bindParam('varEndDate' , $eventEndDate);
//     $insertEvent->bindParam('varStartTime' , $eventStartTime);
//     $insertEvent->bindParam('varEndTime' , $eventEndTime);
//     $insertEvent->bindParam('varWorksite' , $eventWorksite);

//    // $insertEvent->execute();
// }

// function getEventId(){
//     /**
//      * Get the id of last Event so this event
//      */
//     $getLastEvent = $PDO->prepare("select max(eventID) eventId from Event");
//     $getLastEvent->execute();
//     $gettingLastEvent = $getLastEvent->fetch();
//     $gettingLastEvent = $gettingLastEvent->eventId;
// }

// function addEmployee(){
//     /**
//      * Query to insert into Affected the person selected
//      */
//     foreach($eventEmployees as $eventEmployee){
//         $insertAffected = $PDO->prepare("insert into Affected values(:varUser , :varEvent)");
//         $insertAffected->bindParam('varUser', $eventEmployee);
//         $insertAffected->bindParam('varEvent' , $gettingLastEvent);
//         $insertAffected->execute();
//     }
// }

// function addVehicle(){
//     /**
//      * Query to insert into GoTo the vehicles selected
//      */
//     foreach($eventVehicles as $eventVehicle){
//         $insertGoTo = $PDO->prepare("insert into GoTo values(:varLicensePlate , :varEvent)");
//         $insertGoTo->bindParam('varLicensePlate', $eventVehicle);
//         $insertGoTo->bindParam('varEvent' , $gettingLastEvent);
//         $insertGoTo->execute();
//     }
// }

// function addMaterial(){
//     /**
//      * Query to insert into UsedEquipment the equipment selected
//      */
//     for($i = 0; $i < count($eventMaterials); $i++){
//         $insertGoTo = $PDO->prepare("insert into UsedEquipment values(:varEvent, :varMaterialName , :varQuantity)");
//         $insertGoTo->bindParam('varEvent' , $gettingLastEvent);
//         $insertGoTo->bindParam('varMaterialName', $eventMaterials[$i]);
//         $insertGoTo->bindParam('varQuantity', $eventMaterialsQuantity[$i]);
//         $insertGoTo->execute();
//     }
// }

header('Location: /public/planning.php?onglet=missions&display=week&year=2023&month=01&week='.$_SESSION['CURRENTWEEK']);
Exit();

?>