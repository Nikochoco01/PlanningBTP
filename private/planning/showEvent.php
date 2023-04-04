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
        <div class="profil-link-container width-30">
            <a href="<?= URLManagement::addUrlParam(array('month'=>date('m') ,'year'=>date('Y') , 'week'=>$month->getCurrentWeek())) ?>" class="btn-link width-50px height-50px border-rad-10 bg-color-orange hover-color-gray text-color-gray font-1-5-em"> <i class=""> X </i> </a>
        </div>

        <div class="profil-link-container width-70">
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
        <ul class="">
            <li>
                <label for="checkboxDropEmployeeShow" class="labelDropMenu"> Employés de la mission </label>
                <input type="checkbox" id="checkboxDropEmployeeShow" class="checkboxDrop">
                
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

            <li>
                <label for="checkboxDropMaterialShow" class="labelDropMenu"> Matériel de la mission </label>
                <input type="checkbox" id="checkboxDropMaterialShow" class="checkboxDrop">

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

            <li>
                <label for="checkboxDropVehicleShow" class="labelDropMenu"> Véhicules de la mission </label>
                <input type="checkbox" id="checkboxDropVehicleShow" class="checkboxDrop">

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

            <li>
                <label for="checkboxDropMissionShow" class="labelDropMenu"> Lieux de la mission </label>
                <input type="checkbox" id="checkboxDropMissionShow" class="checkboxDrop">

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