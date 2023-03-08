<?php
    InputSecurity::validateWithoutLetter($_GET['employee'] , $userID);
    // $statement = $PDO->prepare("select * from User where userId =".$userID);
    // $statement->execute();
    // $results = $statement->fetch();

    $results = $dataBase->read("User", [
        "conditions" => [
            "userId" => $userID
        ]
    ]);
?>

<form action="modifyEmployee" method="post" class="profilModify" enctype="multipart/form-data">
    <a href="<?= returnURL()?>" class="quitButton" > <i class=""></i> QUIT </a>

    <label for="userPicture" class="userPicture">
        <div class="iconAddPicture">
            <i class="icon-image-plus"></i>
        </div>
        <img src="<?=Picture::display($dataBase, $_GET['employee'])?>" alt="user Picture">
        <input type="file" name="userPicture" id="userPicture">
    </label>

    <label class="Disabled"> <span>Nom d'utilisateur : </span>
        <input type="text" name="userName" id="userName" value="<?= $results[0]->userLastName ?>" class="Disabled" disabled>
    </label>
    <label for="userPassWord"> <span>Mot de passe :</span>
        <input type="password" name="userPassword" id="userPassword" value="" placeholder="taper un nouveau mot de passe">
    </label>
    <label for="userFirstName"> <span>Prénom :</span>
        <input type="text" name="userFirstName" id="userFirstName" value="<?= $results[0]->userFirstName ?>">
    </label>
    <label for="userLastName"> <span>Nom :</span>
        <input type="text" name="userLastName" id="userLastName" value="<?= $results[0]->userLastName ?>">
    </label>
    <label for="userPosition" class=" <?= addDisabled() ?>"> <span>Poste :</span>
        <input type="text" name="userPosition" id="userPosition" value="<?= $results[0]->userPosition ?>" <?= disableInput()?> class="<?= addDisabled() ?>">
    </label>
    <label for="userMail"> <span>Adresse mail :</span>
        <input type="text" name="userMail" id="userMail" value="<?= $results[0]->userMail ?>">
    </label>
    <label for="userPhone"> <span>Numéro de téléphone :</span>
        <input type="text" name="userPhone" id="userPhone" value="<?= $results[0]->userPhone ?>">
    </label>

    <input type="hidden" name="userId" value="<?= $_GET['employee']?>">
    
    <span>
        <input type="submit" value="Enregistrer">
        <input type="reset" value="Annuler">
    </span>
</form>

<?php 
    function disableInput(){
        if($_SESSION['userFonction'] == "administrator"){
            return "";
        }
        else{
            return "disabled";
        }
    }

    function addDisabled(){
        if($_SESSION['userFonction'] == "administrator"){
            return "";
        }
        else{
            return "Disabled";
        }
    }

    function returnURL(){
        if($_SESSION['userFonction'] == "administrator"){
            switch($_GET['onglet']){
                case "personal":
                        return "/profil?onglet=personal&display=view&add=false";
                case "employees":
                        return "/profil?onglet=employees&display=view&add=false";
            }
        }
        else{
            return "/profil.php?onglet=personal&display=view";
        }
    }
?>