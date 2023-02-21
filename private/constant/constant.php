<?php
    // const display parameter:
    const PARAM_DAY_DISPLAY = 'day';
    const PARAM_WEEK_DISPLAY = 'week';
    const PARAM_MONTH_DISPLAY = 'month';

    const PARAM_VIEW_DISPLAY = 'view';
    const PARAM_MODIFY_DISPLAY = 'modify';

    // const onglet parameter:
    const PARAM_MISSION_ONGLET = 'missions';
    const PARAM_PERSONAL_ONGLET = 'personal';
    const PARAM_EMPLOYEE_ONGLET = 'employees';
    const PARAM_VEHICLES_ONGLET = 'vehicles';
    const PARAM_MATERIAL_ONGLET = 'material';
    
    const PARAM_SESSION_TYPE = [
        'administrateur' => 'administrator',
        'chef d\'équipe' => 'planningManager',
        'responsable véhicules' => 'vehicleManager',
        'responsable matériel' => 'materialManager',
        'resources humaine' => 'humanResources',
        'employé' => 'employee'
    ];

    const PARAM_SESSION_TYPE_ADMINISTRATOR = "administrator";
    const PARAM_SESSION_TYPE_TEAM_LEADER = "planningManager";
    const PARAM_SESSION_TYPE_VEHICLE_MANAGER = "vehicleManager";
    const PARAM_SESSION_TYPE_MATERIAL_MANAGER = "materialManager";
    const PARAM_SESSION_TYPE_HUMAN_MANAGER = "humanResources";
    const PARAM_SESSION_TYPE_EMPLOYEE = "employee";

    const TITLE_PAGE_INDEX = "Connexion";
    const TITLE_PAGE_HOME = "Accueil";
    const TITLE_PAGE_PROFIL = "Profil";
    const TITLE_PAGE_COST = "Frais";
    const TITLE_PAGE_PLANNING = "Planning";
    const TITLE_PAGE_SCHEDULE = "Horaires";
    const TITLE_PAGE_MATERIAL = "Matériel";
    const TITLE_PAGE_VEHICLE = "Véhicule";

    const LINK_LOGIN_PROCESS = "/private/treatment/indexProcess/logInProcess";
    const LINK_LOGOUT_PROCESS = "/private/treatment/indexProcess/logOutProcess";
    const LINK_TO_MODIFY_PROCESS = "/private/treatment/profileProcess/modifyProcess";

    const LINK_TO_HOME = "/home";
    const LINK_TO_PROFIL = "/profil?onglet=personal&display=view";
    const LINK_TO_PLANNING = "/planning?onglet=missions&display=week";
    const LINK_TO_PLANNING_EMPLOYEE = "/planning?onglet=employee&display=week";
    const LINK_TO_SCHEDULES = "/schedule";
    const LINK_TO_EXPENDITURE = "/expenditure";
    const LINK_TO_TOOL_MANAGEMENT = "/toolManagement";
    const LINK_TO_VEHICLE_MANAGEMENT = "/vehicleManagement";
?>