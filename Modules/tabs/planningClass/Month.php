<?php 

class Month{

    public $days = ['Lundi' , 'Mardi' , 'Mercredi' , 'Jeudi' , 'Vendredi' , 'Samedi' , 'Dimanche'];


    private $months = ['Janvier' , 'Février' , 'Mars' , 'Avril' , 'Mai' , 'Juin' , 'Juillet' , 'Août' , 'Septembre' , 'Octobre' , 'Novembre' , 'Décembre'];


    public $month;
    public $year;

    /**
     * month constructor
     * 
     * @param int $month the months is between 1 and 12
     * @param int $year current year of calendar
     */

    public function __construct(?int $month = null , ?int $year = null)
    {
        if($month === null || $month < 1 || $month > 12){
            $month = intval(date('m'));
        }

        if($year === null){
            $year = intval(date('Y'));
        }

        $this->month = $month;
        $this->year = $year;
    }

    /**
     * return the first day of month 
     * 
     * @return DateTime
     */
    public function getFirstDay(){
        return new DateTime("{$this->year}-{$this->month}-01");
    }

    /**
     * return the month in full letters
     * 
     * @return string
     */
    public function toString(){
        return $this->months[$this->month - 1].' '. $this->year;
    }

    /**
     * return the number of weeks in the month
     * 
     * @return int
     */
    public function getWeeks(){
        $start = $this->getFirstDay();
        $end = (clone $start)->modify('+1 month -1 day');
        $weeks = intval($end->format('W')) - intval($start->format('W')) + 1;
        if($weeks < 0 ){
            $weeks = intval($end->format('W'));
        }
        return $weeks;
    }

    /**
     * test if the day is in current month
     * 
     * @param DateTime $date
     * @return bool
     */
    public function withinMonth($date){
        return $this->getFirstDay()->format('Y-m') === $date->format('Y-m');
    }

    /**
     * return month after current month
     * 
     * @return month
     */
    public function nextMonth(){
        $month = $this->month + 1;
        $year = $this->year;

        if($month > 12){
            $month = 1;
            $year += 1;
        }
        return new Month($month, $year);
    }

    /**
     * return month before current month
     * 
     * @return month
     */
    public function previousMonth(){
        $month = $this->month - 1;
        $year = $this->year;

        if($month < 1){
            $month = 12;
            $year -= 1;
        }
        return new Month($month, $year);
    }

}


?>