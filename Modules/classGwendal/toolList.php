<?php
$stat = $PDO->prepare("SELECT * FROM Equipment");
$stat->execute();
$results = $stat->fetchAll();
foreach($results as $res):?>
    <form class="material" action="../Modules/classGwendal/delete.php" method="post">
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