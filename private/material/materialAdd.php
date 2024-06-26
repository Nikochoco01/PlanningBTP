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
            $results = $dataBase->read("Equipment",[
                "field" => "*"
            ]);
        }
    ?>

    <div class="profil-container-header">
        <div class="profil-link-container width-50">
            <a href="<?=$_SERVER["PATH_INFO"]?>?onglet=<?=PARAM_MATERIAL_ONGLET?>&display=<?= PARAM_VIEW_DISPLAY?>" class="btn-link width-50px height-50px border-rad-10 bg-color-orange hover-color-gray text-color-gray font-1-5-em"> <i class=""> X </i> </a>
        </div>

        <form method="POST" class="input-container width-50">
            <input type="search" name="search-employee" class="input-field" id="search-employee" optional>
            <label for="search-employee" class="input-label text-color-white"> <i class="icon-user-search"></i> chercher du matériel </label>
        </form>
    </div>

    <div class="table-container">
        <form method="post" class="table-form">
            <table class="table">
                <thead class="table-header bg-color-orange text-color-gray">
                    <tr>
                        <th scope="col"> Nom de l'équipement</th>
                        <th scope="col"> Nombre disponible </th>
                        <th scope="col"> Nombre total</th>
                        <?php if($rightToModify):?>
                        <th scope="col"> Éditer</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody class="table-body">
                        <tr class="table-cell text-color-white">
                            <td> <div class="input-container width-70 margin-left-10"> <input type="text" name="addMaterialName" class="input-field" required> </div> </td>
                            <td> <div class="input-container width-70"> <input type="text" name="addMaterialNumberAvailable" class="input-field" required> </div> </td>
                            <td> <div class="input-container width-70"> <input type="text" name="addMaterialNumberTotal" class="input-field" required> </div> </td>
                            <td>
                                <div class="btn-container width-80 gap-6">
                                    <label for="btn-register" class="label-btn-input bg-color-gray text-color-white"> <span> Enregistrer </span> </label>
                                    <input type="submit" class="btn-input" id="btn-register">
                                    <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>">
                                </div>
                            </td>
                        </tr>
                </tbody>
            </table>
        </form>
    </div>
</div>