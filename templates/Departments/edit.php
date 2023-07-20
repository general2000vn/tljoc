<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Department $department
 * @var \Cake\Collection\CollectionInterface|string[] $parentDepartments
 */

$page_heading = 'Edit Department';


$this->set('page_heading', $page_heading);

$this->set('breadcrumbs', [
    ['caption' => $this->Html->link('Department Management', ['controller' => 'Users', 'action' => 'index']), 'class' => ""],
    ['caption' => $page_heading, 'class' => 'active'],
]);

$this->start('head_css');
//echo $this->Html->css('../assets/plugins/jquery-datatable/dataTables.bootstrap4.min');
$this->end();

$this->start('head_scripts');

$this->end();

$this->start('bottom_scripts');
    echo $this->Html->script(['../themes/sash/assets/plugins/select2/select2.full.min', '../themes/sash/assets/js/select2']);
$this->end();

$this->loadHelper('Form', [
    'templates' => 'sash_form_templates',
]);
?>
<div class="row">
    <div class="col-md-12">
        <div class="card">

            <div class="card-header">
                <h3 class="card-title">Department Detail</h3>
            </div>
            <div class="card-body">
                <?= $this->Form->create($department) ?>
                <div class="row">
                    <?php
                    echo $this->Form->control('name', ['required', 'templateVars' => ['lblClass' => 'required', 'ctnClass' => 'col-md-4']]);
                    echo $this->Form->control('init', ['required', 'label' => 'Abbreviation', 'templateVars' => ['lblClass' => 'required', 'ctnClass' => 'col-md-4']]);
                    echo $this->Form->control('parent_id', ['options' => $parentDepartments, 'empty' => true, 'label' => 'Parent Department', 'templateVars' => ['ctnClass' => 'col-md-4']]);

                    echo $this->Form->control('user_id',  ['options' => $users, 'empty' => true, 'label' => 'Line Manager', 'templateVars' => [ 'extra_class' => 'select2-show-search form-select', 'ctnClass' => 'col-md-4']]);
                    echo $this->Form->control('deputies._ids',  ['options' => $users, 'multiple' => true, 'empty' => true, 'label' => 'Deputy Line Manager', 'templateVars' => ['extra_class' => 'select2-show-search form-select', 'ctnClass' => 'col-md-4']]);
                    echo $this->Form->control('sec_id',  ['options' => $users, 'empty' => true, 'label' => 'Secretary', 'templateVars' => ['extra_class' => 'select2-show-search form-select', 'ctnClass' => 'col-md-4']]);
                    ?>
                    <div class="form-footer mt-2 text-center">
                        <?= $this->Form->button(__('Save'), ['templateVars' => ['extra_class' => 'btn-primary']]) ?>
                    </div>

                </div>
                <?= $this->Form->end() ?>
            </div>

        </div>

    </div>
</div>