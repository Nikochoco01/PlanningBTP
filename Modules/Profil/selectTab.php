<nav>
    <ul>
        <li class="buttonTabs <?php echo activeTab("Personnal") ?>">
            <a href=" <?php echo addUrlParam(array('onglet' => 'Personnal')) ?>">
                <i class=""></i> Personnel
            </a>
        </li>

        <li class="buttonTabs <?php echo activeTab("Employes") ?>">
            <a href=" <?php echo addUrlParam(array('onglet' => 'Employes'))?>">
               <i class=""></i> Employés
            </a>
        </li>
    </ul>
</nav>