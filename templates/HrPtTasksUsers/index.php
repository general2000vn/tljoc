<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\HrPtTasksUser[]|\Cake\Collection\CollectionInterface $hrPtTasksUsers
 */
?>
<div class="hrPtTasksUsers index content">
    <?= $this->Html->link(__('New Hr Pt Tasks User'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Hr Pt Tasks Users') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('user_id') ?></th>
                    <th><?= $this->Paginator->sort('hr_pt_task_id') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($hrPtTasksUsers as $hrPtTasksUser): ?>
                <tr>
                    <td><?= $this->Number->format($hrPtTasksUser->id) ?></td>
                    <td><?= $hrPtTasksUser->has('user') ? $this->Html->link($hrPtTasksUser->user->name, ['controller' => 'Users', 'action' => 'view', $hrPtTasksUser->user->id]) : '' ?></td>
                    <td><?= $hrPtTasksUser->has('hr_pt_task') ? $this->Html->link($hrPtTasksUser->hr_pt_task->id, ['controller' => 'HrPtTasks', 'action' => 'view', $hrPtTasksUser->hr_pt_task->id]) : '' ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $hrPtTasksUser->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $hrPtTasksUser->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $hrPtTasksUser->id], ['confirm' => __('Are you sure you want to delete # {0}?', $hrPtTasksUser->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>
