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

    function display(string $token) : string{
        $str = "";
        $str .= "<form class=\"material\">";
        $str .= "<input type=\"text\" value=\"".$this->designation."\" disabled>";
        $str .=  "<p>".$this->TTCount."</p>";
        $str .=  "<p>".$this->cmtDispo."</p>";
        $str .=  "<input  type=\"hidden\" name=\"token\" value=\"".$token."\">";
        $str .=  "</form>";
        return $str;
    }
}