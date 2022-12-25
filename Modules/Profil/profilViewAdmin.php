<?php 
    include_once dirname(__FILE__,3)."/dataBase/dataBaseConnection.php";
    include_once dirname(__FILE__)."/searchProcess.php";
    $statement = $PDO->prepare("select * from User");
    $statement->execute();
    $results = $statement->fetchAll();


        /**
     * array where we do the research
     */
    $tables = array(
        "User" => array(
            "column" => array("userFirstName" , "userLastName" , "userMail" , "userPhone" , "userPosition"), // array name of column 
            "orderby" => "", // string name of column
            "order" => "" // string ASC / DESC
        )
    );
    //$searchWord = array("nikola" , "chevalliot"); // word that we research
?>

<div class="profilViewAdmin">

    <a href="/profil.php?onglet=Employees&display=View&add=true" class="addEmployee"> <i class="icon-user-plus-bottom"></i> </a>

    <form method="POST" class="searchZone">
        <input type="search" name="searchEmployee" id="searchEmployee" placeholder="chercher un employé">
        <label for="searchEmployee" class="searchEmployeeLabel"> <i class="icon-user-search"></i></label>
    </form>


    <?php
        if(isset($_POST['searchEmployee'])){
            $searchWord = explode(" " , $_POST['searchEmployee']);
            $searchResult = querySearch($tables ,$searchWord);
            $searchStatement = $PDO->prepare($searchResult);
            $searchStatement->execute();
            $results = $searchStatement->fetchAll();
            unset($_POST['searchEmployee']);
        }
        else{
            $statement = $PDO->prepare("select * from User");
            $statement->execute();
            $results = $statement->fetchAll();
        }
        switch ($_GET["add"]) {
            case "false":
    ?>
        <section class="listContainer" id="listContainer">
            <h2> Liste des Employés : </h2>

            <table>
                <tr>
                    <th> Nom </th>
                    <th> Prénom </th>
                    <th> Mail </th>
                    <th> Téléphone </th>
                    <th> Poste </th>
                </tr>
                <tr>

                </tr>
                
            </table>

            <ul class="listContent" id="listContent">
                <?php foreach($results as $employee): ?>
                    <li class="employeeObject" id="employeeObject">
                        <img src="<?= $employee->userPicture ?>" alt="image de l'employé">
                        <p class="nameEmployee" id="nameEmployee"> <?= $employee->userLastName ?> </p>
                        <p class="surNameEmployee" id="surNameEmployee"> <?= $employee->userFirstName ?> </p>
                        <p class="mailEmployee" id="mailEmployee"> <?= $employee->userMail ?> </p>
                        <p class="phoneEmployee" id="phoneEmployee"> <?= $employee->userPhone ?> </p>
                        <p class="positionEmployee" id="positionEmployee"> <?= $employee->userPosition ?> </p>
                        <a href="#"> <i class="icon-user-edit"></i> </a>
                    </li>
                <?php endforeach?>
            </ul>
        </section>
    <?php
            break;
            case "true":
                include "addEmployee.php";
            break;
        }
    ?>
</div>