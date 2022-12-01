<?php 
    session_start();
    include_once "Modules/config.php";
    include_once dirname(__FILE__)."/dataBase/dataBaseConnection.php";
    include_once dirname(__FILE__)."/vehiculeClass.php"; 
    include_once dirname(__FILE__)."/tokenGenerator.php";

    $_SESSION['token'] = generateToken(10);
?>
<!DOCTYPE html>
<html lang="fr">
<?php $titlePage = "Véhicule"; ?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/CSS/default.css">
    <link rel="stylesheet" href="/CSS/menu.css">
    <link rel="stylesheet" href="/Icon/style.css">
    <title> <?php echo $titlePage ?> </title>
</head>

<body>
    <?php include_once "Modules/header.php"; ?>

    <div class="layout">
        <?php include_once "Modules/aside.php"; ?>

        <main>

            <!-- <a href="#"> <i> Add Véhicule </i> <span> Ajout Véhicule </span> </a> -->
            <div class="vehiculeList">
                <?php 
                    $stat = $PDO->prepare("select v.idVehicle, v.type, v.availability, v.designation, d.driverLicenseName from Vehicle v join DriverLicense d on v.idDriverLicense = d.idDriverLicense");

                    $stat->execute();
                    $results = $stat->fetchAll();
                    foreach($results as $res){
                        $veh = new Vehicule($res->idVehicle, $res->type, $res->designation, $res->driverLicenseName);
                        echo $veh->display($_SESSION['token']);
                    }
                ?>
            </div>

            <form action="newVehicle.php" method="post">
                <label for="plate">Immatriculation</label>
                <input type="search" name="plate" id="plate">

                <label for="type">Type de vehicule</label>
                <input type="text" name="type" id="type">

                <label for="model">Model de vehicule</label>
                <input type="text" name="model" id="model">

                <label for="license">Permis nécessaire</label>
                <input type="text" name="license" id="license" list="licenses">
                <datalist id="licenses">
                    <?php 
                    $stat = $PDO->prepare("select driverLicenseName from DriverLicense;");
                    
                    $stat->execute();
                    $results = $stat->fetchAll();
                    foreach($results as $res){
                        echo "<option>". $res->driverLicenseName;
                    }
                    ?>
                </datalist>

                <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>">

                <span>
                    <input type="submit" value="Valider">
                    <input type="reset" value="Annuler">
                </span>
            </form>
            
        </main>
    </div>
</body>
</html>