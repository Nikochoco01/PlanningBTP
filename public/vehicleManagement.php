<!DOCTYPE html>
<html lang="fr">

<?php 
    $title = TITLE_PAGE_VEHICLE;
    $rightToModify = ($_SESSION['userFonction'] == 'administrator' || $_SESSION['userFonction'] == 'vehicleManager');
    $_SESSION['token'] = InputSecurity::generateToken(10);
    include_once APP . "private/constant/page/head.php";
?>

<body>
    <div class="container">
        <?php include_once APP . "private/constant/page/header.php"; ?>
        <?php include_once APP . "private/constant/page/aside.php"; ?>
        <main class="container-main">
            <div class="main-content">
                <?php 
                    switch ($_GET["onglet"]) {
                        case PARAM_VEHICLES_ONGLET:
                            switch($_GET["display"]){
                                case PARAM_VIEW_DISPLAY:
                                    include_once APP . "private/vehicle/vehicleView.php";
                                break;
                                case PARAM_MODIFY_DISPLAY:
                                    include_once APP . "private/vehicle/vehicleModify.php";
                                break;
                                case PARAM_ADD_DISPLAY:
                                    include_once APP . "private/vehicle/vehicleAdd.php";
                                break;
                            }
                        break;
                    }
                ?>
            </div>
        </main>
    </div>
</body>
<script src="/js/vehicle.js"></script>
</html>