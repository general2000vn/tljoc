<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<?php
//$this->layout = 'styleless';
?>

<?php
$this->loadHelper('Form', [
    'templates' => 'sash_form_templates',
]);

$this->setLayout('sash');

$page_heading = 'Edit My Vaccination';

$this->set('page_heading', $page_heading);
$this->set('menuElement', 'sash/left-menu-personal');

$this->set('breadcrumbs', [
    ['caption' => 'Users', 'class' => 'active'],
    ['caption' => $page_heading, 'class' => 'active'],
]);

$this->start('head_css');
echo $this->Html->css('../assets/plugins/bootstrap-select/css/bootstrap-select');
$this->end();

$this->start('head_scripts');
//echo $this->Html->css(['../assets/plugins/bootstrap/css/bootstrap.min', '../assets/css/style.min']) ;
$this->end();

$this->start('bottom_scripts');
$this->end();

// $this->loadHelper('Form', [
//     'templates' => 'aero_form_templates',
// ]);
?>

<?= $this->Form->create($user) ?>

<div class="row">
    <div class="col-12">
    <div class="card">
            <div class="card-header">
                <h3 class="card-title">My Vaccination</h3>
            </div>
            <div class="card-body">
                <div class="row">
                
                    <?= $this->Form->control('vaccination_id', ['options' => $vaccinations, 'templateVars' => ['ctnClass' => 'col-lg-6 col-md-12']]) ?>
                    <?= $this->Form->control('health_id', ['options' => $healths, 'templateVars' => ['ctnClass' => 'col-lg-6 col-md-12']]) ?>

                    <?= $this->Form->control('vaccine1_id', ['options' => $vaccines, 'templateVars' => ['ctnClass' => 'col-lg-4 col-md-12']]) ?>
                    <?= $this->Form->control('vaccine1_date', ['templateVars' => ['ctnClass' => 'col-lg-4 col-md-12']]) ?>
                    <?= $this->Form->control('vaccine1_place', ['templateVars' => ['ctnClass' => 'col-lg-4 col-md-12']]) ?>

                    <?= $this->Form->control('vaccine2_id', ['options' => $vaccines, 'templateVars' => ['ctnClass' => 'col-lg-4 col-md-12']]) ?>
                    <?= $this->Form->control('vaccine2_date', ['templateVars' => ['ctnClass' => 'col-lg-4 col-md-12']]) ?>
                    <?= $this->Form->control('vaccine2_place', ['templateVars' => ['ctnClass' => 'col-lg-4 col-md-12']]) ?>

                    <?= $this->Form->control('vaccine3_id', ['options' => $vaccines, 'templateVars' => ['ctnClass' => 'col-lg-4 col-md-12']]) ?>
                    <?= $this->Form->control('vaccine3_date', ['templateVars' => ['ctnClass' => 'col-lg-4 col-md-12']]) ?>
                    <?= $this->Form->control('vaccine3_place', ['templateVars' => ['ctnClass' => 'col-lg-4 col-md-12']]) ?>

                    <?= $this->Form->control('vaccine4_id', ['options' => $vaccines, 'templateVars' => ['ctnClass' => 'col-lg-4 col-md-12']]) ?>
                    <?= $this->Form->control('vaccine4_date', ['templateVars' => ['ctnClass' => 'col-lg-4 col-md-12']]) ?>
                    <?= $this->Form->control('vaccine4_place', ['templateVars' => ['ctnClass' => 'col-lg-4 col-md-12']]) ?>
                    

            </div>
            <div class="card-footer text-center">
                
                <?= $this->Form->submit('Save', ['class' => 'btn btn-success my-1']) ?>
                
            </div>
        </div>
    </div>
</div>



<?= $this->Form->end() ?>