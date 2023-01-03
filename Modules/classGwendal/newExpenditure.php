<?php 
session_start();
include_once dirname(__FILE__, 2)."/dataBase/dataBaseConnection.php";

if( !empty($_POST['price']) && !empty($_POST['description']) && !empty($_POST['worksite']) && !empty($_POST['token']) && !empty($_SESSION['userName']) && !empty($_SESSION['token']) ){
    if($_POST['token'] == $_SESSION['token']){

        $stat = $PDO->prepare("insert into Expense values(default, :date, :price, :desc, :user, :event, :worksite);");
        $stat->execute([
            'date' => Date("Y-m-d H:m:s"),
            'price' => $_POST['price'],
            'desc' => $_POST['description'],
            'user' => $_SESSION['userName'],
            'event' => $_POST['event'],
            'worksite' => $_POST['worksite']
        ]);
    }
    unset($_SESSION['token']);
}
header("Location:".$_SERVER['HTTP_REFERER']);