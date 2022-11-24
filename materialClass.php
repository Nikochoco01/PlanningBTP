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

    function display(){
        echo "<form class=\"material\">";
        echo "<input type=\"text\" value=\"".$this->designation."\" disabled>";
        echo "<p>".$TTCount."</p>";
        echo "<p>".$cmtDispo."</p>";
        echo "</form>";
    }
}