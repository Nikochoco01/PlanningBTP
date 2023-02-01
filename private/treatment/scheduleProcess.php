<?php 
include_once dirname(__FILE__,2)."/dataBase/dataBaseConnection.php";
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

if (isset($_POST['startTime']) && isset($_POST['endTime'])) {
    if (preg_match('/[0-2][0-9]:[0-5][0-9]/', $_POST['startTime']) && preg_match('/[0-2][0-9]:[0-5][0-9]/', $_POST['endTime'])) {
       // echo "l'heure est valide" . "<br>";
        if ($_POST['startTime'] < $_POST['endTime']) {
            unset($_SESSION['error']);
            // echo "c'est tout bon" . "<br>";
            // echo date('W') . "<br>";
            $w = date("W");
            // echo date('m') . "<br>";
            $m = date("m");
            // echo date('Y') . "<br>";
            $y = date("Y");
            // echo $_POST['endTime'] . "<br>" . $_POST['startTime'] . "<br>";
            $diff = diff_time($_POST['endTime'], $_POST['startTime']);
            // echo $diff . " test 1" . "<br>";
            // $diff = date("h:i", strtotime($diff));
            // echo $diff . " test 2" . "<br>";
            $getId = $PDO->prepare("select userId from Login where loginUsername = :userName");
            $getId->bindParam("userName" , $_SESSION['userName']);
            $getId->execute();
            $getId = $getId->fetch();
            $getId = $getId->userId;

                $test = $PDO->prepare('select userId from WorkTime where userId = :id and workTimeDay = :d and workTimeWeek = :week and workTimeMonth = :m and workTimeYear = :Y');
                $test->bindParam('id', $getId);
                $test->bindParam("d" , $_POST['dayInput']);
                $test->bindParam("week" , $w);
                $test->bindParam('m', $m);
                $test->bindParam('Y', $y);
                $test->execute();
                $test = $test->fetch();
                // var_dump($test);
            if(!isset($test->userId)){
                // echo "j'insert";
                $sth = $PDO->prepare('INSERT INTO WorkTime(userId, workTimeDay, workTimeWeek, workTimeMonth, workTimeYear, workTimeTotalHours) VALUES (:id, :d, :week, :m, :Y, :diff)');
                $sth->bindParam('id', $getId);
                $sth->bindParam("d" , $_POST['dayInput']);
                $sth->bindParam("week" , $w);
                // $sth->bindParam('W', $w); // à voir pour éviter le problème d'une saisie par semaine
                $sth->bindParam('m', $m);
                $sth->bindParam('Y', $y);
                $sth->bindParam('diff', $diff);
                $sth->execute();
            }else{
                // echo "j'update";
                $up = $PDO->prepare('UPDATE WorkTime set workTimeTotalHours = :diff where userId = :id and workTimeDay = :d and workTimeWeek = :week and workTimeMonth = :m and workTimeYear = :Y');
                $up->bindParam('diff', $diff);
                $up->bindParam('id', $getId);
                $up->bindParam("d" , $_POST['dayInput']);
                $up->bindParam("week" , $w);
                $up->bindParam('m', $m);
                $up->bindParam('Y', $y);
                $up->execute();
            }
        } else {
            //echo "erreur input";
            $_SESSION['error'] = "erreur input";
        }
    
    // $dsn = 'mysql:host=iutbg-lamp.univ-lyon1.fr:3306;dbname=p2107521';
    // $user = 'p2107521';
    // $password = '12107521';
    // $conn = new PDO($dsn, $user, $password);
    // $sql = ("select sec_to_time(sum(time_to_sec(workTimeTotalHours))) as totalHours from WorkTime;");
    // //$sql = ("select workTimeTotalHours as totalHours from WorkTime;");
    // foreach ($conn->query($sql) as $row) {
    //     echo $row['totalHours'] . "<br>";
    //     if ($row['totalHours'] == null) {
    //         echo "<br>" . "= null";
    //     } else {
    //         $diff = date("H:i", strtotime($row['totalHours']));
    //     }
    // }
    
    // echo "<br>" . "c'est ici: " . $diff;
    }
    else {
       //echo "l'heure n'est pas valide" . "<br>";
       $_SESSION['error'] = "erreur input";
    }

    header('Location: ../../public/schedule.php');
    Exit();
}