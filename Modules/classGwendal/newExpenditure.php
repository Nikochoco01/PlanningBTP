<?php 
session_start();
include_once dirname(__FILE__,3)."/private/class/InputSecurityClass.php";
include_once dirname(__FILE__,3)."/private/dataBase/dataBaseConnection.php";

if( InputSecurity::isEmpty($_POST['price']) == $_POST['price'] && InputSecurity::isEmpty($_POST['description']) == $_POST['description'] && InputSecurity::isEmpty($_POST['worksite']) == $_POST['worksite'] && InputSecurity::isEmpty($_POST['token']) == $_POST['token'] && InputSecurity::isEmpty($_SESSION['userId']) == $_SESSION['userId'] && InputSecurity::isEmpty($_POST['event']) == $_POST['event'] && InputSecurity::isEmpty($_SESSION['token']) == $_SESSION['token'] ){
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
    header("Location:".dirname(__FILE__,3)."/public/expenditure.php");
}