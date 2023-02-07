<?php
include_once APP . "private/class/InputSecurityClass.php";
include_once APP . "private/dataBase/dataBaseConnection.php";

if( InputSecurity::validateWithoutLetter($_POST['price'], $price) 
    && InputSecurity::validateWithoutNumber($_POST['description'], $description) 
    && InputSecurity::validateWithoutLetter($_POST['worksite'], $worksite)
    && InputSecurity::validateWithoutLetter($_SESSION['userId'], $userId)
    && InputSecurity::validateWithoutLetter($_POST['event'], $event)  
    && !InputSecurity::isEmpty($_POST['token'], $token) 
    && !InputSecurity::isEmpty($_SESSION['token'], $sessionToken)){
        
        if($token == $sessionToken){
            $stat = $PDO->prepare("insert into Expense values(default, :date, :price, :desc, :user, :event, :worksite);");
            $stat->execute([
                'date' => Date("Y-m-d H:m:s"),
                'price' => $price,
                'desc' => $description,
                'user' => $userId,
                'event' => $event,
                'worksite' => $worksite
            ]);
        }
        unset($_SESSION['token']);
        header("Location:".$_SERVER['HTTP_REFERER']);
}
else{
    header("Location:/expenditure");
}