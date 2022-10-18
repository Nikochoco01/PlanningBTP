<?php $titre = "Véhicule";
include_once "module/head.php";?>

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