<?php
/**
 * Gwendal
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
<<<<<<< HEAD
try{
    $PDO = new PDO('mysql:host=iutbg-lamp.univ-lyon1.fr:3306;dbname=p2107521' , 'p2107521' , '12107521');
=======
// try{
//     $PDO = new PDO('mysql:host=iutbg-lamp.univ-lyon1.fr:3306;dbname=p2107521' , 'p2107521' , '12107521');
//     $PDO->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
//     $PDO->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE , PDO::FETCH_OBJ);
// }
// catch(PDOException $e){
//     echo "Error : " . $e->getMessage();
// }

/**
 * PC Nikola
 */
// try{
//     $PDO = new PDO('mysql:host=localhost:3306;dbname=bdsite' , 'root' , 'root');
//     $PDO->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
//     $PDO->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE , PDO::FETCH_OBJ);
// }
// catch(PDOException $e){
//     echo "Error : " . $e->getMessage();
// }

try{
    $PDO = new PDO('mysql:host=iutbg-lamp.univ-lyon1.fr:3306;dbname=p2101430' , 'p2101430' , '12101430');
>>>>>>> Nikola
    $PDO->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
    $PDO->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE , PDO::FETCH_OBJ);
}
catch(PDOException $e){
    echo "Error : " . $e->getMessage();
<<<<<<< HEAD
}

/**
 * PC Nikola
 */
// try{
//     $PDO = new PDO('mysql:host=localhost:3306;dbname=bdsite' , 'root' , 'root');
//     $PDO->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
//     $PDO->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE , PDO::FETCH_OBJ);
// }
// catch(PDOException $e){
//     echo "Error : " . $e->getMessage();
// }

=======
}
>>>>>>> Nikola
