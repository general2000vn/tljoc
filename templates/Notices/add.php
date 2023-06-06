<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Notice $notice
 */

$page_heading = 'Create New Notice';

$this->set('page_heading', $page_heading);

$this->set('breadcrumbs', [
    ['caption' => $this->Html->link('Notices Management', ['controller' => 'Notices', 'action' => 'index']), 'class' => ""],
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

            
            <div class="card-body">
                <?= $this->Form->create($notice) ?>
                <div class="row">

                    <?php
                    echo $this->Form->control('start_date', ['empty' => true, 'templateVars' => ['ctnClass' => 'col-md-6']]);
                    echo $this->Form->control('end_date', ['empty' => true, 'templateVars' => ['ctnClass' => 'col-md-6']]);
                    echo $this->Form->control('content', ['type' => 'text', 'required', 'templateVars' => ['ctnClass' => 'col-md-12']]);
                    
                    
                    ?>
                    <div class="form-footer mt-2 text-center">
                        <?= $this->Form->button(__('Submit'), ['templateVars' => ['extra_class' => 'btn-primary']]) ?>
                    </div>

                </div>
                <?= $this->Form->end() ?>
            </div>

        </div>

    </div>
</div>