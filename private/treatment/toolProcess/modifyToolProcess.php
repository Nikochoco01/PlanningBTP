<?php
$testMaterialName = InputSecurity::validateWithoutNumber($_POST['addMaterialName'], $materialName);
$testMaterialNumberAvailable = InputSecurity::validateWithoutLetter($_POST['addMaterialNumberAvailable'], $materialNumberAvailable);
$testMaterialNumberTotal = InputSecurity::validateWithoutLetter($_POST['addMaterialNumberTotal'], $materialNumberTotal);
$testTokenForm = InputSecurity::isEmpty($_POST['token'], $tokenForm);
$testTokenSession = InputSecurity::isEmpty($_SESSION['token'], $tokenSession);

$materialId = $_POST['materialId'];

if ($testMaterialName && $testMaterialNumberAvailable && $testMaterialNumberTotal && !$testTokenForm && !$testTokenSession ) {
    if($tokenForm == $tokenSession){
            $results = $dataBase->save("Equipment",[
                "equipmentId" => $materialId,
                "equipmentName" => $materialName,
                "equipmentAvailableQuantity" => $materialNumberAvailable,
                "equipmentTotalQuantity" => $materialNumberTotal
            ],"equipmentId");
    }
} else {
    if($materialNumberTotal == null){
        InputSecurity::returnError("Le nombre de matériel ne peut être de 0 , supprimer le matériel");
    }
    else{
        InputSecurity::returnError("Un des champs ne correspond pas aux demandes du formulaire");
    }
}
unset($_SESSION['token']);
header("Location:/tool?onglet=material&display=view");
exit();