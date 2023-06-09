<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DocIncoming $docIncoming
 * @var string[]|\Cake\Collection\CollectionInterface $docCompanies
 * @var string[]|\Cake\Collection\CollectionInterface $users
 * @var string[]|\Cake\Collection\CollectionInterface $docStatuses
 * @var string[]|\Cake\Collection\CollectionInterface $docTypes
 */

use App\Model\Table\DocIncomingsTable;
use Cake\I18n\FrozenDate;

$page_heading = 'Edit Document';


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
                    echo $this->Form->control('reg_date', ['disabled', 'label' => 'Registration Date', 'templateVars' => ['ctnClass' => 'col-md-3']]);
                    echo $this->Form->control('reg_num', ['disabled', 'label' => 'Document Number', 'templateVars' => ['ctnClass' => 'col-md-3']]);
                    echo $this->Form->control('reg_text', ['disabled', 'label' => 'Registration Number', 'templateVars' => ['ctnClass' => 'col-md-6']]);
                    echo $this->Form->control('inputter_id', ['type' => 'text', 'value' => $docIncoming->inputter->name,  'disabled', 'label' => 'Inputter', 'templateVars' => ['ctnClass' => 'col-md-6']]);
                    echo $this->Form->control('modifier_id', ['type' => 'text', 'value' => $docIncoming->modifier->name,  'disabled', 'label' => 'Last Modifier', 'templateVars' => ['ctnClass' => 'col-md-6']]);

                    echo $this->Form->control('doc_sec_level_id', ['options' => $secretLevels, 'label' => 'Sensitivity level', 'templateVars' => ['lblClass' => 'required', 'ctnClass' => 'col-md-3']]);
                    echo $this->Form->control('subject', ['templateVars' => ['lblClass' => 'required', 'ctnClass' => 'col-md-9']]);

                    echo $this->Form->control('partner_id', ['label' => 'Sender', 'templateVars' => ['lblClass' => 'required', 'extra_class' => 'select2-show-search form-select selectPartner', 'ctnClass' => 'col-md-6']]);
                    echo $this->Form->control('ref_text', ['label' => 'Reference Number', 'templateVars' => ['ctnClass' => 'col-md-3']]);
                    echo $this->Form->control('receiving_date', ['value' => FrozenDate::today(),  'templateVars' => ['lblClass' => 'required', 'ctnClass' => 'col-md-3'], 'empty' => true]);

                    echo $this->Form->control('doc_status_id', ['options' => $docStatuses, 'label' => 'Status',  'templateVars' => ['lblClass' => 'required', 'ctnClass' => 'col-md-3']]);
                    echo $this->Form->control('doc_method_id', ['label' => 'Method', 'templateVars' => ['lblClass' => 'required', 'ctnClass' => 'col-md-3']]);
                    echo $this->Form->control('doc_type_id', ['options' => $docTypes, 'label' => 'Type',   'templateVars' => ['lblClass' => 'required', 'ctnClass' => 'col-md-3']]);
                    echo $this->Form->control('contract_num', ['label' => 'RFP/Contract No.', 'templateVars' => ['ctnClass' => 'col-md-3']]);

                    //echo $this->Form->control('departments._ids', ['label' => 'Distributed To', 'options' => $departments, 'required', 'multiple', 'data-placeholder' => "Pick one or more Departments", 'templateVars' => ['lblClass' => 'required', 'extra_class' => 'select2-show-search form-select', 'ctnClass' => 'col-md-12']]);
                    echo $this->Form->control('departments._ids', ['label' => 'To Departments', 'options' => $departments, 'required', 'multiple', 'data-placeholder' => "Pick one or more Departments", 'templateVars' => [ 'lblClass' => 'required', 'extra_class' => 'select2', 'ctnClass' => 'col-md-12']]);
                    
                    echo $this->Form->control('users._ids', ['label' => 'To Staff', 'options' => $users, 'multiple', 'data-placeholder' => "Pick one or more Staff", 'templateVars' => [ 'extra_class' => 'select2', 'ctnClass' => 'col-md-12']]);


                    echo $this->Form->control('doc_outgoing_id', ['label' => 'Related Outgoing Document', 'options' => $relatedDoc, 'empty' => true, 'templateVars' => ['extra_class' => 'select2-show-search form-select selectDocOut', 'ctnClass' => 'col-md-12']]);


                    if (!is_null($docIncoming->doc_file) && ($docIncoming->doc_file != '')) {
                        echo '<div class="col-md-12 form-group">';
                        echo $this->Form->label('Document File');
                        echo "</div>";

                        echo '<div class="col-md-1 form-group">';
                        echo $this->Html->link('<i class="fe fe-trash"></i>', ['action' => 'deleteFile', $docIncoming->id], ['confirm' => __('Are you sure you want to delete the file?'), 'class' => 'btn-sm btn-danger', 'data-bs-toggle' => 'tooltop', 'title' => "Delete", 'type' => "button", 'escape' => false]);
                        //echo '<div class="col-md-1"><button class="btn btn-remove-upload btn-danger btn-icon" data-bs-toggle="tooltip" title="Delete" id="btn_remove_upload-0-" type="button"><i class="fe fe-trash"></i></button></div>';
                        echo '</div>';

                        echo '<div class="col-md-11 form-group">';
                        echo $this->Html->link($docIncoming->doc_file, DS . DocIncomingsTable::UPLOAD_DIR . $docIncoming->doc_file, ['target' => "_blank"]);
                        echo "</div>";
                    } else {
                        echo $this->Form->control('doc_file', ['label' => 'Document File', 'type' => 'file', 'templateVars' => ['ctnClass' => 'col-md-12']]);
                    }


                    echo $this->Form->control('remark', ['templateVars' => ['ctnClass' => 'col-md-12']]);


                    ?>

                    <div class="form-footer mt-2 text-center">
                        <?= $this->Form->button(__('Save'), ['templateVars' => ['extra_class' => 'btn-primary']]) ?>
                    </div>

                </div>

            </div>

        </div>

    </div>
</div>

<?= $this->Form->end() ?>