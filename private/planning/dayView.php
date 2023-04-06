<?php 
    $event = new Events($dataBase);
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


<div class="profil-container bg-color-gray">
    <div class="profil-container-header">
        <div class="profil-link-container width-50">
            <a href="<?= URLManagement::addUrlParam(array('display'=>'add')) ?>" class="btn-link width-50px height-50px border-rad-10 bg-color-orange hover-color-gray text-color-gray font-1-5-em"> <i class="icon-user-plus-bottom"></i> </a>
            <a href="<?=$_SERVER["PATH_INFO"]?>?onglet=<?= PARAM_EMPLOYEE_ONGLET ?>&display=<?= PARAM_VIEW_DISPLAY?>" class="btn-link width-50px height-50px border-rad-10 bg-color-orange hover-color-gray text-color-gray font-1-5-em"> <i class="icon-rotate"></i> </a>
        </div>

        <div class="profil-link-container text-color-white width-50">
            <h2> <?= $month->toStringDay(); ?> </h2>
        </div>

        <div class="profil-link-container width-30">
            <a href="<?= URLManagement::addUrlParam(array('month'=>$month->previousDay()->month ,'year'=>$month->previousDay()->year , 'week'=>$month->previousDay()->week , 'day'=>$month->previousDay()->day))?>" class="btn-link width-50px height-50px border-rad-10 bg-color-orange hover-color-gray text-color-gray font-1-5-em"> <i class="icon-angle-left"></i> </a>
            <a href="<?= URLManagement::addUrlParam(array('month'=>$month->nextDay()->month ,'year'=>$month->nextDay()->year , 'week'=>$month->nextDay()->week , 'day'=>$month->nextDay()->day))?>" class="btn-link width-50px height-50px border-rad-10 bg-color-orange hover-color-gray text-color-gray font-1-5-em"> <i class="icon-angle-right"></i> </a>
        </div>

        <div class="profil-link-container width-70">
            <a href="<?= URLManagement::addUrlParam(array('month'=>date('m') ,'year'=>date('Y') , 'week'=>$month->getCurrentWeek()))?>" class="btn-link width-100 height-50px border-rad-10 bg-color-orange hover-color-gray text-color-gray font-1-5-em">Aujourd’hui</a>
            <a href="<?= URLManagement::addUrlParam(array('display'=>'day' , 'day'=>date('d'))) ?>" class="btn-link width-50 height-50px border-rad-10 bg-color-orange hover-color-gray text-color-gray font-1-5-em"> Jour </a>
            <a href="<?= URLManagement::addUrlParam(array('display'=>'week' , 'week'=>$month->getCurrentWeek())) ?>" class="btn-link width-100 height-50px border-rad-10 bg-color-orange hover-color-gray text-color-gray font-1-5-em"> Semaine </a>
            <a href="<?= URLManagement::addUrlParam(array('display'=>'month')) ?>" class="btn-link width-50 height-50px border-rad-10 bg-color-orange hover-color-gray text-color-gray font-1-5-em"> Mois </a>
        </div>

    </div>

    <div class="table-container">
        <table class="table">
            <thead class="table-header bg-color-orange text-color-gray">
                <tr>
                    <th> Matin </th>
                    <th> Après-midi </th>
                </tr>
            </thead>
            <tbody class="table-body">
                <tr class="table-cell-calendar text-color-white height-94">
                    <td class="table-border">
                        <div class="event-container height-94">
                            <?php
                                $eventsForDay = $events[$date->format($formatDate)] ?? [];
                                foreach($eventsForDay as $event): 
                                if($event->eventStartTime >= '00:00:00' && $event->eventStartTime <= '12:59:59'):
                            ?>
                            <?php 
                                foreach($eventsForDay as $event){
                                    include dirname(__FILE__)."/calendarEvent.php";
                                }
                            ?>
                            <?php endif; endforeach; ?>
                        </div>
                    </td>

                    <td class="table-border">
                        <div class="event-container height-94">
                            <?php
                                $eventsForDay = $events[$date->format($formatDate)] ?? [];
                                foreach($eventsForDay as $event): 
                                if($event->eventStartTime >= '13:00:00' && $event->eventStartTime <= '23:59:59'):
                            ?>
                            <?php 
                                foreach($eventsForDay as $event){
                                    include dirname(__FILE__)."/calendarEvent.php";
                                }
                            ?>
                            <?php endif; endforeach; ?>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>



















