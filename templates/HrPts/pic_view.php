<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\HrPt $hrPt
 * @var \Cake\Collection\CollectionInterface|string[] $departments
 * @var \Cake\Collection\CollectionInterface|string[] $hrPStatuses
 */

use Cake\I18n\FrozenDate;



$this->loadHelper('Form', [
    'templates' => 'sash_form_templates',
]);

$this->loadHelper('Authentication.Identity');

$page_heading = 'View Pre-Termination Tasks';

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

$bComplete = true;
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
                    echo $this->Form->control('hr_p_status_id', ['options' => $taskStatuses, 'label' => 'Status', 'class' => 'form-control', 'disabled', 'templateVars' => ['ctnClass' => 'col-md-6']]);

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
        </div>


        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Your Tasks List</h3>
            </div>
            <div class="card-body">
                <div class="row">

                    <?php
                    foreach ($hrPt->hr_pt_tasks as $index => $task) {
                        echo $this->Form->control('hr_pt_tasks.' . $index . '.id', ['type' => "hidden"]);
                        //echo $this->Form->control($task->description, ['label' => false, 'class' => 'form-control task', 'disabled', 'type' => 'textbox', 'templateVars' => ['ctnClass' => 'col-md-4']]);
                        echo $this->Form->control('hr_pt_tasks.' . $index . '.description', ['label' => false, 'class' => 'form-control task', 'disabled', 'type' => 'textbox', 'templateVars' => ['ctnClass' => 'col-md-3']]);

                        if ($task->hr_p_task_status_id == 3) {
                            echo $this->Form->control('hr_pt_tasks.' . $index . '.hr_p_task_status_id', ['label' => false, 'class' => 'form-control task', 'disabled', 'options' => $taskStatuses, 'templateVars' => ['ctnClass' => 'col-md-2']]);
                            echo $this->Form->control('hr_pt_tasks.' . $index . '.remark', ['label' => false, 'class' => 'form-control task', 'disabled', 'type' => 'textbox', 'templateVars' => ['ctnClass' => 'col-md-3']]);
                            echo $this->Form->control('hr_pt_tasks.' . $index . '.modifier_id', ['label' => false, 'class' => 'form-control task', 'disabled', 'options' => $staffs, 'templateVars' => ['ctnClass' => 'col-md-4']]);
                        } else {
                            echo $this->Form->control('hr_pt_tasks.' . $index . '.hr_p_task_status_id', ['label' => false, 'class' => 'form-control task', 'options' => $taskStatuses, 'templateVars' => ['ctnClass' => 'col-md-2']]);
                            echo $this->Form->control('hr_pt_tasks.' . $index . '.remark', ['label' => false, 'class' => 'form-control task', 'type' => 'textbox', 'templateVars' => ['ctnClass' => 'col-md-3']]);
                            echo $this->Form->control('hr_pt_tasks.' . $index . '.users._ids', ['label' => false, 'options' => $staffs, 'disabled', 'empty' => true, 'data-placeholder' => "Pick 1 or more PIC", 'templateVars' => ['extra_class' => 'select2-show-search form-select', 'ctnClass' => 'col-md-4']]);
                            $bComplete = false;
                        }
                    }
                    ?>
                </div>
            </div>
        </div>

        <?php if (!$bComplete) : ?>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="form-footer mt-2 text-center">
                            <input type="submit" class="btn btn-primary" value="Save">
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>



    </div>
</div>
<?= $this->Form->end() ?>