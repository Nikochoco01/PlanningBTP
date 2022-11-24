<?php session_start() ?>
<!DOCTYPE html>
<html lang="fr">
<?php 
    $title = "Matériel"; 
    include_once dirname(__FILE__)."/Modules/head.php";
?>

<body>
    <?php include_once dirname(__FILE__)."/Modules/header.php"; ?>

    <div class="layout">
        <?php include_once dirname(__FILE__)."/Modules/aside.php"; ?>

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