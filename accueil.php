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
    <div class="layout"> 
        <?php include_once "Modules/aside.php" ?>
            <main>
                    <section class="homePage">
                        <h2> Bienvenue </h2>
                        <img src="<?php echo $_SESSION['userPic'] ?>" alt="image de votre profil">
                        <p><?php echo $_SESSION['surName'] ." ". mb_strtoupper($_SESSION['name']) ?> </p>
                        <div class="scheduleSummary">
                            <p><?php echo $_SESSION['dateToday'] ?> </p>
                            <p> Horaires : <?php echo $_SESSION['schedule'] ?> </p>
                        </div>
                    </section>
            </main>
    </div>
</body>
</html>