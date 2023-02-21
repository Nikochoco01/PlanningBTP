<?php
    InputSecurity::validateWithoutLetter($_GET['event'] , $eventID);
    $eventDetails = $event->getDetailSelectedEvent($eventID);
    $selectedEvent = $event->getEvent($eventDetails[0]->eventId)[0];

    function isInEvent($element1 , $element2){
        if($element1 == $element2){
            return "checked";
        }
    }
?>

<div class="modifyEvent">
    <form action="/modifyEvent" method="post">
        <input type="hidden" name="year" value="<?= $month->getYear() ?>">
        <input type="hidden" name="month" value="<?= $month->getMonth() ?>">
        <input type="hidden" name="week" value="<?= $month->getWeek() ?>">
        <input type="hidden" name="day" value="<?= $month->getDay() ?>">

        <a href="<?= LINK_TO_PLANNING."&year=".date('Y')."&month=".date('m')."&week=".$month->getCurrentWeek() ?>" class="quitModify"> X </a>
        <input type="hidden" name="eventId" value="<?= $eventID ?>" >
        <span>
            <label for="eventDescription"> Description :</label>
            <input type="text" name="eventDescription" id="eventDescription" value="<?= $selectedEvent->eventDescription ?>">
        </span>

        <span>
            <label for="eventStartDate"> Date de début :</label>
            <input type="date" name="eventStartDate" id="eventStartDate" value="<?= $selectedEvent->eventStartDate ?>">
        </span>

        <span>
            <label for="eventEndDate"> Date de fin :</label>
            <input type="date" name="eventEndDate" id="eventEndDate" value="<?= $selectedEvent->eventEndDate ?>">
        </span>

        <span>
            <label for="eventStartTime"> Heure de début :</label>
            <input type="time" name="eventStartTime" id="eventStartTime" value="<?= $selectedEvent->eventStartTime ?>">
        </span>

        <span>
            <label for="eventEndTime"> Heure de fin :</label>
            <input type="time" name="eventEndTime" id="eventEndTime" value="<?= $selectedEvent->eventEndTime ?>">
        </span>

        <ul>
            <li>
                <label for="checkboxDropMissionModify" class="labelDropMenu"> Lieux de la mission </label>
                <input type="checkbox" id="checkboxDropMissionModify" class="checkboxDrop" checked>
                <i></i>
                <span>
                    <!-- WORKSITES -->
                    <div class="scrollTableContainer scrollAddEvent">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col"> Nom du lieux </th>
                                    <th scope="col"> Adresse </th>
                                    <th scope="col"> Ajouter </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    foreach($eventDetails as $eventDetail): $workSite = $event->getWorksite($eventDetail->worksiteId)[0];?>
                                    <tr class="tableCell">
                                        <td> <?= InputSecurity::displayWithFormat($workSite->worksiteName, "uppercase") ?> </td>
                                        <td> <?= InputSecurity::displayWithFormat($workSite->worksiteAddress) ?> </td>
                                        <td class="columnForButton"> 
                                            <input type="radio" name="modifyWorksite" id="modifyWorksite" value="<?= $workSite->worksiteId ?>" checked>
                                            <label for="modifyWorksite"> <i class="icon-user-edit"></i> </label>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </span>
            </li>
            <li>
                <label for="checkboxDropEmployeeModify" class="labelDropMenu"> Employés de la mission </label>
                <input type="checkbox" id="checkboxDropEmployeeModify" class="checkboxDrop" checked>
                <i></i>
                <span>
                    <!-- EMPLOYEES -->
                    <div class="scrollTableContainer scrollAddEvent">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col"> Image</th>
                                    <th scope="col"> Prénom </th>
                                    <th scope="col"> Nom </th>
                                    <th scope="col"> Poste </th>
                                    <th scope="col"> supprimer </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($eventDetails as $eventDetail): $employee = $event->getEmployee($eventDetail->userId)[0];?>
                                    <tr class="tableCell">
                                        <td scope="row"> <img src="" alt="image de l'employé"> </td>
                                        <td> <?= InputSecurity::displayWithFormat($employee->userFirstName , "uppercaseFirstLetter") ?> </td>
                                        <td> <?= InputSecurity::displayWithFormat($employee->userLastName , "uppercase") ?> </td>
                                        <td> <?= InputSecurity::displayWithFormat($employee->userPosition , "uppercase") ?> </td>
                                        <td class="columnForButton"> 
                                            <input type="checkbox" name="addEmployee[]" id="addEmployee" value="<?= $employee->userId?>">
                                            <label for="addEmployee"> <i class="icon-user-edit"></i> </label>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </span>
            </li>
            <li>
                <label for="checkboxDropVehicleModify" class="labelDropMenu"> Véhicules de la mission </label>
                <input type="checkbox" id="checkboxDropVehicleModify" class="checkboxDrop" checked>
                <i></i>
                <span>
                    <!-- VEHICLES -->
                    <div class="scrollTableContainer scrollAddEvent">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col"> Plaque d’immatriculation </th>
                                    <th scope="col"> Model </th>
                                    <th scope="col"> Nombre de place </th>
                                    <th scope="col"> Permis nécessaire </th>
                                    <th scope="col"> supprimer </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($eventDetails as $eventDetail): $vehicle = $event->getVehicles($eventDetail->vehicle)[0];?>
                                    <tr class="tableCell">
                                        <td> <?= InputSecurity::displayWithFormat($vehicle->vehicleLicensePlate, "uppercase") ?> </td>
                                        <td> <?= InputSecurity::displayWithFormat($vehicle->vehicleModel) ?> </td>
                                        <td> <?= InputSecurity::displayWithFormat($vehicle->vehicleMaxPassenger) ?> </td>
                                        <td> <?= InputSecurity::displayWithFormat($vehicle->vehicleDriverLicense, "uppercase") ?> </td>
                                        <td class="columnForButton"> 
                                            <input type="checkbox" name="addVehicle[]" id="addVehicle" value="<?= $vehicle->vehicleLicensePlate ?>">
                                            <label for="addVehicle"> <i class="icon-user-edit"></i> </label>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </span>
            </li>
            <li>
                <label for="checkboxDropMaterialModify" class="labelDropMenu"> Matériel de la mission </label>
                <input type="checkbox" id="checkboxDropMaterialModify" class="checkboxDrop" checked>
                <i></i>
                <span>
                    <!-- MATERIAL -->
                    <div class="scrollTableContainer scrollAddEvent">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col"> Nom de l’équipement </th>
                                    <th scope="col"> Nombre total </th>
                                    <th scope="col"> Nombre disponible </th>
                                    <th scope="col"> Nombre à supprimer </th>
                                    <th scope="col"> supprimer </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($eventDetails as $eventDetail): $material = $event->getMaterial($eventDetail->equipment)[0]?>
                                    <tr class="tableCell">
                                        <td> <?= InputSecurity::displayWithFormat($material->equipmentName, "uppercase") ?> </td>
                                        <td> <?= InputSecurity::displayWithFormat($material->equipmentTotalQuantity) ?> </td>
                                        <td> <?= InputSecurity::displayWithFormat($material->equipmentAvailableQuantity) ?> </td>
                                        <td> <input type="number" name="materialQuantity[]" id="materialQuantity"> </td>
                                        <td class="columnForButton"> 
                                            <input type="checkbox" name="addMaterial[]" id="addMaterial" value="<?= $material->equipmentName ?>">
                                            <label for="addMaterial"> <i class="icon-user-edit"></i> </label>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </span>
            </li>
        </ul>
        <span class="buttonZone">
            <input type="submit" value="Modifier la mission" class="validateButton">
            <input type="button" value="Annuler l'ajout" class="validateButton">
        </span>
    </form>
</div>