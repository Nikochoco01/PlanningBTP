<!DOCTYPE html>
<html lang="fr">
<?php $titre = "Frais";
include_once "module/head.php";?>

<body>
    <?php include_once "module/header.php"; ?>

    <div class="layout">
        <?php include_once "module/aside.php"; ?>
        <main>
            
            <div class="listeFrais" id="listeFrais"></div>

            <a href="#"> <i> Scan </i> </a>

            <form>
                <p><span class="hour" id="hour"></span>:<span class="minutes" id="minutes"></span></p>

                <label for="worksite"> Chantier </label>
                <input type="search" name="worksite" id="worksite">

                <label for="description"> Raison de la depence </label>
                <input type="text" name="description" id="description">

                <label for="price"> Montant </label>
                <input type="number" name="price" id="price" min="0" step="0.01">
            </form>
<script>
    const hour = document.getElementById("hour");
    const min = document.getElementById("minutes");
    const today = new Date();
    hour.innerText = today.getHours();
    min.innerText = today.getMinutes();
</script>
        </main>
    </div>
</body>
</html>