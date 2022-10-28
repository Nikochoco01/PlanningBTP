<!DOCTYPE html>
<html lang="fr">
<?php $titre = "Profil"; ?>

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
            <img src="/img/defaultPP.png" alt="user picture" class="userPic" id="userPic">
            <p> Prénom NOM </p>
            <p> Mail </p>
            <p> Adresse postale </p>
            <p> Post entreprise </p>
            <p> Téléphone </p>
            
            <div class="listePermis" id="listePermis"></div>
            
            <a href="#"> <i> Save </i> Enregistrer </a>
        </main>
    </div>
</body>
</html>