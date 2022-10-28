<!DOCTYPE html>
<html lang="fr">
<?php $titre = "Accueil"; ?>

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
            <h2> Bienvenue </h2>
            <p> Nom de la personne </p>
            <p> Date </p>
            <p> Horaires </p>
        </main>
    </div>
</body>
</html>