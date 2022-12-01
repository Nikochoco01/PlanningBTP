<?php include_once dirname(__FILE__, 2)."/dataBase/dataBaseConnection.php";
session_start();
if( isset($_POST['price'], $_POST['description'], $_POST['worksite'], $_POST['token'], $_SESSION['userName'], $_SESSION['token']) ){
        if($_POST['token'] == $_SESSION['token']){
        $des = $PDO->quote($_POST['worksite']);
        $worksite = $PDO->query("select idWorksite from Worksite where designation = $des;")->fetch();
        $stat = $PDO->prepare("insert into Invoice values(default, :date, :price, :desc, :worksite, :user);");
        $stat->execute([
            'date' => Date("Y-m-d H:m:s"),
            'price' => $_POST['price'],
            'desc' => $_POST['description'],
            'worksite' => $worksite->idWorksite,
            'user' => $_SESSION['userName']
        ]);
    }
    $_SESSION['token'] = "";
}
header("Location:".$_SERVER['HTTP_REFERER']);