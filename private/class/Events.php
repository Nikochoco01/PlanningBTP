<?php
class Events{
   
    // public $PDO;
    private $dataBase;
    function __construct($dataBase)
    {
        // $this->PDO = $dataBase;
        $this->dataBase = $dataBase;
    }

    /**
     * allow to get an event with his ID
     * 
     * @return array from data base
     */
        public function getEvent($eventId = null){

            if($eventId != null){
               return $this->dataBase->read("Event" , [
                        "conditions" => ["eventId" => $eventId],
                        "fields" => ["distinct *"]
                    ]);
            }
            return [];
        }


    /**
     * allow to get all worksite from de data base
     * 
     * @return array from data base
     */
        public function getWorksite($view , $worksiteId = null){

            if($worksiteId != null && $view == "view"){
                return $this->dataBase->read("Worksite",[
                    "conditions" => ["worksiteId" => $worksiteId],
                    "fields" => ["distinct *"]
                ]);
            }
    
            if($worksiteId == null && $view == "modify"){
                return $this->dataBase->read("Worksite",[
                    "fields" => ["distinct *"]
                ]);
            }
        }

    /**
     * allow to get all employees from de data base
     * 
     * @return array from data base
     */
    public function getEmployee($view, $employeeId = null){

        if($employeeId != null && $view == "view"){
            return $this->dataBase->read("User",[
                "conditions" => ["userId" => $employeeId],
                "fields" => ["distinct *"]
            ]);
        }

        if($employeeId == null && $view == "modify"){
            return $this->dataBase->read("User",[
                "fields" => ["distinct *"]
            ]);
        }
    }

    /**
     * allow to get all Material from de data base
     * 
     * @return array from data base
     */
    public function getMaterial($view ,$eventId = null){
        if($eventId != null && $view == "view"){
            return $this->dataBase->read("Equipment e left join UsedEquipment u on e.equipmentName = u.equipmentName",[
                "conditions" => ["eventId =" => $eventId],
                "fields" => ["distinct *"]
            ]);
        }

        if($eventId == null && $view == "modify"){
            return $this->dataBase->read("Equipment e left join UsedEquipment u on e.equipmentName = u.equipmentName",[
                "conditions" => ["eventId is" => null],
                "fields" => ["distinct *"]
            ]);
        }
    }

    /**
     * allow to get all Vehicles from de data base
     * 
     * @return array from data base
     */
    public function getVehicles($view ,$eventId = null){

        if($eventId != null && $view == "view"){
            return $this->dataBase->read("Vehicle v left join GoTo g on v.vehicleId = g.vehicleId",[
                "conditions" => ["eventId =" => $eventId],
                "fields" => ["distinct *"]
            ]);
        }

        if($eventId == null && $view == "modify"){
            return $this->dataBase->read("Vehicle v left join GoTo g on v.vehicleId = g.vehicleId",[
                "conditions" => ["eventId is" => null],
                "fields" => ["distinct *"]
            ]);
        }
    }

    /**
     * allow to get an event in the data base
     * 
     * @return array from data base
     */
    public function getEventBetween(\DateTimeImmutable $eventStart , \DateTimeImmutable $eventEnd){

        return $this->dataBase->read("Event e join Worksite w on w.worksiteId = e.worksiteId", [
            "conditions" => [
                "eventStartDate between" => $eventStart->format('Y-m-d 00:00:00'),
                " " => $eventEnd->format('Y-m-d 23:59:59')
            ],
            "fields" => ["distinct *"],
            "order" => ["e.eventStartTime asc"]
        ]);
    }

    /**
     * allow to group event by day
     * 
     * @return array
     */
    public function getEventBetweenByDay(\DateTimeImmutable $eventStart , \DateTimeImmutable $eventEnd , ?string $page = null){
        $events = "";

        switch($page){
            case "employee":
                    $events = $this->getEventForGivenPerson($eventStart , $eventEnd);
                break;
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
            $date = explode(' ' , $event->eventStartDate)[0];
            if(!isset($days[$date])){
                $days[$date] = [$event];
            }
            else{
                $days[$date][] = $event;
                // echo "<pre>";
                // var_dump($days[$date]);
                // echo "</pre>";
            }
        }
        return $days;
    }

    /**
     * allow to get event where employees is it 
     * 
     * @return array from data base
     */
    public function getEventWithEmployees(\DateTimeImmutable $eventStart , \DateTimeImmutable $eventEnd){

        return $this->dataBase->read("Event e join Affected a on e.eventId = a.eventId join Worksite w on e.worksiteId = w.worksiteId", [
            "conditions" => [
                "eventStartDate between" => $eventStart->format('Y-m-d 00:00:00'),
                " " => $eventEnd->format('Y-m-d 23:59:59')
            ],
            "fields" => ["distinct *"],
            "order" => ["e.eventStartTime asc"]
        ]);
    }

    /**
     * allow to get event where vehicles is used
     * 
     * @return array from data base
     */
    public function getEventWithVehicles(\DateTimeImmutable $eventStart , \DateTimeImmutable $eventEnd){

        return $this->dataBase->read("Event e join GoTo g on e.eventId = g.eventId join Worksite w on e.worksiteId = w.worksiteId", [
            "conditions" => [
                "eventStartDate between" => $eventStart->format('Y-m-d 00:00:00'),
                " " => $eventEnd->format('Y-m-d 23:59:59')
            ],
            "fields" => ["distinct *"],
            "order" => ["e.eventStartTime asc"]
        ]);
    }

    /**
     * allow to get event where material is used
     * 
     * @return array from data base
     */
    public function getEventWithMaterial(\DateTimeImmutable $eventStart , \DateTimeImmutable $eventEnd){

        return $this->dataBase->read("Event e join UsedEquipment u on e.eventId = u.eventId join Worksite w on e.worksiteId = w.worksiteId", [
            "conditions" => [
                "eventStartDate between" => $eventStart->format('Y-m-d 00:00:00'),
                " " => $eventEnd->format('Y-m-d 23:59:59')
            ],
            "fields" => ["distinct *"],
            "order" => ["e.eventStartTime asc"]
        ]);
    }

    /**
     * allow to get event for person connected 
     * 
     * @return array from data base
     */
    public function getEventForGivenPerson(\DateTimeImmutable $eventStart , \DateTimeImmutable $eventEnd){

        return $this->dataBase->read("Affected a join Event e on a.eventId = e.eventId join Worksite w on e.worksiteId = w.worksiteId", [
            "conditions" => [
                "eventStartDate between" => $eventStart->format('Y-m-d 00:00:00'),
                " " => $eventEnd->format('Y-m-d 23:59:59'),
                " a.userId" => [$_SESSION['userId']]
            ],
            "fields" => ["distinct *"],
            "order" => ["e.eventStartTime asc"]
        ]);
    }

    /**
     * allow to get the information about selected event
     * 
     * @return array from data base
     */
    public function getDetailSelectedEvent($eventId){

        return $this->dataBase->read("Event e join Affected a on e.eventId = a.eventId 
                                        left outer join UsedEquipment u on e.eventId = u.eventId 
                                        left outer join GoTo g on e.eventId = g.eventId", [
            "conditions" => ["e.eventId" => "$eventId"],
            "fields" => ["e.eventId, e.worksiteId, GROUP_CONCAT(distinct(a.userId)) userId, 
                            GROUP_CONCAT(distinct(u.equipmentId)) equipment, 
                            GROUP_CONCAT(distinct(g.vehicleId)) vehicle"],
            "order" => ["e.eventId, a.userId, e.worksiteId"]
        ]);
    }
}

?>