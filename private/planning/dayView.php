<?php
    require_once dirname(__FILE__,2). "/class/Month.php";
    require_once dirname(__FILE__,2). "/class/Events.php";

    $event = new Events($PDO);
    $month = new Month($_GET['month'] ?? null, $_GET['year'] ?? null , $_GET['week'] ?? null , $_GET['day'] ?? null);
    $weeks = $month->getWeeks();
    $firstDay = $month->getFirstDay();
    $firstDay = $firstDay->format('N') === '1' ? $firstDay : $month->getFirstDay()->modify('last Monday');
    
    $lastDay = $firstDay->modify('+' . (6 + 7 * ($weeks - 1)) . 'days');
    $events = $event->getEventBetweenByDay($firstDay , $lastDay , $_GET['onglet']);

    /**
     * Allow to setup the date 
     */
    $date;
    foreach($month->days as $dayNumber => $day){
        $date = $firstDay->modify("+".($dayNumber + $month->setupWeek($month->week)). "day");
    }
    
    $formatDate = 'Y-m-'.$month->formatDayNumber($month->day);
?>

<div class="tab" >
    <div class="tabHeader">
        <div class="leftSide">
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
        </div>

        <div class="middle">
            <h2> <?= $month->toStringDay(); ?> </h2>
        </div>

        <div class="rightSide">
                <div class="navigationPreviousNext">
                    <a href="<?= URLManagement::addUrlParam(array('month'=>$month->previousDay()->month ,'year'=>$month->previousDay()->year , 'week'=>$month->previousDay()->week , 'day'=>$month->previousDay()->day))?> "> <i class="icon-angle-left"></i> </a>
                    <a href="<?= URLManagement::addUrlParam(array('month'=>$month->nextDay()->month ,'year'=>$month->nextDay()->year , 'week'=>$month->nextDay()->week , 'day'=>$month->nextDay()->day))?> "> <i class="icon-angle-right"></i> </a>
                </div>
                <div class="navigationView">
                    <a href="<?= URLManagement::addUrlParam(array('month'=>date('m') ,'year'=>date('Y'), 'day'=>date('d')))?>">Ajourd’hui</a>
                    <a href="<?= URLManagement::addUrlParam(array('display'=>'day' , 'day'=>date('d'))) ?>" class="changeView"> Jour </a>
                    <a href="<?= URLManagement::addUrlParam(array('display'=>'week' , 'week'=>$month->getCurrentWeek())) ?>" class="changeView"> Semaine </a>
                    <a href="<?= URLManagement::addUrlParam(array('display'=>'month')) ?>" class="changeView"> Mois </a>
                </div>
        </div>
    </div>

    <table class="calendarTable">
        <tbody class="calendarBodyDayView">
            <tr>
                <th class="rowName"> Matin </th>
                <?php
                    $eventsForDay = $events[$date->format($formatDate)] ?? [];
                    foreach($eventsForDay as $event): 
                    if($event['eventStartTime'] >= '00:00:00' && $event['eventStartTime'] <= '12:59:59'):
                ?>
                    <td class="eventMorning">
                        <?php include dirname(__FILE__)."/calendarEvent.php"; ?>
                    </td>
                <?php 
                    endif;
                    endforeach 
                ?>
            </tr>
            <tr>
                <th class="rowName"> Après-midi </th>
                <?php
                    $eventsForDay = $events[$date->format($formatDate)] ?? [];
                    foreach($eventsForDay as $event): 
                    if($event['eventStartTime'] >= '13:00:00' && $event['eventStartTime'] <= '23:59:59'):
                ?>
                    <td class="eventAfternoon">
                        <?php include dirname(__FILE__)."/calendarEvent.php"; ?>
                    </td>
                <?php 
                    endif;
                    endforeach 
                ?>
            </tr>
        </tbody>
    </table>
</div>