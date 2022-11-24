<?php 

include_once dirname(__FILE__,4)."/dataBase/dataBaseConnection.php";

class Events{

    private $PDO;
   
    function __construct($pdo)
    {
        $this->PDO = $pdo;
    }

    /**
     * allow to get an event in the data base
     * 
     * @return assoc_array from data base
     */
    public function getEventBetween(\DateTime $eventStart , \DateTime $eventEnd){
        $this->PDO->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE , PDO::FETCH_ASSOC);
        $query = "select description , startTime , endTime from Event where startTime between '{$eventStart->format('Y-m-d 00:00:00')}' and '{$eventEnd->format('Y-m-d 23:59:59')}'";
        
        $statement = $this->PDO->query($query);
        $result = $statement->fetchAll();
        return $result;
    }

    /**
     * allow to group event by day
     * 
     * @return day
     */
    public function getEventBetweenByDay(\DateTime $eventStart , \DateTime $eventEnd){
        $events = $this->getEventBetween($eventStart , $eventEnd);
        $days = [];
        foreach($events as $event){
            $date = explode(' ' , $event['startTime'])[0];
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