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
    'templates' => 'aero_form_templates',
]);

$page_heading = 'Edit Profile';

$this->set('page_heading', $page_heading);

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
<!-- First Row Avatar and account info-->
<div class="row clearfix">
    <div class="col-lg-4 col-md-12">
        <div class="card mcard_3">
            <div class="body">

                <?= $this->Html->image($user->picture, ['class' => "rounded-circle shadow", 'alt' => 'Profile Image']) ?>
                <h4 class="m-t-10"><?= $user->username ?></h4>
               
            </div>
        </div>
        <div class="card">
            <div class="header">
                <h2><strong>Roles</strong> : </h2>
            </div>
            <div class="body">

                <ul class="list-unstyled">
                    <?php foreach ($user->roles as $role) : ?>
                        <li>
                            <div><?= $role->name ?></div>

                        </li>
                    <?php endforeach; ?>
                </ul>

            </div>
        </div>
    </div>

    <div class="col-lg-8 col-md-12">
        <div class="card">
            <div class="header">
                <h2><strong>Personal</strong> Detail</h2>
            </div>
            <div class="body">

                <div class="row clearfix">
                    <div class="col-md-6">
                        <div class="form-group">
                            <?= $this->Form->control('firstname', ['class' => 'form-control', 'disabled']) ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <?= $this->Form->control('lastname', ['class' => 'form-control', 'disabled']) ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        
                            <?= $this->Form->control('email', ['class' => 'form-control', 'disabled']) ?>
                        
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <?= $this->Form->control('department_id', ['label' => 'Department', 'class' => 'form-control', 'disabled']) ?>
                        </div>
                    </div>

                    <div class="col-md-6 form-group">
                        <?= $this->Form->radio('is_active', [['text' => 'Working', 'value' => "1"],['text' => 'On Leave', 'value' => "0"]],['disabled','class' => 'with-gap', 'templateVars' => ['ctnClass' => 'radio m-r-20']]) ?>
                    </div>


                    <div class="col-md-6">
                        <div class="form-group">
                            <?= $this->Form->control('mobile', ['disabled','class' => 'form-control']) ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <?= $this->Form->control('id_number', ['disabled','class' => 'form-control', 'label' => 'ID No.']) ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <?= $this->Form->control('id_date', ['disabled','class' => 'form-control', 'label' => 'ID Issue Date']) ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <?= $this->Form->control('id_issuer', ['disabled','class' => 'form-control', 'label' => 'ID Issuer']) ?>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <?= $this->Form->control('addr_detail', ['disabled','label' => 'Address', 'class' => 'form-control']) ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <?= $this->Form->control('addr_city', ['disabled','label' => 'City', 'class' => 'form-control']) ?>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <?= $this->Form->control('addr_district', ['disabled','label' => 'District', 'class' => 'form-control']) ?>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <?= $this->Form->control('addr_ward', ['disabled','label' => 'Ward', 'class' => 'form-control']) ?>
                        </div>
                    </div>

                    

                </div>
            </div>
        </div>
    </div>
</div>
<div class="row clearfix">
    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h2><strong>Health</strong> Detail</h2>
            </div>
            <div class="body">
                <div class="row clearfix">
                    <div class="col-md-6">
                        <div class="form-group">
                            <?= $this->Form->label('vaccination_id', 'Vaccination Status') ?>
                            <?= $this->Form->select('vaccination_id', $vaccinations, ['disabled','class' => 'form-control']) ?>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <?= $this->Form->label('health_id', 'Health Status') ?>
                            <?= $this->Form->select('health_id', $healths, ['disabled','class' => 'form-control', 'aria-label' => 'Default select example']) ?>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <?= $this->Form->label('vaccine1_id', '1st Vaccine') ?>
                            <?= $this->Form->select('vaccine1_id', $vaccines, ['disabled','class' => 'form-control', 'aria-label' => 'Default select example', 'empty' => "-none-"]) ?>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <?= $this->Form->control('vaccine1_date', ['disabled','label' => '1st Vaccine Date', 'class' => 'form-control']) ?>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <?= $this->Form->control('vaccine1_place', ['disabled','label' => '1st Vaccine Place', 'class' => 'form-control']) ?>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <?= $this->Form->label('vaccine2_id', '2nd Vaccine') ?>
                            <?= $this->Form->select('vaccine2_id', $vaccines, ['disabled','class' => 'form-control', 'aria-label' => 'Default select example', 'empty' => "-none-"]) ?>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <?= $this->Form->control('vaccine2_date', ['disabled','label' => '2nd Vaccine Date', 'class' => 'form-control']) ?>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <?= $this->Form->control('vaccine2_place', ['disabled','label' => '2nd Vaccine Place', 'class' => 'form-control']) ?>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <?= $this->Form->label('vaccine3_id', '3rd Vaccine') ?>
                            <?= $this->Form->select('vaccine3_id', $vaccines, ['disabled','class' => 'form-control', 'aria-label' => 'Default select example', 'empty' => "-none-"]) ?>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <?= $this->Form->control('vaccine3_date', ['disabled','label' => '3rd Vaccine Date', 'class' => 'form-control']) ?>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <?= $this->Form->control('vaccine3_place', ['disabled','label' => '3rd Vaccine Place', 'class' => 'form-control']) ?>
                        </div>
                    </div>

                    

                    <div class="col-md-12 align-center">
                        <?= $this->Html->link('Back', $referer, ['class' => 'btn btn-primary']) ?>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>

<?= $this->Form->end() ?>