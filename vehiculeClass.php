<?php
class Vehicule{
    private $id;
    private $type;
    private $designation;
    private $license;

    function __construct(string $plate, string $type, string $des, string $license){
        $this->id = $plate;
        $this->type = $type;
        $this->designation = $des;
        $this->license = $license;
    }

    function display(): string{
        $str = "";
        $str .=  "<form class=\"vehicule\">";
        $str .=  "<input type=\"text\" value=\"".$this->id."\" disabled>";
        $str .=  "<p>".$this->type."</p>";
        $str .=  "<p>".$this->designation."</p>";
        $str .=  "<p>".$this->license."</p>";
        $str .=  "</form>";
        return $str;
    }
}