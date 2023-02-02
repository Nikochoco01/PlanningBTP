<?php
include_once APP . "private/dataBase/dataBaseConnection.php";
include_once APP . "private/class/month.php";
?>

<!DOCTYPE html>
<html lang="fr">

<!-- variables declaration -->
<?php 
$title = TITLE_PAGE_SCHEDULE;

include_once APP ."private/constant/page/head.php";
?>

<body>
    <div class="layout">
        <?php include_once APP . "private/constant/page/header.php"; ?>
        <?php include_once APP . "private/constant/page/aside.php"; ?>

        <main>
            <div class="scheduleContainer">

                <?php

                // $month = new Month($_GET['month'] ?? null, $_GET['year'] ?? null , $_GET['week'] ?? null);
                // var_dump($month);

                //     foreach($month->days as $dayNumber => $day):
                //     $date = $firstDay->modify("+".($dayNumber + $month->setupWeek($_GET['week'])). "day");
                //     endforeach;

                if(isset($_SESSION['error'])){
                    echo "<script> alert('".$_SESSION['error']."') </script>";
                }
                function affichage($totalHours){
                    //Heures au format (hh:mm:ss) la plus grande puis la plus petite

                    $tab = explode(":", $totalHours);

                    $h = $tab[0]; // récupère la partie heures endTime
                    $m = $tab[1]; // récupère la partie minutes endTime
                    if (strlen($h) == 1) { // si il s'agit d'un seul caractère on lui met un 0 devant (Ex: 09:00)
                        $h = "0" . $h;
                    }
                    if (strlen($m) == 1) {
                        $m = "0" . $m;
                    }
                    return $h . ":" . $m; // on affiche
                }
                // $statement = $PDO->prepare("select sec_to_time(sum(time_to_sec(workTimeTotalHours))) as totalHours from WorkTime;");
                // $schedule = $statement->fetchAll();

                $week = date('W');
                $getId = $PDO->prepare("select userId from Login where loginUsername = :userName");
                $getId->bindParam("userName" , $_SESSION['userName']);
                $getId->execute();
                $getId = $getId->fetch();
                $getId = $getId->userId;

                // temporaire 
                $sql  = "select sec_to_time(sum(time_to_sec(workTimeTotalHours))) as totalHours from WorkTime where userId = $getId and workTimeWeek = $week";
                foreach($PDO->query($sql) as $row){
                if($row->totalHours != null){
                        $diff = $row->totalHours;
                }
                }

                // var_dump($schedule);
                // $dsn = 'mysql:host=iutbg-lamp.univ-lyon1.fr:3306;dbname=p2107521';
                // $user = 'p2107521';
                // $password = '12107521';
                // $conn = new PDO($dsn, $user, $password);
                // $sql = ("select sec_to_time(sum(time_to_sec(workTimeTotalHours))) as totalHours from WorkTime;");
                // //$sql = ("select workTimeTotalHours as totalHours from WorkTime;");
                // foreach ($conn->query($sql) as $row) {
                //     //echo $row['totalHours'] . "<br>";
                //     if ($row['totalHours'] !== null) {
                //         //$diff = date("H:i", strtotime($row['totalHours']));
                //         $diff = $row['totalHours'];
                //         // var_dump($diff);
                //     }
                // }
                $horaire  = "select * from WorkTime where userId = $getId and workTimeWeek = $week order by workTimeDay ASC";
                ?>
                <div class="horaireContant">

                    <?php foreach($PDO->query($horaire) as $row):?>
                        <div class="horaire">
                                <p>Jour : <?= $row->workTimeDay ?>
                                Semaine : <?=$row->workTimeWeek ?>
                                Mois : <?= $row->workTimeMonth ?>
                                Heures de la journée : <?= $row->workTimeTotalHours ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
                <span class="separator"></span>
                <div class="recap">
                    <?php if (!isset($diff)) : ?>
                        <p>Les heures effectuées cette semaine: 0:00</p>
                    <?php else: ?>
                        <p>Les heures effectuées cette semaine: <?= affichage($diff); ?></p>
                    <?php endif; ?>
                </div>

                <form method="post">
                    <span>
                        <label for="dayInput"> Jour: </label>
                        <input type="number" name="dayInput" id="weekInput" max="31" min="1">
                    </span>
                    <span>
                        <label for="plate">Heure d'arrivée:</label>
                        <input type="time" name="startTime" id="plate">
                    </span>
                    <span>
                        <label for="type">Heure de départ:</label>
                        <input type="time" name="endTime" id="type">
                    </span>
                    <span class="zoneButton">
                        <input type="submit" id="submit" value="Valider">
                        <input type="reset" id="reset" value="Annuler">
                    </span>
                </form>
            </div>
        </main>
    </div>
</body>

</html>