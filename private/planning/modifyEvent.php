<?php 
    require_once dirname(__FILE__,2). "/class/Events.php";
    $eventDetails = $event->getDetailSelectedEvent($_GET['event']);
    $selectedEvent = $event->getEvent($eventDetails[0]['eventId']);

    function isInEvent($element1 , $element2){
        if($element1 == $element2){
            return "checked";
        }
    }
?>


<div class="modifyEvent">
    <form action="/private/treatment/planningProcess/addEventProcess.php" method="post">

        <span>
            <label for="eventDescription"> Description :</label>
            <input type="text" name="eventDescription" id="eventDescription" value="<?= $selectedEvent[0]['eventDescription'] ?>">
        </span>

        <span>
            <label for="eventStartDate"> Date de début :</label>
            <input type="date" name="eventStartDate" id="eventStartDate" value="<?= $selectedEvent[0]['eventStartDate'] ?>">
        </span>

        <span>
            <label for="eventEndDate"> Date de fin :</label>
            <input type="date" name="eventEndDate" id="eventEndDate" value="<?= $selectedEvent[0]['eventEndDate'] ?>">
        </span>

        <span>
            <label for="eventStartTime"> Heure de début :</label>
            <input type="time" name="eventStartTime" id="eventStartTime" value="<?= $selectedEvent[0]['eventStartTime'] ?>">
        </span>

        <span>
            <label for="eventEndTime"> Heure de fin :</label>
            <input type="time" name="eventEndTime" id="eventEndTime" value="<?= $selectedEvent[0]['eventEndTime'] ?>">
        </span>

        <ul>
            <li>
                <input type="checkbox" checked>
                <i></i>
                <h2>Lieux de la mission </h2>
                <span>
                    <!-- WORKSITES -->
                    <div class="scrollTableContainer">
                        <table class="listContant">
                            <thead>
                                <tr>
                                    <th scope="col"> Nom du lieux </th>
                                    <th scope="col"> Adresse </th>
                                    <th scope="col"> Ajouter </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    foreach($workSites as $workSite):?>
                                    <tr class="employeeObject">
                                        <td> <?= InputSecurity::displayWithFormat($workSite['worksiteName'], "LastName") ?> </td>
                                        <td> <?= InputSecurity::displayWithFormat($workSite['worksiteAddress']) ?> </td>
                                        <td class="columnForButton"> 
                                            <input type="radio" name="addWorksite" id="addWorksite" value="<?= $workSite['worksiteId'] ?>" require>
                                            <label for="addWorksite"> <i class="icon-user-edit"></i> </label>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </span>
            </li>
            <li>
                <input type="checkbox" checked>
                <i></i>
                <h2>Employés de la mission</h2>
                <span>
                    <!-- EMPLOYEES -->
                    <div class="scrollTableContainer">
                        <table class="listContant">
                            <thead>
                                <tr>
                                    <th scope="col"> Image</th>
                                    <th scope="col"> Nom </th>
                                    <th scope="col"> Prénom </th>
                                    <th scope="col"> Poste </th>
                                    <th scope="col"> supprimer </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($eventDetails as $eventDetail): $employee = $event->getEmployee($eventDetail['userId']);?>
                                    <tr class="employeeObject">
                                        <td scope="row"> <img src="<?= $employee->userPicture ?>" alt="image de l'employé"> </td>
                                        <td> <?= InputSecurity::displayWithFormat($employee[0]['userLastName'] , "LastName") ?> </td>
                                        <td> <?= InputSecurity::displayWithFormat($employee[0]['userFirstName'] , "FirstName") ?> </td>
                                        <td> <?= InputSecurity::displayWithFormat($employee[0]['userPosition'] , "Position") ?> </td>
                                        <td class="columnForButton"> 
                                            <input type="checkbox" name="addEmployee[]" id="addEmployee" value="<?= $employee['userId']?>">
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
                <input type="checkbox" checked>
                <i></i>
                <h2>Véhicules de la mission</h2>
                <span>
                    <!-- VEHICLES -->
                    <div class="scrollTableContainer">
                        <table class="listContant">
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
                                <?php foreach($eventDetails as $eventDetail): $vehicle = $event->getVehicles($eventDetail['vehicle']);?>
                                    <tr class="employeeObject">
                                        <td> <?= InputSecurity::displayWithFormat($vehicle[0]['vehicleLicensePlate'], "LastName") ?> </td>
                                        <td> <?= InputSecurity::displayWithFormat($vehicle[0]['vehicleModel']) ?> </td>
                                        <td> <?= InputSecurity::displayWithFormat($vehicle[0]['vehicleMaxPassenger']) ?> </td>
                                        <td> <?= InputSecurity::displayWithFormat($vehicle[0]['vehicleDriverLicense'], "LastName") ?> </td>
                                        <td class="columnForButton"> 
                                            <input type="checkbox" name="addVehicle[]" id="addVehicle" value="<?= $vehicle['vehicleLicensePlate'] ?>">
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
                <input type="checkbox" checked>
                <i></i>
                <h2>Matériel de la mission</h2>
                <span>
                    <!-- MATERIAL -->
                    <div class="scrollTableContainer">
                        <table class="listContant">
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
                                <?php foreach($eventDetails as $eventDetail): $material = $event->getMaterial($eventDetail['equipment'])?>
                                    <tr class="employeeObject">
                                        <td> <?= InputSecurity::displayWithFormat($material[0]['equipmentName'], "LastName") ?> </td>
                                        <td> <?= InputSecurity::displayWithFormat($material[0]['equipmentTotalQuantity']) ?> </td>
                                        <td> <?= InputSecurity::displayWithFormat($material[0]['equipmentAvailableQuantity']) ?> </td>
                                        <td> <input type="number" name="materialQuantity[]" id="materialQuantity"> </td>
                                        <td class="columnForButton"> 
                                            <input type="checkbox" name="addMaterial[]" id="addMaterial" value="<?= $material['equipmentName'] ?>">
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

        <span>
            <input type="submit" value="mettre à jour la mission" class="validateButton">
            <input type="button" value="Annuler l'ajout" class="validateButton">
        </span>

    </form>
</div>