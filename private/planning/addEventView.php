<?php
    $event = new Events($dataBase);
    // InputSecurity::validateWithoutLetter($_GET['event'] , $eventID);
    // $eventDetails = $event->getDetailSelectedEvent($eventID)[0];
    // $selectedEvent = $event->getEvent($eventDetails->eventId)[0];

    $usersResults = $event->getEmployee("modify");

    $materialsResults = $event->getMaterial("modify");

    $vehiclesResults = $event->getVehicles("modify");

    $worksitesResults = $event->getWorksite("modify");
?>

<form class="profil-container bg-color-gray" method="post">
    <div class="profil-container-header">
        <div class="profil-link-container width-10">
            <a href="<?=$_SERVER["PATH_INFO"]?>?onglet=<?= PARAM_MISSION_ONGLET ?>&display=<?= PARAM_WEEK_DISPLAY?>&year= <?= date('Y') ?>&month=<?= date('m')?>&week=<?= $month->getCurrentWeek() ?> " class="btn-link width-50px height-50px border-rad-10 bg-color-orange hover-color-gray text-color-gray font-1-5-em"> <i class=""> X </i> </a>
        </div>

        <div class="profil-link-container width-30 margin-right-15px">

            <div class="input-container width-30">
                <label for="checkboxDropEmployeeShow" class="input-checkbox-label text-color-white bg-color-orange border-rad-10"> Employés </label>
                <input type="checkbox" id="checkboxDropEmployeeShow" class="input-checkbox-field" checked>
            </div>

            <div class="input-container width-30">
                <label for="checkboxDropMaterialShow" class="input-checkbox-label text-color-white bg-color-orange border-rad-10"> Matériels </label>
                <input type="checkbox" id="checkboxDropMaterialShow" class="input-checkbox-field">
            </div>

            <div class="input-container width-30">
                <label for="checkboxDropVehicleShow" class="input-checkbox-label text-color-white bg-color-orange border-rad-10"> Véhicules </label>
                <input type="checkbox" id="checkboxDropVehicleShow" class="input-checkbox-field">
            </div>

            <div class="input-container width-30">
                <label for="checkboxDropMissionShow" class="input-checkbox-label text-color-white bg-color-orange border-rad-10"> Lieux </label>
                <input type="checkbox" id="checkboxDropMissionShow" class="input-checkbox-field">
            </div>
        </div>

        <div class="profil-link-container width-60">
            <div class="profil-user-name input-container width-70">
                <input type="text" name="eventDescription" id="eventDescription" class="input-field bg-color-light-gray" required>
                <label for="eventDescription" class="input-label font-bold text-color-white"> Description </label>
            </div>

            <div class="profil-firstname input-container width-70">
                <input type="date" name="eventStartDate" id="eventStartDate" class="input-field bg-color-light-gray" required>
                <label for="eventStartDate" class="input-label font-bold text-color-white date-time">Date de début</label>
            </div>

            <div class="profil-lastname input-container width-70">
                <input type="date" name="eventEndDate" id="eventEndDate" class="input-field bg-color-light-gray" required>
                <label for="eventEndDate" class="input-label font-bold text-color-white date-time">Date de fin</label>
            </div>

            <div class="profil-fonction input-container width-70">
                <input type="time" name="eventStartTime" id="eventStartTime" class="input-field bg-color-light-gray" required>
                <label for="eventStartTime" class="input-label font-bold text-color-white date-time"> <i class="icon-briefcase"></i> Heure de début</label>
            </div>

            <div class="profil-fonction input-container width-70">
                <input type="time" name="eventEndTime" id="eventEndTime" class="input-field bg-color-light-gray" required>
                <label for="eventEndTime" class="input-label font-bold text-color-white date-time"> <i class="icon-briefcase"></i> Heure de fin</label>
            </div>
        </div>

        <div class="profil-link-container width-10 margin-left-10px">
            <div class="btn-container width-100">
                <label for="btn-register" class="label-btn-input bg-color-orange text-color-white"> <span> Enregistrer </span> </label>
                <input type="submit" class="btn-input" id="btn-register">
            </div>
        </div>
    </div>

    <div class ="table-container">
        <ul class="table-list">
            <li id="employeeList">
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
                            </tr>
                        </thead>
                        <tbody class="table-body">
                            <?php
                                if($usersResults != null):
                                    foreach($usersResults as $employee):?>
                                        <tr class="table-cell text-color-white">
                                            <td> <img class="border-rad-10 width-70px height-70px margin-left-10" src=" <?= $pictureWebsite->display($employee->pictureId) ?>" alt="image de l'employé"> </td>
                                            <td> <?= InputSecurity::displayWithFormat($employee->userFirstName , "uppercaseFirstLetter") ?> </td>
                                            <td> <?= InputSecurity::displayWithFormat($employee->userLastName , "uppercase") ?> </td>
                                            <td> <?= InputSecurity::displayWithFormat($employee->userMail) ?> </td>
                                            <td> <?= InputSecurity::displayWithFormat($employee->userPhone , "PhoneNumber") ?> </td>
                                            <td> <?= InputSecurity::displayWithFormat($employee->userPosition , "uppercase") ?> </td>
                                        
                                        </tr>
                            <?php endforeach; endif ?>
                        </tbody>
                    </table>
                </div>
            </li>

            <li id="materialList">
                <div class="table-container">
                    <table class="table">
                        <thead class="table-header bg-color-orange text-color-gray">
                            <tr>
                                <th scope="col"> Nom de l'equipment</th>
                                <th scope="col"> Nombre disponible </th>
                                <th scope="col"> Nombre total</th>
                                <th scope="col"> Nombre à utiliser</th>
                                <th scope="col"> Ajouter </th>
                            </tr>
                        </thead>
                        <tbody class="table-body">
                            <?php
                                if($materialsResults != null):
                                    foreach($materialsResults as $material):?>
                                    <tr class="table-cell text-color-white">
                                        <td class="padding-left-5"> <?= InputSecurity::displayWithFormat($material->equipmentName , "uppercaseFirstLetter") ?> </td>
                                        <td> <?= InputSecurity::displayWithFormat($material->equipmentAvailableQuantity) ?> </td>
                                        <td> <?= InputSecurity::displayWithFormat($material->equipmentTotalQuantity) ?> </td>
                                        <td> <div class="input-container width-70"> <input type="text" name="materialQuantity[]" class="input-field"> </div> </td>
                                        <td>
                                            <input type="checkbox" name="addMaterial[]" id="addMaterial" class="width-30px height-30px" value="<?= $material->equipmentId ?>">
                                            <input type="hidden" name="materialName" value="<?= $material->equipmentName ?>">
                                        </td>
                                    </tr>
                            <?php endforeach; endif?>
                        </tbody>
                    </table>
                </div>
            </li>

            <li id="vehiclesList">
                <div class="table-container">
                    <table class="table">
                        <thead class="table-header bg-color-orange text-color-gray">
                            <tr>
                                <th scope="col"> Immatriculation</th>
                                <th scope="col"> Model </th>
                                <th scope="col"> Place disponible </th>
                                <th scope="col"> Permis </th>
                                <th scope="col"> Disponibilité </th>
                                <th scope="col"> Ajouter </th>
                            </tr>
                        </thead>
                        <tbody class="table-body">
                            <?php
                                if($vehiclesResults != null):
                                    foreach($vehiclesResults as $vehicle):?>
                                    <tr class="table-cell text-color-white">
                                        <td class="padding-left-2"> <?= InputSecurity::displayWithFormat($vehicle->vehicleLicensePlate , "uppercase") ?> </td>
                                        <td> <?= InputSecurity::displayWithFormat($vehicle->vehicleModel , "uppercaseFirstLetter") ?> </td>
                                        <td> <?= InputSecurity::displayWithFormat($vehicle->vehicleMaxPassenger) ?> </td>
                                        <td> <?= InputSecurity::displayWithFormat($vehicle->vehicleDriverLicense , "uppercase") ?> </td>
                                        <td> <?= InputSecurity::displayWithFormat($vehicle->vehicleDisponibility , "uppercase") ?> </td>
                                        <td>
                                            <input type="checkbox" name="addVehicle[]" id="addVehicle" class="width-30px height-30px" value="<?= $vehicle->vehicleId ?>">
                                        </td>
                                    </tr>
                            <?php endforeach; endif ?>
                        </tbody>
                    </table>
                </div>
            </li>

            <li id="worksiteList">
                <div class="table-container">
                    <table class="table">
                        <thead class="table-header bg-color-orange text-color-gray">
                            <tr>
                                <th scope="col"> Nom du lieu</th>
                                <th scope="col"> Adresse </th>
                                <th scope="col"> Ajouter </th>
                            </tr>
                        </thead>
                        <tbody class="table-body">
                            <?php
                                if($worksitesResults != null):
                                    foreach($worksitesResults as $worksite):?>
                                    <tr class="table-cell text-color-white">
                                        <td class="padding-left-2"> <?= InputSecurity::displayWithFormat($worksite->worksiteName , "uppercase") ?> </td>
                                        <td> <?= InputSecurity::displayWithFormat($worksite->worksiteAddress , "uppercaseFirstLetter") ?> </td>
                                        <td>
                                            <input type="radio" name="addWorksite" id="addWorksite" class="width-30px height-30px" value="<?= $worksite->worksiteId ?>" require>
                                        </td>
                                    </tr>
                            <?php endforeach; endif ?>
                        </tbody>
                    </table>
                </div>
            </li>
        </ul>
    </div>
</form>


<script>

let employeeList = document.getElementById("employeeList")
let materialList = document.getElementById("materialList")
let vehiclesList = document.getElementById("vehiclesList")
let worksiteList = document.getElementById("worksiteList")

let employeeRadio = document.getElementById("checkboxDropEmployeeShow")
let materialRadio = document.getElementById("checkboxDropMaterialShow")
let vehicleRadio = document.getElementById("checkboxDropVehicleShow")
let worksiteRadio = document.getElementById("checkboxDropMissionShow")

employeeList.style.display = "block";
materialList.style.display = "none";
vehiclesList.style.display = "none";
worksiteList.style.display = "none";

employeeRadio.addEventListener("click" , () =>{
    if(!employeeRadio.checked){
        employeeList.style.display = "none";
    }
    else{
        employeeList.style.display = "block";
        materialList.style.display = "none";
        vehiclesList.style.display = "none";
        worksiteList.style.display = "none";

        materialRadio.checked = false;
        vehicleRadio.checked = false;
        worksiteRadio.checked = false;
    }
})

materialRadio.addEventListener("click" , () =>{
    if(!materialRadio.checked){
        materialList.style.display = "none";
    }
    else{
        materialList.style.display = "block";
        employeeList.style.display = "none";
        vehiclesList.style.display = "none";
        worksiteList.style.display = "none";

        employeeRadio.checked = false;
        vehicleRadio.checked = false;
        worksiteRadio.checked = false;
    }
})

vehicleRadio.addEventListener("click" , () =>{
    if(!vehicleRadio.checked){
        vehiclesList.style.display = "none";
    }
    else{
        vehiclesList.style.display = "block";
        employeeList.style.display = "none";
        materialList.style.display = "none";
        worksiteList.style.display = "none";

        employeeRadio.checked = false;
        materialRadio.checked = false;
        worksiteRadio.checked = false;
    }
})

worksiteRadio.addEventListener("click" , () =>{
    if(!worksiteRadio.checked){
        worksiteList.style.display = "none";
    }
    else{
        worksiteList.style.display = "block";
        employeeList.style.display = "none";
        materialList.style.display = "none";
        vehiclesList.style.display = "none";

        employeeRadio.checked = false;
        materialRadio.checked = false;
        vehicleRadio.checked = false;
    }
})

</script>