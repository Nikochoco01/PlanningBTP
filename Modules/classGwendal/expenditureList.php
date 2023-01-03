<?php
include_once dirname(__FILE__)."/dataBase/dataBaseConnection.php";
$stat = $PDO->prepare("select e.expenseId, e.expenseDate, e.expenseAmount, e.expenseDescription, w.worksiteName, v.eventDescription from Expense e join Worksite w on e.worksiteId = w.worksiteId join Event v on e.eventId = v.eventId where userId = :user order by e.expenseId");
$stat->execute(['user' => $_SESSION['userName']]);
$results = $stat->fetchAll();
foreach($results as $res):?>
<form class="expense" action="delete.php" method="post">
    <input type="text" name="id" value="<?= $res->expenseId ?>" readonly>
    <p><?= $res->expenseDescription ?></p>
    <p><?= $res->worksiteName ?></p>
    <p><?= $res->eventDescription ?></p>
    <p><?= explode(" ", $res->expenseDate)[0] ?></p>
    <p><?= number_format($res->expenseAmount, 2, ".", " ")."€" ?></p>
    <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>">
    <input type="hidden" name="table" value="Expense">
    <input type="hidden" name="idName" value="expenseId">
    <input type="submit" value="Effacer">
</form>
<?php endforeach; ?>