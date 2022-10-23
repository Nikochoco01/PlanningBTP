<!DOCTYPE html>
<html lang="fr">

<!-- variables declaration -->
<?php 
$userName = 'Nikola CHEVALLIOT';

$surName = 'Nikola';
$name = 'chevalliot';
$position = 'administrateur'; // position in the companie

$titlePage = 'Planning';
$today = date("j F Y");
$schedule = '8h00 - 17h30';

/** Function for add a parameter to the URL */
function addUrlParam($params=array()){
	$p = array_merge($_GET, $params);
	$qs = http_build_query($p);
	return basename($_SERVER['PHP_SELF']).'?'.$qs;
}

/** Function for generate the tabs menu in this page */
function modifNav($tab , $icon , $buttonName , $url){
    if($_GET['onglet'] == $tab){
        echo '<li class="buttonTabs activeTabs">';
    }
    else{
        echo '<li class="buttonTabs" >';
    }
        echo '<a href="'. $url .'" > <i class="'. $icon . '"></i>'. $buttonName .'</a> </li>';
}

/** Function to switch between day week month view on the calendar */
function displayType(){
    if($_GET['display'] == 'week'){
        echo addUrlParam(array('display'=> 'month'));
    }
    else if ($_GET['display'] == 'month'){
        echo addUrlParam(array('display'=> 'day'));
    }
    else{
        echo addUrlParam(array('display'=> 'week'));
    }
}
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
    <?php echo  "<title>" . $titlePage . "</title>" ?>
</head>

<body>
        <?php include_once "Modules/header.php" ?>
        <?php include_once "Modules/aside.php" ?>

        <main class="planningMain">
            <nav>
                <ul>
                    <?php
                        modifNav('Mission' , '' , 'Mission' , addUrlParam(array('onglet'=>'Mission')));
                        modifNav('Employes' , '' , 'Employés' , addUrlParam(array('onglet'=>'Employes')));
                        modifNav('Vehicules' , '' , 'Véhicules' , addUrlParam(array('onglet'=>'Vehicules')));
                        modifNav('Materiel' , '' , 'Matériel' , addUrlParam(array('onglet'=>'Materiel')));
                    ?>
                    <li class="buttonChangeView"> <a href=" <?php displayType(); ?>" class="" id="buttonChangeView"> <i class="icon-home"></i></a> </li>
                </ul>
            </nav>

            <div class="tabContent">
                <?php 
                    switch($_GET["onglet"]){
                        case "Mission":
                            include_once "Modules/tabs/mission.php";
                            break;
                        case "Employes":
                            include_once "Modules/tabs/employee.php";
                            break;
                        case "Vehicules":
                            include_once "Modules/tabs/vehicles.php";
                            break;
                        case "Materiel":
                            include_once "Modules/tabs/material.php";
                            break;
                    }
                
                ?>
            </div>
        </main>
    </div>

    <script src="/JS/tabsGestion.js"></script>
    <script src="/JS/dayClass.js"></script>
    <script src="/JS/missionClass.js"></script>
    <script src="/JS/employeeClass.js"></script>
    <script src="/JS/materialClass.js"></script>
    <!-- <script src="/JS/creationJour.js"></script> -->
</body>
</html>