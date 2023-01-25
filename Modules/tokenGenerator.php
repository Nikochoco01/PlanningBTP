<?php 
function generateToken(int $n) : string{
    $str = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
    $randomStr = ''; 
  
    for ($i = 0; $i < $n; $i++) { 
        $index = random_int(0, strlen($str) - 1); 
        $randomStr .= $str[$index]; 
    } 
  
    return $randomStr;
}
?>