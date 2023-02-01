<?php
    include_once APP . "private/class/InputSecurityClass.php";   
    include_once APP . "private/dataBase/dataBaseConnection.php";
    include_once APP . "private/constant/constant.php";
    include_once APP . "private/dataBase/dataBaseConnection.php";

    $_SESSION['token'] = InputSecurity::generateToken(10);
?>

<!DOCTYPE html>
<html lang="fr">

<?php $title = "Matériel";
$rightToModify = $_SESSION['userFonction'] == 'administrator' || $_SESSION['userFonction'] == 'materialManager';
include_once APP . "private/constant/page/head.php";
?>

<body>
    <div class="layout">
        <?php include_once APP . "private/constant/page/header.php"; ?>
        <?php include_once APP . "private/constant/page/aside.php"; ?>

        <main>
            <div class="materialContainer">
                <div class="materialList">
                    <?php 
                        $stat = $PDO->prepare("SELECT * FROM Equipment");
                        $stat->execute();
                        $results = $stat->fetchAll();
                        foreach($results as $res):?>
                            <form class="material" action="/delete" method="post">
                                <input type="text" name="id" value="<?= $res->equipmentName ?>" readonly>
                                <p><?= $res->equipmentTotalQuantity ?></p>
                                <p><?= $res->equipmentAvailableQuantity ?></p>
                                <input type="hidden" name="token" value="<?= $_SESSION["token"] ?>">
                                <input type="hidden" name="table" value="Equipment">
                                <input type="hidden" name="idName" value="equipmentName">
                                <?php if($rightToModify):?>
                                    <input type="submit" value="Effacer">
                                <?php endif; ?>
                            </form>
                    <?php endforeach; ?>
                </div>

                <div class="formContainer">
                    <?php if($rightToModify): ?>
                        <form method="post" class="formAddMaterial">
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
                            <form action="rmvTool" method="post" class="formRemoveMaterial">
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
                </div>
            </div>
        </main>
    </div>
</body>
</html>