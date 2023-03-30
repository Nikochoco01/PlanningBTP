<?php
// $testLicensePlate = InputSecurity::validateWithoutLetter($_POST['addLicensePlate'], $licensePlate , "licensePlate");
$testVehicleModel = InputSecurity::isEmpty($_POST['addModel'], $vehicleModel);
$testDriverLicense = InputSecurity::validateWithoutNumber($_POST['addDriverLicense'], $driverLicense);
$testMaxPassenger = InputSecurity::validateWithoutLetter($_POST['addSeatsNumber'], $maxPassenger);
$testAvailable = InputSecurity::validateWithoutNumber($_POST['addAvailable'], $available);
$testTokenForm = InputSecurity::isEmpty($_POST['token'], $tokenForm);
$testTokenSession = InputSecurity::isEmpty($_SESSION['token'], $tokenSession);

$vehicleLicensePlate = $_POST['vehicleLicensePlate'];

if (!$testVehicleModel && $testDriverLicense && $testMaxPassenger && $testAvailable && !$testTokenForm && !$testTokenSession ) {
    if($tokenForm == $tokenSession){
        $dataBase->save("Vehicle", [
            "vehicleLicensePlate" => $vehicleLicensePlate,
            "vehicleModel" => $vehicleModel,
            "vehicleDriverLicense" => $driverLicense,
            "vehicleMaxPassenger" => $maxPassenger,
            "vehicleDisponibility" => $available
        ], "vehicleLicensePlate");
    }
} else {
    InputSecurity::returnError("Un des champs ne correspond pas aux demandes du formulaire");
}
unset($_SESSION['token']);
header("Location:/vehicle?onglet=vehicles&display=view");
exit();