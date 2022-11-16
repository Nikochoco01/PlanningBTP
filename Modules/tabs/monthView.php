<?php 
    require 'PlanningClass/Month.php';
    require 'PlanningClass/Events.php';
    $event = new Events();
    $month = new Month($_GET['month'] ?? null, $_GET['year'] ?? null);
    $weeks = $month->getWeeks();
    $firstDay = $month->getFirstDay();
    $firstDay = $firstDay->format('N') === '1' ? $firstDay : $month->getFirstDay()->modify('last monday');
    
    $end = (clone $firstDay)->modify(0 + 5 * ($weeks - 1) . 'days');
    var_dump($end);
    $event = $event->getEventBetween($firstDay , $end); 
?>
<div class="tab" >
    <div class="tabHeader">
        <h2> <?php echo $month->toString(); ?> </h2>
        <div class="changeButtonContent">
            <a href="<?= addUrlParam(array('month'=>$month->previousMonth()->month ,'year'=>$month->previousMonth()->year))?> " class="changeMonth"> <i class="icon-angle-left"></i> </a>
            <a href="<?= addUrlParam(array('month'=>date('m') ,'year'=>date('Y')))?>" class="currentMonth"> <i class="icon-rotate" ></i> </a>
            <a href="<?= addUrlParam(array('month'=>$month->nextMonth()->month ,'year'=>$month->nextMonth()->year))?> " class="changeMonth"> <i class="icon-angle-right"></i> </a>
        </div>
    </div>

    <table class="calendarTable calendarTable<?php echo $weeks?>weeks">
        <tr> 
            <th> Lundi </th>
            <th> Mardi </th>
            <th> Mercredi </th>
            <th> Jeudi </th>
            <th> Vendredi</th>
            <th> Samedi </th>
            <th> Dimanche </th> 
        </tr>
        <?php for($i = 0 ; $i < $weeks; $i++): ?>
            <tr>
                <?php foreach($month->days as $dayNumber => $day): 
                        $date = (clone $firstDay)->modify("+".($dayNumber + $i*7). "days");
                ?>
                    <td class="<?= $month->withinMonth($date) ?'' : 'calendarOtherMonth' ?>">
                        <div class="calendarDayNumber"> 
                            <?= $date->format('d'); ?>
                        </div>
                    </td>
                <?php endforeach; ?>
            </tr>
        <?php endfor; ?>
    </table>
</div>