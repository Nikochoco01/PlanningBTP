<?php

if( InputSecurity::validateWithoutLetter($_POST['price'], $price) 
    && InputSecurity::validateWithoutNumber($_POST['description'], $description) 
    && InputSecurity::validateWithoutLetter($_POST['worksite'], $worksite)
    && InputSecurity::validateWithoutLetter($_SESSION['userId'], $userId)
    && InputSecurity::validateWithoutLetter($_POST['event'], $event)  
    && !InputSecurity::isEmpty($_POST['token'], $token) 
    && !InputSecurity::isEmpty($_SESSION['token'], $sessionToken)){
        
        if($token == $sessionToken){
            $db->save("Expense",
                [
                    'expenseDate' => Date("Y-m-d H:m:s"),
                    'expenseAmount' => $price,
                    'expenseDescription' => $description,
                    'userId' => $userId,
                    'eventId' => $event,
                    'worksiteId' => $worksite
                ]
            );
        }
        unset($_SESSION['token']);
        header("Location:".$_SERVER['HTTP_REFERER']);
}
else{
    header("Location:/expenditure");
}