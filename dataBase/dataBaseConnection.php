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
    $PDO = new PDO('mysql:host=localhost:3306;dbname=bdsite' , 'root' , 'root');
    $PDO->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
    //echo "Connexion réussie"."\n";
}
catch(PDOException $e){
    echo "Errreur : " . $e->getMessage();
}
    // $request = 'select * from user where name="chevalliot";';

    // foreach($PDO->query($request) as $user){
    //     echo $user['idUser']."\n";
    //     echo $user['name']."\n";
    //     echo $user['surname']."\n";
    //     echo $user['profilePicture']."\n";
    //     echo $user['phoneNumber']."\n";
    //     echo $user['position']."\n";
    //     echo $user['userRole']."\n";
    //     echo $user['mail']."\n";
    // }


?>