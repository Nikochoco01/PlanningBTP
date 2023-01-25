<?php 
    session_start();
<<<<<<< HEAD
    include_once dirname(__FILE__,2)."/private/class/InputSecurityClass.php";   
    include_once dirname(__FILE__,2)."/private/dataBase/dataBaseConnection.php";
    include_once dirname(__FILE__,2). "/private/constant/constant.php";
    include_once dirname(__FILE__,2)."/private/dataBase/dataBaseConnection.php";

    $_SESSION['token'] = InputSecurity::generateToken(10);
=======
    include_once dirname(__FILE__,2). "/private/class/URLManagementClass.php";
    include_once dirname(__FILE__,2). "/private/dataBase/dataBaseConnection.php";
    include_once dirname(__FILE__,2). "/private/constant/constant.php"
    // include_once dirname(__FILE__)."/Modules/classGwendal/materialClass.php"; 
    // include_once dirname(__FILE__)."/Modules/tokenGenerator.php";

    // $_SESSION['token'] = generateToken(10);
>>>>>>> fusionFinal
?>

<!DOCTYPE html>
<html lang="fr">

<?php $title = "Matériel";
$rightToModify = $_SESSION['userFonction'] == 'administrator' || $_SESSION['userFonction'] == 'materialManager';
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

            <?php if($rightToModify): ?>
                <form action="../Modules/classGwendal/newTool.php" method="post">
                    <label for="designation">Nom de l'équipement</label>
                    <input type="text" name="designation" id="designation" required>

                    <label for="total">Quantité du nouvelle équipement</label>
                    <input type="number" name="total" id="total" min="0" max="2000000000" step="1" required>

                    <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>">

                    <button type="submit">Valider</button>
                    <button type="reset">Annuler</button>
                </form>

                <?php 
                $stat = $PDO->prepare("select equipmentName from Equipment");
                $stat->execute();
                $results = $stat->fetchAll();
                if(!empty($results)):?>
                    <form action="../private/treatment/toolProcess/RemoveToolProcess.php" method="post">
                        <label for="designation">Nom de l'équipement</label>
                        <select name="designation" id="des" required>
                            <?php foreach($results as $res):?>
                                <option><?= $res->equipmentName ?></option>
                            <?php endforeach;?>
                        </select>

                        <label for="rmv">Nombre à enlever au stock</label>
                        <input type="number" name="rmv" id="rmv" min="0" required>

                        <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>">

                        <button type="submit">Valider</button>
                        <button type="submit">Annuler</button>
                    </form>
                <?php endif; ?>
            <?php endif;?>
        </main>
    </div>
</body>
</html>