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
        <img src="<?php echo $userPic ?>" alt="user picture" class="userPic" id="userPic">
        <p class="userAccount" id="userAccount"> <span class="surName"> <?php echo $surName ?> </span> <span class="name"> <?php echo strtoupper($name) ?> </span> </p>
        <p class="typeAccount" id="typeAccount"> <?php echo strtoupper($position) ?> </p>
        <a href="../index.php"> <i class="icon-logOut"></i> <span> Déconnection </span> </a>
    </div>
</header>