let planningContent = document.getElementById('planningContent');


// Classes : 

class Mission{

    constructor(MissionName , Employee , MissionMateriel , MissionVehicule, MissionAdress , StartTime , EndTime){
        this.missionName = MissionName;
        this.missionEmployee = Employee;
        this.missionMateriel = MissionMateriel;
        this.missionVehicule = MissionVehicule;
        this.missionAdress = MissionAdress;
        this.startTime = StartTime;
        this.endTime = EndTime;
    }

    printMission(ParentElement){

        /* Create variables and objects */
        let mission = document.createElement('div');
        let missionName = document.createElement('p');
        let missionEmployee = document.createElement('div');
        let missionMateriel = document.createElement('div');
        let missionVehicule = document.createElement('div');
        let missionAdress = document.createElement('p');
        let missionSchedule = document.createElement('p');
        let separate = document.createElement('span');
        let missionStartTime = document.createElement('span');
        let missionEndTime = document.createElement('span');

        /* add class to the elements */
        mission.classList = 'mission';
        missionName.classList = 'missionName';
        missionEmployee.classList = 'employeeList';
        missionMateriel.classList = 'meterielList';
        missionVehicule.classList = 'vehiculeLit';
        missionAdress.classList = 'missionAddress';
        missionSchedule.classList = 'missionSchedule';
        separate.classList = 'separate';

        /* modify the text in the elements */
        missionName.innerText = this.missionName;
        missionEmployee.innerHTML = this.missionEmployee;
        missionMateriel.innerHTML = this.missionMateriel;
        missionVehicule.innerHTML = this.missionVehicule;
        missionAdress.innerText = this.missionAdress;
        missionStartTime.innerText = this.startTime;
        separate.innerText = ' - ';
        missionEndTime.innerText = this.endTime;

        /* add element to the object Mission  */
        mission.appendChild(missionName);
        mission.appendChild(missionEmployee);
        mission.appendChild(missionMateriel);
        mission.appendChild(missionVehicule);
        mission.appendChild(missionAdress);
        mission.appendChild(missionSchedule);

        missionSchedule.appendChild(missionStartTime);
        missionSchedule.appendChild(separate);
        missionSchedule.appendChild(missionEndTime);
        
        ParentElement.appendChild(mission);
    }

}

let day1 = document.getElementById('day1');
let test = document.getElementById('dayView');

let mission1 = new Mission('Maison Ducro' , 'Nikola' , 'pelle , pioche' , 'Fourgon' , '34 rue de la mort' , '11h00' , '14h00');
console.log(mission1);

mission1.printMission(test);