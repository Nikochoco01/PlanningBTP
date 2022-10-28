<!DOCTYPE html>
<html lang="fr">
<?php $titre = "Profil"; ?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/CSS/default.css">
    <link rel="stylesheet" href="/CSS/menu.css">
    <link rel="stylesheet" href="/Icon/style.css">
    <title> <?php echo $titre ?> </title>
</head>

<body>
    <?php include_once "module/header.php"; ?>

    <div class="layout">
        <?php include_once "module/aside.php"; ?>
        <main>
            <nav>
                <menu type="toolbar">
                    <li> <a href="profilAdmPerso.html"> Personnel </a> </li>
                    <li> <a href="profilAdmEmp.html"> Employés </a> </li>
                </menu>
            </nav>

            <section>
                <a href="#"> <i class="icon-userAdd"></i> <span> Add user </span> </a>
                <div>
                    <i class="icon-search"></i>
                    <input type="search" name="employee" id="employee">
                </div>
                
                <div class="listeEmployé" id="listeEmployé"></div>

            </section>
        </main>
    </div>
</body>
</html>