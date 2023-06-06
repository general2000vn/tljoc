<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Role $role
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
echo $this->element('sash/datatable/bottom_scripts');
echo $this->Html->script('Sash/myDataTable');
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

                    ?>

                </div>

            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="form-footer mt-2 text-center">
                        <?php
                        echo $this->Html->link('Back to list', ['action' => 'index'],[ 'class' => 'btn btn-primary']);
                        ?>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>

<?= $this->Form->end() ?>


<div class="card">
    <div class="card-header">
        <h3 class="card-title">Assigned Users</h3>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-bordered text-nowrap key-buttons border-bottom">
                <thead>
                    <tr>

                        <th><?= __('No.') ?></th>
                        <th><?= __('Name') ?></th>
                        <th><?= __('Username') ?></th>
                        <th><?= __('Email') ?></th>
                        <th><?= __('Department') ?></th>

                        <th><?= __('Deleted') ?></th>


                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($role->users as $user) : ?>
                        <tr>
                            <td><?= $this->Number->format($i) ?></td>
                            <td><?= h($user->name) ?></td>
                            <td><?= h($user->username) ?></td>
                            <td><?= h($user->email) ?></td>
                            <td><?= h($user->department->name) ?></td>

                            <td><?= $user->is_deleted ? "Y" : "" ?></td>
                            
                        </tr>
                        <?php $i++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

    </div>
</div>