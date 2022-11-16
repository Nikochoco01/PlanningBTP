<?php 
// try{
//     $PDO = new PDO('mysql:host=iutbg-lamp.lyon1.fr ; dbname=p2101430' , 'p2101430' , '12101430');
//     $PDO->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
//     echo "Connexion réussie";
// }
// catch(PDOException $e){
//     echo "Errreur : " . $e->getMessage();
// }


try{
    $PDO = new PDO('mysql:host=iutbg-lamp.univ-lyon1.fr:3306;dbname=p2103916' , 'p2103916' , '12103916');
    $PDO->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
    $PDO->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE , PDO::FETCH_OBJ);
    //echo "Connexion réussie"."\n";
}
catch(PDOException $e){
    echo "Errreur : " . $e->getMessage();
}
?>