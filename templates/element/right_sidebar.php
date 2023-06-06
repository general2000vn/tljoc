<div class="navbar-right">
    <ul class="navbar-nav">
        <!-- <li><a href="#search" class="main_search" title="Search..."><i class="zmdi zmdi-search"></i></a></li> -->
        <li class="dropdown">
            <a href="javascript:void(0);" class="dropdown-toggle" title="App" data-toggle="dropdown" role="button"><i class="zmdi zmdi-apps"></i></a>
            <ul class="dropdown-menu slideUp2">
                <li class="header">App Shortcut</li>
                <li class="body">
                    <ul class="menu app_sortcut list-unstyled">

                        <li>
                            <?= $this->Html->link('<div class="icon-circle mb-2 bg-green"><i class="zmdi zmdi-calendar"></i></div><p class="mb-0">WFH Records</p>', ['controller' => 'Timesheets', 'action' => 'statistic'], ['escape' => false]) ?>
                        </li>
                        <li>
                            <?= $this->Html->link('<div class="icon-circle mb-2 bg-purple"><i class="zmdi zmdi-account-calendar"></i></div><p class="mb-0">Documents Administration</p>', ['controller' => 'DocIncomings', 'action' => 'index'], ['escape' => false]) ?>
                        </li>

                        <li>
                            <a href="http://ict/glpi" target="_blank">
                                <div class="icon-circle mb-2 bg-blue"><i class="zmdi zmdi-camera"></i></div>
                                <p class="mb-0">GLPI</p>
                            </a>
                        </li>
                        <li>
                            <a href="http://ict/ocsreports" target="_blank">
                                <div class="icon-circle mb-2 bg-amber"><i class="zmdi zmdi-translate"></i></div>
                                <p class="mb-0">OCS</p>
                            </a>
                        </li>

                    </ul>
                </li>
            </ul>
        </li>

        <li><?= $this->Html->link('<i class="zmdi zmdi-power"></i>', ['controller' => 'Users', 'action' => 'logout'], ['title' => 'Sign out', 'class' => 'mega-menu', 'escape' => false]) ?> </li>
    </ul>
</div>