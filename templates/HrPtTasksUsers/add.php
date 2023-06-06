<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\HrPtTasksUser $hrPtTasksUser
 * @var \Cake\Collection\CollectionInterface|string[] $users
 * @var \Cake\Collection\CollectionInterface|string[] $hrPtTasks
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Hr Pt Tasks Users'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="hrPtTasksUsers form content">
            <?= $this->Form->create($hrPtTasksUser) ?>
            <fieldset>
                <legend><?= __('Add Hr Pt Tasks User') ?></legend>
                <?php
                    echo $this->Form->control('user_id', ['options' => $users]);
                    echo $this->Form->control('hr_pt_task_id', ['options' => $hrPtTasks]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
