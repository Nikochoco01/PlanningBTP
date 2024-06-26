<?php
$testMaterialName = InputSecurity::validateWithoutNumber($_POST['addMaterialName'], $materialName);
$testMaterialNumberAvailable = InputSecurity::validateWithoutLetter($_POST['addMaterialNumberAvailable'], $materialNumberAvailable);
$testMaterialNumberTotal = InputSecurity::validateWithoutLetter($_POST['addMaterialNumberTotal'], $materialNumberTotal);
$testTokenForm = InputSecurity::isEmpty($_POST['token'], $tokenForm);
$testTokenSession = InputSecurity::isEmpty($_SESSION['token'], $tokenSession);

$materialId = $_POST['materialId'];

if ($testMaterialName && $testMaterialNumberAvailable && $testMaterialNumberTotal && !$testTokenForm && !$testTokenSession ) {
    if($tokenForm == $tokenSession){
        $goToEvent = $dataBase->read(
                "UsedEquipment",
                [
                    "conditions" => ["equipmentId" => $materialId],
                    "fields" => ['eventId']
                ]
            );
    
            foreach ($goToEvent as $event) {
                $dataBase->delete("UsedEquipment" ,"equipmentId" , $materialId );
            }
    
            $dataBase->delete("Equipment" , "equipmentId" , $materialId);
    }
} else {
    InputSecurity::returnError("Un des champs ne correspond pas aux demandes du formulaire");
}
unset($_SESSION['token']);
header("Location:/tool?onglet=material&display=view");
exit();