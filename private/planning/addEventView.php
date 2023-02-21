<?php 
        require_once dirname(__FILE__,2). "/class/Events.php";
        $workSites = $event->getWorksite();
        $employees = $event->getEmployee();
        $vehicles = $event->getVehicles();
        $materials = $event->getMaterial();
?>

<div class="addEvent">
    <form method="post">

        <span>
            <label for="eventDescription"> Description :</label>
            <input type="text" name="eventDescription" id="eventDescription" require>
        </span>

        <span>
            <label for="eventStartDate"> Date de début :</label>
            <input type="date" name="eventStartDate" id="eventStartDate" require>
        </span>

        <span>
            <label for="eventEndDate"> Date de fin :</label>
            <input type="date" name="eventEndDate" id="eventEndDate" require>
        </span>

        <span>
            <label for="eventStartTime"> Heure de début :</label>
            <input type="time" name="eventStartTime" id="eventStartTime" require>
        </span>

        <span>
            <label for="eventEndTime"> Heure de fin :</label>
            <input type="time" name="eventEndTime" id="eventEndTime" require>
        </span>

        <ul>
            <li>
                <label for="checkboxDropMission" class="labelDropMenu"> Lieux de la mission </label>
                <input type="checkbox" id="checkboxDropMission" class="checkboxDrop" checked>
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
                                    foreach($workSites as $workSite):?>
                                    <tr class="tableCell">
                                        <td> <?= InputSecurity::displayWithFormat($workSite->worksiteName, "uppercase") ?> </td>
                                        <td> <?= InputSecurity::displayWithFormat($workSite->worksiteAddress) ?> </td>
                                        <td class="columnForButton"> 
                                            <input type="radio" name="addWorksite" id="addWorksite" value="<?= $workSite->worksiteId ?>" require>
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
                <label for="checkboxDropEmployee" class="labelDropMenu"> Employés de la mission </label>
                <input type="checkbox" id="checkboxDropEmployee" class="checkboxDrop" checked>
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
                                    <th scope="col"> Ajouter </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    foreach($employees as $employee):?>
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
                <label for="checkboxDropVehicle" class="labelDropMenu"> Véhicules de la mission </label>
                <input type="checkbox" id="checkboxDropVehicle" class="checkboxDrop" checked>
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
                                    <th scope="col"> Ajouter </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    foreach($vehicles as $vehicle):?>
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
                <label for="checkboxDropMaterial" class="labelDropMenu"> Matériel de la mission </label>
                <input type="checkbox" id="checkboxDropMaterial" class="checkboxDrop" checked>
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
                                    <th scope="col"> Nombre à utiliser </th>
                                    <th scope="col"> Ajouter </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    foreach($materials as $material):?>
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
            <input type="submit" value="Ajouter la mission" class="validateButton">
            <input type="button" value="Annuler l'ajout" class="validateButton">
        </span>
    </form>
</div>