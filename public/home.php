<?php 
    include_once dirname(__FILE__,2). "/private/class/InputSecurityClass.php";
    include_once dirname(__FILE__,2). "/private/constant/constant.php";
    session_start();
?>

<!DOCTYPE html>
<html lang="fr">

<!-- variables declaration -->
<?php 
$title = TITLE_PAGE_HOME;

include_once dirname(__FILE__,2)."/private/constant/page/head.php";
?>

<body>
    <?php include_once dirname(__FILE__,2). "/private/constant/page/header.php" ?>
    <div class="layout"> 
        <?php include_once dirname(__FILE__,2). "/private/constant/page/aside.php" ?>
            <main>
                    <section class="homePage">
                        <h2> Bienvenue </h2>
                        <img src="<?= $_SESSION['userPicture'] ?>" alt="image de votre profil">
                        <p><?= InputSecurity::displayWithFormat($_SESSION['userFirstName'] , "FirstName") ." ". 
                               InputSecurity::displayWithFormat($_SESSION['userLastName'] , "LastName") ?> </p>
                        <div class="scheduleSummary">
                            <p><?= $_SESSION['dateToday'] ?> </p>
                            <p> Horaires : <?= $_SESSION['schedule'] ?> </p>
                        </div>
                    </section>
            </main>
    </div>
</body>
</html>