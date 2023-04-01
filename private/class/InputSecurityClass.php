<?php

/**
 * Class InputSecurity
 * Allow to secure the input of application
 */
class InputSecurity{

    private static $errorEmptyInput = "Input is empty, please check it and try again";
    private static $errorMailFormat = "Invalid mail address format, please check it and try again";
    private static $errorStringFormat = "Invalid string format, please check it and try again";
    private static $errorNumberFormat = "Invalid number format, please check it and try again";
    private static $errorPasswordLength = "Invalid password, please do a password with 8 characters minimum and contain uppercase, lowercase, number and special chars #?!@$%^&*-";

    /**
    * delete all tags from parameter
    * @author Nikola Chevalliot
    * @param string $input
    * 
    * @return string return string without tags 
    */
    public static function validateWithoutTags($input): string{
        $inputProcessing = strip_tags($input);
        $inputProcessing = stripslashes($inputProcessing);
        $inputProcessing = trim($inputProcessing);
        $inputProcessing = mb_strtolower($inputProcessing);

        return $inputProcessing;
    }

    /**
    * create a new $_SESSION variable that stores an error message
    * @author Nikola Chevalliot
    * 
    * @param string $message
    */
    public static function returnError($message){
        if(isset($_SESSION)){
            $_SESSION['ERROR'] = $message;
        }
        else{
            session_start();
            $_SESSION['ERROR'] = $message;
        }
    }

    /**
    * create a new $_SESSION variable that stores an error message
    * @author Nikola Chevalliot
    * @param string
    */
    public static function returnMessage($message){
        if(isset($_SESSION)){
            $_SESSION['MESSAGE'] = $message;
        }
        else{
            session_start();
            $_SESSION['MESSAGE'] = $message;
        }
    }

    /**
    * Allow to destroy ERROR variable from session
    * @author Nikola Chevalliot
    */
    public static function destroyError(){
        if(isset($_SESSION['ERROR'])){
            unset($_SESSION['ERROR']);
        }
    }

    /**
    * Allow to destroy MESSAGE variable from session
    * @author Nikola Chevalliot
    */
    public static function destroyMessage(){
        if(isset($_SESSION['MESSAGE'])){
            unset($_SESSION['MESSAGE']);
        }
    }

    /**
    * check if parameter is empty
    * @author Nikola Chevalliot
    * @param string $input 
    * @param string $return 
    * 
    * @return bool return true if the input is empty else false
    */
    public static function isEmpty($input , & $return): bool{
        if(empty($input)){
            InputSecurity::returnMessage(InputSecurity::$errorEmptyInput);
            return true;
        }
        else{
            $return = InputSecurity::validateWithoutTags($input);
            return false;
        }
    }

    /**
    * checks if the parameter matches an email address format 
    * @author Nikola Chevalliot
    * @param string $input
    * @param string $return
    * 
    * @return bool return true if the mail is valide else false
    */
    public static function validateMail($input, & $return): bool{
        InputSecurity::isEmpty($input , $inputProcessing);
        $inputProcessing = mb_strtolower($inputProcessing);
        $REGEX = '#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#';
        if(preg_match($REGEX , $inputProcessing)){
            $return = $inputProcessing;
            return true;
        }
        else{
            InputSecurity::returnError(InputSecurity::$errorMailFormat);
            return false;
        }
    }

    /**
    * checks if the parameter is without number if the second parameter is set with LastName or FirstName return a special formatting
    * @author Nikola Chevalliot
    * @param string $input
    * @param string $return
    * 
    * @return bool return true if the input dons't contain number false else
    */
    public static function validateWithoutNumber($input , & $return): bool{
        
        if(InputSecurity::isEmpty($input , $inputProcessing) == true){
            return false;
        }

        if(!filter_var($inputProcessing , FILTER_SANITIZE_NUMBER_INT)){ // FILTER_SANITIZE_NUMBER_INT allow to remove letter from number
            $return = $inputProcessing;
            return true;
        }
        else{
            InputSecurity::returnError(InputSecurity::$errorNumberFormat);
            return false;
        }
    }
    
    /**
    * check if the parameter is without letter
    * @author Nikola Chevalliot
    * @param string $input
    * @param string $return
    * @param string $format optional if param ==  phoneNumber => $regexPhone else if param == licensePlate => $regexPlate else => $regexNumber
    * 
    * @return bool return true if the input dons't contain letter false else
    */
    public static function validateWithoutLetter($input , & $return , ?string $format = null):bool{
        $REGEX = "";
        $inputProcessing = "";

        switch($format){
            case null:
                    //all number without space
                    $REGEX = "/[\d]{1,}/";
                break;
            case "phoneNumber":
                    //phone number french format
                    $REGEX = "/^(?:(?:\+|00)33[\s.-]{0,3}(?:\(0\)[\s.-]{0,3})?|0)[1-9](?:(?:[\s.-]?\d{2}){4}|\d{2}(?:[\s.-]?\d{3}){2})$/";
                break;
            case "licensePlate":
                    //license plate french format
                    $REGEX = "/[a-zA-Z]{2}([-])[0-9]{3}([-])[a-zA-Z]{2}/";
                break;
        }

        if(InputSecurity::isEmpty($input , $inputProcessing) == true){
            return false;
        }

        if(preg_match($REGEX , $inputProcessing)){
            $return = $inputProcessing;
            return true;
        }
        else{
            InputSecurity::returnError(InputSecurity::$errorStringFormat);
            return false;
        }
    }

    /**
    * check if the parameter is a strong password
    * @author Nikola Chevalliot
    * @param string $input
    * @param string $return
    * 
    * @return bool return true if the password contain  false else
    */
    public static function validatePassWord($input , & $return){
        InputSecurity::isEmpty($input , $inputProcessing);

        $REGEX = "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/";
        if(preg_match($REGEX , $input)){
            $return = $inputProcessing;
            return true;
        }
        // if(preg_match($REGEX , $inputProcessing)){
        //     var_dump("val: " .$inputProcessing);
        //     $return = $inputProcessing;
        //     return true;
        // }
        // else{
        //     InputSecurity::returnError(InputSecurity::$errorPasswordLength);
        //     return false;
        // }
    }

    // public static function validatePicture($input){
        
    // }

    /**
     * Allow to format the string return according to selected format 
     * @author Nikola Chevalliot
     * @param string $input which must be formatted
     * @param string $format optional param list : uppercase , uppercaseFirstLetter , PhoneNumber
     * 
     * @return string 
     */
    public static function displayWithFormat($input , ?string $format = null){
        $inputProcessing = InputSecurity::validateWithoutTags($input);
        switch($format){
            case "uppercase":
                return mb_strtoupper($inputProcessing);
            case "uppercaseFirstLetter":
                return mb_convert_case($inputProcessing , MB_CASE_TITLE);
            case "PhoneNumber":
                $inputProcessing = str_split($inputProcessing , 2);
                return implode(" " , $inputProcessing);
            default:
                return mb_strtolower($inputProcessing);
        }
    }

    /**
     * Allow to generate a token
     * @param int 
     * 
     * @return string 
     */
    public static function generateToken(int $n) : string{
        $str = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomStr = '';
      
        for ($i = 0; $i < $n; $i++) {
            $index = random_int(0, strlen($str) - 1);
            $randomStr .= $str[$index];
        }
      
        return $randomStr;
    }
}

?>