<?php
if($_SERVER['SCRIPT_NAME'] === '/profil.php'):
?>
<nav class="navTab">
    <ul>
        <li class="buttonTabs <?php echo activeTab("Personal") ?>">
            <a href=" <?php echo addUrlParam(array('onglet' => 'Personal')) ?>">
                <i class="icon-user"></i> Personnel
            </a>
        </li>

        <li class="buttonTabs <?php echo activeTab("Employees") ?>">
            <a href=" <?php echo addUrlParam(array('onglet' => 'Employees'))?>">
               <i class="icon-users-group"></i> Employés
            </a>
        </li>
    </ul>
</nav>

<?php 
    endif;

    if($_SERVER['SCRIPT_NAME'] === '/planning.php'):
?>

<nav class="navTab">
    <ul>
        <li class="buttonTabs <?php echo activeTab("Missions") ?>"> 
            <a href=" <?php echo addUrlParam(array('onglet'=>'Missions')) ?>">
                <i class="icon-clipboard-list"></i> Missions 
            </a>
        </li>
        
        <li class="buttonTabs <?php echo activeTab("Employees") ?>"> 
            <a href=" <?php echo addUrlParam(array('onglet'=>'Employees')) ?>">
                <i class="icon-users-group"></i> Employés 
            </a>
        </li>

        <li class="buttonTabs <?php echo activeTab("Vehicles") ?>"> 
            <a href=" <?php echo addUrlParam(array('onglet'=>'Vehicles')) ?>">
                <i class="icon-warehouse"></i> Véhicules 
            </a>
        </li>
        
        <li class="buttonTabs <?php echo activeTab("Material") ?>"> 
            <a href=" <?php echo addUrlParam(array('onglet'=>'Material')) ?>">
                <i class="icon-tool"></i> Matériel 
            </a>
        </li>

        <li class="buttonChangeView"> <a href=" <?php echo displayType(); ?>" class="" id="buttonChangeView"> <i class="icon-home"></i></a> </li>
    </ul>
</nav>

<?php endif; ?>