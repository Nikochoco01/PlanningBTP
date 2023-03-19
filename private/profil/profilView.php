<div class="profil-view-container">
    <div class="profil-view-picture">
        <img class="profil-picture" src="/img/defaultPP.png" alt="photo de profil">
    </div>
    <div class="profil-view-user-name">
        <span class="label"> <i class="icon-user"></i> Nom d'utilisateur</span>
        <span class="user-info">
            <?= $_SESSION['userName'] ?>
        </span>
    </div>
    <div class="profil-view-firstname">
        <span class="label"> Prénom</span>
        <span class="user-info"> 
            <?= InputSecurity::displayWithFormat($_SESSION['userFirstName'] , "uppercaseFirstLetter") ?>
        </span>
    </div>
    <div class="profil-view-lastname">
        <span class="label"> Nom</span>
        <span class="user-info">
            <?= InputSecurity::displayWithFormat($_SESSION['userLastName'] , "uppercase") ?>
        </span>
    </div>
    <div class="profil-view-fonction">
        <span class="label"> <i class="icon-briefcase"></i> Fonction</span>
        <span class="user-info">
            <?= InputSecurity::displayWithFormat($_SESSION['userPosition'] , "uppercase") ?>
        </span>
    </div>
    <div class="profil-view-mail-address">
        <span class="label"> <i class="icon-at"></i> Adresse mail</span>
        <span class="user-info">
            <?= $_SESSION['userMail'] ?>
        </span>
    </div>
    <div class="profil-view-phone-number">
        <span class="label"> <i class="icon-phone"></i> Numéro de téléphone</span>
        <span class="user-info">
            <?= InputSecurity::displayWithFormat($_SESSION['userPhone'] , "PhoneNumber") ?>
        </span>
    </div>

    <div class="profil-view-btn-zone">
        <a class="btn-link width-50 height-50 border-rad-10 bg-color-orange text-color-white" href="<?= URLManagement::addUrlParam(array('display' => PARAM_MODIFY_DISPLAY)) ?>"> <i class="icon-user-edit"></i> Modifier </a>
    </div>
    
</div>