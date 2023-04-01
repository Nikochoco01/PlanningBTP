<?php

$testLicensePlate = InputSecurity::validateWithoutLetter($_POST['addLicensePlate'], $vehicleLicensePlate , "licensePlate");
$testVehicleModel = InputSecurity::isEmpty($_POST['addModel'], $vehicleModel);
$testDriverLicense = InputSecurity::validateWithoutNumber($_POST['addDriverLicense'], $driverLicense);
$testMaxPassenger = InputSecurity::validateWithoutLetter($_POST['addSeatsNumber'], $maxPassenger);
$testAvailable = InputSecurity::validateWithoutNumber($_POST['addAvailable'], $available);
$testTokenForm = InputSecurity::isEmpty($_POST['token'], $tokenForm);
$testTokenSession = InputSecurity::isEmpty($_SESSION['token'], $tokenSession);

$vehicleId = $_POST['vehicleId'];

if ($testLicensePlate && !$testVehicleModel && $testDriverLicense && $testMaxPassenger && $testAvailable && !$testTokenForm && !$testTokenSession ) {
    if ($tokenForm == $tokenSession) {
        $goToEvent = $dataBase->read(
            "GoTo",
            [
                "conditions" => ["vehicleId" => $vehicleId],
                "fields" => ['eventId']
            ]
        );

        foreach ($goToEvent as $event) {
            $dataBase->delete("GoTo" ,"vehicleId" , $vehicleId );
        }

        $dataBase->delete("Vehicle" , "vehicleId" , $vehicleId);
    }
} else {
    InputSecurity::returnError("Erreur lors de la suppression du véhicule");
}
unset($_SESSION['token']);
header("Location:/vehicle?onglet=vehicles&display=view");
exit();