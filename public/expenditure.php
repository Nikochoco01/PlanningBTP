<?php session_start();
    include_once dirname(__FILE__,2)."/private/class/URLManagementClass.php";   
    include_once dirname(__FILE__,2)."/private/class/InputSecurityClass.php";   
    include_once dirname(__FILE__,2)."/private/dataBase/dataBaseConnection.php";
    include_once dirname(__FILE__,2)."/Modules/tokenGenerator.php";

    $_SESSION['token'] = generateToken(10);
?>
<!DOCTYPE html>
<html lang="fr">
<?php 
$title = "Frais";
include_once dirname(__FILE__,2)."/private/constant/page/head.php";
?>

<body>
    <?php include_once dirname(__FILE__,2)."/private/constant/page/header.php"; ?>

    <div class="layout">
        <?php include_once dirname(__FILE__,2)."/private/constant/page/aside.php"; ?>
        <main>
            
            <div class="invoiceList">
                <?php 
                    include_once dirname(__FILE__,2)."/Modules/classGwendal/expenditureList.php"; 
                ?>
            </div>

            <form action="Modules/classGwendal/newExpenditure.php" method="post">

                <label for="worksite"> Chantier </label>
                <select name="worksite" id="worksite" list="worksites">
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
                <input type="text" name="description" id="description" list="expensesType">
                <datalist id="expensesType">
                    <option> Essence </option>
                    <option> Restaurant </option>
                    <option> Autoroute </option>
                    <option> Hotel </option>
                    <!-- <option></option>
                    <option></option>
                    <option></option> -->
                </datalist>
                <label for="event"> Mission associé à la dépense </label>
                <select name="event" id="event" list="expencesEvent">
                    <option value="" worksite="">-- Choix de la mission --</option>
                    <?php
                        $now = Date("Y-m-d");
                        $stat = $PDO->prepare("select eventId, eventDescription, worksiteId from Event where eventEndDate > \"$now\" && eventStartDate < \"$now\";");
                        $stat->execute();
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
        </main>
    </div>
</body>
<script src="js/expenses.js"></script>
</html>