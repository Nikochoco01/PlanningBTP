<?php
$stat = $PDO->prepare("select v.vehicleLicensePlate, v.vehicleModel, v.vehicleMaxPassenger, v.vehicleDriverLicense from Vehicle v join DriverLicense d on v.vehicleDriverLicense = d.driverLicenseName");
$stat->execute();
$results = $stat->fetchAll();
$i = 0;
foreach($results as $res):?>
<form class="vehicule" method="post">
    <input type="text" name="id" value="<?= $res->vehicleLicensePlate ?>" readonly>
    <input type="text" name="model" value="<?= $res->vehicleModel ?>">
    <select name="maxPassenger" id="maxPassenger<?= $i ?>">
        <option value="2" <?= $res->vehicleMaxPassenger == 2?"selected":"" ?>>2</option>
        <option value="3" <?= $res->vehicleMaxPassenger == 3?"selected":"" ?>>3</option>
        <option value="4" <?= $res->vehicleMaxPassenger == 4?"selected":"" ?>>4</option>
        <option value="5" <?= $res->vehicleMaxPassenger == 5?"selected":"" ?>>5</option>
        <option value="7" <?= $res->vehicleMaxPassenger == 7?"selected":"" ?>>7</option>
        <option value="8" <?= $res->vehicleMaxPassenger == 8?"selected":"" ?>>8</option>
        <option value="9" <?= $res->vehicleMaxPassenger == 9?"selected":"" ?>>9</option>
        <option value="10" <?= $res->vehicleMaxPassenger == 10?"selected":"" ?>>10</option>
        <option value="11" <?= $res->vehicleMaxPassenger == 11?"selected":"" ?>>11</option>
        <option value="12" <?= $res->vehicleMaxPassenger == 12?"selected":"" ?>>12</option>
        <option value="13" <?= $res->vehicleMaxPassenger == 13?"selected":"" ?>>13</option>
        <option value="14" <?= $res->vehicleMaxPassenger == 14?"selected":"" ?>>14</option>
        <option value="15" <?= $res->vehicleMaxPassenger == 15?"selected":"" ?>>15</option>
        <option value="16" <?= $res->vehicleMaxPassenger == 16?"selected":"" ?>>16</option>
        <option value="17" <?= $res->vehicleMaxPassenger == 17?"selected":"" ?>>17</option>
    </select>
    <select name="license" id="license<?= $i ?>" list="licenses">
        <?php 
        $stat = $PDO->prepare("select driverLicenseName, driverLicenseMaxPassenger from DriverLicense;");
                    
        $stat->execute();
        $results = $stat->fetchAll();
        foreach($results as $resu):?>
            <option max="<?= $resu->driverLicenseMaxPassenger ?>" <?= $res->vehicleDriverLicense == $resu->driverLicenseMaxPassenger?"selected":"" ?>> <?= $resu->driverLicenseName ?>
        <?php endforeach; ?>
    </select>
    <input type="hidden" name="token" value="<?= $_SESSION["token"] ?>">
    <input type="hidden" name="table" value="Vehicle">
    <input type="hidden" name="idName" value="vehicleLicensePlate">
    <input type="submit" value="Effacer" formaction="../Modules/classGwendal/delete.php">
    <input type="submit" value="Modifier" formaction="../private/treatment/vehicleProcess/modifyVehicleProcess.php">
    <input type="reset" value="Reset">
</form>
<?php 
$i++;
endforeach; ?>
<input type="hidden" id="n" value="<?= $i ?>">