<?php $titre = "Profil";
include_once "module/head.php";?>

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