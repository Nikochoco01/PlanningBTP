<?php 
    $_SESSION['token'] = InputSecurity::generateToken(10);
    $title = TITLE_PAGE_COST;
?>

<!DOCTYPE html>
<html lang="fr">

<?php include_once APP . "private/constant/page/head.php";?>

<body>
    <div class="container">
        <?php include_once APP . "private/constant/page/header.php" ?>
        <?php include_once APP . "private/constant/page/aside.php" ?>
        <main class="container-main">
            <div class="expenditureContainer">

                <div class="invoiceList">
                    <?php
                        $results = $dataBase->read("Expense e join Worksite w on e.worksiteId = w.worksiteId join Event v on e.eventId = v.eventId",[
                            "conditions" => ["userId" => $_SESSION['userId']],
                            "fields" => ["e.expenseId, e.expenseDate, e.expenseAmount, e.expenseDescription, w.worksiteName, v.eventDescription"],
                            "order" => ["e.expenseId"]
                        ]);

                        // $stat = $PDO->prepare("select e.expenseId, e.expenseDate, e.expenseAmount, e.expenseDescription, w.worksiteName, v.eventDescription from Expense e join Worksite w on e.worksiteId = w.worksiteId join Event v on e.eventId = v.eventId where userId = :user order by e.expenseId");
                        // $stat->execute(['user' => $_SESSION['userId']]);
                        // $results = $stat->fetchAll();
                        foreach($results as $result):?>
                            <form class="expense" action="/delete" method="post">
                                <input type="hidden" name="id" value="<?= $result->expenseId ?>">
                                <p> Lieux : <?= $result->worksiteName ?></p>
                                <p> Mission : <?= $result->eventDescription ?></p>
                                <p> Raison : <?= $result->expenseDescription ?></p>
                                <p> Date : <?= explode(" ", $result->expenseDate)[0] ?></p>
                                <p> Montant : <?= number_format($result->expenseAmount, 2, ".", " ")."€" ?></p>
                                <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>">
                                <input type="hidden" name="table" value="Expense">
                                <input type="hidden" name="idName" value="expenseId">
                                <input type="submit" value="Effacer">
                            </form>
                    <?php endforeach; ?>
                </div>

                <form method="post" class="fromAddExpenditure">

                    <label for="worksite"> Chantier </label>
                    <select name="worksite" id="worksite" list="worksites" required>
                        <option value="">-- Choix du chantier --</option>
                        <?php 
                        $results = $dataBase->read("Worksite",[
                            "fields" => ["worksiteId, worksiteName"]
                        ]);

                        foreach($results as $result):?>
                            <option value="<?= $result->worksiteId ?>"> <?= $result->worksiteName ?>
                        <?php endforeach; ?>
                    </select>

                    <label for="description"> Raison de la dépense </label>
                    <input type="text" name="description" id="description" list="expensesType" required>
                    <datalist id="expensesType">
                        <option> Essence </option>
                        <option> Restaurant </option>
                        <option> Autoroute </option>
                        <option> Hotel </option>
                    </datalist>

                    <label for="event"> Mission associé à la dépense </label>
                    <select name="event" id="event" list="expencesEvent" required>
                        <option value="" worksite="">-- Choix de la mission --</option>
                        <?php
                        $now = Date("Y-m-d");
                        // $stat = $PDO->prepare("select eventId, eventDescription, worksiteId from Event where eventEndDate >= :now && eventStartDate <= :now");
                        // $stat->execute(["now" => $now]);
                        // $results = $stat->fetchAll();
                        $results = $dataBase->read("Event", [
                            "conditions" => ["eventEndDate between" => $now],
                            " " => ["eventStartDate" => $now]
                        ]);
                        foreach($results as $result):?>
                            <option value="<?= $result->eventId ?>" worksite="<?= $result->worksiteId ?>"><?= $result->eventDescription ?>
                        <?php endforeach; ?>
                    </select>

                    <label for="price"> Montant </label>
                    <input type="number" name="price" id="price" min="0" max="34000000000000000000000000000000000000" step="0.01">

                    <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>">

                    <span>
                        <input type="submit" value="Valider">
                        <input type="reset" value="Annuler">
                    </span>
                </form>
            </div>
        </main>
    </div>
</body>
<script src="/js/expenses.js"></script>
</html>