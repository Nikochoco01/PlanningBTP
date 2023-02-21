<?php

if(InputSecurity::validateWithoutNumber($_POST["designation"] , $designation) 
    && InputSecurity::validateWithoutLetter($_POST["rmv"] , $removeQuantity) 
    && !InputSecurity::isEmpty($_POST["token"] , $token) 
    && !InputSecurity::isEmpty($_SESSION["token"] , $sessionToken)){
        if($_POST["token"] == $sessionToken){
                $res = $dataBase->read("Equipment",
                        [
                                'fields' => ['equipmentTotalQuantity', 'equipmentAvailableQuantity'],
                                'conditions' => ['equipmentName' => $designation]
                        ]
                );
                if($res->equipmentAvailableQuantity > $removeQuantity){
                        $dataBase->updateBtp('Equipment', 
                                [
                                        'equipmentTotalQuantity' => 
                                        [
                                                'val' => "equipmentTotalQuantity - " . $removeQuantity,
                                                'type' => Database::FORMAT_NUMBER
                                        ],
                                        'equipmentAvailableQuantity' =>
                                        [
                                                'val' => "equipmentAvailableQuantity - " . $removeQuantity,
                                                'type' => Database::FORMAT_NUMBER
                                        ]
                                ],
                                [
                                        'equipmentName' => 
                                        [
                                                'val' => $designation,
                                                'type' => Database::FORMAT_STRING
                                        ]
                                ]
                        );
                }
                else{
                        $dataBase->updateBtp('Equipment', 
                                [
                                        'equipmentTotalQuantity' => 
                                        [
                                                'val' => "equipmentTotalQuantity - " . $res->equipmentAvailableQuantity,
                                                'type' => Database::FORMAT_NUMBER
                                        ],
                                        'equipmentAvailableQuantity' =>
                                        [
                                                'val' => "equipmentAvailableQuantity - " . $res->equipmentAvailableQuantity,
                                                'type' => Database::FORMAT_NUMBER
                                        ]
                                ],
                                [
                                        'equipmentName' => 
                                        [
                                                'val' => $designation,
                                                'type' => Database::FORMAT_STRING
                                        ]
                                ]
                        );
                }
        }
        unset($_SESSION['token']);
        header("Location:".$_SERVER['HTTP_REFERER']);
}
else{
        header("Location:/tool");
}