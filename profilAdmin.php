<?php include_once "Modules/config.php";
    session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<?php $titlePage = "Profil"; ?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/CSS/default.css">
    <link rel="stylesheet" href="/CSS/menu.css">
    <link rel="stylesheet" href="/Icon/style.css">
    <title> <?php echo $titlePage ?> </title>
</head>

<body>
    <?php include_once "Modules/header.php"; ?>

    <div class="layout">
        <?php include_once 'Modules/aside.php'; ?>

        <main>
            <nav>
                <ul>
                    <li class="buttonTabs <?php echo activeTab("Personal") ?>">
                        <a href=" <?php echo addUrlParam(array('onglet' => 'Personal')) ?>">
                            <i class=""></i> Personnel
                        </a>
                    </li>

                    <li class="buttonTabs <?php echo activeTab("Employes") ?>">
                        <a href=" <?php echo addUrlParam(array('onglet' => 'Employes')) ?>">
                            <i class=""></i> Employés
                        </a>
                    </li>
                </ul>
            </nav>

            <div>
                <?php
                    switch ($_GET["onglet"]) {
                        case "Personal":
                           
                            break;
                        case "Employes":
                            switch($_GET["display"]){
                                case "View":
                                    include "module/Profil/profilView.php";
                                break;
                                case "Modify":
                                    include "module/Profil/profilModify.php";
                                break;
                            }
                        break;
                    }
                ?>

            </div>
        </main>
    </div>
</body>

</html>