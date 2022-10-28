<!DOCTYPE html>
<html lang="fr">
<?php $titre = "Frais"; ?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/CSS/default.css">
    <link rel="stylesheet" href="/CSS/menu.css">
    <link rel="stylesheet" href="/Icon/style.css">
    <title> <?php echo $titre ?> </title>
</head>

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

                <label for="description"> Raison de la dépense </label>
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