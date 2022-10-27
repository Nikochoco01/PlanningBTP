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

/** function that add the active class to the buttons */
function activeTab($tab){
    if($_GET['onglet'] == $tab){
        return "activeTab";
    }
}

/** Function to switch between day week month view on the calendar */
function displayType(){
    if($_GET['display'] == 'week'){
        return addUrlParam(array('display'=> 'month'));
    }
    else if ($_GET['display'] == 'month'){
        return addUrlParam(array('display'=> 'day'));
    }
    else{
        return addUrlParam(array('display'=> 'week'));
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
                            include_once "Modules/tabs/employee.php";
                            echo "Booh";
                                // switch($_GET["display"]){
                                //     case "day":
                                //         echo "Booh";
                                //     break;
                                // }
                            
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