<?php session_start();?>

<!DOCTYPE html>
<html lang="fr">

<!-- variables declaration -->
<?php 
$title = "Accueil";

include_once dirname(__FILE__)."/Modules/head.php";
?>

<body>
    <?php include_once "Modules/header.php" ?>
    <div class="layout"> 
        <?php include_once "Modules/aside.php" ?>
            <main>
                    <section class="homePage">
                        <h2> Bienvenue </h2>
                        <img src="<?php echo $_SESSION['userPicture'] ?>" alt="image de votre profil">
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