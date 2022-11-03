<?php session_start();?>

<!DOCTYPE html>
<html lang="fr">

<!-- variables declaration -->
<?php 
$titlePage = "Accueil";
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
    <?php include_once "Modules/aside.php" ?>
        <main class="indexMain">
                <h2> Bienvenue </h2>
                <p><?php echo $_SESSION['surName'] ." ". $_SESSION['name'] ?> </p>
                <p><?php echo $_SESSION['dateToday'] ?> </p>
                <p><?php echo $_SESSION['schedule'] ?> </p>
        </main>
    </div>
</body>
</html>