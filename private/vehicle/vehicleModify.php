<div class="profil-container bg-color-gray">

    <?php
        InputSecurity::validateWithoutLetter($_GET['vehicle'] , $vehicleLicensePlate , "licensePlate");
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
                "conditions"=>["vehicleLicensePlate" => $vehicleLicensePlate],
                "field" => "*"
            ]);
        }
    ?>

    <div class="profil-container-header">
        <div class="profil-link-container width-50">
            <a href="<?=$_SERVER["PATH_INFO"]?>?onglet=<?=PARAM_VEHICLES_ONGLET?>&display=<?= PARAM_VIEW_DISPLAY?>" class="btn-link width-50px height-50px border-rad-10 bg-color-orange hover-color-gray text-color-gray font-1-5-em"> <i class=""> X </i> </a>
        </div>

        <form method="POST" class="input-container width-50">
            <input type="search" name="search-employee" class="input-field" id="search-employee" optional>
            <label for="search-employee" class="input-label text-color-white"> <i class="icon-user-search"></i> chercher un véhicule </label>
        </form>
    </div>

    <div class="table-container">
        <form method="post" class="table-form">
            <table class="table">
                <thead class="table-header bg-color-orange text-color-gray">
                    <tr>
                        <th scope="col"> Immatriculation</th>
                        <th scope="col"> Modèle </th>
                        <th scope="col"> Places assises </th>
                        <th scope="col"> Permis </th>
                        <th scope="col"> Disponibilité </th>
                        <th scope="col"> Éditer </th>
                    </tr>
                </thead>
                <tbody class="table-body">
                    <?php foreach($results as $vehicle):?>
                        <tr class="table-cell text-color-white">
                            <td> <div class="input-container width-70 margin-left-10"> <input type="text" name="addLicensePlate" class="input-field" value="<?= $vehicle->vehicleLicensePlate ?>" readonly> </div> </td>
                            <td> <div class="input-container width-70"> <input type="text" name="addModel" class="input-field" value="<?= $vehicle->vehicleModel ?>" required> </div> </td>
                            <td> <div class="input-container width-70"> <input type="text" name="addSeatsNumber" class="input-field" value="<?= $vehicle->vehicleMaxPassenger ?>" required> </div> </td>
                            <td> <div class="input-container width-70"> <input type="text" name="addDriverLicense" class="input-field" value="<?= $vehicle->vehicleDriverLicense ?>" required> </div> </td>
                            <td> <div class="input-container width-70"> <input type="text" name="addAvailable" class="input-field" value="<?= $vehicle->vehicleDisponibility ?>" required> </div> </td>
                            <td>
                                <div class="btn-container width-80 gap-6">
                                    <label for="btn-register" class="label-btn-input bg-color-gray text-color-white"> <span> Enregistrer </span> </label>
                                    <input type="submit" class="btn-input" id="btn-register" formaction="vehicleModify">

                                    <label for="btn-delete" class="label-btn-input bg-color-gray text-color-white"> <span> Supprimer </span> </label>
                                    <input type="submit" class="btn-input" id="btn-delete" formaction="vehicleDelete">
                                    
                                    <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>">
                                    <input type="hidden" name="vehicleId" value="<?= $vehicle->vehicleId ?>">
                                </div>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </form>
    </div>
</div>