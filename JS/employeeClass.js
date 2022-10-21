class Employee{
    constructor(ProfilPic , EmployeeName , EmployeeSurname , EmployeePhone , EmployeeMail , EmployeePosition){
        this.employeePic = ProfilPic;
        this.employeeName = EmployeeName;
        this.employeeSurname = EmployeeSurname;
        this.employeePhone = EmployeePhone;
        this.employeeMail = EmployeeMail;
        this.employeePosition = EmployeePosition;
    }
}

// class employeeList{
//     constructor(){
//         this.employeeList = [];
//     }

//     addEmployee(employee){
//         this.employeeList.push(employee);
//     }

//     deleteEmployee(){

//     }
// }



let employee1 = new Employee('pic' , 'Chevalliot' , 'Nikola' , '06 56 78 22 41' , 'nikochoco01@gmail.com' , 'Directeur');

console.log(employee1);