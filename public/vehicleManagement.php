<?php
    $_SESSION['token'] = InputSecurity::generateToken(10);
?>

<!DOCTYPE html>
<html lang="fr">

<?php $title = "Véhicule";
$rightToModify = ($_SESSION['userFonction'] == 'administrator' || $_SESSION['userFonction'] == 'vehicleManager');
include_once APP . "private/constant/page/head.php";
?>

<body>
    <div class="layout">
        <?php include_once APP . "private/constant/page/header.php"; ?>
        <?php include_once APP . "private/constant/page/aside.php"; ?>

        <main>
            <div class="vehicleContainer">
                <div class="vehiculeList">
                    <?php 
                        $results = $dataBase->read("Vehicle v join DriverLicense d on v.vehicleDriverLicense = d.driverLicenseName",
                            [
                                'fields' => ['v.vehicleLicensePlate', 'v.vehicleModel', 'v.vehicleMaxPassenger', 'v.vehicleDriverLicense']
                            ]
                        );
                        $i = 0;
                        foreach($results as $res):?>
                            <form class="vehicule" method="post">
                                <label for="id<?= $i ?>"> Immatriculation </label>
                                <input type="text" name="id" id="id<?= $i ?>" value="<?= InputSecurity::displayWithFormat($res->vehicleLicensePlate, "uppercase") ?>" readonly>

                                <label for="model<?= $i ?>"> Modele </label>
                                <?php if($rightToModify):?>
                                    <input type="text" name="model" id="model<?= $i ?>" value="<?= InputSecurity::displayWithFormat($res->vehicleModel, "uppercaseFirstLetter") ?>" required>

                                    <label for="maxPassenger<?= $i ?>"> Places disponible </label>
                                    <select name="maxPassenger" id="maxPassenger<?= $i ?>">
                                        <option <?= $res->vehicleMaxPassenger == 2?"selected":"" ?>>2</option>
                                        <option <?= $res->vehicleMaxPassenger == 3?"selected":"" ?>>3</option>
                                        <option <?= $res->vehicleMaxPassenger == 4?"selected":"" ?>>4</option>
                                        <option <?= $res->vehicleMaxPassenger == 5?"selected":"" ?>>5</option>
                                        <option <?= $res->vehicleMaxPassenger == 7?"selected":"" ?>>7</option>
                                        <option <?= $res->vehicleMaxPassenger == 8?"selected":"" ?>>8</option>
                                        <option <?= $res->vehicleMaxPassenger == 9?"selected":"" ?>>9</option>
                                        <option <?= $res->vehicleMaxPassenger == 10?"selected":"" ?>>10</option>
                                        <option <?= $res->vehicleMaxPassenger == 11?"selected":"" ?>>11</option>
                                        <option <?= $res->vehicleMaxPassenger == 12?"selected":"" ?>>12</option>
                                        <option <?= $res->vehicleMaxPassenger == 13?"selected":"" ?>>13</option>
                                        <option <?= $res->vehicleMaxPassenger == 14?"selected":"" ?>>14</option>
                                        <option <?= $res->vehicleMaxPassenger == 15?"selected":"" ?>>15</option>
                                        <option <?= $res->vehicleMaxPassenger == 16?"selected":"" ?>>16</option>
                                        <option <?= $res->vehicleMaxPassenger == 17?"selected":"" ?>>17</option>
                                    </select>

                                    <label for="license<?= $i ?>"> Permis </label>
                                    <select name="license" id="license<?= $i ?>" list="licenses" required>
                                        <?php 
                                        $resul =
                                        $results = $dataBase->read('DriverLicense', ['fields' => ['driverLicenseName', 'driverLicenseMaxPassenger']]);
                                        foreach($resul as $resu):?>
                                            <option max="<?= $resu->driverLicenseMaxPassenger ?>" <?= $res->vehicleDriverLicense == $resu->driverLicenseName?"selected":""?>> <?= InputSecurity::displayWithFormat($resu->driverLicenseName, "uppercase") ?>
                                    <?php endforeach; ?>
                                    </select>
                                    <input type="hidden" name="token" value="<?= $_SESSION["token"] ?>">
                                    <input type="submit" value="Effacer" formaction="/vehicleDelete">
                                    <input type="submit" value="Modifier" formaction="/vehicleMod">
                                    <input type="reset" value="Reset">
                                <?php else:?>
                                    <p><?= InputSecurity::displayWithFormat($res->vehicleModel, "uppercaseFirstLetter") ?></p>
                                    <label> Places disponible </label>
                                    <p><?= $res->vehicleMaxPassenger ?></p>
                                    <label> Permis </label>
                                    <p><?= InputSecurity::displayWithFormat($res->vehicleDriverLicense, "uppercase") ?></p>
                                <?php endif;?>
                            </form>
                    <?php $i++;
                    endforeach; ?>
                    <input type="hidden" id="n" value="<?= $i ?>">
                </div>

                <?php if($rightToModify):?>
                    <form method="post" class="formAddVehicle">
                        <label for="plate">Immatriculation</label>
                        <input type="search" name="plate" id="plate" required>

                        <label for="model">Modele de vehicule</label>
                        <input type="text" name="model" id="model" required>

                        <label for="license">Permis nécessaire</label>
                        <select name="license" id="license" list="licenses" required>
                            <option value="">-- Choix du Permis --</option>
                            <?php 
                            $results = $dataBase->read('DriverLicense', ['fields' => ['driverLicenseName', 'driverLicenseMaxPassenger']]);
                            foreach($results as $res):?>
                                <option max="<?= $res->driverLicenseMaxPassenger ?>"> <?= InputSecurity::displayWithFormat($res->driverLicenseName, "uppercase") ?>
                            <?php endforeach; ?>
                        </select>

                        <label for="maxPassenger">Nombre de passager maximal</label>
                        <select name="maxPassenger" id="maxPassenger" required>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                            <option value="13">13</option>
                            <option value="14">14</option>
                            <option value="15">15</option>
                            <option value="16">16</option>
                            <option value="17">17</option>
                        </select>

                        <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>">

                        <span>
                            <input type="submit" value="Valider">
                            <input type="reset" value="Annuler">
                        </span>
                    </form>
                <?php endif; ?>
            </div>
        </main>
    </div>
</body>
<script src="/js/vehicle.js"></script>
</html>