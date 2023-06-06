<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\HrPt $hrPt
 * @var \Cake\Collection\CollectionInterface|string[] $departments
 * @var \Cake\Collection\CollectionInterface|string[] $hrPStatuses
 */

use Cake\I18n\FrozenDate;
use App\Model\Table\HrPTaskStatusesTable;

//$this->layout = 'das';


define("NAME_CARD", 122);    // NTMai
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
define("EMAIL_TERMINATE",  [154, 196]);    // THAnh
define("COMPUTER", 154);    // THAnh
define("DESK_PHONE",  196);    // PNHuy
define("ACCESS_CONTROL", 154);    // THAnh


define("OUTSTANDING", 391);    // HLNguyen
define("BANK",  72);    // HTBThuy
define("CREDIT_CARD", 118);    // NTKMao
define("TERMINATION_PAYMENT",  374);    // NVNga


$this->loadHelper('Form', [
    'templates' => 'sash_form_templates',
]);

$this->loadHelper('Authentication.Identity');

$page_heading = 'Edit Pre-Termination';

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
                    echo $this->Form->control('issued_date', ['label' => 'Issued Date',  'disabled', 'templateVars' => ['ctnClass' => 'col-md-6']]);
                    echo $this->Form->control('hr_p_status_id', ['options' => $hrPStatuses, 'label' => 'Status',  'disabled', 'templateVars' => ['ctnClass' => 'col-md-6']]);

                    echo $this->Form->control('staff_id', ['label' => 'Staff', 'options' => $staffs, 'required',  'empty' => true, 'data-placeholder' => "Select a staff", 'templateVars' => ['extra_class' => 'select2-show-search form-select', 'ctnClass' => 'col-md-4']]);
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



        <?php foreach ($categories as $category) : ?>
            <div class="card">

                <div class="card-header">
                    <h3 class="card-title">Check-list <strong><?= $category->name ?></strong></h3>
                </div>
                <div class="card-body">

                    <div class="row">

                        <?php
                        $j = 0;
                        foreach ($hrPt->hr_pt_tasks as $hr_pt_tasks) {
                            if ($hr_pt_tasks->hr_task_category_id == $category->id) {
                                echo $this->Form->hidden('hr_pt_tasks.' . $j . '.id');
                                //echo $this->Form->hidden('hr_pt_tasks.'.$j.'.hr_task_category_id', ['value' => $j]); 
                                echo $this->Form->control('hr_pt_tasks.' . $j . '.description', ['label' => false, 'class' => 'form-control task', 'type' => 'textbox',  'templateVars' => ['ctnClass' => 'col-md-8']]);
                                echo $this->Form->control('hr_pt_tasks.' . $j . '.users._ids', ['label' => false, 'options' => $staffs, 'required', 'empty' => true, 'data-placeholder' => "Pick 1 or more PIC", 'templateVars' => ['extra_class' => 'select2-show-search form-select', 'ctnClass' => 'col-md-4']]);
                            }
                            $j++;
                        }
                        ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="form-footer mt-2 text-center">
                        <input type="submit" class="btn btn-large btn-primary" value="Save">
                        
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<?= $this->Form->end() ?>