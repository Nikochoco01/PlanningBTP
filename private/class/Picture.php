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
                    ])[0]->pictureBin;
            }
            return [];
        }

        public static function add($dataBase, $userId = null, $name, $size, $type, $bin){
            if($userId != null){
                $dataBase->save("Picture", [
                    "pictureId" => "$userId",
                    "userId" => "$userId",
                    "pictureName" => "$name",
                    "pictureSize" => "$size",
                    "pictureType" => "$type",
                    "pictureBin" => "$bin"
                ]);
            }
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