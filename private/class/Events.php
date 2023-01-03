<?php 

include_once dirname(__FILE__,2). "/dataBase/dataBaseConnection.php";

class Events{
   
    public $PDO;
    function __construct($pdo)
    {
        $this->PDO = $pdo;
    }

    /**
     * allow to get an event in the data base
     * 
     * @return assoc_array from data base
     */
    public function getEventBetween(\DateTimeImmutable $eventStart , \DateTimeImmutable $eventEnd){
        $this->PDO->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE , PDO::FETCH_ASSOC);
        /* Get the event from dataBase */
        $query = "select distinct * from Event e join Worksite w on w.worksiteId = e.worksiteId where eventStartDate between '{$eventStart->format('Y-m-d 00:00:00')}' and '{$eventEnd->format('Y-m-d 23:59:59')}'";
        $statement = $this->PDO->query($query);
        $getEvent = $statement->fetchAll();

        return $getEvent;
    }

    /**
     * allow to group event by day
     * 
     * @return day
     */
    public function getEventBetweenByDay(\DateTimeImmutable $eventStart , \DateTimeImmutable $eventEnd){
        $events = $this->getEventBetween($eventStart , $eventEnd);
        $days = [];
        foreach($events as $event){
            $date = explode(' ' , $event['eventStartDate'])[0];
            if(!isset($days[$date])){
                $days[$date] = [$event];
            }
            else{
                $days[$date][] = $event;
            }
        }
        return $days;
    }

    /**
     * create a new event
     * 
     */

     public function createEvent(Events $event){
        $query = "";
     }
}

?>