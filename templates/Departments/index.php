<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DashboardPrdDay[]|\Cake\Collection\CollectionInterface $dashboardPrdDays
 */

$this->setLayout('sash');
$this->set('menuElement', 'sash/left-menu-admin');

$page_heading = 'Departments List';

$this->set('page_heading', $page_heading);

$this->set('breadcrumbs', [
    ['caption' => $this->Html->link('Departments Management', ['controller' => 'Users', 'action' => 'index']), 'class' => ""],
    ['caption' => $page_heading, 'class' => 'active'],
]);

$this->start('head_css');
//echo $this->Html->css('../assets/plugins/jquery-datatable/dataTables.bootstrap4.min');
$this->end();

$this->start('head_scripts');

$this->end();

$this->start('bottom_scripts');
    echo $this->element('sash/datatable/bottom_scripts');
    echo $this->Html->script('Sash/myUserTable');
$this->end();

// $this->loadHelper('Form', [
//     'templates' => 'aero_form_templates',
// ]);
?>


<div class="row row-sm">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Departments</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="user-list" class="table table-striped table-bordered text-nowrap key-buttons border-bottom">
                        <thead>
                            <tr>
                                
                            
                            <th class="border-bottom-0 text-center">Name</th>
                            <th class="border-bottom-0 text-center">Init</th>
                            <th class="border-bottom-0 text-center">Manager</th>
                            <th class="border-bottom-0 text-center">Deputy</th>
                            <th class="border-bottom-0 text-center">Secretary</th>
                            <th class="actions text-center"><?= __('Actions') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($departments as $department) : ?>
                                <tr>
                                    
                                    <td><?= h($department->name)  ?></td>
                                    <td><?= h($department->init)  ?></td>
                                    <td><?= $department->has('manager')? $department->manager->name : ""  ?></td>
                                    <td><?= $department->has('dlm')? $department->dlm->name : ""  ?></td>
                                    <td><?= $department->has('sec')? $department->sec->name : ""  ?></td>
                                    
                                    <td class="actions">
                                        
                                        <?= $this->Html->link('<i class="fe fe-edit"></i>', ['action' => 'edit', $department->id], ['data-bs-toggle'=>"tooltip", 'title'=>"Edit", 'class' => 'btn btn-sm btn-primary', 'escape' => false])  . '  ' ?>
                                        <?= $this->Form->postLink('<i class="fe fe-trash-2"></i>  ', ['action' => 'delete', $department->id], ['data-bs-toggle'=>"tooltip", 'confirm' => __('Are you sure you want to delete department: {0}?', $department->name), 'title'=>"Delete", 'class' => 'btn btn-sm btn-danger', 'escape' => false]) . '  ' ?>
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