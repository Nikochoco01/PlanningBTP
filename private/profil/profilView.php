<div class="profilView">
    <img src=" <?= $_SESSION['userPicture'] ?> " alt="photo de profil">
    <p>
        <span class="label"> <i class="icon-user"></i> Nom d'utilisateur :</span>
        <span class="userInfo">
            <?= $_SESSION['userName'] ?>
        </span>
    </p>
    <p>
        <span class="userInfo"> 
            <?= InputSecurity::displayWithFormat($_SESSION['userFirstName'] , "FirstName") ?>
        </span>
    </p>
    <p>
        <span class="userInfo">
            <?= InputSecurity::displayWithFormat($_SESSION['userLastName'] , "LastName") ?>
        </span>
    </p>
    <p>
        <span class="label"> <i class="icon-briefcase"> Poste:</i></span>
        <span class="userInfo">
            <?= InputSecurity::displayWithFormat($_SESSION['userPosition'] , "Position") ?>
        </span>
    </p>
    <p>
        <span class="label"> <i class="icon-at"></i></span>
        <span class="userInfo">
            <?= $_SESSION['userMail'] ?>
        </span>
    </p>
    <p>
        <span class="label"> <i class="icon-phone"></i></span>
        <span class="userInfo">
            <?= InputSecurity::displayWithFormat($_SESSION['userPhone'] , "PhoneNumber") ?>
        </span>
    </p>

    <a href="<?= URLManagement::addUrlParam(array('display' => PARAM_MODIFY_DISPLAY)) ?>"> <i class="icon-user-edit"></i> Modifier </a>
</div>