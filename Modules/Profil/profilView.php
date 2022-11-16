<?php 
$prenom = $_POST["userFirstname"]; 
$nom = "chevalliot";
$position = "Administrateur";
$mail = "Test@gmail.com";
$phone = "051248030";
$postalAddress = "25 rue de large";
?>

<p> <?php echo $prenom . " " . $nom ?></p>
<p> <?php echo $position ?></p>
<p> <?php echo $mail ?></p>
<p> <?php echo $phone ?></p>
<p> <?php echo $postalAddress ?></p>

<a href="<?php echo displayType2("Modify") ?>"> Modifier </a>
