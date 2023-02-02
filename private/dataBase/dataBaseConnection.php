<?php
/**
 * PC Gwendal
 */
// try{
//     $PDO = new PDO('mysql:host=iutbg-lamp.univ-lyon1.fr:3306;dbname=p2103916' , 'p2103916' , '12103916');
//     $PDO->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
//     $PDO->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE , PDO::FETCH_OBJ);
// }
// catch(PDOException $e){
//     echo "Error : " . $e->getMessage();
// }

/**
 * PC Bruno
 */
// try{
//     $PDO = new PDO('mysql:host=iutbg-lamp.univ-lyon1.fr:3306;dbname=p2107521' , 'p2107521' , '12107521');
//     $PDO->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
//     $PDO->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE , PDO::FETCH_OBJ);
// }
// catch(PDOException $e){
//     echo "Error : " . $e->getMessage();
// }

/**
 * PC NIKO
 */
try{
    $PDO = new PDO('mysql:host=localhost:3306;dbname=bdsite' , 'root' , 'root');
    $PDO->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
    $PDO->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE , PDO::FETCH_OBJ);
}
catch(PDOException $e){
    echo "Error : " . $e->getMessage();
}
?>