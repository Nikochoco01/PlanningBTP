<?php 
    include_once "Modules/config.php";
    include_once dirname(__FILE__)."/Modules/InputSecurityClass.php";
    session_start();
    //var_dump($_SESSION['ERROR']);
    // if(isset($_SESSION['MESSAGE'])){
    //     var_dump($_SESSION['MESSAGE']);
    // }
?>
<!DOCTYPE html>
<html lang="fr">

<?php 
    $title = "Profil"; 
    include_once dirname(__FILE__)."/Modules/head.php";
?>

<body>
    <?php include_once "Modules/header.php"; ?>

    <div class="layout">
        <?php include_once 'Modules/aside.php'; ?>
        <main>
            <?php
                if($_SESSION['userFonction'] == 'administrator'){
                    include_once "Modules/tabs/selectTab.php";
                }
            ?>
            <div class="profilContent">
                <?php 
                    switch ($_GET["onglet"]) {
                        case "Personal":
                            switch($_GET["display"]){
                                case "View":
                                    include "Modules/Profil/profilView.php";
                                break;
                                case "Modify":
                                    include "Modules/Profil/profilModify.php";
                            break;
                            }
                        break;
                        case "Employees":
                            switch($_GET["display"]){
                                case "View":
                                    include "Modules/Profil/profilViewAdmin.php";
                                break;
                                case "Modify":
                                    include "Modules/Profil/profilModify.php";
                                break;
                            }
                        break;
                    }
                ?>
            </div>
        </main>
    </div>
</body>
<script>
    if(document.getElementById('searchEmployee')){
        console.log('test');
        let searchBar = document.getElementById('searchEmployee');
        let employee = document.getElementById('employeeObject');
        let employeeLastName = document.getElementById('nameEmployee');
        let employeeFirstName = document.getElementById('surNameEmployee');
        let employeeMail = document.getElementById('mailEmployee');
        let employeePhone = document.getElementById('phoneEmployee');
        let employeePosition = document.getElementById('positionEmployee');
        searchBar.addEventListener('input', () =>{

            console.log(searchBar.value);
        })

        function search(searchValue){

        }
    }
    
</script>

</html>