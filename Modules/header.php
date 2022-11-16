<header>
    <h1> <?php echo $titlePage ?> </h1>

    <div class="profilZone">
        <img src="<?php echo $_SESSION['userPic'] ?>" alt="user picture" class="userPic" id="userPic">
        <p class="userAccount" id="userAccount"> 
            <span class="surName"> <?php echo $_SESSION['surName'] ?> </span> 
            <span class="name"> <?php echo mb_strtoupper($_SESSION['name']) ?> </span> 
        </p>
        <p class="typeAccount" id="typeAccount"> <?php echo mb_strtoupper($_SESSION['position']) ?> </p>
        
        <form action="/Modules/logOutProcess.php" method="post">
                <label for="logOutButton" class="logOutButton"> <i class="icon-power-off"></i> <span> Déconnexion </span> </label>
                <input type="submit" value="Déconnexion" class="logOutButton" id="logOutButton">
        </form>
    </div>
</header>