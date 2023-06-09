<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\UserTitle $userTitle
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List User Titles'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="userTitles form content">
            <?= $this->Form->create($userTitle) ?>
            <fieldset>
                <legend><?= __('Add User Title') ?></legend>
                <?php
                    echo $this->Form->control('name');
                    echo $this->Form->control('is_deleted');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
