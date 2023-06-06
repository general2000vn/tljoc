<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Role $role
 * @var string[]|\Cake\Collection\CollectionInterface $users
 */

$this->loadHelper('Form', [
    'templates' => 'sash_form_templates',
]);

//$this->loadHelper('Authentication.Identity');

$page_heading = 'Edit Role';

$this->set('page_heading', $page_heading);

$this->set('breadcrumbs', [
    ['caption' => 'Roles Management', 'class' => 'active'],
    ['caption' => $page_heading, 'class' => 'active'],
]);

$this->start('head_css');
$this->end();

$this->start('head_scripts');
$this->end();

$this->start('bottom_scripts');
echo $this->Html->script(['../themes/sash/assets/plugins/select2/select2.full.min', '../themes/sash/assets/js/select2']);
$this->end();
?>

<?= $this->Form->create($role) ?>
<div class="row">
    <div class="col-md-12">

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Role Detail</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <?php
                    echo $this->Form->control('name', ['class' => 'form-control', 'label' => 'Role Name', 'templateVars' => ['ctnClass' => 'col-md-12']]);
                    echo $this->Form->control('description', ['class' => 'form-control',  'label' => 'Description', 'templateVars' => ['ctnClass' => 'col-md-12']]);
                    echo $this->Form->control('users._ids', ['options' => $users, 'label' => 'Assigned Users', 'multiple', 'templateVars' => ['extra_class' => 'select2-show-search form-select', 'ctnClass' => 'col-md-12']]);

                    ?>

                </div>

            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="form-footer mt-2 text-center">
                        <?php
                        echo $this->Form->submit('Save Change', ['class' => 'btn btn-primary', 'templateVars' => ['ctnClass' => 'col-md-12 align-center']]);
                        ?>
                    </div>
                </div>
            </div>
        </div>

    </div>

    </div>

    <?= $this->Form->end() ?>