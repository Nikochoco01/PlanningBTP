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

<div class="profil-container bg-color-gray">

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
    ?>

            <div class="profil-container-header">
                <div class="profil-link-container">
                    <a href="<?= URLManagement::addUrlParam(array('display'=>'add')) ?>" class="btn-link width-50px height-50px border-rad-10 bg-color-orange hover-color-gray text-color-gray font-1-5-em"> <i class="icon-user-plus-bottom"></i> </a>
                    <a href="<?=$_SERVER["PATH_INFO"]?>?onglet=<?= PARAM_EMPLOYEE_ONGLET ?>&display=<?= PARAM_VIEW_DISPLAY?>" class="btn-link width-50px height-50px border-rad-10 bg-color-orange hover-color-gray text-color-gray font-1-5-em"> <i class="icon-rotate"></i> </a>
                </div>

                <form method="POST" class="input-container width-50">
                    <input type="search" name="search-employee" class="input-field" id="search-employee" optional>
                    <label for="search-employee" class="input-label text-color-white"> <i class="icon-user-search"></i> chercher un employé </label>
                </form>
            </div>

            <div class="table-container">
                <table class="table">
                    <thead class="table-header bg-color-orange text-color-gray">
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
                            foreach($results as $employee):?>
                            <tr class="table-cell text-color-white">
                                <td> <img class="border-rad-10 width-70px height-70px margin-left-10" src=" <?= $pictureWebsite->display($employee->pictureId) ?>" alt="image de l'employé"> </td>
                                <td> <?= InputSecurity::displayWithFormat($employee->userFirstName , "uppercaseFirstLetter") ?> </td>
                                <td> <?= InputSecurity::displayWithFormat($employee->userLastName , "uppercase") ?> </td>
                                <td> <?= InputSecurity::displayWithFormat($employee->userMail) ?> </td>
                                <td> <?= InputSecurity::displayWithFormat($employee->userPhone , "PhoneNumber") ?> </td>
                                <td> <?= InputSecurity::displayWithFormat($employee->userPosition , "uppercase") ?> </td>
                                <td> <a class="btn-link bg-color-gray width-50 height-50px border-rad-10 text-color-white hover-color-orange" href="/profil?onglet=employees&display=modify&employee=<?= $employee->userId ?>" > <i class="icon-user-edit"></i> </a> </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
</div>