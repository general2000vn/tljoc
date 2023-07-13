<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DocIncoming $docIncoming
 * @var \Cake\Collection\CollectionInterface|string[] $docCompanies
 * @var \Cake\Collection\CollectionInterface|string[] $users
 * @var \Cake\Collection\CollectionInterface|string[] $docStatuses
 * @var \Cake\Collection\CollectionInterface|string[] $docTypes
 */

use Cake\I18n\FrozenDate;

$page_heading = 'Register New';


$this->set('page_heading', $page_heading);

$this->set('breadcrumbs', [
    ['caption' => $this->Html->link('DAS', ['controller' => 'DocIncomings', 'action' => 'blank']), 'class' => ""],
    ['caption' => $this->Html->link('Incoming Documents', ['controller' => 'DocIncomings', 'action' => 'index']), 'class' => "active"],
    ['caption' => $page_heading, 'class' => 'active'],
]);

$this->start('head_css');
//echo $this->Html->css('../assets/plugins/jquery-datatable/dataTables.bootstrap4.min');
$this->end();

$this->start('head_scripts');

$this->end();

$this->start('bottom_scripts');
    echo $this->Html->script(['../themes/sash/assets/plugins/select2/select2.full.min', '../themes/sash/assets/js/select2']);
    echo $this->Html->script('myDAS_select2');
$this->end();

$this->loadHelper('Form', [
    'templates' => 'sash_form_templates',
]);
?>


<?= $this->Form->create($docIncoming, ['type' => 'file']) ?>
<div class="row">
    <div class="col-md-12">
        <div class="card">

            <div class="card-header">
                <h3 class="card-title">Incoming Document</h3>
            </div>
            <div class="card-body">

                <div class="row">
                    <?php
                    echo $this->Form->control('reg_date', [ 'disabled', 'label' => 'Registration Date', 'templateVars' => ['ctnClass' => 'col-md-3']]);
                    echo $this->Form->control('reg_num', [ 'disabled', 'label' => 'Document Number', 'templateVars' => ['ctnClass' => 'col-md-3']]);
                    echo $this->Form->control('reg_text', [ 'disabled', 'label' => 'Registration Number', 'templateVars' => ['ctnClass' => 'col-md-6']]);
                    echo $this->Form->control('inputter_id', ['options' => $users,  'disabled', 'label' => 'Inputter', 'templateVars' => ['ctnClass' => 'col-md-6']]);
                    echo $this->Form->control('modifier_id', ['type' => 'text', 'value' => $this->Identity->get('name'),  'disabled', 'label' => 'Last Modifier', 'templateVars' => ['ctnClass' => 'col-md-6']]);

                    echo $this->Form->control('doc_sec_level_id', ['options' => $secretLevels, 'label' => 'Sensitivity level',  'templateVars' => [ 'lblClass' => 'required', 'ctnClass' => 'col-md-3']]);
                    echo $this->Form->control('subject', ['templateVars' => [ 'lblClass' => 'required', 'ctnClass' => 'col-md-9']]);

                    echo $this->Form->control('partner_id', ['label' => 'Sender', 'templateVars' => [ 'lblClass' => 'required', 'extra_class' => 'select2-show-search form-select selectPartner', 'ctnClass' => 'col-md-6']]);
                    echo $this->Form->control('ref_text', [ 'label' => 'Reference Number', 'templateVars' => ['ctnClass' => 'col-md-3']]);
                    echo $this->Form->control('receiving_date', ['value' => FrozenDate::today(),  'templateVars' => [ 'lblClass' => 'required', 'ctnClass' => 'col-md-3'], 'empty' => true]);

                    echo $this->Form->control('doc_status_id', ['options' => $docStatuses, 'label' => 'Status',  'templateVars' => [ 'lblClass' => 'required', 'ctnClass' => 'col-md-3']]);
                    echo $this->Form->control('doc_method_id', [ 'label' => 'Method', 'templateVars' => [ 'lblClass' => 'required', 'ctnClass' => 'col-md-3']]);
                    echo $this->Form->control('doc_type_id', ['options' => $docTypes, 'label' => 'Type',   'templateVars' => [ 'lblClass' => 'required', 'ctnClass' => 'col-md-3']]);
                    echo $this->Form->control('contract_num', [ 'label' => 'RFP/Contract No.', 'templateVars' => ['ctnClass' => 'col-md-3']]);

                    echo $this->Form->control('departments._ids', ['label' => 'To Departments', 'options' => $departments, 'multiple', 'data-placeholder' => "Pick one or more Departments", 'templateVars' => [ 'lblClass' => 'required', 'extra_class' => 'select2', 'ctnClass' => 'col-md-12']]);
                    
                    echo $this->Form->control('users._ids', ['label' => 'To Staff', 'options' => $users, 'multiple', 'data-placeholder' => "Pick one or more Staff", 'templateVars' => [ 'extra_class' => 'select2', 'ctnClass' => 'col-md-12']]);

                    echo $this->Form->control('doc_outgoing_id', ['label' => 'Related Outgoing Document', 'empty' => true, 'templateVars' => ['extra_class' => 'select2-show-search form-select selectDocOut' ,'ctnClass' => 'col-md-12']]);

                    echo $this->Form->control('doc_file', ['label' => 'Document File', 'type' => 'file',   'templateVars' => ['ctnClass' => 'col-md-12']]);

                    echo $this->Form->control('remark', [  'templateVars' => ['ctnClass' => 'col-md-12']]);


                    ?>

                    <div class="form-footer mt-2 text-center">
                        <?= $this->Form->button(__('Register'), ['templateVars' => ['extra_class' => 'btn-primary']]) ?>
                    </div>

                </div>

            </div>

        </div>

    </div>
</div>

<?= $this->Form->end() ?>