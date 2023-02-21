<?php

if(InputSecurity::validateWithoutLetter($_POST['id'], $id)
    && !InputSecurity::isEmpty($_POST['token'], $token)
    && !InputSecurity::isEmpty($_SESSION['token'], $sessionToken)){
        if($token == $sessionToken){
           
            $db->deleteBtp("Expense", ['expenseId' => $id]);
        }

        unset($_SESSION['token']);
}
header("Location:".$_SERVER['HTTP_REFERER']);