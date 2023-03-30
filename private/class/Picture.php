<?php

/**
 * Class InputSecurity
 * Allow to secure the input of application
 */
class Picture{

    private Database $dataBase;

    function __construct($dataBase){
        $this->dataBase = $dataBase;
    }

    /**
    * display the picture
    * @author Bruno DOS SANTOS
    * @param string $userId
    * 
    * @return array from data base 
    */
        public function display($userId = null){
            if($userId != null){
                $res = $this->dataBase->read("Picture" , [
                        "conditions" => ["userId" => "$userId"],
                        "fields" => ["pictureBin"]
                    ]);
                if($res){
                    return "data:image/;base64," . $res[0]->pictureBin;
                }else{
                    return "/img/defaultPP.png";
                }
            }
            return [];
        }

        public function add($name, $size, $type, $bin , $userId = null){
            if($userId != null){
                $this->dataBase->save("Picture", [
                    "pictureId" => "$userId",
                    "userId" => "$userId",
                    "pictureName" => "$name",
                    "pictureSize" => "$size",
                    "pictureType" => "$type",
                    "pictureBin" => "$bin"
                ], "$userId");
            }
        }

        public function modify($userId = null){
            if($userId != null){
                return $this->dataBase->read("Picture" , [
                        "conditions" => ["userId" => "$userId"],
                        "fields" => ["distinct *"]
                    ]);
            }
            return [];
        }
}

?>