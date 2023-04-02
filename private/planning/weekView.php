<?php 
    $event = new Events($dataBase);
    $month = new Month($_GET['month'] ?? null, $_GET['year'] ?? null , $_GET['week'] ?? null , $_GET['day'] ?? null);
    $weeks = $month->getWeeks();
    $firstDay = $month->getFirstDay();
    $firstDay = $firstDay->format('N') === '1' ? $firstDay : $month->getFirstDay()->modify('last Monday');

    $lastDay = $firstDay->modify('+' . (6 + 7 * ($weeks - 1)) . 'days');

    InputSecurity::validateWithoutNumber($_GET['onglet'] , $page);
    $events = $event->getEventBetweenByDay($firstDay , $lastDay , $page);
    
    /**
     * Allow to setup the date 
     */
    $date;
    foreach($month->days as $dayNumber => $day){
        $date = $firstDay->modify("+".($dayNumber + $month->setupWeek($month->week)). "day");
    }
?>


<div class="profil-container bg-color-gray">
    <div class="profil-container-header">
        <div class="profil-link-container">
            <a href="<?= URLManagement::addUrlParam(array('display'=>'add')) ?>" class="btn-link width-50px height-50px border-rad-10 bg-color-orange hover-color-gray text-color-gray font-1-5-em"> <i class="icon-user-plus-bottom"></i> </a>
            <a href="<?=$_SERVER["PATH_INFO"]?>?onglet=<?= PARAM_EMPLOYEE_ONGLET ?>&display=<?= PARAM_VIEW_DISPLAY?>" class="btn-link width-50px height-50px border-rad-10 bg-color-orange hover-color-gray text-color-gray font-1-5-em"> <i class="icon-rotate"></i> </a>
        </div>

        <h2> <?= $month->toStringWeek($date); ?> </h2>

        <div class="profil-link-container">
            <a href="<?= URLManagement::addUrlParam(array('month'=>$month->previousWeek()->month ,'year'=>$month->previousWeek()->year , 'week'=>$month->previousWeek()->week))?>" class="btn-link width-50px height-50px border-rad-10 bg-color-orange hover-color-gray text-color-gray font-1-5-em"> <i class="icon-angle-left"></i> </a>
            <a href="<?= URLManagement::addUrlParam(array('month'=>$month->nextWeek()->month ,'year'=>$month->nextWeek()->year , 'week'=>$month->nextWeek()->week))?>" class="btn-link width-50px height-50px border-rad-10 bg-color-orange hover-color-gray text-color-gray font-1-5-em"> <i class="icon-angle-right"></i> </a>
        </div>

        <div class="profil-link-container">
            <a href="<?= URLManagement::addUrlParam(array('month'=>date('m') ,'year'=>date('Y') , 'week'=>$month->getCurrentWeek()))?>" class="btn-link width-100px height-50px border-rad-10 bg-color-orange hover-color-gray text-color-gray font-1-5-em">Aujourd’hui</a>
            <a href="<?= URLManagement::addUrlParam(array('display'=>'day' , 'day'=>date('d'))) ?>" class="btn-link width-100px height-50px border-rad-10 bg-color-orange hover-color-gray text-color-gray font-1-5-em"> Jour </a>
            <a href="<?= URLManagement::addUrlParam(array('display'=>'week' , 'week'=>$month->getCurrentWeek())) ?>" class="btn-link width-100px height-50px border-rad-10 bg-color-orange hover-color-gray text-color-gray font-1-5-em"> Semaine </a>
            <a href="<?= URLManagement::addUrlParam(array('display'=>'month')) ?>" class="btn-link width-100px height-50px border-rad-10 bg-color-orange hover-color-gray text-color-gray font-1-5-em"> Mois </a>
        </div>
    </div>

    <div class="table-container">
        <table class="table">
            <thead class="table-header bg-color-orange text-color-gray">
                <tr>
                <?php foreach($month->days as $dayNumber => $day):?>
                    <th> <?= $day ?> </th>
                <?php endforeach; ?>
                </tr>
            </thead>
            <tbody class="table-body">
                <tr class="table-cell-calendar text-color-white height-94">
                    <?php foreach($month->days as $dayNumber => $day):
                            $date = $firstDay->modify("+".($dayNumber + $month->setupWeek($month->week)). "day");
                            $eventsForDay = $events[$date->format('Y-m-d')] ?? [];
                    ?>
                        <td class="<?= $month->withinMonth($date) ?'' : 'table-cell-not-in-month' ?> table-border">
                            <div class="table-cell-header">
                                <?php if($date->format('Y-m-d') === date('Y-m-d')): ?>
                                    <p class="calendar-day-number color-current-day"> <?= $date->format('d'); ?> </p>
                                <?php 
                                    else : ?>
                                    <p class="calendar-day-number"> <?= $date->format('d'); ?> </p>
                                <?php 
                                    endif 
                                ?>
                                <p class="margin-right-10px">
                                    <?php $eventNumber = 0; foreach($eventsForDay as $event){ $eventNumber++; } ?>
                                    <?php if($eventNumber != 0): ?>
                                        mission : <?= $eventNumber ?>
                                    <?php endif; ?>
                                </p>
                            </div>
                            <div class="event-container height-100">
                                <?php 
                                    foreach($eventsForDay as $event){
                                        include dirname(__FILE__)."/calendarEvent.php";
                                    }
                                ?>
                            </div>
                        </td>
                    <?php endforeach; ?>
                </tr>
            </tbody>
        </table>
    </div>
</div>