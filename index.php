<!DOCTYPE html>
<html lang="fr">

<!-- variables declaration -->
<?php
    $title = TITLE_PAGE_INDEX;
    include_once APP . "private/constant/page/head.php";
?>

<body>
    <div class="container bg-color-gray">
        <main class="main-login">
            <div class="card-login">
                <div class="card-login-content grid-c5-r4">
                    <span class="card-title font-bold">Connectez-vous</span>
                    <div class="card-body">
                        <form method="post" class="card-form grid-c5-r3">
                            <div class="row1 align-self-center">
                                <div class="input-field">
                                    <input id="last_name" type="text" name="userName" required>
                                    <label for="last_name" class="black-text"> <i class="icon-user"></i> Last Name</label>
                                </div>
                            </div>
                            <div class="row2 align-self-center">
                                <div class="input-field">
                                    <input id="password" type="password" name="userPassWord" required>
                                    <label for="password" class="black-text"> <i class="icon-lock"></i> Password</label>
                                </div>
                                <a class="btn bg-color-gray" id="toggle"> <i class="icon-eye-slash" id="toggleIcon"></i> </a>
                            </div>
                            <div class="row3 align-self-center">

                                <label for="btn-connection" class="label-btn-input bg-color-gray text-color-white"> <span> Connexion </span> </label>
                                <input type="submit" class="btn-input" id="btn-connection">

                                <label for="btn-cancel" class="label-btn-input bg-color-gray text-color-white"> <span> Annuler </span> </label>
                                <input type="reset" class="btn-input" id="btn-cancel">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </div>
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