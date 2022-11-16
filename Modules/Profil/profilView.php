<div class="profilView">
    <img src=" <?php echo $_SESSION['userPic'] ?> " alt="photo de profil">
    <p>
        <span class="label"> <i class="icon-user"></i> Nom d'utilisateur :</span>
        <span class="userInfo">
            <?php echo $_SESSION['userName'] ?>
        </span>
    </p>
    <p>
        <span class="label"> Prénom :</span>
        <span class="userInfo"> 
            <?php echo $_SESSION['surName'] ?>
        </span>
    </p>
    <p>
        <span class="label"> Nom :</span>
        <span class="userInfo">
            <?php echo mb_strtoupper($_SESSION['name']) ?>
        </span>
    </p>
    <p>
        <span class="label"> <i class="icon-briefcase"></i> Fonction :</span>
        <span class="userInfo">
            <?php echo mb_strtoupper($_SESSION['position']) ?>
        </span>
    </p>
    <p>
        <span class="label"> <i class="icon-at"></i> Adresse mail :</span>
        <span class="userInfo">
            <?php echo $_SESSION['userMail'] ?>
        </span>
    </p>
    <p>
        <span class="label"> <i class="icon-phone"></i> Numéro de téléphone :</span>
        <span class="userInfo">
            <?php echo $_SESSION['userPhone'] ?>
        </span>
    </p>

    <a href="<?php echo addUrlParam(array('display' => 'Modify')) ?>"> <i class="icon-user-edit"></i> Modifier </a>
</div>