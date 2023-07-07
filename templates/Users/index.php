<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DashboardPrdDay[]|\Cake\Collection\CollectionInterface $dashboardPrdDays
 */

$this->setLayout('sash');
$this->set('menuElement', 'sash/left-menu-admin');

$page_heading = 'Active Users';

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
                <h3 class="card-title">Active Users</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="user-list" class="table table-striped table-bordered text-nowrap key-buttons border-bottom">
                        <thead>
                            <tr>
                            <th class="border-bottom-0 text-center">First Name</th>
                            <th class="border-bottom-0 text-center">Last Name</th>
                            <th class="border-bottom-0 text-center">Username</th>
                            <th class="border-bottom-0 text-center">Department</th>
                            <th class="border-bottom-0 text-center">Group</th>
                            <th class="border-bottom-0 text-center">Email</th>
                            
                            <th class="actions text-center"><?= __('Actions') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($users as $user) : ?>
                                <tr>
                                    <td><?= h($user->firstname)  ?></td>
                                    <td><?= h($user->lastname)  ?></td>
                                    <td><?= h($user->username)  ?></td>
                                    <td><?php
                                            foreach ($user->departments as $department){
                                                echo $department->name . ", ";
                                            }  
                                        ?>
                                    </td>
                                    <td><?= $user->has('group')? $user->group->name : "" ?></td>
                                    <td><?= $user->has('email')? $user->email : "" ?></td>
                                    <td class="actions">
                                        
                                        <?= $this->Html->link('<i class="fe fe-edit"></i>', ['action' => 'adminEdit', $user->id], ['data-bs-toggle'=>"tooltip", 'title'=>"Edit", 'class' => 'btn btn-sm btn-primary', 'escape' => false])  . '  ' ?>
                                        <!-- <?= $this->Html->link('<i class="fa fa-key"></i>  ', ['action' => 'rspwd', $user->id], ['data-bs-toggle'=>"tooltip", 'title'=>"Reset Password", 'class' => 'btn btn-sm btn-warning', 'escape' => false]) . '  ' ?> -->
                                        <?= $this->Form->postLink('<i class="fe fe-trash-2"></i>  ', ['action' => 'delete', $user->id], ['data-bs-toggle'=>"tooltip", 'confirm' => __('Are you sure you want to delete user: {0}?', $user->name), 'title'=>"Delete", 'class' => 'btn btn-sm btn-danger', 'escape' => false]) . '  ' ?>
                                
                                        
                                
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