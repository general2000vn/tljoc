<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
$page_heading = 'Change Password';
$this->set('page_heading', $page_heading);
$this->set('breadcrumbs', [
    ['caption' => 'Profile', 'class' => 'active'], ['caption' => $page_heading, 'class' => 'active']
]);

$this->setLayout('sash');
$this->set('menuElement', 'sash/left-menu-admin');
$this->loadHelper('Form', [
    'templates' => 'sash_form_templates',
]);
?>
<div class="row clearfix">
    <div class="card">
        <div class="body">
            <?= $this->Form->create($user) ?>

            <div class="row clearfix">
                <div class="col-sm-12">


                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <label for="username">Username</label>
                            <?= $this->Form->text('username', ['class' => 'form-control', 'id' => 'username', 'disabled']) ?>

                        </div>
                    </div>
                    <div class="form-row">
                        <?= $this->Form->control('firstname', ['disabled' => true, 'label' => 'First Name', 'required', 'templateVars' => ['ctnClass' => 'col-md-6']]) ?>
                        <?= $this->Form->control('lastname', ['disabled' => true, 'label' => 'Last Name', 'required', 'templateVars' => ['ctnClass' => 'col-md-6']]) ?>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <label for="password">Password</label>
                            <?= $this->Form->text('password', ['class' => 'form-control', 'id' => 'password', 'type' => 'password']) ?>

                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="password2">Confirm Password</label>
                            <?= $this->Form->text('password2', ['class' => 'form-control', 'id' => 'password2', 'type' => 'password']) ?>

                        </div>

                    </div>


                    <div class="form-footer mt-2 text-center">
                        <?= $this->Form->button(__('Change'), ['templateVars' => ['extra_class' => 'btn-primary']]) ?>
                        <?= $this->Html->link("Cancel", $referer, ['class' => 'btn btn-secondary']) ?>
                    </div>

                </div>
            </div>
            <?= $this->Form->end(); ?>
        </div>
    </div>

</div>