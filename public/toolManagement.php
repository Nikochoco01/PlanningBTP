<?php 
    session_start();
    include_once dirname(__FILE__,2)."/private/class/InputSecurityClass.php";   
    include_once dirname(__FILE__,2)."/private/dataBase/dataBaseConnection.php";
    include_once dirname(__FILE__,2). "/private/constant/constant.php";

    $_SESSION['token'] = InputSecurity::generateToken(10);
?>

<!DOCTYPE html>
<html lang="fr">

<?php $title = "Matériel";
include_once dirname(__FILE__,2)."/private/constant/page/head.php";
?>

<body>
    <?php include_once dirname(__FILE__,2)."/private/constant/page/header.php"; ?>

    <div class="layout">
        <?php include_once dirname(__FILE__,2)."/private/constant/page/aside.php"; ?>

        <main>

            <div class="materialList">
                <?php 
                    include_once dirname(__FILE__,2)."/Modules/classGwendal/toolList.php"; 
                ?>
            </div>

            <form action="../Modules/classGwendal/newTool.php" method="post">
                <label for="designation">Nom de l'équipement</label>
                <input type="text" name="designation" id="designation">

                <label for="total">Quantité du nouvelle équipement</label>
                <input type="number" name="total" id="total" min="0" max="2000000000" step="1">

                <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>">

                <button type="submit">Valider</button>
                <button type="reset">Annuler</button>
            </form>

        </main>
    </div>
</body>
</html>