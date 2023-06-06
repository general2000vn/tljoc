<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DeliAddress[]|\Cake\Collection\CollectionInterface $deliAddresses
 */
?>
<div class="deliAddresses index content">
    <?= $this->Html->link(__('New Deli Address'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Deli Addresses') ?></h3>
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
                <?php foreach ($deliAddresses as $deliAddress): ?>
                <tr>
                    <td><?= $this->Number->format($deliAddress->id) ?></td>
                    <td><?= h($deliAddress->name) ?></td>
                    <td><?= h($deliAddress->is_deleted) ?></td>
                    <td><?= $this->Number->format($deliAddress->display_order) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $deliAddress->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $deliAddress->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $deliAddress->id], ['confirm' => __('Are you sure you want to delete # {0}?', $deliAddress->id)]) ?>
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
