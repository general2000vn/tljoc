<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AppComment $appComment
 * @var string[]|\Cake\Collection\CollectionInterface $users
 */
$this->loadHelper('Authentication.Identity');

?>

<?php

$page_heading = 'Process Comment';

$this->set('page_heading', $page_heading);

$this->set('breadcrumbs', [
    ['caption' => 'Application Comments', 'class' => 'active'],
    ['caption' => $page_heading, 'class' => 'active'],
]);

$this->start('head_css');
    // echo $this->Html->css('../assets/plugins/bootstrap-select/css/bootstrap-select');
    // //echo $this->Html->css('../assets/plugins/select2/select2');
    // echo $this->Html->css('../newLib/select2.min.css');
$this->end();

$this->start('head_scripts');

$this->end();

$this->start('bottom_scripts');
    // echo $this->Html->script('../newLib/select2.min.js');
    // echo $this->Html->script('select2');
$this->end();

$this->loadHelper('Form', [
    'templates' => 'sash_form_templates',
]);
?>


<div class="row">
    <div class="col-md-12">
        <div class="card">

            <div class="card-header">
                <h3 class="card-title">Comment</h3>
            </div>
            <div class="card-body">
                <?= $this->Form->create($appComment) ?>

                <div class="row">
                <?php
                    echo $this->Form->control('ac_module_id',['options' => $acModules,  'label' => 'Module', 'templateVars' => ['ctnClass' => 'col-md-6']]) ;
                    echo $this->Form->control('page',['label' => 'On Page', 'templateVars' => ['ctnClass' => 'col-md-6']]) ;
                    
                    echo $this->Form->control('ac_type_id',['label' => 'Type', 'templateVars' => ['ctnClass' => 'col-md-4']]) ;
                    echo $this->Form->control('ac_status_id',['label' => 'Status',  'templateVars' => ['ctnClass' => 'col-md-4']]) ;
                    echo $this->Form->control('ac_result_id',['label' => 'Result',  'templateVars' => ['ctnClass' => 'col-md-4']]) ;

                    echo $this->Form->control('brief',['label' => 'Short Description', 'placeholder' => 'will be displayed in list', 'templateVars' => ['ctnClass' => 'col-md-12']]) ;
                    echo $this->Form->control('description',['label' => 'Detail', 'placeholder' => 'Please enter as much detail as posible', 'templateVars' => ['ctnClass' => 'col-md-12']]) ;
                    
                ?>

                    <div class="form-footer mt-2 text-center">
                        <?= $this->Form->button(__('Save'), ['templateVars' => ['extra_class' => 'btn-primary']]) ?>
                    </div>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>