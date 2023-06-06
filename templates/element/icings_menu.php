<aside id="leftsidebar" class="sidebar">
    <div class="navbar-brand">
        <button class="btn-menu ls-toggle-btn" type="button"><i class="zmdi zmdi-menu"></i></button>
        <a href="#">
            <!-- <img src="assets/images/logo.svg" width="25" alt="Aero"> -->
            <?= $this->Html->image('../assets/images/logo.svg', ['alt' => 'PMSoft', 'width' => '25']) ?>
            <span class="m-l-10">HLHVJOCs e-Office</span>
        </a>
    </div>
    <div class="menu">
        <ul class="list">
            <li>
                <div class="user-info">
                    <!--  <a class="image" href="profile.html"><img src="assets/images/profile_av.jpg" alt="User"></a>-->
                    <div class="detail">
                        <?php $curUser = $this->request->getAttribute('identity'); ?>
                        <h4><?php echo $curUser->name ?></h4>
                        <small><?= ($curUser->is_admin ? "Admin" : "") ?></small>
                    </div>
                </div>
            </li>
            <!--
            <li>
                <?= $this->Html->link('<i class="zmdi zmdi-hc-fw"></i><span>Check-in</span>', ['controller' => 'Timesheets', 'action' => 'add'], ['escape' => false]) ?>
            </li>
            -->
        </ul>
    </div>
    <div class="menu">
        <?php
        $menu = $this->Menu->create('main');

        $menu->addChild('My Profile', ['uri' => ['controller' => 'Users', 'action' => 'editMyProfile', $curUser->id], 'templateVars' => ['itemVar' => '<i class="zmdi zmdi-account"></i>']]);


        //$Covid = $menu->addChild('Covod-19', ['uri' => ['javascript:void(0);'], 'templateVars' => ['itemVar' => '<i class="zmdi zmdi-hc-fw"></i>']]);
        $menu->addChild('Covid-19', ['uri' => ['javascript:void(0);'], 'templateVars' => ['itemVar' => '<i class="zmdi zmdi-hc-fw"></i>']]);
        $menu['Covid-19']->addChild('Add Test Result', ['uri' => ['controller' => 'CovidTests', 'action' => 'add']]);
        $menu['Covid-19']->addChild('My Test Results', ['uri' => ['controller' => 'CovidTests', 'action' => 'index']]);

        $menu->addChild('HSE', ['uri' => 'javascript:void(0);', 'templateVars' => ['itemVar' => '<i class="zmdi zmdi-hc-fw"></i>']]);
        $menu['HSE']->addChild('Update Staff Health', ['uri' => ['controller' => 'Users', 'action' => 'editStaffHealth']]);
        $menu['HSE']->addChild('HSE Report', ['uri' => ['controller' => 'Users', 'action' => 'reportVaccine']]);



        if (!empty(array_intersect([2, 3, 4, 5, 6, 8, 10, 11], $curUser->roleIDs))) {

            $menu->addChild('Incoming Documents', ['uri' => 'javascript:void(0);', 'templateVars' => ['itemVar' => '<i class="zmdi zmdi-hc-fw"></i>']]);
            $menu['Incoming Documents']->addChild('Register New', ['uri' => ['controller' => 'DocIncomings', 'action' => 'add']]);
            $menu['Incoming Documents']->addChild('All Docs', ['uri' => ['controller' => 'DocIncomings', 'action' => 'index']]);
            $menu['Incoming Documents']->addChild('My Docs', ['uri' => ['controller' => 'DocIncomings', 'action' => 'mydoc']]);
            $menu['Incoming Documents']->addChild('Department Docs', ['uri' => ['controller' => 'DocIncomings', 'action' => 'deptdoc']]);
            $menu['Incoming Documents']->addChild('To be requested ...', ['uri' => ['#']]);

            $menu->addChild('Outgoing Documents', ['uri' => 'javascript:void(0);', 'templateVars' => ['itemVar' => '<i class="zmdi zmdi-hc-fw"></i>']]);
            $menu['Outgoing Documents']->addChild('Register New', ['uri' => ['controller' => 'DocOutgoings', 'action' => 'add']]);
            $menu['Outgoing Documents']->addChild('All Docs', ['uri' => ['controller' => 'DocOutgoings', 'action' => 'index']]);
            $menu['Outgoing Documents']->addChild('My Docs', ['uri' => ['controller' => 'DocOutgoings', 'action' => 'mydoc']]);
            $menu['Outgoing Documents']->addChild('Department Docs', ['uri' => ['controller' => 'DocOutgoings', 'action' => 'deptdoc']]);
            $menu['Outgoing Documents']->addChild('To be requested ...', ['uri' => ['#']]);

            $menu->addChild('Internal Documents', ['uri' => 'javascript:void(0);', 'templateVars' => ['itemVar' => '<i class="zmdi zmdi-hc-fw"></i>']]);
            $menu['Internal Documents']->addChild('Register New', ['uri' => ['controller' => 'DocInternals', 'action' => 'add']]);
            $menu['Internal Documents']->addChild('All Docs', ['uri' => ['controller' => 'DocInternals', 'action' => 'index']]);
            $menu['Internal Documents']->addChild('My Docs', ['uri' => ['controller' => 'DocInternals', 'action' => 'mydoc']]);
            $menu['Internal Documents']->addChild('Department Docs', ['uri' => ['controller' => 'DocInternals', 'action' => 'deptdoc']]);
            $menu['Internal Documents']->addChild('To be requested ...', ['uri' => ['#']]);

            $menu->addChild('External Entities', ['uri' => 'javascript:void(0);', 'templateVars' => ['itemVar' => '<i class="zmdi zmdi-hc-fw"></i>']]);
            $menu['External Entities']->addChild('Add New', ['uri' => ['controller' => 'Partners', 'action' => 'add']]);
            $menu['External Entities']->addChild('List', ['uri' => ['controller' => 'Partners', 'action' => 'index']]);
            $menu['Internal Documents']->addChild('To be requested ...', ['uri' => ['#']]);
        }

        if (!empty(array_intersect([4, 13], $curUser->roleIDs))) { //Super Admin and HR Sup

            $menu->addChild('Pre-Termination', ['uri' => 'javascript:void(0);', 'templateVars' => ['itemVar' => '<i class="zmdi zmdi-shield-security"></i>']]);
            $menu['Pre-Termination']->addChild('New Pre-Termination', ['uri' => ['controller' => 'HrPts', 'action' => 'add']]);
            $menu['Pre-Termination']->addChild('Draft', ['uri' => ['controller' => 'HrPts', 'action' => 'draft']]);
            $menu['Pre-Termination']->addChild('In-Progress', ['uri' => ['controller' => 'HrPts', 'action' => 'index']]);
            $menu['Pre-Termination']->addChild('Completed', ['uri' => ['controller' => 'HrPts', 'action' => 'completed']]);
            $menu['Pre-Termination']->addChild('List All', ['uri' => ['controller' => 'HrPts', 'action' => 'all']]);
            $menu['Pre-Termination']->addChild('Related to me', ['uri' => ['controller' => 'HrPts', 'action' => 'related']]);
        }

        if (!empty(array_intersect([4], $curUser->roleIDs))) { //super Admin

            $menu->addChild('User Management', ['uri' => 'javascript:void(0);', 'templateVars' => ['itemVar' => '<i class="zmdi zmdi-shield-security"></i>']]);
            $menu['User Management']->addChild('New User', ['uri' => ['controller' => 'Users', 'action' => 'add']]);
            $menu['User Management']->addChild('Reset Password', ['uri' => ['controller' => 'Users', 'action' => 'resetPassword']]);
            $menu['User Management']->addChild('User List', ['uri' => ['controller' => 'Users', 'action' => 'index']]);
            $menu['User Management']->addChild('Deleted User', ['uri' => ['controller' => 'Users', 'action' => 'deleted']]);
            $menu['User Management']->addChild('Non-employee User', ['uri' => ['controller' => 'Users', 'action' => 'inactive']]);

            $menu->addChild('Department Management', ['uri' => 'javascript:void(0);', 'templateVars' => ['itemVar' => '<i class="zmdi zmdi-shield-security"></i>']]);
            $menu['Department Management']->addChild('New Department', ['uri' => ['controller' => 'Departments', 'action' => 'add']]);
            $menu['Department Management']->addChild('Departments List', ['uri' => ['controller' => 'Departments', 'action' => 'index']]);
            $menu['Department Management']->addChild('Deleted Dept.', ['uri' => ['controller' => 'Departments', 'action' => 'deleted']]);

            $menu->addChild('Department Management', ['uri' => 'javascript:void(0);', 'templateVars' => ['itemVar' => '<i class="zmdi zmdi-shield-security"></i>']]);
            $menu['Department Management']->addChild('New Department', ['uri' => ['controller' => 'Departments', 'action' => 'add']]);
            $menu['Department Management']->addChild('Departments List', ['uri' => ['controller' => 'Departments', 'action' => 'index']]);
            $menu['Department Management']->addChild('Deleted Dept.', ['uri' => ['controller' => 'Departments', 'action' => 'deleted']]);

            $menu->addChild('Role Management', ['uri' => 'javascript:void(0);', 'templateVars' => ['itemVar' => '<i class="zmdi zmdi-shield-security"></i>']]);
            $menu['Role Management']->addChild('New Role', ['uri' => ['controller' => 'Roles', 'action' => 'add']]);
            $menu['Role Management']->addChild('Roles List', ['uri' => ['controller' => 'Roles', 'action' => 'index']]);
        }

        $menu->addChild('App. Comments', ['uri' => 'javascript:void(0);', 'templateVars' => ['itemVar' => '<i class="zmdi zmdi-shield-security"></i>']]);
        $menu['App. Comments']->addChild('Add New', ['uri' => ['controller' => 'AppComments', 'action' => 'add']]);
        $menu['App. Comments']->addChild('Unresolved List', ['uri' => ['controller' => 'AppComments', 'action' => 'index']]);
        $menu['App. Comments']->addChild('Resolved List', ['uri' => ['controller' => 'AppComments', 'action' => 'listResolved']]);

        if (isset($context_menu)) {
            foreach ($context_menu as $cmenu) {
                $menu->addChild($cmenu['caption'], ['uri' =>  $cmenu['url'], 'templateVars' => ['itemVar' => '<i class="zmdi zmdi-shield-security"></i>']]);
            }
        }



        echo $this->Menu->render();
        ?>

    </div>
</aside>