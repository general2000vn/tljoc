<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\HrPtTasksUser $hrPtTasksUser
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Hr Pt Tasks User'), ['action' => 'edit', $hrPtTasksUser->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Hr Pt Tasks User'), ['action' => 'delete', $hrPtTasksUser->id], ['confirm' => __('Are you sure you want to delete # {0}?', $hrPtTasksUser->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Hr Pt Tasks Users'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Hr Pt Tasks User'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="hrPtTasksUsers view content">
            <h3><?= h($hrPtTasksUser->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('User') ?></th>
                    <td><?= $hrPtTasksUser->has('user') ? $this->Html->link($hrPtTasksUser->user->name, ['controller' => 'Users', 'action' => 'view', $hrPtTasksUser->user->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Hr Pt Task') ?></th>
                    <td><?= $hrPtTasksUser->has('hr_pt_task') ? $this->Html->link($hrPtTasksUser->hr_pt_task->id, ['controller' => 'HrPtTasks', 'action' => 'view', $hrPtTasksUser->hr_pt_task->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($hrPtTasksUser->id) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
