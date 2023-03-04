<?php

if( InputSecurity::validateWithoutLetter($_POST['price'] , $price) 
    && InputSecurity::validateWithoutNumber($_POST['description'] , $description) 
    && InputSecurity::validateWithoutLetter($_POST['worksite'] , $worksiteId)
    && InputSecurity::validateWithoutLetter($_SESSION['userId'] , $userId)
    && InputSecurity::validateWithoutLetter($_POST['event'] , $eventId)  
    && InputSecurity::isEmpty($_POST['token'] , $tokenPost) 
    && InputSecurity::isEmpty($_SESSION['token'] , $tokenSession)){
        
        if($tokenPost == $tokenSession){
            // $stat = $PDO->prepare("insert into Expense values(default, :date, :price, :desc, :user, :event, :worksite);");
            // $stat->execute([
            //     'date' => Date("Y-m-d H:m:s"),
            //     'price' => $_POST['price'],
            //     'desc' => $_POST['description'],
            //     'user' => $_SESSION['userId'],
            //     'event' => $_POST['event'],
            //     'worksite' => $_POST['worksite']
            // ]);

            $dataBase->save("Expense" , [
                "expenseId" => "default",
                "expenseDate" => Date("Y-m-d H:m:s"),
                "expenseAmount" => $price,
                "expenseDescription" => $description,
                "userId" => $userId,
                "eventId" => $eventId,
                "worksiteId" => $worksiteId
            ], "default");
        }
        unset($_SESSION['token']);
        header("Location:".$_SERVER['HTTP_REFERER']);
}
else{
    header("Location:/expenditure");
}