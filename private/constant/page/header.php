<header class="header bg-color-orange">
    <h1 class="title-page"> <?= $title ?> </h1>

    <div class="profil-zone">
        <img tabindex="0" role="button" class="profil-image-button"src="/img/defaultPP.png" alt="user picture">
        <div class="profil-menu bg-color-gray text-color-orange">
            <p class="profil-informations font-bold"> 
                <span class="surName"> <?= InputSecurity::displayWithFormat($_SESSION['userFirstName'] , "uppercaseFirstLetter") ?> </span> 
                <span class="name"> <?= InputSecurity::displayWithFormat($_SESSION['userLastName'] , "uppercase") ?> </span> 
            </p>
            <p class="profil-type font-bold"> <?= InputSecurity::displayWithFormat($_SESSION['userPosition'] , "uppercase") ?> </p>

            <form action="logout" method="post" class="profil-logout-form">
                    <label for="profil-logout" class="label-btn-input label-btn-profil bg-color-orange text-color-gray"> <i class="icon-power-off margin-right-5"></i> Déconnexion </label>
                    <input type="submit" class="btn-input" id="profil-logout">
            </form>
        </div>
    </div>
</header>

