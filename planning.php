<?php session_start() ?>

<!DOCTYPE html>
<html lang="fr">

<!-- variables declaration -->
<?php
$title = 'Planning';
$today = date("j F Y");
$schedule = '8h00 - 17h30';


    // echo var_dump($_SERVER['QUERY_STRING']);
    // echo var_dump($_GET['display']);
    // echo var_dump($_SERVER['QUERY_STRING']);
include_once dirname(__FILE__)."/Modules/config.php";
include_once dirname(__FILE__)."/Modules/head.php";
?>

<body>
        <?php include_once "Modules/header.php" ?>
    <div class="layout">
        <?php include_once "Modules/aside.php" ?>
        <main class="planningMain">
            <?php include_once "Modules/tabs/selectTab.php"?>
            <div class="tabContent">
                <?php 
                    switch($_GET["onglet"]){
                        case "Missions":
                                switch($_GET["display"]){
                                    case "day":
                                        include_once "Modules/tabs/dayView.php";
                                    break;
                                    case "week":
                                        include_once "Modules/tabs/weekView.php";
                                    break;
                                    case "month":
                                        include_once "Modules/tabs/monthView.php";
                                    break;
                                }
                            break;
                        case "Employees":
                                switch($_GET["display"]){
                                    case "day":
                                        include_once "Modules/tabs/dayView.php";
                                    break;
                                    case "week":
                                        include_once "Modules/tabs/weekView.php";
                                    break;
                                    case "month":
                                        include_once "Modules/tabs/monthView.php";
                                    break;
                                }
                            break;
                        case "Vehicles":
                                switch($_GET["display"]){
                                    case "day":
                                        include_once "Modules/tabs/dayView.php";
                                    break;
                                    case "week":
                                        include_once "Modules/tabs/weekView.php";
                                    break;
                                    case "month":
                                        include_once "Modules/tabs/monthView.php";
                                    break;
                                }
                            break;
                        case "Material":
                                switch($_GET["display"]){
                                    case "day":
                                        include_once "Modules/tabs/dayView.php";
                                    break;
                                    case "week":
                                        include_once "Modules/tabs/weekView.php";
                                    break;
                                    case "month":
                                        include_once "Modules/tabs/monthView.php";
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