<form action="/profil.php" method="post">
    <!-- <input type="file" name="" id=""> -->
    <input type="text" name="surName" id="surName" value="<?php echo $_SESSION['surName'] ?>">
    <input type="text" name="name" id="name" value="<?php echo $_SESSION['name'] ?>">
    <input type="text" name="userPosition" id="userPosition" value="<?php echo $_SESSION['position'] ?>">
    <input type="text" name="userMAil" id="userMail" value="<?php echo $_SESSION['userMail'] ?>">
    <input type="text" name="userPhone" id="userPhone" value="<?php echo $_SESSION['userPhone'] ?>">

    <input type="submit" value="Enregistrer">
    <input type="button" value="Supprimer">
</form>