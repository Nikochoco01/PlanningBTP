<?php 

class Week{

    public $week;
    public $month;
    public $year;

    function __construct(?Month $month = null , ?int $weeks = null , ?int $year = null)
    {
        $this->wekk = $weeks;
        $this->month = $month;
        $this->year = $year;
    }

    public function toString(){
        return "du ". "........." ."au"."........". $this->year;
    }

    /**
     * return week after current week
     * 
     * @return Week
     */
    public function nextWeek(){
        $week = $this->week + 1;
        $month = $this->month;
        $year = $this->year;

        if($week > $month->getWeeks()){
            $month = $this->month->nextMonth();
        }
        return new Week($month, $week , $year);
    }

    /**
     * return week before current week
     * 
     * @return Week
     */
    public function previousMonth(){
        $week = $this->week - 1;
        $month = $this->month;
        $year = $this->year;

        if($week < $month->getWeeks()){
            $month = $this->month->previousMonth();
        }
        return new Week($month, $week , $year);
    }




}


?>