<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Users'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="users form content">
            <?= $this->Form->create($user) ?>
            <fieldset>
                <legend><?= __('Add User') ?></legend>
                <?php
                    echo $this->Form->control('username');
                    echo $this->Form->control('password');
                    echo $this->Form->control('phone');
                    echo $this->Form->control('mobile');
                    echo $this->Form->control('lastname');
                    echo $this->Form->control('firstname');
                    echo $this->Form->control('is_active');
                    echo $this->Form->control('comment');
                    echo $this->Form->control('auth_type');
                    echo $this->Form->control('is_deleted');
                    //echo $this->Form->control('profiles_id');
                    echo $this->Form->control('user_dn');
                    echo $this->Form->control('is_deleted_ldap');
                    echo $this->Form->control('picture');
                    echo $this->Form->control('groups_id');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
