<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\HrPt $hrPt
 * @var \Cake\Collection\CollectionInterface|string[] $departments
 * @var \Cake\Collection\CollectionInterface|string[] $hrPStatuses
 */

use Cake\I18n\FrozenDate;

//$this->layout = 'das';

$this->loadHelper('Form', [
    'templates' => 'aero_form_templates',
]);

$this->loadHelper('Authentication.Identity');

$page_heading = 'Edit Pre-Termination';

$this->set('page_heading', $page_heading);

$this->set('breadcrumbs', [
    ['caption' => 'HR Employment', 'class' => 'active'],
    ['caption' => $page_heading, 'class' => 'active'],
]);

$this->start('head_css');
echo $this->Html->css('../assets/plugins/bootstrap-select/css/bootstrap-select');
echo $this->Html->css('../newLib/select2.min.css');
$this->end();

$this->start('head_scripts');

$this->end();

$this->start('bottom_scripts');


//echo $this->Html->script('../assets/plugins/select2/select2.min');

echo $this->Html->script('../newLib/select2.min.js');
echo $this->Html->script('select2');

//echo $this->Html->script('myHrPtPage');
$this->end();
?>




<div class="row clearfix">
    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h2>Edit<strong>Pre-Termination</strong></h2>
            </div>
            <?= $this->Form->create($hrPt) ?>
            <div class="body">
                <div class="row clearfix">

                    <?php


                    echo $this->Form->control('issued_date', ['label' => 'Issued Date', 'class' => 'form-control', 'disabled', 'templateVars' => ['ctnClass' => 'col-md-6']]);
                    echo $this->Form->control('hr_p_status_id', ['options' => $hrPStatuses, 'label' => 'Status', 'class' => 'form-control', 'disabled', 'templateVars' => ['ctnClass' => 'col-md-6']]);

                    echo $this->Form->control('staff_id', ['label' => 'Staff', 'options' => $staffs, 'disabled', 'class' => 'form-control show-tick ms select2', 'empty' => true, 'data-placeholder' => "Select a staff", 'templateVars' => ['ctnClass' => 'col-md-4']]);
                    echo $this->Form->control('position', ['label' => 'Position', 'class' => 'form-control', 'disabled', 'templateVars' => ['ctnClass' => 'col-md-4']]);
                    echo $this->Form->control('emp_type', ['label' => 'Employment Type', 'class' => 'form-control', 'disabled', 'templateVars' => ['ctnClass' => 'col-md-4']]);

                    echo $this->Form->control('department', ['label' => 'Department', 'disabled', 'class' => 'form-control', 'templateVars' => ['ctnClass' => 'col-md-6']]);
                    echo $this->Form->control('supervisor_id', ['label' => 'Supervisor', 'options' => $staffs, 'disabled', 'class' => 'form-control show-tick ms select2', 'empty' => true, 'data-placeholder' => "Select a Supervisor", 'templateVars' => ['ctnClass' => 'col-md-6']]);

                    echo $this->Form->control('o_last_date', ['label' => 'Official Last day', 'disabled', 'class' => 'form-control', 'templateVars' => ['ctnClass' => 'col-md-4']]);
                    echo $this->Form->control('last_date', ['label' => 'Last Working day', 'disabled', 'class' => 'form-control', 'templateVars' => ['ctnClass' => 'col-md-4']]);
                    echo $this->Form->control('work_year', ['label' => 'Year in service', 'disabled', 'class' => 'form-control', 'templateVars' => ['ctnClass' => 'col-md-4']]);


                    ?>
                </div>

            </div>
            <?= $this->Form->end() ?>
            <?= $this->Form->create($task_entity) ?>
            <div class="header">
                <h2>Your Tasks <strong>List</strong></h2>
            </div>
            <div class="body">
                <div class="row clearfix">

                    <?php
                    
                    foreach ($tasks as $task) {
                        echo $this->Form->control("task.id", ['type' => "hidden"]);
                        //echo $this->Form->control($task->description, ['label' => false, 'class' => 'form-control task', 'disabled', 'type' => 'textbox', 'templateVars' => ['ctnClass' => 'col-md-4']]);
                        echo $this->Form->control('description', ['label' => false, 'class' => 'form-control task', 'disabled', 'type' => 'textbox', 'templateVars' => ['ctnClass' => 'col-md-4']]);
                        echo $this->Form->control('ht_p_task_status_id', ['label' => false, 'class' => 'form-control task', 'options' => $taskStatuses, 'templateVars' => ['ctnClass' => 'col-md-2']]);
                        echo $this->Form->control('remark', ['label' => false, 'class' => 'form-control task', 'type' => 'textbox', 'templateVars' => ['ctnClass' => 'col-md-3']]);

                        if ($task->ht_p_task_status_id == 3) {

                            echo $this->Form->control('modifier_id', ['label' => false, 'class' => 'form-control task', 'disabled', 'options' => $staffs, 'templateVars' => ['ctnClass' => 'col-md-3']]);
                        } else {

                            echo $this->Form->control('users._ids', ['label' => false, 'options' => $staffs, 'id' => 'tasks-' . $task->id, 'disabled', 'class' => 'form-control pic show-tick ms select2', 'empty' => true, 'data-placeholder' => "Pick 1 or more PIC", 'templateVars' => ['ctnClass' => 'col-md-3']]);
                        }
                    }
                    ?>
                </div>

            </div>


            <div class="header">
                <h2><strong></strong></h2>
            </div>
            <div class="body">
                <div class="row clearfix">
                    <div class="col-md-12 align-center">
                        <input type="submit" class="btn btn-primary" value="Save">
                        <?= $this->Html->link('Cancel', ['action' => 'view', $hrPt->id], ['class' => 'btn btn-primary']) ?>

                    </div>

                </div>
            </div>
            <?= $this->Form->end() ?>

        </div>
    </div>

</div>


<?php
foreach ($tasks as $task) {
    
    if ($task->ht_p_task_status_id != 3) {

        echo $this->element('hr_p_task_process', [
            'id' => $task->id,
            'remark' => $task->remark,
            'status_id' => $task->hr_p_task_status_id
        ]);
    } 
}
?>