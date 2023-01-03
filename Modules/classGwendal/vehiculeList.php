<?php
include_once dirname(__FILE__,3)."/private/dataBase/dataBaseConnection.php";
$stat = $PDO->prepare("select v.vehicleLicensePlate, v.vehicleModel, v.vehicleMaxPassenger, v.vehicleDriverLicense from Vehicle v join DriverLicense d on v.vehicleDriverLicense = d.driverLicenseName");
$stat->execute();
$results = $stat->fetchAll();
foreach($results as $res):?>
<form class="vehicule" action="../Modules/classGwendal/delete.php" method="post">
    <input type="text" name="id" value="<?= $res->vehicleLicensePlate ?>" readonly>
    <p><?= $res->vehicleModel ?></p>
    <p><?= $res->vehicleMaxPassenger ?></p>
    <p><?= $res->vehicleDriverLicense ?></p>
    <input type="hidden" name="token" value="<?= $_SESSION["token"] ?>">
    <input type="hidden" name="table" value="Vehicle">
    <input type="hidden" name="idName" value="vehicleLicensePlate">
    <input type="submit" value="Effacer">
</form>
<?php endforeach; ?>