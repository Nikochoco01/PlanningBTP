<!DOCTYPE html>
<html lang="fr">

<?php 
    $title = TITLE_PAGE_PROFIL;
    include_once APP . "private/constant/page/head.php";
?>

<body>
    <div class="container">
        <?php include_once APP . "private/constant/page/header.php"; ?>
        <?php include_once APP . "private/constant/page/aside.php"; ?>
        <main class="container-main">
            <?php
                if($_SESSION['userFonction'] == 'administrator'){
                    include_once APP . "private/selectTab.php";
                }
            ?>
            <div class="main-content">
                <?php 
                    switch ($_GET["onglet"]) {
                        case PARAM_PERSONAL_ONGLET:
                            switch($_GET["display"]){
                                case PARAM_VIEW_DISPLAY:
                                    include_once APP . "private/profil/profilView.php";
                                break;
                                case PARAM_MODIFY_DISPLAY:
                                    include_once APP . "private/profil/profilModify.php";
                            break;
                            }
                        break;
                        case PARAM_EMPLOYEE_ONGLET:
                            switch($_GET["display"]){
                                case PARAM_VIEW_DISPLAY:
                                    include_once APP . "private/profil/profilViewAdmin.php";
                                break;
                                case PARAM_MODIFY_DISPLAY:
                                    include_once APP . "private/profil/modifyEmployee.php";
                                break;
                                case PARAM_ADD_DISPLAY:
                                    include_once APP . "private/profil/addEmployee.php";
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