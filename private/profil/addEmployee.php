<form action="addEmployee" method="post" class="profil-container bg-color-gray" enctype="multipart/form-data">
    <a href="<?= returnURL()?>" class="btn-link bg-color-orange border-rad-10 width-50px height-50px margin-top-10-px margin-left-10-px" > <i class=""></i> X </a>

    <div class="profil-picture">
        <div class="input-picture-container">
        <input type="file" name="" id="input-picture-field" class="input-picture-field">
        <label for="input-picture-field" class="input-picture-label"> <i class="icon-image-plus"></i> </label>
        <img src="/img/defaultPP.png" alt="photo de profil" class="input-picture-rendered">
    </div>

    </div>

    <div class="profil-user-name disabled input-container width-70">
        <input type="text" name="userName" id="userName" class="disabled input-field bg-color-light-gray" disabled>
        <label for="userName" class="input-label font-bold text-color-white"> <i class="icon-user"></i> Nom d'utilisateur</label>
    </div>

    <div class="profil-password input-container width-70">
        <input type="password" name="userPassword" id="userPassword" class="input-field bg-color-light-gray" required>
        <label for="userPassword" class="input-label font-bold text-color-white"> <i class="icon-lock"></i> Mot de passe</label>
    </div>

    <div class="profil-firstname input-container width-70">
        <input type="text" name="userFirstName" id="userFirstName" class="input-field bg-color-light-gray" required>
        <label for="userFirstName" class="input-label font-bold text-color-white">Prénom</label>
    </div>

    <div class="profil-lastname input-container width-70">
        <input type="text" name="userLastName" id="userLastName" class="input-field bg-color-light-gray" required>
        <label for="userLastName" class="input-label font-bold text-color-white">Nom</label>
    </div>

    <div class="profil-fonction input-container width-70">
        <input type="text" name="userPosition" id="userPosition" class="input-field bg-color-light-gray" required>
        <label for="userPosition" class="input-label font-bold text-color-white"> <i class="icon-briefcase"></i> Fonction</label>
    </div>

    <div class="profil-mail-address input-container width-70">
        <input type="text" name="userMail" id="userMail" class="input-field bg-color-light-gray" required>
        <label for="userMail" class="input-label font-bold text-color-white"> <i class="icon-at"></i> Adresse mail</label>
    </div>

    <div class="profil-phone-number input-container width-70">
        <input type="text" name="userPhone" id="userPhone" class="input-field bg-color-light-gray" required>
        <label for="userPhone" class="input-label font-bold text-color-white"> <i class="icon-phone"></i> Numéro de téléphone</label>
    </div>

    <div class="profil-btn-zone">
        <label for="btn-register" class="label-btn-input bg-color-orange text-color-black"> <span> Enregistrer </span> </label>
        <input type="submit" class="btn-input" id="btn-register">

        <label for="btn-cancel" class="label-btn-input bg-color-orange text-color-black"> <span> Annuler </span> </label>
        <input type="reset" class="btn-input" id="btn-cancel">
    </div>
</form>

<?php
    function returnURL(){
        if($_SESSION['userFonction'] == "administrator"){
            return "/profil?onglet=employees&display=view";
        }
        else{
            return "/profil?onglet=employees&display=view";
        }
    }
?>