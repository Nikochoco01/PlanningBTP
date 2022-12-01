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

    function display(string $token) : string{
        $str = "";
        $str .=  "<form class=\"invoice\">";
        $str .=  "<input type=\"text\" value=\"".$this->idInvoice."\" disabled>";
        $str .=  "<p>".$this->designation."</p>";
        $str .=  "<p>".$this->description."</p>";
        $str .=  "<p>".explode(" ", $this->date)[0]."</p>";
        $str .=  "<p>".number_format($this->price, 2, ".", " ")."€</p>";
        $str .=  "<input  type=\"hidden\" name=\"token\" value=\"".$token."\">";
        $str .=  "</form>";
        return $str;
    }
}