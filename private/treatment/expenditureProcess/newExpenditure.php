<?php
include_once APP . "private/class/InputSecurityClass.php";
include_once APP . "private/dataBase/dataBaseConnection.php";

if( InputSecurity::validateWithoutLetter($_POST['price']) 
    && InputSecurity::validateWithoutNumber($_POST['description']) 
    && InputSecurity::validateWithoutLetter($_POST['worksite'])
    && InputSecurity::validateWithoutLetter($_SESSION['userId'])
    && InputSecurity::validateWithoutLetter($_POST['event'])  
    && InputSecurity::isEmpty($_POST['token']) 
    && InputSecurity::isEmpty($_SESSION['token'])){
        
        if($_POST['token'] == $_SESSION['token']){
            $stat = $PDO->prepare("insert into Expense values(default, :date, :price, :desc, :user, :event, :worksite);");
            $stat->execute([
                'date' => Date("Y-m-d H:m:s"),
                'price' => $_POST['price'],
                'desc' => $_POST['description'],
                'user' => $_SESSION['userId'],
                'event' => $_POST['event'],
                'worksite' => $_POST['worksite']
            ]);
        }
        unset($_SESSION['token']);
        header("Location:".$_SERVER['HTTP_REFERER']);
}
else{
    header("Location:/expenditure");
}