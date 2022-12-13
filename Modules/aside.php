<?php 
    include 'constant.php';

    function addUser(){
        if($_SESSION['userFonction'] ==="administrator"){
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
                    <a href="accueil.php">
                        <i class="icon-home"></i>
                            <span class="nav-text">
                                Accueil
                            </span>
                    </a>
                </li>
                <li class="has-subnav">
                    <a href="profil.php?onglet=<?= PARAM_PROFIL_ONGLET ?>&display=<?= PARAM_PROFIL_DISPLAY ?><?=addUser() ?> ">
                        <i class="icon-id-card"></i>
                            <span class="nav-text">
                                Profil
                            </span>
                    </a>
                </li>
                <li class="has-subnav">
                    <a href="planning.php?onglet=<?= PARAM_PLANNING_ONGLET ?>&display=<?= PARAM_PLANNING_DISPLAY ?>&month=<?= date('m') ?>&year=<?= date('Y') ?>&week=<?=1 ?>">
                        <i class="icon-calendar"></i>
                            <span class="nav-text">
                                Planning
                            </span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="icon-clock"></i>
                            <span class="nav-text">
                                Horaires
                            </span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="icon-euro"></i>
                            <span class="nav-text">
                                Frais
                            </span>
                    </a>
                </li>
                <li>
                    <a href="vehicleManagement.php">
                        <i class="icon-warehouse"></i>
                            <span class="nav-text">
                                Véhicule
                            </span>
                    </a>
                </li>
                <li>
                    <a href="toolManagement.php">
                        <i class="icon-tool"></i>
                            <span class="nav-text">
                                Matériel
                            </span>
                        </a>
                </li>
            </ul>
        </nav>
    </aside>