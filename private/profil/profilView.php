<div class="profilView">
    <img src="<?=Picture::display($dataBase, $_SESSION['userId'])?>" alt="User Picture">
    <p>
        <span class="label"> <i class="icon-user"></i> Nom d'utilisateur:</span>
        <span class="userInfo">
            <?= $_SESSION['userName'] ?>
        </span>
    </p>
    <p>
        <span class="label"> Prénom:</span>
        <span class="userInfo"> 
            <?= InputSecurity::displayWithFormat($_SESSION['userFirstName'] , "uppercaseFirstLetter") ?>
        </span>
    </p>
    <p>
        <span class="label"> Nom:</span>
        <span class="userInfo">
            <?= InputSecurity::displayWithFormat($_SESSION['userLastName'] , "uppercase") ?>
        </span>
    </p>
    <p>
        <span class="label"> <i class="icon-briefcase"></i> Fonction:</span>
        <span class="userInfo">
            <?= InputSecurity::displayWithFormat($_SESSION['userPosition'] , "uppercase") ?>
        </span>
    </p>
    <p>
        <span class="label"> <i class="icon-at"></i> Adresse mail:</span>
        <span class="userInfo">
            <?= $_SESSION['userMail'] ?>
        </span>
    </p>
    <p>
        <span class="label"> <i class="icon-phone"></i> Numéro de téléphone:</span>
        <span class="userInfo">
            <?= InputSecurity::displayWithFormat($_SESSION['userPhone'] , "PhoneNumber") ?>
        </span>
    </p>

    <a href="<?= URLManagement::addUrlParam(array('display' => PARAM_MODIFY_DISPLAY)) ?>"> <i class="icon-user-edit"></i> Modifier </a>
</div>