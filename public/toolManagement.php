<?php
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
                        $results = $dataBase->read('Equipment');
                        foreach($results as $res):?>
                            <form class="material" action="/deleteTool" method="post">
                                <label for="id"> Nom </label>
                                <input type="text" name="id" value="<?= InputSecurity::displayWithFormat($res->equipmentName, "uppercaseFirstLetter") ?>" readonly>
                                
                                <p> Total : <?= $res->equipmentTotalQuantity ?></p>
                                
                                <p> Disponible : <?= $res->equipmentAvailableQuantity ?></p>
                                
                                <input type="hidden" name="token" value="<?= $_SESSION["token"] ?>">
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
                        $results = $dataBase->read('Equipment', ['fields' => ['equipmentName']]);
                        if(!empty($results)):?>
                            <form action="/rmvTool" method="post" class="formRemoveMaterial">
                                <label for="designation">Nom de l'équipement</label>
                                <select name="designation" id="des" required>
                                    <?php foreach($results as $res):?>
                                        <option><?= InputSecurity::displayWithFormat($res->equipmentName, "uppercaseFirstLetter") ?></option>
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