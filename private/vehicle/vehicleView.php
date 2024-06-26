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
            $results = $dataBase->read("Vehicle v join DriverLicense d on v.vehicleDriverLicense = d.driverLicenseName",[
                "field" => "*"
            ]);
        }
    ?>

    <div class="profil-container-header">
        <div class="profil-link-container width-50">
            <a href="<?= URLManagement::addUrlParam(array('display'=>'add')) ?>" class="btn-link width-50px height-50px border-rad-10 bg-color-orange hover-color-gray text-color-gray font-1-5-em"> <i class="icon-user-plus-bottom"></i> </a>
            <a href="<?=$_SERVER["PATH_INFO"]?>?onglet=<?=PARAM_VEHICLES_ONGLET?>&display=<?= PARAM_VIEW_DISPLAY?>" class="btn-link width-50px height-50px border-rad-10 bg-color-orange hover-color-gray text-color-gray font-1-5-em"> <i class="icon-rotate"></i> </a>
        </div>

        <form method="POST" class="input-container width-50">
            <input type="search" name="search-employee" class="input-field" id="search-employee" optional>
            <label for="search-employee" class="input-label text-color-white"> <i class="icon-user-search"></i> chercher un véhicule </label>
        </form>
    </div>

    <div class="table-container">
        <table class="table">
            <thead class="table-header bg-color-orange text-color-gray">
                <tr>
                    <th scope="col"> Immatriculation</th>
                    <th scope="col"> Modèle </th>
                    <th scope="col"> Places assises </th>
                    <th scope="col"> Permis </th>
                    <th scope="col"> Disponibilité </th>
                    <?php if($rightToModify):?>
                    <th scope="col"> Éditer </th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody class="table-body">
                <?php
                    foreach($results as $vehicle):?>
                    <tr class="table-cell text-color-white">
                        <td class="padding-left-2"> <?= InputSecurity::displayWithFormat($vehicle->vehicleLicensePlate , "uppercase") ?> </td>
                        <td> <?= InputSecurity::displayWithFormat($vehicle->vehicleModel , "uppercaseFirstLetter") ?> </td>
                        <td> <?= InputSecurity::displayWithFormat($vehicle->vehicleMaxPassenger) ?> </td>
                        <td> <?= InputSecurity::displayWithFormat($vehicle->vehicleDriverLicense , "uppercase") ?> </td>
                        <td> <?= InputSecurity::displayWithFormat($vehicle->vehicleDisponibility , "uppercase") ?> </td>
                        <?php if($rightToModify):?>
                            <td> <a class="btn-link bg-color-gray width-50 height-50px border-rad-10 text-color-white hover-color-orange" href="<?=$_SERVER["PATH_INFO"]?>?onglet=<?=PARAM_VEHICLES_ONGLET?>&display=<?= PARAM_MODIFY_DISPLAY?>&vehicle=<?= $vehicle->vehicleLicensePlate ?>" > <i class="icon-user-edit"></i> </a> </td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>