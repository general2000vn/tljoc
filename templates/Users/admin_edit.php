<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
$page_heading = 'Admin Edit User';


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

$this->end();

$this->loadHelper('Form', [
    'templates' => 'sash_form_templates',
]);
?>
<div class="row">
    <div class="col-md-12">
        <div class="card">

            <div class="card-header">
                <h3 class="card-title">Edit User</h3>
            </div>
            <div class="card-body">
                <?= $this->Form->create($user) ?>
                <div class="row">
                <?php
                    echo $this->Form->control('username', ['empty' => true, 'label' => 'Username', 'required', 'templateVars' => ['ctnClass' => 'col-md-4']]);
                    echo $this->Form->control('password', ['label' => 'Password', 'disabled', 'placeholder' => 'Optional', 'templateVars' => ['ctnClass' => 'col-md-4']]);
                    echo $this->Form->control('email', ['label' => 'Email', 'placeholder' => 'Optional', 'templateVars' => ['ctnClass' => 'col-md-4']]);

                    echo $this->Form->control('title', ['empty' => false, 'type' => 'select', 'options' => ['Mr.' => 'Mr.', 'Ms.' => 'Ms.', "Dr." => 'Dr.'],'label' => 'Title', 'required', 'templateVars' => ['ctnClass' => 'col-md-2']]);
                    echo $this->Form->control('firstname', ['empty' => true, 'label' => 'First Name', 'required', 'templateVars' => ['ctnClass' => 'col-md-4']]);
                    echo $this->Form->control('lastname', ['empty' => true, 'label' => 'Last Name', 'required', 'templateVars' => ['ctnClass' => 'col-md-6']]);
                    

                    
                    echo $this->Form->checkbox('is_active', ['checked' => true, 'templateVars' => ['text' => 'Active', 'lblClass' => 'custom-checkbox-lg', 'ctnClass' => 'col-md-2']]);
                    echo $this->Form->checkbox('is_deleted', ['checked' => false, 'templateVars' => ['text' => 'Deleted', 'lblClass' => 'custom-checkbox-lg', 'ctnClass' => 'col-md-2']]);
                    echo $this->Form->control('emp_type_id', ['required', 'label' => 'Employee Type', 'templateVars' => ['ctnClass' => 'col-md-2']]);
                    echo $this->Form->control('department_id', ['required', 'label' => 'Department', 'templateVars' => ['ctnClass' => 'col-md-3']]);
                    echo $this->Form->control('group_id', ['required' => false, 'label' => 'Group', 'empty' => true, 'templateVars' => ['ctnClass' => 'col-md-3']]);
                    
                ?>
                    <div class="form-footer mt-2 text-center">
                        <?= $this->Form->button(__('Save Change'), ['templateVars' => ['extra_class' => 'btn-primary']]) ?>
                    </div>

                </div>
                <?= $this->Form->end() ?>
            </div>

        </div>

    </div>
</div>