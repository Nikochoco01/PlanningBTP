<header>
    <h1> <?= $title ?> </h1>

    <div class="profilZone">
        <img src="<?= $_SESSION['userPicture'] ?>" alt="user picture" class="userPic" id="userPic">
        <p class="userAccount" id="userAccount"> 
            <span class="surName"> <?= InputSecurity::displayWithFormat($_SESSION['userFirstName'] , "FirstName") ?> </span> 
            <span class="name"> <?= InputSecurity::displayWithFormat($_SESSION['userLastName'] , "LastName") ?> </span> 
        </p>
        <p class="typeAccount" id="typeAccount"> <?= InputSecurity::displayWithFormat($_SESSION['userPosition'] , "Position") ?> </p>
        
        <form action="<?= LINK_LOGOUT_PROCESS ?>" method="post">
                <label for="logOutButton" class="logOutButton"> <i class="icon-power-off"></i> <span> Déconnexion </span> </label>
                <input type="submit" value="Déconnexion" class="logOutButton" id="logOutButton">
        </form>
    </div>
</header>