<?php
    include_once dirname(__FILE__,2)."/private/class/InputSecurityClass.php";   
    include_once dirname(__FILE__,2)."/private/dataBase/dataBaseConnection.php";
    include_once dirname(__FILE__,2). "/private/constant/constant.php";
    include_once dirname(__FILE__,2)."/private/dataBase/dataBaseConnection.php";

    $_SESSION['token'] = InputSecurity::generateToken(10);
    $title = TITLE_PAGE_COST;
?>

<!DOCTYPE html>
<html lang="fr">

<?php include_once dirname(__FILE__,2)."/private/constant/page/head.php";?>


<body>
    <div class="layout">
        <?php include_once dirname(__FILE__,2). "/private/constant/page/header.php" ?>
        <?php include_once dirname(__FILE__,2). "/private/constant/page/aside.php" ?>
        <main>
            <div class="expenditureContainer">

                <div class="invoiceList">
                    <?php     
                        $stat = $PDO->prepare("select e.expenseId, e.expenseDate, e.expenseAmount, e.expenseDescription, w.worksiteName, v.eventDescription from Expense e join Worksite w on e.worksiteId = w.worksiteId join Event v on e.eventId = v.eventId where userId = :user order by e.expenseId");
                        $stat->execute(['user' => $_SESSION['userId']]);
                        $results = $stat->fetchAll();
                        foreach($results as $res):?>
                            <form class="expense" action="/delete" method="post">
                                <input type="hidden" name="id" value="<?= $res->expenseId ?>">
                                <p> Liex : <?= $res->worksiteName ?></p>
                                <p> Mission : <?= $res->eventDescription ?></p>
                                <p> Raison : <?= $res->expenseDescription ?></p>
                                <p> Date : <?= explode(" ", $res->expenseDate)[0] ?></p>
                                <p> Montant : <?= number_format($res->expenseAmount, 2, ".", " ")."€" ?></p>
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
                        $stat = $PDO->prepare("select worksiteId, worksiteName from Worksite;");
                            
                        $stat->execute();
                        $results = $stat->fetchAll();
                        foreach($results as $res):?>
                            <option value="<?= $res->worksiteId ?>"> <?= $res->worksiteName ?>
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
                        $stat = $PDO->prepare("select eventId, eventDescription, worksiteId from Event where eventEndDate >= :now && eventStartDate <= :now");
                        $stat->execute(["now" => $now]);
                        $results = $stat->fetchAll();
                        foreach($results as $res):?>
                            <option value="<?= $res->eventId ?>" worksite="<?= $res->worksiteId ?>"><?= $res->eventDescription ?>
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