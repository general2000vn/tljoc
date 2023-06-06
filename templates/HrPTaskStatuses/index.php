<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\HrPTaskStatus[]|\Cake\Collection\CollectionInterface $hrPTaskStatuses
 */
?>
<div class="hrPTaskStatuses index content">
    <?= $this->Html->link(__('New Hr P Task Status'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Hr P Task Statuses') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($hrPTaskStatuses as $hrPTaskStatus): ?>
                <tr>
                    <td><?= $this->Number->format($hrPTaskStatus->id) ?></td>
                    <td><?= h($hrPTaskStatus->name) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $hrPTaskStatus->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $hrPTaskStatus->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $hrPTaskStatus->id], ['confirm' => __('Are you sure you want to delete # {0}?', $hrPTaskStatus->id)]) ?>
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
