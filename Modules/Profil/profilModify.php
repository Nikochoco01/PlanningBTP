<form action="/Modules/Profil/modifyProcess.php" method="post" class="profilModify">

    <label for="userPicture" class="userPicture">
        <div class="iconAddPicture">
            <i class="icon-image-plus"></i>
        </div>
        <img src="<?php echo $_SESSION['userPic'] ?>" alt="user Picture">
        <input type="file" name="userPicture" id="userPicture">
    </label>

    <label class="Disabled"> <span>Nom d'utilisateur : </span>
        <input type="text" name="userName" id="userName" value="<?php echo $_SESSION['userName'] ?>" class="Disabled" disabled>
    </label>
    <label for="userPassWord"> <span>Mot de passe :</span>
        <input type="password" name="userPassWord" id="userPassWord" value="" placeholder="taper un nouveau mot de passe">
    </label>
    <label for="surName"> <span>Prénom :</span>
        <input type="text" name="surName" id="surName" value="<?php echo $_SESSION['surName'] ?>">
    </label>
    <label for="name"> <span>Nom :</span>
        <input type="text" name="name" id="name" value="<?php echo $_SESSION['name'] ?>">
    </label>
    <label for="userPosition" class=" <?php echo addDisabled() ?>"> <span>Poste :</span>
        <input type="text" name="userPosition" id="userPosition" value="<?php echo $_SESSION['position'] ?>" <?php echo disableInput()?> class="<?php echo addDisabled() ?>">
    </label>
    <label for="userMail"> <span>Adresse mail :</span>
        <input type="text" name="userMAil" id="userMail" value="<?php echo $_SESSION['userMail'] ?>">
    </label>
    <label for="userPhone"> <span>Numéro de téléphone :</span>
        <input type="text" name="userPhone" id="userPhone" value="<?php echo $_SESSION['userPhone'] ?>">
    </label>
    <span>
        <input type="submit" value="Enregistrer">
        <a href="<?php echo addUrlParam(array('display' => 'View')) ?>"> Annuler </a>
    </span>
</form>
