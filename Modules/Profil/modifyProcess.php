<?php
    $_SESSION['userName'] = $_POST['userName']; //  connection ID
    $_SESSION['userPic'] = $_POST['userPicture']; // profile picture 
    $_SESSION['surName'] = $_POST['surName']; // first name of user
    $_SESSION['name'] = $_POST['name']; // name of user 
    $_SESSION['position'] = $_POST['position']; // position in the companie
    $_SESSION['userPhone'] = $_POST['userPhone']; // user phone number 
    $_SESSION['userMail'] = $_POST['userMail']; // user mail address
    header('Location: ../profil.php?position='.'administrateur'.'&onglet='.'Personnal'.'&display='.'View');
    Exit();
?>