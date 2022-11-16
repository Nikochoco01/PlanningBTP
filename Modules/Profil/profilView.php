<<<<<<< HEAD
<?php 
$prenom = $_POST["userFirstname"]; 
$nom = "chevalliot";
$position = "Administrateur";
$mail = "Test@gmail.com";
$phone = "051248030";
$postalAddress = "25 rue de large";
?>

<p> <?php echo $prenom . " " . $nom ?></p>
<p> <?php echo $position ?></p>
<p> <?php echo $mail ?></p>
<p> <?php echo $phone ?></p>
<p> <?php echo $postalAddress ?></p>

<a href="<?php echo displayType2("Modify") ?>"> Modifier </a>
=======
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
>>>>>>> Vacances
