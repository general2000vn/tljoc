<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\HrPtTask $hrPtTask
 * @var \Cake\Collection\CollectionInterface|string[] $hrPTaskStatuses
 * @var \Cake\Collection\CollectionInterface|string[] $hrPts
 * @var \Cake\Collection\CollectionInterface|string[] $users
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Hr Pt Tasks'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="hrPtTasks form content">
            <?= $this->Form->create($hrPtTask) ?>
            <fieldset>
                <legend><?= __('Add Hr Pt Task') ?></legend>
                <?php
                    echo $this->Form->control('description');
                    echo $this->Form->control('hr_p_task_status_id', ['options' => $hrPTaskStatuses]);
                    echo $this->Form->control('modifier_id');
                    echo $this->Form->control('hr_pt_id', ['options' => $hrPts]);
                    echo $this->Form->control('reminding_date', ['empty' => true]);
                    echo $this->Form->control('users._ids', ['options' => $users]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
