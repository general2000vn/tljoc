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

$page_heading = 'View Document';


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



<div class="row">
    <div class="col-md-12">
        <div class="card">

            <div class="card-header">
                <h3 class="card-title">Incoming Document</h3>
            </div>
            <div class="card-body">
                <?= $this->Form->create($docIncoming, ['type' => 'file']) ?>
                <div class="row">
                    <?php
                    echo $this->Form->control('reg_date', ['disabled', 'label' => 'Registration Date', 'templateVars' => ['ctnClass' => 'col-md-3']]);
                    echo $this->Form->control('reg_num', ['disabled', 'label' => 'Document Number', 'templateVars' => ['ctnClass' => 'col-md-3']]);
                    echo $this->Form->control('reg_text', ['disabled', 'label' => 'Registration Number', 'templateVars' => ['ctnClass' => 'col-md-6']]);

                    echo $this->Form->control('inputter_id', ['type' => 'text', 'value' => $docIncoming->inputter->name,  'disabled', 'label' => 'Inputter', 'templateVars' => ['ctnClass' => 'col-md-6']]);
                    echo $this->Form->control('modifier_id', ['type' => 'text', 'value' => $docIncoming->modifier->name,  'disabled', 'label' => 'Last Modifier', 'templateVars' => ['ctnClass' => 'col-md-6']]);

                    echo $this->Form->control('doc_sec_level_id', ['options' => $secretLevels, 'label' => 'Sensitivity level',  'disabled', 'templateVars' => ['lblClass' => 'required', 'ctnClass' => 'col-md-3']]);
                    echo $this->Form->control('subject', ['disabled', 'templateVars' => ['lblClass' => 'required',  'disabled', 'ctnClass' => 'col-md-9']]);

                    echo $this->Form->control('partner_id', ['label' => 'Sender',  'disabled', 'templateVars' => ['lblClass' => 'required', 'extra_class' => 'select2-show-search form-select selectPartner', 'ctnClass' => 'col-md-6']]);
                    echo $this->Form->control('ref_text', ['label' => 'Reference Number',  'disabled', 'templateVars' => ['ctnClass' => 'col-md-3']]);
                    echo $this->Form->control('receiving_date', ['value' => FrozenDate::today(),  'disabled',  'templateVars' => ['lblClass' => 'required', 'ctnClass' => 'col-md-3'], 'empty' => true]);

                    echo $this->Form->control('doc_status_id', ['options' => $docStatuses, 'label' => 'Status',  'disabled',  'templateVars' => ['lblClass' => 'required', 'ctnClass' => 'col-md-3']]);
                    echo $this->Form->control('doc_method_id', ['label' => 'Method',  'disabled', 'templateVars' => ['lblClass' => 'required', 'ctnClass' => 'col-md-3']]);
                    echo $this->Form->control('doc_type_id', ['options' => $docTypes, 'label' => 'Type',   'disabled',  'templateVars' => ['lblClass' => 'required', 'ctnClass' => 'col-md-3']]);
                    echo $this->Form->control('contract_num', ['label' => 'RFP/Contract No.',  'disabled', 'templateVars' => ['ctnClass' => 'col-md-3']]);

                    echo $this->Form->control('departments._ids', ['label' => 'Distributed To',  'disabled', 'options' => $departments, 'multiple', 'data-placeholder' => "Pick one or more Departments", 'templateVars' => ['lblClass' => 'required', 'extra_class' => 'select2-show-search form-select', 'ctnClass' => 'col-md-12']]);


                    if ($docIncoming->has('doc_outgoing_id')) {
                        echo '<div class="col-md-12 form-group">';
                        echo $this->Form->label('Related Document');
                        
                        echo $this->Html->link($docIncoming->doc_outgoing->name, ['controller' => 'DocOutgoings', 'action' => 'view', $docIncoming->doc_outgoing_id], ['target' => 'blank']);
                        echo '</div>';
                    } else {
                        echo $this->Form->control('doc_outgoing_id', ['type' => 'text', 'value' => "", 'label' => 'Related Outgoing Document', 'disabled', 'class' => 'form-control', 'templateVars' => ['ctnClass' => 'col-md-12']]);
                    }

                    if (!is_null($docIncoming->doc_file) && ($docIncoming->doc_file != '')) {
                        echo '<div class="col-md-12 form-group">';
                        echo $this->Form->label('Attached File');
                        
                        //echo $this->Html->link($docIncoming->doc_file, ROOT . DocIncomingsTable::UPLOAD_DIR . $docIncoming->doc_file, [ 'class' => 'form-control']) ;
                        echo $this->Html->link($docIncoming->doc_file, DS . DocIncomingsTable::UPLOAD_DIR . $docIncoming->doc_file, ['target' => '_blank']);


                        echo '</div>';
                    }

                    echo $this->Form->control('remark', ['class' => 'form-control', 'disable', 'disabled', 'templateVars' => ['ctnClass' => 'col-md-12']]);
                    ?>


                </div>
                <?= $this->Form->end() ?>

                <div class="text-center">
                    <?= $this->Html->link('Edit', ['action' => 'edit', $docIncoming->id], ['class' => 'btn btn-large btn-primary align-center']) ?>
                </div>

            </div>
        </div>
    </div>

</div>