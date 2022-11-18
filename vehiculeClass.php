<?php
class vehicule{
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

    function display(){
        echo "<form class=\"vehicule\">";
        echo "<input type=\"text\" value=\"".$this->id."\" disabled>";
        echo "<p>".$this->type."</p>";
        echo "<p>".$this->designation."</p>";
        echo "<p>".$this->license."</p>";
        echo "</form>";
    }
}