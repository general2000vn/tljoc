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

            <li>
                <?= $this->Html->link('<i class="zmdi zmdi-account"></i><span>My Profile</span>', ['controller' => 'Users', 'action' => 'editMyProfile', $curUser->id], ['escape' => false]) ?>
            </li>

            <li><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-hc-fw"></i><span>Incoming Documents</span></a>
                <ul class="ml-menu">
                    <li><?= $this->Html->link('Register', ['controller' => 'DocIncomings', 'action' => 'add']) ?></li>
                    <li><?= $this->Html->link('This Year List', ['controller' => 'DocIncomings', 'action' => 'index']) ?></li>
                    <li><?= $this->Html->link('Search', ['controller' => 'DocIncomings', 'action' => 'search']) ?></li>
                </ul>
            </li>
            <li><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-hc-fw"></i><span>Outgoing Documents</span></a>
                <ul class="ml-menu">
                    <li><?= $this->Html->link('Register', ['controller' => 'DocOutgoings', 'action' => 'add']) ?></li>
                    <li><?= $this->Html->link('This Year List', ['controller' => 'DocOutgoings', 'action' => 'index']) ?></li>
                    <li><?= $this->Html->link('Search', ['controller' => 'DocOutgoing', 'action' => 'search']) ?></li>

                </ul>
            </li>

            <li><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-hc-fw"></i><span>Internal Documents</span></a>
                <ul class="ml-menu">
                    <li><?= $this->Html->link('Register', ['controller' => 'DocInternals', 'action' => 'add']) ?></li>
                    <li><?= $this->Html->link('This Year List', ['controller' => 'DocInternals', 'action' => 'index']) ?></li>
                    <li><?= $this->Html->link('Search', ['controller' => 'DocInternals', 'action' => 'search']) ?></li>

                </ul>
            </li>

            <li><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-hc-fw"></i><span>App. Comments</span></a>
                <ul class="ml-menu">
                    <li><?= $this->Html->link('Add New', ['controller' => 'AppComments', 'action' => 'add']) ?></li>
                    <li><?= $this->Html->link('Unresolved List', ['controller' => 'AppComments', 'action' => 'index']) ?></li>
                    <li><?= $this->Html->link('Resolved List', ['controller' => 'AppComments', 'action' => 'listResolved']) ?></li>

                </ul>
            </li>

            <?php if ($curUser->is_admin) : ?>
                <li><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-shield-security"></i><span>User Management</span></a>
                    <ul class="ml-menu">
                        <li><?= $this->Html->link('New User', ['controller' => 'Users', 'action' => 'add']) ?></li>
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
                        <li><?= $this->Html->link('Assign User Roles', ['controller' => 'Roles', 'action' => 'assign']) ?></li>
                    </ul>
                </li>
            <?php endif; ?>



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