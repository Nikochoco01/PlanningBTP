<?php include 'Constant.php' ?>

<div class="layout">
        <aside>
            <nav class="main-menu">
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
                        <a href="">
                            <i class="icon-user"></i>
                            <span class="nav-text">
                                Profil
                            </span>
                        </a>
                    </li>
                    <li class="has-subnav">
                        <a href="planning.php?onglet=<?php echo paramOnglet ?>&display=<?php echo paramDisplay ?>">
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
                            <i class="icon-coin-euro"></i>
                            <span class="nav-text">
                                Frais
                            </span>
                        </a>
                    </li>
                    <li>
                    <a href="#">
                        <i class="icon-truck"></i>
                            <span class="nav-text">
                                Véhicule
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="icon-wrench"></i>
                                <span class="nav-text">
                                    Matériel
                                </span>
                            </a>
                        </li>
                </ul>
            </nav>
        </aside>