<?php 
function translateDate(){
    $day = "";
    $month = "";

    switch(date("l")){
        case "Monday":
                $day = "Lundi";
            break;
        case "Tuesday":
                $day = "Mardi";
            break;
        case "Wednesday":
                $day = "Mercredi";
            break;
        case "Thursday":
                $day = "Jeudi";
            break;
        case "Friday":
                $day = "Vendredi";
            break;
        case "Saturday":
                $day = "Samedi";
            break;
        case "Sunday":
                $day = "Dimanche";
            break;
    }

    switch(date("F")){
        case "January":
                $month = "Janvier";
            break;
        case "February":
                $month = "Février";
            break;
        case "March":
                $month = "Mars";
            break;
        case "April":
                $month = "Avril";
            break;
        case "May":
                $day = "Mai";
            break;
        case "June":
                $day = "Juin";
            break;
        case "July":
                $day = "Juillet";
            break;
        case "August":
                $day = "Août";
            break;
        case "September":
                $month = "Septembre";
            break;
        case "October":
                $month = "Octobre";
            break;
        case "November":
                $month = "Novembre";
            break;
        case "December":
                $month = "Décembre";
            break;
    }

    echo $day . " " . date("j") . " " . $month;
}


?>

<div class="tab">
    <h2> <?php translateDate() ?> </h2>
    <section id="morning">
        <p>Matin</p>
    </section>

    <section id="afternoon">
        <p>Après Midi</p>
    </section>
</div>