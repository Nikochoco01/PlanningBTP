<?php

/**
 * Class InputSecurity
 * Allow to secure the input of application
 */
class Picture{

    /**
    * display the picture
    * @author Bruno DOS SANTOS
    * @param $dataBase
    * @param string $userId
    * 
    * @return array from data base 
    */
        public static function display($dataBase, $userId = null){
            if($userId != null){
                return $dataBase->read("Picture" , [
                        "conditions" => ["userId" => "$userId"],
                        "fields" => ["pictureBin"]
                    ]);
            }
            return [];
        }

        public static function add($dataBase, $userId = null, $name, $size, $type, $bin){
            if($userId != null){
                return $dataBase->save("Picture", [
                    "picrtureId" => ["$userId"],
                    "userId" => ["$userId"],
                    "picrtureName" => ["$name"],
                    "picrtureSize" => ["$size"],
                    "picrtureType" => ["$type"],
                    "picrtureBin" => ["$bin"]
                ]);
            }
            return [];
        }

        public static function modify($dataBase, $userId = null){
            if($userId != null){
                return $dataBase->read("Picture" , [
                        "conditions" => ["userId" => "$userId"],
                        "fields" => ["distinct *"]
                    ]);
            }
            return [];
        }
}

?>