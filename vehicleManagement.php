<?php session_start()?>
<!DOCTYPE html>
<html lang="fr">
<?php 
    $title = "Véhicule"; 
    include_once dirname(__FILE__)."/Modules/head.php";
?>

<body>
    <?php include_once dirname(__FILE__)."/Modules/header.php"; ?>

    <div class="layout">
        <?php include_once dirname(__FILE__)."/Modules/aside.php";?>

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