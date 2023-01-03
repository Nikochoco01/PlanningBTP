<?php 
    include_once dirname(__FILE__,2). "/constant.php";

    function addUser(){
        if($_SESSION['userFonction'] === "administrator"){
            return "&add=false";
        }
        else{
            return "";
        }
    }
?>

    <aside>
        <nav class="mainMenu">
            <ul>
                <li>
                    <a href="<?= LINK_TO_HOME ?>">
                        <i class="icon-home"></i>
                            <span class="nav-text">
                                Accueil
                            </span>
                    </a>
                </li>
                <li class="has-subnav">
                    <a href="<?= LINK_TO_PROFIL.addUser() ?>">
                        <i class="icon-id-card"></i>
                            <span class="nav-text">
                                Profil
                            </span>
                    </a>
                </li>
                <li class="has-subnav">
                    <a href="<?= LINK_TO_PLANNING."&month=".date('m')."&year=".date('Y')."&week="."1" ?>">
                        <i class="icon-calendar"></i>
                            <span class="nav-text">
                                Planning
                            </span>
                    </a>
                </li>
                <li>
                    <a href="<?= LINK_TO_SCHEDULES?>">
                        <i class="icon-clock"></i>
                            <span class="nav-text">
                                Horaires
                            </span>
                    </a>
                </li>
                <li>
                    <a href="<?= LINK_TO_EXPENDITURE ?>">
                        <i class="icon-euro"></i>
                            <span class="nav-text">
                                Frais
                            </span>
                    </a>
                </li>
                <li>
                    <a href="<?= LINK_TO_VEHICLE_MANAGEMENT?>">
                        <i class="icon-warehouse"></i>
                            <span class="nav-text">
                                Véhicule
                            </span>
                    </a>
                </li>
                <li>
                    <a href="<?= LINK_TO_TOOL_MANAGEMENT ?>">
                        <i class="icon-tool"></i>
                            <span class="nav-text">
                                Matériel
                            </span>
                        </a>
                </li>
            </ul>
        </nav>
    </aside>