<?php include_once "Modules/config.php";
    session_start();
?>
<!DOCTYPE html>
<html lang="fr">

<?php 
    $title = "Profil"; 
    include_once dirname(__FILE__)."/Modules/head.php";
?>

<body>
    <?php include_once "Modules/header.php"; ?>

    <div class="layout">
        <?php include_once 'Modules/aside.php'; ?>
        <main>
            <?php
                if($_SESSION['userFonction'] == 'administrator'){
                    include_once "Modules/tabs/selectTab.php";
                }
            ?>
            <div class="profilContent">
                <?php 
                    switch ($_GET["onglet"]) {
                        case "Personal":
                            switch($_GET["display"]){
                                case "View":
                                    include "Modules/Profil/profilView.php";
                                break;
                                case "Modify":
                                    include "Modules/Profil/profilModify.php";
                            break;
                            }
                        break;
                        case "Employees":
                            switch($_GET["display"]){
                                case "View":
                                    include "Modules/Profil/profilViewAdmin.php";
                                break;
                                case "Modify":
                                    include "Modules/Profil/profilModify.php";
                                break;
                            }
                        break;
                    }
                ?>
            </div>
        </main>
    </div>
</body>

</html>