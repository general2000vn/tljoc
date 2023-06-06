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

 $page_heading = 'Reserve New Document';
 
 
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
                    echo $this->Form->control('reg_date', ['label' => 'Registration Date', 'value' => FrozenDate::today(),'class' => 'form-control', 'required', 'templateVars' => ['lblClass' => 'required', 'ctnClass' => 'col-md-3']]);
                    echo $this->Form->control('reg_num', ['label' => 'Document Number', 'class' => 'form-control', 'required', 'templateVars' => ['lblClass' => 'required', 'ctnClass' => 'col-md-3']]);
                    echo $this->Form->control('reg_text', ['label' => 'Registration Number', 'class' => 'form-control', 'disabled', 'templateVars' => ['ctnClass' => 'col-md-6']]);
                    
                    echo $this->Form->control('inputter', ['value' => $this->Identity->get('name'), 'class' => 'form-control', 'disabled', 'templateVars' => ['ctnClass' => 'col-md-6']]);
                    echo $this->Form->control('modifier', ['value' => $this->Identity->get('name'), 'class' => 'form-control', 'disabled', 'templateVars' => ['ctnClass' => 'col-md-6']]);

                    echo $this->Form->control('doc_sec_level_id', ['options' => $docSecLevels, 'label' => 'Sensitivity', 'required', 'templateVars' => ['lblClass' => 'required', 'ctnClass' => 'col-md-3']]);
                    echo $this->Form->control('subject', ['label' => 'Subject', 'required', 'templateVars' => ['lblClass' => 'required', 'ctnClass' => 'col-md-9']]);

                    echo $this->Form->control('department_id', ['label' => 'Department','value' => $this->Identity->get('department_id'), 'required','class' => 'form-control', 'templateVars' => ['lblClass' => 'required', 'extra_class' => 'select2-show-search form-select', 'ctnClass' => 'col-md-4']]);
                    echo $this->Form->control('originator_id', ['label' => 'Originator', 'value' => $this->Identity->get('id'), 'required','empty' => true,'data-placeholder' => "Select a staff", 'templateVars' => ['lblClass' => 'required', 'extra_class' => 'select2-show-search form-select','ctnClass' => 'col-md-4']]);
                    echo $this->Form->control('issued_date', ['label' => 'Issued Date', 'class' => 'form-control', 'templateVars' => ['ctnClass' => 'col-md-4']]);
                    
                    // echo $this->Form->control('doc_company_id', ['options' => $docCompanies, 'label' => 'Company', 'class' => 'form-control', 'templateVars' => ['ctnClass' => 'col-md-4']]);
                    echo $this->Form->control('doc_status_id', ['options' => $docStatuses,  'label' => 'Status', 'class' => 'form-control', 'templateVars' => ['lblClass' => 'required', 'ctnClass' => 'col-md-3']]);
                    echo $this->Form->control('doc_method_id', ['options' => $docMethods, 'label' => 'Send Method', 'class' => 'form-control', 'templateVars' => ['lblClass' => 'required', 'ctnClass' => 'col-md-3']]);
                    echo $this->Form->control('doc_type_id', ['options' => $docTypes, 'label' => 'Document Type', 'class' => 'form-control', 'templateVars' => ['lblClass' => 'required', 'ctnClass' => 'col-md-3']]);
                    echo $this->Form->control('contract_no', ['label' => 'RFP/Contract No.', 'class' => 'form-control', 'templateVars' => ['ctnClass' => 'col-md-3']]);
                    
                    echo $this->Form->control('partners._ids', ['options' => $partners, 'label' => 'Distributed to', 'multiple', 'required', 'templateVars' => ['lblClass' => 'required', 'extra_class' => 'select2-show-search form-select selectPartner', 'ctnClass' => 'col-md-12']]);
                    echo $this->Form->control('others', ['label' => 'Others', 'class' => 'form-control', 'templateVars' => ['ctnClass' => 'col-md-12']]);
                 
                    echo $this->Form->control('doc_incoming_id', ['empty' => true, 'label' => 'Related Incoming Document', 'templateVars' => ['extra_class' => 'select2-show-search form-select selectDocIn', 'ctnClass' => 'col-md-12']]);

                    
                    echo $this->Form->control('doc_file', ['type' => 'file' ,'label' => 'Document File',  'templateVars' => ['ctnClass' => 'col-md-12']]); 

                    echo $this->Form->control('remark', ['label' => 'Remark', 'templateVars' => ['ctnClass' => 'col-md-12']]);

                   
                    ?>

                    <div class="form-footer mt-2 text-center">
                        <?= $this->Form->button(__('Reserve'), ['templateVars' => ['extra_class' => 'btn-primary']]) ?>
                    </div>

                </div>

            </div>

        </div>

    </div>
</div>

<?= $this->Form->end() ?>