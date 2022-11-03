<p> <?php echo $_SESSION['surName'] . " " . $_SESSION['name'] ?></p>
<p> <?php echo $_SESSION['position'] ?></p>
<p> <?php echo $_SESSION['userMail'] ?></p>
<p> <?php echo $_SESSION['userPhone'] ?></p>

<a href="<?php echo addUrlParam(array('display' => 'Modify')) ?>"> Modifier </a>