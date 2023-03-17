<?php
if($path === '/profil'):
?>
<nav class="nav-tab">
    <ul class="tab-list">
        <li class="tab-list-element bg-color-gray <?= URLManagement::activeTab(PARAM_PERSONAL_ONGLET) ?>">
            <a class="btn-link text-color-white width-100 height-100" href=" <?= URLManagement::addUrlParam(array('onglet' => PARAM_PERSONAL_ONGLET , 'display' => PARAM_VIEW_DISPLAY)) ?>">
                <i class="icon-user margin-right-5"></i> Personnel
            </a>
        </li>

        <li class="tab-list-element bg-color-gray <?= URLManagement::activeTab(PARAM_EMPLOYEE_ONGLET) ?>">
            <a class="btn-link text-color-white width-100 height-100" href=" <?= URLManagement::addUrlParam(array('onglet' => PARAM_EMPLOYEE_ONGLET , 'display' => PARAM_VIEW_DISPLAY))?>">
               <i class="icon-users-group margin-right-5"></i> Employés
            </a>
        </li>
    </ul>
</nav>

<?php 
    endif;

    if($path === '/planning'):
?>

<nav class="nav-tab">
    <ul class="tab-list">
        <li class="tab-list-element bg-color-gray <?= URLManagement::activeTab(PARAM_MISSION_ONGLET) ?>"> 
            <a class="btn-link text-color-white width-100 height-100" href=" <?= URLManagement::addUrlParam(array('onglet'=> PARAM_MISSION_ONGLET)) ?>">
                <i class="icon-clipboard-list"></i> Missions 
            </a>
        </li>
        
        <li class="tab-list-element bg-color-gray <?= URLManagement::activeTab(PARAM_EMPLOYEE_ONGLET) ?>"> 
            <a class="btn-link text-color-white width-100 height-100" href=" <?= URLManagement::addUrlParam(array('onglet'=> PARAM_EMPLOYEE_ONGLET)) ?>">
                <i class="icon-users-group"></i> Employés 
            </a>
        </li>

        <li class="tab-list-element bg-color-gray <?= URLManagement::activeTab(PARAM_VEHICLES_ONGLET) ?>"> 
            <a class="btn-link text-color-white width-100 height-100" href=" <?= URLManagement::addUrlParam(array('onglet'=> PARAM_VEHICLES_ONGLET)) ?>">
                <i class="icon-warehouse"></i> Véhicules 
            </a>
        </li>
        
        <li class="tab-list-element bg-color-gray <?= URLManagement::activeTab(PARAM_MATERIAL_ONGLET) ?>"> 
            <a class="btn-link text-color-white width-100 height-100" href=" <?= URLManagement::addUrlParam(array('onglet'=> PARAM_MATERIAL_ONGLET)) ?>">
                <i class="icon-tool"></i> Matériel 
            </a>
        </li>
    </ul>
</nav>

<?php endif; ?>