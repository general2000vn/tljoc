<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Role[]|\Cake\Collection\CollectionInterface $roles
 */
$this->setLayout('sash');
$this->set('menuElement', 'sash/left-menu-admin');

$page_heading = 'Roles List';

$this->set('page_heading', $page_heading);

$this->set('breadcrumbs', [
    ['caption' => $this->Html->link('Users Management', ['controller' => 'Users', 'action' => 'index']), 'class' => ""],
    ['caption' => $page_heading, 'class' => 'active'],
]);

$this->start('head_css');
//echo $this->Html->css('../assets/plugins/jquery-datatable/dataTables.bootstrap4.min');
$this->end();

$this->start('head_scripts');

$this->end();

$this->start('bottom_scripts');
    echo $this->element('sash/datatable/bottom_scripts');
    echo $this->Html->script('Sash/myDataTable');
$this->end();

// $this->loadHelper('Form', [
//     'templates' => 'aero_form_templates',
// ]);
?>


<div class="row row-sm">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Roles</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered text-nowrap key-buttons border-bottom">
                        <thead>
                            <tr>

                                <!-- <th><?= __('ID') ?></th> -->
                                <th><?= __('Name') ?></th>
                                <th><?= __('Description') ?></th>
                                <th><?= __('Actions') ?></th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($roles as $role) : ?>
                                <tr>
                                    <!-- <td><?= $this->Number->format($role->id) ?></td> -->
                                    <td><?= h($role->name) ?></td>
                                    <td><?= h($role->description) ?></td>
                                    <td class="actions">
                                        <?= $this->Html->link('<i class="fe fe-eye"></i>  ', ['action' => 'view', $role->id], ['data-bs-toggle'=>"tooltip", 'title'=>"View", 'class' => 'btn btn-sm btn-primary', 'escape' => false]) . '  ' ?>
                                
                                        <?= $this->Html->link('<i class="fe fe-edit"></i>', ['action' => 'edit', $role->id], ['data-bs-toggle'=>"tooltip", 'title'=>"Edit", 'class' => 'btn btn-sm btn-warning', 'escape' => false])  . '  ' ?>
                                        <!-- <?= $this->Form->postLink('<i class="fe fe-trash-2"></i>  ', ['action' => 'delete', $role->id], ['data-bs-toggle'=>"tooltip", 'confirm' => __('Are you sure you want to delete department: {0}?', $role->name), 'title'=>"Delete", 'class' => 'btn btn-sm btn-danger', 'escape' => false]) . '  ' ?> -->
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>