<div class="profil-container bg-color-gray">
    BUG MODIFICATION PROFIL EMPLOYEE ON ACCEDE AU TABLEAU ADMINISTRATEUR
    <div class="profil-picture">
        <div class="input-picture-container">
            <img src="<?= Picture::display($dataBase , $_SESSION['userId']) ?>" alt="photo de profil" class="input-picture-rendered">
        </div>
    </div>

    <div class="profil-user-name input-container width-70">
        <input type="text" name="userName" id="userName" value="<?= $_SESSION['userName'] ?>" class="input-field bg-color-light-gray" readonly>
        <label for="userName" class="input-label font-bold text-color-white"> <i class="icon-user"></i> Nom d'utilisateur</label>
    </div>

    <div class="profil-firstname input-container width-70">
        <input type="text" name="userFirstName" id="userFirstName" class="input-field bg-color-light-gray" value="<?= InputSecurity::displayWithFormat($_SESSION['userFirstName'] , "uppercaseFirstLetter") ?>" readonly>
        <label for="userFirstName" class="input-label font-bold text-color-white">Prénom</label>
    </div>

    <div class="profil-lastname input-container width-70">
        <input type="text" name="userLastName" id="userLastName" class="input-field bg-color-light-gray" value="<?= InputSecurity::displayWithFormat($_SESSION['userLastName'] , "uppercase") ?>" readonly>
        <label for="userLastName" class="input-label font-bold text-color-white">Nom</label>
    </div>

    <div class="profil-fonction input-container width-70">
        <input type="text" name="userPosition" id="userPosition" class="input-field bg-color-light-gray" value="<?= InputSecurity::displayWithFormat($_SESSION['userPosition'] , "uppercase") ?>" readonly>
        <label for="userPosition" class="input-label font-bold text-color-white"> <i class="icon-briefcase"></i> Fonction</label>
    </div>

    <div class="profil-mail-address input-container width-70">
        <input type="text" name="userMail" id="userMail" class="input-field bg-color-light-gray" value="<?= $_SESSION['userMail'] ?>" readonly>
        <label for="userMail" class="input-label font-bold text-color-white"> <i class="icon-at"></i> Adresse mail</label>
    </div>

    <div class="profil-phone-number input-container width-70">
        <input type="text" name="userPhone" id="userPhone" class="input-field bg-color-light-gray" value="<?= InputSecurity::displayWithFormat($_SESSION['userPhone'] , "PhoneNumber") ?>" readonly>
        <label for="userPhone" class="input-label font-bold text-color-white"> <i class="icon-phone"></i> Numéro de téléphone</label>
    </div>

    <div class="profil-btn-zone">
        <a class="btn-link width-50 height-50 border-rad-10 bg-color-orange text-color-white" href="<?= URLManagement::addUrlParam(array('display' => PARAM_MODIFY_DISPLAY)) ?>"> <i class="icon-user-edit"></i> Modifier </a>
    </div>
    
</div>