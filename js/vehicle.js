const license = document.getElementById("license");
const seatNbs = document.querySelectorAll("#maxPassenger option");

function hideSeatBeyonMax(license, seatNbs){
    console.log(license.options[license.selectedIndex], license.options[license.selectedIndex].getAttribute("max"));
    for(let seatNb of seatNbs){
        if(seatNb.value <= license.options[license.selectedIndex].getAttribute("max")){
            seatNb.removeAttribute("hidden");
        }else{
            seatNb.setAttribute("hidden", '');
        }
        console.log(seatNb, seatNb.value, seatNb.value <= license.options[license.selectedIndex].getAttribute("max"));
    }
}
hideSeatBeyonMax(license, seatNbs);
license.addEventListener("change", event => {
    hideSeatBeyonMax(license, seatNbs);
});