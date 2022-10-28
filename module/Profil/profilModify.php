<?php $userName = "Niko" ?>

<form action="<?php echo displayType2("View") ?>" method="post">
    <img src="<?= $userPic ?>" alt="user picture" class="userPic" id="userPic">
    <!-- <input type="file" name="" id=""> -->
    <input type="text" name="userFirstname" id="userFirstname" value="<?= $userFirstname ?>">
    <input type="text" name="userSurname" id="userSurname" value="<?= $userSurname ?>">
    <input type="text" name="userName" id="userName" value="<?= $userPosition ?>">
    <input type="text" name="userName" id="userName" value="<?= $userMail ?>">
    <input type="text" name="userName" id="userName" value="<?= $userPostal ?>">
    <input type="text" name="userName" id="userName" value="<?= $userPhone ?>">

    <input type="submit" value="Enregistrer">
    <input type="button" value="Supprimer">
</form>