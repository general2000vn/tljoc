<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AcStatus[]|\Cake\Collection\CollectionInterface $acStatuses
 */
?>
<div class="acStatuses index content">
    <?= $this->Html->link(__('New Ac Status'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Ac Statuses') ?></h3>
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
                <?php foreach ($acStatuses as $acStatus): ?>
                <tr>
                    <td><?= $this->Number->format($acStatus->id) ?></td>
                    <td><?= h($acStatus->name) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $acStatus->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $acStatus->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $acStatus->id], ['confirm' => __('Are you sure you want to delete # {0}?', $acStatus->id)]) ?>
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
