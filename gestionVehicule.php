<?php 
    session_start();
    include_once "Modules/config.php";
    include_once dirname(__FILE__)."/dataBase/dataBaseConnection.php";
    include_once dirname(__FILE__)."/vehiculeClass.php"; 
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

            <a href="#"> <i> Add Véhicule </i> <span> Ajout Véhicule </span> </a>
            <div>
                <i class="icon-search"></i>
                <input type="search" name="material" id="material">
            </div>
                
            <div class="vehiculeList">
                <?php 
                    $stat = $PDO->prepare("");

                    $stat->execute();
                    $results = $stat->fetchAll();
                    foreach($results as $res){
                        $veh = new Vehicule();
                    }
                ?>
            </div>
            
        </main>
    </div>
</body>
</html>