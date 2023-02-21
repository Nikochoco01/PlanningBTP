<?php

session_start();

const APP = __DIR__ . '/';
const TREAT = __DIR__ . "/private/treatment/";
const PRIVE = __DIR__ . "/private/";

include_once APP . "private/constant/constant.php";
include_once APP . "private/dataBase/Database.php";
include_once APP . "private/dataBase/dataBaseConnection.php";
include_once APP . "private/class/InputSecurityClass.php";
include_once APP . "private/class/Database.php";

$db = new Database;
include_once APP . "private/treatment/profileProcess/searchProcess.php";


$path = $_SERVER["PATH_INFO"] ?? "/";
$dataBase = new Database();

$dataBase = new Database();

ob_start();

switch ($path) {

    case "/":
        if ($_SERVER["REQUEST_METHOD"] == "GET")
            require APP . "index.php";
        if ($_SERVER["REQUEST_METHOD"] == "POST")
            require TREAT . "indexProcess/logInProcess.php";
        break;

    case "/home":
        require APP . "public/home.php";
        break;

    case "/profil":
        require APP . "public/profil.php";
        break;

    case "/addEmployee":
        if ($_SERVER["REQUEST_METHOD"] == "POST")
            require TREAT . "profileProcess/addProcess.php";
        break;

    case "/modifyEmployee":
        if ($_SERVER["REQUEST_METHOD"] == "POST")
            require TREAT . "profileProcess/modifyProcess.php";
        break;

    case "/modifyEvent":
        if ($_SERVER["REQUEST_METHOD"] == "POST" && $path=="/modifyEvent"){
            var_dump($_SERVER['PATH_INFO']);
            require TREAT . "planningProcess/modifyEventProcess.php";
        }
        break;

    case "/planning":
        // var_dump($_SERVER['PATH_INFO']);
        if ($_SERVER["REQUEST_METHOD"] == "GET"){
            require APP . "public/planning.php";
        }
        if ($_SERVER["REQUEST_METHOD"] == "POST"){
            echo "add";
            var_dump($_SERVER['PATH_INFO']);
            require TREAT . "planningProcess/addEventProcess.php";
        }
        break;

    case "/schedule":
        if ($_SERVER["REQUEST_METHOD"] == "GET")
            require APP . "public/schedule.php";
        if ($_SERVER["REQUEST_METHOD"] == "POST")
            require TREAT . "scheduleProcess.php";
        break;

    case "/expenditure":
        if ($_SERVER["REQUEST_METHOD"] == "GET")
            require APP . "public/expenditure.php";
        if ($_SERVER["REQUEST_METHOD"] == "POST")
            require TREAT . "expenditureProcess/newExpenditure.php";
        break;

    case "/deleteExpenditure":
        if($_SERVER["REQUEST_METHOD"] == "POST")
            require TREAT . "expenditureProcess/deleteExpenditure.php";
        else
            header("Location:".$_SERVER['HTTP_REFERER']);
        break;

    case "/vehicle":
        if ($_SERVER["REQUEST_METHOD"] == "GET")
            require APP . "public/vehicleManagement.php";
        if ($_SERVER["REQUEST_METHOD"] == "POST")
            require TREAT . "vehicleProcess/newVehicle.php";
        break;

    case "/vehicleMod":
        if ($_SERVER["REQUEST_METHOD"] == "POST")
            require TREAT . "vehicleProcess/modifyVehicleProcess.php";
        else            
            header("Location:".$_SERVER['HTTP_REFERER']);
        break;

    case "/tool":
        if ($_SERVER["REQUEST_METHOD"] == "GET")
            require APP . "public/toolManagement.php";
        if ($_SERVER["REQUEST_METHOD"] == "POST")
            require TREAT . "toolProcess/newTool.php";
        break;

    case "/rmvTool":
        if($_SERVER["REQUEST_METHOD"] == "POST")
            require TREAT . "toolProcess/removeToolProcess.php";
        else            
            header("Location:".$_SERVER['HTTP_REFERER']);
        break;
    
    case "/deleteTool":
        if($_SERVER["REQUEST_METHOD"] == "POST")
            require TREAT . "toolProcess/deleteTool.php";
        else            
            header("Location:".$_SERVER['HTTP_REFERER']);
        break;

    case "/vehicleDelete":
        if($_SERVER["REQUEST_METHOD"] == "POST")
            require TREAT . "vehicleProcess/deleteVehicle.php";
        else            
            header("Location:".$_SERVER['HTTP_REFERER']);
        break;

    case "/logout":
        if ($_SERVER["REQUEST_METHOD"] == "POST")
            require TREAT . "indexProcess/logOutProcess.php";
        else            
            header("Location:".$_SERVER['HTTP_REFERER']);
        break;

    default:
        header('HTTP/1.0 404 Not Found');
        exit;
}

$content = ob_get_clean();
echo $content;
