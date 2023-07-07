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
            <h3>Documents Administration</h3>
        </li>

        <li class="slide">
            <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i class="side-menu__icon ion ion-log-in"></i><span class="side-menu__label">Incoming Docs</span><i class="angle fe fe-chevron-right"></i></a>
            <ul class="slide-menu">
                <li><?= $this->Html->link('Register New', ['controller' => 'DocIncomings', 'action' => 'add'], ['class' => 'slide-item']) ?></li>
                <li><?= $this->Html->link('All Docs ', ['controller' => 'DocIncomings', 'action' => 'index'], ['class' => 'slide-item']) ?></li>
                <li><?= $this->Html->link('My Docs ', ['controller' => 'DocIncomings', 'action' => 'mydoc'], ['class' => 'slide-item']) ?></li>
                <li><?= $this->Html->link('Department Docs', ['controller' => 'DocIncomings', 'action' => 'deptdoc'], ['class' => 'slide-item']) ?></li>
            </ul>
        </li>
        <li class="slide">
            <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i class="side-menu__icon ion ion-log-out"></i><span class="side-menu__label">Outgoing Docs</span><i class="angle fe fe-chevron-right"></i></a>
            <ul class="slide-menu">
                <li><?= $this->Html->link('Register New', ['controller' => 'DocOutgoings', 'action' => 'add'], ['class' => 'slide-item']) ?></li>
                <li><?= $this->Html->link('All Docs ', ['controller' => 'DocOutgoings', 'action' => 'index'], ['class' => 'slide-item']) ?></li>
                <li><?= $this->Html->link('My Docs ', ['controller' => 'DocOutgoings', 'action' => 'mydoc'], ['class' => 'slide-item']) ?></li>
                <li><?= $this->Html->link('Department Docs', ['controller' => 'DocOutgoings', 'action' => 'deptdoc'], ['class' => 'slide-item']) ?></li>
            </ul>
        </li>

        <li class="slide">
            <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i class="side-menu__icon ion ion-ios7-loop-strong"></i><span class="side-menu__label">Internal Docs</span><i class="angle fe fe-chevron-right"></i></a>
            <ul class="slide-menu">
                <li><?= $this->Html->link('Register New', ['controller' => 'DocInternals', 'action' => 'add'], ['class' => 'slide-item']) ?></li>
                <li><?= $this->Html->link('All Docs ', ['controller' => 'DocInternals', 'action' => 'index'], ['class' => 'slide-item']) ?></li>
                <li><?= $this->Html->link('My Docs ', ['controller' => 'DocInternals', 'action' => 'mydoc'], ['class' => 'slide-item']) ?></li>
                <li><?= $this->Html->link('Department Docs', ['controller' => 'DocInternals', 'action' => 'deptdoc'], ['class' => 'slide-item']) ?></li>
            </ul>
        </li>

        <li class="slide">
            <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i class="side-menu__icon ti-briefcase"></i><span class="side-menu__label">External Entity</span><i class="angle fe fe-chevron-right"></i></a>
            <ul class="slide-menu">
                <li><?= $this->Html->link('Add New', ['controller' => 'Partners', 'action' => 'add'], ['class' => 'slide-item']) ?></li>
                <li><?= $this->Html->link('Entities List', ['controller' => 'Partners', 'action' => 'index'], ['class' => 'slide-item']) ?></li>
            </ul>
        </li>
    </ul>

    <div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
            <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z" />
        </svg></div>
</div>
