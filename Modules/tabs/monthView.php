<?php 
    require 'PlanningClass/Month.php';
    require 'PlanningClass/Events.php';
    include_once dirname(__FILE__,3)."/dataBase/dataBaseConnection.php";

    $event = new Events($PDO);
    $month = new Month($_GET['month'] ?? null, $_GET['year'] ?? null , $_GET['week'] ?? null);
    $weeks = $month->getWeeks();
    $firstDay = $month->getFirstDay();
    $firstDay = $firstDay->format('N') === '1' ? $firstDay : $month->getFirstDay()->modify('last monday');
    
    $lastDay = $firstDay->modify('+' . (6 + 7 * ($weeks - 1)) . 'days');
    $events = $event->getEventBetweenByDay($firstDay , $lastDay);

    // echo "<pre>";
    //     print_r($events);
    // echo "</pre";
?>

<div class="tab" >
    <div class="tabHeader">
        <div class="zoneAddEvent">
            
            <input type="checkbox" name="buttonAddEvent" id="buttonAddEvent" class="buttonAddEvent">
            <label for="buttonAddEvent" class="buttonLabel" id="buttonLabel"> <i id="iButtonLabel" class="icon-calendar-plus-alt"></i></label>
            <label for="buttonAddEvent" class="indicator"> Ajouter une mission</label>

            <div class="popupAddEvent">
                <form action="/Modules/popupProcess/addEvent.php" method="post">

                    <span>
                        <label for="eventLocation"> Lieu :</label>
                        <select name="eventLocation" id="eventLocation">
                            <option value="1"> 1 </option>
                        </select>
                    </span>

                    <span>
                        <label for="eventDescription"> Description :</label>
                        <input type="text" name="eventDescription" id="eventDescription">
                    </span>
                    <span>
                        <label for="eventDate"> Date de début :</label>
                        <input type="date" name="eventDate" id="eventDate">
                    </span>
                    <span>
                        <label for="eventDate"> Date de fin :</label>
                        <input type="date" name="eventDate" id="eventDate">
                    </span>
                    <span>
                        <label for="eventStartTime"> Heure de début :</label>
                        <input type="datetime-local" name="eventStartTime" id="eventStartTime">
                    </span>
                    <span>
                        <label for="eventEndTime"> Heure de fin :</label>
                        <input type="datetime-local" name="eventEndTime" id="eventEndTime">
                    </span>
                    <span>
                        <input type="submit" value="Ajouter la mission" class="validateButton">
                        <input type="button" value="Annuler l'ajout" class="validateButton">
                    </span>
                </form>
            </div>
        </div>

        <h2> <?= $month->toString(); ?> </h2>

        <div class="changeButtonContent">
            <a href="<?= addUrlParam(array('month'=>$month->previousMonth()->month ,'year'=>$month->previousMonth()->year))?> " class="changeMonth"> <i class="icon-angle-left"></i> </a>
            <a href="<?= addUrlParam(array('month'=>date('m') ,'year'=>date('Y')))?>" class="currentMonth"> <i class="icon-rotate" ></i> </a>
            <a href="<?= addUrlParam(array('month'=>$month->nextMonth()->month ,'year'=>$month->nextMonth()->year))?> " class="changeMonth"> <i class="icon-angle-right"></i> </a>
        </div>
    </div>

    <table class="calendarTable calendarTable<?php echo $weeks?>weeks">
        <tr> 
            <?php foreach($month->days as $dayNumber => $day):?>
                <th> <?= $day ?> </th>
            <?php endforeach?>
        </tr>
        <?php for($i = 0 ; $i < $weeks; $i++): ?>
            <tr>
                <?php foreach($month->days as $dayNumber => $day): 
                        $date = $firstDay->modify("+".($dayNumber + $i*7). "days");
                        $eventsForDay = $events[$date->format('Y-m-d')] ?? [];
                        
                        // if($day == "Dimanche"){
                        //     echo "c'est dimanche donc on met lundi \n";
                        //     echo $dayNumber = 0;
                        // }
                ?>
                    <!-- include the calendarBox to display all days -->
                    <?php include dirname(__FILE__,1)."/planningClass/boxCalendar.php";?>
                <?php endforeach; ?>
            </tr>
        <?php endfor; ?>
    </table>
</div>