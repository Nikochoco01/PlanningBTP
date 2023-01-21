<?php 
    include_once dirname(__FILE__,2). "/dataBase/dataBaseConnection.php";
    include_once dirname(__FILE__,2)."/treatment/profileProcess/searchProcess.php";
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
?>

<div class="profilViewAdmin">

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
        <div class="listContainer" id="listContainer">

            <div class="addButton-searchZone">
                <a href="/profil.php?onglet=Employees&display=View&add=true" class="addEmployeeButton"> <i class="icon-user-plus-bottom"></i> </a>

                <form method="POST" class="searchZone">
                    <input type="search" name="searchEmployee" id="searchEmployee" placeholder="chercher un employé">
                    <label for="searchEmployee" class="searchEmployeeLabel"> <i class="icon-user-search"></i></label>
                </form>
            </div>


            <div class="scrollTableContainer">
                <table class="listContant">
                    <thead>
                        <tr>
                            <th scope="col"> Image</th>
                            <th scope="col"> Nom </th>
                            <th scope="col"> Prénom </th>
                            <th scope="col"> Mail </th>
                            <th scope="col"> Téléphone </th>
                            <th scope="col"> Poste </th>
                            <th scope="col"> Éditer </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach($results as $employee):?>
                            <tr class="employeeObject">
                                <td scope="row"> <img src="<?= $employee->userPicture ?>" alt="image de l'employé"> </td>
                                <td> <?= InputSecurity::displayWithFormat($employee->userLastName , "LastName") ?> </td>
                                <td> <?= InputSecurity::displayWithFormat($employee->userFirstName , "FirstName") ?> </td>
                                <td> <?= InputSecurity::displayWithFormat($employee->userMail) ?> </td>
                                <td> <?= InputSecurity::displayWithFormat($employee->userPhone , "PhoneNumber") ?> </td>
                                <td> <?= InputSecurity::displayWithFormat($employee->userPosition , "Position") ?> </td>
                                <td class="columnForButton"> <a href="#"> <i class="icon-user-edit"></i> </a> </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>

        </section>
    <?php
            break;
            case "true":
                include "addEmployee.php";
            break;
        }
    ?>
</div>