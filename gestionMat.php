<!DOCTYPE html>
<html lang="fr">
<?php $titre = "Matériel";
include_once "module/head.php"; ?>

<body>
    <?php include_once "module/header.php"; ?>

    <div class="layout">
        <?php include_once "module/aside.php"; ?>

        <main>

            <a href="#"> <i> Add Matériel</i> <span> Ajout Matériel </span> </a>
            <div>
                <i class="icon-search"></i>
                <input type="search" name="material" id="material">
            </div>
                
            <div class="listeMateriel" id="listeMateriel"></div>

        </main>
    </div>
</body>
</html>