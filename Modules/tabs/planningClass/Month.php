<?php 

class Month{

    public $days = ['Lundi' , 'Mardi' , 'Mercredi' , 'Jeudi' , 'Vendredi' , 'Samedi' , 'Dimanche'];
    private $months = ['Janvier' , 'Février' , 'Mars' , 'Avril' , 'Mai' , 'Juin' , 'Juillet' , 'Août' , 'Septembre' , 'Octobre' , 'Novembre' , 'Décembre'];

    public $month;
    public $year;
    public $numWeek;

    /**
     * month constructor
     * 
     * @param int $month the months is between 1 and 12
     * @param int $year current year of calendar
     */

    public function __construct(?int $month = null , ?int $year = null , ?int $numWeek = null)
    {
        if($month === null || $month < 1 || $month > 12){
            $month = intval(date('m'));
        }

        if($year === null){
            $year = intval(date('Y'));
        }

        $this->month = $month;
        $this->year = $year;
        $this->numWeek = $numWeek;
    }

    /**
     * return the first day of month 
     * 
     * @return DateTimeImmutable
     */
    public function getFirstDay(){
        return new DateTimeImmutable("{$this->year}-{$this->month}-01");
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
        $end = $start->modify('+1 month -1 day');
        $startWeek = intval($start->format('W'));
        $endWeek = intval($end->format('W'));
        if($endWeek === 1 ){
            $endWeek = intval($end->modify('- 7 days')->format('W')) + 1;
        }

        $weeks = $endWeek - $startWeek + 1;

        if($weeks < 0 ){
            $weeks = intval($end->format('W'));
        }

        $this->week = $weeks;
        return $weeks;
    }

    /**
     * test if the day is in current month
     * 
     * @param DateTimeImmutable $date
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


    function setupWeek(){
        
    }

    /**
     * return the week at the format day to day month
     * 
     * @return string 
     */
    public function toStringWeek(){
        return "du ". "........." ."au"."........". $this->year;
    }


    /**
     * return week after current week
     * 
     * @return Week
     */
    public function nextWeek(){
        $this->numWeek+7;
        if($this->numWeek > $this->getWeeks()*7){
            $this->nextMonth();
            $this->numWeek = 0;
        }
        return $this->numWeek;
    }

    /**
     * return week before current week
     * 
     * @return Week
     */
    public function previousWeek(){
        $this->numWeek-7;
        if($this->numWeek > $this->getWeeks()*7){
            $this->nextMonth();
            $this->numWeek = 0;
        }
        return $this->numWeek;
    }

}


?>