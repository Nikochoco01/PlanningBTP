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
            <nav class="navTab">
                <ul>
                    <li class="buttonTabs <?php echo activeTab("Missions") ?>"> 
                        <a href=" <?php echo addUrlParam(array('onglet'=>'Missions')) ?>">
                            <i class="icon-clipboard-list"></i> Missions 
                        </a>
                    </li>
                    
                    <li class="buttonTabs <?php echo activeTab("Employes") ?>"> 
                        <a href=" <?php echo addUrlParam(array('onglet'=>'Employes')) ?>">
                            <i class="icon-users-group"></i> Employés 
                        </a>
                    </li>

                    <li class="buttonTabs <?php echo activeTab("Vehicules") ?>"> 
                        <a href=" <?php echo addUrlParam(array('onglet'=>'Vehicules')) ?>">
                            <i class="icon-warehouse"></i> Véhicules 
                        </a>
                    </li>
                    
                    <li class="buttonTabs <?php echo activeTab("Material") ?>"> 
                        <a href=" <?php echo addUrlParam(array('onglet'=>'Material')) ?>">
                            <i class="icon-tool"></i> Matériel 
                        </a>
                    </li>

                    <li class="buttonChangeView"> <a href=" <?php echo displayType(); ?>" class="" id="buttonChangeView"> <i class="icon-home"></i></a> </li>
                </ul>
            </nav>

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
                        case "Employes":
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
                        case "Vehicules":
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