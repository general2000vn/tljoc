<div class="main-sidemenu">
    <div class="slide-left disabled" id="slide-left"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
            <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z" />
        </svg></div>
    <ul class="side-menu">

        <li class="sub-category">
            <h3>e-Office</h3>
        </li>

        <li class="slide">
            <a class="side-menu__item" data-bs-toggle="slide" href="<?= $this->Url->build('/', ['fullBase' => false]) ?>"><i class="side-menu__icon fe fe-home"></i><span class="side-menu__label">Home</span></a>
        </li>

        <li class="sub-category">
            <h3>Admin Functions</h3>
        </li>
<!--
        <li class="slide">
            <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i class="side-menu__icon fe fe-slack"></i><span class="side-menu__label">Notices Management</span><i class="angle fe fe-chevron-right"></i></a>
            <ul class="slide-menu">
                <li><?= $this->Html->link('Create New', ['controller' => 'Notices', 'action' => 'add'], ['class' => 'slide-item']) ?></li>
                <li><?= $this->Html->link('Active Notices', ['controller' => 'Notices', 'action' => 'index'], ['class' => 'slide-item']) ?></li>
                <li><?= $this->Html->link('Upcoming Notices', ['controller' => 'Notices', 'action' => 'upcoming'], ['class' => 'slide-item']) ?></li>
                <li><?= $this->Html->link('Expired Notices', ['controller' => 'Notices', 'action' => 'expired'], ['class' => 'slide-item']) ?></li>
            </ul>
        </li>
-->
        <li class="slide">
            <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i class="side-menu__icon fa fa-user"></i><span class="side-menu__label">Users Management</span><i class="angle fe fe-chevron-right"></i></a>
            <ul class="slide-menu">
                <li><?= $this->Html->link('Create User', ['controller' => 'Users', 'action' => 'adminAdd'], ['class' => 'slide-item']) ?></li>
                <li><?= $this->Html->link('Active Users', ['controller' => 'Users', 'action' => 'index'], ['class' => 'slide-item']) ?></li>
                <li><?= $this->Html->link('Deleted Users', ['controller' => 'Users', 'action' => 'deleted'], ['class' => 'slide-item']) ?></li>
                <!-- <li><?= $this->Html->link('Reset Password', ['controller' => 'Users', 'action' => 'resetPassword'], ['class' => 'slide-item']) ?></li> -->
                
            </ul>
        </li>
<!--
        <li class="slide">
            <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i class="side-menu__icon fe fe-slack"></i><span class="side-menu__label">Groups Management</span><i class="angle fe fe-chevron-right"></i></a>
            <ul class="slide-menu">

                <li><?= $this->Html->link('Create New Group.', ['controller' => 'Groups', 'action' => 'add'], ['class' => 'slide-item']) ?></li>
                <li><?= $this->Html->link('All Groups List', ['controller' => 'Groups', 'action' => 'index'], ['class' => 'slide-item']) ?></li>

            </ul>
        </li>
-->
        <li class="slide">
            <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i class="side-menu__icon fa fa-home"></i><span class="side-menu__label">Dept. Management</span><i class="angle fe fe-chevron-right"></i></a>
            <ul class="slide-menu">
                <li><?= $this->Html->link('Create New', ['controller' => 'Departments', 'action' => 'add'], ['class' => 'slide-item']) ?></li>
                <li><?= $this->Html->link('Departments List', ['controller' => 'Departments', 'action' => 'index'], ['class' => 'slide-item']) ?></li>
            </ul>
        </li>

        <li class="slide">
            <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i class="side-menu__icon fa fa-shield"></i><span class="side-menu__label">Roles Management</span><i class="angle fe fe-chevron-right"></i></a>
            <ul class="slide-menu">
                <!-- <li><?= $this->Html->link('Create New', ['controller' => 'Roles', 'action' => 'add'], ['class' => 'slide-item']) ?></li> -->
                <li><?= $this->Html->link('Roles List', ['controller' => 'Roles', 'action' => 'index'], ['class' => 'slide-item']) ?></li>
            </ul>
        </li>


    </ul>

    <div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
            <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z" />
        </svg></div>
</div>