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

//$this->layout = 'das';

$page_heading = 'Register New';
 
 
 $this->set('page_heading', $page_heading);
 
 $this->set('breadcrumbs', [
     ['caption' => $this->Html->link('DAS', ['controller' => 'DocIncomings', 'action' => 'blank']), 'class' => ""],
     ['caption' => $this->Html->link('Internal Documents', ['controller' => 'DocIncomings', 'action' => 'index']), 'class' => "active"],
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



<?= $this->Form->create($docInternal, ['type' => 'file']) ?>
<div class="row">
    <div class="col-md-12">
        <div class="card">

            <div class="card-header">
                <h3 class="card-title">Internal Document</h3>
            </div>
            <div class="card-body">

                <div class="row">

                    <?php
                    echo $this->Form->control('reg_date', ['label' => 'Registration Date', 'value' => FrozenDate::today(),'disabled', 'templateVars' => ['ctnClass' => 'col-md-3']]);
                    echo $this->Form->control('reg_num', ['label' => 'Document Number', 'disabled', 'templateVars' => ['ctnClass' => 'col-md-3']]);
                    echo $this->Form->control('reg_text', ['label' => 'Registration Number', 'disabled', 'templateVars' => ['ctnClass' => 'col-md-6']]);
                    
                    echo $this->Form->control('inputter_id', ['options' => $users, 'value' => $this->Identity->get('id'), 'disabled', 'templateVars' => ['ctnClass' => 'col-md-6']]);
                    echo $this->Form->control('modifier_id', ['options' => $users, 'label' => 'Last Modifier','value' => $this->Identity->get('id'), 'disabled', 'templateVars' => ['ctnClass' => 'col-md-6']]);

                    echo $this->Form->control('doc_sec_level_id', ['options' => $docSecLevels, 'required', 'label' => 'Sensitivity', 'templateVars' => ['lblClass' => 'required', 'ctnClass' => 'col-md-3']]);
                    echo $this->Form->control('subject', ['label' => 'Subject', 'required', 'templateVars' => ['lblClass' => 'required', 'ctnClass' => 'col-md-9']]);
                    
                    echo $this->Form->control('department_id', ['label' => 'Department', 'required', 'value' => $default_dept_id, 'templateVars' => ['lblClass' => 'required', 'ctnClass' => 'col-md-4']]);
                    echo $this->Form->control('originator_id', ['label' => 'Originator', 'required', 'options' => $users, 'value' => $this->Identity->get('id'), 'empty' => true,'data-placeholder' => "Select a staff", 'templateVars' => ['lblClass' => 'required', 'extra_class' => 'select2-show-search form-select', 'ctnClass' => 'col-md-4']]);
                    echo $this->Form->control('issued_date', ['label' => 'Issued Date', 'templateVars' => ['ctnClass' => 'col-md-4']]);
                    
                    
                    echo $this->Form->control('doc_status_id', ['options' => $docStatuses,  'required', 'label' => 'Status', 'templateVars' => ['lblClass' => 'required', 'ctnClass' => 'col-md-3']]);
                    echo $this->Form->control('doc_internal_type_id', ['options' => $docTypes, 'required', 'label' => 'Document Type', 'templateVars' => ['lblClass' => 'required', 'ctnClass' => 'col-md-3']]);
                    echo $this->Form->control('doc_file', ['type' => 'file' , 'templateVars' => ['ctnClass' => 'col-md-6']]); 

                    echo $this->Form->control('remark', ['label' => 'Remark', 'templateVars' => ['ctnClass' => 'col-md-12']]);


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