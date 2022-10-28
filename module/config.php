<?php 

/** Function for add a parameter to the URL */
function addUrlParam($params=array()){
	$p = array_merge($_GET, $params);
	$qs = http_build_query($p);
	return basename($_SERVER['PHP_SELF']).'?'.$qs;
}

/** function that add the active class to the buttons */
function activeTab($tab){
    if($_GET['onglet'] == $tab){
        return "activeTab";
    }
}

/** Function to switch between day week month view on the calendar */
function displayType(){
    if($_GET['display'] == 'week'){
        return addUrlParam(array('display'=> 'month'));
    }
    else if ($_GET['display'] == 'month'){
        return addUrlParam(array('display'=> 'day'));
    }
    else{
        return addUrlParam(array('display'=> 'week'));
    }
}

function displayType2($type){
        return addUrlParam(array('display'=> $type));
}