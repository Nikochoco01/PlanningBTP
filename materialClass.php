<?php
class Material{
    private $designation;
    private $TTCount;
    private $cmtDispo;

    function __construct(string $des, int $tt, int $dispo){
        $this->designation = $des;
        $this->TTCount = $tt;
        $this->cmtDispo = $dispo;
    }

    function display() : string{
        $str = "";
        $str .= "<form class=\"material\">";
        $str .= "<input type=\"text\" value=\"".$this->designation."\" disabled>";
        $str .=  "<p>".$TTCount."</p>";
        $str .=  "<p>".$cmtDispo."</p>";
        $str .=  "</form>";
        return $str;
    }
}