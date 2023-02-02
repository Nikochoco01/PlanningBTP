<?php
    include_once APP . "private/dataBase/dataBaseConnection.php";

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
                        $stat = $PDO->prepare("select v.vehicleLicensePlate, v.vehicleModel, v.vehicleMaxPassenger, v.vehicleDriverLicense from Vehicle v join DriverLicense d on v.vehicleDriverLicense = d.driverLicenseName");
                        $stat->execute();
                        $results = $stat->fetchAll();
                        $i = 0;
                        foreach($results as $res):?>
                            <form class="vehicule" method="post">
                                <label for="id"> Immatriculation </label>
                                <input type="text" name="id" value="<?= $res->vehicleLicensePlate ?>" readonly>
                                <label for="model"> Model </label>
                                <?php if($rightToModify):?>
                                    <input type="text" name="model" value="<?= $res->vehicleModel ?>" required>

                                    <label for="maxPassenger"> Places disponible </label>
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

                                    <label for="license"> Permis </label>
                                    <select name="license" id="license<?= $i ?>" list="licenses" required>
                                        <?php 
                                        $sta = $PDO->prepare("select driverLicenseName, driverLicenseMaxPassenger from DriverLicense;");
                                                    
                                        $sta->execute();
                                        $resul = $sta->fetchAll();
                                        foreach($resul as $resu):?>
                                            <option max="<?= $resu->driverLicenseMaxPassenger ?>" <?= $res->vehicleDriverLicense == $resu->driverLicenseName?"selected":""?>> <?= $resu->driverLicenseName ?>
                                    <?php endforeach; ?>
                                    </select>
                                    <input type="hidden" name="token" value="<?= $_SESSION["token"] ?>">
                                    <input type="hidden" name="table" value="Vehicle">
                                    <input type="hidden" name="idName" value="vehicleLicensePlate">
                                    <input type="submit" value="Effacer" formaction="../delete">
                                    <input type="submit" value="Modifier" formaction="/vehicleMod">
                                    <input type="reset" value="Reset">
                                <?php else:?>
                                    <p><?= $res->vehicleModel ?></p>
                                    <label> Places disponible </label>
                                    <p><?= $res->vehicleMaxPassenger ?></p>
                                    <label> Permis </label>
                                    <p><?= $res->vehicleDriverLicense ?></p>
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

                        <label for="model">Model de vehicule</label>
                        <input type="text" name="model" id="model" required>

                        <label for="license">Permis nécessaire</label>
                        <select name="license" id="license" list="licenses" required>
                            <option value="">-- Choix du Permis --</option>
                            <?php 
                            $stat = $PDO->prepare("select driverLicenseName, driverLicenseMaxPassenger from DriverLicense;");
                            
                            $stat->execute();
                            $results = $stat->fetchAll();
                            foreach($results as $res):?>
                                <option max="<?= $res->driverLicenseMaxPassenger ?>"> <?= $res->driverLicenseName ?>
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