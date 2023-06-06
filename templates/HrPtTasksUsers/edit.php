<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\HrPtTasksUser $hrPtTasksUser
 * @var string[]|\Cake\Collection\CollectionInterface $users
 * @var string[]|\Cake\Collection\CollectionInterface $hrPtTasks
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $hrPtTasksUser->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $hrPtTasksUser->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Hr Pt Tasks Users'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="hrPtTasksUsers form content">
            <?= $this->Form->create($hrPtTasksUser) ?>
            <fieldset>
                <legend><?= __('Edit Hr Pt Tasks User') ?></legend>
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
