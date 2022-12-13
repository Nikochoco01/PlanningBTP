<?php 

class Month{

    public $days = ['Lundi' , 'Mardi' , 'Mercredi' , 'Jeudi' , 'Vendredi' , 'Samedi' , 'Dimanche'];
    private $months = ['Janvier' , 'Février' , 'Mars' , 'Avril' , 'Mai' , 'Juin' , 'Juillet' , 'Août' , 'Septembre' , 'Octobre' , 'Novembre' , 'Décembre'];

    public $month;
    public $year;
    public $week;

    /**
     * month constructor
     * 
     * @param int $month the months is between 1 and 12
     * @param int $year current year of calendar
     */

    public function __construct(?int $month = null , ?int $year = null , ?int $week = null)
    {
        if($month === null || $month < 1 || $month > 12){
            $month = intval(date('m'));
        }

        if($year === null){
            $year = intval(date('Y'));
        }

        if($week === null){
            $this->week = 1;
        }

        $this->month = $month;
        $this->year = $year;
        $this->week = $week;
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
        $week = 1;

        if($month > 12){
            $month = 1;
            $week = 1;
            $year += 1;
        }

        return new Month($month, $year, $week);
    }

    /**
     * return month before current month
     * 
     * @return month
     */
    public function previousMonth(){
        $month = $this->month - 1;
        $week = $this->getWeeks();
        $year = $this->year;

        if($month < 1){
            $month = 12;
            $year -= 1;
        }
        return new Month($month, $year , $week);
    }

    private function convertWeek($week){
        if($week >= 1 && $week < 7){
            switch($week){
                case 1:
                    return 0;
                    break;
                case 2:
                    return 7*1;
                    break;
                case 3:
                    return 7*2;
                    break;
                case 4:
                    return 7*3;
                    break;
                case 5:
                    return 7*4;
                    break;
                case 6:
                    return 7*5;
                    break;
            }
        }
    }

    public function setupWeek($week){

        if($week <= 0){
            $this->previousMonth();
            return $this->getWeeks();
        }

        if($week > $this->getWeeks()){
            $this->nextMonth();
            return 1;
        }

        if($week >=1 && $week < 7){
            return $this->convertWeek($week);
        }

    }

    /**
     * return the week at the format day to day month
     * 
     * @return string 
     */
    public function toStringWeek($date){
        return "Du ". $date->modify('- 6 day')->format("d")." au ". $date->format("d") . " " . $this->months[$this->month - 1] . " " . $this->year;
    }


    /**
     * return week after current week
     * 
     * @return Month
     */
    public function nextWeek(){
        $month = $this->month;
        $week = $this->week + 1;
        $year = $this->year;

        if($week > $this->getWeeks()){
            $month = $this->nextMonth()->month;
            $year = $this->nextMonth()->year;
            $week = $this->nextMonth()->week;
        }

        return new Month($month, $year, $week);
    }

    /**
     * return week before current week
     * 
     * @return Month
     */
    public function previousWeek(){
        $month = $this->month;
        $week = $this->week - 1;
        $year = $this->year;

        if($week === 0){
            $month = $this->previousMonth()->month;
            $week = $this->previousMonth()->week;
            $year = $this->previousMonth()->year;
        }

        return new Month($month, $year , $week);
    }
}
?>