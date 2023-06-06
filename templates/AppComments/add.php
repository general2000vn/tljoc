<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AppComment $appComment
 * @var \Cake\Collection\CollectionInterface|string[] $users
 */
$this->loadHelper('Authentication.Identity');

?>

<?php
$page_heading = 'New Comment';

$this->set('page_heading', $page_heading);

$this->set('breadcrumbs', [
    ['caption' => 'App. Comments', 'class' => 'active'],
    ['caption' => $page_heading, 'class' => 'active'],
]);

$this->start('head_css');
//echo $this->Html->css('../assets/plugins/jquery-datatable/dataTables.bootstrap4.min');
$this->end();

$this->start('head_scripts');

$this->end();

$this->start('bottom_scripts');

$this->end();

$this->loadHelper('Form', [
    'templates' => 'sash_form_templates',
]);
?>

<div class="row">
    <div class="col-md-12">
        <div class="card">

            <div class="card-header">
                <h3 class="card-title">Create New Comment</h3>
            </div>
            <div class="card-body">
                <?= $this->Form->create($appComment) ?>

                <div class="row">
                <?php
                    echo $this->Form->control('ac_module_id',['options' => $acModules,  'label' => 'Module', 'templateVars' => ['ctnClass' => 'col-md-6']]) ;
                    echo $this->Form->control('page',['label' => 'On Page', 'templateVars' => ['ctnClass' => 'col-md-6']]) ;
                    
                    echo $this->Form->control('ac_type_id',['label' => 'Type', 'templateVars' => ['ctnClass' => 'col-md-4']]) ;
                    echo $this->Form->control('ac_status_id',['label' => 'Status', 'value' => '', 'disabled', 'type' => 'text', 'templateVars' => ['ctnClass' => 'col-md-4']]) ;
                    echo $this->Form->control('ac_result_id',['label' => 'Result', 'value' => '', 'disabled', 'type' => 'text', 'templateVars' => ['ctnClass' => 'col-md-4']]) ;

                    echo $this->Form->control('brief',['label' => 'Short Description', 'placeholder' => 'will be displayed in list', 'templateVars' => ['ctnClass' => 'col-md-12']]) ;
                    echo $this->Form->control('description',['label' => 'Detail', 'placeholder' => 'Please enter as much detail as posible', 'templateVars' => ['ctnClass' => 'col-md-12']]) ;
                    
                ?>

                    <div class="form-footer mt-2 text-center">
                        <?= $this->Form->button(__('Create'), ['templateVars' => ['extra_class' => 'btn-primary']]) ?>
                    </div>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>
