<?php
include_once dirname(__FILE__,4). "/private/dataBase/dataBaseConnection.php";
$id = $_GET['pictureId'];
$PDO->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE , PDO::FETCH_OBJ);
$req = $PDO->prepare("select * from Picture where pictureId=$id limit 1");
$req->setFetchMode(PDO::FETCH_ASSOC);
$req->execute(array($_GET["pictureId"]));
$tab=$req->fetchAll();
echo $tab[0]["pictureBin"];