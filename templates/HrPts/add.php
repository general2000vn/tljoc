<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\HrPt $hrPt
 * @var \Cake\Collection\CollectionInterface|string[] $departments
 * @var \Cake\Collection\CollectionInterface|string[] $hrPStatuses
 */

use Cake\I18n\FrozenDate;

//$this->layout = 'das';


define("NAME_CARD", 123);    // NTTHa
define("TAXI_CARD", 50);    // CTHChau
define("CELLPHONE", 123);    // NTTHa
define("CAR_PARK",  50);    // CTHChau

define("LABOR_BOOK", 314);    // NTLoan
define("SOCIAL_INSURANCE", 314);    // NTLoan
define("MEDICAL_INSURANCE", 314);    // NTLoan
define("PREMIER_CARD",  279);    // DMChau
define("EXIT_INTERVIEW", [279, 93]);    // DMChau, NTVan
define("BENEFIT",  279);    // DMChau

define("SMOKE_HOOD", [251, 308]);    // DTMai, CTDTrang
define("EMAIL_TERMINATE",  [96]);    // THAnh
define("COMPUTER", 154);    // THAnh
define("DESK_PHONE",  196);    // PNHuy
define("ACCESS_CONTROL", 154);    // THAnh


define("OUTSTANDING", 391);    // HLNguyen
define("BANK",  72);    // HTBThuy
define("CREDIT_CARD", 72);    // HTBThuy
define("TERMINATION_PAYMENT",  374);    // NVNga


$this->loadHelper('Form', [
    'templates' => 'sash_form_templates',
]);

$this->loadHelper('Authentication.Identity');

$page_heading = 'Create new Pre-Termination';

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
                    echo $this->Form->control('issue_date2', ['label' => 'Issued Date', 'value' => 'Auto-generated', 'disabled', 'templateVars' => ['ctnClass' => 'col-md-6']]);
                    echo $this->Form->control('hr_p_status_id', ['options' => $hrPStatuses, 'label' => 'Status', 'disabled', 'templateVars' => ['ctnClass' => 'col-md-6']]);

                    echo $this->Form->control('staff_id', ['label' => 'Staff', 'options' => $staffs, 'required', 'empty' => true, 'data-placeholder' => "Select a staff", 'templateVars' => ['extra_class' => 'select2-show-search form-select', 'ctnClass' => 'col-md-4']]);
                    echo $this->Form->control('position', ['label' => 'Position',  'templateVars' => ['ctnClass' => 'col-md-4']]);
                    echo $this->Form->control('emp_type', ['label' => 'Employment Type',  'disabled', 'templateVars' => ['ctnClass' => 'col-md-4']]);

                    echo $this->Form->control('department', ['label' => 'Department', 'disabled',  'templateVars' => ['ctnClass' => 'col-md-6']]);
                    echo $this->Form->control('supervisor_id', ['label' => 'Supervisor', 'options' => $staffs,  'empty' => true, 'data-placeholder' => "Select a Supervisor", 'templateVars' => ['extra_class' => 'select2-show-search form-select', 'ctnClass' => 'col-md-6']]);

                    echo $this->Form->control('o_last_date', ['label' => 'Official Last day',  'templateVars' => ['ctnClass' => 'col-md-4']]);
                    echo $this->Form->control('last_date', ['label' => 'Last Working day',  'templateVars' => ['ctnClass' => 'col-md-4']]);
                    echo $this->Form->control('work_year', ['label' => 'Year in service',  'templateVars' => ['ctnClass' => 'col-md-4']]);

                    ?>
                </div>
            </div>
        </div>


        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Check-list ADM</h3>
            </div>
            <div class="card-body">
                <div class="row">

                    <?php
                    $j = 1; //task category ID
                    $i = 0;
                    echo $this->Form->hidden('hr_pt_tasks.' . $i . '.hr_task_category_id', ['value' => $j]);
                    echo $this->Form->control('hr_pt_tasks.' . $i . '.description', ['label' => false, 'class' => 'form-control task', 'type' => 'textbox', 'value' => 'Name Card', 'templateVars' => ['ctnClass' => 'col-md-8']]);
                    echo $this->Form->control('hr_pt_tasks.' . $i . '.users._ids', ['label' => false, 'options' => $staffs, 'value' => NAME_CARD, 'required',  'empty' => true, 'data-placeholder' => "Pick 1 or more PIC", 'templateVars' => ['extra_class' => 'select2-show-search form-select', 'ctnClass' => 'col-md-4']]);

                    $i++;
                    echo $this->Form->hidden('hr_pt_tasks.' . $i . '.hr_task_category_id', ['value' => $j]);
                    echo $this->Form->control('hr_pt_tasks.' . $i . '.description', ['label' => false, 'class' => 'form-control task', 'type' => 'textbox', 'value' => 'Entry card/ Taxi cards', 'templateVars' => ['ctnClass' => 'col-md-8']]);
                    echo $this->Form->control('hr_pt_tasks.' . $i . '.users._ids', ['label' => false, 'options' => $staffs, 'value' => TAXI_CARD, 'required',  'empty' => true, 'data-placeholder' => "Pick 1 or more PIC", 'templateVars' => ['extra_class' => 'select2-show-search form-select', 'ctnClass' => 'col-md-4']]);

                    $i++;
                    echo $this->Form->hidden('hr_pt_tasks.' . $i . '.hr_task_category_id', ['value' => $j]);
                    echo $this->Form->control('hr_pt_tasks.' . $i . '.description', ['label' => false, 'class' => 'form-control task', 'type' => 'textbox', 'value' => 'Cell phone', 'templateVars' => ['ctnClass' => 'col-md-8']]);
                    echo $this->Form->control('hr_pt_tasks.' . $i . '.users._ids', ['label' => false, 'options' => $staffs, 'value' => CELLPHONE, 'required',  'empty' => true, 'data-placeholder' => "Pick 1 or more PIC", 'templateVars' => ['extra_class' => 'select2-show-search form-select', 'ctnClass' => 'col-md-4']]);

                    $i++;
                    echo $this->Form->hidden('hr_pt_tasks.' . $i . '.hr_task_category_id', ['value' => $j]);
                    echo $this->Form->control('hr_pt_tasks.' . $i . '.description', ['label' => false, 'class' => 'form-control task', 'type' => 'textbox', 'value' => 'Motorbike / Car Parking cancellation', 'templateVars' => ['ctnClass' => 'col-md-8']]);
                    echo $this->Form->control('hr_pt_tasks.' . $i . '.users._ids', ['label' => false, 'options' => $staffs, 'value' => CAR_PARK, 'required',  'empty' => true, 'data-placeholder' => "Pick 1 or more PIC", 'templateVars' => ['extra_class' => 'select2-show-search form-select', 'ctnClass' => 'col-md-4']]);

                    ?>
                </div>
            </div>
        </div>



        <div class="card">

            <div class="card-header">
                <h3 class="card-title">Check-list HR</h3>
            </div>
            <div class="card-body">

                <div class="row">

                    <?php
                    $j++;

                    $i++;
                    echo $this->Form->hidden('hr_pt_tasks.' . $i . '.hr_task_category_id', ['value' => $j]);
                    echo $this->Form->control('hr_pt_tasks.' . $i . '.description', ['label' => false, 'class' => 'form-control task', 'type' => 'textbox', 'value' => 'Labour Book', 'templateVars' => ['ctnClass' => 'col-md-8']]);
                    echo $this->Form->control('hr_pt_tasks.' . $i . '.users._ids', ['label' => false, 'options' => $staffs, 'value' => LABOR_BOOK, 'required',  'empty' => true, 'data-placeholder' => "Pick 1 or more PIC", 'templateVars' => ['extra_class' => 'select2-show-search form-select', 'ctnClass' => 'col-md-4']]);

                    $i++;
                    echo $this->Form->hidden('hr_pt_tasks.' . $i . '.hr_task_category_id', ['value' => $j]);
                    echo $this->Form->control('hr_pt_tasks.' . $i . '.description', ['label' => false, 'class' => 'form-control task', 'type' => 'textbox', 'value' => 'Social Insurance Book', 'templateVars' => ['ctnClass' => 'col-md-8']]);
                    echo $this->Form->control('hr_pt_tasks.' . $i . '.users._ids', ['label' => false, 'options' => $staffs, 'value' => SOCIAL_INSURANCE, 'required',  'empty' => true, 'data-placeholder' => "Pick 1 or more PIC", 'templateVars' => ['extra_class' => 'select2-show-search form-select', 'ctnClass' => 'col-md-4']]);

                    $i++;
                    echo $this->Form->hidden('hr_pt_tasks.' . $i . '.hr_task_category_id', ['value' => $j]);
                    echo $this->Form->control('hr_pt_tasks.' . $i . '.description', ['label' => false, 'class' => 'form-control task', 'type' => 'textbox', 'value' => 'Medical Insurance card', 'templateVars' => ['ctnClass' => 'col-md-8']]);
                    echo $this->Form->control('hr_pt_tasks.' . $i . '.users._ids', ['label' => false, 'options' => $staffs, 'value' => MEDICAL_INSURANCE, 'required',  'empty' => true, 'data-placeholder' => "Pick 1 or more PIC", 'templateVars' => ['extra_class' => 'select2-show-search form-select', 'ctnClass' => 'col-md-4']]);

                    $i++;
                    echo $this->Form->hidden('hr_pt_tasks.' . $i . '.hr_task_category_id', ['value' => $j]);
                    echo $this->Form->control('hr_pt_tasks.' . $i . '.description', ['label' => false, 'class' => 'form-control task', 'type' => 'textbox', 'value' => 'Premier Card', 'templateVars' => ['ctnClass' => 'col-md-8']]);
                    echo $this->Form->control('hr_pt_tasks.' . $i . '.users._ids', ['label' => false, 'options' => $staffs, 'value' => PREMIER_CARD, 'required',  'empty' => true, 'data-placeholder' => "Pick 1 or more PIC", 'templateVars' => ['extra_class' => 'select2-show-search form-select', 'ctnClass' => 'col-md-4']]);

                    $i++;
                    echo $this->Form->hidden('hr_pt_tasks.' . $i . '.hr_task_category_id', ['value' => $j]);
                    echo $this->Form->control('hr_pt_tasks.' . $i . '.description', ['label' => false, 'class' => 'form-control task', 'type' => 'textbox', 'value' => 'Exit Interview', 'templateVars' => ['ctnClass' => 'col-md-8']]);
                    echo $this->Form->control('hr_pt_tasks.' . $i . '.users._ids', ['label' => false, 'options' => $staffs, 'value' => EXIT_INTERVIEW, 'required',  'empty' => true, 'data-placeholder' => "Pick 1 or more PIC", 'templateVars' => ['extra_class' => 'select2-show-search form-select', 'ctnClass' => 'col-md-4']]);

                    $i++;
                    echo $this->Form->hidden('hr_pt_tasks.' . $i . '.hr_task_category_id', ['value' => $j]);
                    echo $this->Form->control('hr_pt_tasks.' . $i . '.description', ['label' => false, 'class' => 'form-control task', 'type' => 'textbox', 'value' => 'Benefits calculation', 'templateVars' => ['ctnClass' => 'col-md-8']]);
                    echo $this->Form->control('hr_pt_tasks.' . $i . '.users._ids', ['label' => false, 'options' => $staffs, 'value' => BENEFIT, 'required',  'empty' => true, 'data-placeholder' => "Pick 1 or more PIC", 'templateVars' => ['extra_class' => 'select2-show-search form-select', 'ctnClass' => 'col-md-4']]);

                    ?>
                </div>
            </div>
        </div>


        <div class="card">

            <div class="card-header">
                <h3 class="card-title">Checklist HSE & IT</h3>
            </div>
            <div class="card-body">

                <div class="row">

                    <?php
                    $j++;

                    $i++;
                    echo $this->Form->hidden('hr_pt_tasks.' . $i . '.hr_task_category_id', ['value' => $j]);
                    echo $this->Form->control('hr_pt_tasks.' . $i . '.description', ['label' => false, 'class' => 'form-control task', 'type' => 'textbox', 'value' => 'Emergency Escape Smoke Hood', 'templateVars' => ['ctnClass' => 'col-md-8']]);
                    echo $this->Form->control('hr_pt_tasks.' . $i . '.users._ids', ['label' => false, 'options' => $staffs, 'value' => SMOKE_HOOD, 'required',  'empty' => true, 'data-placeholder' => "Pick 1 or more PIC", 'templateVars' => ['extra_class' => 'select2-show-search form-select', 'ctnClass' => 'col-md-4']]);

                    $i++;
                    echo $this->Form->hidden('hr_pt_tasks.' . $i . '.hr_task_category_id', ['value' => $j]);
                    echo $this->Form->control('hr_pt_tasks.' . $i . '.description', ['label' => false, 'class' => 'form-control task', 'type' => 'textbox', 'value' => 'ICT & Email account termination', 'templateVars' => ['ctnClass' => 'col-md-8']]);
                    echo $this->Form->control('hr_pt_tasks.' . $i . '.users._ids', ['label' => false, 'options' => $staffs, 'value' => EMAIL_TERMINATE, 'required',  'empty' => true, 'data-placeholder' => "Pick 1 or more PIC", 'templateVars' => ['extra_class' => 'select2-show-search form-select', 'ctnClass' => 'col-md-4']]);

                    $i++;
                    echo $this->Form->hidden('hr_pt_tasks.' . $i . '.hr_task_category_id', ['value' => $j]);
                    echo $this->Form->control('hr_pt_tasks.' . $i . '.description', ['label' => false, 'class' => 'form-control task', 'type' => 'textbox', 'value' => 'Computer and/or monitor', 'templateVars' => ['ctnClass' => 'col-md-8']]);
                    echo $this->Form->control('hr_pt_tasks.' . $i . '.users._ids', ['label' => false, 'options' => $staffs, 'value' => COMPUTER, 'required',  'empty' => true, 'data-placeholder' => "Pick 1 or more PIC", 'templateVars' => ['extra_class' => 'select2-show-search form-select', 'ctnClass' => 'col-md-4']]);

                    $i++;
                    echo $this->Form->hidden('hr_pt_tasks.' . $i . '.hr_task_category_id', ['value' => $j]);
                    echo $this->Form->control('hr_pt_tasks.' . $i . '.description', ['label' => false, 'class' => 'form-control task', 'type' => 'textbox', 'value' => 'Desk Phone', 'templateVars' => ['ctnClass' => 'col-md-8']]);
                    echo $this->Form->control('hr_pt_tasks.' . $i . '.users._ids', ['label' => false, 'options' => $staffs, 'value' => DESK_PHONE, 'required',  'empty' => true, 'data-placeholder' => "Pick 1 or more PIC", 'templateVars' => ['extra_class' => 'select2-show-search form-select', 'ctnClass' => 'col-md-4']]);

                    $i++;
                    echo $this->Form->hidden('hr_pt_tasks.' . $i . '.hr_task_category_id', ['value' => $j]);
                    echo $this->Form->control('hr_pt_tasks.' . $i . '.description', ['label' => false, 'class' => 'form-control task', 'type' => 'textbox', 'value' => 'Clear office access privilege', 'templateVars' => ['ctnClass' => 'col-md-8']]);
                    echo $this->Form->control('hr_pt_tasks.' . $i . '.users._ids', ['label' => false, 'options' => $staffs, 'value' => ACCESS_CONTROL, 'required',  'empty' => true, 'data-placeholder' => "Pick 1 or more PIC", 'templateVars' => ['extra_class' => 'select2-show-search form-select', 'ctnClass' => 'col-md-4']]);

                    ?>

                </div>
            </div>
        </div>


        <div class="card">

            <div class="card-header">
                <h3 class="card-title">Check-list FIN</h3>
            </div>
            <div class="card-body">

                <div class="row">

                    <?php
                    $j++;

                    $i++;
                    echo $this->Form->hidden('hr_pt_tasks.' . $i . '.hr_task_category_id', ['value' => $j]);
                    echo $this->Form->control('hr_pt_tasks.' . $i . '.description', ['label' => false, 'class' => 'form-control task', 'type' => 'textbox', 'value' => 'Outstanding advances/ claims', 'templateVars' => ['ctnClass' => 'col-md-8']]);
                    echo $this->Form->control('hr_pt_tasks.' . $i . '.users._ids', ['label' => false, 'options' => $staffs, 'value' => OUTSTANDING, 'required',  'empty' => true, 'data-placeholder' => "Pick 1 or more PIC", 'templateVars' => ['extra_class' => 'select2-show-search form-select', 'ctnClass' => 'col-md-4']]);

                    $i++;
                    echo $this->Form->hidden('hr_pt_tasks.' . $i . '.hr_task_category_id', ['value' => $j]);
                    echo $this->Form->control('hr_pt_tasks.' . $i . '.description', ['label' => false, 'class' => 'form-control task', 'type' => 'textbox', 'value' => 'Bank (if authorized signing staff)', 'templateVars' => ['ctnClass' => 'col-md-8']]);
                    echo $this->Form->control('hr_pt_tasks.' . $i . '.users._ids', ['label' => false, 'options' => $staffs, 'value' => BANK, 'required',  'empty' => true, 'data-placeholder' => "Pick 1 or more PIC", 'templateVars' => ['extra_class' => 'select2-show-search form-select', 'ctnClass' => 'col-md-4']]);

                    $i++;
                    echo $this->Form->hidden('hr_pt_tasks.' . $i . '.hr_task_category_id', ['value' => $j]);
                    echo $this->Form->control('hr_pt_tasks.' . $i . '.description', ['label' => false, 'class' => 'form-control task', 'type' => 'textbox', 'value' => 'Credit Card', 'templateVars' => ['ctnClass' => 'col-md-8']]);
                    echo $this->Form->control('hr_pt_tasks.' . $i . '.users._ids', ['label' => false, 'options' => $staffs, 'value' => CREDIT_CARD, 'required',  'empty' => true, 'data-placeholder' => "Pick 1 or more PIC", 'templateVars' => ['extra_class' => 'select2-show-search form-select', 'ctnClass' => 'col-md-4']]);

                    $i++;
                    echo $this->Form->hidden('hr_pt_tasks.' . $i . '.hr_task_category_id', ['value' => $j]);
                    echo $this->Form->control('hr_pt_tasks.' . $i . '.description', ['label' => false, 'class' => 'form-control task', 'type' => 'textbox', 'value' => 'Termination Payment (Severance/ redundancy/ gratitude)', 'templateVars' => ['ctnClass' => 'col-md-8']]);
                    echo $this->Form->control('hr_pt_tasks.' . $i . '.users._ids', ['label' => false, 'options' => $staffs, 'value' => TERMINATION_PAYMENT, 'required',  'empty' => true, 'data-placeholder' => "Pick 1 or more PIC", 'templateVars' => ['extra_class' => 'select2-show-search form-select', 'ctnClass' => 'col-md-4']]);

                    ?>
                </div>
            </div>
        </div>


        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="form-footer mt-2 text-center">
                        <?php
                        echo $this->Form->submit('Create New', ['class' => 'btn btn-primary', 'templateVars' => ['ctnClass' => 'col-md-12 align-center']]);
                        ?>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>

<?= $this->Form->end() ?>