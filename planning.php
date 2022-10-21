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
                <div class="tabs">
                    <span data-tab-value="#tab_1" class="buttonPlanning"> Employés </span>
                    <span data-tab-value="#tab_2" class="buttonPlanning"> Chantier </span>
                    <span data-tab-value="#tab_3" class="buttonPlanning"> Véhicules </span>
                    <span data-tab-value="#tab_4" class="buttonPlanning"> Matériel </span>

                    <span data-tab-value="#tab_5" class="changeTypePlanning" id="changeTypePlanning" > <i class="icon-home"></i> </span>
                </div>

                    <div class="tabs__tab active" id="tab_1" data-tab-info>
                        <h2>Planning Employés</h2>

                        <div class="tabContent" id="dayView">
                            <a href="#" id="addDay" > ajout jour </a>

                            <div class="planningContent">
                                <div class="day" id="day1">
                                    <p> Lundi </p>

                                </div>
                            </div>

                        </div>

                        <div class="tabContent" id="weekView">

                        </div>

                        <div class="tabContent" id="monthView">

                        </div>

                    </div>

                    <div class="tabs__tab" id="tab_2" data-tab-info>

                        <p> test 2 </p>
              
                    </div>

                    <div class="tabs__tab" id="tab_3" data-tab-info>

                        <p> TEST 3 .</p>
              
                    </div>

                    <div class="tabs__tab" id="tab_4" data-tab-info>

                        <p> TEST 4 .</p>
              
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