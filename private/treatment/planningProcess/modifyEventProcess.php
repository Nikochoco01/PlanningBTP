<?php 
session_start();
include_once dirname(__FILE__,4). "/private/dataBase/dataBaseConnection.php";
include_once dirname(__FILE__,4). "/private/class/InputSecurityClass.php";

InputSecurity::validateWithoutLetter($_POST['eventId'] , $eventId);
InputSecurity::validateWithoutTags($_POST['eventDescription'] , $eventDescription);
InputSecurity::isEmpty($_POST['eventStartDate'] , $eventStartDate);
InputSecurity::isEmpty($_POST['eventEndDate'] , $eventEndDate);
InputSecurity::isEmpty($_POST['eventStartTime'] , $eventStartTime);
InputSecurity::isEmpty($_POST['eventEndTime'] , $eventEndTime);



/**
 * Query to update the selected event
 */
$updateEvent = $PDO->prepare("update Event set eventDescription = :varDescription , eventStartDate = :varStartDate , eventEndDate = :varEndDate , eventStartTime = :varStartTime , eventEndTime = :varEndTime where eventId = :varEventId");
$updateEvent->bindParam('varDescription', $eventDescription);
$updateEvent->bindParam('varStartDate' , $eventStartDate);
$updateEvent->bindParam('varEndDate' , $eventEndDate);
$updateEvent->bindParam('varStartTime' , $eventStartTime);
$updateEvent->bindParam('varEndTime' , $eventEndTime);
$updateEvent->bindParam('varEventId' , $eventId);

$updateEvent->execute();

header('Location: /public/planning.php?onglet=missions&display=week&year=2023&month=01&week='.$_SESSION['CURRENTWEEK']);
Exit();
?>