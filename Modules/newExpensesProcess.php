<?php include_once dirname(__FILE__, 2)."/dataBase/dataBaseConnection.php";
session_start();
if( isset($_POST['price']) && isset($_POST['description']) && isset($_POST['worksite']) && isset($_SESSION['userName']) ){
    $idworksite = explode("-", $_POST['worksite'])[0];
    $stat = $PDO->prepare("insert into Invoice values(default, :date, :price, :desc, :worksite, :user)");
    $stat->execute([
        'date' => Date("Y-m-d H:m:s"),
        'price' => $_POST['price'],
        'desc' => $_POST['description'],
        'worksite' => $idworksite,
        'user' => $_SESSION['userName']
    ]);
}
header("Location:".$_SERVER['HTTP_REFERER']);