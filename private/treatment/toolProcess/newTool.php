<?php

if( InputSecurity::validateWithoutNumber($_POST['designation'], $designation)
    && InputSecurity::validateWithoutLetter($_POST['total'], $total)
    && !InputSecurity::isEmpty($_POST['token'], $token)
    && !InputSecurity::isEmpty($_SESSION['token'], $sessionToken)){
        if($token == $sessionToken){
            if(!$db->getOne('Equipment', ['conditions' => ['equipmentName' => $designation]])){
                $db->add('Equipment', 
                    [
                        'equipmentName' => $designation,
                        'equipmentTotalQuantity' => $total,
                        'equipmentAvailableQuantity' => $total
                    ]
                );
            }
            else{
                $db->updateBtp('Equipment',
                    [
                        'equipmentTotalQuantity' => 
                            [
                                'val' => 'equipmentTotalQuantity + ' . $total,
                                'type' => Database::FORMAT_NUMBER
                            ],
                        'equipmentAvailableQuantity' => 
                            [
                                'val' => 'equipmentAvailableQuantity + ' . $total,
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
        die();
        unset($_SESSION['token']);
        header("Location:".$_SERVER['HTTP_REFERER']);
}
else{
    header("Location:/tool");
}