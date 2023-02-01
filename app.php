<?php
session_start();

const APP = __DIR__ . '/';
const TREAT = __DIR__ . "/private/treatment/";

$path = $_SERVER["PATH_INFO"]??"/";

switch($path){

    case "/":
        if($_SERVER["REQUEST_METHOD"] == "GET")
            require APP . "index.php";
        if($_SERVER["REQUEST_METHOD"] == "POST")
            require TREAT . "indexProcess/logInProcess.php";
        break;
    
    case "/home":
        require APP . "public/home.php";
        break;

    case "/profil":
        require APP . "public/profil.php";
        break;
    
    case "/addEmployee":
        if($_SERVER["REQUEST_METHOD"] == "POST")
            require TREAT . "profileProcess/addProcess.php";
        break;
    
    case "/modifyEmployee":
        if($_SERVER["REQUEST_METHOD"] == "POST")
            require TREAT . "profileProcess/modifyProcess.php";
        break;
    
    case "/planning":
        require APP . "public/planning.php";
        break;

    case "/schedule":
        if($_SERVER["REQUEST_METHOD"] == "GET")
            require APP . "public/schedule.php";
        if($_SERVER["REQUEST_METHOD"] == "POST")
            require TREAT . "scheduleProcess.php";
        break;

    case "/expenditure":
        if($_SERVER["REQUEST_METHOD"] == "GET")
            require APP . "public/expenditure.php";
        if($_SERVER["REQUEST_METHOD"] == "POST")
            require TREAT . "expenditureProcess/newExpenditure.php";
        break;

    case "/vehicle":
        if($_SERVER["REQUEST_METHOD"] == "GET")
            require APP . "public/vehicleManagement.php";
        if($_SERVER["REQUEST_METHOD"] == "POST")
            require TREAT . "vehicleProcess/newVehicle.php";
        break;

    case "/vehicleMod":
        if($_SERVER["REQUEST_METHOD"] == "POST")
            require TREAT . "vehicleProcess/modifyVehicleProcess.php";
        break;

    case "/tool":
        if($_SERVER["REQUEST_METHOD"] == "GET")
            require APP . "public/toolManagement.php";
        if($_SERVER["REQUEST_METHOD"] == "POST")
            require TREAT . "toolProcess/newTool.php";
        break;

    case "/rmvTool":
        if($_SERVER["REQUEST_METHOD"] == "POST")
            require TREAT . "toolProcess/RemoveToolProcess.php";
        break;

    case "/delete":
        if($_SERVER["REQUEST_METHOD"] == "POST")
            require TREAT . "delete.php";
        break;

    case "/logout":
        if($_SERVER["REQUEST_METHOD"] == "POST")
            require TREAT . "indexProcess/logOutProcess.php";
        break;

    default:
        header('HTTP/1.0 404 Not Found');
        exit;
}