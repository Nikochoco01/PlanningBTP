<!DOCTYPE html>
<html lang="fr">
<?php $titre = "Profil";
include_once "module/head.php";?>

<body>
    <?php include_once "module/header.php"; ?>

    <div class="layout">
        <?php include_once 'module/aside.php'; ?>

        <main>
            <nav>
                <menu type="toolbar">
                    <li> <a href="profilAdmPerso.html"> Personnel </a> </li>
                    <li> <a href="profilAdmEmp.html"> Employés </a></li>
                </menu>
            </nav>

            <section>
                <img src="/img/defaultPP.png" alt="user picture" class="userPic" id="userPic">
                <p> Prénom NOM </p>
                <p> Mail </p>
                <p> Adresse postale </p>
                <p> Post entreprise </p>
                <p> Téléphone </p>
                
                <div class="listePermis" id="listePermis"></div>

                <a href="#"> <i> Save </i> Enregistrer </a>
            </section>
        </main>
    </div>
</body>
</html>