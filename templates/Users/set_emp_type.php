<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\EmpType $empType
 * @var \App\Model\Entity\User $user
 */
?>



<?php

$page_heading = 'Set Employees Type';

$this->set('page_heading', $page_heading);

$this->set('breadcrumbs', [
    ['caption' => $this->Html->link('Setting', ['controller' => 'EmpTypes', 'action' => 'index']), 'class' => ""],
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

        <?= $this->Form->create(null) ?>

        <div class="card">

            <div class="card-header">
                <h3 class="card-title">Employees</h3>
            </div>
            <div class="card-body">
                <div class="row">

                    <?php

                    echo $this->Form->control('emp_type', ['options' => $empTypes, 'type' => 'select', 'label' => 'Employee Type', 'templateVars' => ['extra_class' => 'form-select', 'ctnClass' => 'col-md-12']]);
                    echo $this->Form->control('users', ['options' => $users, 'type' => 'select', 'label' => 'Users', 'multiple' => true, 'templateVars' => ['extra_class' => 'select2-show-search form-select', 'ctnClass' => 'col-md-12']]);

                    ?>

                </div>

            </div>

        </div>

        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="form-footer mt-2 text-center">
                        <?php
                        echo $this->Form->submit('Save', ['class' => 'btn btn-primary', 'templateVars' => ['ctnClass' => 'col-md-12 align-center']]);
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <?= $this->Form->end() ?>

    </div>
</div>