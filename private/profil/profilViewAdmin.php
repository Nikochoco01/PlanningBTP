<?php

    $results = "";
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

<div class="profil-container">

    <?php
        if(isset($_SESSION['ERROR'])){
            echo "<script> alert('" . $_SESSION['ERROR'] . "') </script>";
            InputSecurity::destroyError();
        }
        if(isset($_POST['searchEmployee'])){
            $searchWord = explode(" " , $_POST['searchEmployee']);
            $searchResult = querySearch($tables ,$searchWord);
      //  $searchStatement = $dataBase->read($tables , );
            $searchStatement = $PDO->prepare($searchResult);
            $searchStatement->execute();
            $results = $searchStatement->fetchAll();
            unset($_POST['searchEmployee']);
        }
        else{
        $results = $dataBase->read("User" , [
                        "field" => "*"
                    ]);
        }
        switch ($_GET["add"]) {
            case "false":
    ?>

            <div class="profil-container-header">
                <a href="<?= URLManagement::addUrlParam(array('add'=>'true')) ?>" class="addEmployeeButton"> <i class="icon-user-plus-bottom"></i> </a>
                <a href="/profil?onglet=employees&display=view&add=false" class="refreshButton"> <i class="icon-rotate"></i> </a>

                <form method="POST" class="searchZone">
                    <input type="search" name="searchEmployee" id="searchEmployee" placeholder="chercher un employé">
                    <label for="searchEmployee" class="searchEmployeeLabel"> <i class="icon-user-search"></i></label>
                </form>
            </div>

            <div class="scroll-table-container">
                <table class="table">
                    <thead class="table-header">
                        <tr>
                            <th scope="col"> Image</th>
                            <th scope="col"> Prénom </th>
                            <th scope="col"> Nom </th>
                            <th scope="col"> Mail </th>
                            <th scope="col"> Téléphone </th>
                            <th scope="col"> Poste </th>
                            <th scope="col"> Éditer </th>
                        </tr>
                    </thead>
                    <tbody class="table-body">
                        <?php
                            foreach($results as $employee): ?>
                            <tr class="table-cell">
                                <td scope="row"> <img src="<?= $employee->userPicture ?>" alt="image de l'employé"> </td>
                                <td> <?= InputSecurity::displayWithFormat($employee->userFirstName , "uppercaseFirstLetter") ?> </td>
                                <td> <?= InputSecurity::displayWithFormat($employee->userLastName , "uppercase") ?> </td>
                                <td> <?= InputSecurity::displayWithFormat($employee->userMail) ?> </td>
                                <td> <?= InputSecurity::displayWithFormat($employee->userPhone , "PhoneNumber") ?> </td>
                                <td> <?= InputSecurity::displayWithFormat($employee->userPosition , "uppercase") ?> </td>
                                <td class="column-for-button"> <a href="/profil?onglet=employees&display=modify&add=false&employee=<?= $employee->userId ?>" > <i class="icon-user-edit"></i> </a> </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
    <?php
            break;
            case "true":
                include "addEmployee.php";
            break;
        }
    ?>
</div>