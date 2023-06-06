<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DocOutgoing $docOutgoing
 * @var \Cake\Collection\CollectionInterface|string[] $docTypes
 * @var \Cake\Collection\CollectionInterface|string[] $docCompanies
 * @var \Cake\Collection\CollectionInterface|string[] $partners
 * @var \Cake\Collection\CollectionInterface|string[] $docCategories
 * @var \Cake\Collection\CollectionInterface|string[] $docMethods
 * @var \Cake\Collection\CollectionInterface|string[] $docSecLevels
 * @var \Cake\Collection\CollectionInterface|string[] $docStatuses
 * @var \Cake\Collection\CollectionInterface|string[] $departments
 */

use App\Model\Table\DocOutgoingsTable;
use Cake\I18n\FrozenDate;

$page_heading = 'Edit Document';


$this->set('page_heading', $page_heading);

$this->set('breadcrumbs', [
    ['caption' => $this->Html->link('DAS', ['controller' => 'DocIncomings', 'action' => 'blank']), 'class' => ""],
    ['caption' => $this->Html->link('Outgoing Documents', ['controller' => 'DocIncomings', 'action' => 'index']), 'class' => "active"],
    ['caption' => $page_heading, 'class' => 'active'],
]);

$this->start('head_css');
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


<?= $this->Form->create($docOutgoing, ['type' => 'file']) ?>
<div class="row">
    <div class="col-md-12">
        <div class="card">

            <div class="card-header">
                <h3 class="card-title">Outgoing Document</h3>
            </div>
            <div class="card-body">

                <div class="row">

                    <?php
                    echo $this->Form->control('reg_date', ['label' => 'Registration Date', 'value' => FrozenDate::today(), 'disabled', 'templateVars' => ['ctnClass' => 'col-md-3']]);
                    echo $this->Form->control('reg_num', ['label' => 'Document Number', 'disabled', 'templateVars' => ['ctnClass' => 'col-md-3']]);
                    echo $this->Form->control('reg_text', ['label' => 'Registration Number', 'disabled', 'templateVars' => ['ctnClass' => 'col-md-6']]);

                    echo $this->Form->control('inputter_id', ['label' => 'Inputter', 'options' => $users,  'disabled', 'templateVars' => ['ctnClass' => 'col-md-6']]);
                    echo $this->Form->control('modifier_id', ['label' => 'Last Modifier', 'options' => $users, 'value' => $this->Identity->get('id'), 'disabled', 'templateVars' => ['ctnClass' => 'col-md-6']]);

                    echo $this->Form->control('doc_sec_level_id', ['options' => $docSecLevels, 'label' => 'Sensitivity', 'required', 'templateVars' => ['lblClass' => 'required', 'ctnClass' => 'col-md-3']]);
                    echo $this->Form->control('subject', ['label' => 'Subject', 'required', 'templateVars' => ['lblClass' => 'required', 'ctnClass' => 'col-md-9']]);

                    echo $this->Form->control('department_id', ['label' => 'Department', 'options' => $departments, 'required', 'templateVars' => ['lblClass' => 'required', 'extra_class' => 'select2-show-search form-select', 'ctnClass' => 'col-md-4']]);
                    echo $this->Form->control('originator_id', ['label' => 'Originator', 'options' => $users, 'required', 'empty' => true, 'data-placeholder' => "Select a staff", 'templateVars' => ['lblClass' => 'required', 'extra_class' => 'select2-show-search form-select', 'ctnClass' => 'col-md-4']]);
                    echo $this->Form->control('issued_date', ['label' => 'Issued Date', 'templateVars' => ['ctnClass' => 'col-md-4']]);

                    // echo $this->Form->control('doc_company_id', ['options' => $docCompanies, 'label' => 'Company', 'templateVars' => ['ctnClass' => 'col-md-4']]);
                    echo $this->Form->control('doc_status_id', ['options' => $docStatuses,  'label' => 'Status', 'templateVars' => ['lblClass' => 'required', 'ctnClass' => 'col-md-3']]);
                    echo $this->Form->control('doc_method_id', ['options' => $docMethods, 'label' => 'Send Method', 'templateVars' => ['lblClass' => 'required', 'ctnClass' => 'col-md-3']]);
                    echo $this->Form->control('doc_type_id', ['options' => $docTypes, 'label' => 'Document Type', 'templateVars' => ['lblClass' => 'required', 'ctnClass' => 'col-md-3']]);
                    echo $this->Form->control('contract_no', ['label' => 'RFP/Contract No.', 'templateVars' => ['ctnClass' => 'col-md-3']]);

                    echo $this->Form->control('partners._ids', ['options' => $partners, 'label' => 'Distributed to', 'multiple', 'required', 'templateVars' => ['lblClass' => 'required', 'extra_class' => 'select2-show-search form-select selectPartner', 'ctnClass' => 'col-md-12']]);
                    echo $this->Form->control('others', ['label' => 'Others', 'templateVars' => ['ctnClass' => 'col-md-12']]);

                    echo $this->Form->control('doc_incoming_id', ['empty' => true, 'options' => $relatedDoc, 'label' => 'Related Incoming Document', 'templateVars' => ['extra_class' => 'select2-show-search form-select selectDocIn', 'ctnClass' => 'col-md-12']]);

                    if (!is_null($docOutgoing->doc_file) && ($docOutgoing->doc_file != '')) {
                        echo '<div class="col-md-12 form-group">';
                        echo $this->Form->label('Document File');
                        echo '</div>';

                        echo '<div class="col-md-1 form-group">';
                        echo $this->Html->link('<i class="fe fe-trash"></i>', ['action' => 'deleteFile', $docOutgoing->id], ['confirm' => __('Are you sure you want to delete the file?'), 'class' => 'btn-sm btn-danger', 'data-bs-toggle' => 'tooltop', 'title' => "Delete", 'type' => "button", 'escape' => false]);
                        //echo '<div class="col-md-1"><button class="btn btn-remove-upload btn-danger btn-icon" data-bs-toggle="tooltip" title="Delete" id="btn_remove_upload-0-" type="button"><i class="fe fe-trash"></i></button></div>';
                        echo '</div>';


                        echo '<div class="col-md-11 form-group">';
                        echo $this->Html->link($docOutgoing->doc_file, DS . DocOutgoingsTable::UPLOAD_DIR . $docOutgoing->doc_file, ['target' => "_blank"]);
                        echo "</div>";

                        
                    } else {
                        echo $this->Form->control('doc_file', ['type' => 'file', 'label' => 'Document File',  'templateVars' => ['ctnClass' => 'col-md-12']]);
                    }

                    echo $this->Form->control('remark', ['label' => 'Remark', 'templateVars' => ['ctnClass' => 'col-md-12']]);
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