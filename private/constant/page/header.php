<header>
    <h1> <?= $title ?> </h1>

    <div class="profilZone">
        <span id="profilButton" tabindex="0" role="button"> <img src="<?=Picture::display($dataBase, $_SESSION['userId'])?>" alt="user picture" class="userPic" id="userPic"> </span>
        <div class="profilMenu">
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

