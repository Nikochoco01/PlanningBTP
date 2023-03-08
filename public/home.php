<!DOCTYPE html>
<html lang="fr">

<!-- variables declaration -->
<?php 
$title = TITLE_PAGE_HOME;
include_once APP . "/private/class/Picture.php";
include_once APP . "private/constant/page/head.php";
?>

<body>
    <div class="layout">
        <?php include_once APP . "private/constant/page/header.php" ?>
        <?php include_once APP . "private/constant/page/aside.php" ?>
            <main>
                <img src="/private/treatment/indexProcess/export.php?pictureId=<?php echo $_SESSION['userId']; ?>" alt="pas d'image de profil">
                <?php// var_dump(Picture::display($dataBase, $_SESSION['userId']));?>
                <?php// Picture::add($dataBase, "4", "4", "deft.png", "721", "image/png", "010011100001111"); ?>
                <img src="data:image/;base64,<?=Picture::display($dataBase, $_SESSION['userId'])?>" alt="test">
            </main>
    </div>
</body>
</html>