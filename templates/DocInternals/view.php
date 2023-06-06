<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DocOutgoing $docInternal
 * @var \Cake\Collection\CollectionInterface|string[] $docTypes
 * @var \Cake\Collection\CollectionInterface|string[] $docCompanies
 * @var \Cake\Collection\CollectionInterface|string[] $partners
 * @var \Cake\Collection\CollectionInterface|string[] $docCategories
 * @var \Cake\Collection\CollectionInterface|string[] $docMethods
 * @var \Cake\Collection\CollectionInterface|string[] $docSecLevels
 * @var \Cake\Collection\CollectionInterface|string[] $docStatuses
 * @var \Cake\Collection\CollectionInterface|string[] $departments
 */

use App\Model\Table\DocInternalsTable;
use Cake\I18n\FrozenDate;

 //$this->layout = 'das';
 
 $page_heading = 'Edit Document';
  
  
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
                     
                     echo $this->Form->control('inputter', ['value' => $docInternal->inputter->name,'disabled', 'templateVars' => ['ctnClass' => 'col-md-6']]);
                     echo $this->Form->control('modifier', ['label' => 'Last Modifier', 'value' => $docInternal->modifier->name, 'disabled', 'templateVars' => ['ctnClass' => 'col-md-6']]);
 
                     echo $this->Form->control('doc_sec_level', ['value' => $docInternal->doc_sec_level->name, 'disabled', 'required', 'label' => 'Sensitivity', 'templateVars' => ['lblClass' => 'required', 'ctnClass' => 'col-md-3']]);
                     echo $this->Form->control('subject', ['label' => 'Subject', 'disabled', 'required', 'templateVars' => ['lblClass' => 'required', 'ctnClass' => 'col-md-9']]);
                     
                     echo $this->Form->control('department_id', ['label' => 'Department', 'required', 'disabled', 'templateVars' => ['lblClass' => 'required', 'ctnClass' => 'col-md-4']]);
                     echo $this->Form->control('originator', [ 'value' => $docInternal->originator->name, 'label' => 'Originator', 'required', 'disabled', 'empty' => true,'data-placeholder' => "Select a staff", 'templateVars' => ['lblClass' => 'required', 'ctnClass' => 'col-md-4']]);
                     echo $this->Form->control('issued_date', ['label' => 'Issued Date', 'disabled', 'templateVars' => ['ctnClass' => 'col-md-4']]);
                     
                     echo $this->Form->control('doc_status', ['value' => $docInternal->doc_status->name,  'required', 'disabled', 'label' => 'Status', 'templateVars' => ['lblClass' => 'required', 'ctnClass' => 'col-md-3']]);
                     echo $this->Form->control('doc_internal_type', ['value' => $docInternal->doc_internal_type->name, 'required', 'disabled', 'label' => 'Document Type', 'templateVars' => ['lblClass' => 'required', 'ctnClass' => 'col-md-3']]);

                                        
                    if (!is_null($docInternal->doc_file) && ($docInternal->doc_file != '')) {
                        echo '<div class="col-md-6 form-group">';
                        echo $this->Form->label('Document File');
                        echo "<br>";
                        
                        
                        echo $this->Html->link($docInternal->doc_file,  DS . DocInternalsTable::UPLOAD_DIR . $docInternal->doc_file, ['target' => '_blank']);

                        echo '</div>';
                    } else {
                        echo $this->Form->control('doc_file', ['type' => 'text', 'value' => "", 'label' => 'Internal Document file', 'disabled', 'class' => 'form-control', 'templateVars' => ['ctnClass' => 'col-md-6']]);
                    }

                    echo $this->Form->control('remark', ['label' => 'Remark', 'disabled', 'class' => 'form-control', 'templateVars' => ['ctnClass' => 'col-md-12']]);

                    
                    ?>


                </div>

            </div>

        </div>

    </div>
</div>

<?= $this->Form->end() ?>