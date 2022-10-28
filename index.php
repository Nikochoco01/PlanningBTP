<!DOCTYPE html>
<html lang="fr">

<!-- variables declaration -->
<?php 
$userName = 'Nikola CHEVALLIOT';

$surName = 'Nikola';
$name = 'chevalliot';
$position = 'administrateur'; // position in the companie

$titlePage = "Accueil";
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
        <main class="indexMain">
                <h2> Bienvenue </h2>
                <?php echo '<p>' . $userName . '</p>' ?>
                <?php echo '<p>'. $today .'</p>' ?>
                <?php echo '<p>'. $schedule .'</p>' ?>
        </main>
    </div>
</body>
</html>