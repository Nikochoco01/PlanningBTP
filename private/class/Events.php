<?php 

include_once dirname(__FILE__,2). "/dataBase/dataBaseConnection.php";

class Events{
   
    public $PDO;
    function __construct($pdo)
    {
        $this->PDO = $pdo;
    }

    /**
     * allow to get all worksite from de data base
     * 
     * @return assoc_array from data base
     */
        public function getWorksite(){
            $this->PDO->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE , PDO::FETCH_ASSOC);

            $select = "select distinct *";
            $from = " from Worksite";
            $query = $select . $from;
            $statement = $this->PDO->query($query);
            $getSite = $statement->fetchAll();
            return $getSite;
        }

    /**
     * allow to get all employees from de data base
     * 
     * @return assoc_array from data base
     */
    public function getEmployee(){
        $this->PDO->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE , PDO::FETCH_ASSOC);

        $select = "select distinct *";
        $from = " from User";
        $where = " where userId not in (select userId from Affected)";
        $query = $select . $from . $where;
        $statement = $this->PDO->query($query);
        $getSite = $statement->fetchAll();
        return $getSite;
    }

    /**
     * allow to get all Material from de data base
     * 
     * @return assoc_array from data base
     */
    public function getMaterial(){
        $this->PDO->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE , PDO::FETCH_ASSOC);

        $select = "select distinct *";
        $from = " from Equipment";
        $where = " where equipmentName not in (select equipmentName from UsedEquipment)";
        $query = $select . $from . $where;
        $statement = $this->PDO->query($query);
        $getSite = $statement->fetchAll();
        return $getSite;
    }

    /**
     * allow to get all Vehicles from de data base
     * 
     * @return assoc_array from data base
     */
    public function getVehicles(){
        $this->PDO->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE , PDO::FETCH_ASSOC);

        $select = "select distinct *";
        $from = " from Vehicle";
        $where = " where vehicleLicensePlate not in (select vehicleLicensePlate from goTo)";
        $query = $select . $from . $where;
        $statement = $this->PDO->query($query);
        $getSite = $statement->fetchAll();
        return $getSite;
    }






    /**
     * allow to get an event in the data base
     * 
     * @return assoc_array from data base
     */
    public function getEventBetween(\DateTimeImmutable $eventStart , \DateTimeImmutable $eventEnd){
        $this->PDO->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE , PDO::FETCH_ASSOC);
        /* Get the event from dataBase */
        $select = "select distinct *";
        $from = " from Event e join Worksite w on w.worksiteId = e.worksiteId";
        $where = " where eventStartDate";
        $between = " between '{$eventStart->format('Y-m-d 00:00:00')}' and '{$eventEnd->format('Y-m-d 23:59:59')}'";
        $orderBy = " order by e.eventStartTime asc";
        
        $query = $select . $from . $where . $between . $orderBy;

        $statement = $this->PDO->query($query);
        $getEvent = $statement->fetchAll();

        return $getEvent;
    }

    /**
     * allow to group event by day
     * 
     * @return day
     */
    public function getEventBetweenByDay(\DateTimeImmutable $eventStart , \DateTimeImmutable $eventEnd , ?string $page = null){
        $events = "";

        if($page == null){
            $events = $this->getEventForGivenPerson($eventStart , $eventEnd);
        }

        switch($page){
            case "missions":
                    $events = $this->getEventBetween($eventStart , $eventEnd);
                break;
            case "employees":
                    $events = $this->getEventWithEmployees($eventStart , $eventEnd);
                break;
            case "vehicles":
                    $events = $this->getEventWithVehicles($eventStart , $eventEnd);
                break;
            case "material":
                    $events = $this->getEventWithMaterial($eventStart , $eventEnd);
                break;
        }

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
     * allow to get event where employees is it 
     * 
     * @return assoc_array from data base
     */
    public function getEventWithEmployees(\DateTimeImmutable $eventStart , \DateTimeImmutable $eventEnd){
        $this->PDO->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE , PDO::FETCH_ASSOC);
        $select = "select distinct *";
        $from = " from Event e join Affected a on e.eventId = a.eventId join Worksite w on e.worksiteId = w.worksiteId";
        $where = " where eventStartDate";
        $between = " between '{$eventStart->format('Y-m-d 00:00:00')}' and '{$eventEnd->format('Y-m-d 23:59:59')}'";
        $orderBy = " order by e.eventStartTime asc";
        
        $query = $select . $from . $where . $between . $orderBy;

        $statement = $this->PDO->query($query);
        $getEvent = $statement->fetchAll();

        return $getEvent;
    }

    /**
     * allow to get event where vehicles is used
     * 
     * @return assoc_array from data base
     */
    public function getEventWithVehicles(\DateTimeImmutable $eventStart , \DateTimeImmutable $eventEnd){
        $this->PDO->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE , PDO::FETCH_ASSOC);
        $select = "select distinct *";
        $from = " from Event e join GoTo g on e.eventId = g.eventId join Worksite w on e.worksiteId = w.worksiteId";
        $where = " where eventStartDate";
        $between = " between '{$eventStart->format('Y-m-d 00:00:00')}' and '{$eventEnd->format('Y-m-d 23:59:59')}'";
        $orderBy = " order by e.eventStartTime asc";
        
        $query = $select . $from . $where . $between . $orderBy;

        $statement = $this->PDO->query($query);
        $getEvent = $statement->fetchAll();

        return $getEvent;
    }

    /**
     * allow to get event where material is used
     * 
     * @return assoc_array from data base
     */
    public function getEventWithMaterial(\DateTimeImmutable $eventStart , \DateTimeImmutable $eventEnd){
        $this->PDO->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE , PDO::FETCH_ASSOC);
        $select = "select distinct *";
        $from = " from Event e join UsedEquipment u on e.eventId = u.eventId join Worksite w on e.worksiteId = w.worksiteId";
        $where = " where eventStartDate";
        $between = " between '{$eventStart->format('Y-m-d 00:00:00')}' and '{$eventEnd->format('Y-m-d 23:59:59')}'";
        $orderBy = " order by e.eventStartTime asc";
        
        $query = $select . $from . $where . $between . $orderBy;

        $statement = $this->PDO->query($query);
        $getEvent = $statement->fetchAll();

        return $getEvent;
    }

    /**
     * allow to get event for person connected 
     * 
     * @return assoc_array from data base
     */
    public function getEventForGivenPerson(\DateTimeImmutable $eventStart , \DateTimeImmutable $eventEnd){
        $this->PDO->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE , PDO::FETCH_ASSOC);
        $select = "select distinct *";
        $from = " from Affected a join Event e on a.eventId = e.eventId join Worksite w on e.worksiteId = w.worksiteId";
        $where = " where eventStartDate";
        $between = " between '{$eventStart->format('Y-m-d 00:00:00')}' and '{$eventEnd->format('Y-m-d 23:59:59')}' and a.userId =".$_SESSION['userId'];
        $orderBy = " order by e.eventStartTime asc";
        
        $query = $select . $from . $where . $between . $orderBy;

        $statement = $this->PDO->query($query);
        $getEvent = $statement->fetchAll();

        return $getEvent;
    }

    /**
     * allow to get the information about selected event
     * 
     * @return assoc_array from data base
     */
    public function getDetailSelectedEvent(\DateTimeImmutable $eventStart , \DateTimeImmutable $eventEnd){
        $this->PDO->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE , PDO::FETCH_ASSOC);

        /** Get employees */
        $selectEmployee = "select distinct *";
        $fromEmployee = " from Affected a join Event e on a.eventId = e.eventId";
        $whereEmployee = " where eventStartDate";
        $betweenEmployee = " between '{$eventStart->format('Y-m-d 00:00:00')}' and '{$eventEnd->format('Y-m-d 23:59:59')}' and a.eventId = 1";

        $queryEmployee = $selectEmployee . $fromEmployee . $whereEmployee . $betweenEmployee;

        $statementEmployee = $this->PDO->query($queryEmployee);
        $getEventEmployee = $statementEmployee->fetchAll();

        /** Get material */
        $selectMaterial = "select distinct *";
        $fromMaterial = " from UsedEquipment u join Event e on u.eventId = e.eventId";
        $whereMaterial = " where eventStartDate";
        $betweenMaterial = " between '{$eventStart->format('Y-m-d 00:00:00')}' and '{$eventEnd->format('Y-m-d 23:59:59')}' and u.eventId = 1 ;";

        $queryMaterial = $selectMaterial . $fromMaterial . $whereMaterial . $betweenMaterial;

        $statementMaterial = $this->PDO->query($queryMaterial);
        $getEventMaterial = $statementMaterial->fetchAll();

        /** Get vehicles */
        $selectVehicle = "select distinct *";
        $fromVehicle = " from GoTo g join Event e on g.eventId = e.eventId";
        $whereVehicle = " where eventStartDate";
        $betweenVehicle = " between '{$eventStart->format('Y-m-d 00:00:00')}' and '{$eventEnd->format('Y-m-d 23:59:59')}' and g.eventId = 1; ";
        
        $query = $selectVehicle . $fromVehicle . $whereVehicle . $betweenVehicle;

        $statementVehicle = $this->PDO->query($query);
        $getEventVehicle = $statementVehicle->fetchAll();

        // $getEvent = $getEventEmployee + $getEventMaterial + $getEventVehicle;

        return $getEventEmployee;
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