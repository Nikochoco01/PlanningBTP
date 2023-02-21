<?php

if (InputSecurity::validateWithoutLetter($_POST['id'], $id, "licensePlate")
    && !InputSecurity::isEmpty($_POST['token'], $token)
    && !InputSecurity::isEmpty($_SESSION['token'], $sessionToken)) {
        if ($token == $sessionToken) {
            $linksToEvent = $dataBase->read(
                "GoTo",
                [
                    "fields" => ['eventId'],
                    "conditions" => ["vehicleLicensePlate" => $id]
                ]
            );

            foreach ($linksToEvent as $event) {
                $dataBase->deleteBtp(
                    "GoTo",
                    [
                        'eventId' => $event->eventId,
                        'vehicleLicensePlate' => $id
                    ]
                );
            }

            $dataBase->deleteBtp("Vehicle", ['vehicleLicensePlate' => $id]);
        }

        unset($_SESSION['token']);
}
header("Location:" . $_SERVER['HTTP_REFERER']);