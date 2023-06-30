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

$page_heading = 'Edit Profile';

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

<?= $this->Form->create($user, ['type' => 'file']) ?>

<!-- ROW-1 OPEN -->
<div class="row">
    <div class="col-xl-4">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Avatar</div>
            </div>
            <div class="card-body">
                <div class="text-center chat-image mb-5">
                    <div class="avatar avatar-xxl chat-profile mb-3 brround">
                        <?= $this->Html->image('../uploads/avatar/avatardefault.webp') ?>
                    </div>
                    <div class="main-chat-msg-name">
                        <a href="profile.html">
                            <h5 class="mb-1 text-dark fw-semibold"><?= $this->Identity->get('name') ?></h5>
                        </a>
                        <p class="text-muted mt-0 mb-0 pt-0 fs-13"></p>
                    </div>
                </div>

            </div>

        </div>
    </div>

    <div class="col-xl-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Profile Detail</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    
                    
                    <?= $this->Form->control('title', ['empty' => false, 'type' => 'select', 'options' => ['Mr.' => 'Mr.', 'Ms.' => 'Ms.', "Dr." => 'Dr.'],'label' => 'Title', 'required', 'templateVars' => ['lblClass' => 'required', 'ctnClass' => 'col-md-2']]) ?>
                    <?= $this->Form->control('firstname', [ 'disabled', 'templateVars' => ['ctnClass' => 'col-md-5']]) ?>
                    <?= $this->Form->control('lastname', [ 'disabled', 'templateVars' => ['ctnClass' => 'col-md-5']]) ?>
                    
                    <?= $this->Form->control('email', [ 'disabled', 'templateVars' => ['ctnClass' => 'col-md-4']]) ?>
                    <?= $this->Form->control('department.name', ['label' => 'Department',  'disabled', 'templateVars' => ['ctnClass' => 'col-md-4']]) ?>
                    <?= $this->Form->control('emp_type.name', ['label' => 'Employment Type',  'disabled', 'templateVars' => ['ctnClass' => 'col-md-4']]) ?>
                    
                    <div class='col-md-4'>
                        <div class="custom-controls-stacked">
                            <?= $this->Form->radio('is_active', [['text' => 'Working', 'value' => "1"], ['text' => 'On Leave', 'value' => "0"]], ['class' => 'custom-control-input', 'templateVars' => ['ctnClass' => 'custom-control custom-radio-md']]) ?>
                        </div>
                    </div>
                    <?= $this->Form->control('dob', [ 'label' => 'Date of Birth', 'templateVars' => ['ctnClass' => 'col-md-4']]) ?>
                    <?= $this->Form->control('mobile', [ 'label' => 'Mobile', 'templateVars' => ['ctnClass' => 'col-md-4']]) ?>
                    
                    <?= $this->Form->control('id_number', [ 'label' => 'ID No.', 'templateVars' => ['ctnClass' => 'col-md-4']]) ?>
                    <?= $this->Form->control('id_date', [ 'label' => 'Issue Date', 'templateVars' => ['ctnClass' => 'col-md-4']]) ?>
                    <?= $this->Form->control('id_issuer', [ 'label' => 'Issuer', 'templateVars' => ['ctnClass' => 'col-md-4']]) ?>

                    <?= $this->Form->control('addr_detail', [ 'label' => 'Address', 'templateVars' => ['ctnClass' => 'col-lg-12 col-md-12']]) ?>

                    <?= $this->Form->control('addr_city', [ 'label' => 'City', 'templateVars' => ['ctnClass' => 'col-md-4']]) ?>
                    <?= $this->Form->control('addr_district', [ 'label' => 'District', 'templateVars' => ['ctnClass' => 'col-md-4']]) ?>
                    <?= $this->Form->control('addr_ward', [ 'label' => 'Ward', 'templateVars' => ['ctnClass' => 'col-md-4']]) ?>

            </div>
            <div class="card-footer text-center">
                <?= $this->Form->submit('Save', ['class' => 'btn btn-primary my-1']) ?>
            </div>
        </div>

    </div>
</div>

<!-- ROW-1 CLOSED -->


<?= $this->Form->end() ?>