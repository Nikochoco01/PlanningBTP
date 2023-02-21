<?php
include_once APP . "/private/dataBase/dataBaseConnection.php";
include_once APP . "/private/class/InputSecurityClass.php";

InputSecurity::validateWithoutLetter($_POST['eventId'] , $eventId);
InputSecurity::validateWithoutNumber($_POST['eventDescription'] , $eventDescription);
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

header('Location: /planning?onglet=missions&display=week&year=2023&month=02&week='.$_SESSION['CURRENTWEEK']);
Exit();
?>