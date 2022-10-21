<!DOCTYPE html>
<html lang="fr">
<?php $titre = "Profil";
include_once "module/head.php";?>

<body>
    <?php include_once "module/header.php"; ?>

    <div class="layout">
        <?php include_once "module/aside.php"; ?>

        <main>
            <img src="" alt="Profil Picture">
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