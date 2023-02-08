<?php 
    require_once dirname(__FILE__,2). "/class/Events.php";
    $eventDetails = $event->getDetailSelectedEvent($_GET['event']);
    $selectedEvent = $event->getEvent($eventDetails[0]['eventId']);
?>


<div class="detailEvent">
    <div class="detailContainer">
        <a href="<?= LINK_TO_PLANNING."&year=".date('Y')."&month=".date('m')."&week=".$month->getCurrentWeek() ?>" class="quitDetails"> X </a>
        <span>
            <label for="eventDescription"> Description :</label>
            <input type="text" name="eventDescription" id="eventDescription" value="<?= $selectedEvent[0]['eventDescription'] ?>" readonly>
        </span>

        <span>
            <label for="eventStartDate"> Date de début :</label>
            <input type="date" name="eventStartDate" id="eventStartDate" value="<?= $selectedEvent[0]['eventStartDate'] ?>" readonly>
        </span>

        <span>
            <label for="eventEndDate"> Date de fin :</label>
            <input type="date" name="eventEndDate" id="eventEndDate" value="<?= $selectedEvent[0]['eventEndDate'] ?>" readonly>
        </span>

        <span>
            <label for="eventStartTime"> Heure de début :</label>
            <input type="time" name="eventStartTime" id="eventStartTime" value="<?= $selectedEvent[0]['eventStartTime'] ?>" readonly>
        </span>

        <span>
            <label for="eventEndTime"> Heure de fin :</label>
            <input type="time" name="eventEndTime" id="eventEndTime" value="<?= $selectedEvent[0]['eventEndTime'] ?>" readonly>
        </span>

        <ul>
            <li>
                <label for="checkboxDropMissionShow" class="labelDropMenu"> Lieux de la mission </label>
                <input type="checkbox" id="checkboxDropMissionShow" class="checkboxDrop" checked>
                <i></i>
                <span>
                    <!-- WORKSITES -->
                    <div class="scrollTableContainer">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col"> Nom du lieux </th>
                                    <th scope="col"> Adresse </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $workSite = $event->getWorksite($eventDetails[0]['worksiteId']); ?>
                                <tr class="tableCell">
                                    <td> <?= InputSecurity::displayWithFormat($workSite[0]['worksiteName'], "uppercase") ?> </td>
                                    <td> <?= InputSecurity::displayWithFormat($workSite[0]['worksiteAddress']) ?> </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </span>
            </li>
            <li>
                <label for="checkboxDropEmployeeShow" class="labelDropMenu"> Employés de la mission </label>
                <input type="checkbox" id="checkboxDropEmployeeShow" class="checkboxDrop" checked>
                <i></i>
                <span>
                    <!-- EMPLOYEES -->
                    <div class="scrollTableContainer">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col"> Image</th>
                                    <th scope="col"> Prénom </th>
                                    <th scope="col"> Nom </th>
                                    <th scope="col"> Poste </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($eventDetails as $eventDetail): $employee = $event->getEmployee($eventDetail['userId']);?>
                                    <tr class="tableCell">
                                        <td scope="row"> <img src="" alt="image de l'employé"> </td>
                                        <td> <?= InputSecurity::displayWithFormat($employee[0]['userFirstName'] , "uppercaseFirstLetter") ?> </td>
                                        <td> <?= InputSecurity::displayWithFormat($employee[0]['userLastName'] , "uppercase") ?> </td>
                                        <td> <?= InputSecurity::displayWithFormat($employee[0]['userPosition'] , "uppercase") ?> </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </span>
            </li>
            <li>
                <label for="checkboxDropVehicleShow" class="labelDropMenu"> Véhicules de la mission </label>
                <input type="checkbox" id="checkboxDropVehicleShow" class="checkboxDrop" checked>
                <i></i>
                <span>
                    <!-- VEHICLES -->
                    <div class="scrollTableContainer">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col"> Plaque d’immatriculation </th>
                                    <th scope="col"> Model </th>
                                    <th scope="col"> Nombre de place </th>
                                    <th scope="col"> Permis nécessaire </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($eventDetails as $eventDetail): $vehicle = $event->getVehicles($eventDetail['vehicle']);?>
                                    <tr class="tableCell">
                                        <td> <?= InputSecurity::displayWithFormat($vehicle[0]['vehicleLicensePlate'], "uppercase") ?> </td>
                                        <td> <?= InputSecurity::displayWithFormat($vehicle[0]['vehicleModel']) ?> </td>
                                        <td> <?= InputSecurity::displayWithFormat($vehicle[0]['vehicleMaxPassenger']) ?> </td>
                                        <td> <?= InputSecurity::displayWithFormat($vehicle[0]['vehicleDriverLicense'], "uppercase") ?> </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </span>
            </li>
            <li>
                <label for="checkboxDropMaterialShow" class="labelDropMenu"> Matériel de la mission </label>
                <input type="checkbox" id="checkboxDropMaterialShow" class="checkboxDrop" checked>
                <i></i>
                <span>
                    <!-- MATERIAL -->
                    <div class="scrollTableContainer">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col"> Nom de l’équipement </th>
                                    <th scope="col"> Nombre total </th>
                                    <th scope="col"> Nombre disponible </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    foreach($eventDetails as $eventDetail): $material = $event->getMaterial($eventDetail['equipment'])?>
                                    <tr class="tableCell">
                                        <td> <?= InputSecurity::displayWithFormat($material[0]['equipmentName'], "uppercase") ?> </td>
                                        <td> <?= InputSecurity::displayWithFormat($material[0]['equipmentTotalQuantity']) ?> </td>
                                        <td> <?= InputSecurity::displayWithFormat($material[0]['equipmentAvailableQuantity']) ?> </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </span>
            </li>
        </ul>

        <?php if($_SESSION['userPosition'] != PARAM_SESSION_TYPE_ADMINISTRATOR ) : ?>
            <span class="buttonZone">
                <a href="<?= URLManagement::addUrlParam(array('modify'=>'true')) ?>">Modifier</a>
            </span>
        <?php endif ?>
    </div>
</div>