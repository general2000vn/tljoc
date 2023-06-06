<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\HrPtTask[]|\Cake\Collection\CollectionInterface $hrPtTasks
 */
?>
<div class="hrPtTasks index content">
    <?= $this->Html->link(__('New Hr Pt Task'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Hr Pt Tasks') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('hr_p_task_status_id') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th><?= $this->Paginator->sort('modifier_id') ?></th>
                    <th><?= $this->Paginator->sort('hr_pt_id') ?></th>
                    <th><?= $this->Paginator->sort('reminding_date') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($hrPtTasks as $hrPtTask): ?>
                <tr>
                    <td><?= $this->Number->format($hrPtTask->id) ?></td>
                    <td><?= $hrPtTask->has('hr_p_task_status') ? $this->Html->link($hrPtTask->hr_p_task_status->name, ['controller' => 'HrPTaskStatuses', 'action' => 'view', $hrPtTask->hr_p_task_status->id]) : '' ?></td>
                    <td><?= h($hrPtTask->modified) ?></td>
                    <td><?= $this->Number->format($hrPtTask->modifier_id) ?></td>
                    <td><?= $hrPtTask->has('hr_pt') ? $this->Html->link($hrPtTask->hr_pt->id, ['controller' => 'HrPts', 'action' => 'view', $hrPtTask->hr_pt->id]) : '' ?></td>
                    <td><?= h($hrPtTask->reminding_date) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $hrPtTask->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $hrPtTask->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $hrPtTask->id], ['confirm' => __('Are you sure you want to delete # {0}?', $hrPtTask->id)]) ?>
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
