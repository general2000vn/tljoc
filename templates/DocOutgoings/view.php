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

use Cake\I18n\FrozenDate;
use App\Model\Table\DocOutgoingsTable;

$page_heading = 'View Document';


$this->set('page_heading', $page_heading);

$this->set('breadcrumbs', [
    ['caption' => $this->Html->link('DAS', ['controller' => 'DocIncomings', 'action' => 'blank']), 'class' => ""],
    ['caption' => $this->Html->link('Outgoing Documents', ['controller' => 'DocIncomings', 'action' => 'index']), 'class' => "active"],
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

<div class="row">
    <div class="col-md-12">
        <div class="card">

            <div class="card-header">
                <h3 class="card-title">Outgoing Document</h3>
            </div>
            <div class="card-body">
                <?= $this->Form->create($docOutgoing, ['type' => 'file']) ?>
                <div class="row">

                    <?php
                    echo $this->Form->control('reg_date', ['label' => 'Registration Date', 'disabled', 'templateVars' => ['ctnClass' => 'col-md-3']]);
                    echo $this->Form->control('reg_num', ['label' => 'Document Number', 'disabled', 'templateVars' => ['ctnClass' => 'col-md-3']]);
                    echo $this->Form->control('reg_text', ['label' => 'Registration Number', 'disabled', 'templateVars' => ['ctnClass' => 'col-md-6']]);

                    echo $this->Form->control('inputter', ['value' => $docOutgoing->inputter->name, 'disabled', 'templateVars' => ['ctnClass' => 'col-md-6']]);
                    echo $this->Form->control('modifier', ['value' => $docOutgoing->modifier->name, 'label' => 'Last Modifier', 'disabled', 'templateVars' => ['ctnClass' => 'col-md-6']]);

                    echo $this->Form->control('doc_sec_level_id', ['type' => 'text', 'value' => $docOutgoing->doc_sec_level->name, 'label' => 'Sensitivity level', 'disabled', 'templateVars' => ['ctnClass' => 'col-md-2']]);
                    echo $this->Form->control('subject', ['label' => 'Subject', 'disabled', 'templateVars' => ['ctnClass' => 'col-md-10']]);

                    echo $this->Form->control('department_id', ['type' => 'text', 'value' => $docOutgoing->department->name, 'label' => 'Department', 'disabled', 'templateVars' => ['ctnClass' => 'col-md-4']]);
                    echo $this->Form->control('originator', ['type' => 'text', 'value' => $docOutgoing->originator->name, 'label' => 'Originator', 'disabled', 'templateVars' => ['ctnClass' => 'col-md-4']]);
                    echo $this->Form->control('issued_date', ['label' => 'Issued Date', 'disabled', 'templateVars' => ['ctnClass' => 'col-md-4']]);

                    echo $this->Form->control('doc_status_id', ['type' => 'text', 'value' => $docOutgoing->doc_status->name,  'label' => 'Status', 'disabled', 'templateVars' => ['ctnClass' => 'col-md-3']]);
                    echo $this->Form->control('doc_method_id', ['type' => 'text', 'value' => $docOutgoing->doc_method->name, 'label' => 'Send Method', 'disabled', 'templateVars' => ['ctnClass' => 'col-md-3']]);
                    echo $this->Form->control('doc_type_id', ['type' => 'text', 'value' => $docOutgoing->doc_type->name, 'label' => 'Document Type', 'disabled', 'templateVars' => ['ctnClass' => 'col-md-3']]);
                    echo $this->Form->control('contract_no', ['label' => 'RFP/Contract No.', 'disabled', 'templateVars' => ['ctnClass' => 'col-md-3']]);

                    echo $this->Form->control('partners._ids', ['options' => $partners, 'label' => 'Distributed to', 'disabled', 'multiple', 'templateVars' => ['extra_class' => 'select2-show-search form-select selectPartner', 'ctnClass' => 'col-md-12']]);
                    echo $this->Form->control('others', ['label' => 'Others', 'disabled', 'templateVars' => ['ctnClass' => 'col-md-12']]);

                    if ($docOutgoing->has('doc_incoming_id')) {
                        echo '<div class="col-md-12 form-group">';
                        echo $this->Form->label('Document File');
                        
                        echo $this->Html->link($docOutgoing->doc_incoming->name, ['controller' => 'DocIncomings', 'action' => 'view', $docOutgoing->doc_incoming->id], ['target' => 'blank']);
                        echo '</div>';
                    } else {
                        echo $this->Form->control('doc_incoming_id', ['type' => 'text', 'value' => "", 'label' => 'Related Incoming Document', 'disabled', 'templateVars' => ['ctnClass' => 'col-md-12']]);
                    }


                    if (!is_null($docOutgoing->doc_file) && ($docOutgoing->doc_file != '')) {
                        echo '<div class="col-md-12 form-group">';
                        echo $this->Form->label('Outgoing Document File');
                        
                        echo $this->Html->link($docOutgoing->doc_file,  DS . DocOutgoingsTable::UPLOAD_DIR . $docOutgoing->doc_file, ['target' => '_blank']);

                        echo '</div>';
                    } else {
                        echo $this->Form->control('doc_file', ['type' => 'text', 'value' => "", 'label' => 'Outgoing Document file TEST', 'disabled', 'templateVars' => ['ctnClass' => 'col-md-12']]);
                    }

                    echo $this->Form->control('remark', ['label' => 'Remark', 'disabled', 'templateVars' => ['ctnClass' => 'col-md-12']]);


                    ?>
                </div>

                <?= $this->Form->end() ?>

                <div class="text-center">
                    <?= $this->Html->link('Edit', ['action' => 'edit', $docOutgoing->id], ['class' => 'btn btn-large btn-primary align-center']) ?>
                </div>

            </div>
        </div>
    </div>

</div>