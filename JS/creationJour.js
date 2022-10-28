class Day{
    constructor(){
        this.mission = [];
    }

    addMission(mission){
        this.mission.push(mission);
    }

    deleteMission(){
        this.mission.splice(0,1);
    }

    printMission(zoneAffichage){
        this.mission.forEach(miss =>{
            console.log(miss.name);
        })
    }
}

class Mission{
    constructor(nameMission , employee , missionAddress , startTimeMission , endTimeMission){
        this.missionName = nameMission;
        this.employee = employee;
        this.missionAddress = missionAddress;
        this.startTime = startTimeMission;
        this.endTime = endTimeMission;

        let name = document.createElement('p');
        let employees = document.createElement('p');
        let address = document.createElement('p');
        let startT = document.createElement('p');
        let endT = document.createElement('p');

        name.innerText = this.missionName;
        employees.innerText = this.employee;
        address.innerText = this.missionAddress;
        startT.innerText = this.startTime;
        endT.innerText = this.endTime;
    }
}

let buttonAddDay = document.getElementById('addDay');

let zoneAffichage = document.getElementById('dayView');

let jour; 

let mission = new Mission('test' , 'Nikola' , '22 rue peter fink' , '7h00' , '18h00');

// buttonAddDay.addEventListener('click' , () =>{
    jour = new Day();
    jour.addMission(mission);
    jour.printMission(zoneAffichage);
    console.log(mission);
// })