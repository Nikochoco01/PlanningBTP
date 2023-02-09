<?php
session_start();

const APP = __DIR__ . '/';
const TREAT = __DIR__ . "/private/treatment/";
include_once APP . "private/constant/constant.php";
include_once APP . "private/dataBase/Database.php";
include_once APP . "private/class/InputSecurityClass.php";

$path = $_SERVER["PATH_INFO"] ?? "/";
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

    case "/planning":
        var_dump($_SERVER['PATH_INFO']);
        if ($_SERVER["REQUEST_METHOD"] == "GET"){
            require APP . "public/planning.php";
        }
        if ($_SERVER["REQUEST_METHOD"] == "POST"){
            echo "add";
            var_dump($_SERVER['PATH_INFO']);
            require TREAT . "planningProcess/addEventProcess.php";
        }
        if ($_SERVER["REQUEST_METHOD"] == "POST" && $path == "/planning/modifyEventProcess.php"){
            var_dump($_SERVER['PATH_INFO']);
            require TREAT . "planningProcess/modifyEventProcess.php";
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

    case "/vehicle":
        if ($_SERVER["REQUEST_METHOD"] == "GET")
            require APP . "public/vehicleManagement.php";
        if ($_SERVER["REQUEST_METHOD"] == "POST")
            require TREAT . "vehicleProcess/newVehicle.php";
        break;

    case "/vehicleMod":
        if ($_SERVER["REQUEST_METHOD"] == "POST")
            require TREAT . "vehicleProcess/modifyVehicleProcess.php";
        break;

    case "/tool":
        if ($_SERVER["REQUEST_METHOD"] == "GET")
            require APP . "public/toolManagement.php";
        if ($_SERVER["REQUEST_METHOD"] == "POST")
            require TREAT . "toolProcess/newTool.php";
        break;

    case "/rmvTool":
        if ($_SERVER["REQUEST_METHOD"] == "POST")
            require TREAT . "toolProcess/RemoveToolProcess.php";
        break;

    case "/delete":
        if ($_SERVER["REQUEST_METHOD"] == "POST")
            require TREAT . "delete.php";
        break;

    case "/logout":
        if ($_SERVER["REQUEST_METHOD"] == "POST")
            require TREAT . "indexProcess/logOutProcess.php";
        break;

    default:
        header('HTTP/1.0 404 Not Found');
        exit;
}

$content = ob_get_clean();
echo $content;
