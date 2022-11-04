<?php session_start() ?>

<!DOCTYPE html>
<html lang="fr">

<!-- variables declaration -->
<?php
$titlePage = 'Planning';
$today = date("j F Y");
$schedule = '8h00 - 17h30';

include_once "Modules/config.php"
    // echo var_dump($_SERVER['QUERY_STRING']);
    // echo var_dump($_GET['display']);
    // echo var_dump($_SERVER['QUERY_STRING']);
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/CSS/default.css">
    <link rel="stylesheet" href="/CSS/menu.css">
    <link rel="stylesheet" href="/Icon/style.css">
    <title> <?php echo $titlePage ?> </title>
</head>

<body>
        <?php include_once "Modules/header.php" ?>
    <div class="layout">
        <?php include_once "Modules/aside.php" ?>
        <main class="planningMain">
            <nav class="navTab">
                <ul>
                    <li class="buttonTabs <?php echo activeTab("Missions") ?>"> 
                        <a href=" <?php echo addUrlParam(array('onglet'=>'Missions')) ?>">
                            <i class=""></i> Missions 
                        </a>
                    </li>
                    
                    <li class="buttonTabs <?php echo activeTab("Employes") ?>"> 
                        <a href=" <?php echo addUrlParam(array('onglet'=>'Employes')) ?>">
                            <i class=""></i> Employés 
                        </a>
                    </li>

                    <li class="buttonTabs <?php echo activeTab("Vehicules") ?>"> 
                        <a href=" <?php echo addUrlParam(array('onglet'=>'Vehicules')) ?>">
                            <i class=""></i> Véhicules 
                        </a>
                    </li>
                    
                    <li class="buttonTabs <?php echo activeTab("Material") ?>"> 
                        <a href=" <?php echo addUrlParam(array('onglet'=>'Material')) ?>">
                            <i class=""></i> Matériel 
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
                                        include_once "Modules/tabs/day.php";
                                    break;
                                    case "week":
                                        include_once "Modules/tabs/week.php";
                                    break;
                                    case "month":
                                        include_once "Modules/tabs/month.php";
                                    break;
                                }
                            break;
                        case "Employes":
                                switch($_GET["display"]){
                                    case "day":
                                        include_once "Modules/tabs/day.php";
                                    break;
                                    case "week":
                                        include_once "Modules/tabs/week.php";
                                    break;
                                    case "month":
                                        include_once "Modules/tabs/month.php";
                                    break;
                                }
                            break;
                        case "Vehicules":
                                switch($_GET["display"]){
                                    case "day":
                                        include_once "Modules/tabs/day.php";
                                    break;
                                    case "week":
                                        include_once "Modules/tabs/week.php";
                                    break;
                                    case "month":
                                        include_once "Modules/tabs/month.php";
                                    break;
                                }
                            break;
                        case "Materiel":
                                switch($_GET["display"]){
                                    case "day":
                                        include_once "Modules/tabs/day.php";
                                    break;
                                    case "week":
                                        include_once "Modules/tabs/week.php";
                                    break;
                                    case "month":
                                        include_once "Modules/tabs/month.php";
                                    break;
                                }
                            break;
                    }
                ?>
            </div>
        </main>
    </div>

    <script src="/JS/dayClass.js"></script>
    <script src="/JS/missionClass.js"></script>
    <script src="/JS/employeeClass.js"></script>
    <script src="/JS/materialClass.js"></script>
    <!-- <script src="/JS/creationJour.js"></script> -->
</body>
</html>