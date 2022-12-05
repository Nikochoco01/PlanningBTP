<?php session_start();
    include_once "Modules/config.php";   
    include_once dirname(__FILE__)."/dataBase/dataBaseConnection.php";
    include_once dirname(__FILE__)."/invoiceClass.php"; 
    include_once dirname(__FILE__)."/tokenGenerator.php";

    $_SESSION['token'] = generateToken(10);
?>
<!DOCTYPE html>
<html lang="fr">
<?php $titlePage = "Frais"; ?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/CSS/default.css">
    <link rel="stylesheet" href="/CSS/menu.css">
    <link rel="stylesheet" href="/Icon/style.css">
    <title> <?php echo $titlePage ?> </title>
</head>

<body>
    <?php include_once "Modules/header.php"; ?>

    <div class="layout">
        <?php include_once "Modules/aside.php"; ?>
        <main>
            
            <div class="invoiceList">
                <?php 
                    $stat = $PDO->prepare("select e.expenseId, e.expenseDate, e.expenseAmount, e.expenseDescription, w.worksiteName from Expense e join Worksite w on e.worksiteId = w.worksiteId where userId = :user order by e.expenseId");
                    $stat->execute(['user' => $_SESSION['userName']]);
                    $results = $stat->fetchAll();
                    foreach($results as $res){
                        $in = new Invoice($res->expenseId, $res->expenseDate, $res->expenseAmount, $res->expenseDescription, $res->worksiteName);
                        echo $in->display($_SESSION['token']);
                    }
                ?>
            </div>

            <form action="Modules/newExpensesProcess.php" method="post">

                <label for="worksite"> Chantier </label>
                <input type="search" name="worksite" id="worksite" list="worksites">
                <datalist id="worksites">
                <?php 
                    $stat = $PDO->prepare("select worksiteName from Worksite;");
                    
                    $stat->execute();
                    $results = $stat->fetchAll();
                    foreach($results as $res){
                        echo "<option>". $res->worksiteName;
                    }
                    ?>
                </datalist>

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
                <input type="text" name="event" id="event" list="expencesEvent">
                <datalist id="expencesEvent">
                    <?php
                    $stat = $PDO->prepare("select eventId, eventDescription from Event where eventEndDate > :now && :now < eventStartDate;");
                    $results = $stat->execute(['now' => Date("Y-m-d")]);
                    foreach($results as $res){
                        echo "<option>".$res->eventId." - ".$res->eventDescription;
                    }
                    ?>
                </datalist>

                <label for="price"> Montant </label>
                <input type="number" name="price" id="price" min="0" step="0.01">

                <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>">

                <span>
                    <input type="submit" value="Valider">
                    <input type="reset" value="Annuler">
                </span>
            </form>
<script>
    const hour = document.getElementById("hour");
    const min = document.getElementById("minutes");
    const today = new Date();
    hour.innerText = today.getHours();
    m = today.getMinutes();
    if(m<10){m = '0' + m;}
    min.innerText = m;
</script>
        </main>
    </div>
</body>
</html>