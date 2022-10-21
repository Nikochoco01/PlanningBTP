<!-- variables declaration -->
<?php 
$userName = 'Nikola CHEVALLIOT';
$userPic = '/img/defaultPP.png';

$surName = 'Nikola';
$name = 'chevalliot';
$position = 'administrateur'; // position in the companie
?>


<header>
    <?php echo "<h1>" . $titlePage . "</h1>" ?>

    <div class="logZone">
        <?php echo '<img src="'. $userPic .'" alt="user picture" class="userPic" id="userPic">' ?>
        <?php echo '<p class="userAccount" id="userAccount"> <span class="surName">'. $surName .'</span> <span class="name">'. strtoupper($name) .'</span> </p>' ?>
        <?php echo '<p class="typeAccount" id="typeAccount">'. strtoupper($position) .'</p>' ?>
        <a href="#"> <i class="icon-logOut"></i> <span> Déconnection </span> </a>
        </div>
</header>