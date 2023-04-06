<!DOCTYPE html>
<html lang="fr">

<!-- variables declaration -->
<?php 
$title = TITLE_PAGE_HOME;

include_once APP . "private/constant/page/head.php";
?>

<body>
<div class="container">
        <?php include_once APP . "private/constant/page/header.php"; ?>
        <?php include_once APP . "private/constant/page/aside.php"; ?>
        <main class="container-main">
            <?php
                if($_SESSION['userFonction'] == 'administrator'){
                    include_once APP . "private/selectTab.php";
                }
            ?>
            <div class="main-content">

            <div class="profil-container bg-color-gray">
                <div class="profil-picture">
                    <div class="input-picture-container">
                        <img src="<?= $pictureWebsite->display($_SESSION['userId']) ?>" alt="photo de profil" class="input-picture-rendered">
                    </div>
                </div>

                <div class="profil-firstname input-container width-70">
                    <input type="text" name="userFirstName" id="userFirstName" class="input-field bg-color-light-gray" value="<?= InputSecurity::displayWithFormat($_SESSION['userFirstName'] , "uppercaseFirstLetter") ?>" readonly>
                    <label for="userFirstName" class="input-label font-bold text-color-white">Prénom</label>
                </div>

                <div class="profil-lastname input-container width-70">
                    <input type="text" name="userLastName" id="userLastName" class="input-field bg-color-light-gray" value="<?= InputSecurity::displayWithFormat($_SESSION['userLastName'] , "uppercase") ?>" readonly>
                    <label for="userLastName" class="input-label font-bold text-color-white">Nom</label>
                </div>
            </div>


            </div>
        </main>
</body>
</html>