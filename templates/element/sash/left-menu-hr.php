<?php

use App\Model\Table\RolesTable; ?>

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
            <h3>HR Functions</h3>
        </li>

        <li class="slide">
            <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i class="side-menu__icon fe fe-slack"></i><span class="side-menu__label">Pre-Termination</span><i class="angle fe fe-chevron-right"></i></a>
            <ul class="slide-menu">

                <?php if (count(array_intersect($this->Identity->get('roleIDs'), [RolesTable::R_HR, RolesTable::R_HR_SUP, RolesTable::R_SADMIN])) > 0) : ?>
                    <li><?= $this->Html->link('Create new', ['controller' => 'HrPts', 'action' => 'add'], ['class' => 'slide-item']) ?></li>
                    <li><?= $this->Html->link('All List', ['controller' => 'HrPts', 'action' => 'index'], ['class' => 'slide-item']) ?></li>
                <?php endif; ?>

                <!--
                <li><?= $this->Html->link('Draft List', ['controller' => 'HrPts', 'action' => 'draft'], ['class' => 'slide-item']) ?></li>
                <li><?= $this->Html->link('Completed List', ['controller' => 'HrPts', 'action' => 'completed'], ['class' => 'slide-item']) ?></li>
                <li><?= $this->Html->link('Pending List', ['controller' => 'HrPts', 'action' => 'all'], ['class' => 'slide-item']) ?></li>
                -->

                <li><?= $this->Html->link('My Tasks', ['controller' => 'HrPts', 'action' => 'related'], ['class' => 'slide-item']) ?></li>

            </ul>
        </li>


        <li class="slide">
            <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i class="side-menu__icon fe fe-slack"></i><span class="side-menu__label">Business Compliance</span><i class="angle fe fe-chevron-right"></i></a>
            <ul class="slide-menu">

                <li><?= $this->Html->link('My Forms', ['controller' => 'abc-forms', 'action' => 'my'], ['class' => 'slide-item']) ?></li>
                <li><?= $this->Html->link('View Guideline', ['controller' => 'abc-campaigns', 'action' => 'view-abc-guide'], ['target' => '_blank', 'class' => 'slide-item']) ?></li>

                <?php if (count(array_intersect($this->Identity->get('roleIDs'), [RolesTable::R_GM, RolesTable::R_DGM, RolesTable::R_LM, RolesTable::R_DLM, RolesTable::R_SADMIN])) > 0) : ?>
                    <li><?= $this->Html->link('Dept. Forms', ['controller' => 'abc-forms', 'action' => 'my-ack'], ['class' => 'slide-item']) ?></li>
                <?php endif; ?>

                <?php if (count(array_intersect($this->Identity->get('roleIDs'), [RolesTable::R_GM, RolesTable::R_DGM, RolesTable::R_HR, RolesTable::R_ADM_MAN, RolesTable::R_SADMIN])) > 0) : ?>
                    <li><?= $this->Html->link('Create Campaign', ['controller' => 'abc-campaigns', 'action' => 'add'], ['class' => 'slide-item']) ?></li>
                    <li><?= $this->Html->link('Campaigns List', ['controller' => 'abc-campaigns', 'action' => 'all'], ['class' => 'slide-item']) ?></li>
                <?php endif; ?>
            </ul>
        </li>


        <!--
        <li class="slide">
            <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i class="side-menu__icon fe fe-slack"></i><span class="side-menu__label">WFH Reports</span><i class="angle fe fe-chevron-right"></i></a>
            <ul class="slide-menu">


                <li><?= $this->Html->link('Department Daily', ['controller' => 'Timesheets', 'action' => 'deptDaily'], ['class' => 'slide-item']) ?></li>
                <li><?= $this->Html->link('All Staff Daily', ['controller' => 'Timesheets', 'action' => 'wholeCompany'], ['class' => 'slide-item']) ?></li>
                <li><?= $this->Html->link('Today Pie Chart', ['controller' => 'Timesheets', 'action' => 'statistic'], ['class' => 'slide-item']) ?></li>
                <li><?= $this->Html->link('HSE Report', ['controller' => 'Users', 'action' => 'reportVaccine'], ['class' => 'slide-item']) ?></li>
                <li><?= $this->Html->link('To be requested...', ['#'], ['class' => 'slide-item']) ?></li>

            </ul>
        </li>
        -->

    </ul>

    <div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
            <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z" />
        </svg></div>
</div>