const n = document.getElementById("n").value;
function hideSeatBeyonMax(license, seatNbs){
    for(let seatNb of seatNbs){
        if(parseInt(seatNb.value) <= parseInt(license.options[license.selectedIndex].getAttribute("max"))){
            seatNb.removeAttribute("hidden");
            seatNb.removeAttribute("disabled");
            if(seatNbs.options[seatNbs.selectedIndex].value > parseInt(license.options[license.selectedIndex].getAttribute("max")) 
                && parseInt(seatNb.value) == parseInt(license.options[license.selectedIndex].getAttribute("max"))){
                    seatNbs.value = seatNb.value;
            }
        }else{
            seatNb.setAttribute("hidden", '');
            seatNb.setAttribute("disabled", '');
        }
    }
}
for(let i = 0; i < n; i++){
    const license = document.getElementById("license"+i);
    const seatNbs = document.getElementById("maxPassenger"+i);
    hideSeatBeyonMax(license, seatNbs);
    license.addEventListener("change", event => {
        hideSeatBeyonMax(license, seatNbs);
    });
}
const license = document.getElementById("license");
const seatNbs = document.getElementById("maxPassenger");
hideSeatBeyonMax(license, seatNbs);
license.addEventListener("change", event => {
    hideSeatBeyonMax(license, seatNbs);
});