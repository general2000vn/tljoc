<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Partner $partner
 * @var \Cake\Collection\CollectionInterface|string[] $docOutgoings
 */


 $page_heading = 'Edit External Entity';


 $this->set('page_heading', $page_heading);
 
 $this->set('breadcrumbs', [
     ['caption' => $this->Html->link('DAS', ['controller' => 'DocIncomings', 'action' => 'blank']), 'class' => ""],
     ['caption' => $this->Html->link('External Entities', ['controller' => 'DocIncomings', 'action' => 'index']), 'class' => "active"],
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

<?= $this->Form->create($partner) ?>
<div class="row">
    <div class="col-md-12">
        <div class="card">

            <div class="card-header">
                <h3 class="card-title">External Entity</h3>
            </div>
            <div class="card-body">

                <div class="row">

                    <?php
                    echo $this->Form->control('name', ['label' => 'Name', 'class' => 'form-control', 'templateVars' => ['ctnClass' => 'col-md-12']]);
                    echo $this->Form->control('name2', ['label' => 'Abbreviation', 'class' => 'form-control', 'templateVars' => ['ctnClass' => 'col-md-6']]);
                    echo $this->Form->control('tax_code', ['label' => 'Tax Code', 'class' => 'form-control', 'templateVars' => ['ctnClass' => 'col-md-6']]);
                    
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