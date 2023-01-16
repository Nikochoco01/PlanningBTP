<?php 
    session_start();
    include_once dirname(__FILE__,2)."/private/class/InputSecurityClass.php";   
    include_once dirname(__FILE__,2)."/private/dataBase/dataBaseConnection.php";
    include_once dirname(__FILE__,2). "/private/constant/constant.php";
    include_once dirname(__FILE__,2)."/private/dataBase/dataBaseConnection.php";

    $_SESSION['token'] = InputSecurity::generateToken(10);
?>

<!DOCTYPE html>
<html lang="fr">

<?php $title = "Véhicule";
$rightToModify = $_SESSION['userFonction'] == 'administrator' || $_SESSION['userFonction'] == 'vehicleManager';
include_once dirname(__FILE__,2)."/private/constant/page/head.php";
?>

<body>
    <?php include_once dirname(__FILE__,2)."/private/constant/page/header.php"; ?>

    <div class="layout">
        <?php include_once dirname(__FILE__,2)."/private/constant/page/aside.php"; ?>

        <main>

            <div class="vehiculeList">
                <?php 
                    include_once dirname(__FILE__,2)."/Modules/classGwendal/vehiculeList.php";
                ?>
            </div>

            <?php if($rightToModify):?>
            <form action="../Modules/classGwendal/newVehicle.php" method="post">
                <label for="plate">Immatriculation</label>
                <input type="search" name="plate" id="plate">

                <label for="model">Model de vehicule</label>
                <input type="text" name="model" id="model">

                <label for="license">Permis nécessaire</label>
                <select name="license" id="license" list="licenses">
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
                <select name="maxPassenger" id="maxPassenger">
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
            
        </main>
    </div>
</body>
<script src="../private/js/vehicle.js"></script>
</html>