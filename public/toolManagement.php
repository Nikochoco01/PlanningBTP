<!DOCTYPE html>
<html lang="fr">

<?php 
    $title = TITLE_PAGE_MATERIAL;
    $rightToModify = $_SESSION['userFonction'] == 'administrator' || $_SESSION['userFonction'] == 'materialManager';
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
                        case PARAM_MATERIAL_ONGLET:
                            switch($_GET["display"]){
                                case PARAM_VIEW_DISPLAY:
                                    include_once APP . "private/material/materialView.php";
                                break;
                                case PARAM_MODIFY_DISPLAY:
                                    include_once APP . "private/material/materialModify.php";
                                break;
                                case PARAM_ADD_DISPLAY:
                                    include_once APP . "private/material/materialAdd.php";
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