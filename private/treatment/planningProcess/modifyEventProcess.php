<?php
include_once APP . "/private/dataBase/dataBaseConnection.php";
include_once APP . "/private/class/InputSecurityClass.php";

InputSecurity::validateWithoutLetter($_POST['eventId'] , $eventId);
InputSecurity::validateWithoutNumber($_POST['eventDescription'] , $eventDescription);
InputSecurity::isEmpty($_POST['eventStartDate'] , $eventStartDate);
InputSecurity::isEmpty($_POST['eventEndDate'] , $eventEndDate);
InputSecurity::isEmpty($_POST['eventStartTime'] , $eventStartTime);
InputSecurity::isEmpty($_POST['eventEndTime'] , $eventEndTime);
InputSecurity::isEmpty($_POST['modifyWorksite'] , $eventWorksite);

    $dataBase->save("Event",[
        "eventId" => $eventId,
        "eventDescription" => $eventDescription,
        "eventStartDate" => $eventStartDate,
        "eventEndDate" => $eventEndDate,
        "eventStartTime" => $eventStartTime,
        "eventEndTime" => $eventEndTime,
        "worksiteId" => $eventWorksite
    ] , "eventId");

header('Location: /planning?onglet=missions&display=week&year='.$_POST['year'].'&month='.$_POST['month'].'&week='.$_POST['week']);
Exit();
?>