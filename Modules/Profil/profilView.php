<div class="profilView">
    <img src=" <?php echo $_SESSION['userPic'] ?> " alt="photo de profil">
    <p>
        <span class="label"> Nom d'utilisateur :</span>
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
            <?php echo strtoupper($_SESSION['name']) ?>
        </span>
    </p>
    <p>
        <span class="label"> Poste :</span>
        <span class="userInfo">
            <?php echo strtoupper($_SESSION['position']) ?>
        </span>
    </p>
    <p>
        <span class="label"> Adresse mail :</span>
        <span class="userInfo">
            <?php echo $_SESSION['userMail'] ?>
        </span>
    </p>
    <p>
        <span class="label"> Numéro de téléphone :</span>
        <span class="userInfo">
            <?php echo $_SESSION['userPhone'] ?>
        </span>
    </p>

    <a href="<?php echo addUrlParam(array('display' => 'Modify')) ?>"> Modifier </a>
</div>