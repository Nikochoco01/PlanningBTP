<!DOCTYPE html>
<html lang="fr">
<?php $titre = "Véhicule"; ?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/CSS/default.css">
    <link rel="stylesheet" href="/CSS/menu.css">
    <link rel="stylesheet" href="/Icon/style.css">
    <title> <?php echo $titre ?> </title>
</head>

<body>
    <?php include_once "module/header.php"; ?>

    <div class="layout">
        <?php include_once "module/aside.php"; ?>

        <main>

            <a href="#"> <i> Add Véhicule </i> <span> Ajout Véhicule </span> </a>
            <div>
                <i class="icon-search"></i>
                <input type="search" name="material" id="material">
            </div>
                
            <div class="listeVehicule" id="listeVehicule"></div>
            
        </main>
    </div>
</body>
</html>