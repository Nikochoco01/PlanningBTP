<?php include 'constant.php' ?>

    <aside>
        <nav class="main-menu">
            <ul>
                <li>
                    <a href="accueil.php?userRole=<?php echo $_SESSION['userRole']?>">
                        <i class="icon-home"></i>
                            <span class="nav-text">
                                Accueil
                            </span>
                    </a>
                </li>
                <li class="has-subnav">
                    <a href="profil.php?userRole=<?php echo $_SESSION['userRole']?>&onglet=<?php echo PARAM_PROFIL_ONGLET ?>&display=<?php echo PARAM_PROFIL_DISPLAY ?>">
                        <i class="icon-id-card"></i>
                            <span class="nav-text">
                                Profil
                            </span>
                    </a>
                </li>
                <li class="has-subnav">
                    <a href="planning.php?userRole=<?php echo $_SESSION['userRole']?>&onglet=<?php echo PARAM_PLANNING_ONGLET ?>&display=<?php echo PARAM_PLANNING_DISPLAY ?>&month=<?php echo date('m') ?>&year=<?php echo date('Y') ?>">
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
                    <a href="invoice.php">
                        <i class="icon-euro"></i>
                            <span class="nav-text">
                                Frais
                            </span>
                    </a>
                </li>
                <li>
                    <a href="vehicle.php#">
                        <i class="icon-warehouse"></i>
                            <span class="nav-text">
                                Véhicule
                            </span>
                    </a>
                </li>
                <li>
                    <a href="material.php">
                        <i class="icon-tool"></i>
                            <span class="nav-text">
                                Matériel
                            </span>
                        </a>
                </li>
            </ul>
        </nav>
    </aside>