<!DOCTYPE html>
<html lang="fr">

<!-- variables declaration -->
<?php

    $title = TITLE_PAGE_PLANNING;
    include_once APP . "private/constant/page/head.php";
?>

<body>
    <div class="container">
        <?php include_once APP . "private/constant/page/header.php" ?>
        <?php include_once APP . "private/constant/page/aside.php" ?>
        <main class="container-main">
            <?php
                if($_SESSION['userFonction'] == 'administrator'){
                    include_once APP . "private/selectTab.php";
                }
            ?>
            <div class="main-content">
                <?php
                    $dayView = APP . "private/planning/dayView.php";
                    $weekView = APP . "private/planning/weekView.php";
                    $monthView = APP . "private/planning/monthView.php";
                    $eventView = APP . "private/planning/showEvent.php";
                    $eventAdd = APP . "private/planning/addEventView.php";


                    switch($_GET["onglet"]){
                        case PARAM_MISSION_ONGLET:
                                switch($_GET["display"]){
                                    case PARAM_DAY_DISPLAY:
                                        include_once $dayView;
                                    break;
                                    case PARAM_WEEK_DISPLAY:
                                        include_once $weekView;
                                    break;
                                    case PARAM_MONTH_DISPLAY:
                                        include_once $monthView;
                                    break;
                                    case PARAM_VIEW_DISPLAY:
                                        include_once $eventView;
                                    break;
                                    case PARAM_ADD_DISPLAY:
                                        include_once $eventAdd;
                                    break;
                                }
                            break;
                        case PARAM_EMPLOYEE_ONGLET:
                                switch($_GET["display"]){
                                    case PARAM_DAY_DISPLAY:
                                        include_once $dayView;
                                    break;
                                    case PARAM_WEEK_DISPLAY:
                                        include_once $weekView;
                                    break;
                                    case PARAM_MONTH_DISPLAY:
                                        include_once $monthView;
                                    break;
                                    case PARAM_VIEW_DISPLAY:
                                        include_once $eventView;
                                    break;
                                    case PARAM_ADD_DISPLAY:
                                        include_once $eventAdd;
                                    break;
                                }
                            break;
                        case PARAM_VEHICLES_ONGLET:
                                switch($_GET["display"]){
                                    case PARAM_DAY_DISPLAY:
                                        include_once $dayView;
                                    break;
                                    case PARAM_WEEK_DISPLAY:
                                        include_once $weekView;
                                    break;
                                    case PARAM_MONTH_DISPLAY:
                                        include_once $monthView;
                                    break;
                                    case PARAM_VIEW_DISPLAY:
                                        include_once $eventView;
                                    break;
                                    case PARAM_ADD_DISPLAY:
                                        include_once $eventAdd;
                                    break;
                                }
                            break;
                        case PARAM_MATERIAL_ONGLET:
                                switch($_GET["display"]){
                                    case PARAM_DAY_DISPLAY:
                                        include_once $dayView;
                                    break;
                                    case PARAM_WEEK_DISPLAY:
                                        include_once $weekView;
                                    break;
                                    case PARAM_MONTH_DISPLAY:
                                        include_once $monthView;
                                    break;
                                    case PARAM_VIEW_DISPLAY:
                                        include_once $eventView;
                                    break;
                                    case PARAM_ADD_DISPLAY:
                                        include_once $eventAdd;
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