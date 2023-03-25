<?php 
    include_once APP . "private/constant/constant.php";
    include_once APP . "private/class/Month.php";

    $month = new Month($_GET['month'] ?? null, $_GET['year'] ?? null , $_GET['week'] ?? null , $_GET['day'] ?? null);
    $weeks = $month->getWeeks();
    $firstDay = $month->getFirstDay();
    $firstDay = $firstDay->format('N') === '1' ? $firstDay : $month->getFirstDay()->modify('last Monday');
?>

<aside class="aside-menu bg-color-gray">
    <nav class="main-menu">
        <ul>
            <li>
                <a href="home">
                    <i class="icon-home"></i>
                        <span class="nav-text">
                            Accueil
                        </span>
                </a>
            </li>
            <li class="has-subnav">
                <a href="profil?onglet=personal&display=view">
                    <i class="icon-id-card"></i>
                        <span class="nav-text">
                            Profil
                        </span>
                </a>
            </li>
            <li class="has-subnav">
                    <a href="<?= "planning?onglet=missions&display=week&year=".date('Y')."&month=".date('m')."&week=".$month->getCurrentWeek() ?>">
                    <i class="icon-calendar"></i>
                        <span class="nav-text">
                            Planning
                        </span>
                </a>
            </li>
            <li>
                <a href="schedule">
                    <i class="icon-clock"></i>
                        <span class="nav-text">
                            Horaires
                        </span>
                </a>
            </li>
            <li>
                <a href="expenditure">
                    <i class="icon-euro"></i>
                        <span class="nav-text">
                            Frais
                        </span>
                </a>
            </li>
            <li>
                <a href="vehicle">
                    <i class="icon-warehouse"></i>
                        <span class="nav-text">
                            Véhicule
                        </span>
                </a>
            </li>
            <li>
                <a href="tool">
                    <i class="icon-tool"></i>
                        <span class="nav-text">
                            Matériel
                        </span>
                </a>
            </li>
        </ul>
    </nav>
</aside>