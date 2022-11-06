<?php 
    require 'PlanningClass/Month.php';
    $month = new Month($_GET['month'] ?? null, $_GET['year'] ?? null);
    $firstDay = $month->getFirstDay()->modify('last monday');
?>
<div class="tab" >
    <div class="tabHeader">
        <h2> <?php echo $month->toString(); ?> </h2>
        <div class="changeButtonContent">
            <a href="<?= addUrlParam(array('month'=>$month->previousMonth()->month ,'year'=>$month->previousMonth()->year))?> " class="changeMonth"> <i class="icon-arrowLeft"></i> </a>
            <a href="<?= addUrlParam(array('month'=>date('m') ,'year'=>date('Y')))?>" class="currentMonth"> <i class="icon-loop" ></i> </a>
            <a href="<?= addUrlParam(array('month'=>$month->nextMonth()->month ,'year'=>$month->nextMonth()->year))?> " class="changeMonth"> <i class="icon-arrowRight"></i> </a>
        </div>
    </div>

    <table class="calendarTable calendarTable<?php echo $month->getWeeks();?>weeks">
        <tr> 
            <th> Lundi </th>
            <th> Mardi </th>
            <th> Mercredi </th>
            <th> Jeudi </th>
            <th> Vendredi</th>
            <th> Samedi </th>
            <th> Dimanche </th> 
        </tr>
        <?php for($i = 0 ; $i < $month->getWeeks(); $i++): ?>
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