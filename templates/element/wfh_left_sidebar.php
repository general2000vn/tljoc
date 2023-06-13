<aside id="leftsidebar" class="sidebar">
    <div class="navbar-brand">
        <button class="btn-menu ls-toggle-btn" type="button"><i class="zmdi zmdi-menu"></i></button>
        <a href="#">
            <!-- <img src="assets/images/logo.svg" width="25" alt="Aero"> -->
            <?= $this->Html->image('../assets/images/logo.svg', ['alt' => 'PMSoft', 'width' => '25']) ?>
            <span class="m-l-10">TLJOC e-Office</span>
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

            <li>
                <?= $this->Html->link('<i class="zmdi zmdi-account"></i><span>My Profile</span>', ['controller' => 'Users', 'action' => 'editMyProfile', $curUser->id], ['escape' => false]) ?>
            </li>

            <li><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-hc-fw"></i><span>Covid-19</span></a>
                <ul class="ml-menu">
                    <li><?= $this->Html->link('Add Test Result', ['controller' => 'CovidTests', 'action' => 'add']) ?></li>
                    <li><?= $this->Html->link('My Test Results', ['controller' => 'CovidTests', 'action' => 'index']) ?></li>
                </ul>
            </li>
            <li><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-hc-fw"></i><span>HSE</span></a>
                <ul class="ml-menu">
                    <li><?= $this->Html->link('Update Staff Health', ['controller' => 'Users', 'action' => 'editStaffHealth']) ?></li>
                    <li><?= $this->Html->link('HSE Report', ['controller' => 'Users', 'action' => 'reportVaccine']) ?></li>
                    <li><?= $this->Html->link('Dashboard Statistic', ['controller' => 'HseStats', 'action' => 'index']) ?></li>
                    <li><?= $this->Html->link('Dashboard', ['controller' => 'Dashboards', 'action' => 'index']) ?></li>
                    
                </ul>
            </li>
            <li><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-shield-security"></i><span>PRD Statistic</span></a>
                <ul class="ml-menu">
                    <li><?= $this->Html->link('Add Daily statistic', ['controller' => 'dashboard-prd-days', 'action' => 'add']) ?></li>
                    <li><?= $this->Html->link('Daily Statistics List', ['controller' => 'dashboard-prd-days', 'action' => 'index']) ?></li>
                    <li><?= $this->Html->link('Add Yearly Target', ['controller' => 'dashboard-prd-years', 'action' => 'add']) ?></li>
                    <li><?= $this->Html->link('Yearly Targets List', ['controller' => 'dashboard-prd-years', 'action' => 'index']) ?></li>
                    <li><?= $this->Html->link('Dashboard', ['controller' => 'dashboards', 'action' => 'index']) ?></li>
                </ul>
            </li>

            <!--
            <li><?= $this->Html->link('<i class="zmdi zmdi-hc-fw"></i><span>HSE Report</span>', ['controller' => 'Users', 'action' => 'reportVaccine'], ['escape' => false]) ?></li>

            

            <li><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-hc-fw"></i><span>My Check-in</span></a>
                <ul class="ml-menu">
                    <li><?= $this->Html->link('Today', ['controller' => 'Timesheets', 'action' => 'index']) ?></li>
                    <li><?= $this->Html->link('Monthly', ['controller' => 'Timesheets', 'action' => 'myMonthly']) ?></li>
                </ul>
            </li>
           
            
             -->
            

            <?php if (!empty(array_intersect([2, 3, 4, 5, 6, 8, 10, 11] , $curUser->roleIDs))) : ?>
                <li><a href="javascript:void(0, );" class="menu-toggle"><i class="zmdi zmdi-hc-fw"></i><span>Incoming Documents</span></a>
                    <ul class="ml-menu">

                        <li><?= $this->Html->link('Register New', ['controller' => 'DocIncomings', 'action' => 'add']) ?></li>
                        <li><?= $this->Html->link('All Docs', ['controller' => 'DocIncomings', 'action' => 'index']) ?></li>
                        <li><?= $this->Html->link('My Docs', ['controller' => 'DocIncomings', 'action' => 'mydoc']) ?></li>
                        <li><?= $this->Html->link('Department Docs', ['controller' => 'DocIncomings', 'action' => 'deptdoc']) ?></li>
                        
                        <li><a href="#">To be requested ...</a></li>
                    </ul>
                </li>
                <li><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-hc-fw"></i><span>Outgoing Documents</span></a>
                    <ul class="ml-menu">

                        <li><?= $this->Html->link('Register New', ['controller' => 'DocOutgoings', 'action' => 'add']) ?></li>
                        <li><?= $this->Html->link('All Docs', ['controller' => 'DocOutgoings', 'action' => 'index']) ?></li>
                        <li><?= $this->Html->link('My Docs', ['controller' => 'DocOutgoings', 'action' => 'mydoc']) ?></li>
                        <li><?= $this->Html->link('Department Docs', ['controller' => 'DocOutgoings', 'action' => 'deptdoc']) ?></li>
                        
                        <li><a href="#">To be requested ...</a></li>
                    </ul>
                </li>
                <li><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-hc-fw"></i><span>Internal Documents</span></a>
                    <ul class="ml-menu">

                        <li><?= $this->Html->link('Register New', ['controller' => 'DocInternals', 'action' => 'add']) ?></li>
                        <li><?= $this->Html->link('All Docs', ['controller' => 'DocInternals', 'action' => 'index']) ?></li>
                        <li><?= $this->Html->link('My Docs', ['controller' => 'DocInternals', 'action' => 'mydoc']) ?></li>
                        <li><?= $this->Html->link('Department Docs', ['controller' => 'DocInternals', 'action' => 'deptdoc']) ?></li>
                        
                        <li><a href="#">To be requested ...</a></li>
                    </ul>
                </li>
                <li><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-hc-fw"></i><span>External Entities</span></a>
                    <ul class="ml-menu">

                        <li><?= $this->Html->link('Add New', ['controller' => 'Partners', 'action' => 'add']) ?></li>
                        <li><?= $this->Html->link('List', ['controller' => 'Partners', 'action' => 'index']) ?></li>
                        <li><a href="#">To be requested ...</a></li>
                    </ul>
                </li>

                <li><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-hc-fw"></i><span>Order Requisitions</span></a>
                    <ul class="ml-menu">

                        <li><?= $this->Html->link('Create New', ['controller' => 'OrderReqs', 'action' => 'add']) ?></li>
                        <li><?= $this->Html->link('Handling', ['controller' => 'OrderReqs', 'action' => 'index']) ?></li>
                        <li><a href="#">To be requested ...</a></li>
                    </ul>
                </li>
            <?php endif; ?>

            <?php if (count(array_intersect([4, 13] , $curUser->roleIDs)) > 0) : ?>
                <li><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-shield-security"></i><span>Pre-Termination</span></a>
                    <ul class="ml-menu">
                        <li><?= $this->Html->link('New Pre-Termination', ['controller' => 'HrPts', 'action' => 'add']) ?></li>
                        <li><?= $this->Html->link('Draft', ['controller' => 'HrPts', 'action' => 'draft']) ?></li>
                        <li><?= $this->Html->link('In-Progress', ['controller' => 'HrPts', 'action' => 'index']) ?></li>
                        <li><?= $this->Html->link('Completed', ['controller' => 'HrPts', 'action' => 'completed']) ?></li>
                        <li><?= $this->Html->link('List All', ['controller' => 'HrPts', 'action' => 'all']) ?></li>
                        <li><?= $this->Html->link('Related', ['controller' => 'HrPts', 'action' => 'related']) ?></li>
                    </ul>
                </li>

                <li><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-hc-fw"></i><span>Check-in Reports</span></a>
                <ul class="ml-menu">

                    <li><?= $this->Html->link('Department Daily', ['controller' => 'Timesheets', 'action' => 'deptDaily']) ?></li>
                    <li><?= $this->Html->link('All Staff Daily', ['controller' => 'Timesheets', 'action' => 'wholeCompany']) ?></li>
                    <li><?= $this->Html->link('Today Pie Chart', ['controller' => 'Timesheets', 'action' => 'statistic']) ?></li>
                    <li><?= $this->Html->link('HSE Report', ['controller' => 'Users', 'action' => 'reportVaccine']) ?></li>
                    <li><a href="#">To be requested ...</a></li>
                </ul>
                </li>
                
                <li><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-shield-security"></i><span>User Management</span></a>
                    <ul class="ml-menu">
                        <li><?= $this->Html->link('New User', ['controller' => 'Users', 'action' => 'adminAdd']) ?></li>
                        <li><?= $this->Html->link('Reset Password', ['controller' => 'Users', 'action' => 'resetPassword']) ?></li>
                        <li><?= $this->Html->link('User List', ['controller' => 'Users', 'action' => 'index']) ?></li>
                        <li><?= $this->Html->link('Deleted User', ['controller' => 'Users', 'action' => 'deleted']) ?></li>
                        <li><?= $this->Html->link('Non-employee User', ['controller' => 'Users', 'action' => 'inactive']) ?></li>
                    </ul>
                </li>

                <li><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-shield-security"></i><span>Department Management</span></a>
                    <ul class="ml-menu">
                        <li><?= $this->Html->link('New Department', ['controller' => 'Departments', 'action' => 'add']) ?></li>
                        <li><?= $this->Html->link('Departments List', ['controller' => 'Departments', 'action' => 'index']) ?></li>
                        <li><?= $this->Html->link('Deleted Dept.', ['controller' => 'Departments', 'action' => 'deleted']) ?></li>
                    </ul>
                </li>

            
                <li><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-shield-security"></i><span>Role Management</span></a>
                    <ul class="ml-menu">
                        <li><?= $this->Html->link('New Role', ['controller' => 'Roles', 'action' => 'add']) ?></li>
                        <li><?= $this->Html->link('Roles List', ['controller' => 'Roles', 'action' => 'index']) ?></li>
                    </ul>
                </li>
            <?php endif; ?>

            <li><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-hc-fw"></i><span>App. Comments</span></a>
                <ul class="ml-menu">
                    <li><?= $this->Html->link('Add New', ['controller' => 'AppComments', 'action' => 'add']) ?></li>
                    <li><?= $this->Html->link('Unresolved List', ['controller' => 'AppComments', 'action' => 'index']) ?></li>
                    <li><?= $this->Html->link('Resolved List', ['controller' => 'AppComments', 'action' => 'listResolved']) ?></li>

                </ul>
            </li>

            <!-- Context Menu for each Page  -->
            <?php if (isset($context_menu)) : ?>
                <?php foreach ($context_menu as $menu) : ?>
                    <li>
                        <?= $this->Html->link($menu['caption'], $menu['url']) ?>
                    </li>
                <?php endforeach ?>
            <?php endif ?>

        </ul>
    </div>
</aside>