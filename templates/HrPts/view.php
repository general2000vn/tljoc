<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\HrPt $hrPt
 * @var \Cake\Collection\CollectionInterface|string[] $departments
 * @var \Cake\Collection\CollectionInterface|string[] $hrPStatuses
 */

use App\Model\Table\HrPTaskStatusesTable;
use Cake\I18n\FrozenDate;

$this->loadHelper('Form', [
    'templates' => 'sash_form_templates',
]);

$this->loadHelper('Authentication.Identity');

$page_heading = 'View Pre-Termination';

$this->set('page_heading', $page_heading);

$this->set('breadcrumbs', [
    ['caption' => 'HR', 'class' => 'active'],
    ['caption' => 'Pre-Termination', 'class' => 'active'],
    ['caption' => $page_heading, 'class' => 'active'],
]);

$this->start('head_css');
$this->end();

$this->start('head_scripts');
$this->end();

$this->start('bottom_scripts');
echo $this->Html->script(['../themes/sash/assets/plugins/select2/select2.full.min', '../themes/sash/assets/js/select2']);
//echo $this->Html->script('myHrPtPage');
$this->end();
?>



<?= $this->Form->create($hrPt) ?>
<div class="row">
    <div class="col-md-12">

        <div class="card">

            <div class="card-header">
                <h3 class="card-title">Pre-Termination</h3>
            </div>
            <div class="card-body">

                <div class="row">

                    <?php
                    echo $this->Form->control('issued_date', ['label' => 'Issued Date', 'class' => 'form-control', 'disabled', 'templateVars' => ['ctnClass' => 'col-md-6']]);
                    echo $this->Form->control('status', ['type' => 'text', 'value' => $hrPt->hr_p_status->name, 'label' => 'Status', 'class' => 'form-control', 'disabled', 'templateVars' => ['ctnClass' => 'col-md-6']]);

                    echo $this->Form->control('name', ['label' => 'Staff', 'type' => 'text', 'disabled', 'class' => 'form-control', 'empty' => true, 'data-placeholder' => "Select a staff", 'templateVars' => ['ctnClass' => 'col-md-4']]);
                    echo $this->Form->control('position', ['label' => 'Position', 'disabled', 'class' => 'form-control', 'templateVars' => ['ctnClass' => 'col-md-4']]);
                    echo $this->Form->control('emp_type', ['label' => 'Employment Type', 'class' => 'form-control', 'disabled', 'templateVars' => ['ctnClass' => 'col-md-4']]);

                    echo $this->Form->control('department', ['label' => 'Department', 'disabled', 'class' => 'form-control', 'templateVars' => ['ctnClass' => 'col-md-6']]);
                    echo $this->Form->control('supervisor', ['label' => 'Supervisor', 'type' => 'text', 'value' => $hrPt->supervisor->name, 'disabled', 'class' => 'form-control', 'empty' => true, 'data-placeholder' => "Select a Supervisor", 'templateVars' => ['ctnClass' => 'col-md-6']]);

                    echo $this->Form->control('o_last_date', ['label' => 'Official Last day', 'value' => $hrPt->o_last_date->format('Y-m-d'), 'disabled', 'class' => 'form-control', 'templateVars' => ['ctnClass' => 'col-md-4']]);
                    echo $this->Form->control('last_date', ['label' => 'Last Working day', 'value' => $hrPt->last_date->format('Y-m-d'), 'disabled', 'class' => 'form-control', 'templateVars' => ['ctnClass' => 'col-md-4']]);
                    echo $this->Form->control('work_year', ['label' => 'Year in service', 'disabled', 'class' => 'form-control', 'templateVars' => ['ctnClass' => 'col-md-4']]);

                    ?>
                </div>
            </div>
        </div>

        <?php foreach ($categories as $category) : ?>
            <div class="card">

                <div class="card-header">
                    <h3 class="card-title">Check-list <strong><?= $category->name ?></strong></h3>
                </div>
                <div class="card-body">

                    <div class="row">

                        <?php
                        $j = 0;
                        foreach ($hrPt->hr_pt_tasks as $hr_pt_task) {
                            if ($hr_pt_task->hr_task_category_id == $category->id) {
                                echo $this->Form->hidden('hr_pt_tasks.' . $j . '.id');
                                echo $this->Form->control('hr_pt_tasks.' . $j . '.description', ['label' => false, 'class' => 'form-control task', 'disabled', 'type' => 'textbox', 'templateVars' => ['ctnClass' => 'col-md-4']]);
                                //echo $this->Form->control('hr_pt_tasks.' . $j . '.hr_p_task_status.name', ['label' => false, 'disabled', 'templateVars' => ['extra_class' => 'form-control task ' . $hr_pt_tasks->hr_p_task_status->tag,'ctnClass' => 'col-md-2']]);
                                echo '<div class="col-md-2"><span class="' . $hr_pt_task->hr_p_task_status->tag . '">' . $hr_pt_task->hr_p_task_status->name . '</span></div>';
                                echo $this->Form->control('hr_pt_tasks.' . $j . '.remark', ['label' => false, 'class' => 'form-control task', 'disabled', 'type' => 'textbox', 'templateVars' => ['ctnClass' => 'col-md-3']]);

                                if ($hrPt->hr_pt_tasks[$j]->hr_p_task_status_id == HrPTaskStatusesTable::S_COMPLETED) {
                                    echo $this->Form->control('hr_pt_tasks.' . $j . '.modifier_id', ['label' => false, 'class' => 'form-control task', 'disabled', 'options' => $staffs, 'templateVars' => ['ctnClass' => 'col-md-3']]);
                                } else {
                                    echo $this->Form->control('hr_pt_tasks.' . $j . '.users._ids', ['label' => false, 'options' => $staffs, 'id' => 'tasks-' . $j, 'disabled', 'empty' => true, 'data-placeholder' => "Pick 1 or more PIC", 'templateVars' => ['extra_class' => 'select2-show-search form-select', 'ctnClass' => 'col-md-3']]);
                                }
                            }
                            $j++;
                        }


                        // foreach ($hrPt->hr_pt_tasks as $hr_pt_task) {
                        //     if ($hr_pt_task->hr_task_category_id == $category->id) {
                        //         echo $this->Form->hidden('hr_pt_task.id');
                        //         echo $this->Form->control('hr_pt_task.description', ['label' => false, 'class' => 'form-control task', 'disabled', 'type' => 'textbox', 'templateVars' => ['ctnClass' => 'col-md-4']]);
                                
                        //         echo '<div class="col-md-2"><span class="' . $hr_pt_task->hr_p_task_status->tag . '">' . $hr_pt_task->hr_p_task_status->name . '</span></div>';
                                
                        //         echo $this->Form->control('hr_pt_task.remark', ['label' => false, 'class' => 'form-control task', 'disabled', 'type' => 'textbox', 'templateVars' => ['ctnClass' => 'col-md-3']]);

                        //         if ($hr_pt_task->hr_p_task_status_id == HrPTaskStatusesTable::S_COMPLETED) {
                        //             echo $this->Form->control('hr_pt_task.modifier_id', ['label' => false, 'class' => 'form-control task', 'disabled', 'options' => $staffs, 'templateVars' => ['ctnClass' => 'col-md-3']]);
                        //         } else {
                        //             echo $this->Form->control('hr_pt_task.users._ids', ['label' => false, 'options' => $staffs,  'disabled', 'empty' => true, 'data-placeholder' => "Pick 1 or more PIC", 'templateVars' => ['extra_class' => 'select2-show-search form-select', 'ctnClass' => 'col-md-3']]);
                        //         }
                        //     }
                            
                        // }
                        ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="form-footer mt-2 text-center">


                        <?php
                        if ($hrPt->hr_p_status_id == 1) { //draff
                            echo $this->Html->link('Edit', ['action' => 'edit', $hrPt->id], ['class' => 'btn btn-primary']);

                            echo $this->Html->link('Publish', ['action' => 'publish', $hrPt->id], ['class' => 'btn btn-primary']);
                        }
                        if ($hrPt->hr_p_status_id == 2) { //pending
                            echo $this->Html->link('Complete', ['action' => 'complete', $hrPt->id], ['class' => 'btn btn-primary']);
                        }

                        if ($hrPt->hr_p_status_id == 3) { //completed
                            echo $this->Html->link('Generate Report', ['action' => 'export', $hrPt->id], ['class' => 'btn btn-primary', 'target' => '_blank']);
                        }

                        ?>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>

<?= $this->Form->end() ?>