<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\OrStatus[]|\Cake\Collection\CollectionInterface $orStatuses
 */
?>
<div class="orStatuses index content">
    <?= $this->Html->link(__('New Or Status'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Or Statuses') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th><?= $this->Paginator->sort('is_deleted') ?></th>
                    <th><?= $this->Paginator->sort('display_order') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orStatuses as $orStatus): ?>
                <tr>
                    <td><?= $this->Number->format($orStatus->id) ?></td>
                    <td><?= h($orStatus->name) ?></td>
                    <td><?= h($orStatus->is_deleted) ?></td>
                    <td><?= $this->Number->format($orStatus->display_order) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $orStatus->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $orStatus->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $orStatus->id], ['confirm' => __('Are you sure you want to delete # {0}?', $orStatus->id)]) ?>
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
