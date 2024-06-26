<?php
function diff_time($t1, $t2)
{
    //Heures au format (hh:mm:ss) la plus grande puis la plus petite 

    $tab = explode(":", $t1);
    $tab2 = explode(":", $t2);

    $h = $tab[0]; // récupère la partie heures endTime
    $m = $tab[1]; // récupère la partie minutes endTime
    $h2 = $tab2[0]; // récupère la partie heures startTime
    $m2 = $tab2[1]; // récupère la partie minutes startTime

    if ($h2 > $h) { // vérifie si startTime est supérieure et met à jour les valeurs si c'est le cas afin de ne pas avoir une valeur négative
        $h = $h + 24;
    }
    if ($m2 > $m) {
        $m = $m + 60;
        $h2++;
    }
    $ht = $h - $h2; // on fait la différence entre les deux
    $mt = $m - $m2;
    if (strlen($ht) == 1) { // si il s'agit d'un seul caractère on lui met un 0 devant (Ex: 09:00)
        $ht = "0" . $ht;
    }
    if (strlen($mt) == 1) {
        $mt = "0" . $mt;
    }
    return $ht . ":" . $mt; // on affiche
}

// echo diff_time('05:00:00', '06:00:00') . "<br>";

if (isset($_POST['startTime']) && isset($_POST['endTime']) && $_POST['dayInput'] != "" && $_POST['startTime'] != "" && $_POST['endTime'] != "" && $_POST['dayInput'] < 32 && $_POST['dayInput'] > 0) {
    if (preg_match('/[0-2][0-9]:[0-5][0-9]/', $_POST['startTime']) && preg_match('/[0-2][0-9]:[0-5][0-9]/', $_POST['endTime'])) {
        // echo "l'heure est valide" . "<br>";
        if ($_POST['startTime'] < $_POST['endTime']) {
            unset($_SESSION['error']);
            // echo "c'est tout bon" . "<br>";
            // echo date('W') . "<br>";
            $week = date("W");
            // echo date('m') . "<br>";
            $month = date("m");
            // echo date('Y') . "<br>";
            $year = date("Y");
            // echo $_POST['endTime'] . "<br>" . $_POST['startTime'] . "<br>";
            $diff = diff_time($_POST['endTime'], $_POST['startTime']);
            
            $test = $dataBase->read("WorkTime",[
                "conditions" => ["userId" => $_SESSION["userId"] , "workTimeDay" => $_POST['dayInput'] , 
                                "workTimeWeek" => $week , "workTimeMonth" => $month , "workTimeYear" => $year ],
                "fields" => ["userId"]
            ]);

            var_dump($test);
            if (!isset($test->userId)) {
                $dataBase->save("WorkTime",[
                    "userId" => $_SESSION['userId'],
                    "workTimeDay" => $_POST['dayInput'],
                    "workTimeWeek" => $week,
                    "workTimeMonth" => $month,
                    "workTimeYear" => $year,
                    "workTimeTotalHours" => $diff
                ], $_SESSION['userId']);
            } else {
                // echo "j'update";
                $dataBase->save("WorkTime",[
                    "userId" => $_SESSION['userId'],
                    "workTimeDay" => $_POST['dayInput'],
                    "workTimeWeek" => $week,
                    "workTimeMonth" => $month,
                    "workTimeYear" => $year,
                    "workTimeTotalHours" => $diff
                ], $_SESSION['userId']);
            }
        } else {
            // echo "erreur input";
            $_SESSION['error'] = "erreur input";
        }
    } else {
        // echo "erreur input";
        $_SESSION['error'] = "erreur input";
    }

    header('Location:/schedule');
    exit();
} else {
    $_SESSION['error'] = "erreur input";
    header('Location:/schedule');
    exit();
}
