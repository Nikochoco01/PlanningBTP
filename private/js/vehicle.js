const n = document.getElementById("n").value;
//console.log(n);
function hideSeatBeyonMax(license, seatNbs){
    //console.log(license.options[license.selectedIndex], license.options[license.selectedIndex].getAttribute("max"));
    for(let seatNb of seatNbs){
        if(parseInt(seatNb.value, 10) <= parseInt(license.options[license.selectedIndex].getAttribute("max"), 10)){
            seatNb.removeAttribute("hidden");
        }else{
            seatNb.setAttribute("hidden", '');
        }
    }
}
for(let i = 0; i < n; i++){
    const license = document.getElementById("license"+i);
    const seatNbs = document.querySelectorAll("#maxPassenger"+ i +" option");
    hideSeatBeyonMax(license, seatNbs);
    license.addEventListener("change", event => {
        hideSeatBeyonMax(license, seatNbs);
    });
}
const license = document.getElementById("license");
const seatNbs = document.querySelectorAll("#maxPassenger option");
hideSeatBeyonMax(license, seatNbs);
license.addEventListener("change", event => {
    hideSeatBeyonMax(license, seatNbs);
});