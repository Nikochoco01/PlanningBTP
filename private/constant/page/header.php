<header class="header">
    <h1 class="title-page"> <?= $title ?> </h1>

    <div class="profil-zone">
        <img tabindex="0" role="button" class="profil-image-button" id="profil-image-button" src="/private/treatment/indexProcess/export.php?pictureId=<?= $_SESSION['userId']; ?>" alt="user picture">
        <div class="profil-menu">
            <p class="userAccount" id="userAccount"> 
                <span class="surName"> <?= InputSecurity::displayWithFormat($_SESSION['userFirstName'] , "uppercaseFirstLetter") ?> </span> 
                <span class="name"> <?= InputSecurity::displayWithFormat($_SESSION['userLastName'] , "uppercase") ?> </span> 
            </p>
            <p class="typeAccount" id="typeAccount"> <?= InputSecurity::displayWithFormat($_SESSION['userPosition'] , "uppercase") ?> </p>

            <form action="logout" method="post">
                    <label for="logOutButton" class="logOutButton"> <i class="icon-power-off"></i> <span> Déconnexion </span> </label>
                    <input type="submit" value="Déconnexion" class="logOutButton" id="logOutButton">
            </form>
        </div>
    </div>
</header>

