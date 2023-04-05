<?php
    $event = new Events($dataBase);
    InputSecurity::validateWithoutLetter($_GET['event'] , $eventID);
    $eventDetails = $event->getDetailSelectedEvent($eventID)[0];
    $selectedEvent = $event->getEvent($eventDetails->eventId)[0];

    $usersResults = $event->getEmployee("view" , $eventDetails->userId);

    $materialsResults = $event->getMaterial("view" , $selectedEvent->eventId);

    $vehiclesResults = $event->getVehicles("view" , $selectedEvent->eventId);

    $worksitesResults = $event->getWorksite("view" , $eventDetails->worksiteId);
?>

<div class="profil-container bg-color-gray">
    <div class="profil-container-header">
        <div class="profil-link-container width-10">
            <a href="<?=$_SERVER["PATH_INFO"]?>?onglet=<?= PARAM_MISSION_ONGLET ?>&display=<?= PARAM_WEEK_DISPLAY?>&year= <?= date('Y') ?>&month=<?= date('m')?>&week=<?= $month->getCurrentWeek() ?> " class="btn-link width-50px height-50px border-rad-10 bg-color-orange hover-color-gray text-color-gray font-1-5-em"> <i class=""> X </i> </a>
        </div>

        <div class="profil-link-container width-30 margin-right-5">

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
                <input type="text" name="userName" id="userName" value="<?= $selectedEvent->eventDescription ?>" class="input-field bg-color-light-gray" readonly>
                <label for="userName" class="input-label font-bold text-color-white"> Description </label>
            </div>

            <div class="profil-firstname input-container width-70">
                <input type="text" name="userFirstName" id="userFirstName" class="input-field bg-color-light-gray" value="<?= $selectedEvent->eventStartDate ?>" readonly>
                <label for="userFirstName" class="input-label font-bold text-color-white">Date de début</label>
            </div>

            <div class="profil-lastname input-container width-70">
                <input type="text" name="userLastName" id="userLastName" class="input-field bg-color-light-gray" value="<?= $selectedEvent->eventEndDate ?>" readonly>
                <label for="userLastName" class="input-label font-bold text-color-white">Date de fin</label>
            </div>

            <div class="profil-fonction input-container width-70">
                <input type="text" name="userPosition" id="userPosition" class="input-field bg-color-light-gray" value="<?= $selectedEvent->eventStartTime ?>" readonly>
                <label for="userPosition" class="input-label font-bold text-color-white"> <i class="icon-briefcase"></i> Heure de début</label>
            </div>

            <div class="profil-fonction input-container width-70">
                <input type="text" name="userPosition" id="userPosition" class="input-field bg-color-light-gray" value="<?= $selectedEvent->eventEndTime ?>" readonly>
                <label for="userPosition" class="input-label font-bold text-color-white"> <i class="icon-briefcase"></i> Heure de fin</label>
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
                            </tr>
                        </thead>
                        <tbody class="table-body">
                            <?php
                                foreach($materialsResults as $material):?>
                                <tr class="table-cell text-color-white">
                                    <td class="padding-left-5"> <?= InputSecurity::displayWithFormat($material->equipmentName , "uppercaseFirstLetter") ?> </td>
                                    <td> <?= InputSecurity::displayWithFormat($material->equipmentAvailableQuantity , "uppercase") ?> </td>
                                    <td> <?= InputSecurity::displayWithFormat($material->equipmentTotalQuantity) ?> </td>
                                </tr>
                            <?php endforeach ?>
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
                            </tr>
                        </thead>
                        <tbody class="table-body">
                            <?php
                                foreach($vehiclesResults as $vehicle):?>
                                <tr class="table-cell text-color-white">
                                    <td class="padding-left-2"> <?= InputSecurity::displayWithFormat($vehicle->vehicleLicensePlate , "uppercase") ?> </td>
                                    <td> <?= InputSecurity::displayWithFormat($vehicle->vehicleModel , "uppercaseFirstLetter") ?> </td>
                                    <td> <?= InputSecurity::displayWithFormat($vehicle->vehicleMaxPassenger) ?> </td>
                                    <td> <?= InputSecurity::displayWithFormat($vehicle->vehicleDriverLicense , "uppercase") ?> </td>
                                    <td> <?= InputSecurity::displayWithFormat($vehicle->vehicleDisponibility , "uppercase") ?> </td>
                                </tr>
                            <?php endforeach ?>
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
                            </tr>
                        </thead>
                        <tbody class="table-body">
                            <?php
                                foreach($worksitesResults as $worksite):?>
                                <tr class="table-cell text-color-white">
                                    <td class="padding-left-2"> <?= InputSecurity::displayWithFormat($worksite->worksiteName , "uppercase") ?> </td>
                                    <td> <?= InputSecurity::displayWithFormat($worksite->worksiteAddress , "uppercaseFirstLetter") ?> </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </li>
        </ul>
    </div>
</div>


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