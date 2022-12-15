const worksite = document.getElementById("worksite");
const events = document.querySelectorAll("#event option");

function hideUnrelatedEvents(worksite, events){
    //console.log(worksite);
    for(let event of events){
        if(event.getAttribute("worksite") != worksite.value && event.getAttribute("worksite") != ""){
            event.setAttribute("hidden", '');
        }else{
            event.removeAttribute("hidden");
        }
        //console.log(event);
    }
}
hideUnrelatedEvents(worksite, events);
worksite.addEventListener("change", event => {
    hideUnrelatedEvents(worksite, events);
});