<?php
class Invoice{
    private $idInvoice;
    private $date;
    private $price;
    private $description;
    private $designation;

    function __construct(int $idIn, string $date, float $price, string $desc, string $desi){
        $this->idInvoice = $idIn;
        $this->date = $date;
        $this->price = $price;
        $this->description = $desc;
        $this->designation = $desi;
    }

    function display(){
        echo "<form class=\"invoice\">";
        echo "<input type=\"text\" value=\"".$this->idInvoice."\" disabled>";
        echo "<p>".$this->date."</p>";
        echo "<p>".$this->price."€</p>";
        echo "<p>".$this->description."</p>";
        echo "<p>".$this->designation."</p>";
        echo "</form>";
    }
}