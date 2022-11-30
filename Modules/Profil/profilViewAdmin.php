<div class="profilViewAdmin">

    <a href="/profil.php?userRole=administrateur&onglet=Employes&display=View&add=true" class="addEmployee"> <i class="icon-user-plus-bottom"></i> </a>

    <span class="searchZone">
        <input type="search" name="searchEmployee" id="searchEmployee" placeholder="chercher un employé">
        <label for="searchEmployee" class="searchEmployeeLabel"> <i class="icon-user-search"></i></label>
    </span>


    <?php
        switch ($_GET["add"]) {
            case "false":
    ?>
        <!-- <section class="listContainer" id="listContainer">
            <h2> Liste des Employés : </h2>

            <ul class="listContent" id="listContent">
                <li class="employee">
                    <img src="img/Noemie.png" alt="image de l'employé">
                    <p class="nameEmployee"> Nom </p>
                    <p class="surNameEmployee"> Prenom </p>
                    <label for="editEmployee"> <i class="icon-user-edit"></i></label>
                    <input type="button" value="" id="editEmployee">
                </li>
                <li class="employee">
                    <img src="img/Noemie.png" alt="image de l'employé">
                    <p class="nameEmployee"> Nom </p>
                    <p class="surNameEmployee"> Prenom </p>
                    <label for="editEmployee"> <i class="icon-user-edit"></i></label>
                    <input type="button" value="" id="editEmployee">
                </li>
                <li class="employee">
                    <img src="img/Noemie.png" alt="image de l'employé">
                    <p class="nameEmployee"> Nom </p>
                    <p class="surNameEmployee"> Prenom </p>
                    <label for="editEmployee"> <i class="icon-user-edit"></i></label>
                    <input type="button" value="" id="editEmployee">
                </li>
            </ul>
        </section> -->
    <?php
            break;
            case "true":
                include "addEmployee.php";
            break;
        }
    ?>

    
</div>