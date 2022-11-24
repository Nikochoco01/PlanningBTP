<?php 
session_start();
?>

<!DOCTYPE html>
<html lang="fr">

<!-- variables declaration -->
<?php
    $titlePage = "Connexion";
    include_once dirname(__FILE__)."/Modules/head.php";
?>

<body>
        <main class="logMain">

            <div class="logForm">
                <h2> Connectez-vous </h2>
                <form action="/Modules/logInProcess.php" method="post">
                    <p class="userName">
                        <label for="userName"> Nom d'utilisateur : </label>
                        <span> <i class="icon-user"></i> <input type="text" name="userName" id="userName" placeholder="prenom.nom" class="inputLog"> </span>
                    </p>

                    <p class="passWord">
                        <label for="userPassWord"> Mot de passe : </label>
                        <span> 
                            <i class="icon-lock"></i> <input type="password" name="userPassWord" id="userPassWord" placeholder="mot de passe" class="inputLog"> 
                            <a href="#" id="toggle"> <i class="icon-eye-slash" id="toggleIcon"></i> </a>
                        </span>
                    </p>

                        <input type="submit" value="Connexion">
                        <input type="reset" value="Annuler">
                </form>
            </div>
        </main>


    <script>
        let inputPassWord = document.querySelector('input[name="userPassWord"]');
        let toggleButton = document.getElementById('toggle');
        let toggleIcon = document.getElementById('toggleIcon');

        toggleButton.addEventListener('click' , ()=>{
            if(toggleIcon.classList == 'icon-eye-slash'){
                inputPassWord.type = 'text';
                toggleIcon.classList = 'icon-eye';
            }
            else{
                inputPassWord.type = 'password';
                toggleIcon.classList = 'icon-eye-slash';
            }
        })
    </script>
</body>
</html>