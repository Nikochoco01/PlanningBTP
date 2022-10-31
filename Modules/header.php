<header>
    <?php echo "<h1>" . $titlePage . "</h1>" ?>

    <div class="logZone">
        <img src="<?php echo $_SESSION['userPic'] ?>" alt="user picture" class="userPic" id="userPic">
        <p class="userAccount" id="userAccount"> 
            <span class="surName"> <?php echo $_SESSION['surName'] ?> </span> 
            <span class="name"> <?php echo strtoupper($_SESSION['name']) ?> </span> 
        </p>
        <p class="typeAccount" id="typeAccount"> <?php echo strtoupper($_SESSION['position']) ?> </p>
        <a href="../index.php"> <i class="icon-logOut"></i> <span> Déconnection </span> </a>
    </div>
</header>